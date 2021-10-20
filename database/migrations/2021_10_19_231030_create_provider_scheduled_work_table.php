<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Provider;
use App\Models\ScheduledWork;

class CreateProviderScheduledWorkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_scheduled_work', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(Provider::class, "provider_id");
            $table->foreignIdFor(ScheduledWork::class, "scheduled_work_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('provider_scheduled_work');
    }
}
