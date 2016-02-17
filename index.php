<!DOCTYPE html>
<html>
<head>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="functions.js"></script>
<!-- <script src="Bootstrap-Confirmation.js"></script> -->
<script src="http://bootboxjs.com/bootbox.js"></script>
<!-- ************************  links ************************-->
<script src="Highcharts-4.1.7/js/highcharts.js"></script>
<!-- <script src="Highcharts-4.1.7/js/highcharts-3d.js"></script> -->
<!-- <script src="Highcharts-4.1.7/js/modules/exporting.js"></script> -->
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>


<style>

body{
  margin: 20px;
}
</style>

<!-- OVERRIDES -->
<style>
.btn.active.focus, .btn.active:focus, .btn.focus, .btn:active.focus, .btn:active:focus, .btn:focus {
    outline: 0 !important;
}
.dropdown:hover .dropdown-menu {
display: block;
}

ul.dropdown-menu {margin-top: -1px; }

.well{
  border: solid #C8C8C8 1px !important; 

}

.well_analytics{
  background: #51A351 !important;
  color: white !important;
}

</style>

<script>




$(document).ready(function () {


  $(".navbar-nav li a").click(function(event) {
    // Removes focus of the anchor link.
    $(this).blur();
  });


  $(".form-control").click(function(event) {
    // Removes focus of the anchor link.
    // $(this).blur();
    // $(this).css("boxShadow","none !important");
    // $(this).css("outline","none !important");
  });


// // 
// php file to deliver data
// // this would create an html div, have a corresponding php ajax file, specificy all details.
// graph3.draw('one','two','other','stuff',3,4,5,4,5,4,2,2,3,3,4,5,5,4,4,);
// //
// html to take the graph


 //---------------------------------------------------------------------------------------------------------------------------------------------

  // var graphObject = {

  //   div_id : '#experiment',    
  //   type: 'bar',
  //   color: 'red',
  //   newVal: 2,
  //   the_list: [],
  //   mydata: '',
    
  //   otherMethod : function(data){
  //     this.mydata = data;
  //     // console.log(data);
  //   },
    
  //   graphing : function(){
  //     return this.type + " " + this.color;
  //   },
    
  //   query : function(){
  //     $(this.div_id).html('change');
  //   },
    
  //   ajax_request: function(){
      
  //     $.ajax({
  //       type: 'post',  
  //       url: "get_data_by_ajax5.php", //file to access  
  //       data: "", //what do you want to send to the php file "username="+var+"&pword="+var2,
  //       dataType: 'json',
  //       success: function(data) {          
  //         $("#experiment").html(data);
  //         graphObject.otherMethod(data);             
  //         // console.log(data);
  //       }    
  //     })      

  //     .done(function( data ) {
  //       // console.log(data);

  //     });


  //   }

  // }

// console.log( graphObject.graphing() );

// graphObject.ajax_request();

// console.log(graphObject.mydata);


// $("#experiment").html("Hello <b>world!</b>");

 

 //---------------------------------------------------------------------------------------------------------------------------------------------




 //---------------------------------------------------------------------------------------------------------------------------------------------


function animate_count(){
  $('.count').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 2000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
  });  
}  

animate_count();


})

</script>
<!-- OVERRIDES END -->

</head>

<?php include ('header.php'); ?>
<?php include ('functions.php'); ?>

<script>


