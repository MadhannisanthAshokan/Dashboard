<?php
session_start();
include_once "config.php";
$sql = "SELECT `cityid`, `cityname`, `state`, `country` FROM `city`";
$result = $conn->query($sql);
$_SESSION['cityid']=$_POST['cityid'];
if ($result->num_rows > 0) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
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
        <img src="./Assets/Logo.png" alt="">
    </div>
    <div class="vertical">
       <div id="v-head"><p>SCHOOL MANAGEMENT</p></div>
       <div class="list">
                <div><p class="sidetext" style="border-left: 3px solid rgb(45, 45, 196);
                background-color:#f6f8fa; color: #225fad; ;">
                <img class="listpng" src="./Assets/City List.png" alt=""><span id='text'> City List </span></p>
            </div>
            <div><p class="sidetext" id="sidetext3">
                    <img class="listpng" src="./Assets/School List.png" alt=""> <a href="school.php">School List</a></p>
                    </div>
                <div><p class="sidetext" id="sidetext2">
                    <img class="listpng" src="./Assets/Class List.png" alt=""> <a href="class.php">Class List</a></p>
                    </div>
                
                <div><p class="sidetext" id="sidetext4">
                    <img class="listpng" src="./Assets/Student List.png" alt=""> <a href="student.php">Student List</a></p>
                    </div>
         
        </div>
    <div class="main">
        <div class="nav">
            <p class="list" style="color: #505050;"><b> City List</b></p>
            <p class="total">Total Cities - <?php $count="SELECT COUNT(`cityid`)as count FROM city";
                $coun = $conn->query($count);
                while($rw=$coun->fetch_assoc()){echo $rw['count']; }?> 
                </p>
            <input class="search" type="text" placeholder="Search" id="myInput">
            <img class="searchpng" src="./Assets/Search Icon.png" alt="">
        </div>
        <table id="customers">
            <tr>
                <div id="table">
              <th style="height: 18px;width: 150px;">SI.NO</th>
              <th id="head">City Id</th>
              <th id="head" >City Name</th>
              <th id="head">State</th>
            </div>
            </tr>
            <?php
                while ($row = $result->fetch_assoc()) {

                ?>
                <tbody class="myTable">
            <tr>
                <td><?php echo  $row["cityid"]; ?></td>
                <td class='allcity' style="color:#0a9af8;" data-cityid='<?php echo  $row["cityid"]; ?>'><?php echo  $row["cityname"]; ?></td>
                <td><?php echo  $row["state"]; ?></td>
                <td><?php echo  $row["country"]; ?></td>
            </tr>
            </tbody>
            <?php
                }
            }

            ?>
            <div class="no-results" style="display:none">no results found</div>
          </table>
    <script src="city.js"></script>
</body>
</html>