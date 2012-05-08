<?php
class View_Frontend_LoginAndRegistration extends Extension_Core_View_Yui_Template
{  
	private $loginPanel;
	private $registrationPanel;
		
	public function getLoginPanel()
	{
		if(!isset($this->loginPanel))
		{
			$this->setLoginPanel();
		}
		return $this->loginPanel; 
	}
		
	public function setLoginPanel()
	{
		$this->loginPanel = new Extension_View_Yui35_Panel();
		$this->setPanelOptions($this->loginPanel,150,'Login Form');
		$this->loginPanel->setBody(new View_Frontend_Widgets_Login());
	}
	 
	public function getRegistrationPanel()
	{
		if(!isset($this->registrationPanel))
		{
			$this->setRegistrationPanel();
		}
		return $this->registrationPanel; 
	}
		
	public function setRegistrationPanel()
	{
		$this->registrationPanel = new Extension_View_Yui35_Panel();
		$this->setPanelOptions($this->registrationPanel,350,'Registration Form');
		$this->registrationPanel->setBody(new View_Frontend_Widgets_Registration());
	}
	 
	
	public function setPanelOptions($panel,$height,$title)
	{
		$panel->addConstructorOption('srcNode' , $panel->getHtmlElementId(true),true); 
        $panel->addConstructorOption('width'        , '450');
        $panel->addConstructorOption('height'        , $height);
        $panel->addConstructorOption('headerContent' ,$title,true);
        $panel->addConstructorOption('zIndex'       , '1005');
        $panel->addConstructorOption('centered'     , 'true');
        $panel->addConstructorOption('modal'        , 'true');
        $panel->addConstructorOption('visible'      , 'false');
        $panel->addConstructorOption('render'       , 'true');
        $panel->addConstructorOption('plugins'     , '[Y.Plugin.Drag]');  
	}	 
}
?>