<?php
/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.gnu.org/licenses/gpl-2.0.html
 * @author      Goran Sambolic gsambolic@gmail.com
 *
 * 
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

/*
 * manage bet related actions
 */
class Bets
{
	public function __construct()
	{
		$this->conn = new StoredConnections();
		$this->test = new CustomError();
	}

	public function selectGroupAndSportsOffer()
	{
		$query = "call usertSelectGroupAndSports()";
		return $this->conn->multiresultbackArray( $query );
	}

	public function selectBetInfoNew($ticketId)
	{	  
		if($this->conn->checkAdmin())
		{		 
			$query = "CALL selectOneInfoBet('".$ticketId."','1')";
			return  $this->conn->result( $query);
		}
		else
		{
			if($this->conn->checkUser())
			{
				$userID=$this->conn->getAdminId();
				$query = "CALL selectOneInfoBet('".$ticketId."','0')";
				return  $this->conn->result( $query);
			}
			else
			{
				$this->test->type="error";
				$this->test->info="nologin";
				return $this->test;
			}
		}
	}

	public function selectEventBetsService($id)
	{
		if($this->conn->checkAdmin())
		{
			$dates = date("Y-m-d H:i:s") ;
			$int = new Zend_Validate_Int();
	
			if(!$int->isValid($id))
			{
				return $this->test;
			}
			 	
			$query = "call selectEventBets('".$id."','".$dates."')";
			return $this->conn->result( $query );
		}
		else
		{
			$this->test->type="error";
			$this->test->info="nologin";
			return $this->test;
		}
	}

	public function groupsData($id)
	{
		if($this->conn->checkAdmin())
		{
			$int = new Zend_Validate_Int();

			if(!$int->isValid($id))
			{
				return $this->test;
			}
		 	
		 	$dates = date("Y-m-d H:i:s") ;

		 	$query = "CALL selectTeams( '".$id."');CALL selectBetBasic('".$id."','".$dates."');";
		 	return  $this->conn->multiresultbackArray( $query);
		}
		else
		{
			$this->test->type="error";
			$this->test->info="nologin";
			return $this->test;
		}
	}

	public function betsData($id)
	{
		if($this->conn->checkAdmin())
		{ 
			$dates = date("Y-m-d H:i:s") ;
			$int = new Zend_Validate_Int();

		 	if(!$int->isValid($id))
		 	{
		 		return $this->test;
		 	}
		 	
			$dates = date("Y-m-d H:i:s") ;
			$query = "call selectEventBetTeams('".$id."');call selectEventBets('".$id."','".$dates."');";

			return  $this->conn->multiresultbackArray( $query);
		}
		else
		{
			$this->test->type="error";
			$this->test->info="nologin";
			return $this->test;
		}
	}

