<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::factory(1)->create();

        // هاد الكوماند لتنفيذ السيدر للفاكتوري
        //php artisan db:seed --class=AdminSeeder

    }
}
