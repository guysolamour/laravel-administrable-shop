<?php

namespace Guysolamour\Administrable\Extensions\Shop\Http\Controllers\Back;


use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Guysolamour\Administrable\Traits\FormBuilderTrait;
use Guysolamour\Administrable\Http\Controllers\BaseController;


class ClientController extends BaseController
{
    use FormBuilderTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->with('orders')->get();

        return view('administrable-shop::' . Str::lower(config('administrable.back_namespace')) . '.clients.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = $this->getForm(new User, config('administrable-shop.forms.back.client'));

        return view('administrable-shop::' . Str::lower(config('administrable.back_namespace')) . '.clients.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form = $this->getForm(new User, config('administrable-shop.forms.back.client'));

        $form->redirectIfNotValid();

        User::create([
            'name'              => $request->get('name'),
            'pseudo'            => $request->get('pseudo'),
            'email'             => $request->get('email'),
            'email_verified_at' => now(),
            'remember_token'    => Str::random(10),
        ]);

        flashy('L\' utilisateur a bien été ajouté');

        return redirect_backroute('extensions.shop.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('administrable-shop::' . Str::lower(config('administrable.back_namespace')) . '.clients.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $form = $this->getForm($user, $user->form);

        return view('administrable-shop::' . Str::lower(config('administrable.back_namespace')) . '.clients.edit', compact('form', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $form = $this->getForm($user, config('administrable-shop.forms.back.client'));

        $form->redirectIfNotValid();

        $user->update([
            'name'              => $request->get('name'),
            'pseudo'            => $request->get('pseudo'),
            'email'             => $request->get('email'),
        ]);

        flashy('L\' utilisateur a bien été modifié');

        return redirect_backroute('extensions.shop.user.index');
    }



    /**
     * @param Request $request
     * @param User $user
     */
    public function changePassword(Request $request, User  $user)
    {
        $validator = Validator::make($request->all(), [
            'password'              => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            flashy()->error('Erreur lors de la modification des mots de passe.');
            return back()->withErrors($validator)->withInput();
        }

        // update password
        $user->update([
            'password' => bcrypt($request->input('password'))
        ]);

        flashy('Votre mot de passe a été mis à jour');

        return redirect_backroute('extensions.shop.user.index');
    }
}
