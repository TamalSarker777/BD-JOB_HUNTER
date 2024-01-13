<?php
session_start();

if(
        isset($_SESSION['useremail'])
    &&  !empty($_SESSION['useremail'])
){
    ///already logged in
    $boosted=0;
    
    if( 
            isset($_POST['company'])
        &&  isset($_POST['info'])
        &&  isset($_POST['rating'])
       
        
        &&  !empty($_POST['company'])
        &&  !empty($_POST['info'])
        &&  !empty($_POST['rating'])
        
        
    ){
        $company=$_POST['company'];
        $info=$_POST['info'];
        $rating=$_POST['rating'];
       
        $username=($_SESSION['useremail']);
        
           try{
            $conn=new PDO('mysql:host=localhost:3306;dbname=careerbuilder;','root','');
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
             
             
           $sqlquerystring="INSERT INTO company VALUES('$company','$info',$rating) ";
            
            ///executing the mysql code
            $returnobj=$conn->query($sqlquerystring);
            ///product data found
            $tabledata=$returnobj->fetchAll();
               
                  
           $sqlquerystring="INSERT INTO recruiter VALUES('$username',$company') ";
            
            ///executing the mysql code
            $returnobj=$conn->query($sqlquerystring);
            ///product data found
            $tabledata=$returnobj->fetchAll();
 
           
            }
         
        catch (PDOException $ex){
            ?>
<script>
    location.assign('recruiterpage.php')
</script>
<?php
        }
}
    
    else{
        
        $company=$_POST['company'];
        $username=$_SESSION['useremail'];
        
        
            try{
            $conn=new PDO('mysql:host=localhost:3306;dbname=careerbuilder;','root','');
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
             
             
           $sqlquerystring="SELECT * FROM company WHERE company_name='$company' ";
            
            ///executing the mysql code
            $returnobj=$conn->query($sqlquerystring);
            ///product data found
            $tabledata=$returnobj->fetchAll();
               
            if($returnobj->rowCount()==1){
                
           $sqlquerystring="INSERT INTO recruiter VALUES('$username','$company') ";
            
            ///executing the mysql code
            $returnobj=$conn->query($sqlquerystring);
            ///product data found
            $tabledata=$returnobj->fetchAll();
            
            }
             else{
                 
                  ?>
<p>Seems Your Comapny is a Startup Company.Please Provide Us Some Details About It</p>
<div class="companyinfo">
    <form action="updatecompanyinfo.php" method="POST">
        <level>Company Name:</level>
        <input type="text" name="company" id="company" Placeholder="ALL CAPITAL LETTER" value='<?php echo $company?>'>
        <br><br>
        <level>Company Info:</level>
        <input type="text" name="info" id="info" Placeholder="info">
        <br><br>
        <level>Ratings:</level>
        <input type="text" name="rating" id="rating" Placeholder="x.x">
        <br><br>

        <input type="submit" value="Submit">


    </form>

</div>
<?php
                 
                 
                 
             }   
                
 
           
            }
         
        catch (PDOException $ex){
            ?>
<script>
//    alert("Problem is Here")
//    location.assign('recruiterpage.php')
</script>
<?php
        }
        
        
        
        
        
       
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