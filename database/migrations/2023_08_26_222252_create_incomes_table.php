<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\IncomeCategoryEnum;


return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->decimal('amount', 10, 2);

            $table->enum(
                'category',
                [
                    IncomeCategoryEnum::SALARY,
                    IncomeCategoryEnum::SALES,
                    IncomeCategoryEnum::ETC,
                ]
            );

            $table->text('description')->nullable();
            $table->timestamp('created_at')->nullable();


            $table->foreign('user_id')->references('chat_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incomes');
    }
};