<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Metaboxes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metaboxes', function(Blueprint $table){
            $table->increments('id');

            $table->integer('model_id');
            $table->string('model_type')->nullable();

            $table->string('meta_key')->nullable();
            $table->longtext('meta_value')->nullable();
            $table->tinyInteger('json')->default(0);

            $table->unique(['model_id', 'model_type', 'meta_key']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('metaboxes');
    }
}
