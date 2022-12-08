<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory()->count(5)->create();
        foreach ($users as $user) {
            $user->attachRole('user');
        } //end of user factory
        
        //create an initial user
        User::create([
            'name' => 'super admin',
            'email' => 'super_admin@app.com',
            'password' => Hash::make('12345678'),
            'birthdate' => '1919-02-15 00:00:00',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ])->attachRole('super_admin');
    }
}
