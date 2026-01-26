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
        Schema::table('orders', function (Blueprint $table) {
            // Lokasi pemesan (Tribun, Meja, dll)
            $table->string('location')->nullable()->after('customer_phone');

            // Kategori: Santri, Walsan, Guru
            $table->enum('customer_category', ['santri', 'walsan', 'guru'])->default('santri')->after('location');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['location', 'customer_category']);
        });
    }
};
