<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('surgery_types', function (Blueprint $table) {
            $table->tinyInteger('status')->default(1)->after('sort_order');
        });
    }

    public function down(): void
    {
        Schema::table('surgery_types', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
