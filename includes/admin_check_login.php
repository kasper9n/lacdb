<?

$password = "123";

if (isset($_POST["submit_login"])) {
    $submitted_password = $_POST["password"];
    if ($submitted_password == $password) {
		$_SESSION["logged_in"] = true;
        redirect_to($slug);
    } else {
		$_SESSION["logged_in"] = false;
        redirect_to("/admin?password=incorrect");
	}
}

session_to_string("logged_in", false);
$logged_out = !$logged_in;

?>
