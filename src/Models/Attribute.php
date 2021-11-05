<?php

namespace Guysolamour\Administrable\Extensions\Shop\Models;


use Guysolamour\Administrable\Models\BaseModel;
use Guysolamour\Administrable\Traits\ModelTrait;
use Guysolamour\Administrable\Traits\SluggableTrait;

class Attribute extends BaseModel
{
    use ModelTrait;
    use SluggableTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'shop_attributes';


    public $fillable = ['name', 'description', 'slug', 'product_id'];

    /**
     * The field to use for sluggable
     *
     * @var string
     */
    protected $sluggablefield = 'name';


    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'terms_list', 'global', 'value'
    ];


    /**
     * Scope a query to only include
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFindByName($query, string $name)
    {
        return $query->where('name', $name);
    }


    public function saveTerms($terms)
    {
        $terms = array_filter(array_unique(array_map(function ($item) {
            return trim($item);
        }, explode(',', $terms))), function ($item) {
            return !empty($item);
        });

        $persisted_terms = config('administrable-shop.models.attributeterm')::whereIn('name', $terms)->get();

        $terms_to_create = array_diff($terms, $persisted_terms->pluck('name')->all());

        $terms_to_create = array_map(function ($tag) {
            return ['name' => $tag, 'order' => 1];
        }, $terms_to_create);


        return $this->terms()->createMany($terms_to_create);
    }



    public function getTermsListAttribute()
    {
        return $this->terms->implode('name', ',');
    }

    public function getValueAttribute()
    {
        return $this->terms_list;
    }

    public function getGlobalAttribute()
    {
        return $this->products->isEmpty();
    }


    public function scopeGlobal($query)
    {
        return $query->where('global', true);
    }

    // add relation methods below

    public function terms()
    {
        return $this->hasMany(config('administrable-shop.models.attributeterm'));
    }


    public function products()
    {
        return $this->belongsToMany(config('administrable-shop.models.product'), 'shop_products_attributes');
    }


    protected static function booted()
    {
        parent::booted();

        static::saved(function ($model) {
            if ($terms = request('attribute_terms')){
                $model->saveTerms($terms);
            }
        });
    }
}
