<?php

namespace Korona\Http\Controllers;

use Korona\Http\Requests;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Erzeuge eine neue Instanz des Controllers.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Zeige das Korona-Dashboard an.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard');
    }
}
