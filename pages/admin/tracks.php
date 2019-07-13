<? if($logged_in): ?>

	<? include("includes/admin_navbar.php"); ?>
    <aside class="sidebar loading<?=$sidebar_open?>">
		<div class="search flex-row">
			<input class="input" type="text" name="search_artists" placeholder="Search">
		</div>

		<?

		if (str_starts_with($slug, "/admin/tracks")) {
			$query = "SELECT * FROM tracks ORDER BY catnum";
			$result = mysqli_query($db_connection, $query);
			if (!$result) {
				echo "Well, that happened... " . mysqli_error($db_connection);
				die();
			}

			// Avoid errors if on /admin/tracks
			$read_id = "";
			$read_artist_format = "";
			$read_artist1 = "";
			$read_artist2 = "";
			$read_artist3 = "";
			$read_artist4 = "";
			$read_artist5 = "";
			$read_title = "";
			$read_catnum = "";
			$read_short_description = "";
			$read_genre = "";
			$read_release_date = "";
			$read_link_free_download = "";
			$read_link_soundcloud = "";
			$read_link_youtube = "";
			$read_link_spotify = "";
			$read_link_beatport = "";
			$read_link_itunes = "";
			$read_link_google_play_music = "";
			$read_link_bandcamp = "";

			while ($track = mysqli_fetch_assoc($result)) {
				$track_url = urlify($track["title"]);
				$current_page = "";
				if ($real_slug == "/admin/tracks/$track_url") {
					$current_page = " current-page";

					$read_id = $track["id"];
					$read_artist_format = $track["artist_format"];
					$read_artist1 = $track["artist1"];
					$read_artist2 = $track["artist2"];
					$read_artist3 = $track["artist3"];
					$read_artist4 = $track["artist4"];
					$read_artist5 = $track["artist5"];
					$read_title = $track["title"];
					$read_catnum = $track["catnum"];
					$read_short_description = $track["short_description"];
					$read_genre = $track["genre"];
					$read_release_date = $track["release_date"];
					$read_link_free_download = $track["link_free_download"];
					$read_link_soundcloud = $track["link_soundcloud"];
					$read_link_youtube = $track["link_youtube"];
					$read_link_spotify = $track["link_spotify"];
					$read_link_beatport = $track["link_beatport"];
					$read_link_itunes = $track["link_itunes"];
					$read_link_google_play_music = $track["link_google_play_music"];
					$read_link_bandcamp = $track["link_bandcamp"];
				}
				?>
				<div class="track<?=$current_page?>">
					<a href="/admin/tracks/<?=$track_url?>">
						<p><?=$track["artist_format"]?></p>
						<p><?=$track["title"]?></p>
					</a>
				</div>
				<?
			}
			mysqli_free_result($result);
		}
		?>
	</aside>
	<main class="loading<?=$sidebar_open?>">
		<section class="track-info artist-track-info">
			<form autocomplete="off" method="post" action="/admin/post">
				<div class="flex-row static"></div>
				<input type="hidden" name="id" value="<?=$read_id?>">
				<div class="flex-row static">
					<? if ($real_slug == "/admin/tracks"): ?>
						<input class="input submit create" type="submit" name="submit_create_track" value="">
					<? else: ?>
						<input class="input submit update" type="submit" name="submit_update_track" value="">
					<? endif;?>
					<div class="flex-row">
						<input class="input" type="text" name="artist" placeholder="Artist" value="<?=$read_artist_format?>">
						<input class="input" type="text" name="title" placeholder="Title" value="<?=$read_title?>">
						<input class="input catnum" type="text" name="catnum" placeholder="LCR???" value="<?=$read_catnum?>">
					</div>
					<? if ($real_slug == "/admin/tracks"): ?>
						<input class="input submit spacer" type="submit">
					<? else: ?>
						<input class="input submit delete" type="submit" name="submit_delete_track" value="">
					<? endif; ?>
				</div>
				<div class="flex-row static description">
					<input class="input" type="text" name="short_description" placeholder="Short description" value="<?=$read_short_description?>">
					<input class="input" type="text" name="genre" placeholder="Genre" value="<?=$read_genre?>">
					<?
					if ($read_release_date == "") {
						$read_release_date = date("j M Y", strtotime("today"));
					} else {
						$read_release_date = date("j M Y", strtotime($read_release_date));
					}
					?>
					<input class="input" type="text" name="release_date" placeholder="Release Date" value="<?=$read_release_date?>">
				</div>
				<section class="track-links">
					<div class="flex-row">
						<div class="icon download"></div>
						<input class="input link" type="text" name="link_free_download" placeholder="Free download Link" value="<?=$read_link_free_download?>">
					</div>
					<div class="flex-row">
						<div class="icon soundcloud"></div>
						<input class="input link" type="text" name="link_soundcloud" placeholder="SoundCloud Link" value="<?=$read_link_soundcloud?>">
					</div>
					<div class="flex-row">
						<div class="icon youtube"></div>
						<input class="input link" type="text" name="link_youtube" placeholder="YouTube Link" value="<?=$read_link_youtube?>">
					</div>
					<div class="flex-row">
						<div class="icon spotify"></div>
						<input class="input link" type="text" name="link_spotify" placeholder="Spotify Link" value="<?=$read_link_spotify?>">
					</div>
					<div class="flex-row">
						<div class="icon beatport"></div>
						<input class="input link" type="text" name="link_beatport" placeholder="Beatport Link" value="<?=$read_link_beatport?>">
					</div>
					<div class="flex-row">
						<div class="icon itunes"></div>
						<input class="input link" type="text" name="link_itunes" placeholder="iTunes Link" value="<?=$read_link_itunes?>">
					</div>
					<div class="flex-row">
						<div class="icon googleplaymusic"></div>
						<input class="input link" type="text" name="link_google_play_music" placeholder="Google Play Music Link" value="<?=$read_link_google_play_music?>">
					</div>
					<div class="flex-row">
						<div class="icon bandcamp"></div>
						<input class="input link" type="text" name="link_bandcamp" placeholder="Bandcamp Link" value="<?=$read_link_bandcamp?>">
					</div>
				</section>
			</form>
		</section>
		<section class="darker-section tracks-page flex-row">
			<div class="card tracks-page">
				<div class="flex-col">
					<a class="file" title="WAV">
						<label class="upload" for="audio_wav">Audio</label>
						<input class="hidden" type="file" id="audio_wav" name="audio_wav" accept="audio/wav"/>
					</a>
					<a class="file" download href="/cdn/icons/sm/twitter.png">
						<label class="download">WAV</label>
					</a>
					<a class="file" download href="/cdn/icons/sm/twitter.png">
						<label class="download">MP3 320kbps</label>
					</a>
					<a class="file" download href="/cdn/icons/sm/twitter.png">
						<label class="download">MP3 128kbps</label>
					</a>
				</div>
			</div>
			<div class="card tracks-page">
				<div>
					<img src="/cdn/covers/1.png">
				</div>
			</div>
			<div class="card tracks-page">
				<div class="flex-col">

					<a class="file" title="PNG/JPG, optimally 3000x3000">
						<label class="upload" for="cover_png_jpg">Cover</label>
						<input class="hidden" type="file" id="cover_png_jpg" name="cover_png_jpg" accept="image/jpeg, image/png"/>
					</a>
					<a class="file" download href="/cdn/icons/sm/twitter.png">
						<label class="download">PNG 3000x</label>
					</a>
					<a class="file" download href="/cdn/icons/sm/twitter.png">
						<label class="download">PNG 500x</label>
					</a>
					<a>
						<p>Original: 1000x</p>
					</a>
				</div>
			</div>
		</section>
		<section class="bottom-filler"></section>
		<section class="other-files flex-row">
			<button class="file upload media-exists">Upload MP4</button>
			<button class="file upload media-exists">Upload Thumbnail</button>
			<button class="file upload media-exists">Upload Project</button>
			<button class="file upload media-exists">Upload Custom</button>
			<button class="file js-textareacopybtn media-exists" onclick="copyToClipboard()">Copy Description</button>
			<? include("includes/admin_description.php") ?>
			<textarea class="description"><?=$description?></textarea>
		</section>
	</main>

<? elseif ($logged_out): ?>
    <? include("includes/admin_login.php") ?>
<? endif; ?>
