<?php

if($_SERVER['REQUEST_METHOD']=="POST"){
    //we will give service
    //$_POST['uemail']
    //$_POST['upass']
    
    //empty value check, valid index check
    $usertype='none';
    
    if(
        isset($_POST['uemail']) &&
        isset($_POST['upass'])  &&
        
        !empty($_POST['uemail']) &&
        !empty($_POST['upass'])
    )
    {
        $email=$_POST['uemail'];
        $pass=$_POST['upass'];
//        $enc_pass=md5($pass);
        
        ///tries to communicate with the database and store the data
        
        try{
            $conn=new PDO('mysql:host=localhost:3306;dbname=careerbuilder;','root','');
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            //database code execute, default : warning generate
            $sqlquerystring="SELECT * FROM user WHERE username='$email' and password='$pass'";
            
            ///executing the mysql code
            $returnobj=$conn->query($sqlquerystring);
            ///product data found
            $tabledata=$returnobj->fetchAll();
            
            
            if($returnobj->rowCount()==1){
                ///login successful
                session_start();
                $_SESSION['useremail']=$email;
                foreach($tabledata AS $row)
                    $usertype= $row['usertype'];
                    echo $usertype;
                
                if($usertype=='recruiter'){
                      ?>

<script>
    location.assign('recruiterpage.php')
</script>
<?php
                }
                else{
                ?>

<script>
    location.assign('home.php')
</script>
<?php
              }
            }
            else{
                ///invalid user
                ?>

<script>
    alert('Incorrect Username or Password');
    location.assign('login.php')
</script>
<?php
            }
        }
        catch (PDOException $ex){
            ?>
<script>
    location.assign('login.php')
</script>
<?php
        }
    }
    else{
        //otherwise
        ?>
<script>
    location.assign('login.php')
</script>
<?php
    }
}
else{
    //we won't provide service
    echo "<script>location.assign('login.php')</script>";
}
?>