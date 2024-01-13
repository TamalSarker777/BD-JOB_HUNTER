<?php
session_start();

if(
        isset($_SESSION['useremail'])
    &&  !empty($_SESSION['useremail'])
){
    ///already logged in
    
    ?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <title>Update recruiter profile Page</title>
      <?php include "css.php"; ?>

</head>

<body>
     <?php include "recruiterheader.php"; ?>
  

    <h4>Upload Profile Info HERE</h4>
    
        <?php
                     try{
                         
                        $conn=new PDO('mysql:host=localhost:3306;dbname=careerbuilder;','root','');
                        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                         
                         $mail=$_SESSION['useremail'];
                         

                        //database code execute, default : warning generate
                        $sqlquerystring="SELECT * FROM user WHERE username='$mail'";
                        $returnobj=$conn->query($sqlquerystring); 
                         
                         
            
                            ///product data found
                            $tabledata=$returnobj->fetchAll();
                           
                            
                            foreach($tabledata AS $row){
                                ///$row = array(id=>1,name=>lays,imagepath=>folder/file.jpg,…)
                                
                                ?>
                                   
                                   <form action="updatereqprofileprocess.php" method="POST">

         <label for="upass">Password: </label>
            <input type="text" id="upass" name="upass"  value="<?php echo $row['password']; ?>">
            <br><br>

            <label for="fname"> Name *</label>
            <input type="text" name="fname" id="fname" value="<?php echo $row['name']; ?>" required>
            <br><br>
            <label for="location"> Location *</label>
            <input type="text" name="location" id="location"  value="<?php echo $row['location']; ?>"required>
            <br><br>
            <label for="gender">Gender: </label>
            <br><br>
            <input type="radio" id="gender" name="gender" value="male" /> Male
            <input type="radio" id="gender" name="gender" value="female" /> Female <br />
            <br><br>

            <label for="dob">Date of Birth</label>
            <input type="date" name="dob" id="dob" value="<?php echo $row['dateofbirth']; ?>">
            <br><br>
            <label for="phone">Phone Number</label>
            <input type="text" name="phone" id="phone"  value="<?php echo $row['contact']; ?>">
            <br><br>
            
        <input type="submit" value="SUBMIT FOR UPDATE">
        <input type="reset" value="RESET">
    </form>
                                    
                                <?php
                                
                            }
                            
                        }
    
    
    
    
                     
    
    
    
    
                    catch (PDOException $ex){
                        ?>
                             catch No data found
                            
                        <?php
                    }
                    
                    ?> 
                     <?php include "recruiterfooter.php"; ?>
    
</body>

</html>

<?php
}
else{
    ?>
<script>
    location.assign('login.php')
</script>
<?php
}

?>