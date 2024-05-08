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
        Schema::dropIfExists('users');
        if(Schema::hasTable('users'))
        {
            Schema::table('users', function (Blueprint $table) {
                $table->string('lex_PhoneNumber')->unique();
            });
        }else{
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('password');
                $table->string('FullName')->nullable();
                $table->string('ProfileURL')->nullable();
                $table->rememberToken();
                 $table->string('lex_PhoneNumber')->unique();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
