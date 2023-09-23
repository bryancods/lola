<?php
$title = 'Form - ';
$nav_form_class = 'active_page';


$db = init_sqlite_db('db/site.sqlite', 'db/init.sql');

$show_confirmation = False;
$form_valid = True;

define("MAX_FILE_SIZE", 100000000);

$upload_feedback = array(
  'general_error' => False,
  'too_large' => False
);

$upload_file_name = NULL;
$upload_file_ext = NULL;

//form values
$form_values = array(
  'title' => '',
  'release_date' => '',
  'duration' => '',
  'genre' => '',
  'source' => '',
  'spotify_url' => ''

);

//stick values
$sticky_values = array(
  'title' => '',
  'release_date' => '',
  'duration' => '',
  'genre' => '',
  'source' => '',
  'spotify_url' => ''
);

$stay = array(
  'title' => True,
  'release_date' => True,
  'duration' => True,
  'genre' => True,
  'source' => True,
  'spotify_url' => True,
);

const GENRE = array(
  1 => 'Planet Her',
  2 => 'Hot Pink',
  3 => 'Amala',
  4 => 'Hip-Hop',
  5 => 'Pop',
);

if (isset($_POST['submit-button'])) {
  $form_values['title'] = trim($_POST['title']);
  $form_values['release_date'] = trim($_POST['release_date']);
  $form_values['duration'] = trim($_POST['duration']);
  $form_values['genre'] = trim($_POST['genre']);
  $form_values['source'] = trim($_POST['source']);
  $form_values['spotify_url'] = trim($_POST['spotify_url']);

  if ($form_values['title'] == '') {
    $form_valid = False;
    $stay['title'] = False;
  }

  if ($form_values['release_date'] == '') {
    $form_valid = False;
    $stay['release_date'] = False;
  }

  if ($form_values['duration'] == '') {
    $form_valid = False;
    $stay['duration'] = False;
  }

  // if ($form_values['genre'] == '') {
  //   $form_valid = False;
  //   $stay['genre'] = False;
  // }

  if ($form_values['source'] == '') {
    $form_valid = False;
    $stay['source'] = False;
  }

  if ($form_values['spotify_url'] == '') {
    $form_valid = False;
    $stay['spotify_url'] = False;
  }


  $upload = $_FILES['file'];

  if ($upload['error'] == UPLOAD_ERR_OK) {

    $upload_file_name = basename($upload['name']);

    $upload_file_ext = strtolower(pathinfo($upload_file_name, PATHINFO_EXTENSION));

    if (!in_array($upload_file_ext, array('png'))) {
      $upload_valid = False;
      $upload_feedback['general_error'] = True;
    }
  } else if (($upload['error'] == UPLOAD_ERR_INI_SIZE) || ($upload['error'] == UPLOAD_ERR_FORM_SIZE)) {

    $form_valid = False;
    $upload_feedback['too_large'] = True;
  } else {

    $form_valid = False;
    $upload_feedback['general_error'] = True;
  }

  $code = exec_sql_query(
    $db,
    "SELECT
  * FROM albums"
  )->fetchAll();


  if ($form_valid) {
    $tags = array();
    foreach ($code as $genre) {
      if (in_array($genre['id'], $_POST)) {
        array_push($tags, $genre);
      }
    }

    $result = exec_sql_query(
      $db,
      "INSERT INTO songs (title, release_date, duration, genre, source, spotify_url)
    VALUES (:title, :release_date, :duration, :genre, :source, :spotify_url);",
      array(
        ':title' => $form_values['title'], // tainted
        ':release_date' => $form_values['release_date'], // tainted
        ':duration' => $form_values['duration'], // tainted
        // ':genre' => $form_values['genre'], // tainted !!
        ':source' => $form_values['source'], // tainted
        ':spotify_url' => $form_values['spotify_url'], // tainted
      )
    );
    $media_id = $db->lastInsertId('id');

    foreach ($tags as $tag) {
      $result_two = exec_sql_query(
        $db,
        "INSERT INTO songs_on_albums(song_id, album_id) VALUES (:song_id, :album_id)",
        array(
          ':song_id' => $media_id,
          ':album_id' => $tag['id']
        )
      );
    }
    $upload_storage_path = 'public/uploads/songs/' . $media_id . '.' . $upload_file_ext;
    $show_confirmation = True;

    if (move_uploaded_file($upload["tmp_name"], $upload_storage_path) == False) {
      error_log("Failed to permanently store the uploaded file on the file server. Please check that the server folder exists.");
    }
    $show_confirmation = True;
  } else {

    $sticky_values['title'] = $form_values['title'];
    $sticky_values['release_date'] = $form_values['release_date'];
    $sticky_values['duration'] = $form_values['duration'];
    $sticky_values['genre'] = $form_values['genre'];
    $sticky_values['source'] = $form_values['source'];
    $sticky_values['spotify_url'] = $form_values['spotify_url'];
  }
}

