<?php

namespace Guysolamour\Administrable\Extensions\Shop\Http\Controllers\Back;


use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Guysolamour\Administrable\Traits\FormBuilderTrait;
use Guysolamour\Administrable\Http\Controllers\BaseController;

class CategoryController extends BaseController
{
    use FormBuilderTrait;

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = config('administrable-shop.models.category')::last()->get();

        return view('administrable-shop::' . Str::lower(config('administrable.back_namespace')) . '.categories.index', compact('categories'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = $this->getForm(config('administrable-shop.models.category'), config('administrable-shop.forms.back.category'));

        return view('administrable-shop::' . Str::lower(config('administrable.back_namespace')) . '.categories.create', compact('form'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form = $this->getForm(config('administrable-shop.models.category'), config('administrable-shop.forms.back.category'));

        $form->redirectIfNotValid();

        $category = config('administrable-shop.models.category')::create($request->all());

        if ($request->ajax()) {
            return  $category;
        }

       flashy('L\' élément a bien été ajouté');

       return redirect_backroute('extensions.shop.category.index');
    }



    /**
     * Display the specified resource.
     *
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function show(string $slug)
    {
        $category = config('administrable-shop.models.category')::where('slug', $slug)->firstOrFail();

        return view('administrable-shop::' . Str::lower(config('administrable.back_namespace')) . '.categories.show', compact('category'));
    }



      /**
     * Show the form for editing the specified resource.
     *
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function edit(string $slug)
    {
        $category = config('administrable-shop.models.category')::where('slug', $slug)->firstOrFail();
        $form = $this->getForm($category, config('administrable-shop.forms.back.category'));

        return view('administrable-shop::' . Str::lower(config('administrable.back_namespace')) . '.categories.edit', compact('category', 'form'));
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
        $category = config('administrable-shop.models.category')::where('slug', $slug)->firstOrFail();

        $form = $this->getForm($category, config('administrable-shop.forms.back.category'));
        $form->redirectIfNotValid();

        $category->update($request->all());

        flashy('L\' élément a bien été modifié');

        return redirect_backroute('extensions.shop.category.index');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $slug)
    {
        $category = config('administrable-shop.models.category')::where('slug', $slug)->firstOrFail();

        $category->delete();

        flashy('L\' élément a bien été supprimé');

        return redirect_backroute('extensions.shop.category.index');
    }

}
