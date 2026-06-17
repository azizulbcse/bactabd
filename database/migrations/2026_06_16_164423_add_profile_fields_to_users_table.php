<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Route::middleware('auth')->group(function () {
        Schema::table('users', function (Blueprint $table) {
            $table->string('mobile_no')->nullable()->after('email');
            $table->string('profile_pic')->nullable()->after('mobile_no');
        });
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['mobile_no', 'profile_pic']);
    });
}

};
