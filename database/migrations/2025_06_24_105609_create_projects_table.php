<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->text('description');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['not_started', 'in_progress', 'on_hold', 'completed', 'cancelled'])->default('not_started');
            $table->enum('type', ['hourly', 'fix_cost'])->nullable()->after('status'); // or after any column
            $table->string('client_name')->nullable(); // or after any column
            $table->string('budget')->nullable();
            $table->softDeletes();
            $table->integer('deleted_by')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