	public function insertBetEvent($text,$betNameId,$eventBetId,$betOdds)
	{
		if($this->conn->checkAdmin())
		{
			$int = new Zend_Validate_Int();

		 	if(!$int->isValid($eventBetId))
		 	{
		 		return $this->test;
		 	}
		 
			 $array= $betOdds;
			 $num=sizeof($array);
	
			 $query = "call selectEventCount('".$eventBetId."') ";
			 $testSizeNum =$this->conn->result( $query);
			  
			 if($num!=$testSizeNum[0]["number"])
			 {
			 	return $this->test;
			 }
	
			 mysqli_autocommit( $this->conn->mysqli(), FALSE);
			 
			 $validator = new Zend_Validate_StringLength(1,250);
			 $float = new Zend_Validate_Float();
			  
			 if (!$validator->isValid($text))
			 {
			 	mysqli_rollback($this->conn->mysqli());
			 	return $this->test;
			 }
	
			 if(!$int->isValid($betNameId))
			 {		 		
			 	mysqli_rollback($this->conn->mysqli());
			 	return $this->test;
			 }
			  
			 $dates = date("Y-m-d H:i:s") ;
			 $query = "call insertEventBet ('".$betNameId."','".$eventBetId."','".$text."','".$dates."' )";
			 $idEvent =$this->conn->result( $query);
			  
			 if(!is_array($idEvent))
			 {
				 mysqli_rollback($this->conn->mysqli());
				 return  $idEvent ;
			 }
			  
			 if($idEvent[0][0]=="notok")
			 {
			 	$this->test->info="outdated";
			 	$this->test->type="error";
			 	return $this->test;
			 }
	
			 $query2 =" ";
			 $validator->setMax(100);
			 $validator->setMin(1);
			 	
			 for($i=0;$i<$num;$i++)
			 {
			 	if(!$validator->isValid($array[$i][0]))
			 	{
			 		mysqli_rollback($this->conn->mysqli());
			 		return $this->test;
			 	}
	
			 	if($array[$i][2]=="")
			 	{
			 		$teamThis='null';
			 	}
			 	else
			 	{
			 		if(!$int->isValid($array[$i][2]))
			 		{
			 			mysqli_rollback($this->conn->mysqli());
			 			return $this->test;
			 		}
			 		$teamThis="'".$array[$i][2]."'";
			 	}
	
			 	if(!$float->isValid($array[$i][1]))
			 	{
					 mysqli_rollback($this->conn->mysqli());
					 return $this->test;
			 	}
			 	 
				$query2 .= "call insertBetType('".$array[$i][0]."','".$array[$i][1]."','".$idEvent[0]["number"]."',".$teamThis.",'".$dates."');";
			 }
	
			$test=$this->conn->multiinsert($query2);
		 	if($test->info=='null')
		 	{
		 		mysqli_commit($this->conn->mysqli());
		 			
		 		$query = "CALL selectEventBets('".$betNameId."','".$dates."');";
		 		return  $this->conn->result( $query);	 
		 	}
		 	else
		 	{
		 		$test->type="error";
		 		$test->info="error";
		 		mysqli_rollback($this->conn->mysqli());
		 		return  $test;
		 	}
		}
		else
		{
			$this->test->type="error";
			$this->test->info="nologin";
			return $this->test;
		}
	}

	public function editOddsService( $array )
	{
		if($this->conn->checkAdmin())
		{
			$validator = new Zend_Validate_StringLength(1,100);
			$int = new Zend_Validate_Int();
			$float = new Zend_Validate_Float();
			 
			$dates = date("Y-m-d H:i:s") ;
			$query =" ";
			 
			$num=sizeof($array);
	
			if($num==0)
			{
			 	return "null";
			}
	
			$counNull=1;
			for($ie=0;$ie<$num;$ie++)
			{
				if($array[$ie][3]==null)
			  	{
			  		$counNull++;
			  	}
			}
			
			if($num==$counNull)
			{
			 	return $this->test;
			}
	
			for($i=0;$i<$num;$i++)
			{
			 	if($array[$i][2]==null)
			  	{
			  		$var="null";
			  	}
			 	else
			  	{
			  		if(!$int->isValid($array[$i][2]))
			  		{
			  			return $this->test;
			  		}
			  		$var="'".$array[$i][2]."'";
			  	}
	
			  	if(!$int->isValid($array[$i][4]))
			  	{
			  		return $this->test;
			  	} ;
			  
			  	if(!$float->isValid( $array[$i][1] ))
			  	{
			  		return $this->test;
			  	} ;
			  	
			  	if (!$validator->isValid($array[$i][0]))
			  	{
			  		return $this->test;
			  	}  ;
			  	
			  	if(!$int->isValid($array[$i][3]))
			  	{
			 		return $this->test;
			  	} ;
			  	
			  	$query .= "call updateBetOddsAll  ('".$array[$i][4]."','".$array[$i][1]."','".$dates."' ,$var,'".$array[$i][0]."','".$array[$i][3]."');";
			 }
	
			 return  $this->conn->multiinsert($query);
		}
		else
		{
			$this->test->type="error";
			$this->test->info="nologin";
			return $this->test;
		}
	}

	public function editEventService($id,$idGroup)
	{
		if($this->conn->checkAdmin())
		{
			$dates = date("Y-m-d H:i:s") ;
			$query = "call selectEditEvent('".$id."','".$dates."')";
			$array=array();
			$array[0]=$this->conn->result( $query );
			$query = "CALL selectEventBetTeams('".$id."')";
			$array[1]=$this->conn->result( $query );
			$query = "CALL selectTeams( '".$idGroup."')";
			$array[2]=$this->conn->result( $query );
	 
			return  $array;
		}
		else
		{
			$this->test->type="error";
			$this->test->info="nologin";
			return $this->test;
		}
	}

