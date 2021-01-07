<?php
session_start();
use App\SongsList;
use App\Factories\SongsFactory;
use App\Factories\StylesFactory;
use App\Factories\SingersFactory;
use App\Factories\AlbomsFactory;

$sngList = new SongsList();

$pageName ='App/Actions/list.php';
$userLogin = $_SESSION['user_login'];

if (isset($_GET['action'])){
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    if ($action == 'sort-by-singer') {
        $listOfSongs = $sngList->sortBySinger();
    }
}

if (isset($_GET['action'])){
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    if ($action == 'sort-by-path') {
        $listOfSongs = $sngList->sortByPath();
    }
}

if (isset($_GET['action'])){
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    if ($action == 'search-by-singer') {
        //$listOfSongs = $sngList->searchBySinger($_POST['singer']);
        $listOfSongs = $sngList->searchBySingerSameStyleAndMaxDuration($_POST['singer']);
    }
}


if (isset($_GET['action'])){
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    if ($action == 'search-by-сodec') {
        $listOfSongs = $sngList->searchByCodec($_POST['codec']);
    }
}

if (isset($_GET['action'])){
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    if ($action == 'enter-user') {
        $faker = Faker\Factory::create();

        $stlFactory = new StylesFactory();
        $stlFactory->create($faker, 7);

        $singFactory = new SingersFactory();
        $singFactory->create($faker, 7);

        $albmFactory = new AlbomsFactory();
        $albmFactory->create($faker, 7);

        $sngFactory = new SongsFactory();
        $sngFactory->create($faker,70);


        $listOfSongs = $sngList->getAll();

        $similar = $sngList->sameStyleAndYear();

        $maxSong = $sngList->getTheLongestSong();

        $sameSongInAlboms = $sngList->AlbomsWithSameSongs();

    }
}


include $_SERVER['DOCUMENT_ROOT'] .  '/partials/view_songslist.php';



