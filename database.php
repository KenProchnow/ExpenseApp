
<?php
class Database{

	public $servername = "localhost";
	public $username = "root";
	public $password = "root";
	public $dbname = "expenses";
	public $db;
	public $last_query;
	public $num_rows;
	
	public function __construct(){
		$this->db = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);
		self::test_connection();
	}	

	private function confirm_query($resource){
		if(!$resource){
			$output = "query failed: " . mysqli_error() . "<br>";
			$output .= "Last query " . $this->last_query;
			die($output);

		}
	}
	
	public function test_connection(){
		if (!$this->db) {
	    die("Connection failed: " . mysqli_connect_error());
		}else{
			// echo "connected";
		}	
	}

	// takes sql and returns a resource. the resource is to be used by another method.
	public function fetch_all($sql=""){
		$resource = $this->query($sql);
		return $resource;
	}

	// this is needed all the time, pass a sql message to the db and return the resource.
	public function query($sql=""){				
		$resource = mysqli_query($this->db,$sql);		
		$this->last_query = $sql;
		// $this->num_rows = mysqli_num_rows($resource);
		$this->confirm_query($resource);
		return $resource;
	}

	// needed a lot. from the resource get the first array.
	public function fetch_array($resource){
		return mysqli_fetch_array($resource);
	}

	public function display_data_in_table($sql){		
		$this->last_query = $sql;
		$result = mysqli_query($this->db,$sql);

		if (mysqli_num_rows($result) > 0) {			
		
			$finfo = mysqli_fetch_fields($result);
			echo "<table class='table'>";
			echo "<tr>";
			foreach ($finfo as $val) {			
				echo "<td>";
				$self = $_SERVER['PHP_SELF'];
				echo "<b>" . $val->name . "<b></a>";
				echo "</td>";
			}
			echo "<td><b>custom</b></td>";
			echo "</tr>";
				
			while($row = mysqli_fetch_array($result)) {			
				echo "<tr>";				 				
				for($x = 0; $x < count($finfo);$x++){			
		 			echo "<td>";
					echo $row[$x];
					echo "</td>";				
				}
				echo "<td><a href='#'><button>custom</button></a></td>";
				echo "</tr>"; 			
			} // end of while		
			echo "</table>";  		
			// echo "<input type='submit' value='delete'>";
			echo "</form>";
		} else {
		  echo "0 results";
		}
	}
	
	public function num_rows($resource){
		return mysqli_num_rows($resource);
	}

	public function insert_id(){
		return mysqli_insert_id($this->db);
	}

	public function affected_rows(){
		return mysqli_affected_rows($this->db);
	}  
	public function close_connection(){
		mysqli_close($this->db);
	}  
	
}


// instantiate the database class, makes a connection, gives our user class access to it, and allows for other query methods, etc..
$db = new Database();


?>