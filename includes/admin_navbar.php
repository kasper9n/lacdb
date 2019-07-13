<?
function active_page($page_slug) {
    global $slug;
    if ($page_slug == $slug) {
        return "active";
    } else {
        return "";
    }
}
?>

<nav class="nav-bar flex-row">
	<a onclick="toggleSidebar()">
		<div></div>
	</a>
    <a href="/admin/artists">
		<div class="<?=active_page("/admin/artists");?>">
			Artists
		</div>
	</a>
    <a href="/admin/tracks">
		<div class="<?=active_page("/admin/tracks");?>">
			Tracks
		</div>
	</a>
	<a href="/admin/logout">
		<div></div>
	</a>
</nav>
