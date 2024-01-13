  <?php
session_start();

if(
        isset($_SESSION['useremail'])
    &&  !empty($_SESSION['useremail'])
){
    ///already logged in user
    $mail=$_SESSION['useremail'];
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
                      <input class="active item" type="button" value="BD Job Hunter" onclick="homefn();">
                      <input class="item" type="button" value="Post Job" onclick="postjobfn();">
                      <input class="item" type="button" value="Message" onclick="messagefn();">
                      <input class="item" type="button" value="notification" onclick="notificationfn();">
                      <input class="item" type="button" value="Subscription" onclick="subscriebefn();">

                      <div class="right menu">
                          <div class="item">
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
                    
          <?php
                    $conn=new PDO('mysql:host=localhost:3306;dbname=careerbuilder;','root','');
                        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
             $sqlquerystring="SELECT * FROM recruiter WHERE username='$mail'";
            
            ///executing the mysql code
            $returnobj=$conn->query($sqlquerystring);
            ///product data found
            $tabledata=$returnobj->fetchAll();
            
            
            if($returnobj->rowCount()==0){
                ?>
                                    
 <div class="companyinfo">
        <h2>Please Enter Your Company Name to complete Your Profile</h2>
        <form action="updatecompanyinfo.php" method="POST">
            <level>Company Name:</level>
            <input type="text" name="company" id="company" Placeholder="ALL CAPITAL LETTER">
        
            <input type="submit" value="Submit">


        </form>

    </div>
 
                 <?php
                }
    else{
        
          try{
              ?>
              
              <h3>Employee Profile</h2>
              <?php
              
                         
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
  <div class="card" id="recprofile">
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
                    

  

           
            <h3>Posted JOB</h3>
            <table>
                <tbody>
            
                    
             <?php
                     try{
                         
                        $conn=new PDO('mysql:host=localhost:3306;dbname=careerbuilder;','root','');
                        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                         
                         $mail=$_SESSION['useremail'];
                         

                        //database code execute, default : warning generate
                        $sqlquerystring="SELECT * FROM jobs WHERE recruiter='$mail'";
                        $returnobj=$conn->query($sqlquerystring); 
                         
                        if($returnobj->rowCount()==0){
                            ///no data found
                             ?>
                                <tr>
                                    <td colspan="10">DIDN'T POST ANY JOB YET   <input id="nodatafound" type="button" value=" Want to Hire Now!!?" onclick="postjobfn();"></td>
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
                                          <div class="ui icon message">
                                        <i class="briefcase icon"></i>
                                        <div class="content">
                                            <div class="header">
                                                Post: <?php echo $row['jobtitle']; ?><br>
                                                Company: <?php echo $row['company_name']; ?>
                                            </div>
                                            <div class="meta">

                                                Type:<?php echo $row['jobtype']; ?><br>
                                                Salary: <?php echo  $row['salary']?><br>
                                         

                                            </div>
                                            <div class="description">
                                                Location: <?php echo  $row['location']; ?><br>
                                                Details: <?php echo $row['jobdescription'] ?><br>
                                                   <span style="color:red">**Deadline:</span>
                                            <?php echo $row['deadline'] ?><br>
                                                #<?php echo $row['jobkeywords'] ?><br>
                                                
                                            </div>
                                             <div class="ui basic buttons">
                                                <div class="ui  basic green button" onclick="statusfn(<?php echo $row['jobid'];  ?>);"> Applicant Status</div>     
                                            </div>

                                            
                                        </div>
                                        <div class="extra content">
                                            <div class="ui  basic buttons">
                                                <div class="ui basic green button" onclick="updatefn(<?php echo $row['jobid']; ?>);">Update</div>
                                            </div>

                                            <div class="ui  basic buttons">
                                                <div class="ui basic green button" onclick="boostfn(<?php echo $row['jobid']; ?>);">Boost</div>
                                            </div>
                                            
                                            <div class="ui  basic buttons">
                                                <div class="ui basic green button" onclick="deletefn(<?php echo $row['jobid']; ?>);">Delete</div>
                                            </div>
                                        
                                        
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
            
            <br> <br>
            
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
        <script>location.assign('login.php')</script>
    <?php
}

?>
