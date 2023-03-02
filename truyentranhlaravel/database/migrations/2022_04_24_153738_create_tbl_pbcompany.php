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
        Schema::create('tbl_pbcompany', function (Blueprint $table) {
            $table->Increments('pbcompany_id');
            $table->string('pbcompany_name');
            $table->string('pbcompany_adress');
            $table->string('pbcompany_sdt');
            $table->text('pbcompany_desc');
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
        Schema::dropIfExists('tbl_pbcompany');
    }
};
