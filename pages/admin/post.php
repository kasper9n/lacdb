<?

//function upload()



function post_to_sql_strings($type) {
	define("REQUIRED", true);
	if ($type == "artist") {
		post_to_sql_string("id");
		post_to_sql_string("name", REQUIRED);
		post_to_sql_string("link_website");
		post_to_sql_string("link_soundcloud");
		post_to_sql_string("link_youtube");
		post_to_sql_string("link_facebook");
		post_to_sql_string("link_twitter");
		post_to_sql_string("link_instagram");
	} elseif ($type == "track") {
		post_to_sql_string("id");
		post_to_sql_string("artist", REQUIRED);
		post_to_sql_string("title", REQUIRED);
		post_to_sql_string("catnum");
		post_to_sql_string("short_description");
		post_to_sql_string("genre");
		post_to_sql_string("release_date");
		// Validare release_date
		post_to_sql_string("link_free_download");
		post_to_sql_string("link_soundcloud");
		post_to_sql_string("link_youtube");
		post_to_sql_string("link_spotify");
		post_to_sql_string("link_beatport");
		post_to_sql_string("link_itunes");
		post_to_sql_string("link_google_play_music");
		post_to_sql_string("link_bandcamp");
	}
}

// Create artist
if (isset($_POST["submit_create_artist"])) {
	post_to_sql_strings("artist");

	$query = " INSERT INTO artists
	(name, link_website, link_soundcloud, link_youtube, link_facebook, link_twitter, link_instagram)
	VALUES ('{$name}', '{$link_website}', '{$link_soundcloud}', '{$link_youtube}', '{$link_facebook}', '{$link_twitter}', '{$link_instagram}')
	";


	$result = mysqli_query($db_connection, $query);

	if ($result) {
		echo "Database INSERT query successful<br>";
		$artist_url = urlify($name);
		echo "<a href=\"/admin/artists/$artist_url\">Redirect</a><br>";
	} else {
		echo "Datatabse query failed: " . mysqli_error($db_connection) . "<br>";
	}
	die();
}

// Update artist
elseif (isset($_POST["submit_update_artist"])) {
	post_to_sql_strings("artist");

	$query = " UPDATE artists SET
	name = '{$name}',
	link_website = '{$link_website}',
	link_soundcloud = '{$link_soundcloud}',
	link_youtube = '{$link_youtube}',
	link_facebook = '{$link_facebook}',
	link_twitter = '{$link_twitter}',
	link_instagram = '{$link_instagram}'
	WHERE id = '{$id}'
	";
	$result = mysqli_query($db_connection, $query);
	// Error check
	if ($result) {
		// Success
		echo "Database UPDATE query successful<br>";
		$artist_url = urlify($name);
		echo "<a href=\"/admin/artists/$artist_url\">Redirect</a><br>";
	} else {
		echo "Datatabse query failed: " . mysqli_error($db_connection) . "<br>";
	}
	die();
}

// Delete artist
elseif (isset($_POST["submit_delete_artist"])) {
	post_to_sql_string("id");
	$query = "DELETE FROM artists WHERE id = '{$id}' LIMIT 1";
	$result = mysqli_query($db_connection, $query);

	if ($result && mysqli_affected_rows($db_connection) == 1) {
		// Success
		echo "Database DELETE query successful<br>";
		echo "<a href=\"/admin/artists\">Redirect</a><br>";
	} else {
		echo "Datatabse query failed: " . mysqli_error($db_connection) . "<br>";
	}
	die();
}


// Create track
elseif (isset($_POST["submit_create_track"])) {
	post_to_sql_strings("track");
	$release_date = date("d-m-Y", strtotime($release_date));

	$query = " INSERT INTO tracks
	(artist_format, title, catnum, short_description, genre, release_date, link_free_download, link_soundcloud, link_youtube, link_spotify, link_beatport, link_itunes, link_google_play_music, link_bandcamp)
	VALUES ('{$artist}', '{$title}', '{$catnum}', '{$short_description}', '{$genre}', '{$release_date}', '{$link_free_download}', '{$link_soundcloud}', '{$link_youtube}', '{$link_spotify}', '{$link_beatport}', '{$link_itunes}', '{$link_google_play_music}', '{$link_bandcamp}')
	";

	$result = mysqli_query($db_connection, $query);

	if ($result) {
		echo "Database INSERT query successful<br>";
		$track_url = urlify($title);
		echo "<a href=\"/admin/tracks/$track_url\">Redirect</a><br>";
	} else {
		echo "Datatabse query failed: " . mysqli_error($db_connection) . "<br>";
	}
	die();
}

// Update track
elseif (isset($_POST["submit_update_track"])) {
	post_to_sql_strings("track");
	$release_date = date("Y-m-d", strtotime($release_date));

	$query = " UPDATE tracks SET
	artist_format = '{$artist}',
	title = '{$title}',
	catnum = '{$catnum}',
	short_description = '{$short_description}',
	genre = '{$genre}',
	release_date = '{$release_date}',
	link_free_download = '{$link_free_download}',
	link_soundcloud = '{$link_soundcloud}',
	link_youtube = '{$link_youtube}',
	link_spotify = '{$link_spotify}',
	link_beatport = '{$link_beatport}',
	link_itunes = '{$link_itunes}',
	link_google_play_music = '{$link_google_play_music}',
	link_bandcamp = '{$link_bandcamp}'
	WHERE id = '{$id}'
	";
	$result = mysqli_query($db_connection, $query);
	// Error check
	if ($result) {
		// Success
		echo "Database UPDATE query successful<br>";
		$track_url = urlify($title);
		echo "<a href=\"/admin/tracks/$track_url\">Redirect</a><br>";
	} else {
		echo "Datatabse query failed: " . mysqli_error($db_connection) . "<br>";
	}
	die();
}

// Delete track
elseif (isset($_POST["submit_delete_track"])) {
	post_to_sql_string("id");
	$query = "DELETE FROM tracks WHERE id = '{$id}' LIMIT 1";
	$result = mysqli_query($db_connection, $query);

	if ($result && mysqli_affected_rows($db_connection) == 1) {
		// Success
		echo "Database DELETE query successful<br>";
		echo "<a href=\"/admin/tracks\">Redirect</a><br>";
	} else {
		echo "Datatabse query failed: " . mysqli_error($db_connection) . "<br>";
	}
	die();
}

?>
