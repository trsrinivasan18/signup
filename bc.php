<?php

$uname=$_POST['uname'];
$email=$_POST['email'];
$phno=$_POST['phno'];
$passwd=$_POST['passwd'];
$conpasswd=$_POST['conpasswd'];
$location=$_POST['location'];

if(!empty($uname)||!empty($email)||!empty($phno)||!empty($passwd)||!empty($conpasswd)||!empty($location))
{
    $host="localhost";
    $dataname="root";
    $dbpass="";
    $db="bookingclub";

    $conn=new mysqli($host,$dataname,$dbpass,$db);

    if(mysqli_connect_error()){
        die('connection Error('.mysqli_connect_errno().')'.mysqli_connect_error());
    }
    else{
        $SELECT="SELECT email From signup WHERE email = ? Limit  1";
        $INSERT="INSERT INTO signup (uname,email,phno,passwd,conpasswd,location) values(?,?,?,?,?,?)";
        $stmt=$conn->prepare($SELECT);
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->store_result();
        $rnum=$stmt->num_rows;
        if($rnum==0){
            $stmt->close();
            $stmt=$conn->prepare($INSERT);
            $stmt->bind_param("ssssss",$uname,$email,$phno,$passwd,$conpasswd,$location);
            $stmt->execute();
            echo"new record";

        }
        else{
            echo"already";
        }
        $stmt->close();
        $conn->close();
    }
}
else{
    echo"all required";
    die();
}

?>