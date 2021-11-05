<?php

namespace Guysolamour\Administrable\Extensions\Shop\Http\Controllers\Back;


use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Guysolamour\Administrable\Traits\FormBuilderTrait;
use Guysolamour\Administrable\Http\Controllers\BaseController;

class DeliverController extends BaseController
{
    use FormBuilderTrait;

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $delivers       = config('administrable-shop.models.deliver')::latest()->get();

        return view('administrable-shop::' . Str::lower(config('administrable.back_namespace')) . '.delivers.index', compact('delivers'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = $this->getForm(config('administrable-shop.models.deliver'), config('administrable-shop.forms.back.deliver'));

        $coverage_areas = config('administrable-shop.models.coveragearea')::latest()->get();

        return view('administrable-shop::' . Str::lower(config('administrable.back_namespace')) . '.delivers.create', compact('form', 'coverage_areas'));
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form = $this->getForm(config('administrable-shop.models.deliver'), config('administrable-shop.forms.back.deliver'));
       $form->redirectIfNotValid();

       config('administrable-shop.models.deliver')::create($request->all());

       flashy('L\' élément a bien été ajouté');

        return redirect_backroute(back_route_path('extensions.shop.deliver.index'));
    }





    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show(string $slug)
    {
        $deliver = config('administrable-shop.models.deliver')::where('slug', $slug)->firstOrFail();

        return view('administrable-shop::' . Str::lower(config('administrable.back_namespace')) . '.delivers.show', compact('deliver'));
    }



      /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit(string $slug)
    {
        $deliver        = config('administrable-shop.models.deliver')::where('slug', $slug)->firstOrFail();

        $form           = $this->getForm($deliver, config('administrable-shop.forms.back.deliver'));

        $coverage_areas = config('administrable-shop.models.coveragearea')::latest()->get();

        $deliver->append('area_prices');

        return view('administrable-shop::' . Str::lower(config('administrable.back_namespace')) . '.delivers.edit', compact('deliver', 'form', 'coverage_areas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $slug)
    {
        $deliver = config('administrable-shop.models.deliver')::where('slug', $slug)->firstOrFail();

        $form = $this->getForm($deliver, config('administrable-shop.forms.back.deliver'));
        $form->redirectIfNotValid();

        $deliver->update($request->all());

        flashy('L\' élément a bien été modifié');

        return redirect_backroute('extensions.shop.deliver.index');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $slug)
    {
        $deliver = config('administrable-shop.models.deliver')::where('slug', $slug)->firstOrFail();
        $deliver->delete();

        flashy('L\' élément a bien été supprimé');

        return redirect_backroute('extensions.shop.deliver.index');
    }
}
