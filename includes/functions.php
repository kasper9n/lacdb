<?

$site_address = "http://" . $_SERVER["HTTP_HOST"];
// $site_address = "http://" . "185.78.69.59";

$css_paths = [
	"/admin" => "admin.css",
	"/admin/tracks" => "admin.css",
	"/admin/artists" => "admin.css"
];
$js_paths = [
	"/admin" => "admin.js",
	"/admin/tracks" => "admin.js",
	"/admin/artists" => "admin.js"
];

function is_ajax_request() {
	return isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && $_SERVER["HTTP_X_REQUESTED_WITH"] == "XMLHttpRequest";
}

function get_slug() {
	global $slug;
	$slug = $_SERVER["REQUEST_URI"];
	$slug = explode("?", $slug, 2);
	$slug = $slug[0];
	$slug = strtolower($slug);
	if (preg_match("[/$]", $slug) && $slug != "/") {
		$slug = rtrim($slug, "/");
		// redirect_to($slug);
	}
	return $slug;
}
function get_css() {
	global $slug;
	global $css_paths;
	$css = "";
	// Find out if slug is one from $css_paths
	foreach ($css_paths as $possible_slug => $css_path) {
		if ($possible_slug == $slug) {
			$css = "/css/$css_path?r=" . rand(0,999);
			$css = '<link rel="stylesheet" type="text/css" href="'.$css.'"/>';
		}
	}
	return $css;
}
function get_js() {
	global $slug;
	global $js_paths;
	$js = "";
	// Find out if slug is one from $js_paths
	foreach ($js_paths as $possible_slug => $js_path) {
		if ($possible_slug == $slug && file_exists("js/$js_path")) {
			$js = "/js/$js_path?r=" . rand(0,999);
			$js = '<script src="'.$js.'"></script>';
		}
	}
	return $js;
}

function redirect_from_to($from_slug, $to_slug) {
	global $slug;
	global $site_address;
	if ($slug == $from_slug) {
		header("Location: $site_address$to_slug");
		die();
	}
}
function redirect_if() {
	redirect_from_to("/home", "");
}
function redirect_to($to_slug) {
	global $site_address;
	echo "$site_address";
	header("Location: $site_address$to_slug");
	die();
}
function reload() {
	redirect_to($slug);
}

function db_connect() {
	global $db_connection;
	$host = "localhost";
	$username = "web";
	$password = "BdW2XyeWaSVmFNcn";
	$db_name = "lacuna";
	$db_connection = mysqli_connect($host, $username, $password, $db_name);
}
function db_disconnect() {
	// 5. Disconnect from db
	global $db_connection;
	mysqli_close($db_connection);
}
function db_query($query) {
	global $db_connection;
	$query = mysqli_real_escape_string($db_connection, $query);
	$result = mysqli_query($db_connection, $query);
	return $result;
}

function validate_upload_image($target_file) {
	// Check if file already exists
	if (file_exists($target_file)) {
		die("File already exists");
	}
	// Validate file size
	if ($_FILES["cover_upload"]["size"] > 5000000) {
		die("File is too large.");
	}
	// Validate format
	global $imageFileType;
	if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
		die("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
	}
}

function urlify($string) {
	$string = strtolower($string);
	$string = str_replace([" "], "-", $string);
	$array = [".", ",", '"', "'", "&", "(", ")", "[", "]"];
	$string = str_replace($array, "", $string);
	$string = str_replace("--", "", $string);
	return $string;
}

function session_to_string($session_index, $else_val) {
	if (isset($_SESSION[$session_index])) {
		$session_value = $_SESSION[$session_index];
		global $$session_index;
		$$session_index = $session_value;
	} else {
		global $$session_index;
		$$session_index = $else_val;
	}
}
function post_to_sql_string($post_index, $required = false) {
	if (isset($_POST[$post_index])) {
		if ($_POST[$post_index] == "" && $required == true) {
			die("Error: $post_index field cannot be empty");
		}
		$post_value = $_POST[$post_index];
		global $db_connection;
		$post_value = mysqli_real_escape_string($db_connection, $post_value);
		global $$post_index;
		$$post_index = $post_value;
	} else {
		die("isset(\$_POST['$post_index']) returned false");
	}
}

function str_starts_with($string, $start) {
	//  substr($slug, 0, 6) == "/admin"
	$length = strlen($start);
	return (substr($string, 0, $length) == $start);
}

?>
