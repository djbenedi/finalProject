<?php
session_start();
if(!isset($_SESSION['username'])){ //if login in session is not set
    header("Location: unauthorized.html");
}
// Shows who is logged in. Generic "Welcome" if no one. 


//connect to database
 $db=mysqli_connect("localhost","djbenedi","Dani102403","djbenedi");
require "../../../database/database.php";
include "../fileDownload.php";
// $db=Database::connectMysqli();

?>
<!DOCTYPE html>
<html>
<head>
  <title>Home Page</title>

    <link href="../css/bootstrap.min.css" rel="stylesheet">
  <script src="../js/bootstrap.min.js"></script>
</head>
<body>
<div class="header">
    <center><h2>Welcome <?php echo $_SESSION['username']; ?>!</h2></div>
	<br>
</div>
<?php
    if(isset($_SESSION['message']))
    {
         echo "<div id='error_msg'>".$_SESSION['message']."</div>";
         unset($_SESSION['message']);
    }
?>

<div>
<center>
<?php
ini_set('file-uploads',true);
if(isset($_POST['upload']) && $_FILES['userfile']['size']>0)
{
  $fileName = $_FILES['userfile']['filename'];
  $tmpName  = $_FILES['userfile']['tmp_name'];
  $fileSize = $_FILES['userfile']['size'];
  $fileType = $_FILES['userfile']['filetype'];
  $fileType = (get_magic_quotes_gpc()==0 
    ? mysql_real_escape_string($_FILES['userfile']['filetype'])
    : mysql_real_escape_string(stripslashes ($_FILES['userfile'])));
  $fp       = fopen($tmpName, 'r');
  $content  = fread($fp, filesize($tmpName));
  $content  = addslashes($content);
  echo "filename: " . $fileName . "<br />";
  echo "filesize: " . $fileSize . "<br />";
  echo "filetype: " . $fileType . "<br />";
  fclose($fp);
   if (! get_magic_quotes_gpc() )
   {
     $fileName = addslashes($fileName);
   }
  $con = mysql_connect('localhost','djbenedi','Dani102403') 
    or die(mysql_error());
  $db  = mysql_select_db('djbenedi',$con);
  if($db)
  {
    $query = "INSERT INTO customers2 (filename, filesize, filetype, filecontent) ".
	  "VALUES ('$fileName', '$fileSize', '$fileType', '$content')";
	mysql_query($query) or die('Error... query failed!');
	mysql_close();
	echo "<br />File $fileName <br />uploaded successfully <br />";
  }
  else
  {
    echo "file upload failed: " . mysql_error();
  }
}
mysql_connect("localhost","djbenedi","Dani102403");
mysql_select_db("djbenedi");


// if first time calling this php file, use first pic
// else use value entered from form

$id = 1;
if(isset($_POST['img_id'])) $id = $_POST['img_id'];
// ----- display list of files available by id -----
$query = "SELECT id, filename, filesize, filetype FROM customers2";
$result  = mysql_query ($query);

// display list
while ($row = mysql_fetch_assoc($result))
{
  echo "<p>" . $row['id'] . ' ' . $row['filename'] .
    ' ' . $row['filesize'] . ' ' . $row['filetype'] . "</p>";
}
echo "<form method='post' action='home.php' >";
echo "<input name='img_id' type='text'>";
echo "<input type='submit' value='Submit'>";
echo "</form>";
$query = "SELECT filename, filesize, filecontent, filetype
  FROM customers2 WHERE id=$id";
$result  = mysql_query ($query);
$name    = mysql_result($result, 0, "filename");
$size    = mysql_result($result, 0, "filesize");
$type    = mysql_result($result, 0, "filetype");
$content = mysql_result($result, 0, "filecontent");
// Header( "Content-type: $type");
// print $content;
echo "<img height='25%' width='25%'
  src='data:image/jpeg;base64,"
  . base64_encode($content) . "'>";

?>

<html>
	<body>
		<form method="post" action="home.php" enctype="multipart/form-data">
			<table width="350" border="0" 
				cellpadding="1" cellspacing="1" class="box">
				<tr><td>Select a File</td></tr>
				<tr><td>
				<input type="hidden" name="MAX_FILE_SIZE" value="1000000">
				<input name="userfile" type="file" id="userfile">
				</td></tr>
				<tr>
				<td width="80">
				<input name="upload" type="submit" class="btn btn-info" id="upload"  value=" Upload ">
				</td>
				</tr>
			</table>
		</form>

	</body>
</html>

</div>
<center><a href="../rounds" class="btn btn-primary">Click here to start a new round</a>
<br><br>
<center><a href="../json.php" class="btn btn-primary">Golfer's Information</a>
<br><br>
<center><a href="diagrams.html" class="btn btn-primary">Diagrams</a>


<footer>
<br><br><br>
<a href="logout.php" class="btn btn-danger">Log Out</a></center>
<center>Copyright TeeTyme</center>
</footer>
</body>
</html>
