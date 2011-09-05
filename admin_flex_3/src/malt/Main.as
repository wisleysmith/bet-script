/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */
package malt
{
	import malt.components.actions.*;
    import malt.components.model.*;
    import malt.components.serviceActions.*
    import flash.utils.getDefinitionByName;
    import malt.core.component.MainBase
 
	public class Main extends MainBase
	{
	    public function Main()
		{	
		    setClass(Sports);
		    setClass(ArhiveBets);
		    setClass(Groups); 
		    setClass(Bets); 
	        setClass(SuperToto); 
	        setClass(SportsBets)
	        setClass(Players)
	        setClass(TabMain) 
	        setClass(EventsSupertoto) 
	        setModel(Global);
		    setClass(PrebuildGroups);
			setClass(Events);
	        setClass(Teams);
	        setClass(Settings);
	        setClass(Bets);
	        setClass(BetsData);	   
	        setClass(Manage)  ; 
		}
 	}
	

}