<?php require('database.php'); ?>

<?php


$sql = "
select trans_date as trans_date, description, category, Pos_Amount as amount from Expenses.data 
where Date2 = '2015-11' ";

// if($cat != 'TOTAL'){
// 	$sql .= " and category = '{$cat}' ";
// }

$sql .= "
order by amount desc
limit 3
";


$result = mysqli_query($db->db,$sql);

$data = array();

while($row = mysqli_fetch_array($result)) {			

$data[] =  $row['trans_date'];
$data[] = $row['description'];
$data[] =  $row['amount'];

} // end of while		


$jsondata = json_encode($data,JSON_NUMERIC_CHECK);
echo $jsondata;






?>