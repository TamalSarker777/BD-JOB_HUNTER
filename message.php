<?php
session_start();

if(
        isset($_SESSION['useremail'])
    &&  !empty($_SESSION['useremail'])
){
   $next_receiver="one";
    $last_message="none";
     $mail=$_SESSION['useremail'];
    ///already logged in user
    ?>
<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <title>MessagePage</title>

    <?php include "css.php"; ?>

</head>

<body>

           <div class="navbar">
              <div class="ui segment">
                  <div class="ui secondary  menu">
                      <input class="active item" type="button" value="BD Job Hunter" onclick="homefn();">
                      <input class="item" type="button" value="Post Job" onclick="postjobfn();">
                      <input class="active item" type="button" value="Message" onclick="messagefn();">
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

    <h2>Message</h2>

   
   <button class="ui basic button" onclick="sendmessagefn()">
<i class="big comment icon"></i>
  Start A New Chat
</button>
   
   
   
   
    <table >

        <tbody>


            <?php
                     try{
                         
                        $conn=new PDO('mysql:host=localhost:3306;dbname=careerbuilder;','root','');
                        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                         
                  
                         

                        //database code execute, default : warning generate
                          $sqlquerystring="
                        SELECT DISTINCT name, username
FROM user
JOIN message ON (user.username=message.sender)or(user.username=message.receiver)
WHERE ((message.sender='$mail') or (message.receiver='$mail')) AND user.username!='$mail'
ORDER BY  senton DESC,messageid DESC;
                        ";
                        $returnobj=$conn->query($sqlquerystring); 
                         
                        if($returnobj->rowCount()==0){
                            ///no data found
                             ?>
            <tr>

                <div class="ui message">
  <div class="header">
  </div>
  <p>No Message</p>
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
               
                    <div class="ui message" id="uimessage">
                        <div class="header">
                        <i class="envelope icon"></i>
   

                              
                               <?php
                                
                                
                                    echo $row['name'];
                                    echo  ": ";
                                    $next_receiver=$row['username'];    
                    
                    ?>  
                    
                    
                   
                       
                            
       <?php
                       
                       $sqlquerystring="SELECT * FROM `message`
WHERE (receiver='$mail' AND sender='$next_receiver') or   (sender='$mail' AND receiver='$next_receiver')
ORDER BY messageid ASC;
                        ";
                        $returnobj=$conn->query($sqlquerystring); 
                         
                
                            ///product data found
                            $tabledata=$returnobj->fetchAll();
                            
                            foreach($tabledata AS $row){
                                
                                $last_message=$row['message'] ;
                            }
                        echo $last_message;
                       
                       ?>
                        
                       </div>
                   
                           
                
                 <form action="sendmessage.php" method="POST">
                    <input type="text" name="pid" id="searchkey" Placeholder="ALL CAPITAL LETTER" value="<?php echo $next_receiver; ?>">
                    <br>
                    <input type="submit" class="ui button" value="Reply">
                </form>
<!--                 <input type="button" value="Reply" onclick="replyfn();">-->
<!--                 echo $next_receiver; -->
                 
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
<script>
    location.assign('login.php')
</script>
<?php
}

?>