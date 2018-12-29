<?php

namespace App\Http\Controllers\Auth;

use Eloquent;
use App\User;
use App\Role;
use App\Models\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        if (!Role::count()) {
            return view('errors.error', [
                'title' => 'Migration not completed',
                'message' => 'Please run command <code>php artisan db:seed</code> to generate required table data.',
            ]);
        }

		return User::count() ? view('auth.register') : redirect('login');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // TODO: This is Not Standard. Need to find alternative
        // TODO-WL need remove this trash. Employees? WTF!?
//        Eloquent::unguard();
//
//        $employee = Employee::create([
//            'name' => $data['name'],
//            'designation' => "Super Admin",
//            'mobile' => "8888888888",
//            'mobile2' => "",
//            'email' => $data['email'],
//            'gender' => 'Male',
//            'dept' => "1",
//            'city' => "Pune",
//            'address' => "Karve nagar, Pune 411030",
//            'about' => "About user / biography",
//            'date_birth' => date("Y-m-d"),
//            'date_hire' => date("Y-m-d"),
//            'date_left' => date("Y-m-d"),
//            'salary_cur' => 0,
//        ]);
        
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
//            'context_id' => $employee->id,
//            'type' => "Employee",
        ]);

//        $role = Role::where('name', 'SUPER_ADMIN')->first(); // TODO-WL WTF?

//        $user->attachRole($role);
    
        return $user;
    }
}
