<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('committee_members', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // ডাক্তারের নাম
            $table->string('member_pic')->nullable(); // ডাইনামিক ছবির পাথ
            $table->integer('sort_order')->default(99); // ১, ২, ৩ দিয়ে ৩-লেয়ার সিরিয়াল কন্ট্রোল
            $table->tinyInteger('status')->default(1); // 1 = Active, 0 = Inactive/Deleted
            
            // ডাইনামিক ৩টি মাস্টার টেবিলের সাথে ফরেন রিলেশনশিপ আইডি লিংক
            $table->foreignId('hospital_id')->constrained('hospitals');
            $table->foreignId('medical_designation_id')->constrained('medical_designations');
            $table->foreignId('bacta_designation_id')->constrained('bacta_designations');

            // ব্যাকএন্ড অডিট ট্র্যাকিং লকস
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('committee_members');
    }
};
