<?php
session_start();
//connect to database
// $db=mysqli_connect("localhost","djbenedi","","djbenedi"); 

require "../../../database/database.php";
// $db=Database::connectMysqli();
	$db=Database::connectMysqli();

if(isset($_POST['login_btn']))
{

 // var_dump($db); exit();
    $username=mysqli_real_escape_string($db, $_POST['username']);
    $password=mysqli_real_escape_string($db, $_POST['password']);
    $password=md5($password); 
	
    $sql="SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result=mysqli_query($db,$sql);
    if(mysqli_num_rows($result)==1)
    {
        $_SESSION['message']="You are now Logged In";
        $_SESSION['username']=$username;
        header("location:home.php");
    }
   else
   {
                $_SESSION['message']="Username and Password combination incorrect";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <link href="../../css/bootstrap.min.css" rel="stylesheet">
  <script src="../../js/bootstrap.min.js"></script>
  <title>Login/Register</title>
  <link rel="stylesheet" type="text/css" href="style.css"/>
  <style>
	.border1 {
		color: solid black 1px;
		width:35%;
	height:50%;}
	</style>
</head>
<body>
<div class="header">
    <center><h1>Login/Register</h1>
</div>
<?php
    if(isset($_SESSION['message']))
    {
         echo "<div id='error_msg'>".$_SESSION['message']."</div>";
         unset($_SESSION['message']);
    }
?>
<center><form method="post" action="login.php">
  <table>
     <tr>
           <td>Username : </td>
           <td><input type="text" name="username" class="textInput"></td>
     </tr>
      <tr>
           <td>Password : </td>
           <td><input type="password" name="password" class="textInput"></td>
     </tr>
	 <tr>
           <td></td>
           <td><input type="submit" name="login_btn" class="btn btn-success" value="Submit">
		   <a href="register.php" class="btn btn-success">Register</a></td>
     </tr>
  
</table>
</form>
<center><h2>What is TeeTyme?</h2>
<div><h4 class="border1">This app is for golfers so they may record their scores from each round. Golfers may create a user, and then choose
the ID of their user along with the ID of a golf course so they may play a round. 
<br><br>When beginning a new round, golfers may enter "0" for their scores until they have played that hole. If only playing 9 holes, they may
leave the score for the remaining 9 holes as "0." 
<br><br>Golfers can look up other golfers and their IDs.<div>
This app keeps track of the golfer's name, mobile, and email. The courses are tracked by their name and the
address of the course.</h3></center>
</body>
</html>
 
 
<!--
In 2 minutes 8 second you don a mistake then last time only you found
In 2 minutes 49 second you done a mistake then last time only you found
Please Change this Your Video Length is Decrease
Your Suscribers will increase
I Like and Thanks for  Who are all Helping to Create this Video
 
About Me: www.visualcv.com/karthickraja
-->