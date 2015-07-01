<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Redirect;
use Illuminate\Http\Request;
use Input;
use App\User;
use Validator;
use App\Http\Controllers\SingleFormController;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends SingleFormController
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers;

    protected $redirectTo = '/home';

    /*
    public function authenticate()
    {
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            // Authentication passed...
            return redirect()->intended('home');
        }
    }
     */

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
        parent::__construct();
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function getUpdatePwd()
    {
        return $this->viewMake('auth.update_pwd',
            ['model'=> Auth::user()]);
    }

    public function postUpdatePwd(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed|min:6',
        ]);

        if ($validator->fails()){
            return Redirect::To(action('Auth\AuthController@getUpdatePwd'))
                ->withErrors($validator);
        }

        $user = User::find(Auth::user()->id);
        $user->password = bcrypt(Input::get('password'));
        $user->save();

        return Redirect::to(action("Home\HomeController@getIndex"));
    }

    public function updatePwdValidate($request)
    {

    }
}
