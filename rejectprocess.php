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
        
         $applyid=$_GET['pid'];
        $recruiter=$_SESSION['useremail'];
        
       
             ///database section
         try{
            $conn=new PDO('mysql:host=localhost:3306;dbname=careerbuilder;','root','');
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            
            $sqlquerystring="SELECT * FROM appointment WHERE id=$applyid ";
             $returnobj=$conn->query($sqlquerystring); 
              $tabledata=$returnobj->fetchAll();
             
             $status=" ";
                            
            foreach($tabledata AS $row){
                 $status=$row['status'];
                
            }
             
            if($status=="pending"){
                
                
                $sqlquerystring="UPDATE `appointment` SET `recruitant`='$recruiter',`status`='Accepted' WHERE id=$applyid ";
            
            ///executing the mysql code
            $conn->query($sqlquerystring);
             
             $applicant;
             $jobtitle;
             $company;
             $jobid;
                
            $sqlquerystring="SELECT * FROM appointment WHERE id=$applyid ";
             $returnobj=$conn->query($sqlquerystring); 
              $tabledata=$returnobj->fetchAll();
                            
            foreach($tabledata AS $row){
                 $applicant=$row['applicant'];
                 $jobid=$row['jobid'];
                
            } 
                

           $sqlquerystring="SELECT * FROM jobs WHERE jobid=$jobid ";
             $returnobj=$conn->query($sqlquerystring); 
              $tabledata=$returnobj->fetchAll();
             foreach($tabledata AS $row){
                  $company=  $row['company_name'];
                 $jobtitle=  $row['jobtitle'];
                
            }
//             echo $applicant;
//             echo $company;
//             echo $jobtitle;
//             echo $recruiter;
//             echo $jobid;
//             echo $applyid;
//             
            $sqlquerystring="INSERT INTO notificatiion VALUES(NULL,'confirmation','Your Application for the $jobtitle post of $company Company has been Rejected','$applicant')";
            $conn->exec($sqlquerystring);
             
           
          
             
                        ?>
<script>
    alert("Choice Have been Made!!!")
    location.assign('applicantstatus.php')
</script>
<?php
                
                
                
            }
    else{
        ?>
<script>
    alert("Choice have Been Made Already!!!")
    location.assign('applicantstatus.php')
</script>

<?php
        
    }
             
             
             
             
           
            
        
                    
     
        }
        catch (PDOException $ex){
            ?>
<script>
    wrong1

    //    location.assign('applicantstatus.php')
</script>
<?php
        }
        
        
        
    }
    else{
         ?>
wrong2
<!--            <script>location.assign('applicantstatus.php')</script>-->
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