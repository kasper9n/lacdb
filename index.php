<?
	session_start();
	include("includes/functions.php");
	get_slug();
	$real_slug = $slug;
	db_connect();
	$thatsa404 = false;

	if ($slug == "/") {
		$include_path = "pages/home.php";
	} elseif (file_exists("pages$slug/index.php")) {
		$include_path = "pages$slug/index.php";
	} elseif (file_exists("pages$slug.php")) {
		$include_path = "pages$slug.php";
	} else {
		$thatsa404 = true;
	}

	// Admin area
	if (str_starts_with($slug, "/admin")) {
		include("includes/admin_check_login.php");

		// Find correct artist/track page
		if (str_starts_with($slug, "/admin/artists")) {
			$query = "SELECT * FROM artists ORDER BY id";
			$result = mysqli_query($db_connection, $query);
			if (!$result) {
				echo "Well, that happened... " . mysqli_error($db_connection);
				die();
			}
			while ($artist = mysqli_fetch_assoc($result)) {
				$artist_url = urlify($artist["name"]);
				if ($slug == "/admin/artists/$artist_url") {
					$thatsa404 = false;
					$include_path = "pages/admin/artists.php";
					$real_slug = $slug;
					$slug = "/admin/artists";
				}
			}
			mysqli_free_result($result);
		} elseif (str_starts_with($slug, "/admin/tracks")) {
			$query = "SELECT * FROM tracks ORDER BY catnum";
			$result = mysqli_query($db_connection, $query);
			if (!$result) {
				echo "Well, that happened... " . mysqli_error($db_connection);
				die();
			}
			while ($track = mysqli_fetch_assoc($result)) {
				$track_url = urlify($track["title"]);
				if ($slug == "/admin/tracks/$track_url") {
					$thatsa404 = false;
					$include_path = "pages/admin/tracks.php";
					$real_slug = $slug;
					$slug = "/admin/tracks";
				}
			}
		}

		// Load sidebar state cookies
		if (isset($_COOKIE["sidebar_open"])) {
			if ($_COOKIE["sidebar_open"] == "true") {
				$sidebar_open = " open";
			} else {
				$sidebar_open = "";
			}
		} else {
			$sidebar_open = " open";
			setcookie("sidebar_open", "true", null, "/");
		}
	}

	// Handle 404s
	if ($thatsa404) {
		// redirect_to("/");
		$include_path = "pages/404.php";
		$real_slug = $slug;
		$slug = "/";
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="/css/global.css?r=<?=rand(0,999)?>">
		<?= get_css(); ?>
	</head>
	<body>
		<? include("$include_path"); ?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="/js/js.cookie-2.1.3.min.js"></script>
		<?= get_js(); ?>
	</body>
</html>
<? db_disconnect(); ?>
