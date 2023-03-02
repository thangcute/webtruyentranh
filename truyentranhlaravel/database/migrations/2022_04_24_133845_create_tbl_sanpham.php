<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_sanpham', function (Blueprint $table) {
            $table->Increments('sanpham_id');
            $table->integer('category_id');
            $table->integer('author_id');
            $table->integer('pbcompany_id');
            $table->string('sanpham_name');
            $table->text('sanpham_desc');
            $table->text('sanpham_content');
            $table->string('sanpham_price');
            $table->string('sanpham_image');
            $table->string('sanpham_pbyear');
            $table->integer('sanpham_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_sanpham');
    }
};
