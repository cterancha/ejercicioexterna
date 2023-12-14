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
        if (!Schema::hasTable('estado')) {
            Schema::create('estado', function (Blueprint $table) {
                $table->char('idestado',1);
                $table->primary('idestado');
                $table->string('descripcion');
            });

            DB::table('estado')->insert([
                [   
                    'idestado'=>'P', 
                    'descripcion'=>'Pendiente'
                ],
                [   
                    'idestado'=>'R', 
                    'descripcion'=>'Progreso'
                ],
                [   
                    'idestado'=>'C', 
                    'descripcion'=>'Completo'
                ],
            ]);
        }


        if (!Schema::hasTable('tarea')) {
            Schema::create('tarea', function (Blueprint $table) {
                $table->integer('idtarea')->autoIncrement();
                $table->foreignId('iduser')->references('id')->on('users');
                $table->char('idestado',1);
                $table->foreign('idestado')->references('idestado')->on('estado');  
                $table->string('titulo');
                $table->string('descripcion');
                $table->date('fechavencimiento');

            });
        }


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarea');
        Schema::dropIfExists('estado');
    }
};
