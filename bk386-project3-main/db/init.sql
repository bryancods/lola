CREATE TABLE users (
  id INTEGER NOT NULL UNIQUE,
  name TEXT NOT NULL,
  email TEXT NOT NULL,
  username TEXT NOT NULL UNIQUE,
  password TEXT NOT NULL,
  PRIMARY KEY(id AUTOINCREMENT)
);

INSERT INTO
  users (id, name, email, username, password)
VALUES
  (
    1,
    'Kongnyu',
    'bryan.kongnyu@cornell.edu',
    'bryan',
    '$2y$10$QtCybkpkzh7x5VN11APHned4J8fu78.eFXlyAMmahuAaNcbwZ7FH.' -- monkey
  );

INSERT INTO
  users (id, name, email, username, password)
VALUES
  (
    2,
    'Kevin Jaigua',
    'kevin@example.com',
    'kevin',
    '$2y$10$QtCybkpkzh7x5VN11APHned4J8fu78.eFXlyAMmahuAaNcbwZ7FH.' -- monkey
  );

CREATE TABLE sessions (
  id INTEGER NOT NULL UNIQUE,
  user_id INTEGER NOT NULL,
  session TEXT NOT NULL UNIQUE,
  last_login TEXT NOT NULL,
  PRIMARY KEY(id AUTOINCREMENT) FOREIGN KEY(user_id) REFERENCES users(id)
);

CREATE TABLE groups (
  id INTEGER NOT NULL UNIQUE,
  name TEXT NOT NULL UNIQUE,
  PRIMARY KEY(id AUTOINCREMENT)
);

INSERT INTO
  groups (id, name)
VALUES
  (1, 'admin');

CREATE TABLE user_groups (
  id INTEGER NOT NULL UNIQUE,
  user_id INTEGER NOT NULL,
  group_id INTEGER NOT NULL,
  PRIMARY KEY(id AUTOINCREMENT) FOREIGN KEY(group_id) REFERENCES groups(id),
  FOREIGN KEY(user_id) REFERENCES users(id)
);

INSERT INTO
  user_groups (user_id, group_id)
VALUES
  (1, 1);

CREATE TABLE songs (
  id INTEGER PRIMARY KEY AUTOINCREMENT UNIQUE,
  title TEXT NOT NULL,
  song_path TEXT,
  release_date REAL NOT NULL,
  duration REAL NOT NULL,
  genre INTEGER,
  source TEXT NOT NULL,
  spotify_url TEXT NOT NULL,
  song_ext TEXT
);

INSERT INTO
  songs (
    id,
    title,
    song_path,
    release_date,
    duration,
    genre,
    source,
    spotify_url,
    song_ext
  )
VALUES
  (
    1,
    "Boss Bitch",
    '1.png',
    3.19,
    2.14,
    3,
    "https://en.wikipedia.org/wiki/Boss_Bitch_(Doja_Cat_song)",
    "https://open.spotify.com/playlist/4z2ebTTKukc34eMDlqrnW4",
    'png'
  );

INSERT INTO
  songs (
    id,
    title,
    song_path,
    release_date,
    duration,
    genre,
    source,
    spotify_url,
    song_ext
  )
VALUES
  (
    2,
    "Candy",
    '2.png',
    1.18,
    3.11,
    3,
    "https://en.wikipedia.org/wiki/Candy_(Doja_Cat_song)",
    "https://open.spotify.com/playlist/4z2ebTTKukc34eMDlqrnW4",
    'png'
  );

INSERT INTO
  songs (
    id,
    title,
    song_path,
    release_date,
    duration,
    genre,
    source,
    spotify_url,
    song_ext
  )
VALUES
  (
    3,
    "Freak",
    '3.png',
    6.19,
    4.45,
    4,
    "https://en.wikipedia.org/wiki/Freak_(Doja_Cat_song)",
    "https://open.spotify.com/playlist/4z2ebTTKukc34eMDlqrnW4",
    'png'
  );

INSERT INTO
  songs (
    id,
    title,
    song_path,
    release_date,
    duration,
    genre,
    source,
    spotify_url,
    song_ext
  )
VALUES
  (
    4,
    "Freaky Deaky",
    '4.png',
    4.21,
    3.35,
    3,
    "https://en.wikipedia.org/wiki/Need_to_Know_(Doja_Cat_song)",
    "https://open.spotify.com/playlist/4z2ebTTKukc34eMDlqrnW4",
    'png'
  );

INSERT INTO
  songs (
    id,
    title,
    song_path,
    release_date,
    duration,
    genre,
    source,
    spotify_url,
    song_ext
  )
