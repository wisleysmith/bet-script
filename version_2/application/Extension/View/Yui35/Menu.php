<?php
class Extension_View_Yui35_Menu extends Extension_Core_View_Yui_Template
{ 
  	private $links = array();
  	private $direction='horizontal';
  	private $childs = array();
	public function __construct($elementName = 'default_menu')
	{ 
		$this->childs['menu'] = array();
		$this->links['menu'] = array();
		$this->setId($elementName); 
		$this->setHtmlElementId('menu_'.$this->getId()); 
		$this->setWidgetDependencies('node-menunav');  
	}
	
	public function addLink($id,$linkData)
	{
		$this->links[$id] = $linkData;
	}  
	
	public function getLink($id=null)
	{
		if($id!=null)
		{
			return $this->links[$id];
		}
		return $this->links;
	}
	
	public function getChilds($id=null)
	{
		if(isset($id))
		{
			if(isset($this->childs[$id]))
			{
				return $this->childs[$id];
			}
			else 
			{
				return array();
			}
		}
		return $this->childs;
	}
	
	public function addChild($id,$childId)
	{
		if(!isset($this->links[$id]))
		{
			new Core_Exceptions('Link menu id does not exist '.$id);
		}
		
		if(!isset($this->links[$childId]))
		{
			new Core_Exceptions('Link menu id does not exist '.$childId);
		}
		
		$this->childs[$id][] = $childId;
	}
	
	public function removeChild($id,$childId)
	{
		if(!isset($this->links[$id]))
		{
			return;
		}
		
		if(!isset($this->links[$childId]))
		{
			return;
		}
		
		if(!isset($this->childs[$id]))
		{ 
			return;
		}
		
		foreach ($this->childs as $c)
		{
			foreach ($c as $key=>$child)
			{
				if($child==$childId)
				{
					unset($c[$key]);
				}
			}
		}
	}
	
	public function getDirection()
	{
		return $this->direction;
	}
	
	public function getMenuHtml()
	{ 
		$menuHtml = '';	 
		$menuHtml .= '<ul class="first-of-type">'; 
		$topMenu = $this->getChilds('menu');
		 
		foreach ($topMenu as $l)
		{  
			$menuHtml .= '<li class="yui3-menuitem">';
			$menuHtml .= $this->getMenuLinkContent($l);
			$menuHtml .= '</li>'; 
		} 
		$menuHtml .= '</ul>'; 
		return $menuHtml;
	}
	
	private function getMenuLinkContent($id,$html='')
	{   
		 
		$childs = $this->getChilds($id);
		$html .= $this->getMenuLink($id);
		if(sizeof($childs)>0)
		{ 
			 $html .=' 
                            <div id="'.$id.'" class="yui3-menu">
                                <div class="yui3-menu-content">
                                    <ul>';
			 foreach ($childs as $c)
			 {
			 	$html .=' <li class="yui3-menuitem">';
			 	$html =$this->getMenuLinkContent($c,$html); 
			 	$html .='</li>';
			 }
                                        
  			$html .='			</ul>    
							</div>
						</div> ';     
		 
		} 
	
		return $html;
	}
	
	private function getMenuLink($id)
	{
		$menuItem = $this->getLink($id);
		 
		if(empty($menuItem))
		{
			return '';
		}
		$html='';
		$html .= '<a core_menu_id="'.$id.'"';  
		  
		if(!isset($menuItem['attributes']))
		{    
			 $menuItem['attributes']=array();
		} 
		
		if(isset($menuItem['attributes']['class']))
		{ 
			if(strpos($menuItem['attributes']['class'], 'yui3-menu-')===false)
			{
				$menuItem['attributes']['class'] =  $menuItem['attributes']['class'] .' '.$this->getMenuItemClass($id);
			} 
		}
		else 
		{
			$menuItem['attributes']['class'] =  $this->getMenuItemClass($id);
		} 
		 
		if(strpos( $menuItem['attributes']['class'],'yui3-menu-label')!==false)
		{
			if(!isset($menuItem['attributes']['href']))
			{
				$menuItem['attributes']['href']="#".$id;
			}
		}
		 
		foreach ($menuItem['attributes'] as $key=>$m)
		{
				$html .=' '.$key.'="'.$m.'"'; 
		}  
		
		if(isset($menuItem['content']))
		{
			$html .='>'.$menuItem['content'].'</a>'; 
		}
		else 
		{
			$html .='></a>'; 
		}
	
		return $html;
	}
	
	private function getMenuItemClass($id)
	{ 
		$html ='';
		$childs = $this->getChilds($id);
		if(sizeof($childs)==0)
		{
			$html .='yui3-menuitem-content';
		} 
		else 
		{
			$html .='yui3-menu-label'; 
		} 
		return $html;
	}
	
	public function setDirection($direction)
	{
		$this->direction = $direction;
	}
}