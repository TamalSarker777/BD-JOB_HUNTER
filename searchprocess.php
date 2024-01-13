<?php
session_start();

if(
        isset($_SESSION['useremail'])
    &&  !empty($_SESSION['useremail'])
){
    ///already logged in user
    
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
          <input class="item" type="button" value="BD Job Hunter" onclick="homefn();">
          <input class="  item" type="button" value="Profile" onclick="profilefn();">
           
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

   
   <h2> <span style="color:green; text-align:center;">Available Jobs</span></h2>  

    <table >
        
        <tbody>


            <?php
                     try{
                         
                        $conn=new PDO('mysql:host=localhost:3306;dbname=careerbuilder;','root','');
                        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                         
                         $mail=$_SESSION['useremail'];
                         

                        //database code execute, default : warning generate
                        $sqlquerystring="SELECT * FROM jobs WHERE (company_name='$pid') OR (location='$pid') OR (jobtype='$pid')OR (salary>='$pid') OR (jobkeywords='$pid')  ORDER BY boosted DESC ,deadline ASC";
                        $returnobj=$conn->query($sqlquerystring); 
                         
                        if($returnobj->rowCount()==0){
                            ///no data found
                             ?>
            <tr>
                <img src="images/depressed.PNG" alt="Dogo Pic">
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

                                            
                                        </div>
                                        <div class="extra content">

                                          
                                            <div class="ui huge buttons">
                                                <div class="ui basic green button" onclick="applyfn(<?php echo $row['jobid']; ?>);"> APPLY</div>
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
    <?php include "userfooter.php"; ?>

</body>

</html>

<?php
             
         
    }
    else{
       ?>
        <script>location.assign('Home.php')</script>
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