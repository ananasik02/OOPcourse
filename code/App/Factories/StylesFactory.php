<?php


namespace App\Factories;


use App\DB\DB;
use App\Repositories\StylesRepository;

class StylesFactory
{
    public $StylesRep;

    public function __construct()
    {
        $this->StylesRep = new StylesRepository(DB::getInstance());
    }
    public function create($faker, $count)
    {
        for($i=0; $i<$count; $i++){
            $this->StylesRep->create([
                'name' => $faker->word
            ]);
        }
    }
}