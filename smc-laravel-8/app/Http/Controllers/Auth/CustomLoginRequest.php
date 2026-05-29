<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class CustomLoginRequest extends LoginRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate()
    {
        $this->ensureIsNotRateLimited();

        //Login using MD5 Joomla username and password

        //TODO ADD ENV VAR for JOOMLA database server connection, and table
        $user = DB::connection('joomla')->table('jos_users')->select('id','email','password')
            ->where('email', $this->email)
            //may need to be md5($this->password . env('FINAO_LEGACY_SALT'))
            ->where('block', '=','0')
            ->where('activation', '=' ,'')
            ->first();
        //->where('password',md5($this->password))
        //password_verify


        //Check if user is found and password is good
        $authenticated = false;
        if(isset($user->id)) {
            // check password hash
            if(isset($user->password)) {
                //Check for HASHING type.
                if ($user->password[0] === "$") {
                    $authenticated = password_verify($this->password, $user->password);
                }
                else {
                    //legacy HASH type.
                    if (md5($this->password) === $user->password) {
                        //USER found manually log in user
                        $authenticated = true;
                    }
                }
            }

            //Check if password was correct
            if($authenticated === true){
                //Attempt to login
                if (! Auth::loginUsingId($user->id,
                    //TODO fix jos_users doesnt have remember me field, so default to false for now
                    //$this->boolean('remember')
                    false
                )) {
                    RateLimiter::hit($this->throttleKey());

                    throw ValidationException::withMessages([
                        'email' => __('auth.failed'),
                    ]);
                }
            } else {
                //BAD PASSWORD
                throw ValidationException::withMessages([
                    'email' => __('auth.failed'),
                ]);
            }
        } else {

            //BAD EMAIL
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        //Clear rate limiter
        RateLimiter::clear($this->throttleKey());
    }

}
