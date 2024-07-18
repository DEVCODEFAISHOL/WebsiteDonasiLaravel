<?php

    namespace App\Http\Controllers\Auth;

    use App\Http\Controllers\Controller;
    use App\Models\User;
    use Illuminate\Auth\Events\Registered;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Validation\Rules;
    use Illuminate\View\View;
    use RealRashid\SweetAlert\Facades\Alert;


    class RegisteredUserController extends Controller
    {
        /**
         * Display the registration view.
         */
        public function create(): View
        {
            return view('auth.register');
        }

        /**
         * Handle an incoming registration request.
         *
         * @throws \Illuminate\Validation\ValidationException
         */
        public function store(Request $request): RedirectResponse
        {
            try {
                $validated = $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'avatar' => ['required', 'image', 'mimes:png,jpg,jpeg'],
                    'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                    'password' => ['required', 'confirmed', Rules\Password::defaults()],
                ]);
    
                if ($request->hasFile('avatar')) {
                    $file = $request->file('avatar')->store('avatar', 'public');
                    $validated['avatar'] = $file;
                }
    
                $user = User::create([
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'avatar' => $validated['avatar'],
                    'password' => Hash::make($validated['password']),
                ]);
    
                Alert::success('Success register', 'Your account has been successfully created!');
    
                event(new Registered($user));
    
                Auth::login($user);
    
                return redirect(route('dashboard', false));
            } catch (\Exception $e) {
                Alert::error('Registration Failed', 'There was an error creating your account: ' . $e->getMessage());
                return redirect()->back()->withInput();
            }
        }
    }
