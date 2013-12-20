<?php
class Model {
	public $db;
	public function __construct() {
	}
	function openDb() {
		
		// Connect to a MySQL database
		$this->db = mysql_connect ( "localhost", "venaura", "yabbadabba" ) or die ( 'I cannot connect to the database.' );
		mysql_select_db ( "staufr_aim" );
		return ($this->db);
	}
	function closeDb() {
		// Closing database connection
		mysql_close ( $this->db );
	}
	public function __destruct() {
	}
	public function updatePoll($question, $id) {
		$this->openDb ();
		$query = "UPDATE poll SET question =" . $question . " WHERE id = " . $id . ";";
		$result = mysql_query ( $query );
		$this->closeDb ();
	}
	
	public function updateAnswers($answer1, $answer2, $answer3, $answer4, $answer5, $answer6, $answer7, $answer8, $answer9, $answer10, $answer11, $answer12, $answer13, $answer14, $answer15, $id) {
		$this->openDb ();
		$query = "UPDATE answers SET answer1 =" . $answer1 . ", answer2 =" . $answer2 . ", answer3 =" . $answer3 . ", answer4 =" . $answer4 . ", answer5 =" . $answer5 . ", answer6 =" . $answer6 . ", answer7 =" . $answer7 . ", answer8 =" . $answer8 . ", answer9 =" . $answer9 . ", answer10 =" . $answer10 . ", answer11 =" . $answer11 . ", answer12 =" . $answer12 . ", answer13 =" . $answer13 . ", answer14 =" . $answer14 . ", answer15 =" . $answer15 . " WHERE id = " . $id . ";";
		$result = mysql_query ( $query );
		$this->closeDb ();
	}
	
	public function removePoll($id) {
		$this->openDb ();
		
		$query = "DELETE FROM poll WHERE id = " . $id;
		$result = mysql_query ( $query );
		$this->closeDb ();
		
		if ($result)
			return true;
		else
			return false;
	}
	public function getPollById($id) {
		$this->openDb ();
		
		$query = "SELECT * FROM poll WHERE id = " . $id;
		$result = mysql_query ( $query );
		$this->closeDb ();
		
		return (mysql_fetch_array ( $result ));
	}
	public function addAnswers($answer1, $answer2, $answer3, $answer4, $answer5, $answer6, $answer7, $answer8, $answer9, $answer10, $answer11, $answer12, $answer13, $answer14, $answer15) 

	{
		
		// Connect to a MySQL database
		$this->openDb ();
		
		$query = "INSERT INTO answers (answer1,answer2,answer3,answer4,answer5,answer6,answer7,answer8,answer9,answer10,answer11,answer12,answer13,answer14,answer15) ";
		
		$query .= "VALUES ('$answer1','$answer2','$answer3','$answer4','$answer5','$answer6','$answer7','$answer8','$answer9','$answer10','$answer11','$answer12','$answer13','$answer14','$answer15');";
		
		mysql_query ( $query );
		
		$ansID = mysql_insert_id ();
		$this->closeDb ();
		return ($ansID);
	}
	public function addPoll($question, $answers_id) {
		// Connect to a MySQL database
		$this->openDb ();
		
		$query = "INSERT INTO poll (question, answers_id, user_id) ";
		$query .= "VALUES ('$question', '$answers_id', '1');";
		mysql_query ( $query );
		$this->closeDb ();
	}
	public function getPollDetail($id) {
		// Connect to a MySQL database
		$this->openDb ();
		$query = "SELECT * FROM poll WHERE id = " . $id . ";";
		$result = mysql_query ( $query );
		$detail = mysql_fetch_array ( $result );
		return $detail;
	}
	public function updateVote($voteName, $id) {
		// Connect to a MySQL database
		$this->openDb ();
		
		$query = "SELECT " . $voteName . ",max FROM answers WHERE id = " . $id . ";";
		
		$result = mysql_query ( $query );
		$votes = mysql_fetch_array ( $result );
		$votes [$voteName] += 1;
		if ($votes [$voteName] > $votes ['max'])
			$votes ['max'] = $votes [$voteName];
		$query = "UPDATE answers SET " . $voteName . " =" . $votes [$voteName] . ", max =" . $votes ['max'] . " WHERE id = " . $id . ";";
		
		$result = mysql_query ( $query );
		
		$detail = mysql_fetch_array ( $result );
		
		return $detail;
	}
	public function authUser($username, $password) {
		// Connect to a MySQL database
		$this->openDb ();
		
		// Build the database query
		$query = "SELECT * FROM poll_users WHERE ";
		$query .= "username = '$username' AND ";
		$query .= "password = '$password' AND ";
		$query .= "status = 'enabled'";
		// Execute the query and fetch the results
		$result = mysql_query ( $query );
		
		$this->closeDb ();
		$row = mysql_fetch_array ( $result );
		
		return $row;
	}
	public function getPolls() {
		$this->openDb ();
		$rtnLinkArr = array ();
		
		// Perform SQL query to get array of all links
		$query = 'SELECT * FROM poll';
		$result = mysql_query ( $query ) or die ( 'Query failed: ' . mysql_error () );
		$this->closeDb ();
		
		// create array of link arrays
		while ( $row = mysql_fetch_array ( $result ) ) {
			array_push ( $rtnLinkArr, $row );
		}
		
		return $rtnLinkArr;
	}
	public function getAnswers($ansId) {
		$this->openDb ();
		
		$rtnLinkArr = array ();
		
		// Perform SQL query to get array of all links
		
		$query = "SELECT * FROM answers WHERE ";
		$query .= "id = $ansId";
		
		$result = mysql_query ( $query ) or die ( 'Query failed: ' . mysql_error () );
		
		$this->closeDb ();
		
		// create array of link arrays
		
		while ( $row = mysql_fetch_array ( $result ) ) 

		{
			
			array_push ( $rtnLinkArr, $row );
		}
		
		return $rtnLinkArr;
	}
}

?>