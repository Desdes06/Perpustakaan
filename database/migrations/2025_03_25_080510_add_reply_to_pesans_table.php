<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('pesans', function (Blueprint $table) {
            $table->text('reply')->nullable()->after('pesan');
        });
    }

    public function down()
    {
        Schema::table('pesans', function (Blueprint $table) {
            $table->dropColumn('reply');
        });
    }
};

