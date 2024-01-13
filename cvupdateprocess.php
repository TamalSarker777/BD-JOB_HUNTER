<?php
session_start();

if(
        isset($_SESSION['useremail'])
    &&  !empty($_SESSION['useremail'])
){
    ///already logged in
    
    if( 
            isset($_POST['fullname'])
        &&  isset($_POST['education'])
        &&  isset($_POST['skills'])
        &&  isset($_POST['language'])
        &&  isset($_POST['certification'])
        &&  isset($_POST['experience'])
        &&  isset($_POST['interest'])
        &&  isset($_POST['reference'])
        &&  isset($_POST['links'])
        
        
        &&  !empty($_POST['fullname'])
        &&  !empty($_POST['education'])
        &&  !empty($_POST['skills'])
        &&  !empty($_POST['language'])
        &&  !empty($_POST['certification'])
        &&  !empty($_POST['experience'])
        &&  !empty($_POST['interest'])
         &&  !empty($_POST['reference'])
         &&  !empty($_POST['links'])
        
    ){
        $fullname=$_POST['fullname'];
        $education=$_POST['education'];
        $skills=$_POST['skills'];
        $language=$_POST['language'];
        $certification=$_POST['certification'];
        $experience=$_POST['experience'];
        $interest=$_POST['interest'];
        $reference=$_POST['reference'];
        $links=$_POST['links'];
        $username=($_SESSION['useremail']);
//        
//        echo $fullname;
//        echo $education;
//        echo $skills;
//        echo $language;
//        echo $certification;
//        echo $reference;
//        echo $links;
//        echo $interest;
//        echo $experience;
//        echo $username;
        
        
           ///database section
         try{
            $conn=new PDO('mysql:host=localhost:3306;dbname=careerbuilder;','root','');
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            
            //database code execute, default : warning generate
            $sqlquerystring="UPDATE cv SET fullname='$fullname',education='$education',skills='$skills',language='$language',certification='$certification',experience='$experience',interest='$interest',reference='$reference',links='$links'  WHERE username='$username' ";
             
            $conn->exec($sqlquerystring);
             
      
             
             ?>
<script>
    alert('CV updated Succesfully!!!');
    location.assign('profile.php')
</script>
<?php
        }
        catch (PDOException $ex){
            ?>
<script>
   
    location.assign('cvupdate.php')
</script>
<?php
        }
        
        
         
        
        
    }
    else{
        ?>
<script>
     alert("Please Fill up the Form Correctly")
    location.assign('cvupdate.php')
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