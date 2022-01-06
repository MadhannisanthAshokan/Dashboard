<?php
        session_start();
        include_once ('config.php');
        $results_per_page=7;
        $sql='SELECT * FROM class';
        $result=$conn->query($sql);
        $numofresult=mysqli_num_rows($result);
        $numofpages=ceil($numofresult / $results_per_page);
                // echo $numofpages;
                if(!isset($_GET['page'])){
                    $page=1;
                }
                else{
                    $page=$_GET['page'];
                }
                $classid=$_POST['classid'];
                $_SESSION['classid']=$classid;
                $_SESSION["ageid"]=$_POST["ageid"];
                $pageresult=($page-1)* $results_per_page;
                $pagination='SELECT * FROM class LIMIT ' .$pageresult.','.$results_per_page;
                $result2=$conn->query($pagination);
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
            <div><p class="sidetext" id="sidetext3">
                    <img class="listpng" src="./Assets/School List.png" alt=""> <a href="school.php">School List</a></p>
                    </div>
                <div><p class="sidetext" style="border-left: 3px solid #444444;
                background-color:#f6f8fa;color:  #444444;" id="sidetext2">
                    <img class="listpng" src="./Assets/Class List.png" alt=""><span id='text'> Class List </span></p>
                    </div>
                
                <div><p class="sidetext" id="sidetext4">
                    <img class="listpng" src="./Assets/Student List.png" alt=""> <a href="student.php">Student List</a></p>
                    </div>
         
        </div>
    <div class="main">
        <div class="nav">
            <p class="list" style="color: #505050;"><b> Class List</b></p>
            <p class="total">Total Class -<?php $count="SELECT COUNT(`classid`)as count FROM class";
                $coun = $conn->query($count);
                while($rw=$coun->fetch_assoc()){echo $rw['count']; }?> </p>
            <input class="search"  type="text" placeholder="Search" id="myInput">
            <img class="searchpng" src="./Assets/Search Icon.png" alt="">
        </div>
        <table id="customers">
            <tr>
                <div id="table">
              <th style="height: 18px;width: 150px;">SI.NO</th>
              <!-- <th id="head">Class Id</th> -->
              <th id="head">Standard</th>
              <th id="head">Section</th>
              <th id="head">School Id</th>
              <th id="head">Action</th>
            </div>
            </tr>
            <?php
           
            $schoolid=$_SESSION['schoolid'];
            if($schoolid){
                $select='SELECT Class.classid,Class.standard,Class.section,Class.schoolid FROM School INNER JOIN Class ON School.schoolid = Class.schoolid where School.schoolid='.$schoolid;
                $result2=$conn->query($select);
            while ($row = $result2->fetch_assoc()) {
            ?>
            <tbody class='myTable'>
            <tr>
                <td><?php echo  $row["classid"]; ?></td>
                <td><?php echo  $row["standard"]; ?></td>
                <td><?php echo  $row["section"]; ?></td>
                <td><?php echo  $row["schoolid"]; ?></td>
                <td class='allstudent' data-classid='<?php echo  $row["classid"]; ?>'> All students</td>
            </tr>
            </tbody>
                
                <?php
                    }
                }else{
                    $pagination='SELECT * FROM class LIMIT ' .$pageresult.','.$results_per_page;
                    $result2=$conn->query($pagination);
                    while ($row = $result2->fetch_assoc()) {
            ?>
            <tbody class='myTable'>
            <tr>
                <td><?php echo  $row["classid"]; ?></td>
                <td><?php echo  $row["standard"]; ?></td>
                <td><?php echo  $row["section"]; ?></td>
                <td><?php echo  $row["schoolid"]; ?></td>
                <td class='allstudent' style="color:#0a9af8;" data-classid='<?php echo  $row["classid"]; ?>'> All students</td>
            </tr>
            </tbody>
                <?php
                    }
                }
                    ?>
            <div class="no-results" style="display:none">no results found</div>
          </table>
          <div class="pagination">
                <?php
                    for($page=1;$page<=$numofpages;$page++){
                        ?>
                        <a id='page' href="<?php echo 'class.php?page='.$page;?>">
                        <?php 
                            echo $page;
                        ?>
                       
                        </a>
                        <?php
                    }
                    ?>
        </div>
        <script src="student.js"></script>
    <script src="class.js"></script>
</body>
</html>