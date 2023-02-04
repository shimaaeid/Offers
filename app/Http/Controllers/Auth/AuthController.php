<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Hash as FacadesHash;

class AuthController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        return view('auth.registration');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // dd(Hash::make($data['password']), $data['password']);
        // dd(Hash::check($request->password, '$2y$10$NpOf5CUBL3wyFNMinQE21.Tbyj8c/zA0SI68leJLaPzr7O/1FYpYK'));
        // $2y$10$SRpLM.G9P50r2j8mWkipce/pwrS1kem1RIFo2dAP2wQxpaz8fcM0u
        // dd(Auth::check());
        // dd(Auth::guard('web'));
        // dd(Auth::guard('web')->login(User::find(2)));
        // dd(Auth::guard('web')->attempt(['email'=> 'test@gmail.com', 'password'=> '147258369']));

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('You have Successfully loggedin');
        }

        return redirect("/")->withSuccess('Oppes! You have entered invalid credentials');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|numeric',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();

        // dd(Hash::make($data['password']), $data['password']);
        $check = $this->create($data);

        return redirect("dashboard")->withSuccess('Great! You have Successfully loggedin');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard');
        }

        return redirect("login")->withSuccess('Opps! You do not have access');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'phone' => $data['phone'],
        'mac_add' => \exec('getmac'),
        'password' => Hash::make($data['password'])
      ]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout() {
        Session::flush();
        Auth::logout();

        return Redirect('login');
}
}
