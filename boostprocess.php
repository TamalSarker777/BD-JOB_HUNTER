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
    $upid=$_GET['pid'];
    $boost=0;
    $applicant=$_SESSION['useremail'];
    $username=$_SESSION['useremail'];
     $presenttime=date("Y-m-d");
    
     try{
            $conn=new PDO('mysql:host=localhost:3306;dbname=careerbuilder;','root','');
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
             
             
           $sqlquerystring="SELECT * FROM payment WHERE username='$username' and expire>='$presenttime'";
            
            ///executing the mysql code
            $returnobj=$conn->query($sqlquerystring);
            ///product data found
            $tabledata=$returnobj->fetchAll(); 
    
               
            if($returnobj->rowCount()==0){
                ?>
 <script>
     alert('You need to  Subscribed Frist!!!');
     location.assign('subscriebe.php')
 </script>
 <?php   
         }
         
         
         else{
             
                try{
                         
                        $conn=new PDO('mysql:host=localhost:3306;dbname=careerbuilder;','root','');
                        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                         
                         $mail=$_SESSION['useremail'];
                         

                        //database code execute, default : warning generate
                        $sqlquerystring="SELECT * FROM jobs WHERE jobid='$upid'";
                        $returnobj=$conn->query($sqlquerystring); 
                         
                         
            
                            ///product data found
                            $tabledata=$returnobj->fetchAll();
                         foreach($tabledata AS $row){
                                ///$row = array(id=>1,name=>lays,imagepath=>folder/file.jpg,…)
                                
                                ?>

                                 <?php $boost= $row['boosted']; ?>
                                 <?php echo $boost;
                            }
                    
                    
                     if($boost=='1'){
      ?>
 <script>
     alert('Already Boosted');
     location.assign('recruiterpage.php')
 </script>
 <?php
 }
                    
                else{
                        $sqlquerystring="UPDATE jobs SET  boosted ='1' WHERE jobid='$upid'";
                         $conn->query($sqlquerystring);
                          ///product data found
                         $sqlquerystring="SELECT * FROM jobs WHERE jobid='$upid'";
                        $returnobj=$conn->query($sqlquerystring);
                        $tabledata=$returnobj->fetchAll();
                           
                            $company="";
                            $post="";
                            foreach($tabledata AS $row){
                                $company=  $row['company_name'];
                                $post=  $row['jobtitle'];
                                
                            }
                             $sqlquerystring="INSERT INTO notificatiion VALUES(NULL,'boost','You have Boosted  the Job post for $post of $company Company','$applicant')";
             
                            $conn->exec($sqlquerystring);

                                
                            
                         
                          ?>


 <script>
     alert('JOB Boosted Succesfully!!!');
     location.assign('recruiterpage.php')
 </script>
 <?php
     
}
                    
                    
          
                    
                     }
            catch (PDOException $ex){
                        ?>
 catch No data found

 <?php
                    } 
                           
  
         }
         
         

        
     }
        catch (PDOException $ex){
                        ?>
 catch No data found

 <?php
                    }   
        

    
    
   }
    else{
         ?>
 <script>
     location.assign('recruiterpage.php')
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