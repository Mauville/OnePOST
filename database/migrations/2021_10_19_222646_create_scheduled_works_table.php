<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduledWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scheduled_works', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("URI");
            $table->string("name");
            $table->string("description");
            $table->foreignIdFor(User::class, 'userID');
            $table->dateTime("time_scheduled");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scheduled_works');
    }
}