VALUES
  (
    5,
    "Get into it (yuh)",
    '5.png',
    7.20,
    3.09,
    1,
    "https://en.wikipedia.org/wiki/get_into_it_(Doja_Cat_song)",
    "https://open.spotify.com/playlist/4z2ebTTKukc34eMDlqrnW4",
    'png'
  );

INSERT INTO
  songs (
    id,
    title,
    song_path,
    release_date,
    duration,
    genre,
    source,
    spotify_url,
    song_ext
  )
VALUES
  (
    6,
    "I like you",
    '6.png',
    4.22,
    3.12,
    5,
    "https://en.wikipedia.org/wiki/I_like_you_(Doja_Cat_song)",
    "https://open.spotify.com/playlist/4z2ebTTKukc34eMDlqrnW4",
    'png'
  );

INSERT INTO
  songs (
    id,
    title,
    song_path,
    release_date,
    duration,
    genre,
    source,
    spotify_url,
    song_ext
  )
VALUES
  (
    7,
    "Kiss me more",
    '7.png',
    8.21,
    3.29,
    5,
    "https://en.wikipedia.org/wiki/Kiss_me_more_(Doja_Cat_song)",
    "https://open.spotify.com/playlist/4z2ebTTKukc34eMDlqrnW4",
    'png'
  );

INSERT INTO
  songs (
    id,
    title,
    song_path,
    release_date,
    duration,
    genre,
    source,
    spotify_url,
    song_ext
  )
VALUES
  (
    8,
    "Need to know",
    '8.png',
    3.19,
    3.19,
    4,
    "https://en.wikipedia.org/wiki/Need_to_Know_(Doja_Cat_song)",
    "https://open.spotify.com/playlist/4z2ebTTKukc34eMDlqrnW4",
    'png'
  );

INSERT INTO
  songs (
    id,
    title,
    song_path,
    release_date,
    duration,
    genre,
    source,
    spotify_url,
    song_ext
  )
VALUES
  (
    9,
    "Been like this",
    '9.png',
    3.20,
    2.49,
    1,
    "https://en.wikipedia.org/wiki/planet_her_(Doja_Cat_song)",
    "https://open.spotify.com/playlist/4z2ebTTKukc34eMDlqrnW4",
    'png'
  );

INSERT INTO
  songs (
    id,
    title,
    song_path,
    release_date,
    duration,
    genre,
    source,
    spotify_url,
    song_ext
  )
VALUES
  (
    10,
    "Say So",
    '10.png',
    7.19,
    3.26,
    5,
    "https://en.wikipedia.org/wiki/say_so_(Doja_Cat_song)",
    "https://open.spotify.com/playlist/4z2ebTTKukc34eMDlqrnW4",
    'png'
  );

INSERT INTO
  songs (
    id,
    title,
    song_path,
    release_date,
    duration,
    genre,
    source,
    spotify_url,
    song_ext
  )
VALUES
  (
    11,
    "Streets",
    '11.png',
    2.19,
    3.47,
    2,
    "https://en.wikipedia.org/wiki/streets_(Doja_Cat_song)",
    "https://open.spotify.com/playlist/4z2ebTTKukc34eMDlqrnW4",
    'png'
  );

INSERT INTO
  songs (
    id,
    title,
    song_path,
    release_date,
    duration,
    genre,
    source,
    spotify_url,
    song_ext
  )
VALUES
  (
    12,
    "Vegas",
    '12.png',
    7.22,
    3.03,
    4,
    "https://en.wikipedia.org/wiki/Vegas_(Doja_Cat_song)",
    "https://open.spotify.com/playlist/4z2ebTTKukc34eMDlqrnW4",
    'png'
  );

INSERT INTO
  songs (
    id,
    title,
    song_path,
    release_date,
    duration,
    genre,
    source,
    spotify_url,
    song_ext
  )
VALUES
  (
    13,
    "Woman",
    '13.png',
    5.21,
    3.22,
    1,
    "https://en.wikipedia.org/wiki/Woman_(Doja_Cat_song)",
    "https://open.spotify.com/playlist/4z2ebTTKukc34eMDlqrnW4",
    'png'
  );

INSERT INTO
  songs (
    id,
    title,
    song_path,
    release_date,
    duration,
    genre,
    source,
    spotify_url,
    song_ext
  )
VALUES
  (
    14,
    "You right",
    '14.png',
    5.21,
    3.11,
    2,
    "https://en.wikipedia.org/wiki/You_right_(Doja_Cat_song)",
    "https://open.spotify.com/playlist/4z2ebTTKukc34eMDlqrnW4",
    'png'
  );

