<?php

use Illuminate\Database\Seeder;
use Korona\User;
use Korona\Member;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        Member::truncate();

        $user           = new User();
        $user->username = 'Ajax';
        $user->password = Hash::make('secret');
        $user->email    = 'ajax@homestead.app';
        $user->handle   = 'ajax';
        $user->active   = true;
        $user->save();

        $member             = new Member();
        $member->firstname  = 'Max';
        $member->lastname   = 'Mustermann';
        $member->nickname   = 'Ajax';
        $member->profession = 'Softwaretester';
        $member->birthday   = Carbon::createFromDate(1991, 12, 18);
        $member->active     = true;
        $user->member()->save($member);

        $user2           = new User();
        $user2->username = 'Sokrates';
        $user2->password = Hash::make('secret');
        $user2->email    = 'sokrates@homestead.app';
        $user2->active   = true;
        $user2->handle   = 'sokrates';
        $user2->save();

        $member2             = new Member();
        $member2->firstname  = 'Michael';
        $member2->lastname   = 'Schmidt';
        $member2->nickname   = 'Sokrates';
        $member2->profession = 'Holzfäller';
        $member2->birthday   = Carbon::createFromDate(1993, 3, 14);
        $member2->active     = true;
        $user2->member()->save($member2);

        $user3           = new User();
        $user3->username = 'Quax';
        $user3->password = Hash::make('secret');
        $user3->email    = 'quax@homestead.app';
        $user3->active   = true;
        $user3->handle   = 'quax';
        $user3->save();

        $member3             = new Member();
        $member3->firstname  = 'Sebastian';
        $member3->lastname   = 'Bruch';
        $member3->nickname   = 'Quax';
        $member3->profession = 'Astronaut';
        $member3->birthday   = Carbon::createFromDate(1997, 1, 31);
        $member3->active     = true;
        $user3->member()->save($member3);
    }
}
