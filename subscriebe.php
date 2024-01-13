 <?php
session_start();

if(
        isset($_SESSION['useremail'])
    &&  !empty($_SESSION['useremail'])
){
    ///already logged in
     $presenttime=date("Y-m-d");
     $username=($_SESSION['useremail']);
    
    ?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <title>Subscriebe Page</title>
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
                      <input class="active item" type="button" value="Subscription" onclick="subscriebefn();">

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
                

    <div>
         <form action="subscribeprocess.php" method="POST" id="subcriebe">
           <div class="ui form">
               <h4 class="ui dividing header">Subscriebe information</h4>
               <div class="field">
                    <label for="scheme">subscription scheme: </label>
                   <div class="field">
                        <input type="radio" id="scheme" name="scheme" value="weekly" /> Weekly Subscriebe For 300 Taka
                        <br>
                        <input type="radio" id="scheme" name="scheme" value="monthly" /> Monthly Subscriebe For 1000 Taka
                        <br>
                        <input type="radio" id="scheme" name="scheme" value=" yearly" /> Yearly Subscriebe For 8000 Taka
                   </div>
                   <label for="method">Method: </label>
                   <div class="field">
                   <input type="radio" id="method" name="method" value="bkash" /> BKASH
                   <br>
                   <input type="radio" id="method" name="method" value="bank" /> BANK
                   </div>
               </div>
           </div>
            <br><br>
           
            <input type="submit" class="ui  green button" value="SUBSCIRBE">
        </form>
    </div>
                
                
                
                
                <?php
                }
           else{
               
            $sqlquerystring="SELECT * FROM payment WHERE username='$username' and expire>='$presenttime'";
            $returnobj=$conn->query($sqlquerystring);
            ///product data found
            $tabledata=$returnobj->fetchAll();
                foreach($tabledata AS $row){
                    ?>
                    <div class="ui message" id="subcriebe">
  <div class="header">
  
    <h1> <i class="thumbs up icon"></i>Thanks for The Subscription!!</h1>
  </div>
 <h3>You have <?php echo $row['scheme']; ?> Subcription Till <?php echo $row['expire']; ?> </h3>
</div>
                    
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