<?php
/*
1) to receive the data from register.php
2) if the data is valid then we need to store the data to database
3) if data is store then forward the user to LOGIN page
4) if data store is not successful then forward to REGISTER page
*/

if($_SERVER['REQUEST_METHOD']=="POST"){
    //we will give service
    //$_POST['uemail']
    //$_POST['upass']
    
    //empty value check, valid index check
    
    if(
        isset($_POST['uemail']) &&
        isset($_POST['upass'])  &&
        isset($_POST['fname'])  &&
        isset($_POST['location'])&&
        isset($_POST['gender'])  &&
        isset($_POST['dob']) &&
        isset($_POST['phone'])  &&
        isset($_POST['usertype'])  &&
        
        !empty($_POST['uemail']) &&
        !empty($_POST['upass'])  &&
        !empty($_POST['fname'])  &&
        !empty($_POST['location'])&&
        !empty($_POST['gender'])  &&
        !empty($_POST['dob']) &&
        !empty($_POST['phone'])  &&
        !empty($_POST['usertype'])
        
        
    )
    {
        $email=$_POST['uemail'];
        $pass=$_POST['upass'];
        $name=$_POST['fname'];
        $location=$_POST['location'];
        $gender=$_POST['gender'];
        $dob=$_POST['dob'];
        $phone=$_POST['phone'];
        $usertype=$_POST['usertype'];
        
//        $enc_pass=md5($pass);
        
        ///tries to communicate with the database and store the data
        
        try{
            $conn=new PDO('mysql:host=localhost:3306;dbname=careerbuilder;','root','');
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            
            //database code execute, default : warning generate
            $sqlquerystring="INSERT INTO user VALUES('$email','$pass','$name','$location','$gender','$phone','$usertype','$dob')";
            
            ///executing the mysql code
            $conn->exec($sqlquerystring);
            
            ?>
                <script>location.assign('login.php')</script>
            <?php
        }
        catch (PDOException $ex){
            ?>
                <script>location.assign('register.php')</script>
            <?php
        }
    }
    else{
        //otherwise
        ?>
        <script>location.assign('register.php')</script>
        <?php
    }

}
else{
    //we won't provide service
    echo "<script>location.assign('register.php')</script>";
}
?>