$result = exec_sql_query($db, "SELECT
songs.title AS 'title',
songs.release_date AS 'release_date',
songs.duration AS 'duration',
songs.genre AS 'genre',
songs.source AS 'source',
songs.spotify_url AS 'spotify_url',
albums.stats AS 'stats'
FROM songs_on_albums
INNER JOIN songs ON songs.id = songs_on_albums.song_id
INNER JOIN albums ON albums.id = (songs_on_albums.album_id) ORDER BY songs.title ASC;");

$records = $result->fetchAll();


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link rel="stylesheet" type="text/css" href="/public/styles/site.css" media="all">

  <title>Form Page</title>
</head>

<body>
  <?php include 'includes/header.php'; ?>
  <!-- <title><?php echo $title; ?></title> -->
  <?php if (is_user_logged_in() && $is_admin) { ?>

    <?php if ($show_confirmation) { ?>

      <!-- Source:https://www.billboard.com/artist/doja-cat/ -->

      <div class="confirm">
        <section>
          <p>Thank you for trying to add more information to our database. We have received your <strong>New Entry</strong> and have added it to our database.
        </section>
      </div>

    <?php } else { ?>

      <section>
        <div class="text">
          <h2>Add to her Catalog</h2>
          <form method="post" action="/form" method="post" enctype="multipart/form-data" novalidate>
            <div class="form">
              <div class="form-header">
                <p><strong>Fill out this form: </strong></p>
              </div>

              <div class="entry">
                <?php if (!$stay['title']) { ?>
                  <p class="display">*Please provide the title*</p> <?php } ?>
                <div class="add-entry">
                  <label for="title_field">Song title: </label><input id="title_field" type="text" name="title" value="<?php echo $sticky_values['title']; ?>" />
                </div>
              </div>

              <div class="entry">
                <?php if (!$stay['release_date']) { ?>
                  <p class="display">*Please provide the release date*</p> <?php } ?>
                <div class="add-entry">
                  <label for="release_date_field">Release Date: </label><input id="release_date_field" type="number" min="0" value="0" step=".01" name="release_date" value="<?php echo $sticky_values['release_date']; ?>" />
                </div>
              </div>

              <div class="entry">
                <?php if (!$stay['duration']) { ?>
                  <p class="display">*Please provide the Duration*</p> <?php } ?>
                <div class="add-entry">
                  <label for="duration_field">Duration: </label><input id="duration_field" type="number" min="0" value="0" step=".01" name="duration" value="<?php echo $sticky_values['duration']; ?>" />
                </div>
              </div>

              <div class="entry">
                <?php if (!$stay['genre']) { ?>
                  <p class="display">*Please provide the genre*</p>
                <?php } ?>
                <div class="add-entry">
                  <label for="genre_field">Stats: </label>
                  <?php
                  foreach (GENRE as $code => $genre) {
                  ?>
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="<?php echo $code; ?>" value="<?php echo $code; ?>">
                        <?php echo $genre; ?>
                      </label>
                    </div>
                  <?php
                  }
                  ?>
                </div>

                <div class="entry">
                  <?php if (!$stay['source']) { ?>
                    <p class="display">*Please choose source*</p> <?php } ?>
                  <div class="add-entry">
                    <label for="source_field">Source: </label><input id="source_field" type="text" name="source" value="<?php echo $sticky_values['source']; ?>" />
                  </div>
                </div>

                <div class="entry">
                  <?php if (!$stay['spotify_url']) { ?>
                    <p class="display">*Please choose the playlist*</p> <?php } ?>
                  <div class="add-entry">
                    <label for="spotify_url_field">Spotify URL: </label><input id="spotify_url_field" type="text" name="spotify_url" value="<?php echo $sticky_values['spotify_url']; ?>" />
                  </div>
                </div>

                <form method="post" action="/form" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE; ?>">

                  <?php if ($upload_feedback['too_large']) { ?>
                    <p class="display">We're sorry. The file failed to upload because it was too big. Please select a file that&apos;s no larger than 10MB.</p>
                  <?php } ?>

                  <?php if ($upload_feedback['general_error']) { ?>
                    <p class="display">We're sorry. Something went wrong. Please select a PNG file to upload.</p>
                  <?php } ?>

                  <div class="add-entry2">
                    <label for="upload-file">PNG file Upload:</label>
                    <input id="upload-file" type="file" name="file" accept=".png,image/png+xml">
                  </div>

                  <div class="submit-request">
                    <input type="submit" value="submit" name='submit-button' />
                  </div>
              </div>
          </form>
        </div>
      </section>

    <?php } ?>
    </main>
  <?php } else { ?>
    <div class="logo">Please admin login to upload form</div>
  <?php echo login_form('/form', $session_messages);
  } ?>


</body>

</html>
