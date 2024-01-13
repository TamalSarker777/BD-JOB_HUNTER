<?php
session_start();

if(
        isset($_SESSION['useremail'])
    &&  !empty($_SESSION['useremail'])
){
    ///already logged in user
    
     if(
        isset($_GET['pid'])
    &&  !empty($_GET['pid']) )
    {
         $pid= $_GET['pid'];
        
    ?>


            <?php
                     try{
                         
                        $conn=new PDO('mysql:host=localhost:3306;dbname=careerbuilder;','root','');
                        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                         
                         $mail=$_SESSION['useremail'];
                         

                        //database code execute, default : warning generate
                        $sqlquerystring="DELETE FROM jobs  WHERE jobid='$pid'";
                        $returnobj=$conn->query($sqlquerystring);
                         
                         ?>
        <script>
            alert("post deleted successfully")
            location.assign('recruiterpage.php')
</script>
    <?php
                         
                       
                            
                        }
    
                    catch (PDOException $ex){
                        ?>
            catch No data found

            <?php
                    }
                   
    
         
    }
    else{
       ?>
        <script>location.assign('recruiterpage.php')</script>
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