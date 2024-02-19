<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateProvinces extends Migration
{
    public function up(): void
    {
        Schema::create('provinces', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('province_name');
            $table->datetimes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('provinces');
    }
}
