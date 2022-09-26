<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('promocodes', function (Blueprint $table) {
            $table->string('code', 10)->unique();
            $table->primary('code');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->date('activated_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('promocodes');
    }
};
