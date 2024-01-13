
<?php
session_start();

if(
        isset($_SESSION['useremail'])
    &&  !empty($_SESSION['useremail'])
){
    ///already logged in
    if(
            isset($_GET['pid'])
        && !empty($_GET['pid'])
    ){
        
        $jobid=$_GET['pid'];
        $applicant=$_SESSION['useremail'];
        $reqruitant="none";
        $status="pending";
   
        
           ///database section
         try{
            $conn=new PDO('mysql:host=localhost:3306;dbname=careerbuilder;','root','');
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
             
             
           $sqlquerystring="SELECT * FROM appointment WHERE applicant='$applicant' and jobid='$jobid'";
            
            ///executing the mysql code
            $returnobj=$conn->query($sqlquerystring);
            ///product data found
            $tabledata=$returnobj->fetchAll();
            
            
            if($returnobj->rowCount()>=1){
                ?>
                <script>
                    alert('You have Already applied this Job!!!');
                    location.assign('home.php')
                    
</script>
          <?php
           
            }
             else{
                        //database code execute, default : warning generate
                 
                 
                 
            $sqlquerystring="INSERT INTO appointment VALUES(NULL,'$applicant','$reqruitant','$status','$jobid')";
             
            $conn->exec($sqlquerystring);
                 
            
            $sqlquerystring="SELECT * FROM jobs WHERE jobid='$jobid'";
            
            ///executing the mysql code
            $returnobj=$conn->query($sqlquerystring);
            ///product data found
            $tabledata=$returnobj->fetchAll();
            
            $postname="";
            $company="";
             foreach($tabledata AS $row){
                                ///$row = array(id=>1,name=>lays,imagepath=>folder/file.jpg,…)
                                
                                
            
                 $company=$row['company_name'];
                 $postname=$row['jobtitle'];
                
            
                                
                            }
                 
            
                 
            $sqlquerystring="INSERT INTO notificatiion VALUES(NULL,'apply','You have applied for the  $postname post of $company company ','$applicant')";
             
            $conn->exec($sqlquerystring);
                 
                 
           
             
             ?>
<script>
    alert('You have applied for this Job Succesfully!!!');
    location.assign('home.php')
</script>

<?php
                              
         }
                    
     
        }
        catch (PDOException $ex){
            ?>
<script>
    location.assign('home.php')
</script>
<?php
        }
        
        
        
        
        
    }
    else{
         ?>
            <script>location.assign('home.php')</script>
        <?php
    }
}
else{
    ?>
        <script>location.assign('login.php')</script>
    <?php
}

?>


 
   