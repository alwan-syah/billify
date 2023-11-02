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
		Schema::create('bills', function (Blueprint $table) {
			$table->id();
			$table->string('description');
			$table->string('slug');
			$table->string('image')->nullable();
			$table->date('paid_date');
			$table->foreignId('type_id')->constrained('bill_type')->onDelete('cascade');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('bills');
	}
};
