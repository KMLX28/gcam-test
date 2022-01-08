<?php

use App\Models\CardRequest;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('card_requests', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->enum('status', [CardRequest::$PENDING, CardRequest::$ACCEPTED, CardRequest::$REJECTED]);
            $table->string('name');
            $table->string('national_id');
            $table->string('email');
            $table->string('department_name');
            $table->string('photo');
            $table->foreignId('approved_by_HREmployee')->nullable();
            $table->foreignId('approved_by_HRManager')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('card_requests');
    }
}
