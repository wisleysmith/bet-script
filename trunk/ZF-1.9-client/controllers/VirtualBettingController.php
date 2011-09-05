<?php 
 /**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboli� 
 */
class  VirtualBettingController extends Zend_Controller_Action
{ 
	private $conn="";
    
	public function preDispatch()
	{
		//vritual betting connection
		$this->conn=mysqli_connect("",  "", '',"") or die();
	}
	
	public function accountAction()
	{
	    
	}

	public function accountreportAction()
	{
		$this->_helper->layout->disableLayout();   
		if(Zend_Auth::getInstance()->getIdentity())
    	{ 
    		$auth=Zend_Auth::getInstance()->getStorage()->read(); 
    		$userID=$auth['userId']; 
    	}
    	else
    	{
    		return;
    	}  
		
		$request = $this->getRequest();
   	 	$reqParmas=$request->getParams(); 
    
   	 	if($reqParmas['first']=="true")
   	 	{
   	 		$status="true";
   	 	}
   	 	else
   	 	{
   	 		$status="false";	
   	 	}; 
   	 	
   	 	$reqParmas['selectfirstdate']=(int)$reqParmas['selectfirstdate'];
   	 	$reqParmas['selectfirstmonth']=(int)$reqParmas['selectfirstmonth'];
   	 	$reqParmas['selectsecondday']=(int)$reqParmas['selectsecondday'];
   	 	$reqParmas['selectsecondmonth']=(int)$reqParmas['selectsecondmonth'];
   	 	$reqParmas['selectsecondyear']=(int)$reqParmas['selectsecondyear'];
   	 	$reqParmas['selectfirstyear']=(int)$reqParmas['selectfirstyear'];
   	 	
   	 	$datefirst=$reqParmas['selectfirstyear']."-".$reqParmas['selectfirstmonth']."-".$reqParmas['selectfirstdate']." 00:00:00";
   	 	$datesecond=$reqParmas['selectfirstyear']."-".$reqParmas['selectsecondmonth']."-".$reqParmas['selectsecondday']." 23:59:59";
   	 	
		$query ="call  selectTransactions('".$userID."','".$datefirst."','".$datesecond."','".$status."')" ; 
		 
		$this->view->account=$this->result( $query );
	}
	
	public function betsAction()
	{
		 
	}
	
	public function betsreportAction()
	{
		$this->_helper->layout->disableLayout();   
		if(Zend_Auth::getInstance()->getIdentity())
    	{ 
    		$auth=Zend_Auth::getInstance()->getStorage()->read(); 
    		$userID=$auth['userId']; 
    	}
    	else
    	{
    		return;
    	}  
    	 
		$request = $this->getRequest();
   	 	$reqParmas=$request->getParams(); 
    
   	 	if($reqParmas['first']=="true")
   	 	{
   	 		$status="true";
   	 	}
   	 	else
   	 	{
   	 		$status="false";	
   	 	}; 
   	 	
   	 	$reqParmas['selectfirstdate']=(int)$reqParmas['selectfirstdate'];
   	 	$reqParmas['selectfirstmonth']=(int)$reqParmas['selectfirstmonth'];
   	 	$reqParmas['selectsecondday']=(int)$reqParmas['selectsecondday'];
   	 	$reqParmas['selectsecondmonth']=(int)$reqParmas['selectsecondmonth'];
   	 	$reqParmas['selectsecondyear']=(int)$reqParmas['selectsecondyear'];
   	 	$reqParmas['selectfirstyear']=(int)$reqParmas['selectfirstyear'];
	   
		
	    $datefirst=$reqParmas['selectfirstyear']."-".$reqParmas['selectfirstmonth']."-".$reqParmas['selectfirstdate']." 00:00:00";
   	 	$datesecond=$reqParmas['selectfirstyear']."-".$reqParmas['selectsecondmonth']."-".$reqParmas['selectsecondday']." 23:59:59";
	    $query = "call select_bet_slip_user_admin('".$userID."','".$datefirst."','".$datesecond."','".$status."');";  
    
	    $this->view->account=$this->multiresultbackArray( $query); 
	}
	
