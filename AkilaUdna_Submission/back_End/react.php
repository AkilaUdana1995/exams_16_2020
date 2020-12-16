<?php
    $dbuser="user";
    $dbname="exams";
    $password="";
    $db=mysqli_connect("localhost",$dbuser,$password,$dbname);
    $response = array();
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $username =$_POST['username'];
        $password = $_POST['password'];
        
        $sql="SELECT nic FROM user where username='$username' AND password='$password'";
        
        $result=mysqli_query($db,$sql);
        
        if(mysqli_num_rows($result)>0){
            $row = mysqli_fetch_row($result);
            $nic=$row[0];
            $code = "Logged";
            array_push($response,array("code" => $nic, "nic" =>$nic));
      
        }else{
            $code = "Failed";
            array_push($response,array("code" => $code,"msg" => "User Name or Password is Incorrect Try Again"));
    }
    
    }else{
        array_push($response,array("status" => 0, "msg" => "Request method not accepted"));
    }
    
    
    @mysqli_close($db);
    header('Content-type: application/json');
    echo json_encode($response);
   ?>