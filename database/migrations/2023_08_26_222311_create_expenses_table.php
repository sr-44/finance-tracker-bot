<?php

use App\Enums\ExpenseCategoryEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->decimal('amount', 10, 2);

            $table->enum('category', [
                ExpenseCategoryEnum::FOOD,
                ExpenseCategoryEnum::TRANSPORT,
                ExpenseCategoryEnum::EDUCATION,
                ExpenseCategoryEnum::GIFTS,
                ExpenseCategoryEnum::ELECTRONICS,
                ExpenseCategoryEnum::HEALTH,
                ExpenseCategoryEnum::HOUSING,
                ExpenseCategoryEnum::TRAVEL,
                ExpenseCategoryEnum::HOBBIES,
                ExpenseCategoryEnum::ETC,
            ]);


            $table->string('description', 50)->nullable();
            $table->timestamp('created_at')->nullable();


            $table->foreign('user_id')->references('chat_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
