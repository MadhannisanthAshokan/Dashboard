<?php
session_start();
                include_once ('config.php');
                $results_per_page=7;
                $sql='SELECT * FROM student';
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
                $pageresult=($page-1)* $results_per_page;
                $ageid=$_SESSION["ageid"];
                // echo $sql1;
                ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School details</title>
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
// $('#1').click(function(e){
//     e.preventDefault;
//     var first = document.getElementById('1').value;
//     console.log("clicked");
// })
</script>
</head>
<body>
<div class="out"></div>
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
                    <img class="listpng" src="./Assets/School List.png" alt=""><a href="school.php"> School List</a></p>
                    </div>
                <div><p class="sidetext" id="sidetext2">
                    <img class="listpng" src="./Assets/Class List.png" alt=""><a href="class.php"> Class List</a></p>
                    </div>
                
                    <div><p class="sidetext" style="border-left: 3px solid #d642c8;
                background-color: #f6f8fa;color:  #d642c8;" id="sidetext4">
                    <img class="listpng" src="./Assets/Student List.png" alt=""> <span id='text'> Student List </span></p>
                    </div>
         
        </div>
    <div class="main">
        <div class="nav">
            <p class="list" style="color: #505050;"><b> Student List</b></p>
            <p class="total">Total Students -<?php $count="SELECT COUNT(`studentid`)as count FROM student";
                $coun = $conn->query($count);
                while($rw=$coun->fetch_assoc()){echo $rw['count']; }?> </p>
            <input class="search"  type="text" placeholder="Search" id="myInput">
            <img class="searchpng" src="./Assets/Search Icon.png" alt="">
           <button class='filter' onclick="myFunc()"><img src="./Assets/Filter.png" alt="" id="filter">Filter</button>
           <div class="dropdown">
           <div class="myfilter" id="filter-content"><p class='age'>Age</p>
               <input type="radio" class='input' id='1' name='filter' value="'3'and'5'">
               <label for="1">3 to 5</label>
               <input type="radio" class='input' id='2' name='filter' value="'6'and'9'">
               <label for="2">6 to 9</label>
               <input type="radio" class='input' id='3' name='filter' value="'10'and'12'">
               <label for="3">10 to 12</label>
               <input type="radio" class="input" id='4' name='filter' value="'13'and'15'">
               <label for="4">13 to 15</label>
               <input type="radio" class="input" id='5' name='filter' value="'16'and'18'">
               <label for="5">16 to 18</label>
           </div>
           </div>
        </div>
        
        <table id="customers">
            <tr>
                <div id="table">
              <th style="height: 18px;width: 150px;">SI.NO</th>
              <th id="head">Student Name</th>
              <th id="head">Age</th>
              <th id="head">Gender</th>
              <th id="head">Father Name</th>
              <th id="head">Mobile number</th>
              <th id="head">Class id</th>
              <th id="head">City id</th>
            </div>
            </tr>
            <?php
            $schoolid=$_SESSION['schoolid'];
             $classid= $_SESSION['classid'];
             $cityid= $_SESSION['cityid'];
            if($classid){
                $sql1='SELECT Student.studentid,Student.studentname,Student.age,Student.gender,Student.fathername,Student.mobilenumber,Student.classid,Student.cityid FROM class LEFT JOIN Student ON class.classid = student.classid where class.classid='.$classid;
                $result2=$conn->query($sql1);
            while ($row = $result2->fetch_assoc()) {
                ?>
            <tbody class="myTable">
            <tr>
                <td><?php echo  $row["studentid"]; ?></td>
                <td><?php echo  $row["studentname"]; ?></td>
                <td><?php echo  $row["age"]; ?></td>
                <td><?php echo  $row["gender"]; ?></td>
                <td><?php echo  $row["fathername"]; ?></td>
                <td><?php echo  $row["mobilenumber"]; ?></td>
                <td><?php echo  $row["classid"]; ?></td>
                <td><?php echo  $row["cityid"]; ?></td>
            </tr>
            </tbody>
                <?php   
                }
            }elseif($cityid){
                $sql1='SELECT Student.studentid,Student.studentname,Student.age,Student.gender,Student.fathername,Student.mobilenumber,Student.classid,Student.cityid FROM City LEFT JOIN Student ON City.cityid = student.cityid where City.cityid='.$cityid;
                $result2=$conn->query($sql1);
            while ($row = $result2->fetch_assoc()) {
                
                    
                ?>
            <tbody class="myTable">
            <tr>
                <td><?php echo  $row["studentid"]; ?></td>
                <td><?php echo  $row["studentname"]; ?></td>
                <td><?php echo  $row["age"]; ?></td>
                <td><?php echo  $row["gender"]; ?></td>
                <td><?php echo  $row["fathername"]; ?></td>
                <td><?php echo  $row["mobilenumber"]; ?></td>
                <td><?php echo  $row["classid"]; ?></td>
                <td><?php echo  $row["cityid"]; ?></td>
            </tr>
            </tbody>  
                <?php
            }
            }elseif($schoolid){
                //
                //SELECT * FROM ((Student INNER JOIN Class ON student.classid=Class.classid)INNER JOIN School ON School.schoolid=Class.schoolid) where School.schoolid='.$schoolid;
                //$select= 'SELECT student.studentid,student.studentname,student.age,student.fathername,student.mobilenumber,student.classid,student.cityid from((Class inner join school on school.schoolid = class.classid)INNER JOIN Student on student.classid=class.classid) WHERE School.schoolid='.$schoolid;
                $select="SELECT * FROM ((Student INNER JOIN Class ON student.classid=Class.classid)INNER JOIN School ON School.schoolid=Class.schoolid) where School.schoolid=".$schoolid;
                $result2=$conn->query($select);
                echo $select;
            while ($row = $result2->fetch_assoc()) {
                
                    
                ?>
            <tbody class="myTable">
            <tr>
                <td><?php echo  $row["studentid"]; ?></td>
                <td><?php echo  $row["studentname"]; ?></td>
                <td><?php echo  $row["age"]; ?></td>
                <td><?php echo  $row["gender"]; ?></td>
                <td><?php echo  $row["fathername"]; ?></td>
                <td><?php echo  $row["mobilenumber"]; ?></td>
                <td><?php echo  $row["classid"]; ?></td>
                <td><?php echo  $row["cityid"]; ?></td>
            </tr>
            </tbody>

                        
                <?php
                }
            }elseif($ageid){
                $select="SELECT * from Student where age BETWEEN".$ageid;
                $result2=$conn->query($select);
            while ($row = $result2->fetch_assoc()) {
                ?>
            <tbody class="myTable">
            <tr>
                <td><?php echo  $row["studentid"]; ?></td>
                <td><?php echo  $row["studentname"]; ?></td>
                <td><?php echo  $row["age"]; ?></td>
                <td><?php echo  $row["gender"]; ?></td>
                <td><?php echo  $row["fathername"]; ?></td>
                <td><?php echo  $row["mobilenumber"]; ?></td>
                <td><?php echo  $row["classid"]; ?></td>
                <td><?php echo  $row["cityid"]; ?></td>
            </tr>
            </tbody>

                        
                <?php
                }
            }else{
                $sql1='SELECT * FROM student LIMIT ' .$pageresult.','.$results_per_page;
                $result2=$conn->query($sql1);
            while ($row = $result2->fetch_assoc()) {
                ?>
            <tbody class="myTable">
            <tr>
                <td><?php echo  $row["studentid"]; ?></td>
                <td><?php echo  $row["studentname"]; ?></td>
                <td><?php echo  $row["age"]; ?></td>
                <td><?php echo  $row["gender"]; ?></td>
                <td><?php echo  $row["fathername"]; ?></td>
                <td><?php echo  $row["mobilenumber"]; ?></td>
                <td><?php echo  $row["classid"]; ?></td>
                <td><?php echo  $row["cityid"]; ?></td>
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
                        <a id='page' href="<?php echo 'student.php?page='.$page;?>">
                        <?php 
                         echo $page;
                        ?>
                       
                        </a>
                        <?php
                    }
                    
                    ?>
        </div>
          <script>
              function myFunc(){
                document.getElementById("filter-content").classList.toggle("show");
              }
          </script>
            
     <script src="student.js"></script>
  
    
</body>
</html>