 <?php
session_start();

if(
        isset($_SESSION['useremail'])
    &&  !empty($_SESSION['useremail'])
){
    ///already logged in
    
    ?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <title>PostJob Page</title>
      <?php include "css.php"; ?>
</head>

<body>
           <div class="navbar">
              <div class="ui segment">
                  <div class="ui secondary  menu">
                      <input class=" item" type="button" value="BD Job Hunter" onclick="homefn();">
                      <input class="active item" type="button" value="Post Job" onclick="postjobfn();">
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
   

    <div id="postjob">
         <form action="postjobprocess.php" method="POST">
            <div class="ui form">
  <h4 class="ui dividing header">Job Information</h4>
  <div class="field">
    
    <div class="three fields">
      <div class="field">
       <label>company</label>
        <input type="text" name="company" placeholder="company">
      </div>
      <div class="field">
       <label>Job title</label>
        <input type="text" name="title" placeholder="title">
      </div>
      <div class="field">
       <label>Job type</label>
        <input type="text" name="type" placeholder="type">
      </div>
    </div>
    <div class="field">
       <label>Job Description</label>
        <input type="text" name="detail" placeholder="detail">
        
    </div>
     <div class="two fields">
      <div class="field">
       <label>salary</label>
        <input type="text" name="salary" placeholder="salary">
      </div>
      <div class="field">
       <label>location</label>
        <input type="text" name="location" placeholder="location">
      </div>
    </div>
    <div class="two fields">
      <div class="field">
       <label>keyword</label>
        <input type="text" name="keyword" placeholder="keyword">
      </div>
      <div class="field">
       <label>deadline</label>
        <input type="date" name="deadline" placeholder="deadline">
      </div>
    </div>
  </div>
</div>   

            <input type="submit" class="ui green button" value="Click to Post">
            <input type="reset" class="ui green button" value="Reset Data">
        </form>
    </div>
    
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