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
        $user->username = 'Test1';
        $user->password = Hash::make('test1');
        $user->email    = 'test1@homestead.app';
        $user->active   = true;
        $user->save();

        $member             = new Member();
        $member->firstname  = 'Testnutzer';
        $member->lastname   = 'Eins';
        $member->nickname   = 'Testus';
        $member->profession = 'Softwaretester';
        $member->birthday   = Carbon::createFromDate(1991, 12, 18);
        $member->active     = true;
        $user->member()->save($member);

        $user2           = new User();
        $user2->username = 'Test2';
        $user2->password = Hash::make('test2');
        $user2->email    = 'test2@homestead.app';
        $user2->active   = true;
        $user2->save();

        $member2             = new Member();
        $member2->firstname  = 'Testnutzer';
        $member2->lastname   = 'Zwei';
        $member2->nickname   = 'Testus II.';
        $member2->profession = 'Holzfäller';
        $member2->birthday   = Carbon::createFromDate(1993, 3, 14);
        $member2->active     = true;
        $user2->member()->save($member2);

        $user3           = new User();
        $user3->username = 'Test3';
        $user3->password = Hash::make('test3');
        $user3->email    = 'test3@homestead.app';
        $user3->active   = true;
        $user3->save();

        $member3             = new Member();
        $member3->firstname  = 'Testnutzer';
        $member3->lastname   = 'Drei';
        $member3->nickname   = 'Testus III.';
        $member3->profession = 'Astronaut';
        $member3->birthday   = Carbon::createFromDate(1997, 1, 31);
        $member3->active     = true;
        $user3->member()->save($member3);
    }
}
