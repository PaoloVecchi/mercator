<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DemoFluxesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('fluxes')->delete();
        
        
        
    }
}