INSERT INTO
  songs (
    id,
    title,
    song_path,
    release_date,
    duration,
    genre,
    source,
    spotify_url,
    song_ext
  )
VALUES
  (
    15,
    "I don't drugs",
    '15.png',
    8.19,
    3.19,
    1,
    "https://en.wikipedia.org/wiki/i_dont_do_drugs_(Doja_Cat_song)",
    "https://open.spotify.com/playlist/4z2ebTTKukc34eMDlqrnW4",
    'png'
  );

CREATE TABLE albums (
  id INTEGER PRIMARY KEY AUTOINCREMENT UNIQUE,
  stats INTEGER NOT NULL
);

INSERT INTO
  albums (id, stats)
VALUES
  (1, 1);

INSERT INTO
  albums (id, stats)
VALUES
  (2, 2);

INSERT INTO
  albums (id, stats)
VALUES
  (3, 3);

INSERT INTO
  albums (id, stats)
VALUES
  (4, 4);

INSERT INTO
  albums (id, stats)
VALUES
  (5, 5);

CREATE TABLE songs_on_albums (
  id INTEGER PRIMARY KEY AUTOINCREMENT UNIQUE,
  song_id INTEGER NOT NULL,
  album_id INTEGER NOT NULL,
  FOREIGN KEY(song_id) REFERENCES songs(id),
  FOREIGN KEY(album_id) REFERENCES albums(id)
);

INSERT INTO
  songs_on_albums (id, song_id, album_id)
VALUES
  (1, 1, 2);

INSERT INTO
  songs_on_albums (id, song_id, album_id)
VALUES
  (2, 1, 4);

INSERT INTO
  songs_on_albums (id, song_id, album_id)
VALUES
  (3, 2, 3);

INSERT INTO
  songs_on_albums (id, song_id, album_id)
VALUES
  (4, 2, 4);

INSERT INTO
  songs_on_albums (id, song_id, album_id)
VALUES
  (5, 3, 2);

INSERT INTO
  songs_on_albums (id, song_id, album_id)
VALUES
  (6, 3, 5);

INSERT INTO
  songs_on_albums (id, song_id, album_id)
VALUES
  (7, 4, 1);

INSERT INTO
  songs_on_albums (id, song_id, album_id)
VALUES
  (8, 4, 5);

INSERT INTO
  songs_on_albums (id, song_id, album_id)
VALUES
  (9, 5, 1);

INSERT INTO
  songs_on_albums (id, song_id, album_id)
VALUES
  (10, 5, 5);

INSERT INTO
  songs_on_albums (id, song_id, album_id)
VALUES
  (11, 6, 3);

INSERT INTO
  songs_on_albums (id, song_id, album_id)
VALUES
  (12, 6, 4);

INSERT INTO
  songs_on_albums (id, song_id, album_id)
VALUES
  (13, 7, 3);

INSERT INTO
  songs_on_albums (id, song_id, album_id)
VALUES
  (14, 7, 5);

INSERT INTO
  songs_on_albums (id, song_id, album_id)
VALUES
  (15, 8, 2);

INSERT INTO
  songs_on_albums (id, song_id, album_id)
VALUES
  (16, 8, 4);

INSERT INTO
  songs_on_albums (id, song_id, album_id)
VALUES
  (17, 9, 1);

INSERT INTO
  songs_on_albums (id, song_id, album_id)
VALUES
  (18, 9, 5);

INSERT INTO
  songs_on_albums (id, song_id, album_id)
VALUES
  (19, 10, 2);

INSERT INTO
  songs_on_albums (id, song_id, album_id)
VALUES
  (20, 10, 4);

INSERT INTO
  songs_on_albums (id, song_id, album_id)
VALUES
  (21, 11, 2);

INSERT INTO
  songs_on_albums (id, song_id, album_id)
VALUES
  (22, 12, 3);

INSERT INTO
  songs_on_albums (id, song_id, album_id)
VALUES
  (23, 12, 4);

INSERT INTO
  songs_on_albums (id, song_id, album_id)
VALUES
  (24, 13, 3);

INSERT INTO
  songs_on_albums (id, song_id, album_id)
VALUES
  (25, 13, 5);

INSERT INTO
  songs_on_albums (id, song_id, album_id)
VALUES
  (26, 14, 2);

INSERT INTO
  songs_on_albums (id, song_id, album_id)
VALUES
  (27, 14, 5);

INSERT INTO
  songs_on_albums (id, song_id, album_id)
VALUES
  (28, 15, 1);

INSERT INTO
  songs_on_albums (id, song_id, album_id)
VALUES
  (29, 15, 4);

INSERT INTO
  songs_on_albums (id, song_id, album_id)
VALUES
  (30, 15, 5);
