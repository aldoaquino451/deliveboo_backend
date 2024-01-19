<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Typology;
use App\Functions\Helper;
use Illuminate\View\View;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Storage;


class RegisteredUserController extends Controller
{

    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $typologies = Typology::all();
        return view('auth.register', compact('typologies'));
    }


    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(UserRequest $request): RedirectResponse
    {

        //Sezione del formn destinata ai dati dell'user
        $user_data = $request->validated();
        $user = User::create([
        'name' => $user_data['name'],
        'lastname' => $user_data['lastname'],
        'email' => $user_data['email'],
        'password' => Hash::make($user_data['password']),
        ]);
        event(new Registered($user));

        //Sezione del formn destinata ai dati del ristorante
        $form_data = $request->all();
        $new_restaurant = new Restaurant();
        $form_data['slug'] = Helper::generateSlug($form_data['name_restaurant'], Restaurant::class);
        $form_data['user_id'] = $user->id;

        //Salvataggio dell'immagine
        if (array_key_exists('image', $form_data)) {
            $form_data['image'] = Storage::put('uploads/restaurants', $form_data['image']);
            $form_data['image_original_name'] = $request->file('image')->getClientOriginalName();
        }
        $new_restaurant->fill($form_data);
        $new_restaurant->save();

        if (array_key_exists('typologies', $form_data)) {
        $new_restaurant->typologies()->attach($form_data['typologies']);
        }

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
    }
