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
     <title>Upload CV Page</title>
       <?php include "css.php"; ?>

 </head>

 <body>
         <div class="navbar">
          <div class="ui segment">
              <div class="ui secondary  menu">
                  <input class="item" type="button" value="BD Job Hunter" onclick="homefn();">
                  <input class="active item" type="button" value="Profile" onclick="profilefn();">

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
                                  <input type="submit" value="Search">

                              </form>
                              <input class="item" type="button" value="Logout" onclick="logoutfn();">

                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>


     <div>
         <form action="cvupdateprocess.php" method="POST">
             <h2>Update your Info HERE</h2>

             <label for="fullname">fullname</label>
             <input type="text" name="fullname" id="fullname">
             <br><br>
             <label for="education">education</label>
             <input type="text" name="education" id="education">
             <br><br>
             <label for="skills">skill</label>
             <input type="text" name="skills" id="skills">
             <br><br>
             <label for="language">language</label>
             <input type="text" name="language" id="language">
             <br><br>
             <label for="certification">certification</label>
             <input type="text" name="certification" id="certification">
             <br><br>
             <label for="experience">experience</label>
             <input type="text" name="experience" id="experience">
             <br><br>
             <label for="interest">Interest</label>
             <input type="text" name="interest" id="interest">
             <br><br>
             <label for="reference">reference</label>
             <input type="text" name="reference" id="reference">
             <br><br>
             <label for="links">links</label>
             <input type="text" name="links" id="links">
             <br><br>



             <input type="submit" value="Click to Update CV">
         </form>
     </div>

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