	public function updateBetsMain($updateData, $columnSelect , $groupIdEdited)
	{
		if($this->conn->checkAdmin())
		{
			$dates = date("Y-m-d H:i:s") ;
			$validator = new Zend_Validate_StringLength(2,100);
			$int = new Zend_Validate_Int();
			$timeval = new Zend_Validate_StringLength(15,20);

			if(!$int->isValid($groupIdEdited))
			{
				return $this->test;
			} ;
			 
			if($columnSelect=="name")
			{
			 	if (!$validator->isValid($updateData))
			 	{
					 return $this->test;
			 	}  ;

			 	$query = "CALL updateBets('name','".$updateData."','".$groupIdEdited."','".$dates."')";
			}
			else if($columnSelect=="dateact")
			{
				if (!$timeval->isValid($updateData))
				{
				 	return $this->test;
				}  ;
				
				if(time()>=strtotime($updateData))
				{
					return $this->test;
				}

				$query = "CALL updateBets('dateact','".$updateData."','".$groupIdEdited."','".$dates."')";
			}
			else if($columnSelect=="datend")
			{
				if (!$timeval->isValid($updateData))
				{
				 	return $this->test;
				}  ;

				if(time()>=strtotime($updateData))
				{
					return $this->test;
				}
				 
				$query = "CALL updateBets('datend','".$updateData."','".$groupIdEdited."','".$dates."')";
			}
			
			return   $this->conn->result( $query);
		}
		else
		{
			$this->test->type="error";
			$this->test->info="nologin";
			return $this->test;
		}
	}
	
	public function insertBets($text,$gId,$bType,$time, $timeActive )
	{
		if($this->conn->checkAdmin())
		{
			$dates = date("Y-m-d H:i:s") ;
			if(time()>=strtotime($timeActive)||time()>=strtotime($time))
			{
				return "Time is not set correct";
			}
			 
			if(strtotime($timeActive)>=strtotime($time))
			{
				return "Time is not set correct";
			}
		 	
			$int = new Zend_Validate_Int();
		 	$validator = new Zend_Validate_StringLength(2,250);
		 	$timeval = new Zend_Validate_StringLength(15,20);
		  
		 	$array= $bType;
		 	$num=sizeof($array);

		 	if(!$int->isValid($gId))
		 	{
		 		return $this->test;
		 	}
		 	
		 	if($num==0)
		 	{
		 		$this->test->info="teamcounter";
		 		$this->test->type="error";
		 	//  return    $this->test;
		 	}

		 	if (!$timeval->isValid($timeActive) )
		 	{
				 return $this->test;
			}
		  
		 	if (!$timeval->isValid($time))
		 	{
			 	return $this->test;
		 	}

		 	$int = new Zend_Validate_Int();

		 	if (!$validator->isValid($text))
		 	{
			 	return $this->test;
		 	}
		  
		 	if(!$int->isValid($gId))
		 	{
		 		return $this->test;
		 	}

		 	$query = "call insertBet('".$text."','".$gId."','".$time."','".$timeActive."','".$dates."')";

		 	$idEvent =$this->conn->result( $query);
		  
		 	$query2 =" ";

		 	for($i=0;$i<$num;$i++)
		 	{
		 		if(!$int->isValid($array[$i][0]))
		 		{
		 			return $this->test;
		 		}

			 	$query2 .= "call insertTeamToEvent('".$array[$i][0]."','".$idEvent[0]["number"]."','".$dates."','select');";	
		 	}

		 	$this->conn->multiinsert($query2);
		 	$query = "CALL selectBetBasic('".$gId."','".$dates."');";
		 	return  $this->conn->result( $query);
		}
		else
		{
			$this->test->type="error";
			$this->test->info="nologin";
			return $this->test;
		}
	}

	public function insertNewOddService($odd,$id)
	{
		if($this->conn->checkAdmin())
		{
			$float = new Zend_Validate_Float();
			if(!$float->isValid($odd))
			{
				return $this->test;
			}

			$int = new Zend_Validate_Int();

			if(!$int->isValid($id))
			{
				return $this->test;
			}

			$dates = date("Y-m-d H:i:s") ;
			$query = "call insertNewOdd('".$odd."','".$id."','".$dates."')";

			return $this->conn->multiresultbackArray( $query );
		}
		else
		{
			$this->test->type="error";
			$this->test->info="nologin";
			return $this->test;
		}
	}
	 
