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
        Schema::create('companies',function (Blueprint $table){
            $table->id();
            $table->string('company_name',200);
            $table->timestamps();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('name','full_name');
            $table->float('money');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
        Schema::create('stocks',function (Blueprint $table){
            $table->id();
            $table->string('company');
            $table->string('company_eng',20);
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
        Schema::create('stock_user',function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('stock_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('count')->default(0);
            $table->float('wasted')->default(0);
            $table->foreign('stock_id')->references('id')->on('stocks')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        Schema::create('date_prices',function (Blueprint $table){
            $table->id();
            $table->date('date');
            $table->float('prices');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tables');
    }
};
