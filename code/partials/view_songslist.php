<?php require 'header.php';

use App\Repositories\ListRepository;
?>
<div class="container">
    <p>
    <form style="display: inline-block" action="?action=create-task" method="post">
        <button class= "btn btn-success">Create Song</button>
    </form>
    <form style="display: inline-block" action="?action=sort-by-singer" method="post">
        <button class= "btn btn-success">Sort by singer</button>
    </form>
    <form style="display: inline-block" action="?action=search-by-singer" method="post">
        <input class="form-control" placeholder="Enter singer" id="singer" name="singer" required>
        <button class= "btn btn-success">Search by singer</button>
    </form>
    <form style="display: inline-block" action="?action=search-by-сodec" method="post">
        <input class="form-control" placeholder="Enter codec" id="codec" name="codec" required>
        <button class= "btn btn-success">Search by codec</button>
    </form>
    </p>
    <table class="table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Singer</th>
            <th>Albom</th>
            <th>Year</th>
            <th>Style</th>
            <th>Path</th>
            <th>Duration</th>
            <th>Codec</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($listOfSongs as $item) : ?>
                <tr>
                    <td><?php echo $item->id ?></td>
                    <td><?php echo $item->name ?></td>
                    <td><?php echo $item->singer_id ?></td>
                    <td><?php echo $item->albom_id ?></td>
                    <td><?php echo $item->year ?></td>
                    <td><?php echo $item->style_id ?></td>
                    <td><?php echo $item->path ?></td>
                    <td><?php echo $item->duration ?></td>
                    <td><?php echo $item->codec ?></td>
                </tr>
        <?php endforeach; ?>

        </tbody>
    </table>

    <?php if(isset($similar)) : ?>
        <p>These songs have the same year and codec</p>
        <table class="table">
        <?php foreach ($similar as $item) : ?>
            <tr>
                <td><?php echo $item->id ?></td>
                <td><?php echo $item->name ?></td>
                <td><?php echo $item->singer_id ?></td>
                <td><?php echo $item->albom_id ?></td>
                <td><?php echo $item->year ?></td>
                <td><?php echo $item->style_id ?></td>
                <td><?php echo $item->path ?></td>
                <td><?php echo $item->duration ?></td>
                <td><?php echo $item->codec ?></td>
            </tr>
        <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <?php if(isset($maxSong)) : ?>
    <p>The max length of song</p>
    <table class="table">
        <tr>
            <td><?php echo $maxSong->id ?></td>
            <td><?php echo $maxSong->name ?></td>
            <td><?php echo $maxSong->singer_id ?></td>
            <td><?php echo $maxSong->albom_id ?></td>
            <td><?php echo $maxSong->year ?></td>
            <td><?php echo $maxSong->style_id ?></td>
            <td><?php echo $maxSong->path ?></td>
            <td><?php echo $maxSong->duration ?></td>
            <td><?php echo $maxSong->codec ?></td>
        </tr>
    </table>
    <?php endif; ?>

    <p>
        This song belongs to more that 1 albom <?= $sameSongInAlboms ?>
    </p>

</div>

<?php


?>

<?php require 'footer.php' ?>