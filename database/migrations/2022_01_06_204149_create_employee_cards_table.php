<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeCardsTable extends Migration
{
    public function up()
    {
        Schema::create('employee_cards', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('national_id');
            $table->string('email');
            $table->string('department_name');
            $table->string('photo');
            $table->string('pdf');
            $table->dateTime('expire_at');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employee_cards');
    }
}
