<?php
	$USERNAME = "admin";
	$PASSWORD = "123456";

	session_start(); 
	if ($_GET["cmd"] == "logout") $_SESSION["username"] = ""; 
	$msg = "";
	if ($_POST["year"] != null) $year = $_POST["year"]; else $year = date("Y"); 
	if ($_POST["month"] != null) $month = $_POST["month"]; else $month = date("m"); 
	if ($_POST["day"] != null) $day = $_POST["day"]; else $day = date("d"); 
	if (strlen($month) < 2) $month = "0" . $month;
	if (strlen($day) < 2) $day = "0" . $day;
	$ymd = $year . $month . $day;

	if ($_POST["username"] != "") {
		if (($_POST["username"] == $USERNAME) & ($_POST["password"] == $PASSWORD)) {
			$_SESSION["username"] = "bc";
		} else {
			$msg = "<div style='color: #f0f0'>wrong username or password!</div>";
		}
	}

	$username = $_SESSION["username"];
?>
<html>
<head>
	<title>Uranium SIP-10A IP Network Wireless Siyah IP Kamera</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<!-- Add jQuery library -->
	<script type="text/javascript" src="./fancy/jquery-1.8.0.min.js"></script>

	<!-- Add mousewheel plugin (this is optional) -->
	<script type="text/javascript" src="./fancy/jquery.mousewheel-3.0.6.pack.js"></script>

	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="./fancy/jquery.fancybox.js?v=2.1.0"></script>
	<link rel="stylesheet" type="text/css" href="./fancy/jquery.fancybox.css?v=2.1.0" media="screen" />

	<!-- Add Button helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="./fancy/helpers/jquery.fancybox-buttons.css?v=1.0.3" />
	<script type="text/javascript" src="./fancy/helpers/jquery.fancybox-buttons.js?v=1.0.3"></script>

	<!-- Add Thumbnail helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="./fancy/helpers/jquery.fancybox-thumbs.css?v=1.0.6" />
	<script type="text/javascript" src="./fancy/helpers/jquery.fancybox-thumbs.js?v=1.0.6"></script>

	<!-- Add Media helper (this is optional) -->
	<script type="text/javascript" src="./fancy/helpers/jquery.fancybox-media.js?v=1.0.3"></script>

	<style>
		.lst { width: 205px; height: 160px; margin: 5px; padding: 5px; float: left; display: inline-block; background-size: cover;  color: #333; font-size: 10pt; text-decoration: none; font-family: arial; font-weight: bold }
		body { background-color: #333 }
	</style>
	<script>
		$(document).ready(function() {
			$("#username").focus();
			$('.fancybox').fancybox({
					openEffect : 'none',
					closeEffect : 'none',
					prevEffect : 'none',
					nextEffect : 'none',

					arrows : false,
					helpers : {
						media : {},
						buttons : {}
					});
		});
	</script>
</head>

<body>
<?php
	if ($username == null) {
?>
	<form name="frm" method="post">
	<?php echo $msg; ?>
	<input type="text" placeholder="username" id="username" name="username" />
	<input type="password" placeholder="password" id="password" name="password" />
	<input type="submit" value="Login" />
	</form>
<?php
	} else {
?>
<div style="height: 28px">
	<form method="post" style="margin: 0; padding: 0">
		<input type="text" maxlength="2" size="2" name="day" id="day" value="<?php echo $day?>" placeholder="Day" />
<input type="text" maxlength="2" size="2" name="month" id="month" value="<?php echo $month?>" placeholder="Month" />
		<input type="text" maxlength="4" size="4" name="year" id="year" value="<?php echo $year?>" placeholder="Year" />		
		<input type="submit" value="Show" />
		<input type="button" value="Log Out"style="color: #f00" onclick="document.location.href='?cmd=logout'" />
	</form>
</div>
<div style="width: 100%; height: 90%; overflow: auto">
<?php

		$dirpath = ".";
		$dh = opendir($dirpath);
		while (false !== ($file = readdir($dh))) {
			if (!is_dir("$dirpath/$file")) {
				if (strlen($file) > 38) {
					//78A5DD021178(002kdmf)_1_20120921222750_3
					$filename = htmlspecialchars(ucfirst(preg_replace('/\..*$/', '', $file)));
					if (substr($filename, 24, 8) == $ymd)  {
						$tarih = substr($filename, 24, 12);
						//2012092216
						$tarih = substr($tarih, 8, 2) . ":" . substr($tarih, 10, 2);
						echo "<a href='$file' class='fancybox'><div class='lst' style='background-image:url(\"$file\")'>$tarih</div></a>";
					}
				}
			}
		}  
		closedir($dh); 
	}
?>
</div>
</body>
</html>
