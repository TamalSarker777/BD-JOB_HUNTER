      <div class="navbar">
          <div class="ui segment">
              <div class="ui secondary  menu">
                  <input class="active item" type="button" value="BD Job Hunter" onclick="homefn();">
                  <input class="item" type="button" value="Profile" onclick="profilefn();">

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