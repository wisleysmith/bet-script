<?php 
$user = new Core_Auth_User();
if(!$user->isAuth())
{
?>
Y.one('<?php echo $this->getHtmlIds('loginPopUp',true) ?>').on('click',

	function()
	{ 
		Y.one('#loginContent').setStyle('display','block'); 
		<?php echo $this->getLoginPanel()->getId() ?>.show();
	}

)

Y.one('<?php echo $this->getHtmlIds('registerPopUp',true) ?>').on('click',

	function()
	{ 
		Y.one('#registrationContent').setStyle('display','block'); 
		<?php echo $this->getRegistrationPanel()->getId()?>.show();
	} 
)
<?php 
}
?>