	public function updateBetType($text,$id)
	{
		if($this->conn->checkAdmin())
		{
			$validator = new Zend_Validate_StringLength(1,100);
			 
			if(!$validator->isValid($text))
			{
			 	return $this->test;
		 	}
		  
			$int = new Zend_Validate_Int();
	
			if(!$int->isValid($id))
			{
			 	return $this->test;
			}

		 	$dates = date("Y-m-d H:i:s") ;
		 	$query = "call updateBetType('".$text."','".$id."','".$dates."')";
		  
		 	return $this->conn->multiresultbackArray( $query );
		}
		else
		{
			$this->test->type="error";
			$this->test->info="nologin";
			return $this->test;
		}
	}

	/*   public function insertBetType($arrayParam )
	 {
	 $query = "call insertBetTypeOne('".$arrayParam[0][0]."','".$arrayParam[0][1]."','".$arrayParam[0][2]."')";
	 return $this->conn->result( $query );
	 }*/

	public function updateBets($updateData, $columnSelect , $groupIdEdited)
	{
		if($this->conn->checkAdmin())
		{
			$int = new Zend_Validate_Int(); 
			$dates = date("Y-m-d H:i:s") ;
			 
			if(!$int->isValid($groupIdEdited))
			{
				return $this->test;
			}	
			 
			if($columnSelect=="name")
			{
				$validator = new Zend_Validate_StringLength(2,250);
				if (!$validator->isValid($updateData))
			 	{
			  		return $this->test;
			 	}

			 	$query = "CALL updateBetsName('".$updateData."','".$groupIdEdited."','".$dates."')";
			}
			else if($columnSelect=="event")
			{	 
				if(!$int->isValid($updateData))
				{
					return $this->test;
				}	 
				$query = "CALL updateBetOdds('".$updateData."','".$groupIdEdited."','".$dates."')";
			}
			 
			return   $this->conn->result( $query);
		}
		else
		{
			$this->test->type="error";
			$this->test->info="nologin";
			return $this->test;
		}
	}

	public function updateBetSavedService($score,$corec )
	{
		if($this->conn->checkAdmin())
		{
			$int = new Zend_Validate_Int();

			if(!$int->isValid($corec))
			{
				return $this->test;
			}
			 
			$validator = new Zend_Validate_StringLength(1,100);
			if (!$validator->isValid($score))
			{
				return $this->test;
			}

			$admin=$this->conn->getAdminId();
		 	$dates = date("Y-m-d H:i:s") ;
		 	$query = "CALL updateBetData( '".$score."','".$corec."','".$dates."','".$admin."')";

		 	return $this->conn->insert( $query);
		}
		else
		{
			$this->test->type="error";
			$this->test->info="nologin";
			return $this->test;
		}
		 
	}
	
	/*
	 public function selectSportBetsRows($id)
	 {
	 $int = new Zend_Validate_Int();
	  
	 if(!$int->isValid($id))
	 {
	 $messages = $int->getMessages();
	 return  current($messages);
	 }
	  
	 $query = "CALL selectGroupAndSports('".$id."')";
	 return  $this->conn->result( $query);
	 }
	 */
	public function selectSportBetsData ($groupsParam ,$eventId,$status,$betId,$timeParam  )
	{
		if($this->conn->checkAdmin())
		{
			$dates = date("Y-m-d H:i:s") ;
			$int = new Zend_Validate_Int();

		 	if(!$int->isValid($groupsParam))
		 	{
		 		return $this->test;
		 	}
		  
		 	if(!$int->isValid($eventId))
		 	{
		 		return $this->test;
		 	}
		  
		 	if(!$int->isValid($betId))
		 	{
		 		return $this->test;
		 	}
		  
		 	if(!$int->isValid($status))
		 	{
		 		return $this->test;
		 	}
		 
		 	$timeval = new Zend_Validate_StringLength(15,20);
		  
		 	if($status==2)
		 	{
		 		if(!$timeval->isValid($timeParam))
		 		{
		 			return $this->test;
		 		}
		 	}
		 	else
		 	{
		 		$timeParam=0;
		 	}

		 	$query = "CALL selectBets('".$groupsParam."','".$dates."', '".$eventId."','".$status."','".$betId."','".$timeParam."')";

		 	return  $this->conn->multiresultbackArray( $query);
		}
		else
		{
			$this->test->type="error";
			$this->test->info="nologin";
			return $this->test;
		}
	}

