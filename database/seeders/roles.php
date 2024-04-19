<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class roles extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['Admin', 'Manager', 'Client'];

        foreach ($roles as $role) {
            \App\Models\Roles::create([
                'name' => $role,
            ]);
        }
    }

}
