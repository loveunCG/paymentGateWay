<?php

// -------------------------------------------------
//		InternetDataService ManagermentSystem
//		mySQL Class
// -------------------------------------------------

	class mySQL{
		var $conn;

		function mySQL(){			
			
  			$this->conn = mysql_connect(DB_HOST, DB_USER, DB_PASS);
			if (!$this->conn) {
				echo "Database Connection Failed.";
				exit;
			}

 			mysql_select_db(DB_NAME, $this->conn);
		}


		function exec($sql)
		{
			return mysql_query($sql, $this->conn);
		}

		function query($sql)
		{
 			return mysql_query($sql, $this->conn);
		}

		function query_all_records_db($sql)
		{
			$result = $this->query($sql);

			if(!$result) return false;
			
 			$rows = array();

			while ($row = @mysql_fetch_array ($result)) 
 			{ 
				array_push($rows, $row);
			} 
			return($rows);
		}
		
		function records_count($result)
		{
			$count = mysql_num_rows ($result);
			return $count;
		}

		function fetch_array($result)
		{
			$count = mysql_num_rows ($result);
			if($count == 0)
				return false;

			$entry = mysql_fetch_array($result);
			return $entry;
		}

		// transaction begin
		function begin()
		{
			$this->query("begin;");
		}

		// transaction commit
		function commit()
		{
			$this->query("commit;");
		}

		// transaction rollback
		function rollback()
		{
			$this->query("rollback;");
		}

		function close()
		{
			mysql_close($this->conn);
		}
	}

?>