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
                      <input class="active item" type="button" value="BD Job hunter" onclick="homefn();">
                      <input class="item" type="button" value="Post Job" onclick="postjobfn();">
                      <input class="item" type="button" value="Message" onclick="messagefn();">
                      <input class="active item" type="button" value="notification" onclick="notificationfn();">
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
            <h2>Notification</h2>
              <table id="ptable">

        <tbody>


            <?php
                     try{
                         
                        $conn=new PDO('mysql:host=localhost:3306;dbname=careerbuilder;','root','');
                        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                         
                         $mail=$_SESSION['useremail'];
                         

                        //database code execute, default : warning generate
                        $sqlquerystring="SELECT * FROM notificatiion  WHERE receiver='$mail'  ORDER BY notificationid DESC  ";
                        $returnobj=$conn->query($sqlquerystring); 
                         
                        if($returnobj->rowCount()==0){
                            ///no data found
                             ?>
            <tr>
              <div class="ui card">
  <div class="content">
   
  <div class="content">
    <div class="ui small feed">
      <div class="event">
        <div class="content">
          <div class="summary">
             No new Notification
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
                </div>
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
            
                
<div class="ui message">
  <div class="header">
     <i class="big bell icon"></i><?php echo $row['type']; ?>
  </div>
  <p><?php echo $row['details']; ?></p>
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
        <script>location.assign('login.php')</script>
    <?php
}

?>
