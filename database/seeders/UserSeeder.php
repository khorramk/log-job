<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::factory()->has(Job::factory()->has(Property::factory()))
                ->count(4)
                ->create();

    }
}
