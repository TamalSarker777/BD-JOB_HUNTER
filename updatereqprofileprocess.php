<?php
session_start();

if(
        isset($_SESSION['useremail'])
    &&  !empty($_SESSION['useremail'])
){
    ///already logged in
    $mail=$_SESSION['useremail'];
    
    if( 
        
        isset($_POST['gender'])  &&
        isset($_POST['dob']) && 
        isset($_POST['usertype'])
        
        
    ){
        $pass=$_POST['upass'];
        $name=$_POST['fname'];
        $location=$_POST['location'];
        $gender=$_POST['gender'];
        $dob=$_POST['dob'];
        $phone=$_POST['phone'];
        $usertype=$_POST['usertype'];   
        
        try{
            $conn=new PDO('mysql:host=localhost:3306;dbname=careerbuilder;','root','');
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            
            //database code execute, default : warning generate
            $sqlquerystring="UPDATE user SET name='$name',location='$location',password='$pass',gender='$gender',dateofbirth='$dob',contact='$phone' WHERE username='$mail'  ";
             
            $conn->exec($sqlquerystring);
             
             
             ?>
<script>
    location.assign('recruiterpage.php')
</script>
<?php
        }
        catch (PDOException $ex){
            ?>
<script>
    location.assign('updatereqprofile.php')
</script>
<?php
        }
        
        
    }
    else{
        ?>
<script>
    location.assign('updatereqprofile.php')
</script>
<?php
    }
}
else{
    ?>
<script>
    location.assign('login.php')
</script>
<?php
}

?>