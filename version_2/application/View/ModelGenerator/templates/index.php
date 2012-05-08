<html>
<head></head>
<body>
Insert data for model creating:<br />
<form action="" method="post">
Table name: <br /><input value="<?php  if(isset($_POST['table_name'])){echo $_POST['table_name']; }; ?>" name="table_name" type="text" /> <br />
New Model name: <br /><input value="<?php  if(isset($_POST['class_model_name'])){echo $_POST['class_model_name']; }; ?>" name="class_model_name" type="text" /> <br />
Path name (relative to application folder use "/" for folder separation): <br /><input value="<?php  if(isset($_POST['path'])){echo $_POST['path']; }; ?>" name="path" type="text" /> <br />
Overwrite model <br /><input  value="1" <?php  if(isset($_POST['overwrite_model'])){echo "checked"; }; ?> name="overwrite_model" type="checkbox" /> <br />
<input type="submit"  > 
</form>

<?php 
foreach ($this->getDatabaseTables() as $dt)
{
	echo $dt.'<br />';
}
?>

</body>
</html>
