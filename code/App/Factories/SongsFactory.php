<?php


namespace App\Factories;


use App\DB\DB;
use App\Repositories\ListRepository;
use App\Repositories\SingersRepository;
use App\Repositories\AlbomsRepository;
use App\Factories\StylesFactory;
use App\Repositories\StylesRepository;

class SongsFactory
{
    public $SongsRep;
    public $SingRep;
    public $StylesRep;
    public $AlbomsRep;

    public function __construct()
    {
        $this->SongsRep = new ListRepository(DB::getInstance());
        $this->SingRep = new SingersRepository(DB::getInstance());
        $this->StylesRep = new StylesRepository(DB::getInstance());
        $this->AlbomsRep = new AlbomsRepository(DB::getInstance());
    }

    public function create($faker, $count)
    {
        for($i=0; $i<$count; $i++){
            $this->SongsRep->create([
                'name' => $faker->word,
                'singer_id' => rand(1, count($this->SingRep->all())),
                'albom_id' => rand(1, count($this->AlbomsRep->all())),
                'year' => $faker->year,
                'style_id' => rand(1, count($this->StylesRep->all())),
                'path' => '/' . $faker->word . '/' . $faker->word,
                'duration' => $faker->time,
                'codec' => $faker->word
            ]);
        }
    }

}