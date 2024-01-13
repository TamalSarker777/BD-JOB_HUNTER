<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Main Page</title>
        
        <style>

           
            div{
                width: 250px;
                height:500px;
                margin: auto;
                text-align: center;
                background-color:goldenrod;
                
            }
            div input{
                padding: 20px;
                background-color: aqua;
                border-radius:10%;
                color:blue;
            }
            div input:hover{
                padding: 25px;
                background-color: white;
            }
        </style>
        
    </head>
    <body>
       <div>
        <br><br> 
         <h2>    WELCOME </h2>
          <h4>TO OUR SITE </h4>
                 
        <input type="button" value="USER LOGIN" onclick="userloginfn();">
        <br><br> 
        <input type="button" value="ADMIN LOGIN" onclick="emploginfn();">
        <br><br> 
        <input type="button" value="NEW USER?" onclick="registerfn();">
          <br><br> 
           
       </div>
        

        
        <script>
            function userloginfn(){
                location.assign('userlogin.php'); ///GET method
            }
            function adminfn(){
                location.assign('adminlogin.php'); ///GET method
            }
            function registerfn(){
                location.assign('register.php'); ///GET method
            }
        </script>
        
    </body>
</html>

