<?php

namespace Database\Seeders;

use App\Models\HREmployee;
use Illuminate\Database\Seeder;

class HREmployeeSeeder extends Seeder
{
  public function run()
  {
    HREmployee::factory()->create();
  }
}
