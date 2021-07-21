<?php

use App\Models\Topnavitem;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menuitems', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Topnavitem::class, 'topnavitem_id');
            $table->string('name')->unique();
            $table->string('uri')->index()->default('#');
            $table->unsignedInteger('position')->nullable()->default(0)->index();
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
        Schema::dropIfExists('menuitems');
        Schema::enableForeignKeyConstraints();
    }
}