	public function selectSportOnlyBets ($groupsParam,$timeParam,$eventId,$status,$betId )
	{	
		if($this->conn->checkAdmin())
		{
		 	$dates = date("Y-m-d H:i:s") ;
			$int = new Zend_Validate_Int();
			$timeval = new Zend_Validate_StringLength(0,20);

			if (!$timeval->isValid($timeParam))
			{
				return $this->test;
			}
		 
			if(!$int->isValid($groupsParam))
			{
				return $this->test;
			}
		 
		 
			if(!$int->isValid($eventId))
			{
				return $this->test;
			}
		 
			if(!$int->isValid($betId))
			{
				return $this->test;
			}
		 
			if(!$int->isValid($status))
			{
				return $this->test;
			}
		 
		 
			$query = "CALL selectOnlyBets('".$groupsParam."','".$dates."','".$timeParam."','".$eventId."','".$status."','".$betId."')";
		 
			return  $this->conn->result( $query);
		}
		else
		{
			$this->test->type="error";
			$this->test->info="nologin";
			return $this->test;
		}
	}
	 
	public function serviceDeleteActiveEvent($id)
	{
		if($this->conn->checkAdmin())
		{
			$dates = date("Y-m-d H:i:s") ;
			$int = new Zend_Validate_Int();
			 
			if(!$int->isValid($id))
			{
				return $this->test;
			}

			$query = "CALL deleteActiveEvent('".$id."','".$dates."' );call updateBetCanceled('".$dates."');";
			 
			return  $this->conn->multiinsert( $query);
		}
		else
		{
			$this->test->type="error";
			$this->test->info="nologin";
			return $this->test;
		}
	}

	public function serviceDeleteActiveBet($id,$param)
	{
		if($this->conn->checkAdmin())
		{
			$dates = date("Y-m-d H:i:s") ;
			$int = new Zend_Validate_Int();
			 
			if(!$int->isValid($id))
			{
				return $this->test;
			}
	 
			if($param==1)
			{
		 		$query = "CALL deleteActiveBet('".$id."','".$dates."','arhive');call updateBetCanceled('".$dates."');";
			}
			else if($param==0)
			{
				$query = "CALL deleteActiveBet('".$id."','".$dates."','finished');call updateBetCanceled('".$dates."');";
			}
			else if($param==2)
			{
				$query = "CALL deleteActiveBet('".$id."','".$dates."','fintoarh');call updateBetCanceled('".$dates."');";
			}
			return  $this->conn->multiinsert( $query);
		}
		else
		{
			$this->test->type="error";
			$this->test->info="nologin";
			return $this->test;
		}
	}
	 
	public function deleteBetsType ($param )
	{
		if($this->conn->checkAdmin())
		{		 
			$int = new Zend_Validate_Int();
			 
			if(!$int->isValid($param))
			{
				return $this->test;
			}

			$query = "CALL deleteBetType('".$param."')";
			return  $this->conn->result( $query);
		}
		else
		{
			$this->test->type="error";
			$this->test->info="nologin";
			return $this->test;
		}
	}

	public function deleteBet($param )
	{	
		if($this->conn->checkAdmin())
		{
			$int = new Zend_Validate_Int();
		 
			if(!$int->isValid($param))
			{
				return $this->test;
			}
			$dates = date("Y-m-d H:i:s") ;
			$query = "CALL deleteBet('".$param."','".$dates."')";
			return  $this->conn->insert( $query);
		}
		else
		{
			$this->test->type="error";
			$this->test->info="nologin";
			return $this->test;
		}
	}

