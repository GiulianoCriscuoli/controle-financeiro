<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('financial_transactions', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['receber', 'pagar']);
            $table->foreignId('type_account_id')
                ->constrained('type_accounts')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->string('description');
            $table->decimal('amount', 12, 2);
            $table->date('issue_date');
            $table->date('due_date');
            $table->string('status')->default('pendente');
            $table->date('settlement_date')->nullable();
            $table->timestamps();

            $table->index(['type', 'status']);
            $table->index('issue_date');
            $table->index('due_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('financial_transactions');
    }
};
