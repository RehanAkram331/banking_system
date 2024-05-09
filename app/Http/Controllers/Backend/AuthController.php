<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\AuthRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private $authRepository;


    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function registerCreate()
    {


        return view('auth.registration');

    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);
        $email = $request->email;
        $password = $request->password;
        try {
             $this->authRepository->registerUser($request);
             return redirect()->back()->with('success', 'user create successfully');
        } catch (Exception $e) {
             return redirect()->back()->with('erreor', 'user not create successfully')->with('email',$email)->with('password', $password);
        }
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|string|max:255|',
            'password' => 'required|string|min:8',
        ]);
            $email = $request->email;
            $password = $request->password;
            if ($this->authRepository->checkIfAuthenticated($request)) {
                return redirect()->route('index');
            } else {
                return redirect()->back()->with('error', 'Invalid email or password')->with('email',$email)->with('password', $password);
            }

    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('show-login');

    }

}
