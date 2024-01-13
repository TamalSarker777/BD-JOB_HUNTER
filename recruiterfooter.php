  <script>
      function homefn() {
          location.assign('recruiterpage.php'); ///GET method
      }

      function logoutfn() {
          location.assign('logout.php'); ///GET method
      }

      function postjobfn() {
          location.assign('postjob.php'); ///GET method
      }

      function subscriebefn() {
          location.assign('subscriebe.php'); ///GET method
      }

      function messagefn() {
          location.assign('message.php'); ///GET method
      }

      function notificationfn() {
          location.assign('reqnotification.php'); ///GET method
      }

      function profileupdatefn() {

          location.assign('updatereqprofile.php'); //GET
      }

      function updatefn(jobid) {

          location.assign('jobupdate.php?pid=' + jobid); //GET
      }

      function deletefn(jobid) {


          let person = prompt("ARE YOU SURE?", "Type YES to confirm");
          if (person == "YES") {
              location.assign('jobdelete.php?pid=' + jobid); //GET
          } else {
              location.assign('recruiterpage.php'); //GET
          }


      }

      function boostfn(jobid) {

          location.assign('boostprocess.php?pid=' + jobid); //GET
      }

      function statusfn(jobid) {

          location.assign('applicantstatus.php?pid=' + jobid); //GET
      }

      function messagefn() {

          location.assign('message.php'); //GET
      }

      function sendmessagefn() {

          location.assign('sendmessage.php'); //GET
      }

      function acceptfn(id) {

          location.assign('acceptprocess.php?pid=' + id); ///GET method
      }

      function rejectfn(id) {

          location.assign('rejectprocess.php?pid=' + id); ///GET method
      }
  </script>