<?php

use App\Models\Postulante;
use Illuminate\Database\Seeder;

class PostulanteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
   	    factory(Postulante::class,2)->create();
    }
}
