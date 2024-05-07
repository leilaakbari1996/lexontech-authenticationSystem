<?php

namespace Lexontech\AuthenticationSystem\database\seeders\AuthenticationSystem;

use Illuminate\Database\Seeder;
use Lexontech\Root\app\Models\RootAttributes;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RootAttributes::create([
            'Name'   => 'authentication-system',
            'Status' => true
        ]);
    }
}
