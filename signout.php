<?php
include_once ('DB.php');
include_once('user.php');

$db = DB::getInstance();
if ($db->connect_errno) {
	echo 'Database connection problem: ' . $db->connect_errno;
	exit();
}
$user = new User($db);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Test Sign In</title>
	<meta charset="utf-8" />
</head>
<body>
	<?php
		if (!$user->check_signed()) {
			include('register.php');

			exit();
			
		}else{
			echo "<h3>You have already signed in</h3>";
			?>
			<a href='signout.php?signOut'>Sign Out</a>
			
			<?php
		}
	?>
</body>
</html>
