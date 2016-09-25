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


namespace Korona\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'Korona\Model' => 'Korona\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $gate->define('ltm-admin-translations', function ($user) {
            /* @var $user \App\User */
            return $user;
        });

        $gate->define('ltm-bypass-lottery', function ($user) {
            /* @var $user \App\User */
            return $user;
        });

        $gate->define('ltm-list-editors', function ($user, $connection_name, &$user_list) {
            /* @var $user \App\User */
            /* @var $connection_name string */
            /* @var $query  \Illuminate\Database\Query\Builder */
            $query = $user->on($connection_name)->getQuery();

            // modify the query to return only users that can edit translations and can be managed by $user
            // if you have a an editor scope defined on your user model you can use it to filter only translation editors
            //$user_list = $user->scopeEditors($query)->orderby('id')->get(['id', 'email', 'name']);
            $user_list = $query->orderby('id')->get(['id', 'email']);

            // if the returned list is empty then no per locale admin will be shown for the current user.
            return $user_list;
        });

        $this->registerPolicies($gate);
    }
}
