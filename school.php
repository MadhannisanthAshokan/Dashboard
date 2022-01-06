<?php 
session_start();
$_SESSION['schoolid']=$_POST['schoolid'];
include_once ('config.php');
$sql="SELECT * FROM `school`";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class list</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    var $block = $('.no-results');
  $("#myInput").keyup(function() {
    var isMatch = false;
    var value = $(this).val();
    $(".myTable tr").each(function() {
        var content = $(this).html();
      if(content.toLowerCase().indexOf(value) == -1){
         $(this).hide(); 
      }else{
          isMatch=true;
          $(this).show();
      }
    });
    $block.toggle(!isMatch);
  });
});
</script>
</head>
<body>
    <div class="logo">
        <img class='logoimg' src="./Assets/Logo.png" alt="">
    </div>
    <div class="vertical">
       <div id="v-head"><p>SCHOOL MANAGEMENT</p></div>
       <div class="list">
                <div><p class="sidetext" id="sidetext1">
                <img class="listpng" src="./Assets/City List.png" alt=""> <a href="city.php">City List</a></p>
            </div>
            <div><p class="sidetext" style="border-left: 3px solid #3dbce8;
                background-color:#f6f8fa;color:  #3dbce8;" id="sidetext3">
                    <img class="listpng" src="./Assets/School List.png" alt=""><span id='text'> School List </span></p>
                    </div>
                <div><p class="sidetext" id="sidetext2">
                    <img class="listpng" src="./Assets/Class List.png" alt=""><a href="class.php"> Class List</a></p>
                    </div>
                
                <div><p class="sidetext" id="sidetext4">
                    <img class="listpng" src="./Assets/Student List.png" alt=""> <a href="student.php">Student List</a></p>
                    </div>
         
        </div>
    <div class="main">
        <div class="nav">
            <p class="list" style="color: #505050;"><b> School List</b></p>
            <p class="total">Total Schools -<?php $count="SELECT COUNT(`schoolid`)as count FROM school";
                $coun = $conn->query($count);
                while($rw=$coun->fetch_assoc()){echo $rw['count']; }?> </p>
            <input class="search"  type="text" placeholder="Search" id='myInput'>
            <img class="searchpng" src="./Assets/Search Icon.png" alt="">
            
        </div>
        <table id="customers">
            <tr>
                <div id="table">
              <th style="height: 18px;width: 150px;">SI.NO</th>
              <th id="head">School Name</th>
              <th id="head">City Id</th>
              <th id="head">State</th>
              <th id="head">Country</th>
              <th id="head">Action</th>
              <th id="head"> </th>
            </div>
            </tr>
            <?php
                while ($row = $result->fetch_assoc()) {

                ?>
                <tbody class='myTable'>
            <tr>
                <td><?php echo  $row["schoolid"]; ?></td>
                <td><?php echo  $row["schoolname"]; ?></td>
                <td><?php echo  $row["cityid"]; ?></td>
                <td><?php echo  $row["stateid"]; ?></td>
                <td><?php echo  $row["country"]; ?></td>
                <td class='allclass' style="color:#0a9af8;" data-schoolid='<?php echo  $row["schoolid"]; ?>'>All classes</td>
                <td class='allstudent' style="color:#0a9af8;" data-schoolid='<?php echo  $row["schoolid"]; ?>'>All students</td>
            </tr>
            </tbody>
            <?php
                }
            }
            ?>
            <div class="no-results" style="display:none">no results found</div>
          </table>
    <script src="school.js"></script>
</body>
</html>