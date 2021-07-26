<?php

use App\Models\Menuitem;
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
            $table->foreignIdFor(Menuitem::class, 'toplevel_id')->default(0);
            $table->text('name');
            $table->string('route_name')->default('about')->unique();
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
