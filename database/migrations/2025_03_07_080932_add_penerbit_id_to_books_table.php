<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('buku', function (Blueprint $table) {
            $table->unsignedBigInteger('penerbit_id')->nullable()->after('id');
            $table->foreign('penerbit_id')->references('id')->on('penerbit')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('buku', function (Blueprint $table) {
            $table->dropForeign(['penerbit_id']);
            $table->dropColumn('penerbit_id');
        });
    }
};
