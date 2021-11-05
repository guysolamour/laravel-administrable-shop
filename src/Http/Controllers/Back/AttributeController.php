<?php

namespace Guysolamour\Administrable\Extensions\Shop\Http\Controllers\Back;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Guysolamour\Administrable\Traits\FormBuilderTrait;
use Guysolamour\Administrable\Http\Controllers\BaseController;

class AttributeController extends BaseController
{
    use FormBuilderTrait;

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributes = config('administrable-shop.models.attribute')::latest()->get();

        return view('administrable-shop::' . Str::lower(config('administrable.back_namespace')) . '.attributes.index', compact('attributes'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = $this->getForm(config('administrable-shop.models.attribute'), config('administrable-shop.forms.back.attribute'));

        return view('administrable-shop::' . Str::lower(config('administrable.back_namespace')) . '.attributes.create', compact('form'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form = $this->getForm(config('administrable-shop.models.attribute'), config('administrable-shop.forms.back.attribute'));

       $form->redirectIfNotValid();

        config('administrable-shop.models.attribute')::create($request->all());

       flashy('L\' élément a bien été ajouté');

       return redirect_backroute('extensions.shop.attribute.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show(string $slug)
    {
        $attribute = config('administrable-shop.models.attribute')::where('slug', $slug)->firstOrFail();

        return view('administrable-shop::' . Str::lower(config('administrable.back_namespace')) . '.attributes.show', compact('attribute'));
    }



      /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit(string $slug)
    {
        $attribute = config('administrable-shop.models.attribute')::where('slug', $slug)->firstOrFail();

        $form = $this->getForm($attribute, config('administrable-shop.forms.back.attribute'));

        return view('administrable-shop::' . Str::lower(config('administrable.back_namespace')) . '.attributes.edit', compact('attribute', 'form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $slug)
    {
        $attribute = config('administrable-shop.models.attribute')::where('slug', $slug)->firstOrFail();
        $form = $this->getForm($attribute, config('administrable-shop.forms.back.attribute'));

        $form->redirectIfNotValid();

        $attribute->update($request->all());

        flashy('L\' élément a bien été modifié');

        return redirect_backroute('extensions.shop.attribute.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $slug)
    {
        $attribute = config('administrable-shop.models.attribute')::where('slug', $slug)->firstOrFail();

        $attribute->delete();

        flashy('L\' élément a bien été supprimé');

        return redirect_backroute('extensions.shop.attribute.index');
    }


}
