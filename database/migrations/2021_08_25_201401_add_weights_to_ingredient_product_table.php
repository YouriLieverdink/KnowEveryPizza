<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWeightsToIngredientProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ingredient_product', function (Blueprint $table) {
            $table->float('medium')->after('product_id');
            $table->float('italian')->after('medium')->nullable();
            $table->float('large')->after('italian')->nullable();
            $table->float('family')->after('large')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ingredient_product', function (Blueprint $table) {
            $table->dropColumn(['medium', 'italian', 'large', 'family']);
        });
    }
}
