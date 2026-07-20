<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('journal_articles', function (Blueprint $table) {
            $table->id();
            // প্যারেন্ট টেবিলের সাথে ওয়ান-টু-ম্যানি রিলেশন লক করার ফরেন কি নোড
            $table->foreignId('bacta_journal_id')->constrained('bacta_journals')->onDelete('cascade');
            
            $table->string('article_title'); // e.g., Editorial, Congenital Surgery Statistics
            $table->string('author_name'); // e.g., Prof. ATM. Khalilur Rahman
            $table->string('pdf_file'); // ১ পেজ বা পুরো ৬০ পেজের ওরিজিনাল পিডিএফ ফাইল পাথ (সিমলিংক মুক্ত)
            $table->string('start_page')->nullable(); // e.g., Page 02
            $table->string('end_page')->nullable();
            $table->integer('status')->default(2); // 2 = Active/Live, 1 = Pending Review
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('journal_articles');
    }
};
