<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreatePostalCode extends Migration
{
    public function up(): void
    {
        Schema::create('postal_code', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('village_id');
            $table->string('postal_code');
            $table->datetimes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('postal_code');
    }
}
