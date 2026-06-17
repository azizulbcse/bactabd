<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('medical_designations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            
            // স্মার্ট স্ট্যাটাস কন্ট্রোল (1 = Active, 0 = Inactive/Deleted)
            $table->tinyInteger('status')->default(1);
            
            // রিয়েল-টাইম ইউজার অ্যাক্টিভিটি ট্র্যাকিং লকস
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medical_designations');
    }
};
