<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->morphs('addressable', 'addressable_index');
            $table->string('place_id')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('country')->nullable()->index()->default(__('address.default_country'));
            $table->string('region')->nullable()->default(__('address.default_region'));
            $table->string('zip_code')->nullable()->default('address.default_region');
            $table->string('city')->nullable()->index()->default('address.default_city');
            $table->string('district')->nullable();
            $table->string('street')->index()->nullable();
            $table->string('building')->index()->nullable();
            $table->string('flat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('addresses');
        Schema::enableForeignKeyConstraints();
    }
}
