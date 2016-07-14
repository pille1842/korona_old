<?php
/*
 * Korona - A free community management system for German-language fraternities
 * Copyright (C) 2016 Eric Haberstroh <eric@erixpage.de>
 *
 * This file is part of Korona.
 *
 * Korona is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Korona is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Korona.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Korona\Http\Controllers;

use Korona\Http\Requests;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Erzeuge eine neue Instanz des Controllers
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Zeige das Korona-Dashboard an
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard');
    }
}
