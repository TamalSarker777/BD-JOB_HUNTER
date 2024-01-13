<?php
session_start();

if(
        isset($_SESSION['useremail'])
    &&  !empty($_SESSION['useremail'])
){
    ///already logged in
    $boosted=0;
    
    if( 
            isset($_POST['company'])
        &&  isset($_POST['title'])
        &&  isset($_POST['type'])
        &&  isset($_POST['detail'])
        &&  isset($_POST['salary'])
        &&  isset($_POST['location'])
        &&  isset($_POST['keyword'])
        &&  isset($_POST['deadline'])
        
        &&  !empty($_POST['company'])
        &&  !empty($_POST['title'])
        &&  !empty($_POST['type'])
        &&  !empty($_POST['detail'])
        &&  !empty($_POST['salary'])
        &&  !empty($_POST['location'])
        &&  !empty($_POST['keyword'])
        &&  !empty($_POST['deadline'])
        
        
    ){
        $company=$_POST['company'];
        $title=$_POST['title'];
        $type=$_POST['type'];
        $detail=$_POST['detail'];
        $salary=$_POST['salary'];
        $location=$_POST['location'];
        $keyword=$_POST['keyword'];
        $deadline=$_POST['deadline'];
        $username=($_SESSION['useremail']);
        $presenttime=date("Y-m-d");
        
//        echo $company;
//        echo $title;
//        echo $type;
//        echo $detail;
//        echo $salary;
//        echo  $location;
//        echo $keyword;
//        echo $deadline;
//        echo $username;
//        echo $boosted;
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
    alert('You Have to Subscribe First To Post Job!!!');
    location.assign('subscriebe.php')
</script>
<?php
           
            }
             else{
                 
                 
                        ///database section
         try{
            $conn=new PDO('mysql:host=localhost:3306;dbname=careerbuilder;','root','');
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            
            //database code execute, default : warning generate
            $sqlquerystring="INSERT INTO jobs VALUES(NULL,'$title','$type','$detail','$salary','$location','$keyword',$boosted,'$deadline','$username','$company')";
             
            $conn->exec($sqlquerystring);
             
            ///uploading the file to our server folder
//            move_uploaded_file($tmp_file_path,$to); 
             
             ?>
<script>
    alert('JOB Posted Succesfully!!!');
    location.assign('recruiterpage.php')
</script>
<?php
        }
        catch (PDOException $ex){
            ?>
<script>
    location.assign('postjob.php')
</script>
<?php
        }
                 
                 
                 
             }
        

        
        
    }
        catch (PDOException $ex){
            ?>
<script>
    location.assign('subscriebe.php')
</script>
<?php
        }
    }
    else{
        ?>
<script>
    location.assign('postjob.php')
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