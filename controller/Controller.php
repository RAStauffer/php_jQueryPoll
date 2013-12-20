<?php
include_once ("model/Model.php");
class Controller {
	public $model;
	public $params;
	public $siteRoot;
	public function __construct() {
		// setup Model
		$this->model = new Model ();
		import_request_variables ( "gp" );
		$path = $_SERVER ['PATH_INFO'];
	}
	function getPath() {
		return $path;
	}
	function checkAuth() {
		// Authetication check
		$user_id = $_COOKIE ["user_id"];
		if (! is_numeric ( $user_id )) {
			return false;
		} else
			return true;
	}
	public function invoke() {
		$userAuthorized = $this->checkAuth ();
		$path = $this->getPath ();
		include ('view/menu.php');
		
		if ($_GET ['pollDetail']) {
			$poll = $this->model->getPollDetail ( ($_GET ['id']) );
			$answers = $this->model->getAnswers ( $poll ['answers_id'] );
			include 'view/poll_detail.php'; /* Use jQuery to animate Poll results */
			return;
		}
		
		if ($_GET ['login']) {
			include 'view/login.php';
			return;
		}
		if ($_GET ['logout']) {
			setcookie ( "user_id", null );
			header ( "Location: index.php" );
			exit ();
		} elseif ($_GET ['authUser']) {
			// check for a user match
			$row = $this->model->authUser ( $_POST ['username'], $_POST ['password'] );
			if ($row) {
				// Set a cookie and display the add news form
				setcookie ( "user_id", $row ['id'] );
				header ( "Location: index.php" );
				exit ();
			}
			// Return to login.php and displays auth failed message
			header ( "Location: index.php?login=1" . "&message=Login Failed! Please try again." . "&msgColor=red" );
			exit ();
		} elseif ($_GET ['addPoll']) {
			if ($_POST ['submitted']) {
				$ansId = $this->model->addAnswers ( $_POST ['answer1'], $_POST ['answer2'], $_POST ['answer3'], $_POST ['answer4'], $_POST ['answer5'], $_POST ['answer6'], $_POST ['answer7'], $_POST ['answer8'], $_POST ['answer9'], $_POST ['answer10'], $_POST ['answer11'], $_POST ['answer12'], $_POST ['answer13'], $_POST ['answer14'], $_POST ['answer15'] );
				$this->model->addPoll ( $_POST ['question'], $ansId );
				header ( "Location: index.php" );
				exit ();
			}
			if ($this->checkAuth ()) {
				include ('view/add_poll.php');
				exit ();
			} else {
				// Return to login.php and displays auth failed message
				header ( "Location: index.php?login=1" . "&message=Login before adding poll." . "&msgColor=red" );
				exit ();
			}
		} elseif ($_GET ['vote']) {
			
			$poll = $this->model->getPollDetail ( ($_GET ['pollId']) );
			$answers = $this->model->getAnswers ( $poll ['answers_id'] );
			
			if ($_POST ['submitted']) {
				$voteName = "votes" . $_POST ['voteNum'];
				$pollId = "Poll" . $poll ['id'];
				/* if ( $_COOKIE[$pollId] != $pollId) */ /* Disallow multiple votes */
				if (true) /* Allow multiple votes */
				{
					$this->model->updateVote ( $voteName, $answers [0] ['id'] );
					setcookie ( $pollId, $pollId );
					setcookie ( "voter_ip", $_SERVER [REMOTE_ADDR] );
				} else {
					header ( "Location: index.php" . "?message=You may only vote once" . "&msgColor=red" );
					/* echo "You may only vote once"; */
					exit ();
				}
				header ( "Location: index.php" );
				/* include 'view/poll_detail.php'; /* Use jQuery to animate Poll results */
				exit ();
			}
		} elseif ($_GET ['updatePoll']) {
			if (! $this->checkAuth ()) {
				// Return to login.php and displays auth failed message
				header ( "Location: index.php?login=1" . "&message=Login before updating poll." . "&msgColor=red" );
				exit ();
			}
			
			$poll = $this->model->getPollById ( $_GET ['id'] );
			if ($_POST ['submitted']) {
				$ansId = $this->model->updateAnswers ( $_POST ['answer1'], $_POST ['answer2'], $_POST ['answer3'], $_POST ['answer4'], $_POST ['answer5'], $_POST ['answer6'], $_POST ['answer7'], $_POST ['answer7'], $_POST ['answer8'], $_POST ['answer10'], $_POST ['answer11'], $_POST ['answer12'], $_POST ['answer13'], $_POST ['answer14'], $_POST ['answer15'], $poll ['id'] );
				$this->model->updatePoll ( $_POST ['question'], $_GET ['id'] );
				header ( "Location: index.php" );
				exit ();
			}

			$poll = $this->model->getPollDetail ( ($_GET ['id']) );
			$answers = $this->model->getAnswers ( $poll ['answers_id'] );	
			$_SESSION["question"] = $poll ['question'];
			$_SESSION["answer1"] = $answers[0][1];
			$_SESSION["answer2"] = $answers[0][2];
			$_SESSION["answer3"] = $answers[0][3];
			$_SESSION["answer4"] = $answers[0][4];
			$_SESSION["answer5"] = $answers[0][5];
			$_SESSION["answer6"] = $answers[0][6];
			$_SESSION["answer7"] = $answers[0][7];
			$_SESSION["answer8"] = $answers[0][8];
			$_SESSION["answer9"] = $answers[0][9];
			$_SESSION["answer10"] = $answers[0][10];
			$_SESSION["answer11"] = $answers[0][11];
			$_SESSION["answer12"] = $answers[0][12];
			$_SESSION["answer13"] = $answers[0][13];
			$_SESSION["answer14"] = $answers[0][14];
			$_SESSION["answer15"] = $answers[0][15];

			include 'view/update_poll.php';
		} elseif ($_GET ['removePoll']) {
			if (! $this->checkAuth ()) {
				// Return to login.php and displays auth failed message
				header ( "Location: index.php?login=1" . "&message=Login before removing news." . "&msgColor=red" );
				exit ();
			}
			/* TODO: Remove answers of this poll */
			if ($this->model->removePoll ( $_GET ['id'] )) {
				header ( "Location: index.php" );
				exit ();
			}
		}
		
		// get model data for view
		$polls = $this->model->getPolls ();
		include 'view/polls_summary.php';
	}
}

?>