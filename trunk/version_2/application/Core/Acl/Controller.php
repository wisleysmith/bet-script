<?php
class Core_Acl_Controller
{
	private $roles = array();
	private $childs = array(); 
	private $currentRoles = array();
	private $currentAssets = array();
	private $rolesAssets = array();
	private $currentRolesAssets = array(); 
	
	//guest, user, admin
	public function addRole($role,$childs=null)
	{
		$this->roles[] = $role;
		$this->childs[$role][] = $childs;
	}
	
	public function getCurrentRoles()
	{
		return $this->currentRoles;
	}
	
	private function getChildRolesRecursive($role)
	{
		if(isset($this->childs[$role]))
		{
			foreach ($this->childs[$role] as $c)
			{  
				$this->setRolesAssetToCurrentRole($c);
				$this->getChildRolesRecursive($c);
			}
		}
	}
	
	public function addCurrentRole($role)
	{
		if(!in_array($role, $this->roles))
		{
			throw new Core_Exceptions('ACL role does not exist');
		}
		$this->currentRoles[]= $role;
	}
	 
	
	public function addRoleAsset($role,$asset)
	{
		$this->rolesAsset[$role][] = $asset;
	}
	
	private function setRolesAssetToCurrentRole($role)
	{
		if(!in_array($role, $this->currentRoles))
		{
			$this->currentRoles[] = $role;
		}
		if(isset($this->rolesAsset[$role]))
		{
			foreach ($this->rolesAsset[$role] as $c)
			{
				if(!in_array($c, $this->currentRolesAssets))
				{
					$this->currentRolesAssets[] = $c;
				}
			}
		} 
	}
	
	public function getRolesAsset($role = null)
	{
		if($role!==null)
		{
			if(isset($this->rolesAsset[$role]))
			{
				return $this->rolesAsset[$role];
			}
			else 
			{
				return null;
			}
		}
		
		return $this->rolesAsset;
	}
	
	public function getCurrentAssets()
	{
		return $this->currentAssets;
	}
	
	public function addCurrentAsset($asset)
	{
		$this->currentAssets[] = $asset;
	}
	
	public function validate()
	{ 
		foreach ($this->currentRoles as $cr)
		{  
			$this->setRolesAssetToCurrentRole($cr); 
			if(isset($this->childs[$cr]))
			{
				foreach ($this->childs[$cr] as $c)
				{ 
					$this->setRolesAssetToCurrentRole($c); 
					$this->getChildRolesRecursive($c);
				}
			} 
		} 
		
		foreach ($this->getCurrentAssets() as $a)
		{
			if(!in_array($a,$this->currentRolesAssets))
			{
				echo json_encode(array('status'=>'ok','html'=>'','javascript'=>'alert("Please login")'));
				exit();
			}
		} 
	}
}

?>