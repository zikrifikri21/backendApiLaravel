<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(Str::uuid());
            $table->string('username');
            $table->string('password');
            $table->string('email')->unique();
            $table->string('token')->nullable();
            $table->tinyInteger('active')->default(0);
            $table->text('profile')->nullable();
            $table->string('remember_token')->nullable();
            $table->text('g_recaptcha_response')->nullable();
            $table->unsignedBigInteger('user_role_id')->default(3);
            $table->foreign('user_role_id')
                ->references('id')
                ->on('user_role')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
