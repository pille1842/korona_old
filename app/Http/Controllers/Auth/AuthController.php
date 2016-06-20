<?php

namespace Korona\Http\Controllers\Auth;

use Korona\User;
use Validator;
use Korona\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Controller für Anmeldung & Registrierung
    |--------------------------------------------------------------------------
    |
    | Dieser Controller leitet die Anmeldung (Login), Abmeldung (Logout) und
    | Registrierung von Nutzern, wobei die Registrierung standardmäßig
    | abgeschaltet ist.
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Ziel der Weiterleitung nach der Anmeldung.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Nutzer können sich mit ihrem Namen anmelden.
     *
     * @var string
     */
    public $username = 'username';

    /**
     * Erzeuge eine neue Instanz des Authentication-Controllers.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Erzeuge einen Validator für eine eingehende Registrierungsanfrage.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Erzeuge eine neue Nutzerinstanz nach der erfolgreichen Registrierung
     * (Stub, da die Registrierung abgeschaltet ist).
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        throw new Exception('Registrierung wurde abgeschaltet.');
    }

    /**
     * Überschriebene Methode, um statt des Registrierformulars auf das
     * Anmeldeformular weiterzuleiten.
     *
     * @return Response Weiterleitung nach /login
     */
    public function showRegistrationForm()
    {
        return redirect('login');
    }

    /**
     * Überschriebene Methode zur Registrierung (Stub)
     */
    public function register()
    {
        //
    }

    /**
     * Prüft, ob ein Nutzer aktiv ist, und loggt ihn ansonsten wieder aus
     * @param  Die Anfrage
     * @param  Der eingeloggte Nutzer
     * @return Response
     */
    public function authenticated(Request $request, User $user)
    {
        if ($user->active) {
            return redirect()->intended($this->redirectPath());
        } else {
            $request->session()->flash('error', trans('auth.user_inactive'));
            return $this->logout();
        }
    }
}
