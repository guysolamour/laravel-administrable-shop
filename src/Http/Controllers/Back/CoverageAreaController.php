<?php

namespace Guysolamour\Administrable\Extensions\Shop\Http\Controllers\Back;



use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Guysolamour\Administrable\Traits\FormBuilderTrait;
use Guysolamour\Administrable\Http\Controllers\BaseController;

/**
 * CoverageAreaController
 */
class CoverageAreaController extends BaseController
{
    use FormBuilderTrait;

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coverageareas = config('administrable-shop.models.coveragearea')::last()->get();

        return view('administrable-shop::' . Str::lower(config('administrable.back_namespace')) . '.coverageareas.index', compact('coverageareas'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = $this->getForm(config('administrable-shop.models.coveragearea'), config('administrable-shop.forms.back.coveragearea'));

        return view('administrable-shop::' . Str::lower(config('administrable.back_namespace')) . '.coverageareas.create', compact('form'));
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form = $this->getForm(config('administrable-shop.models.coveragearea'), config('administrable-shop.forms.back.coveragearea'));

       $form->redirectIfNotValid();

       $coveragearea = config('administrable-shop.models.coveragearea')::create($request->all());

       if ($request->ajax()){
           return $coveragearea;
       }

       flashy('L\' élément a bien été ajouté');


        return redirect_backroute('extensions.shop.coveragearea.index');
    }





    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show(string $slug)
    {
        $coveragearea = config('administrable-shop.models.coveragearea')::where('slug', $slug)->firstOrFail();

        return view('administrable-shop::' . Str::lower(config('administrable.back_namespace')) . '.coverageareas.show', compact('coveragearea'));
    }



      /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit(string $slug)
    {
        $coveragearea = config('administrable-shop.models.coveragearea')::where('slug', $slug)->firstOrFail();

        $form = $this->getForm($coveragearea, config('administrable-shop.forms.back.coveragearea'));

        return view('administrable-shop::' . Str::lower(config('administrable.back_namespace')) . '.coverageareas.edit', compact('coveragearea', 'form'));
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
        $coveragearea = config('administrable-shop.models.coveragearea')::where('slug', $slug)->firstOrFail();

        $form = $this->getForm($coveragearea, config('administrable-shop.forms.back.coveragearea'));
        $form->redirectIfNotValid();

        $coveragearea->update($request->all());

        flashy('L\' élément a bien été modifié');

        return redirect_backroute('extensions.shop.coveragearea.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $slug)
    {
        $coveragearea = config('administrable-shop.models.coveragearea')::where('slug', $slug)->firstOrFail();
        $coveragearea->delete();

        flashy('L\' élément a bien été supprimé');

        return redirect_backroute('extensions.shop.coveragearea.index');
    }
}
