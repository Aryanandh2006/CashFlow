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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
             $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->decimal('amount', 10, 2);
            $table->string('type'); // Will hold 'income' or 'expense'
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->dateTime('date');
            $table->text('note')->nullable();
            $table->timestamps();
           
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::table('transactions', function (Blueprint $table) {
            // Drop the foreign key first before dropping the column
            $table->dropForeign(['category_id']);
            
            $table->dropColumn(['title', 'amount', 'type', 'category_id', 'date', 'note']);
        });
    }
};
