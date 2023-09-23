<?php
$title = '';
$nav_home_class = 'active_page';

$db = init_sqlite_db('db/site.sqlite', 'db/init.sql');

const GENRE = array(
  1 => 'Planet Her',
  2 => 'Hot Pink',
  3 => 'Amala',
  4 => 'Hip-Hop',
  5 => 'Pop',
);

$filter = $_GET['stats'];

if (isset($filter)) {
  $result = exec_sql_query($db, "SELECT
    songs.id AS 'id',
    songs.duration AS 'duration',
    songs.spotify_url AS 'spotify_url',
    songs.title AS 'title',
    songs.release_date AS 'release_date',
    songs.source AS 'source',
    songs.song_path  AS 'song_path',
    songs.song_ext AS 'song_ext',
    albums.stats AS 'stats'
    FROM songs_on_albums
    INNER JOIN songs ON (songs.id = songs_on_albums.song_id)
    INNER JOIN albums ON (albums.id = songs_on_albums.album_id)
    WHERE (:stats = albums.stats)", array(":stats" => $filter));
} else {
  $result = exec_sql_query(
    $db,
    "SELECT
  * FROM songs"
  );
}

$records = $result->fetchAll();

$albums = exec_sql_query(
  $db,
  "SELECT
* FROM albums"
);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title><?php echo $title; ?> - DOJA CAT</title>

  <link rel="stylesheet" type="text/css" href="/public/styles/site.css" media="all">
  <title>Globe Gallery</title>
</head>


<body>
  <?php include 'includes/header.php'; ?>


  <h1>Planet Her</h1>

  <div class="heading">
    <p class="first-line">Welcome to Planet Her by Doja Cat. Here, you will find yourself immersed in the world of doja cat</p>
    <p class="second-line">ranging from her music to her craft choosing her cover singles and album. In planet her we want you </p>
    <p class="third-line"> sit back and relax while we take you into a journey of musical fantasies. A good time is promised</p>
  </div>


  <div class="form">
    <div class="form-header2">
      <p><strong>Filter by stats: </strong></p>
    </div>
    <div class="add-entry">
      <div class="add-entry2">
        <?php foreach (GENRE as $albums => $album) {
          $file_url = '/public/uploads/songs/' . $albums['id'] . '.png'; ?>
          <a class="music-button" src="<?php echo htmlspecialchars($file_url); ?>" href="/?<?php echo http_build_query(array('stats' => $albums)); ?>"><?php echo $album; ?></a>
        <?php } ?>
      </div>
    </div>
  </div>


  <div id="pictures">
    <!-- Source:https://www.billboard.com/artist/doja-cat/ -->
    <?php foreach ($records as $record) {
      $file_url = '/public/uploads/songs/' . $record['id'] . '.png';
    ?>
      <div class="image">
        <a href="/details?<?php echo http_build_query(array('id' => $record['id'])); ?>">
          <img src="<?php echo htmlspecialchars($file_url); ?>" alt="<?php echo htmlspecialchars($record['id']); ?>">
          <p><?php echo htmlspecialchars($record['title']); ?></p>
          <cite><a href="https://en.wikipedia.org/wiki/Doja_Cat">Image source</a></cite>
        </a>
      </div>

    <?php } ?>

</body>

</html>
