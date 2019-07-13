<? if($logged_in): ?>

	<? include("includes/admin_navbar.php"); ?>
    <aside class="sidebar loading<?=$sidebar_open?>">
		<div class="search flex-row">
			<input class="input" type="text" name="search_artists" placeholder="Search">
		</div>

		<?

		if (str_starts_with($slug, "/admin/artists")) {
			$query = "SELECT * FROM artists ORDER BY id";
			$result = mysqli_query($db_connection, $query);
			if (!$result) {
				echo "Well, that happened... " . mysqli_error($db_connection);
				die();
			}

			// Avoid errors if on /admin/artists
			$read_id = "";
			$read_name = "";
			$read_link_website = "";
			$read_link_soundcloud = "";
			$read_link_youtube = "";
			$read_link_facebook = "";
			$read_link_twitter = "";
			$read_link_instagram = "";

			while ($artist = mysqli_fetch_assoc($result)) {
				$artist_url = urlify($artist["name"]);
				$current_page = "";
				if ($real_slug == "/admin/artists/$artist_url") {
					$current_page = " current-page";

					$read_id = $artist["id"];
					$read_name = $artist["name"];
					$read_link_website = $artist["link_website"];
					$read_link_soundcloud = $artist["link_soundcloud"];
					$read_link_youtube = $artist["link_youtube"];
					$read_link_facebook = $artist["link_facebook"];
					$read_link_twitter = $artist["link_twitter"];
					$read_link_instagram = $artist["link_instagram"];
				}
				?>
				<div class="artist<?=$current_page?>">
					<a href="/admin/artists/<?=$artist_url?>">
						<p><?=$artist["name"]?></p>
					</a>
				</div>
				<?
			}
			mysqli_free_result($result);
		}
		?>
	</aside>
	<main class="loading<?=$sidebar_open?>">
		<section class="artist-info artist-track-info">
			<form autocomplete="off" method="post" action="/admin/post">
				<input type="hidden" name="id" value="<?=$read_id?>">
				<div class="flex-row static">
					<? if ($real_slug == "/admin/artists"): ?>
						<input class="input submit create" type="submit" name="submit_create_artist" value="">
					<? else: ?>
						<input class="input submit update" type="submit" name="submit_update_artist" value="">
					<? endif; ?>
					<input class="input artist" type="text" name="name" placeholder="Artist" value="<?=$read_name?>">
					<? if ($real_slug == "/admin/artists"): ?>
						<input class="input submit spacer" type="submit">
					<? else: ?>
						<input class="input submit delete" type="submit" name="submit_delete_artist" value="">
					<? endif; ?>
				</div>
				<section class="artist-links">
					<div class="flex-row">
						<div class="icon website"></div>
						<input class="input link" type="text" name="link_website" placeholder="Website Link" value="<?=$read_link_website?>">
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
						<div class="icon facebook"></div>
						<input class="input link" type="text" name="link_facebook" placeholder="Facebook Link" value="<?=$read_link_facebook?>">
					</div>
					<div class="flex-row">
						<div class="icon twitter"></div>
						<input class="input link" type="text" name="link_twitter" placeholder="Twitter Link" value="<?=$read_link_twitter?>">
					</div>
					<div class="flex-row">
						<div class="icon instagram"></div>
						<input class="input link" type="text" name="link_instagram" placeholder="Instagram Link" value="<?=$read_link_instagram?>">
					</div>
				</section>
			</form>
		</section>
		<section class="darker-section artists-page flex-row">
			<div class="card">
				<div>
					<a href="/">
						<img src="/cdn/covers/1.png">
						<div> <p>Heyo there I be title</p> </div>
					</a>
					<p class="artists"><a href="/">Conor Ross</a> x <a href="/">Arny Lengle</a></p>
				</div>
			</div>
			<div class="card">
				<div>
					<a href="/">
						<img src="/cdn/covers/1.png">
						<div> <p>Heyo there I be title</p> </div>
					</a>
					<p class="artists"><a href="/">Conor Ross</a> x <a href="/">Arny Lengle</a></p>
				</div>
			</div>
			<div class="card">
				<div>
					<a href="/">
						<img src="/cdn/covers/1.png">
						<div> <p>Heyo there I be title</p> </div>
					</a>
					<p class="artists"><a href="/">Conor Ross</a> x <a href="/">Arny Lengle</a></p>
				</div>
			</div>
			<div class="card">
				<div>
					<a href="/">
						<img src="/cdn/covers/1.png">
						<div> <p>Heyo there I be title</p> </div>
					</a>
					<p class="artists"><a href="/">Conor Ross</a> x <a href="/">Arny Lengle</a></p>
				</div>
			</div>
			<div class="card">
				<div>
					<a href="/">
						<img src="/cdn/covers/1.png">
						<div> <p>Heyo there I be title</p> </div>
					</a>
					<p class="artists"><a href="/">Conor Ross</a> x <a href="/">Arny Lengle</a></p>
				</div>
			</div>
		</section>
		<section class="bottom-filler"></section>
	</main>

<? elseif ($logged_out): ?>
    <? include("includes/admin_login.php") ?>
<? endif; ?>
