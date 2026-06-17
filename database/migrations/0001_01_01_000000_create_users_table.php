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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            
            // --- BACTA Doctors Profile Registration Fields ---
            $table->string('bmdc_reg_no')->unique()->nullable(); // BMDC নম্বর (মেডিকেল আইডি)
            $table->string('designation')->nullable();          // পদবি 
            $table->string('member_type')->nullable();          // Lifetime নাকি General Member
            
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            
            // --- International Standard Security Status & Admin Tracking Fields ---
            // status: 1 = Pending (Default), 2 = Approved, 0 = Deleted/Blocked
            $table->tinyInteger('status')->default(1)->comment('1=Pending, 2=Approved, 0=Deleted'); 
            
            $table->unsignedBigInteger('approved_by')->nullable(); // যে অ্যাডমিন এপ্রুভ করল তার আইডি
            $table->timestamp('approved_at')->nullable();          // কখন এপ্রুভ করা হলো (টাইমস্ট্যাম্প)
            $table->unsignedBigInteger('updated_by')->nullable();  // সর্বশেষ মডিফাই করা অ্যাডমিনের আইডি
            
            $table->rememberToken();
            $table->timestamps();

            // --- Foreign Key Constraints (অ্যাডমিন ট্র্যাকিং রিলেশন লক করা) ---
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
