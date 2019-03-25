<!DOCTYPE html>
<html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
</head>
<body>

  <div class="container">

   <h2 align="center">How to Search Table Data by Typehead with PHP Ajax</h2>
  
   <label>Search Employee Details</label>
   
   <div id="search_area">
    <input type="text" name="employee_search" id="employee_search" class="form-control input-lg" autocomplete="off" placeholder="Type Employee Name" />
  </div>

  <div id="employee_data"></div>
  
</div>
</body>
</html>

<script>
  $(document).ready(function(){

   load_data('');

   function load_data(query, typehead_search = 'yes')
   {
    $.ajax({
     url:"fetch.php",
     method:"POST",
     data:{query:query, typehead_search:typehead_search},
     success:function(data)
     {
      $('#employee_data').html(data);
    }
  });
  }


  $('#employee_search').typeahead({
    source: function(query, result){
     $.ajax({
      url:"fetch.php",
      method:"POST",
      data:{query:query},
      dataType:"json",
      success:function(data){
       result($.map(data, function(item){
        return item;
      }));
       load_data(query, 'yes');
     }
   });
   }
 });


  $(document).on('click', 'li', function(){
    var query = $(this).text();
    load_data(query);
  });

});
</script>
