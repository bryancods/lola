<?php
$title = 'Albums - ';

const GENRE = array(
  1 => 'Planet Her',
  2 => 'Hot Pink',
  3 => 'Amala',
  4 => 'Hip-Hop',
  5 => 'Pop',
);


$db = init_sqlite_db('db/site.sqlite', 'db/init.sql');

$display = $_GET['id'];

$sql_result_first = exec_sql_query(
  $db,
  "SELECT
songs.id AS 'songs.id',
songs.duration AS 'songs.duration',
songs.spotify_url AS 'songs.spotify_url',
songs.title AS 'songs.title',
songs.release_date AS 'songs.release_date',
songs.source AS 'songs.source',
songs.song_path  AS 'songs.song_path',
songs.song_ext AS 'songs.song_ext'
FROM songs
WHERE songs.id = $display;"
);

$sql_result_second = exec_sql_query($db, "SELECT
albums.stats AS 'albums.stats'
FROM albums
INNER JOIN songs_on_albums
ON (albums.id = songs_on_albums.album_id)
WHERE (songs_on_albums.song_id = $display);");

$records1 = $sql_result_first->fetchAll();
$records2 = $sql_result_second->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link rel="stylesheet" type="text/css" href="/public/styles/site.css" media="all">

  <title>Doja Cat's Success</title>
</head>

<body>
  <?php include 'includes/header.php'; ?>
  <title><?php echo $title; ?> - DOJA CAT's CATALOG</title>

  <main class="homepage">
    <h1>Doja Cat's Catalog</h1>
    <table>
      <tr>
        <th>Title</th>
        <th>Release Date</th>
        <th>Duration</th>
        <th>Source</th>
        <th>Spotify URL</th>
      </tr>
      <?php

      // <!-- Source:https://www.billboard.com/artist/doja-cat/ -->


      foreach ($records1 as $record) {
        $file_url = '/public/uploads/songs/' . $record['songs.id'] . '.' . $record['songs.song_ext'];
      ?>
        <tr>
          <div class="image">
            <a href="/details?<?php echo http_build_query(array('id' => $record['songs.id'])); ?>">
              <img src="<?php echo htmlspecialchars($file_url); ?>" alt="<?php echo htmlspecialchars($record['song_name']); ?>">
            </a>
          </div>
          <td><?php echo htmlspecialchars($record['songs.title']); ?></td>
          <td><?php echo htmlspecialchars($record['songs.release_date']); ?></td>
          <td><?php echo htmlspecialchars($record['songs.duration']); ?></td>
          <td><?php echo htmlspecialchars($record['songs.source']); ?></td>
          <td><a class="music-button" type="button" href="https://open.spotify.com/album/1nAQbHeOWTfQzbOoFrvndW"><?php echo htmlspecialchars($record['songs.spotify_url']); ?>
            </a></td>
        </tr>
      <?php } ?>
    </table>
    <table>
      <th>Stats</th>
      <!-- Source:https://www.billboard.com/artist/doja-cat/ -->
      <?php
      foreach ($records2 as $record) { ?>
        <div class="image">
          <tr>
            <td><?php echo htmlspecialchars(GENRE[$record['albums.stats']]); ?></td>
          </tr>
        </div>
      <?php } ?>
    </table>

</body>

</html>
