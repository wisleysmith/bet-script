/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */
package  malt.components.controls
{
    
    import flash.display.Loader;
    import flash.display.LoaderInfo;
    import flash.display.DisplayObject;
    import flash.display.Sprite;
    import flash.display.Bitmap;
    import flash.net.URLRequest;
    import flash.events.Event;
    
    import mx.core.UIComponent;    
    import mx.core.UITextField;
    import mx.controls.DataGrid;    
    import mx.controls.listClasses.IListItemRenderer;
    
    public class  DragProxy extends UIComponent {
        
        public function  DragProxy():void
        {
            super();
        }
        
        override protected function createChildren():void
        {
            super.createChildren();
            
            //retrieve the selected indicies and then sort them
            //in order to display them in the proper order
            var items:Array = mx.controls.DataGrid(owner).selectedIndices;
       
            
                var dg:mx.controls.DataGrid = mx.controls.DataGrid(owner);
                
                var container: UIComponent = new UIComponent();
                addChild(DisplayObject(container));    
                
                var item:Object = dg.dataProvider[items[0]];
                
                var label:UITextField = new UITextField();
                label.text = item.name;
                
                container.addChild(label);
                
              
                var src:IListItemRenderer = dg.indexToItemRenderer(items[0]);
                y = src.y+dg.rowHeight;
           
            
            x = src.x ;

        }
        
        
    }
}