	public function selectViewOdds($id)
	{
		if($this->conn->checkAdmin())
		{
			$dates = date("Y-m-d H:i:s") ;
			$int = new Zend_Validate_Int();
			 
			if(!$int->isValid($id))
			{
				return $this->test;
			}
			 
			$query = "CALL selectViewOdd('".$id."')";
			return  $this->conn->multiresultbackArray( $query);
		}
		else
		{
			$this->test->type="error";
			$this->test->info="nologin";
			return $this->test;
		}
	}

	public function selectBetEdit($id,$idBet)
	{
		if($this->conn->checkAdmin())
		{
			$int = new Zend_Validate_Int();
			if(!$int->isValid($id))
			{
				return $this->test;
			}
			$dates = date("Y-m-d H:i:s") ;
			$query = "CALL selectEditBet('".$id."','".$dates."');call selectEventBetTeams('".$idBet."')";
			 
			return   $this->conn->multiresultbackArray(	$query );
		}
		else
		{
			$this->test->type="error";
			$this->test->info="nologin";
			return $this->test;
		}
	}

	public function selectBetEditEnd($id)
	{
		if($this->conn->checkAdmin())
		{
			$int = new Zend_Validate_Int();
			if(!$int->isValid($id))
			{
				return $this->test;
			}
			 
			$dates = date("Y-m-d H:i:s") ;
			$query = "CALL  selectBetEditEnd('".$id."','".$dates."')";
			return   $this->conn->multiresultbackArray(	$query );			 
		}
		else
		{
			$this->test->type="error";
			$this->test->info="nologin";
			return $this->test;
		}
	}

	public function selectBetEditArhive($id)
	{
		if($this->conn->checkAdmin())
		{
			$int = new Zend_Validate_Int();
			if(!$int->isValid($id))
			{
				return $this->test;
			}

			$query = "CALL  selectBetEditArihve('".$id."')";
			return   $this->conn->multiresultbackArray(	$query );
		}
		else
		{
			$this->test->type="error";
			$this->test->info="nologin";
			return $this->test;
		}
	}

	public function setDataForBet($id)
	{
		if($this->conn->checkAdmin())
		{
			$int = new Zend_Validate_Int();
			 
			if(!$int->isValid($id))
			{
				return $this->test;
			}
			 
			return   $this->conn->multiresultbackArray("CALL selectBetData('".$id."')");
		}
		else
		{
			$this->test->type="error";
			$this->test->info="nologin";
			return $this->test;
		}
	}

	public function userSetDataForBet($id)
	{
		if($this->conn->checkAdmin())
		{
			$int = new Zend_Validate_Int();
			 
			if(!$int->isValid($id))
			{
				return $this->test;
			}
			$array=array();
			$query = "CALL selectSports('".$id."')";
			$array[0]= $this->conn->result( $query);

			$query = "CALL selectGroupAndSports('".$id."')";
			$array[1]= $this->conn->result( $query);	 
			return   $array;
		}
		else
		{
			$this->test->type="error";
			$this->test->info="nologin";
			return $this->test;
		}
	}

	public function userGetEvents($id)
	{
		$int = new Zend_Validate_Int();

		if(!$int->isValid($id))
		{
			return $this->test;
		}
		 
		$dates = date("Y-m-d H:i:s") ;
		$query = "CALL userSelectEventGroup('".$id."','".$dates."')";
		return  $this->conn->result( $query);
	}

	public function userActiveBetAdd ($idGroup )
	{
		$int = new Zend_Validate_Int();
		if(!$int->isValid($idGroup))
		{
			return $this->test;
		}
		 
		$dates = date("Y-m-d H:i:s") ;
		$query = "CALL userSelectActiveBetsAdd('".$idGroup."','".$dates."')";
		return  $this->conn->multiresultbackArray($query);
	}
	 
	public function userActiveBet ($idGroup,$idEvent)
	{
		$int = new Zend_Validate_Int();
		if(!$int->isValid($idGroup))
		{
			return $this->test;
		}
		 
		if(!$int->isValid($idEvent))
		{
			return $this->test;
		}
		 
		$dates = date("Y-m-d H:i:s") ;
		$query = "CALL userSelectActiveBets('".$idGroup."','".$dates."','".$idEvent."')";
		return  $this->conn->multiresultbackArray($query);
	}

