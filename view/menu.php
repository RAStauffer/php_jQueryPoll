<div id="pollMenu">
	<a class="pollButton" href="index.php">Polls</a>
<?php
if ($userAuthorized)
	echo "<a class='pollButton' href='index.php?logout=1'>Logout</a>";
else
	echo "<a class='pollButton' href='index.php?login=1'>Login</a>";
?>
<a class="pollButton" href="index.php?addPoll=1">Add Poll</a>
</div>