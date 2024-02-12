<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\drivers;
use App\Models\passengers;
use App\Models\Role;
use App\Models\roles;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $roles = roles::all()->except(1);
        return view('auth.register' , compact('roles'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {   

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => 'required',
            'phone' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::slug($request->title) . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images', $imageName);
        }


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'image' => $imageName,
        ]);
        
        $userId = $user->id;

        event(new Registered($user));
        $user->assignRole($request->role);
        Auth::login($user);

        if($request->role == 'driver'){
            $driver = drivers::create([
                'driver_id' => $userId,
            ]);
        }else if($request->role == 'passenger'){
            $passenger = passengers::create([
                'passenger_id' => $userId,
            ]);
        }
        
        return redirect(RouteServiceProvider::HOME);
    }
}
