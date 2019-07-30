<?php

use App\Person;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 1)->create()->each(function ($user) {
            for ($i = 0; $i < 50; $i++) {
                $user->persons()->save(factory(Person::class)->make());
            }
        });
    }
}
