/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */
package malt
{
	import malt.components.actions.*;
	import malt.components.model.*;
	import malt.core.component.MainBase;
	public class Main extends MainBase
	{
	    public function Main( )
		{	
			 
		   setClass(Bets); 
		   setClass(BetSlip)
		   setClass(History)
		   setClass(MainTab) 
		   setClass(Players) 
		   setClass(MySettings) 
		    setClass(PasswordRemember) 
		   setModel(Global);   
	    }
 	}
	

}