<?php


namespace App\Factories;


use App\DB\DB;
use App\Repositories\SingersRepository;

class SingersFactory
{
    public $SingersRep;

    public function __construct()
    {
        $this->SingersRep = new SingersRepository(DB::getInstance());
    }
    public function create($faker, $count)
    {
        for($i=0; $i<$count; $i++){
            $this->SingersRep->create([
                'name' => $faker->name
            ]);
        }
    }
}