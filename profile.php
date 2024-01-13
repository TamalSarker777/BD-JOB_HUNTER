<?php
session_start();

if(
        isset($_SESSION['useremail'])
    &&  !empty($_SESSION['useremail'])
){
    ///already logged in user
    ?>
<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <title>Home Page</title>

      <?php include "css.php"; ?>

</head>

<body>
     <div class="navbar">
              <div class="ui segment">
    <div class="ui secondary  menu">
          <input class="item" type="button" value="BD Job Hunter" onclick="homefn();">
          <input class=" active  item" type="button" value="Profile" onclick="profilefn();">
           
           <?php include "dropdown.php"; ?>
           

            <input class="item" type="button" value="Message" onclick="messagefn();">
            <input class="item" type="button" value="Notification" onclick="notificationfn();">
            <input class="item" type="button" value="Application Status" onclick="statusfn();">
            <input class="item" type="button" value="Suggest JOB" onclick="suggestfn();">
        
  <div class="right menu">
    <div class="item">
      <div class="ui icon input">
       <form action="searchprocess.php" method="POST">
                <input type="text" name="pid" id="pid" Placeholder="Search here">
                <input type="submit"  value="Search">
               
            </form>
            <input class="item" type="button" value="Logout" onclick="logoutfn();">
        
      </div>
    </div>
  </div>
</div>
     </div>
</div>
    
     <div class="profile">
 
    

<!--    <h2>PROFILE</h2>-->
    <?php $id=0; ?>
    
   


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
                                
                            
 
 
    
<div class="ui cards">
  <div class="card" id="uicard">
    <div class="content">
      <img class="right floated mini ui image" src="images/maleavatar.png">
      <div class="header">
        <?php echo $row['name']; ?> <br><br>
      </div>
      <div class="meta">
        PHONE No: <?php echo $row['contact']; ?> <br>
        Email: <?php echo $row['username']; ?> <br><br>
      </div>
      <div class="description">
        DATE of Birth: <?php echo $row['dateofbirth']; ?> <br>
            Gender: <?php echo $row['gender']; ?> <br>
            Location: <?php echo $row['location']; ?> <br><br>
      </div>
    </div>
     <div class="extra content">
    <button class="ui small green button" onclick="profileupdatefn();">UPDATE PROFILE</button>
  </div>
</div>

</div>

    <br><br>
    <?php
                                
                            }
                            
                        }
    
                    catch (PDOException $ex){
                        ?>
    catch No data found

    <?php
                    }
                    
                    ?>
   </div> <br><br>
    


            <?php
                     try{
                         
                        $conn=new PDO('mysql:host=localhost:3306;dbname=careerbuilder;','root','');
                        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                         
                         $mail=$_SESSION['useremail'];
                         

                        //database code execute, default : warning generate
                        $sqlquerystring="SELECT * FROM cv WHERE username='$mail'";
                        $returnobj=$conn->query($sqlquerystring); 
                         
                        if($returnobj->rowCount()==0){
                            ///no data found
                             ?>
            <tr>
     
         <h3> You didnt have uploaded any cv.</h3>  
        <input id="nodatafound" class="ui big green button" type="button" value="CREATE CV" onclick="cvuploadfn();">          
            </tr>
            <?php
                        } 
                        else{
                            ///product data found
                            $tabledata=$returnobj->fetchAll();
                            
                            foreach($tabledata AS $row){
                                ///$row = array(id=>1,name=>lays,imagepath=>folder/file.jpg,…)
                                
                                ?>                    
                                
                                
            <tr>
               <form class="ui form">
   <h4 class="ui dividing header">Curriculum vitae</h4>
   <div class="field">
    <label>Name</label>
    <input type="text" name="first-name" placeholder=" Name" value="<?php echo $row['fullname']; ?>" readonly>
  </div>
   
   <h4 class="ui dividing header">Qualifications</h4>
     <div class="field">
   
    <div class="two fields">
      <div class="field">
       <label>Education</label>
        <input type="text" name="shipping[first-name]" placeholder="First Name" value="<?php echo $row['education']; ?>" readonly>
      </div>
      <div class="field">
        <label>Skills</label>
        <input type="text" name="shipping[last-name]" placeholder="Last Name" value="<?php echo $row['skills']; ?>" readonly>
      </div>
       
    </div>
    </div>
    
       <h4 class="ui dividing header">Interest And Language</h4>
     <div class="field">
   
    <div class="two fields">
      <div class="field">
       <label>Interested In</label>
        <input type="text" name="shipping[first-name]" placeholder="First Name" value="<?php echo $row['interest']; ?>" readonly>
      </div>
      <div class="field">
        <label>Language</label>
        <input type="text" name="shipping[last-name]" placeholder="Last Name" value="<?php echo $row['language']; ?>" readonly>
      </div>
      
    </div>
    </div>
    
 <div class="field">
    <h4 class="ui dividing header">Awards and Experience</h4>
    <div class="two fields">
      <div class="field">
       <label>Certification</label>
        <input type="text" name="shipping[first-name]" placeholder="First Name" value="<?php echo  $row['certification']?>" readonly>
      </div>
      <div class="field">
        <label>Experience</label>
        <input type="text" name="shipping[last-name]" placeholder="Last Name" value="<?php echo $row['experience'] ?>" readonly>
      </div>
    </div>
    
  </div>
   <div class="field">
    <h4 class="ui dividing header">References and Contacts</h4>
    <div class="three fields">
      <div class="field">
       <label>Reference</label>
        <input type="text" name="shipping[first-name]" placeholder="First Name"  value="<?php echo $row['reference'] ?>" readonly>
      </div>
      <div class="field">
        <label>Social Media Links</label>
       <a href="<?php echo $row['links'] ?>" target="_blank"> <input type="text" name="shipping[last-name]" placeholder="Last Name" value="<?php echo $row['links'] ?>" readonly>   </a>
      </div>
      <div class="field">
        <label>Email</label>
        <input type="text" name="shipping[last-name]" placeholder="Last Name" value="<?php echo $row['username']; ?>" readonly>
      </div>
    </div>
    
  </div>
  
  
   <div class="ui huge buttons">
       <div class="ui basic green button" onclick="cvupdatefn();"> Update CV</div>
   </div>
</form> 


            </tr>
            <?php
                                
                            }
                            
                        }
                            
                        }
    
                    catch (PDOException $ex){
                        ?>
            catch No data found

            <?php
                    }
                   
                    ?>


    <?php include "userfooter.php"; ?>

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