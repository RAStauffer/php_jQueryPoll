<?php
if ($_GET ['message'])
	$msg = $_GET ['message'];
$color = $_GET ['msgColor'];
echo "<div style=\"color:$color;font-size: 18px;\">" . $msg . "</div>";
?>
<div class="summaryItem">
	<table>
		<tbody>
			<?php
			foreach ( $polls as $poll ) {
				echo "<tr>";
				echo "<td><a href='index.php?pollDetail=1&id=" . $poll ['id'] . "'>" . $poll ['question'] . "</a></td>";
				if ($userAuthorized) {
					/*echo "<td><a class='button' href='index.php?updatePoll=1&id=" . $poll['id'] ."'>Update</a></td>"; */
					echo "<td><a class='button' href='index.php?removePoll=1&id=" . $poll ['id'] . "'>Remove</a></td>";
				}
				echo "</tr>";
			}
			
			reset ( $polls );
			?>
		</tbody>
	</table>
</div>
