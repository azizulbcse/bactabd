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
        Schema::table('bacta_journals', function (Blueprint $table) {
            $table->string('publishing_date')->nullable()->after('volume_issue');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bacta_journals', function (Blueprint $table) {
            $table->dropColumn('publishing_date');
        });
    }
};
