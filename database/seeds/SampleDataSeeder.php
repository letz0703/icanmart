<?php

use App\Box;
use App\Seller;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class SampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        $this->sellers();
        $this->boxes();
        Schema::enableForeignKeyConstraints();
    }
    
    protected function sellers()
    {
        Seller::truncate();
        factory('App\Seller',4)
            ->create();
    }
    
    protected function boxes()
    {
        Box::truncate();
        factory('App\Box', 10)
            ->create();
    }
    
    
}
