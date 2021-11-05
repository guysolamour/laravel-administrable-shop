<?php

namespace Guysolamour\Administrable\Extensions\Shop\Http\Controllers\Back;



use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Guysolamour\Administrable\Traits\FormBuilderTrait;
use Guysolamour\Administrable\Http\Controllers\BaseController;

class CouponController extends BaseController
{
    use FormBuilderTrait;

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = config('administrable-shop.models.coupon')::latest()->get();

        return view('administrable-shop::' . Str::lower(config('administrable.back_namespace')) . '.coupons.index', compact('coupons'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $coupon = new (config('administrable-shop.models.coupon'));
        $form = $this->getForm(config('administrable-shop.models.coupon'), config('administrable-shop.forms.back.coupon'));

        return view('administrable-shop::' . Str::lower(config('administrable.back_namespace')) . '.coupons.create', compact('form'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form = $this->getForm(config('administrable-shop.models.coupon'), config('administrable-shop.forms.back.coupon'));
       $form->redirectIfNotValid();

       config('administrable-shop.models.coupon')::create($request->all());

       flashy('L\' élément a bien été ajouté');

       return redirect_backroute('extensions.shop.coupon.index');
    }





    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $coupon = config('administrable-shop.models.coupon')::where('id', $id)->firstOrFail();

        return view('administrable-shop::' . Str::lower(config('administrable.back_namespace')) . '.coupons.show', compact('coupon'));
    }



      /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $coupon = config('administrable-shop.models.coupon')::where('id', $id)->firstOrFail();
        $form = $this->getForm($coupon, config('administrable-shop.forms.back.coupon'));

        return view('administrable-shop::' . Str::lower(config('administrable.back_namespace')) . '.coupons.edit', compact('coupon', 'form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $coupon = config('administrable-shop.models.coupon')::where('id', $id)->firstOrFail();

        $form = $this->getForm($coupon, config('administrable-shop.forms.back.coupon'));
        $form->redirectIfNotValid();

        $coupon->update($request->all());

        flashy('L\' élément a bien été modifié');

        return redirect_backroute('extensions.shop.coupon.index');
    }





    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $coupon = config('administrable-shop.models.coupon')::where('id', $id)->firstOrFail();
        $coupon->delete();

        flashy('L\' élément a bien été supprimé');

        return redirect_backroute('extensions.shop.coupon.index');
    }


}
