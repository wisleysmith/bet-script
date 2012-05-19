<style>
#loginContent
{
	display:none;
}

#registrationContent
{
	display:none;
}

</style>

<?php 
$user = new Core_Auth_User(); 
if($user->isAuth())
{
	?>
	<div style="float:right">
	  	<a href="<?php echo $url = Application::getRouter()->getFullUrl(array('controller'=>'index','action'=>'logout'));?>"> Logout </a>
	</div>
<?php 
}
else 
{
?>
	<div style="float:right">
	  	<span><a id="<?php echo $this->getHtmlIds('loginPopUp') ?>" href="#"> Login </a></span>
	  	|
	  	<span><a id="<?php echo $this->getHtmlIds('registerPopUp') ?>" href="#"> Register </a></span>
	</div>


<?php echo $this->getLoginPanel() ?>

<?php echo $this->getRegistrationPanel()?>

<?php 
}
?>