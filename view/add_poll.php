<form action="index.php?addPoll=1" method="post" class="addPoll">
	Question<br />
	<textarea cols="46" rows="5" name="question">
<?php echo (isset($_SESSION["question"]) ? $_SESSION["question"] : "");?>
</textarea>
	<br />Answers<br /> <input type="text" name="answer1"
		value="<?php echo (isset($_SESSION["answer1"]) ? $_SESSION["answer1"] : ''); ?>" />
	<br /> <input type="text" name="answer2"
		value="<?php echo (isset($_SESSION["answer2"]) ? $_SESSION["answer2"] : ''); ?>" />
	<br /> <input type="text" name="answer3"
		value="<?php echo (isset($_SESSION["answer3"]) ? $_SESSION["answer3"] : ''); ?>" />
	<br /> <input type="text" name="answer4"
		value="<?php echo (isset($_SESSION["answer4"]) ? $_SESSION["answer4"] : ''); ?>" />
	<br /> <input type="text" name="answer5"
		value="<?php echo (isset($_SESSION["answer5"]) ? $_SESSION["answer5"] : ''); ?>" />
	<br /> <input type="text" name="answer6"
		value="<?php echo (isset($_SESSION["answer6"]) ? $_SESSION["answer6"] : ''); ?>" />
	<br /> <input type="text" name="answer7"
		value="<?php echo (isset($_SESSION["answer7"]) ? $_SESSION["answer7"] : ''); ?>" />
	<br /> <input type="text" name="answer8"
		value="<?php echo (isset($_SESSION["answer8"]) ? $_SESSION["answer8"] : ''); ?>" />
	<br /> <input type="text" name="answer9"
		value="<?php echo (isset($_SESSION["answer9"]) ? $_SESSION["answer9"] : ''); ?>" />
	<br /> <input type="text" name="answer10"
		value="<?php echo (isset($_SESSION["answer10"]) ? $_SESSION["answer10"] : ''); ?>" />
	<br /> <input type="text" name="answer11"
		value="<?php echo (isset($_SESSION["answer11"]) ? $_SESSION["answer11"] : ''); ?>" />
	<br /> <input type="text" name="answer12"
		value="<?php echo (isset($_SESSION["answer12"]) ? $_SESSION["answer12"] : ''); ?>" />
	<br /> <input type="text" name="answer13"
		value="<?php echo (isset($_SESSION["answer13"]) ? $_SESSION["answer13"] : ''); ?>" />
	<br /> <input type="text" name="answer14"
		value="<?php echo (isset($_SESSION["answer14"]) ? $_SESSION["answer14"] : ''); ?>" />
	<br /> <input type="text" name="answer15"
		value="<?php echo (isset($_SESSION["answer15"]) ? $_SESSION["answer15"] : ''); ?>" />
	<br /> <input type="submit" name="submit" value="Submit" /> <input
		type="hidden" name="submitted" value="true" />

</form>
