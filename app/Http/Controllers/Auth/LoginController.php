<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\RoleUser;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*     |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected function authenticated(Request $request, $user)
    {
        // 'user_role' => $user->roleUser[0]->idrole ?? 'user',
        // 'user_role_name' => $namaRole->nama_role ?? 'User',
        $activeRoleUser = RoleUser::where('iduser', $user->iduser)->where('status', 1)->with('Role')->first();

        $request->session()->put([
            'user_role_id' => $activeRoleUser->idrole_user,
            'role_id' => $activeRoleUser->Role->idrole,
            'role_name' => $activeRoleUser->Role->nama_role
        ]);
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/idashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
