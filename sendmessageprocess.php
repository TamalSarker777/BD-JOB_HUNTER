<?php
session_start();

if(
        isset($_SESSION['useremail'])
    &&  !empty($_SESSION['useremail'])
){
    ///already logged in
   
    
    if( 
            isset($_POST['receiver'])
        &&  isset($_POST['message'])
        
        
        &&  !empty($_POST['receiver'])
        &&  !empty($_POST['message'])
       
        
    ){
        $receiver=$_POST['receiver'];
        $message=$_POST['message'];
        
        $senton=date("Y-m-d");
        $sender=($_SESSION['useremail']);
        
        

        
        ///database section
         try{
            $conn=new PDO('mysql:host=localhost:3306;dbname=careerbuilder;','root','');
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            
            //database code execute, default : warning generate
            $sqlquerystring="INSERT INTO message VALUES(NULL,'$message','$senton','$sender','$receiver')";
             
            $conn->exec($sqlquerystring);
             
            ///uploading the file to our server folder
//            move_uploaded_file($tmp_file_path,$to); 
             
             ?>
<script>
//    alert('Message Sent Succesfully!!!');
    location.assign('message.php')
</script>
<?php
        }
        catch (PDOException $ex){
            ?>
<script>
    alert("user Does Not Exist!!!")
    location.assign('sendmessage.php')
</script>
<?php
        }
        
        
        
    }
    else{
        ?>
<script>
    location.assign('sendmessage.php')
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