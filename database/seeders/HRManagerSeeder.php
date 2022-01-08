<?php

namespace Database\Seeders;

use App\Models\HRManager;
use Illuminate\Database\Seeder;

class HRManagerSeeder extends Seeder
{
  public function run()
  {
      HRManager::factory()->create();
  }
}