$(document).ready(function(){

//------------------------------------------------------------------------
// Pass PHP arrays to Javascript arrays
// functions.php is what prepares these data structures into json
// to then be passed to JS
var all_cost_categories = <?php echo $cost_categories; ?>;
var all_dates = <?php echo $dates; ?>;


//------------------------------------------------------------------------
Highcharts.setOptions({
      lang : {
        thousandsSep: ",",
      }
    });

// -------------------- dynamic select tab function based on the counter value, defaulted to zero ---------------------

function dyn_select(newVal){
//Dynamic select tab
        var sel = document.getElementById('category_dyn_select_list');
          for(var i = 0; i < all_cost_categories.length; i++) {
              var opt = document.createElement('option');
              opt.innerHTML = all_cost_categories[i];
              opt.value = all_cost_categories[i];    
              
              if(all_cost_categories[newVal] == all_cost_categories[i]){
                opt.selected="selected";
              } else {
              }

              sel.appendChild(opt);
          }
}

// -------------------- dynamic select tab function based on the counter value, defaulted to zero ---------------------

function dyn_select2(newVal){
//Dynamic select tab
        var sel = document.getElementById('date_dyn_select_list');
          for(var i = 0; i < all_dates.length; i++) {
              var opt = document.createElement('option');
              opt.innerHTML = all_dates[i];
              opt.value = all_dates[i];    
              
              if(all_dates[newVal] == all_dates[i]){
                opt.selected="selected";
              } else {
              }

              sel.appendChild(opt);
          }
}

// -------------------- select tab change event ---------------------NEW

$( "#category_dyn_select_list" ).change(function() {

    var value = $("#category_dyn_select_list").val();    //since select tab is based off of a hard coded array, so will this. user selected value from dynamic select tab.
    var newVal = all_cost_categories.indexOf(value); //connected to a hard coded array. This gets the counter/index of the selected item. 
    
    $(".button").parent().find("input").val(newVal); // this will find the class of the button, and change its value attribute in the input field, which is then set in the ajax method on all change events.  
    // $("#display_count").html(list[newVal]);

    load_expenses_by_month(newVal,all_cost_categories);
    load_data_and_chart_by_day();

    load_data_and_stats_and_table();

    console.log('newVal = '+newVal+' value = '+value);
});

// -------------------- select tab change event ---------------------NEW

$( "#date_dyn_select_list" ).change(function() {

    var value = $("#date_dyn_select_list").val();    //since select tab is based off of a hard coded array, so will this. user selected value from dynamic select tab.
    var newVal = all_dates.indexOf(value); //connected to a hard coded array. This gets the counter/index of the selected item. 
    
    $(".button2").parent().find("input").val(newVal); // this will find the class of the button, and change its value attribute in the input field, which is then set in the ajax method on all change events.  
    // $("#display_count").html(list[newVal]);

    load_expenses_by_cat(newVal,all_dates);
    load_data_and_chart_by_day();

    load_data_and_stats_and_table();

    console.log('newVal = '+newVal+' value = '+value);
});


// -------------------- a link top menu change event ---------------------NEW

$("a").click(function(){
      // console.log($(this).attr('value'));

  var value = $(this).attr('value');
  // console.log(value);  
  var newVal = all_cost_categories.indexOf(value); //connected to a hard coded array. This gets the counter/index of the selected item. 
  $("#category_dyn_select_list").val(all_cost_categories[newVal]);
    
    $(".button").parent().find("input").val(newVal); // this will find the class of the button, and change its value attribute in the input field, which is then set in the ajax method on all change events.  
    // $("#display_count").html(list[newVal]);

    load_expenses_by_month(newVal,all_cost_categories);
    load_data_and_chart_by_day();
    load_data_and_stats_and_table();

    console.log('newVal = '+newVal+' value = '+value);


})



// -------------------- all connected --------------------------------------------------------------------------------
$("#category div").append('<button type="submit" class="button btn btn-default btn-sm"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></button> <button id="plus" type="button" class="button btn btn-default btn-sm"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></button>');
// -------------------- all connected --------------------------------------------------------------------------------

$("#date div").append('<button type="button" class="button2 btn btn-default btn-sm"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></button> <button id="plus" type="button" class="button2 btn btn-default btn-sm"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></button>');

// -------------------- all connected --------------------------------------------------------------------------------




// -------------------- arrow click event ---------------------

$(".button").on("click", function() {

        var $button = $(this);
        var oldValue = $button.parent().find("input").val();

        if ($button.attr('id') == "plus") {
          var newVal = parseFloat(oldValue) + 1;
        } else {
         // Don't allow decrementing below zero
          if (oldValue > 0) {
            var newVal = parseFloat(oldValue) - 1;
          } else {
            newVal = 0;
          }
        }

        $button.parent().find("input").val(newVal);
        
        // $("#display_count").html(list[newVal]);

        $('#category_dyn_select_list').children('option').remove();
        // $('ul').children('li#item1').remove();

        dyn_select(newVal);              
        load_expenses_by_month(newVal,all_cost_categories);
        load_data_and_chart_by_day();

        load_data_and_stats_and_table();

        console.log('newVal = '+newVal);


        // url: "testing.php?id=" + id + "&newvalue=" + newVal,
        // url: "testing.php?newvalue=" + newVal,

});


// -------------------- arrow click event ---------------------

$(".button2").on("click", function() {

        var $button = $(this);
        var oldValue = $button.parent().find("input").val();

        if ($button.attr('id') == "plus") {
          var newVal = parseFloat(oldValue) + 1;
        } else {
         // Don't allow decrementing below zero
          if (oldValue > 0) {
            var newVal = parseFloat(oldValue) - 1;
          } else {
            newVal = 0;
          }
        }

        $('#test').html(all_dates[newVal]); //for testing display in broswer

        $('#date_dyn_select_list').children('option').remove();

        $button.parent().find("input").val(newVal);

        dyn_select2(newVal);        
        load_expenses_by_cat(newVal,all_dates);
        load_data_and_chart_by_day();
        
        load_data_and_stats_and_table();


        console.log('newVal = '+newVal);
});




        


// -------------------- arrow click event ---------------------


function load_data_and_stats_and_table(){
    var field1 = $("#category_dyn_select_list").val();

    var field2 = $("#date_dyn_select_list").val();
    

    $.ajax({
        type: 'post',  
        url: "get_data_by_ajax_both_fields_for_table_and_stats.php?cat="+field1+"&date="+field2, //file to access  
        data: "", //what do you want to send to the php file "username="+var+"&pword="+var2,
        dataType: 'html',
        success: function(data) {  //3 params: return data, string if success or error, http req object
          // $button.parent().find("input").val(newVal);     
          $("#getdata").html(data);    

          // options.xAxis.categories = json[0]['data'];
          // options.series[0] = json[1];
          // options.title.text = the_list[newVal];
          // chart = new Highcharts.Chart(options);

        }  
    }).done(function(){
        capture_form();
    });


    field1 = "";
    field2 = "";

    console.log('field1 = '+field1+'field2 = '+field2);
}


// -------------------- all connected end--------------------------------------------------------------------------------

// push all the similar code together and make the differences as arguments for the function


// -------------------- ajax function based on the counter value --------------------- MAIN GRAPH TO NOT CHANGE

// function load_data_and_chart_main(newVal,the_list){
//   $.ajax({
//           type: 'post',  
//           url: "get_data_by_ajax.php?count="+newVal, //file to access  
//           data: "", //what do you want to send to the php file "username="+var+"&pword="+var2,
//           dataType: 'json',
//           success: function(json) {  //3 params: return data, string if success or error, http req object
//             // $button.parent().find("input").val(newVal);     
//             // $("#getdata").html(data);    

//             options_alpha.xAxis.categories = json[0]['data'];
//             options_alpha.series[0] = json[1];
//             options_alpha.title.text = the_list[newVal];

//             chart = new Highcharts.Chart(options_alpha);

//           }  
//         });  
// }

// options_alpha = graph('container_main_graph','line');


// -------------------- ajax function based on the counter value ---------------------

function load_expenses_by_month(newVal,the_list){
  $.ajax({
          type: 'post',  
          url: "get_data_by_ajax_by_month.php?count="+newVal, //file to access  
          data: "", //what do you want to send to the php file "username="+var+"&pword="+var2,
          dataType: 'json',    
          success: function(json) {  //3 params: return data, string if success or error, http req object
            // $button.parent().find("input").val(newVal);     
            // $("#getdata").html(data);    

            options.xAxis.categories = json[0]['data'];
            options.series[0] = json[1];
            options.title.text = the_list[newVal] + " - sale by month";

            chart = new Highcharts.Chart(options);


          }  
        }).done(function(){
        capture_form();
    });
}

//initial settings of an options object to later build on with the load_graph() functions.
//global
options = graph('container','column',0.1,0,0.1,'#0088CC');


// -------------------- ajax function based on the counter value ---------------------


function load_expenses_by_cat(newVal,the_list){
  $.ajax({
          type: 'post',  
          url: "get_data_by_ajax_by_cat.php?count="+newVal, //file to access  
          data: "", //what do you want to send to the php file "username="+var+"&pword="+var2,
          dataType: 'json',
          success: function(json) {  //3 params: return data, string if success or error, http req object
            // $button.parent().find("input").val(newVal);     
            // $("#getdata").html(data);    

            options2.xAxis.categories = json[0]['data'];
            options2.series[0] = json[1];
            options2.title.text = the_list[newVal] + " TOTAL" + " - by category"; 

            chart = new Highcharts.Chart(options2);
          }  
        }).done(function(){
        capture_form();
    });
}

options2 = graph('container_date','column',0.1,0,0.1,'#0088CC');


// -------------------- ajax function based on the counter value ---------------------


function load_data_and_chart_by_day(){

  var cat = $("#category_dyn_select_list").val();
  var date = $("#date_dyn_select_list").val();
  if (cat == null){
    cat = 'TOTAL'; //fail safe plan
  }
  if (date == null){
    date = 'TOTAL'; //fail safe plan 
  }

  // if (cat != 'TOTAL' && date != 'TOTAL'){
    // console.log(cat);
    // console.log(date);
    // console.log('test');
    // }
  

  $.ajax({
          type: 'post',  
          url: "get_data_by_ajax_by_day.php?date="+date+"&cat="+cat, //file to access  
          data: "", //what do you want to send to the php file "username="+var+"&pword="+var2,
          dataType: 'json',
          success: function(json) {  //3 params: return data, string if success or error, http req object
            // $button.parent().find("input").val(newVal);     
            // $("#getdata").html(data);    

            options4.xAxis.categories = json[0]['data'];
            options4.series[0] = json[1];
            options4.title.text = date + " " + cat + " - sale by day"; 

            chart = new Highcharts.Chart(options4);
          }  
        }).done(function(){
        capture_form();
    });  
}


options4 = graph('container_by_day',"line",0,0,0,'blue');  

// this determines which button was pressed, line or bar, sets the variable that then sets the graph. 
$("#type").click(function(){
  // console.log($(this).val());
  graph_type = 'line';
  options4 = graph('container_by_day',graph_type,0,0,0,'blue');
  load_data_and_chart_by_day();
});
$("#type2").click(function(){
  // console.log($(this).val());
  graph_type = 'column';
  options4 = graph('container_by_day',graph_type,0,0,0,'blue');
  load_data_and_chart_by_day();
});  










// -------------------- ajax function based on the counter value ---------------------




// -------------------- all connected end--------------------------------------------------------------------------------


// ----------------- DEFAULTS ----------------------------------- 
//default ajax request so that data is not dependent on the event.
// --------------------------------------------------------------
$(".button").parent().find("input").val(0);


// load_data_and_chart_main(0,all_cost_categories);
load_expenses_by_month(0,all_cost_categories);
load_expenses_by_cat(0,all_dates);
load_data_and_chart_by_day();
dyn_select(0);
dyn_select2(0);




function display_detail(){
  var alpha = "<br>display sql info";
  return alpha;
  // var date = this.series.x;
  // $.ajax({
  //         type: 'post',  
  //         url: "get_data_by_ajax4.php", //file to access  
  //         data: "", //what do you want to send to the php file "username="+var+"&pword="+var2,
  //         dataType: 'json',
  //         success: function(json) {  //3 params: return data, string if success or error, http req object
  //           // $button.parent().find("input").val(newVal);     
  //           // $("#getdata").html(data);    

  //           var query_data = json[0];
  //         }


           
  //       });

  //       return query_data;  
}



// -------------------- fucntions to work with graphs --------------------------------------------------------------------------------




function graph(id_name,graph_type,size1,size2,size3,color){

    var options = {
        chart: {

            renderTo: id_name,
            type: graph_type,
            marginRight: 100,
            marginBottom: 75
        },
        colors: [color],
        title: {
            text: '',
            x: -20 //center
        },
        subtitle: {
            text: '',
            x: -20
        },
        xAxis: {

            categories: []
        },
        yAxis: {
            title: {
                text: 'Sale'
            },
            stackLabels: {
                enabled: true,                
                style: {                    
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray',                    
                    style: {                      
                        fontSize: '6px'
                    }
                },
                formatter: function() {
                    return  Highcharts.numberFormat(this.total,0);
                }            
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                    this.x +': '+ '$' + Highcharts.numberFormat(this.y,0)+                    
                    display_detail();
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',            
            x: -10,
            y: 100,
            borderWidth: 0
        },
         plotOptions: {
          series: {
                allowPointSelect: true,
                cursor: 'pointer',
                point: {
                    events: {
                        click: function() {
                            for (var i = 0; i < this.series.data.length; i++) {
                                // this.series.data[i].update({ color: '#ECB631' }, true, false);
                            }
                            // this.update({ color: '#f00' }, true, false)
    
                              clickable_bar(this.category,this.y);
                        }
                    }
                },
                // column: {
                //     pointPadding: 0,
                //     pointWidth: 0,
                //     borderWidth: 0
                // },


                pointPadding: size1, // Defaults to 0.1
                groupPadding: size2, // Defaults to 0.2
                borderWidth: size3,
                animation: {
                  duration: 0      
                },
                shadow : false,                
                dataLabels: {
                    enabled: true,                
                    fontSize: "8px",
                     formatter: function () {
                      return '$' + Highcharts.numberFormat(this.y,0);
                    }
                }
                // borderWidth : 0,
                // borderColor : 'black'
            },
            // column: {
            //     stacking: 'normal',
            //     dataLabels: {
            //         enabled: false,

            //         color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
            //          style: {
            //             textShadow: '0 0 2px black',
            //             fontSize: '10px'
            //         }
                    
            //     }
            // }
        },
        series: []
    } //end of var options

return options;
}//end of graph function 




function clickable_bar(category,y){
    console.log('Category: ' + category);    
    // console.log(all_dates[0]);    
    // alert(date_list.indexOf(3));

     //var value = $("#List2").val();    //since select tab is based off of a hard coded array, so will this. user selected value from dynamic select tab.
     // alert(value);

    // var newVal = date_list.indexOf(value); //connected to a hard coded array. This gets the counter/index of the selected item. 
    
    // $(".button2").parent().find("input").val(newVal); // this will find the class of the button, and change its value attribute in the input field, which is then set in the ajax method on all change events.  
    // $("#display_count").html(list[newVal]);

    var newVal = all_dates.indexOf(category);

    $('#date_dyn_select_list').children('option').remove();
    dyn_select2(newVal);

    load_expenses_by_cat(newVal,all_dates);
    load_data_and_chart_by_day(newVal,all_dates);

    load_data_and_stats_and_table();

    // load_data_and_stats_and_table();


      // $.ajax({
      //     type: 'post',  
      //     url: "get_data_by_ajax2.php?count=3", //file to access  
      //     data: "", //what do you want to send to the php file "username="+var+"&pword="+var2,
      //     dataType: 'json',
      //     success: function(json) {  //3 params: return data, string if success or error, http req object
      //       // $button.parent().find("input").val(newVal);     
      //       // $("#getdata").html(data);    

      //       options2.xAxis.categories = json[0]['data'];
      //       options2.series[0] = json[1];
      //       // options2.title.text = the_list[5]; 

      //       chart = new Highcharts.Chart(options2);
      //     }  
      //   });  

}



// -------------------- category select tab change event for reclass ---------------------

// $("a").css("background-color", "yellow");

// $('form').on('change', function() {
//   // alert( this.value ); // or $(this).val()

//   var value = $(this).serialize();
//   console.log( value  );

// });

// -------------------- insert event ---------------------

function insert(insert_params){
  console.log('inser_params are ' + insert_params);
    $.ajax({
            type: 'post',  
            url: "insert_data_by_ajax6.php?"+insert_params, //file to access  
            data: "", //what do you want to send to the php file "username="+var+"&pword="+var2,
            dataType: 'html',
            success: function(data) {  //3 params: return data, string if success or error, http req object
              // $button.parent().find("input").val(newVal);     
              // $("#getdata").html(data);    

              // options.xAxis.categories = json[0]['data'];
              // options.series[0] = json[1];
              // options.title.text = the_list[newVal];
              // chart = new Highcharts.Chart(options);

              alert(data);
              // possible refresh and call the other ajax functions now.

            }  
        });  
}

// -------------------- capture form ---------------------

function capture_form(){
  $('form').on('change', function() {
        var params = $(this).serialize();
        // get old value of select tab and new value of select. dispay old value back in false, display new value if true  *************************
        bootbox.confirm("Are you sure want to reclass?", function(result) {
                  // alert("Confirm result: " + result);
                  if(result == true){
                    console.log(true);
                    
                    console.log( params  );
                    //insert the params on the event using ajax. when success is run, not sure how to handle, possible alert for now.
                    // insert(params);

                    $.ajax({
                        type: 'post',  
                        url: "insert_data_by_ajax6.php?"+params, //file to access  
                        data: "", //what do you want to send to the php file "username="+var+"&pword="+var2,
                        dataType: 'html',
                        success: function(data) {  //3 params: return data, string if success or error, http req object
                          // $button.parent().find("input").val(newVal);     
                          // $("#getdata").html(data);    

                          // options.xAxis.categories = json[0]['data'];
                          // options.series[0] = json[1];
                          // options.title.text = the_list[newVal];
                          // chart = new Highcharts.Chart(options);

                          // alert(data);
                          console.log('newVal = '+newVal+' value = '+value);
                          
                          


                          // possible refresh and call the other ajax functions now.

                        }  
                    });  
                    
                    
                  } else {
                    console.log(false);
                  }
        });

        
        // alert('are you sure you want to change this category?');
     
            
          

      });
}





}); //end of doc ready




</script>
<!-- ________________________________HTML________________________________ -->
<!-- ________________________________HTML________________________________ -->
<br>


<!-- ________________________________graph________________________________ -->





<!-- ________________________________graph________________________________ -->




<div class="container-fluid">
  
  <div class="row">


<div class="well">
<?php

$cost_categories = json_decode($cost_categories);
// print_r($cost_categories);
// echo $cost_categories[2];
foreach($cost_categories as $key => $value){
  echo "<a href='#' value='$value'>". ucfirst(strtolower($value)) . "</a> | ";
}
?>
  
</div>
    <!-- Controller --> 
    
          <div class="col-xs-2 col-med-2">  
            
            <!-- Graph controller -->
<br><br>
            <div class="well"> 

              <!-- dropdown -->
            <!-- <div class="dropdown">
              <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                Dropdown
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Separated link</a></li>
              </ul>
            </div>
            <br> -->

              <select id="category_dyn_select_list" class="form-control">
              </select>          
              <div id="category" method="post" action="" >
                  </br>  
                  <div>
                      <label style="font-size:14px">Category</label>

                      <input type="hidden" value="0"><br>


                  </div>    
                  <br>
                  <a href="<?php echo $_SERVER['PHP_SELF']; ?>"><button type="button" class="btn btn-success">Reset</button></a>
              </div>    
          </div>  
        </div>  

    <!-- GRAPH -->
    <div class="col-xs-10 col-med-10">  
      <div id="container" style="width:100%; margin: auto; height:275px;">
      </div>
    </div>
  </div> <!-- end of row -->
</div> <!-- end of container -->






<!-- ________________________________HTML________________________________ -->

<?php
/*

<div class="container">
  <div class="well">
    <div class="row">   
         

          <!-- controller 1 -->
                    <div class="col-xs-6">  
                    <select id="List">
                    </select>          
                    <form id="category" method="post" action="" >
                    </br>  
                    <div>
                    <label style="font-size:20px">Category</label>
                    <input type="text" value="0"><br>
                    </div>    
                    <!-- <input type="submit" value="Submit" id="submit"> -->
                    </form>  
                    </div>

          <!-- controller 2 -->  
                    <div class="col-xs-6">  
                    <select id="List2">
                    </select>

                    <form id="date" method="post" action="" >
                    </br>  
                    <div>
                    <label style="font-size:20px">Date</label>
                    <input type="text" value="0"><br>
                    </div>    

                    </form>
                    <p id="test">..</p>
                    </div>  

    </div> <!-- end of row -->
  </div> <!-- end of well -->
</div> <!-- end of container -->
*/
?>

<!-- ________________________________graph________________________________ -->

<div class="container-fluid">
  <div class="row">

    <div class="col-xs-2 col-med-2">  
      <br><br>
      <div class="well" style="height:200px;">
        
        <select id="date_dyn_select_list" class="form-control">
        </select>

        <form id="date" method="post" action="" >
            </br>  
            <div>
                <label style="font-size:14px">Date</label>
                <input type="hidden" value="0"><br>
            </div>    
  
        <!-- <select id="" class="form-control">
          <option>Add another cateogry to see comparison</option>
          <option>Add another cateogry to see comparison</option>
          <option>Add another cateogry to see comparison</option>
          <option>Add another cateogry to see comparison</option>
        </select>                     -->

        </form>
        <!-- <p id="test">..</p> -->
        </div>
    </div>


    <!-- GRAPH -->
    <div class="col-xs-10 col-med-10">  
      <div id="container_date" style="width:100%; margin: auto; height:300px;">
      </div>
    </div>
  </div> <!-- end of row -->
</div> <!-- end of container -->


<!-- ________________________________graph________________________________ -->

<div class="container-fluid">
  <div class="row">

    <div class="col-xs-2 col-med-2">  
      <br><br>
      <div class="well" style="height:200px;">
        
        <!-- <select id="date_dyn_select_list" class="form-control">
        </select> -->

        <form id="date" method="post" action="" >
            </br>  
            <div>
                <label style="font-size:14px">Date</label>
                <input type="hidden" value="0"><br>
            </div>    

            
        </form>
        <br>
        <button type="button" id="type" value="line" class="btn btn-info btn-xs">line <span class="glyphicon glyphicon-flash"></span></button>
        <button type="button" id="type2" value="bar" class="btn btn-info btn-xs">bar <span class="glyphicon glyphicon-signal"></span></button>
        <!-- <p id="test">..</p> -->
        </div>
    </div>


    <!-- GRAPH -->
    <div class="col-xs-10 col-med-10">  
      <div id="container_by_day" style="width:100%; margin: auto; height:350px;">
      </div>
    </div>
  </div> <!-- end of row -->
</div> <!-- end of container -->




<!-- ________________________________graph________________________________ -->


<div class="container-fluid">
  <div class="row">    

    <div class="col-xs-2 col-med-2">  
      <br>
      <div class="well">
        
        <!-- <select id="List3" class="form-control">
        </select> -->

        <form id="date" method="post" action="" >
            </br>  
            <div>
                <label style="font-size:14px">Date</label>
                <input type="hidden" value="0"><br>
            </div>    
            
        </form>
        <!-- <p id="test">..</p> -->
        </div>
    </div>
    
<!-- col-xs-offset-2 -->
    <div class="col-xs-10 col-med-10">  

      <p id="getdata">..</p>

  </div> <!-- end of row -->
</div> <!-- end of container -->


<div id="" style="width:100%; margin: auto; height:500px;">













