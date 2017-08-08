<html>
	<body>
		<form method="post" action="fileUpload.php" enctype="multipart/form-data">
			<table width="350" border="0" 
				cellpadding="1" cellspacing="1" class="box">
				<tr><td>Select a File</td></tr>
				<tr><td>
				<input type="hidden" name="MAX_FILE_SIZE" value="1000000">
				<input name="userfile" type="file" id="userfile">
				</td></tr>
				<tr>
				<td width="80">
				<input name="upload" type="submit" class="box" id="upload"  value=" Upload ">
				</td>
				</tr>
			</table>
		</form>

	</body>
</html>

<?php

#ini_set('file-uploads',true);
if(isset($_POST['upload']) )
{
  $fileName = $_FILES['userfile']['filename'];
  $tmpName  = $_FILES['userfile']['tmp_name'];
  $fileSize = $_FILES['userfile']['filesize'];
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
	  "VALUES ('$fileName', '$fileSize', '$fileType', '$filecontent')";
	mysql_query($query) or die('Error... query failed!');
	mysql_close();
	echo "<br />File $fileName <br />uploaded successfully <br />";
  }
  else
  {
    echo "file upload failed: " . mysql_error();
  }
}
?>
