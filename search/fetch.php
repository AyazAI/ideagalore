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
   <h2>Question</h2>
    <h2>Situation</h2>
  ';

 if(mysqli_num_rows($result) > 0)
 {
  while($row = mysqli_fetch_array($result))
  {
   $data[] = $row["question"];
   $data[] = $row["situation"];
   
   $html .= "
    Data
   ";
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


 $html .= '';
 
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