	public function setBetBasicService($id )
	{
		if($this->conn->checkAdmin())
		{
			$dates = date("Y-m-d H:i:s") ;
			$int = new Zend_Validate_Int();
			 
			if(!$int->isValid($id))
			{
				return $this->test;
			}
			 
			$query = "CALL selectBetBasic('".$id."','".$dates."');";
			return  $this->conn->result( $query);
		}
		else
		{
			$this->test->type="error";
			$this->test->info="nologin";
			return $this->test;
		}
	}

	public function addNewTeamToEventService($id,$teamId)
	{
		if($this->conn->checkAdmin())
		{
			$int = new Zend_Validate_Int();
			 
			if(!$int->isValid($id))
			{
				return $this->test;
			}

			if(!$int->isValid($teamId))
			{
				return $this->test;
			}
			 
			$dates = date("Y-m-d H:i:s") ;
			$query = "call insertTeamToEvent('".$teamId."','".$id."','".$dates."','select');";
			return  $this->conn->result( $query);
		}
		else
		{
			$this->test->type="error";
			$this->test->info="nologin";
			return $this->test;
		}
	}

	public function selectBetEventTeam($id)
	{
		if($this->conn->checkAdmin())
		{
			$int = new Zend_Validate_Int();
			 
			if(!$int->isValid($id))
			{
				return $this->test;
			}

		 	$query = "call selectEventBetTeams('".$id."')";
		 	return $this->conn->result( $query );
		}
		else
		{
			$this->test->type="error";
			$this->test->info="nologin";
			return $this->test;
		}
	}

	public function updateBetEventTeam($id,$teamId)
	{
		if($this->conn->checkAdmin())
		{
			$int = new Zend_Validate_Int();
			 
			if(!$int->isValid($id))
			{
				return $this->test;
			}
			 
			if(!$int->isValid($teamId))
			{
				return $this->test;
			}
			 
			$dates = date("Y-m-d H:i:s") ;
			$query = "call updateBetTeams('".$teamId."','".$id."','".$dates."');";
			return  $this->conn->result( $query);
		}
		else
		{
			$this->test->type="error";
			$this->test->info="nologin";
			return $this->test;
		}
	}

	public function deleteBetsTeamsService($id)
	{
		if($this->conn->checkAdmin())
		{
			$int = new Zend_Validate_Int();
			 
			if(!$int->isValid($id))
			{
				return $this->test;
			}
			 
			$dates = date("Y-m-d H:i:s") ;
			$query = "call deleteBetTeams('".$id."','".$dates."');";
			return  $this->conn->result( $query);
		}
		else
		{
			$this->test->type="error";
			$this->test->info="nologin";
			return $this->test;
		}
	}

	public function resetBetService($id)
	{		 
		if($this->conn->checkAdmin())
		{
			$int = new Zend_Validate_Int();
			 
			if(!$int->isValid($id))
			{
				return $this->test;
			}

			$query = "call resetArhiveBets('".$id."');";
			//   	 return 	 $query ;
			return  $this->conn->insert( $query);
		}
		else
		{
			$this->test->type="error";
			$this->test->info="nologin";
			return $this->test;
		}
	}

	public function selectUserPlacedBets($id,$datefirst,$datesecond,$status)
	{
		if($this->conn->checkAdmin())
		{
			$int = new Zend_Validate_Int();
			if(!$int->isValid($id))
			{
				return $this->test;
			}
			 
			$timeval = new Zend_Validate_StringLength(15,20);

			if (!$timeval->isValid($datefirst))
			{
				return $this->test;
			}  ;
			 	
			if (!$timeval->isValid($datesecond))
			{
				 return $this->test;
			}  ;
			 	
			$timeval->setMin(1);
			$timeval->setMax(10);
		 	
		 	if (!$timeval->isValid($status))
		 	{
				return $this->test;
		 	}  ;
		  
		 	$query = "call select_bet_slip_user_admin('".$id."','".$datefirst."','".$datesecond."','".$status."');";
		 	return  $this->conn->multiresultbackArray( $query);
		}
		else
		{
			$userID=$this->conn->getAdminId();
			 
			if($this->conn->checkUser())
			{
				$int = new Zend_Validate_Int();
				if(!$int->isValid($id))
				{
					return $this->test;
				}

				$timeval = new Zend_Validate_StringLength(15,20);
					
				if (!$timeval->isValid($datefirst))
				{
					return $this->test;
				}  ;

				if (!$timeval->isValid($datesecond))
				{
					return $this->test;
				}  ;

				$timeval->setMin(1);
				$timeval->setMax(10);

				if (!$timeval->isValid($status))
				{
					return $this->test;
				}  ;

				$query = "call select_bet_slip_user_admin('".$userID."','".$datefirst."','".$datesecond."','".$status."');";
				return  $this->conn->multiresultbackArray( $query);
			}
			else
			{
				$this->test->type="error";
				$this->test->info="nologin";
				return $this->test;
			}
		}
	}


