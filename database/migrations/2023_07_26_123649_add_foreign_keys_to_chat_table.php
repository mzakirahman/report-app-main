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
        Schema::table('chat', function (Blueprint $table) {
            $table->foreignId('dosen_id', 'fk_chat_to_dosen')
            ->references('id')->on('dosen')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreignId('kelas_id', 'fk_chat_to_kelas')
            ->references('id')->on('kelas')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreignId('user_id', 'fk_chat_to_users')
            ->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chat', function (Blueprint $table) {
            $table->dropForeign('fk_chat_to_dosen');
            $table->dropForeign('fk_chat_to_kelas');
            $table->dropForeign('fk_chat_to_users');
        });
    }
};
