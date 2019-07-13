<? if($logged_in): ?>

    <? include("includes/admin_navbar.php"); ?>
	<main class="sitemap">
		<h1>Sitemap</h1>
		<div class="flex-row">
			<div>
				<a href="/admin"><h3 class="link-text-hover">/admin</h3></a>
				<a href="/admin/artists"><p class="link-text-hover">/artists</p></a>
				<a href="/admin/tracks"><p class="link-text-hover">/tracks</p></a>
			</div>
			<div>
				<a href="/something"><h3 class="link-text-hover">/something</h3></a>
			</div>
		</div>
	</main>

<? elseif ($logged_out): ?>
    <? include("includes/admin_login.php") ?>
<? endif; ?>
