<?php
//fetch.php

if(isset($_POST["query"]))
{
 $connect = mysqli_connect("localhost", "root", "", "bp");
 $request = mysqli_real_escape_string($connect, $_POST["query"]);
 $query = "
  SELECT * FROM posts 
  WHERE question LIKE '%".$request."%' 
  OR situation LIKE '%".$request."%' 
 ";


 $result = mysqli_query($connect, $query);
 $data =array();
 
 $html = '';

 $html .= '
  <table class="table table-bordered table-striped">
   <tr>
    <th>Question</th>
    <th>Situation</th>

   </tr>
  ';

 if(mysqli_num_rows($result) > 0)
 {
  while($row = mysqli_fetch_array($result))
  {
   $data[] = $row["question"];
   $data[] = $row["situation"];
   
   $html .= '
   <tr>
    <td>'.$row["question"].'</td>
    <td>'.$row["situation"].'</td>
   </tr>
   ';
  }
 }
 else
 {
  $data = 'No Data Found';
  $html .= '
   <tr>
    <td colspan="3">No Data Found</td>
   </tr>
   ';
 }


 $html .= '</table>';
 
 if(isset($_POST['typehead_search']))
 {
  echo $html;
 }
 else
 {
  $data = array_unique($data);
  echo json_encode($data);
 }
}

?>
