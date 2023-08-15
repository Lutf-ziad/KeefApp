<?php

use App\Enums\PromotionType;
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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('title')->nullable();
            $table->datetime('from')->useCurrent();
            $table->datetime('to')->nullable();
            $table->enum('type', PromotionType::values())->default(PromotionType::QUANTITATIVE->value);
            $table->float('amount')->default(0);
            $table->integer('valid_number')->nullable();
            $table->boolean('active')->default(1);
            $table->foreignId('package_id')->nullable()->constrained()->cascadeOnDelete();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
