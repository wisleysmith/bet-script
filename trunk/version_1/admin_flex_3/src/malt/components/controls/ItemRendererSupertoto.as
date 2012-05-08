package  malt.components.controls
{
	import mx.containers.HBox;
	import mx.controls.CheckBox; 
     
    public class  ItemRendererSupertoto extends  HBox
    {
    	public function ItemRendererSupertoto()
    	{
    		super(); 
    		this.setStyle("horizontalAlign", "center");
    		var c:CheckBox=new CheckBox;
    		addChild(c)
    	}
    
    }
        
        
}
