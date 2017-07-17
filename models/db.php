<?php

class DataBase {

	public function openDB() {
		
		if ( !mysql_connect("localhost", "root", "") )
			throw new Exception("Connection to the database server failed!");
		
		if ( !mysql_select_db("mydb") )
			throw new Exception("No MyBD database found on database server.");
	}

	public function closeDB() {
		mysql_close();
	}


	public function runQuery($statement) {	
		$this->openDB();
		if(stristr($statement, "select") && (!stristr($statement, "insert"))) 
			return $this->returnResult(mysql_query($statement)); 
		elseif(stristr($statement, "insert")) {
			
			return mysql_query($statement);
		}
		elseif(stristr($statement, "update")) 
			return mysql_query($statement); 
		elseif(stristr($statement, "delete"))
			return mysql_query($statement); 
		else 
			return  "Errro with query ".$statement;	
		$this->closeDB();			
	}

	public function returnResult($query) {
		while ( ($object = mysql_fetch_object($query)) != NULL ) {
			$result[] = $object;
		}
		return isset($result) ? $result : false;
	}
	
}

?>