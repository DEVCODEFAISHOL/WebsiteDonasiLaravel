<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSedeer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $ownerRole = Role::create([
            "name" => "owner"
        ]);
        //
        $fundraiserRole = Role::create([
            "name" => "fundraiser"
        ]);

        $userOwner = User::create([
            "name"=> "MUHAMMAD FAISHOL WIJANARKO",
            "avatar"=> 'images/default-avatar.png',
            "email"=> "faishol2561@gmail.com",
            "password"=> bcrypt("Faishol0308")
            ]);
            $userOwner->assignRole($ownerRole);
    }
}
