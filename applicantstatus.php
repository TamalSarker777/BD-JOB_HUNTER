<?php
session_start();

if(
        isset($_SESSION['useremail'])
    &&  !empty($_SESSION['useremail'])
){
    ///already logged in user
    if(
            isset($_GET['pid'])
        && !empty($_GET['pid'])
    ){

         $upid=$_GET['pid'];
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
                                      <input type="text" name="pid" id="pid" Placeholder="ALL CAPITAL LETTER">
                                      <input type="submit" value="Search">
                                  </form>
                                  <input class="item" type="button" value="Logout" onclick="logoutfn();">

                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              
          </div>
 
                    
            <h2>Applicant List For this Job</h2>
            <?php $id=0; ?>
            
            <table class="ui celled table">
                <thead>
                    <tr>
                         <th>Serial</th>
                        <th>Applicant</th>
                        <th>Status</th>
                        <th>Confirmation</th>
                    </tr>
                </thead>
                <tbody>
                    
             <?php
                     try{
                         
                        $conn=new PDO('mysql:host=localhost:3306;dbname=careerbuilder;','root','');
                        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                         
                         $mail=$_SESSION['useremail'];
                         

                        //database code execute, default : warning generate
                        $sqlquerystring="SELECT * FROM appointment WHERE jobid='$upid'";
                        $returnobj=$conn->query($sqlquerystring); 
                         
                        if($returnobj->rowCount()==0){
                            ///no data found
                             ?>
                                <tr>
                                    <td colspan="4">No one Applied Yet</td>
                                </tr>
                            <?php
                        } 
                        else{
                            ///product data found
                            $tabledata=$returnobj->fetchAll();
                            
                            $serial=1;
                            
                            foreach($tabledata AS $row){
                                ///$row = array(id=>1,name=>lays,imagepath=>folder/file.jpg,…)
                                
                                ?>
                                 <tr>
                                    <td><?php  echo $serial; $serial=$serial+1;?></td>
                
                                    <td><?php echo $row['applicant']; ?></td>
                                    <td><?php echo $row['status']; ?></td>
                                   
                                     <td>
   <input type="button" class="ui green button" value="Accept" onclick="acceptfn(<?php echo $row['id']; ?>);">
    <input type="button" class="ui red button" value="Reject" onclick="rejectfn(<?php echo $row['id']; ?>);">


                                     </td>
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
         ?>

    <?php
}
else{
    ?>
        <script>location.assign('login.php')</script>
    <?php
}

?>
