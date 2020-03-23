<?php
class Database{
	
	private $host  = 'localhost';
    private $user  = 'root';
    private $password   = "namasaya";
    private $database  = "flip"; 
    
    public function getConnection(){		
		$conn = new mysqli($this->host, $this->user, $this->password, $this->database);
		if($conn->connect_error){
			die("Error failed to connect to MySQL: " . $conn->connect_error);
		} else {
			return $conn;
		}
	}
	
	public function migrate(){
		$link = mysqli_connect($this->host, $this->user, $this->password, $this->database);

		if ($link === false) {
			die("ERROR: Could not connect. " . mysqli_connect_error());
		}

		$table1 = "CREATE TABLE seller (
				id INT(11) NOT NULL AUTO_INCREMENT,
				name VARCHAR(255) NOT NULL,
				email VARCHAR(255) NOT NULL,
				phone VARCHAR(255) NOT NULL,
				active_balance INT(15) NOT NULL,
				bank_code VARCHAR(20) NOT NULL,
				account_number VARCHAR(15) NOT NULL,
				PRIMARY KEY (id));";

		$table2 = "CREATE TABLE transaction (
				id INT(11) NOT NULL AUTO_INCREMENT,
				disburse_id BIGINT (15) NOT NULL,
				user_id INT(11) NOT NULL,
				amount INT(15) NOT NULL,
				status VARCHAR(10) NOT NULL,
				receipt VARCHAR(255),
				remark VARCHAR(255) NOT NULL,
				time_served TIMESTAMP NOT NULL,
				fee int(5) NOT NULL,
				PRIMARY KEY (id),
				FOREIGN KEY (user_id) REFERENCES seller(id));";

		$data1 = "INSERT INTO `seller`(`name`, `email`, `phone`, `active_balance`, `bank_code`, `account_number`) 
				VALUES (\"John Doe\",\"john.doe@gmail.com\",\"02150928829\",5000000, \"021\", \"123456789\");";

		$sql = [$table1, $table2, $data1];
		foreach ($sql as $key => $value) {
			if (mysqli_query($link, $value)) {
				echo "Database created successfully\n";
			} else {
				echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
			}
		}

		mysqli_close($link);

	}
}
