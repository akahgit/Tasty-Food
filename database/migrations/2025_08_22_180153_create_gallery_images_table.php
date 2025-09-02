<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('gallery_images', function (Blueprint $table) {
            $table->id();
            $table->string('image');           // Nama file gambar
            $table->string('caption')->nullable(); // Keterangan (opsional)
            $table->integer('order')->default(0); // Urutan tampil
            $table->boolean('is_featured')->default(false); // Gambar utama
            $table->unsignedBigInteger('uploaded_by'); // Siapa yang upload
            $table->timestamps();

            // Foreign key
            $table->foreign('uploaded_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('gallery_images');
    }
};