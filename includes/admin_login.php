<?
if (isset($_GET["password"]) && $_GET["password"] == "incorrect") {
	// if password is incorrect
    $class = " " . $_GET["password"];
} else {
    $class = "";
}
?>

<div class="login center-xy">
    <form action="" method="post">
        <div>
            <input class="input<?=$class?>" type="password" name="password" placeholder="Password"/>
        </div>
        <div>
            <input class="hidden" type="submit" name="submit_login" value=""/>
        </div>
    </form>
</div>
