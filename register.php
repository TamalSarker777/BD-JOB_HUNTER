<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <title>Register Page</title>
    <style>
        div{
            margin-left: 30%;
            margin-top: 5%;
        }
        h2{
            margin-left: 5%;
            color: green;
            font-size: 32px;
        }
        input[type=submit],#login{
            padding: 15px 35px;
            background: orange;
            color:white;
            
        }
        input[type=submit]:hover,#login:hover{
            padding: 20px 35px;
            background: green;
            color:white;
        }
    </style>
</head>


<body>
    
    <div>
        <form action="registerprocess.php" method="POST">
            <h2 >Register Here</h2>

            <label for="uemail">Email: </label>
            <input type="email" id="uemail" name="uemail" placeholder="enter your email here" title="valid email">
            <br><br>
            <label for="upass">Password: </label>
            <input type="password" id="upass" name="upass" placeholder="1234">
            <br><br>

            <label for="fname"> Name *</label>
            <input type="text" name="fname" id="fname" required>
            <br><br>
            <label for="location"> Location *</label>
            <input type="text" name="location" id="location" required>
            <br><br>
            <label for="gender">Gender: </label>
            <br><br>
            <input type="radio" id="gender" name="gender" value="male" /> Male
            <input type="radio" id="gender" name="gender" value="female" /> Female <br />
            <br><br>

            <label for="dob">Date of Birth</label>
            <input type="date" name="dob" id="dob">
            <br><br>
            <label for="phone">Phone Number</label>
            <input type="text" name="phone" id="phone" placeholder="01*********">
            <br><br>
            <label for="usertype">User type: </label>
            <br><br>
            <input type="radio" id="usertype" name="usertype" value="recruiter" /> Recruiter
            <input type="radio" id="usertypr" name="usertype" value="applicant" /> Applicant <br />
            <br><br>


            <input type="submit" value="Register"> 
        </form>
<!--        <input id="login" type="button" value="Login" onclick=login() >-->
    </div>
    
   <script>
       function login(){
            location.assign('login.php'); 
       }
    </script>
    
</body>

</html>