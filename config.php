<?php
$dbname='Task';
$servername='localhost';
$username='root';
$paassword='root';

$conn= new mysqli($servername,$username,$paassword,$dbname);
if(!$conn){
    die('failed to connect'.$conn->mysqli_error());
};