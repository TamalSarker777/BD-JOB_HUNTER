<?php
session_start();

if(
        isset($_SESSION['useremail'])
    &&  !empty($_SESSION['useremail'])
){
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
                      <input class=" item" type="button" value="BD Job Hunter" onclick="homefn();">
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
<?php
 
  $receiver="none";
     if(
         isset($_POST['pid'])
        && !empty($_POST['pid'])
        
    ){
         $receiver=$_POST['pid'];
//         echo $receiver;
         ?>
       <h2>Message</h2>
          <div>
         <form action="sendmessageprocess.php" method="POST">
             <div class="ui form"  >
                <div class="three fields">
                   <div class="field">
                       <label for="receiver">TO:</label>
            <input type="text" name="receiver" id="receiver" placeholder="Enter receiver Username" value="<?php echo $receiver; ?>" readonly >
                       
                   </div>                  
                </div>                  
             </div>
            
<!--            <input type="text" name="receiver" id="receiver" placeholder="Enter receiver Username" v>-->
            
            
            
            <br><br>
           
            <table> 
        <tbody>





            <?php
                     try{
                         
                        $conn=new PDO('mysql:host=localhost:3306;dbname=careerbuilder;','root','');
                        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                         
                         $mail=$_SESSION['useremail'];
                         

                        //database code execute, default : warning generate
                        $sqlquerystring="SELECT  * FROM message WHERE (sender= '$receiver' and receiver='$mail') or (sender= '$mail' and receiver='$receiver') ORDER BY messageid ASC; ";
                        $returnobj=$conn->query($sqlquerystring); 
                         
                        if($returnobj->rowCount()==0){
                            ///no data found
                             ?>
            <tr>
<!--                No Previous message-->
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
             <div class="ui form">
                 <div class="inline fields">
                     <div class="three wide field">
                         <input type="text" placeholder="Last Name" value="<?php echo $row['sender']; ?> :" readonly>
                         
                     </div>
                     <div class="twelve wide field">
                         <input type="text" placeholder="First Name" value="<?php echo $row['message']; ?>" readonly>
                     </div>
                     <div class="two wide field">
                         <input type="text" placeholder="Middle Name" value="<?php echo $row['senton']; ?>" readonly>
                     </div>
                     <div class="two wide field">
                           <input type="button" class="ui button" value="Delete" onclick="deletesmsfn(<?php echo $row['messageid']; ?>);">
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
           <div class="ui form"  >
             <textarea id="message" name="message" rows="10" cols="50" placeholder="Enter Your message Here">  </textarea>
            
             </div>
             <br>
             
            <input class="ui big green button" type="submit" value="SEND"> 
             <br><br>
        </form>
    </div> 
       
       
       
     <?php     
     } 
    
    else{
        ?> 
         <h2>Message</h2>
         <div class="ui form"  >
         <form action="sendmessageprocess.php" method="POST"> 
           <div class="three fields">
                   <div class="field">
                       <label for="receiver">TO:</label>
            <input type="text" name="receiver" id="receiver" placeholder="Enter receiver Username"  >
                       
                   </div>                  
                </div>
<!--            <input type="text" name="receiver" id="receiver" placeholder="Enter receiver Username">-->
            <br><br>
   
            <textarea id="message" name="message" rows="10" cols="50" placeholder="Enter Your message Here">
  
  </textarea>
            <br><br>
<!--             <div class="ui button" type="submit"></div>-->
             <input type="submit" class="ui huge green button" value="Sent" >
             <br><br>
            

            
        </form>
    </div>
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