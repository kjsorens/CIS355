<?php
/* ---------------------------------------------------------------------------
 * filename    : upload.php
 * author      : Kyle Sorenson
 * description : This file allows picture uploads to kjsorens database
 * ---------------------------------------------------------------------------
 */
session_start();
//connect to database
$db=mysqli_connect("localhost","kjsorens","411079","kjsorens"); 
?>
<?php
if(isset($_SESSION['message']))
{
echo "<div id='error_msg'>".$_SESSION['message']."</div>";
unset($_SESSION['message']);
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js">
    </script>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <h3>Restaurant Picture Upload
        </h3>
      </div>
      <div class="row">
        <p>
          <a href="rating.php" class="btn btn-success">Back
          </a>
          <a href="logout.php" class="btn btn-success">Logout
          </a>
          <br>
        </br>
    </div>
    <div>
      <body>
        <form method="post" enctype="multipart/form-data">
          <table width="350" border="0" 
                 cellpadding="1" cellspacing="1" class="box">
            <tr>
              <td>Select a File
              </td>
            </tr>
            <tr>
              <td>
                <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
                <input name="userfile" type="file" id="userfile">
              </td>
            </tr>
            <tr>
              <td width="80">
                <input name="upload" type="submit" class="box" id="upload"  value=" Upload ">
              </td>
            </tr>
          </table>
        </form>
      </body>
    </div>
    </div> 
  <!-- /container -->
  </body>
</html>
<?php
//Dr Corser's modified code
ini_set('file-uploads',true);
if(isset($_POST['upload']) && $_FILES['userfile']['size']>0)
{
$fileName = $_FILES['userfile']['name'];
$tmpName  = $_FILES['userfile']['tmp_name'];
$fileSize = $_FILES['userfile']['size'];
$fileType = $_FILES['userfile']['type'];
$fileType = (get_magic_quotes_gpc()==0 
? mysql_real_escape_string($_FILES['userfile']['type'])
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
$con = mysql_connect('localhost','kjsorens','411079') 
or die(mysql_error());
$db  = mysql_select_db('kjsorens',$con);
if($db)
{
$query = "INSERT INTO upload (name, size, type, content) ".
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
?>
