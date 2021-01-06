<?php


namespace App\Factories;


use App\DB\DB;
use App\Repositories\AlbomsRepository;

class AlbomsFactory
{
    public $AlbomsRep;

    public function __construct()
    {
        $this->AlbomsRep = new AlbomsRepository(DB::getInstance());
    }
    public function create($faker, $count)
    {
        for($i=0; $i<$count; $i++){
            $this->AlbomsRep->create([
                'singer_id' => 1,
                'name' => $faker->word
            ]);
        }
    }
}