<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan', function (Blueprint $table) {
            $table->id();
            $table->string('agenda')->nullable();
            $table->longText('deskripsi')->nullable();
            $table->longText('tindakan')->nullable();
            $table->longText('lampiran')->nullable();
            $table->enum('status_dosen', [1,2,3,4])->nullable();
            $table->enum('status_kaprodi', [1,2,3,4])->nullable();
            $table->enum('status_kajur', [1,2,3,4])->nullable();
            $table->enum('status_wadir', [1,2,3,4])->nullable();
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
        Schema::dropIfExists('laporan');
    }
};
