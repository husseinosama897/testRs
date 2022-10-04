<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\advertising;
use DB;
class AdvertisingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];

for($i=0; $i<=50; $i++){
$data []= [
        'name'=>'advertising_'.''.rand(1,50000),
        'from'=>date('Y-m-d'),
        'to'=>date('Y-m-d'),
         'total'=>rand(1,50000),
           'daily_budget'=>rand(1,50000),

];


$chunking_data = array_chunk($data, 3);
if(!empty($chunking_data)){
    foreach($chunking_data as $chunk){
        advertising::insert($chunk);
    }
       }

}
    }
}
