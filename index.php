<?php
	$USERNAME = "admin";
	$PASSWORD = "123456";

	session_start(); 
	if ($_GET["cmd"] == "logout") $_SESSION["username"] = ""; 
	$msg = "";
	
	$year = date("Y"); 
	$month = date("m");
	$day = date("d");
	$date = $_POST["date"];
	if ($date != "") {		
		$d = explode(".", $date);
		$day = $d[0];
		$month = $d[1];
		$year = $d[2];	
	}

	if (strlen($month) < 2) $month = "0" . $month;
	if (strlen($day) < 2) $day = "0" . $day;
	$ymd = $year . $month . $day;	
	$dmy = "$day.$month.$year";


	if ($_POST["username"] != "") {
		if (($_POST["username"] == $USERNAME) & ($_POST["password"] == $PASSWORD)) {
			$_SESSION["username"] = $USERNAME;
		} else {
			$msg = "<div style='color: #f0f0'>wrong username or password!</div>";
		}
	}

	$username = $_SESSION["username"];

	if ($username == "") {
		pageheader();
		login();
		footer();	
	} else if ($date == "") {
		if ($_POST["datesubmit"] != "yes") {
			pageheader();
			form();
			footer();
		}
	} else {
		images($ymd);	
	}
?>

<?php function pageheader() {?>
<html>
<head>
	<title>Uranium SIP-10A IP Network Wireless Siyah IP Kamera</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<link rel="stylesheet" href="./fancy/jquery.fancybox.css?v=2.1.0" media="screen" />
	<link rel="stylesheet" href="./fancy/helpers/jquery.fancybox-buttons.css?v=1.0.3" />
	<link rel="stylesheet" href="./fancy/helpers/jquery.fancybox-thumbs.css?v=1.0.6" />
	<link rel="stylesheet" href="./fancy/themes/ui-lightness/jquery.ui.all.css">
	<link rel="stylesheet" href="./fancy/default.css">
	<script src="./fancy/jquery-1.8.0.min.js"></script>
	<script src="./fancy/jquery.mousewheel-3.0.6.pack.js"></script>
	<script src="./fancy/jquery.fancybox.js?v=2.1.0"></script>
	<script src="./fancy/helpers/jquery.fancybox-buttons.js?v=1.0.3"></script>
	<script src="./fancy/helpers/jquery.fancybox-thumbs.js?v=1.0.6"></script>
	<script src="./fancy/helpers/jquery.fancybox-media.js?v=1.0.3"></script>
	<script src="./fancy/ui/jquery.ui.core.js"></script>
	<script src="./fancy/ui/jquery.ui.widget.js"></script>
	<script src="./fancy/ui/jquery.ui.datepicker.js"></script>
	<script src="./fancy/main.js"></script>
</head>

<body>
<?php } ?>

<?php function login() {?>
	<form name="frm" method="post">
	<?php echo $msg; ?>
	<input type="text" placeholder="username" id="username" name="username" />
	<input type="password" placeholder="password" id="password" name="password" />
	<input type="submit" value="Login" />
	</form>
<?php } ?>


<?php function form() { ?>

<div style="height: 28px">
	<form method="post" style="margin: 0; padding: 0" id="dtform">
		<input type="text" id="datepicker" name="date" id="date" value="<?php echo $dmy; ?>" size="10" maxlength="10" />
		<input type="hidden" name="datesubmit" id="datesubmit" value="yes" />
		<input type="submit" value="Show" />
		<input type="button" value="Log Out"style="color: #f00" onclick="document.location.href='?cmd=logout'" />
	</form>
</div>
<div id="images">
</div>
<?php } ?>

<?php
function images($ymd) {
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

<?php function footer() {?>
</body>
</html>
<?php } ?>

