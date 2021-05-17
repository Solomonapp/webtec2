 <?php
//acessing the database
	class DbConnect {
		//login info for database
		private $host = 'localhost';
		private $dbName = 'db1';
		private $user = 'root';
		private $password = '';

		//establishing connection
		public function connect() {
			try {
				//connecting to database using provided login details
				$conn = new PDO('mysql:host=' . $this->host . '; dbname=' . $this->dbName, $this ->user, $this ->password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				return $conn;
			} catch (PDOException $e ){
				echo 'Database Error: ' . $e->getMessage();
			}
		}

	}
?>