	public function indexAction()
    { 
    	$dates = date("Y-m-d H:i:s") ;
	    $query = "call usertSelectGroupAndSports('".$dates."')";
	    $this->view->topLinks=$this->multiresultbackArray($query);
    }  

   public function typesAction()
    {
    	$this->_helper->layout->disableLayout();   
    	$request = $this->getRequest();
   	 	$reqParmas=$request->getParams(); 
   	 	$reqParmas['value']=(int)$reqParmas['value']; 
		  
	    date_default_timezone_set('Europe/Zagreb');
    	$dates = date("Y-m-d H:i:s") ;
    	$query = "CALL userSelectEventGroup('".$reqParmas['value']."','".$dates."')"; 
     	$this->view->formatResult = $this->result( $query); 
    }
    
    public function eventdetailsAction()
    {
    	$this->_helper->layout->disableLayout();   
    	$request = $this->getRequest();
   	 	$reqParmas=$request->getParams(); 
   	 	$reqParmas['value']=(int)$reqParmas['value']; 
     
	    $query ="CALL userSelectActiveBets(".$reqParmas['value'].",now(),0)";  
	    $this->view->formatResult=$this->multiresultbackArray($query); 
    } 

    public function betsdetailsAction()
    {
    	$this->_helper->layout->disableLayout();   
    	$request = $this->getRequest();
   	 	$reqParmas=$request->getParams(); 
   	 	$reqParmas['value']=(int)$reqParmas['value'];
   	 	$reqParmas['lang']=(int)$reqParmas['lang']; 
     
	    $query ="CALL userSelectActiveBets(".$reqParmas['lang'].",now(),".$reqParmas['value'].")";  
	    $this->view->formatResult=$this->multiresultbackArray($query); 
    }
    
  	private function multiresultbackArray($query)
	{
	  	$arrFin=array(); 
		/* execute multi query */
		if (mysqli_multi_query($this->conn, $query)) 
		{
		    do {
		    	$arr=array();
		        /* store first result set */
	        if ($result = mysqli_store_result($this->conn))
	        {
	            while ($row = mysqli_fetch_array($result)) 
	            {
	                $arr[]= $row;
	            }
	            mysqli_free_result($result);
		        }
		       $arrFin[]=$arr ;
		    } while (mysqli_next_result($this->conn));
		} 
			 
		return  $arrFin ;  
	}
	
	 private function result($query)
	 {
	 	$result = mysqli_query($this->conn , $query ) ;
 
	 	if(mysqli_num_rows($result)==0)
 		{
 		     mysqli_free_result( $result); 
 		    mysqli_next_result($this->conn );
 		    return; 	 
 		}
	 	  
		while ($row = mysqli_fetch_array($result)) 
		{
		    $ArrayOfUsers[] = $row;
		} 
		mysqli_free_result( $result); 
 		  
 		mysqli_next_result($this->conn );
 		  
 		return  $ArrayOfUsers ; 
	 }
	 
