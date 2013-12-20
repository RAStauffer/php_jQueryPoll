<?php
$max = $answers [0] ['max'];
$bar_px = array (
		11 
);
for($ans = 1; $answers [0] [$ans] != null; $ans ++) {
	$bar_px [$ans] = $answers [0] [$ans + 16] / $max * 300;
}
?>
<script>

	
	halt = false;
	function sethalt(e) {
		halt = e;
	}
	$(document).ready(function() {
			$.idleTimer(60000);
			$(document).bind("idle.idleTimer", function(){
 				// user is idle for 3 minutes
 				if (!halt) {
	 				location.reload();
	 			}
			});
	    	//$("#clickhere").click(function() {
	    	<?php for ($ans=1;$answers[0][$ans] != null; $ans++) {?> 
	        $("#bar<?php echo $ans;?>").animate({ 
	        	top: "<?php echo 300-$bar_px[$ans];?>px",
	            width: "50px", 
	            height: "<?php echo $bar_px[$ans];?>px", 
	        }, <?php echo $bar_px[$ans];?> * 5);
	       	<?php }?> 
	}); 
</script>
<div id="wrapper">

	<div id="bars_container">
		<?php for ($ans=1;$answers[0][$ans] != null; $ans++) {?>
		<?php if ($bar_px[$ans] != 0) {?>
		<div class="group">
			<div class="bkgnd<?php echo $ans;?>" id="bar<?php echo $ans;?>">
				<div class="answerCount"><?php echo $answers[0][$ans+16];?></div>
			</div>
		</div>
		<?php
			
} else {
				echo "<div class=\"group\"><img class=\"emptyAnswer\" src=\"view/sadFace.png\" alt=\"Sad face\"></div>";
			}
		}
		?>
	</div>

	<?php echo "<div class='pollDetail'>" . "<h1>" . $poll['question'] . "</h1>"; ?>
	
	<div class="form">
		<form action="index.php?vote=1&pollId=<?php echo $_GET['id'];?>"
			method="post">
				<?php for ($ans=1;$answers[0][$ans] != null; $ans++) {?>
			<div class="bkgnd<?php echo $ans;?>" id="button<?php echo $ans;?>">

				<input onclick="sethalt(true)" type="radio" name="voteNum"
					value="<?php echo $ans?>" />
				<?php echo $answers[0][$ans]?>
				</div>
				<?php }?>
			<input type="submit" value="Submit Choice" /> <input type="hidden"
				name="submitted" value="true" />
		</form>
	</div>
</div>
