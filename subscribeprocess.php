
<?php
session_start();

if(
        isset($_SESSION['useremail'])
    &&  !empty($_SESSION['useremail'])
){
    ///already logged in
    if(
            isset($_POST['scheme'])
        &&  isset($_POST['method'])
        &&  !empty($_POST['scheme'])
         &&  !empty($_POST['method'])
    ){
        
         $scheme=$_POST['scheme'];
        $method=$_POST['method'];
        $username=$_SESSION['useremail'];
        $txnid = rand();   
        $amount=0;
        $paytime=date("Y-m-d");
        $expire=date("Y-m-d");
        
        if($scheme=="weekly"){
            $expire=date('Y-m-d', strtotime($paytime. ' + 7 days'));
             $amount=300;

            
        }
        else if($scheme=="monthly"){
             $amount=1000;
            
            $expire=date('Y-m-d', strtotime($paytime. ' + 1 months'));

        }
        else{
             $amount=8000;
          
            $expire=date('Y-m-d', strtotime($paytime. ' + 1 years'));

            
            
        }
   
        
//        echo $scheme;
//        echo $method;
//        echo $username;
//        echo $txnid;
//        echo $amount;
//        echo $paytime;
//        echo $expire;
//        
// 
             ///database section
         try{
            $conn=new PDO('mysql:host=localhost:3306;dbname=careerbuilder;','root','');
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
             
             
           $sqlquerystring="SELECT * FROM payment WHERE username='$username' and expire>='$paytime'";
            
            ///executing the mysql code
            $returnobj=$conn->query($sqlquerystring);
            ///product data found
            $tabledata=$returnobj->fetchAll();
            
            
            if($returnobj->rowCount()>=1){
                ?>
                <script>
                    alert('You have Subscribed Already!!!');
                    location.assign('recruiterpage.php')
                    
</script>
          <?php
           
            }
             else{
                        //database code execute, default : warning generate
            $sqlquerystring="INSERT INTO payment VALUES('$txnid','$method','$amount','$paytime','$scheme','$expire','$username')";
             
            $conn->exec($sqlquerystring);
                 
            $sqlquerystring="INSERT INTO notificatiion VALUES(NULL,'subscriebe','You have Subcribed $scheme Subscription till $expire For $amount Taka. Transaction id is $txnid. Please keep this id and Pay us Throw $method','$username')";
             
            $conn->exec($sqlquerystring);
                 
                 
           
             
             ?>
<script>
    alert('You have Subscribed Succesfully!!!');
    location.assign('recruiterpage.php')
</script>

<?php
                              
         }
                    
     
        }
        catch (PDOException $ex){
            ?>
<script>
    location.assign('subscriebe.php')
</script>
<?php
        }
        
        
        
    }
    else{
         ?>
            <script>location.assign('subscriebe.php')</script>
        <?php
    }
}
else{
    ?>
        <script>location.assign('login.php')</script>
    <?php
}

?>


 
   