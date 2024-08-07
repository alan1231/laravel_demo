<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlavorsTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('flavors')) {
            Schema::create('flavors', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->text('description')->nullable();
                $table->decimal('price', 10, 2);
                $table->timestamps();
            });
        }
    }
    
    public function down()
    {
        Schema::dropIfExists('flavors');
    }
}