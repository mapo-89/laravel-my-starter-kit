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
        Schema::create('contract_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contract_id')
                ->constrained('contracts')
                ->cascadeOnDelete();

            $table->string('product');
            $table->string('sku')->unique(); 
            $table->decimal('price', 12, 2)->default(0);
            $table->decimal('purchase_price', 12, 2)->nullable();
            $table->unsignedInteger('minimum_quantity')->nullable();
            $table->string('billing_cycle');  
            $table->string('billing_month')->nullable(); // MVP: String (z.B. "Januar" oder "2026-01")
            $table->date('end_transfer')->nullable();
            $table->string('order_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contract_items');
    }
};
