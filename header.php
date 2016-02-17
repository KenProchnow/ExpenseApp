


<!-- To Make Unresponsive -->
<!-- Note that the .navbar-collapse and .collapse classes have been removed from the #navbar -->
<!-- Note there is no responsive meta tag here -->
<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
<!-- set the container to a fixed width 
.container, .container-fluid{
  width: 900px;
} -->

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- The above 2 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta name="description" content="">
<meta name="author" content="">

<!-- ****************     CSS      ************************* -->
<!-- Bootstrap core CSS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">

<!-- ****************     CSS      ************************* -->

<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />



<!-- ****************     CSS      ************************* -->
<!-- Custom styles for this template -->
<link href="css/non-responsive.css" rel="stylesheet">
<style type="text/css">
.container, .container-fluid{
  /*padding:0px !important;*/
/*  width: 900px;*/
}
.col-xs-4{
  background-color: white !important;
  border: none !important;
}
body {
  padding-top: 0px !important;
  padding-bottom: 30px;
}
.sidebar{
  background-color: #f2f2f2;
  padding-bottom: 800px;
  /*border-color: #ddd;*/
}
.navbar{
  margin-bottom: 0px !important;
  border-radius: 0px !important;
}
.content{
  padding-top:20px;

}
.active{
 color: red;
}
</style>


<!-- **************     HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries ************** -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

</head>

<body>


<!-- ************************      START OF PAGE       ******************** -->
<div class="container-fluid">




<div class="row">
<!-- ************************      MAIN NAV BAR       ******************** -->

    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse">      
        <div class="navbar-header">
          <!-- The mobile navbar-toggle button can be safely removed since you do not need it in a non-responsive implementation -->
          <a class="navbar-brand" href="#">Expense App</a>          
          <a class="navbar-brand" href="#">WeekDay Stats</a>          
          <a class="navbar-brand" href="#">Expenses by Day</a>          
          <a class="navbar-brand" href="#">Multi Series Comparisons</a>          
          <a class="navbar-brand" href="#">ETL Builder</a> 
          <span style="color:white" class="count">10000</span>         
          <span style="color:white" class="count">20000</span>         
          <span style="color:white" class="count">30000</span>         

        </div>

        <!-- Note that the .navbar-collapse and .collapse classes have been removed from the #navbar -->


        <div id="navbar">
        
          <!-- <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
          </ul> -->


          <!-- <form class="navbar-form navbar-left" role="search">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
          </form> -->

          <!-- <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Link</a></li>
            <li><a href="#">Link</a></li>
            <li><a href="#">Link</a></li>
          </ul> -->

        </div><!--/.nav-collapse -->      
    </nav>

</div>  <!-- END OF ROW -->





<div class="row"> 

<?php
/*
<!-- ************************      SIDEBAR       ******************** -->

<div class="col-xs-2 sidebar">
<ul class="nav nav-sidebar">


<?php
$menu = $_GET['menu'];

// later this array will come from a database of forms.
$side_menu_list = array('credit_form','records','invoiced_customers','payments','analytics','revenue','account history','more','more','more');
foreach($side_menu_list as $value){
  echo "<li";  
  if($menu == $value){
    echo " class='active' ";
  }
  echo ">";
  echo "<a href=".$_SERVER['PHP_SELF']."?menu={$value}";  
  echo ">";
  echo $value;
  echo "</a>";
  echo "</li>";
}
?>




</ul>
</div> <!-- end of left col (sidebar) -->





<!-- ************************      CONTENT WINDOW       ******************** -->
<!-- only allowed 10 columns because the side nav takes up 2 columns. -->
<div class="col-xs-10 content">  <!-- this is closed on the footer -->
  
  
<div class="padding"></div>

*/
?>
