<?php require('database.php'); ?>

<?php

// class Database_Object{
// 	global $db = $db->db;

// 	public $sql = "";	

// 	public function query($this->sql){

// 	}
// }

// $db_obj = new Database_Object();

// $db_obj->query($sql);

$sql ="
SELECT distinct Date2 
FROM Expenses.data
order by Date2 DESC
";

$resource = mysqli_query($db->db,$sql);
$dates = array();
$dates[] = 'TOTAL';
while ($row = mysqli_fetch_assoc($resource)){ 
  // echo $row['date'] . "," .
  $dates[] = $row['Date2'];
}


if ( isset($_GET['count']) ) {
	$count = $_GET['count'];
}else {
	$count = 0;	
}

$date_selected = $dates[$count];


$sql = "select 
category,
COALESCE(SUM(pos_amount), 0) as sum
FROM Expenses.data 
";

if($count != 0){
$sql .= " where Date2 = '{$date_selected}' ";  
}

$sql .= " group by category
order by sum desc
";


$category = array();
$category['name'] = 'cost';
$series = array();
$series['name'] = 'sum';

$resource = mysqli_query($db->db,$sql);
while ($row = mysqli_fetch_assoc($resource)){ 
  // echo $row['date'] . "," .
  $category['data'][] = $row['category'];   
  $series['data'][] = $row['sum'];


}

$result = array();
array_push($result, $category);
array_push($result, $series);

$jsondata = json_encode($result,JSON_NUMERIC_CHECK);
echo $jsondata

// echo "<pre>";
// print_r($x);
// print_r($y);
// echo "</pre>";

  // echo json_encode($x);
  // echo json_encode($y);












?>