<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->text('description');

            $table->tinyInteger('flag')->nullable()->index();

            $table->boolean('completed')->index();

            $table->dateTime('reminder')->nullable();

            $table->foreignId('allocated_to')->nullable()->constrained('users')->index()->name('tasks_allocated_to_foreign');

            $table->foreignId('created_by')->nullable()->constrained('users')->index()->name('tasks_created_by_foreign');

            $table->foreignId('updated_by')->nullable()->constrained('users')->index()->name('tasks_updated_by_foreign');

            $table->dateTime('reminded_at')->nullable()->index();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
