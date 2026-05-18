<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller; // 1. PASTIKAN INI ADA
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller // 2. HARUS EXTENDS KE Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | Controller ini menangani autentikasi pengguna untuk aplikasi dan
    | mengarahkan mereka ke layar beranda. Controller ini menggunakan trait
    | untuk menyediakan fungsionalitasnya tanpa memerlukan banyak kode.
    |
    */

    use AuthenticatesUsers;

    /**
     * Ke mana pengguna harus diarahkan setelah login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Membuat instance controller baru.
     *
     * @return void
     */
    public function __construct()
    {
        // Fungsi middleware() ini berasal dari class Controller induk
        $this->middleware('guest')->except('logout');
    }
}