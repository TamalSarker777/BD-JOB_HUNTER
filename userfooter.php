 <script>
     function logoutfn() {
         location.assign('logout.php'); ///GET method
     }

     function profilefn() {
         location.assign('profile.php'); ///GET method
     }

     function homefn() {
         location.assign('home.php'); ///GET method
     }

     function statusfn() {
         location.assign('applicationstatus.php'); ///GET method
     }

     function notificationfn() {
         location.assign('notification.php'); ///GET method
     }
      function suggestfn() {
         location.assign('suggest.php'); ///GET method
     }
     
      function cvupdatefn() {
         location.assign('cvupdate.php'); ///GET method
     }
     
       function cvuploadfn() {
         location.assign('cvupload.php'); ///GET method
     }


     function applyfn(jobid) {

         location.assign('applyprocess.php?pid=' + jobid); //GET

     }
     
       function messagefn() {

          location.assign('usermessage.php'); //GET
      }
       function sendmessagefn() {

          location.assign('usersendmessage.php'); //GET
      }
     
      function profileupdatefn() {

          location.assign('profileupdate.php'); //GET
      }
     
 </script>