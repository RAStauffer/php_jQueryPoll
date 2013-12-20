<?php
ob_start ();
session_start ();

include_once ("controller/Controller.php");
?>
<!DOCTYPE HTML">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/mvccss.css" type="text/css">
<link rel="stylesheet" href="poll.css" type="text/css">
<script src="jquery-1.9.0.min.js" type="text/javascript">
</script>
<script src="idle-timer.min.js" type="text/javascript">
</script>
<title>PHP jQuery Poll</title>
</head>
<body>
	<div id="wrapper">
      <?php
						// instantiate controller
						$controller = new Controller ();
						// control logic is in invoke function
						$controller->invoke ();
						?>
    </div><?php
				ob_end_flush ();
				?>
  </body>
</html>
