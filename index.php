<?php
	//Here set domain for the result to give, must end in filename and ?s= for the argument
	$domain = 'https://example.com/index.php?s=';
	//Change 'db.db' with the database file name, or leave 'db.db' for the sample database
	//Database is SQLite3 and has the following: table 'short' with the following columns: short TEXT NOT NULL UNIQUE, long TEXT NOT NULL UNIQUE, epoch INTEGER NOT NULL
   	$db = new SQLite3('db.db');
	
	if (isset($_GET['l'])) {
    	$shorted = uniqid();
    	$time = time();
    	$db->exec("INSERT INTO short VALUES('" . $shorted . "','" . $_GET['l'] . "'," . $time .")");
    	echo $domain . $shorted;
	} else {
    	if (isset($_GET['s'])) {
			$stmt = $db->query("SELECT long FROM short WHERE shorted IS  '" . $_GET['s'] . "'" );
			$data = $stmt->fetchArray();
			//echo $data[0];
			header('Location: ' . $data[0]);
			exit;
		} else {
    		echo "No parameter given => No result";
		}
	}	
?>