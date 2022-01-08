<?php

namespace Database\Factories;

use App\Models\HRManager;
use Illuminate\Database\Eloquent\Factories\Factory;

class HRManagerFactory extends Factory
{
  protected $model = HRManager::class;

  public function definition()
  {
    return [
        'name' => $this->faker->name(),
        'email' => 'manager@mail.com',
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
    ];
  }
}
