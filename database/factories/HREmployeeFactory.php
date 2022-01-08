<?php

namespace Database\Factories;

use App\Models\HREmployee;
use Illuminate\Database\Eloquent\Factories\Factory;

class HREmployeeFactory extends Factory
{
  protected $model = HREmployee::class;

  public function definition()
  {
    return [
        'name' => $this->faker->name(),
        'email' => 'employee@mail.com',
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
    ];
  }
}
