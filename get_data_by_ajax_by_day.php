<?php require('database.php'); ?>

<?php

// header('Content-Type: application/json');

// $sql = "select distinct date_format(post_date,'%Y-%m') as date from Expenses.data";
// $resource = mysqli_query($db->db,$sql);

// while ($row = mysqli_fetch_assoc($resource)){ 
//   // echo $row['date'] . "," .
//   $dates[] = $row['date'];   
// }




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
// echo "<pre>";
// print_r($dates2);
// echo "</pre>";

// $dates = array(
// 'TOTAL',
// '2014-06',
// '2014-07',
// '2014-08',
// '2014-09',
// '2014-10',
// '2014-11',
// '2014-12',
// '2015-01',
// '2015-02',
// '2015-03',
// '2015-04',
// '2015-05',
// '2015-06',
// '2015-07',
// '2015-08',
// '2015-09',
// '2015-10',
// '2015-11',
// '2015-12'
// );

// echo print_r($dates);


$cat = "";
$date = "";

if ( isset($_GET['date']) ) {
	$date = $_GET['date'];
}else {
	$date = "";	
}

if ( isset($_GET['cat']) ) {
	$cat = $_GET['cat'];
}

// $cat = "TOTAL";
// $date = "TOTAL";

if($cat == 'TOTAL'){
	$cat = "";
}
if($date == 'TOTAL'){
	$date = "";
}

// echo $cat;
// echo $date;

// $date_selected = $dates[$count];


$sql = "select 
trans_date,
COALESCE(SUM(pos_amount), 0) as sum
FROM Expenses.data 
";

if($date != "" || $cat != ""){
$sql .= " where ";	
}


if($date != ""){
$sql .= " Date2 = '{$date}' ";  
}

if($date != "" && $cat != ""){
$sql .= " and ";	
}


if( $cat != '' ){
$sql .= " category = '{$cat}' ";
}

$sql .= " group by trans_date
order by trans_date asc
";

// echo $sql;


$category = array();
$category['name'] = 'date';
$series = array();
$series['name'] = 'sum';

$resource = mysqli_query($db->db,$sql);
while ($row = mysqli_fetch_assoc($resource)){ 
  // echo $row['date'] . "," .
  $category['data'][] = $row['trans_date'];   
  $series['data'][] = $row['sum'];


}

$result = array();
array_push($result, $category);
array_push($result, $series);

$jsondata = json_encode($result,JSON_NUMERIC_CHECK);
echo $jsondata;

// echo "<pre>";
// print_r($x);
// print_r($y);
// echo "</pre>";

  // echo json_encode($x);
  // echo json_encode($y);












?>