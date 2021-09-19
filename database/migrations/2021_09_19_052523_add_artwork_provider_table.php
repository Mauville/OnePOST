<?php

use App\Models\Artwork;
use App\Models\Provider;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddArtworkProviderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artwork_provider', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(Artwork::class, "artwork_id");
            $table->foreignIdFor(Provider::class, "provider_id");
        });
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artwork_provider');
    }
}
