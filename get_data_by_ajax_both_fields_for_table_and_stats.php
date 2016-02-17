<?php require('database.php'); ?>

<?php
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

function dyn_select_option($cost_categories="",$current_value=""){
	echo "<select class='form-control' name='category'>";
	foreach($cost_categories as $key => $value){
		echo "<option value='{$value}'";
		if($value == $current_value){
			echo "selected";
		}
		echo ">{$value}</option>";
		
	}
	echo "</select>";
}
//---------------------------------------------------------------
$cat = "";
$date = "";

if ( isset($_GET['cat']) ) {
	$cat = $_GET['cat'];
}
if ( isset($_GET['date']) ) {
	$date = $_GET['date'];
}

// echo $cat;
// echo $date;

//---------------------------------------------------------------
//Analytics


// select count(Pos_Amount) as count, avg(Pos_Amount) as average, sum(Pos_Amount) as sum, std(pos_amount) as std from Expenses.data 
// where category = 'Lynda'


$sql = "
select count(Pos_Amount) as count, avg(Pos_Amount) as average, sum(Pos_Amount) as sum, std(pos_amount) as std from Expenses.data 
where ";

if( $cat != 'TOTAL' ){
$sql .= "category = '{$cat}' ";
}

if( $cat != 'TOTAL' && $date != 'TOTAL'){
$sql .= " and ";
}

if( $date != 'TOTAL' ){
$sql .= " Date2 = '{$date}' ";
}

$sql .= "
order by amount desc
";

$result = mysqli_query($db->db,$sql);



while($row = mysqli_fetch_array($result)) {			
			if ( $row['count'] == 1 ){ $std = "NA"; } else { $std = number_format($row['std'],2); };			
			if ( $row['count'] == 1 || $row['count'] == 0 ){ $cov = "NA"; } else { $cov = number_format( ( $row['std'] / $row['average'] ) ,2); };
			

			echo "<div class='col-xs-2 col-med-2'><div class='well well_analytics' style='background:none;'><h4> Count </h4><h3><span class='count'>".$row['count']."</span></h3></div></div>";
			echo "<div class='col-xs-2 col-med-2'><div class='well well_analytics' style='background:none;'><h4> Daily Average </h4><h3>$".number_format($row['average'],2)." </h3></div></div>";
			echo "<div class='col-xs-2 col-med-2'><div class='well well_analytics' style='background:none;'><h4> Standard Deviation </h4><h3>".$std."</h3></div></div>";
			echo "<div class='col-xs-2 col-med-2'><div class='well well_analytics' style='background:none;'><h4> Coefficiant of Variation </h4><h3>".$cov."</h3></div></div>";			 
			echo "<div class='col-xs-2 col-med-2'><div class='well well_analytics' style='background:none;'><h4> Sum </h4><h3>$".number_format($row['sum'])."</h3></div></div>";


			
} // end of while				


// $sql = "
// select description as merchants, sum(Pos_Amount) as amount, count(Pos_Amount) as count from Expenses.data 
// where category = '{$cat}' and Date2 = '{$date}' 
// group by description
// order by amount desc
// ";


// $result = mysqli_query($db->db,$sql);

// echo "<div class='col-xs-12 col-med-12'><div class='well' style='background:none;'>";
// while($row = mysqli_fetch_array($result)) {			
// 			echo 	$row['merchants']."";
// 			echo "$".number_format($row['amount'],2)."";
// 			echo "count: ".number_format($row['count'])."";
// 			echo "<br>";
			
// } // end of while				
// echo "</div></div>";


$sql = "
select id, trans_date as trans_date, description, category, Pos_Amount as amount from Expenses.data 
where Date2 = '{$date}' ";


	

if($cat != 'TOTAL'){
	$sql .= " and category = '{$cat}' ";
}


$sql .= "
order by amount desc
";



echo "<div style='clear:both'></div>";

//---------------------------------------------------------------
// echo $sql;

// $resource = mysqli_query($db->db,$sql);

// print_r($resource);

	$result = mysqli_query($db->db,$sql);

	// while($row = mysqli_fetch_array($result)) {			
	// 		$total += $row['amount'];
	// 	}	


	if (mysqli_num_rows($result) > 0) {			
		
	
		$finfo = mysqli_fetch_fields($result);
		echo "<p><b>Detail for $cat during $date</b></p>";
		// echo $total;				 				 
		echo "<table class='table table-striped table-bordered'>";
		echo "<tr>";
		foreach ($finfo as $val) {			
			echo "<td>";
			// $self = $_SERVER['PHP_SELF'];
			echo "<b>" . $val->name . "<b></a>";
			echo "</td>";
		}

		echo "<td>";
		echo "ReClass";
		echo "</td>";

		echo "</tr>";
			
		while($row = mysqli_fetch_array($result)) {			
			echo "<tr>";				 				
			for($x = 0; $x < count($finfo);$x++){			
	 			echo "<td>";
				echo $row[$x];
				echo "</td>";					
			}
				
				echo "<td>";
				echo "<form name='form'> ";	
				$id = $row['id'];

				echo "<input type='hidden' name='id' value='$id'>";		
				dyn_select_option( $cost_categories , $row['category'] );
				
				// echo "<input type='submit' value='submit'>";				

				echo "</form>";
				// echo "<select id='category_dyn_select_list' class='form-control'>
              	// </select>";
				// echo "<a href='testing11.php?id=2'><button type='button' class='btn btn-success'>";
				// echo "Re Class";
				// echo "</button></a>";
				// echo $row['category'];
				
				echo "</td>";	

			echo "</tr>";

			
			if(!isset($total)){$total = 0;}
			$total += $row['amount'];
			if(!isset($count)){$count = 0;}
			$count += 1;
		} // end of while		


			echo "<tr>";
			echo "<td><b>";
			echo "Count:".$count;
			echo "<td></td>";
			echo "<td></td>";
			echo "<b></td>";
			echo "<td>";
			echo "<b>Total:<b>";
			echo "</td>";
			echo "<td><b>";
			echo number_format($total,2);				 				
			echo "<b></td>";	
			echo "<td>";
			
			
			echo "<button type='submit' class='btn btn-success'>Submit</button> ";
			
			echo "</td>";
			
			echo "</tr>";


		echo "</table>";  		
		// echo "<input type='submit' value='delete'>";
		echo "</form>";
	} else {
	  echo "0 results";
	}


// $result = array();
// array_push($result, $category);
// array_push($result, $series);

// $jsondata = json_encode($result,JSON_NUMERIC_CHECK);
// echo $jsondata


// echo "<pre>";
// print_r($x);
// print_r($y);
// echo "</pre>";

  // echo json_encode($x);
  // echo json_encode($y);




















//---------------------------------------------------------------
								







?>