	public function userInsertBet($money,$betTypes)
	{
		if($this->conn->checkUser())
		{
			mysqli_autocommit( $this->conn->mysqli(), FALSE);

			$float = new Zend_Validate_Float();
			if(!$float->isValid($money))
			{
				return $this->test;
			}			 
			 
			$status=true;

			$dates = date("Y-m-d H:i:s") ;
			$num =sizeof($betTypes);

			$query =" ";
			for($i=0;$i<$num;$i++)
			{
				$int = new Zend_Validate_Int();
				 
				if(!$int->isValid($betTypes[$i][0]))
				{

					return $this->test;
				}
					
				$query .= "call userBetValidation('".$betTypes[$i][0]."','".$dates."');";
			}

			$arrayCheck=$this->conn->multiresultbackArray($query);
			 
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
				$this->test->type="error";
				$this->test->info='oudated';
				$this->test->message=$arrayCheck[0][0];
				mysqli_rollback($this->conn->mysqli());
				return	$this->test;
			}

			$query2 =" ";
			for($i=0;$i<$num;$i++)
			{
				$query2 .= "call userOddValidation('".$betTypes[$i][0]."','".$betTypes[$i][1]."');";
			}
			 
			$arrayCheck2=$this->conn->multiresultbackArray($query2);
			$num3=sizeof($arrayCheck2);
			 
			for($i=0;$i<sizeof($num3);$i++)
			{
				if($arrayCheck2[0][0][$i]!='ok')
				{
					$status=false;
				}		
			}

			if( $status==false)
			{
				$this->test->type="error";
				$this->test->info='oudated';
				$this->test->message=$arrayCheck2[0][0];
				mysqli_rollback($this->conn->mysqli());
				return	$this->test;
			}
			 
			$userID=$this->conn->getAdminId();
			 
		 	$query =  "call selectCheckMoney('".$userID."','".$money."')";
		 	
		 	$testMon= $this->conn->result( $query);


		 	if($testMon[0][0]!="ok")
		 	{
		 		$this->test->type="error";
		 		$this->test->info='money';
		 		$this->test->message="not enough money in your account";
		 		mysqli_rollback($this->conn->mysqli());
		 		return	$this->test;
		 	}

		 //1 cijeli vrijeme ozna�i primaray key od user

		 	$query =  "call  userInsertBetSlip( '".$dates."','$userID','".$money."')";
		 	$test= $this->conn->result( $query);
		  
		 	$query4 =" ";
		 	for($i=0;$i<$num;$i++)
		 	{
		 		$query4 .= "call  usertInsertBetType( '".$test[0][0]."','".$betTypes[$i][0]."');";
		 	}

		 	$test=$this->conn->multiinsert($query4);
		  
	 		if($test->info=='null')
	 		{
	 			mysqli_commit($this->conn->mysqli());
	 			return  $test;
	 		}
	 		else
	 		{
	 			$test->type="error";
	 			$test->info="no";
	 			mysqli_rollback($this->conn->mysqli());
	 			return  $test;
	 		}
		}
		else
		{
			$this->test->type="error";
			$this->test->info="nologin";
			return $this->test;
		}
	}

	public function deleteEventBets($id)
	{
		if($this->conn->checkAdmin())
		{
			$int = new Zend_Validate_Int();
			 
			if(!$int->isValid($id))
			{
				return $this->test;
			}
			 
			$dates = date("Y-m-d H:i:s") ;
			$query = "call deleteEventBets('".$id."','".$dates."');";
			 
			return  $this->conn->insert( $query);
		}
		else
		{
			$this->test->type="error";
			$this->test->info="nologin";
			return $this->test;
		}
	}
}