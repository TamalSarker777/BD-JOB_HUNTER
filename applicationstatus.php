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
          <input class="item" type="button" value="BD Job Hunter" onclick="homefn();">
          <input class="  item" type="button" value="Profile" onclick="profilefn();">
           
           <?php include "dropdown.php"; ?>
           

            <input class="item" type="button" value="Message" onclick="messagefn();">
            <input class="item" type="button" value="Notification" onclick="notificationfn();">
            <input class=" active item" type="button" value="Application Status" onclick="statusfn();">
            <input class=" item" type="button" value="Suggest JOB" onclick="suggestfn();">
        
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

    <h2>Aplication Status</h2>
    <?php $id=0; ?>

    <table >
   
        <tbody>


            <?php
                     try{
                         
                        $conn=new PDO('mysql:host=localhost:3306;dbname=careerbuilder;','root','');
                        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                         
                         $mail=$_SESSION['useremail'];
                         

                        //database code execute, default : warning generate
                        $sqlquerystring="SELECT * FROM appointment  WHERE applicant='$mail' ";
                        $returnobj=$conn->query($sqlquerystring); 
                         
                        if($returnobj->rowCount()==0){
                            ///no data found
                             ?>
            <tr>
                <td colspan="2">DIDN'T APPLY FOR ANY JOB YET <input id="nodatafound" type="button" value=" Want to Apply for Jobs!!?" onclick="homefn();"></td>
            </tr>
            <?php
                        } 
                        else{
                            ///product data found
                            $tabledata=$returnobj->fetchAll();
                            $jobid;
                            foreach($tabledata AS $row){
                                ///$row = array(id=>1,name=>lays,imagepath=>folder/file.jpg,…)
                            $jobid=$row['jobid'];
                        $sqlquerystring="SELECT * FROM jobs  WHERE jobid=$jobid ";
                        $returnobj=$conn->query($sqlquerystring);
                         $tabledata2=$returnobj->fetchAll();
                        foreach($tabledata2 AS $row2){
                            
                         
                           
                            
                            
                            ?>
                               <tr>

                <div class="ui cards">
                    <div class="card" id="jobstatus">
                        <div class="content">
                            <div class="header">
                                Job Title: <?php echo $row2['jobtitle'];?><br>
                                Comapny: <?php    echo  $row2['company_name'];?><br>
                            </div>
                            <div class="meta">
                               <?php  echo  $row2['salary'];?><br>
                               <?php echo  $row2['location'];?><br>
                            </div>
                            <div class="description">
                               <?php echo  $row2['jobdescription'];?><br>
                            </div>
                        </div>
                        <div class="extra content">
                                <div class="ui basic green button">Status: <?php echo  $row['status']?></div>     
                        </div>
                    </div>
                </div>

            </tr>
                            
                            
                            
                            
                            
                         <?php    
                        }
                            ?>
         
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
<script>
    location.assign('login.php')
</script>
<?php
}

?>