<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tb_transaction', function (Blueprint $table) {
            $table->string('buyerName')->after('id_trasaction');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_transaction', function (Blueprint $table) {
            $table->dropColumn('buyerName');
        });
    }
};
