<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class LoginSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->create([
            "name"=>"koto",
            "email"=>"admin@skilljapan.info",
            "password"=>Hash::make("gorin")
        ]);
    }
}
