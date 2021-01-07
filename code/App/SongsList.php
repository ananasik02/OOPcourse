<?php


namespace App;
use App\Repositories\AlbomsRepository;
use App\Repositories\ListRepository;
use App\Repositories\UsersRepository;
use App\DB\DB;

class SongsList
{

    public $songRep;
    public $usersRep;
    public $albomsRep;

    public function __construct()
    {
        $this->songRep = new ListRepository(DB::getInstance());
        $this->usersRep = new UsersRepository(DB::getInstance());
        $this->albomsRep = new AlbomsRepository(DB::getInstance());
    }

    public function getAll()
    {
        return $this->songRep->all();
    }

    public function searchBySinger($singer)
    {
        $AllSongs = $this->songRep->all();
        $listOfSongs = array();
        for($i=0; $i<count($AllSongs); $i++){
            if($AllSongs[$i]->singer_id == $singer){
                $listOfSongs [] = $AllSongs[$i];
            }
        }
        return $listOfSongs;
    }

    public function searchBySingerSameStyleAndMaxDuration($singer)
    {
        $Songs = $this->searchBySinger($singer);
        $listOfSongs = array();
        for($i=0; $i<count($Songs); $i++){
            $style = $Songs[$i]->style;
            $maxSong = $this->getTheLongestSong();
            for($j=$i+1; $j<count($Songs); $j++){
                if($Songs[$j]->style == $style && $Songs[$j]->duration == $maxSong->duration){
                    $listOfSongs [] = $Songs[$j];
                }
            }
        }
        return $listOfSongs;
    }

    public function sortBySinger()
    {
        $listOfSongs = $this->songRep->all();
        $d = count($listOfSongs);
        for ($gap = $d / 2; $gap >= 1; $gap = $gap/2)
        {
            for ($j = $gap; $j < $d; $j++)
            {
                for ($i = $j - $gap; $i >= 0; $i = $i-$gap)
                {

                    if ($listOfSongs[$i+$gap]->singer_id > $listOfSongs[$i]->singer_id)
                    {
                        break;

                    }
                    else
                    {
                        $temp = $listOfSongs[$i + $gap];
                        $listOfSongs[$i + $gap] = $listOfSongs[$i];
                        $listOfSongs[$i] = $temp;

                    }

                }

            }

        }

        return $listOfSongs;
    }

    public function searchByCodec($codec)
    {
        $AllSongs = $this->songRep->all();
        $listOfSongs = array();
        for($i=0; $i<count($AllSongs); $i++){
            if($AllSongs[$i]->codec==$codec && $AllSongs[$i]->year > 2011 ){
                $listOfSongs[] = $AllSongs[$i];
            }
        }
        return $listOfSongs;
    }

    public function getTheLongestSong()
    {
        $listOfSongs = $this->songRep->all();
        $d = count($listOfSongs);
        $maxSongTime = $listOfSongs[0]->duration;

        for($i=0; $i<$d; $i++){
            if($listOfSongs[$i]->duration > $maxSongTime){
                $maxSongTime = $listOfSongs[$i]->duration;
                $maxSong = $listOfSongs[$i];
            }
        }

        return $maxSong;
    }

    public function sameStyleAndYear()
    {
        $listOfSongs = $this->songRep->all();
        $d = count($listOfSongs);
        for($i=0; $i<$d; $i++){
            $year = $listOfSongs[$i]->year;
            $codec = $listOfSongs[$i]->codec;
            for($j=$i+1; $j<$d; $j++){
                if($listOfSongs[$j]->year == $year && $listOfSongs[$j]->codec == $codec){
                    $similar [] = $listOfSongs[$j];
                    $similar [] = $listOfSongs[$i];
                }
            }
        }

        return $similar;
    }

    public function AlbomsWithSameSongs()
    {
        $albomsList = $this->albomsRep->all();
        $songs = $this->songRep->all();
        $albom_songs = array();
        for($i=0; $i< count($albomsList); $i++){
            $one_albom_with_songs = array();
            for($j=0; $j<count($songs); $j++){
                if($songs[$j]->albom_id == $albomsList[$i]['name']){
                    $one_albom_with_songs [$j] = $songs[$j]->name;
                }
            }
            $albom_songs [$i] = $one_albom_with_songs;
        }
       // var_dump($albom_songs);
        for($i=0; $i<count($albom_songs); $i++){
            for($j=$i+1; $j<count($albom_songs); $j++){
                $result = array_intersect($albom_songs[$i], $albom_songs[$j]);
                if($result[0] != 0 ){
                    $albom_1 = $i;
                    $albom_2 = $j;
                    break;
                }
            }
            //echo  "Song " . $result[1] . " belongs to both alboms : "  . $albom_1 . " , ".  $albom_2;
        }
        //var_dump($result[1]);
        return $result[1];
    }
}