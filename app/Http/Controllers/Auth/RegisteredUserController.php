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
    // $request->validate([
    //     'name' => ['required', 'string', 'max:255'],
    //     'lastname' => ['required', 'string', 'max:255'],
    //     'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
    //     'password' => ['required', 'confirmed', Rules\Password::defaults()],
    // ]);

    $userData = $request->validated();
    $user = User::create([
      'name' => $userData['name'],
      'lastname' => $userData['lastname'],
      'email' => $userData['email'],
      'password' => Hash::make($userData['password']),
    ]);

    event(new Registered($user));
    $form_data = $request->all();
    $new_restaurant = new Restaurant();
    $form_data['slug'] = Helper::generateSlug($form_data['name_restaurant'], Restaurant::class);
    $form_data['user_id'] = $user->id;
    $new_restaurant->fill($form_data);
    $new_restaurant->save();

    if (array_key_exists('typologies', $form_data)) {
      $new_restaurant->typologies()->attach($form_data['typologies']);
    }

    Auth::login($user);

    return redirect(RouteServiceProvider::HOME);
  }
}
