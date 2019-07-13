<?

function complete_link_line($link_platform) {
	global $artist_link;
	$artist_link_platform = "artist_$link_platform";
	$$artist_link_platform = $artist_link["$link_platform"];
	if ($$artist_link_platform != "") {
		return "\n»» ".$$artist_link_platform;
	}
}
for ($i = 1; $i <= 5; $i++) {
	$read_artistnum = "read_artist".$i;
	if (isset($$read_artistnum) && $$read_artistnum != "") {
		$query = "SELECT * FROM artists WHERE name = '{$$read_artistnum}'";
		$result = mysqli_query($db_connection, $query);
		if (!$result) {
			echo "Oh look at this, huh... " . mysqli_error($db_connection);
			die();
		}

		while ($artist_link = mysqli_fetch_assoc($result)) {
			$artist_link_website = complete_link_line("link_website");
			$artist_link_soundcloud = complete_link_line("link_soundcloud");
			$artist_link_youtube = complete_link_line("link_youtube");
			$artist_link_facebook = complete_link_line("link_facebook");
			$artist_link_twitter = complete_link_line("link_twitter");
			$artist_link_instagram = complete_link_line("link_instagram");
		}
		mysqli_free_result($result);

		$$read_artistnum =
		"\n►".$$read_artistnum
		.$artist_link_website
		.$artist_link_soundcloud
		.$artist_link_youtube
		.$artist_link_facebook
		.$artist_link_twitter
		.$artist_link_instagram
		."\n";
	} else {
		$$read_artistnum = "";
	}
}
$artists = $read_artist1.$read_artist2.$read_artist3.$read_artist4.$read_artist5;
$artists = trim($artists, "\n");


function il($text, $type) {
	$var_name = "read_link_" . $type;
	global $$var_name;
	if (isset($$var_name) && $$var_name != "") {
		if ($type == "free_download") return $text . $$var_name;
		return "\n" . $text . $$var_name;
	} else {
		return "";
	}
}

$platform_links =
	il("Free download: ", "free_download")
	.il("SoundCloud: ", "soundcloud")
	.il("YouTube: ", "youtube")
	.il("Spotify: ", "spotify")
	.il("Beatport: ", "beatport")
	.il("iTunes: ", "itunes")
	.il("Google Play Music: ", "google_play_music")
	.il("Bandcamp: ", "bandcamp");

if ($platform_links == "" && $artists != "") {
	$artists = "\n$artists\n";
} elseif ($platform_links != "" && $artists == "") {
	$platform_links = "\n$platform_links\n";
} elseif ($artists != "" && $artists != "") {
	$artists = "\n$artists\n";
	$platform_links = "\n$platform_links\n";
}
if ($read_catnum == "") $read_catnum = "CATNUM";

$description =
$read_short_description
."\n"
.$platform_links
.$artists
."\nGenre: $read_genre
Catalogue Number: $read_catnum

► Lacuna Records
»» https://soundcloud.com/lacunaRecords
»» https://youtube.com/c/LacunaRecords
»» https://facebook.com/LacunaRecs
»» https://twitter.com/Lacuna_Records
»» https://instagram.com/Lacuna_Records

©️ Copyright
Every Lacuna Records release is free to both download and upload, and we do not claim or strike any videos. We do not allow re-uploading tracks to SoundCloud. If you want to promote a track, please credit Lacuna Records and the artist with links."
?>
