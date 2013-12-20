<?php
if ($_GET ['message'])
	$msg = $_GET ['message'];
$color = $_GET ['msgColor'];
echo "<div style=\"color:$color;font-size: 18px;\">" . $msg . "</div>";
?>
<form action="index.php?authUser=1" method="post">
	Username<br />
	<input type="text" name="username" size=27 /><br /> Password<br />
	<input type="text" name="password" size=27 /><br />
	<br /> <input type="submit" name="authUser" value="Submit" /> <input
		type="hidden" name="submitted" value="true" />
</form>