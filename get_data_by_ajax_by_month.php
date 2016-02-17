<?php require('database.php'); ?>

<?php

// header('Content-Type: application/json');


//---------------------------------------------------------------
// get distinct categories from db, ordered by total spend, and create an array of them to use
// in a dynamic select tab
$sql ="
select distinct category from
(
SELECT category, 
sum(pos_amount) 
FROM Expenses.data
group by category
order by sum(pos_amount) desc
) as sub
";
$resource = mysqli_query($db->db,$sql);
$cost_categories = array();
$cost_categories[] = 'TOTAL';
while ($row = mysqli_fetch_assoc($resource)){ 
  // echo $row['date'] . "," .
  $cost_categories[] = $row['category'];
}
//---------------------------------------------------------------

if ( isset($_GET['count']) ) {
	$count = $_GET['count'];
}else {
	$count = 0;	
}


$category = $cost_categories[$count];


$sql = "select sub1.date as date, ifnull(sub2.sum,0) as sum from 
( select distinct date_format(post_date,'%Y-%m') as date from Expenses.data ) as sub1
left join 
( select date_format(post_date,'%Y-%m') as date, COALESCE(SUM(pos_amount), 0) as sum from Expenses.data
";

if($count != 0){
$sql .= " where category = '{$category}' ";  
}

$sql .= " group by date order by date ) sub2
on sub1.date = sub2.date
";

$category = array();
$category['name'] = 'date';
$series = array();
$series['name'] = 'sum';

$resource = mysqli_query($db->db,$sql);
while ($row = mysqli_fetch_assoc($resource)){ 
  // echo $row['date'] . "," .
  $category['data'][] = $row['date'];   
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