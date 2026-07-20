<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // 🔒 আগে admin panel-এ ঢোকার জন্য শুধু auth (logged-in) চেক করা হতো,
            // status=2 (Approved) থাকা যেকোনো ইউজারই পুরো admin panel-এ full access পেয়ে যেতো।
            // এই কলামটা এখন সেই gap বন্ধ করবে।
            $table->boolean('is_admin')->default(false)->after('status');
        });

        // 🔧 ব্যাকফিল: বর্তমানে যাদের status = 2 (Approved) আছে, তাদের সবাইকে is_admin = true
        // করে দেওয়া হচ্ছে, যাতে এই migration চালানোর পর কোনো বর্তমান স্টাফ/অ্যাডমিন
        // হঠাৎ লক-আউট হয়ে না যান। নতুন migration এর পর থেকে যারা নতুন যোগ হবেন,
        // তাদের is_admin আলাদাভাবে সেট করতে হবে (MemberController@ajaxStore এ এটা
        // আগে থেকেই true করে দেওয়া আছে যেহেতু "Add Staff" ফর্মটা trusted admin-ই ব্যবহার করেন)।
        DB::table('users')->where('status', 2)->update(['is_admin' => true]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_admin');
        });
    }
};