	 public function insertbetAction()
	 { 
	 	$this->_helper->layout->disableLayout();   
	 	if(Zend_Auth::getInstance()->getIdentity())
    	{ 
    		$auth=Zend_Auth::getInstance()->getStorage()->read(); 
    		$userID=$auth['userId']; 
    	}
    	else
    	{ 
    		 echo  '{"data":[{"value":"0","mess":"Niste ulogirani"}]}';
    		return;
    	}  
	 	
	 	$this->_helper->layout->disableLayout();    //disable layout 
	 	$request = $this->getRequest();
   	 	$reqParmas=$request->getParams(); 
		$money=(int)$reqParmas['money'];
		$visiblebet=(int)$reqParmas['visiblebet'];
		$comment="";
		if($reqParmas['commenttrue']==1)
    	{ 
    		$comment=htmlentities($reqParmas['commentvalue']);
    	}
    	
    	if($visiblebet<1||$visiblebet>3)
    	{
    		$visiblebet=1;
    	} 
		
    	mysqli_autocommit( $this->conn, FALSE);
		$float = new Zend_Validate_Float(); 
		if(!$float->isValid($money))
       	{ 
       		 echo  '{"data":[{"value":"0","mess":"Niste dobro unjeli ulog"}]}';
       		return;
       	} 
       		
		if(  0>=$money)
		{
			 echo  '{"data":[{"value":"0","mess":"Niste dobro unjeli ulog"}]}';
			return;
		}   
    	 
    	$status=true;
    	date_default_timezone_set('Europe/Zagreb');
    	$dates = date("Y-m-d H:i:s") ; 
    	 
    	$parArray=$reqParmas['pairs'];	
    	$pairsSize =sizeof($parArray);
    	 
     	$int = new Zend_Validate_Int();
    	$query =" ";
    	  
    	if($pairsSize==0)
    	{
    		echo  '{"data":[{"value":"0","mess":"Niste odabrali niti jedan event"}]}';
    		return;
    	}
    	
    	for($i=0;$i<$pairsSize;$i++)
    	{ 
			if(!$int->isValid($parArray[$i]))
	       	{		
	       		echo  '{"data":[{"value":"0","mess":"Oklade nisu valjane"}]}';
	       	 	return ;
	       	}
	    	 	  
			 $query .= "call userBetValidation('".$parArray[$i]."','".$dates."');";
	   	} 
	   	
    	$arrayCheck=$this->multiresultbackArray($query);
      	$num2=sizeof($arrayCheck[0]); 
	
    	for($i=0;$i<sizeof($num2);$i++)
    	{ 
    		if($arrayCheck[0][0][$i]!='ok')
    	  	{   
    	   		$status=false; 
    		} 
        } 
		  
	    if( $status==false)
	    { 
	    	  echo  '{"data":[{"value":"0","mess":"Provjerite svoj listić, sadrži istekle oklade"}]}';
	     	  mysqli_rollback($this->conn); 
	      	 return	;
	    }
    	  
    	
		$query =  "call selectCheckMoney('".$userID."','".$money."')"; 
		$testMon= $this->result( $query);
     
        if($testMon[0][0]!="ok")
    	{ 
    	 	 echo  '{"data":[{"value":"0","mess":"Nemate dosta sredstava na računu"}]}';
    	  	 mysqli_rollback($this->conn); 
    	  	 return	;
    	}  
 			
    	//1 cijeli vrijeme ozna�i primaray key od user
     	$comment=mysqli_real_escape_string($this->conn,$comment);
    	$query =  "call  userInsertBetSlip( '".$dates."','$userID','".$money."','1/1','$comment','$visiblebet')";
 		$test= $this->result( $query);
         
        $query4 =" "; 
        for($i=0;$i<$pairsSize;$i++)
    	{
    	 	 $query4 .= "call  usertInsertBetType( '".$test[0][0]."','".$parArray[$i]."','1');";
    	}   
 
    	$test=$this->multiinsert($query4);
  
	 	if($test)
	 	{
	 		mysqli_commit($this->conn); 
	 		echo  '{"data":[{"value":"1","mess":"Vaša oklada je upisana"}]}'; 
	 		return;
	 	}
	 	else 
	 	{
	 	   echo  '{"data":[{"value":"0","mess":"Došlo je do problema na serveru, pokušajte ponovo"}]}';   
		 
	 	    mysqli_rollback($this->conn); 
	        return ;
	 	}  
	 } 
	  
	 public function multiinsert($query)
	 { 
		$result= mysqli_multi_query($this->conn, $query); 
	    
        do { 
	    	mysqli_store_result($this->conn);
        } while (mysqli_next_result($this->conn));
	    
		if(mysqli_errno($this->conn))
		{ 
        	return false;
		} 
		return true;
	 } 
}

 