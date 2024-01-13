<?php
session_start();

if(
        isset($_SESSION['useremail'])
    &&  !empty($_SESSION['useremail'])
){
    ///already logged in user
    $next_receiver="none";
     if(
        isset($_POST['pid'])
    &&  !empty($_POST['pid']) )
    {
         $pid= $_POST['pid'];
        
    ?>
<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <title>Search Result Page</title>

     <?php include "css.php"; ?>


</head>

<body>

          <div class="navbar">
              <div class="ui segment">
                  <div class="ui secondary  menu">
                      <input class=" item" type="button" value="BD Job Hunter" onclick="homefn();">
                      <input class="item" type="button" value="Post Job" onclick="postjobfn();">
                      <input class="item" type="button" value="Message" onclick="messagefn();">
                      <input class="item" type="button" value="notification" onclick="notificationfn();">
                      <input class="item" type="button" value="Subscription" onclick="subscriebefn();">

                      <div class="right menu">
                          <div class=" active item">
                              <div class="ui icon input">
                                  <form action="cvsearchprocess.php" method="POST">
                                      <input type="text" name="pid" id="pid" Placeholder="Search here">
                                      <input type="submit" value="Search">
                                  </form>
                                  <input class="item" type="button" value="Logout" onclick="logoutfn();">

                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              
          </div>

   

    <h2>Search Result</h2>
    <?php $id=0; ?>

     <table >
       
        <tbody>


            <?php
                     try{
                         
                        $conn=new PDO('mysql:host=localhost:3306;dbname=careerbuilder;','root','');
                        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                         
                         $mail=$_SESSION['useremail'];
                         

                        //database code execute, default : warning generate
                        $sqlquerystring="SELECT * FROM cv WHERE fullname='$pid' OR skills='$pid' OR username='$pid' ";
                        $returnobj=$conn->query($sqlquerystring); 
                         
                        if($returnobj->rowCount()==0){
                            ///no data found
                             ?>
            <tr>
                No Result Found
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
               <div class="ui form" id="searchcv">

                   <h4 class="ui dividing header">Curriculum vitae</h4>
                   <div class="field">
                       <label>Name</label>
                       <input type="text" name="first-name" placeholder=" Name" value="<?php echo $row['fullname']; ?>" readonly>
                   </div>

                   <div class="field">
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
                       <div class="two fields">
                           <div class="field">
                               <label>Reference</label>
                               <input type="text" name="shipping[first-name]" placeholder="First Name" value="<?php echo $row['reference'] ?>" readonly>
                           </div>
                           <div class="field">
                               <label>Social Media Links</label>
                               <a href="<?php echo $row['links'] ?>" target="_blank"> <input type="text" name="shipping[last-name]" placeholder="Last Name" value="<?php echo $row['links'] ?>" readonly> </a>
                           </div>
                           
                       </div>
                       
                       <?php $next_receiver=$row['username']; ?>
                                
                       <form action="sendmessage.php" method="POST">
                          <label>Email</label>
                           <input type="text" name="pid" id="pid cvsearchmsg" Placeholder="ALL CAPITAL LETTER" value="<?php echo $next_receiver; ?>" readonly>
                           <input type="submit" class="ui green button" value="Contact" >
                       </form>

                   </div>
                   




               </div>



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

        </tbody>
    </table>
    <?php include "recruiterfooter.php"; ?>

</body>

</html>

<?php
             
         
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

