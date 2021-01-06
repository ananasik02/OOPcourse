<?php

namespace App;
use App\DB\DB;
use App\Repositories\ListRepository;
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';


class Song
{
    public $id;
    public $name;
    public $singer_id;
    public $albom_id;
    public $year;
    public $style_id;
    public $path;
    public $duration;
    public $codec;

    public function __construct(array $data){
        $this->id = isset($data['id']) ? $data['id'] : '';
        $this->name = isset($data['name']) ? $data['name'] : '';
        $this->year = isset($data['year']) ? $data['year'] : '';
        $this->path = isset($data['path']) ? $data['path'] : '';
        $this->duration = isset($data['duration']) ? $data['duration'] : '';
        $this->codec = isset($data['codec']) ? $data['codec'] : '';

        $SongsRep = new ListRepository(DB::getInstance());
        $setSinger=$SongsRep->findSingerLinks(intval($data['singer_id']));
        $setAlbom=$SongsRep->findAlbomsLinks(intval($data['albom_id']));
        $setStyle=$SongsRep->findStylesLinks(intval($data['style_id']));
        $this->singer_id = $setSinger;
        $this->albom_id = $setAlbom;
        $this->style_id = $setStyle;

        return $this;
    }


    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'singer_id' =>$this->singer_id,
            'albom_id' => $this->albom_id,
            'year' => $this->year,
            'style_id' => $this->style_id,
            'path' => $this->path,
            'duration' => $this->duration,
            'codec' => $this->codec
        ];
    }
}