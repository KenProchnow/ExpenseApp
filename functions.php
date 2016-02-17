<?php require('database.php'); ?>

<?php


// these sections below build the data for what is used in the select tabs.


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

//convert array into json
$cost_categories = json_encode($cost_categories);
//---------------------------------------------------------------

//---------------------------------------------------------------
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
//convert array into json
$dates = json_encode($dates);
//---------------------------------------------------------------


?>