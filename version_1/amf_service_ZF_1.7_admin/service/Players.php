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
 * manange players
 */
class Players
{
	public function __construct()
	{
		$this->conn = new StoredConnections();
		$this->test = new CustomError();
	}

	public function serviceOneUser($userId)
	{

		if($this->conn->checkAdmin())
		{
		 	$int = new Zend_Validate_Int();
		 	if(!$int->isValid($userId))
		 	{
		 		return $this->test;
		 	}
		  
		 	$query ="call selectOneUser('".$userId."')" ;

		 	return   $this->conn->result( $query );
		}
		else
		{
			$this->test->type="error";
			$this->test->info="nologin";
			return $this->test;
		}			
	}

	public function updatePlayersService(  $userId,$username, $password,  $firstname, $lastname, $email )
	{
			
		if($this->conn->checkAdmin())
		{
			$string = new Zend_Validate_StringLength(5,20);
			$emailValidator = new Zend_Validate_EmailAddress();
			$int = new Zend_Validate_Int();

			if(!$int->isValid($userId))
			{
				return $this->test;
			}
	 	 
			if(!$string->isValid($username))
			{
				return $this->test;
			}
			if(!$emailValidator->isValid($email))
			{
				return $this->test;
			}
			 
			$query ="call selectAddUser( '".$username."','".$userId."')" ;

			$te=$this->conn->result($query);
			if( is_array($te))
			{
			 	$this->test->type="error";
			 	$this->test->info="duplicateUser";
			 	return  $this->test;
			}

			$query2 ="call selectAddEmail( '".$email."','".$userId."')" ;

			$te2=$this->conn->result($query2);
			 
			if( is_array($te2))
			{
			 	$this->test->type="error";
			 	$this->test->info="duplicateEmail";
			 	return $this->test;
			}
			
			$string->setMin(2);
			$string->setMax(50);
			 
			if(!$string->isValid( $firstname))
			{
				return $this->test;
			}
			if(!$string->isValid($lastname))
			{
				return $this->test;
			}

			$string->setMin(6);
			$string->setMax(20);
	   
			$status= $this->conn->getStatus();

			if($status==2)
			{
				$userId=$this->conn->getAdminId();
			}

			$query ="call updateUserData('".$userId."','".$username."','".$firstname."','".$lastname."','".$email."','".$status."')" ;
			$returnData= $this->conn->result( $query );

			if($string->isValid( $password))
			{
				$salt=substr(mt_rand(),0,9);
				$pasWithSalt=$password.$salt;
				$hash=sha1($pasWithSalt);
				$query ="call updateUserPassword('".$userId."','".$hash."','".$salt."')" ;
				$this->conn->insert( $query );
			}
	 	 
			return $returnData;
		}
		else
		{
			if($this->conn->checkUser())
			{
				$string = new Zend_Validate_StringLength(5,20);
				$emailValidator = new Zend_Validate_EmailAddress();
				$int = new Zend_Validate_Int();
					
				if(!$int->isValid($userId))
				{
					return $this->test;
				}

				if(!$string->isValid($username))
				{
					return $this->test;
				}
				if(!$emailValidator->isValid($email))
				{
					return $this->test;
				}

				$query ="call selectAddUser( '".$username."','".$userId."')" ;
				$te=$this->conn->result($query);

				if( is_array($te))
				{
				 $this->test->type="error";
				 $this->test->info="duplicateUser";
				 return  $this->test;
				}
				 
				$query2 ="call selectAddEmail( '".$email."','".$userId."')" ;
				 
				$te2=$this->conn->result($query2);

				if( is_array($te2))
				{
				 $this->test->type="error";
				 $this->test->info="duplicateEmail";
				 return $this->test;
				}
				 					
				$string->setMin(2);
				$string->setMax(50);

				if(!$string->isValid( $firstname))
				{
					return $this->test;
				}
				if(!$string->isValid($lastname))
				{
					return $this->test;
				}
				 
				$string->setMin(6);
				$string->setMax(20);

				$status= $this->conn->getStatus();
				$userId=$this->conn->getAdminId();
				$query ="call updateUserData('".$userId."','".$username."','".$firstname."','".$lastname."','".$email."','".$status."')" ;
				$returnData= $this->conn->result( $query );
					
				if($string->isValid( $password))
				{
					$salt=substr(mt_rand(),0,9);
					$pasWithSalt=$password.$salt;
					$hash=sha1($pasWithSalt);
					$query ="call updateUserPassword('".$userId."','".$hash."','".$salt."')" ;
					$this->conn->insert( $query );
				}

				return $returnData;					
			}
			else
			{
				$this->test->type="error";
				$this->test->info="nologin";
				return $this->test;
			}
		}
	}

	public function deletePlayer($id )
	{
		if($this->conn->checkAdmin( ))
		{
			$int = new Zend_Validate_Int();
			 
		 	if(!$int->isValid($id))
		 	{
		 		return $this->test;
		 	}
		 	$status= $this->conn->getStatus();
		 	$query ="call deletePlayers('".$id."','".$status."')" ;
		 	return $this->conn->insert( $query );
		}
		else
		{
			$this->test->type="error";
			$this->test->info="nologin";
			return $this->test;
		}
	}

	public function registerPlayer(  $username, $password,  $firstname, $lastname, $email )
	{
		$dates = date("Y-m-d H:i:s") ;
		 
		$validator = new Zend_Validate_StringLength();

		$emailValidator = new Zend_Validate_EmailAddress();
		 
		$int = new Zend_Validate_Int();
		 
		if(!$emailValidator->isValid($email))
		{
			return $this->test;
		}

		$validator->setMax(20);
		$validator->setMin(5);
			
		if(!$validator->isValid($username))
		{
			return $this->test;
		}
		 			
		if(!$validator->isValid( $password))
		{
			return $this->test;
		}
		$validator->setMax(50);
		$validator->setMin(2);
			
		if(!$validator->isValid( $firstname))
		{
			return $this->test;
		}

		if(!$validator->isValid($lastname))
		{
			return $this->test;
		}

		$salt=substr(mt_rand(),0,9);
		$pasWithSalt=$password.$salt;
		$hash=sha1($pasWithSalt);

		$query ="call selectCheckUser( '".$username."')" ;
		$te=$this->conn->result($query);

		if( is_array($te))
		{
			$this->test->type="error";
			$this->test->info="duplicate";
			$this->test->message="duplicate User";
			return $this->test;
		}

		$query2 ="call selectCeckEmail( '".$email."')" ;

		$te2=$this->conn->result($query2);
		 
		if( is_array($te2))
		{
			$this->test->type="error";
			$this->test->info="duplicate";
			$this->test->message="duplicate Email";
			return $this->test;
		}
		/*
		 	
		ugraditi mail activation kad sustav bude online
		te ugraditi da se automatski iz baze loadira koliko para treba uplatiti korisniku
		*/

		$query3 ="call  registerUser( '".$username."','". $hash."', '".$firstname."','".$lastname."','".$email."','".$dates."','1','".$salt."' )" ;
		return $this->conn->insert( $query3 );
	}

	public function insertPlayersService (  $username, $password, $money, $firstname, $lastname, $email,$adminOrUser)
	{
		if($this->conn->checkAdmin())
		{
			$dates = date("Y-m-d H:i:s") ;
	   
			$validator = new Zend_Validate_StringLength();
			$float = new Zend_Validate_Float();
			$emailValidator = new Zend_Validate_EmailAddress();
	   
			$int = new Zend_Validate_Int();

			if(!$emailValidator->isValid($email))
			{
				return $this->test;
			}

			if(!$float->isValid($money))
			{
				return $this->test;
			}

			$validator->setMax(20);
			$validator->setMin(5);
				
			if(!$validator->isValid($username))
			{
				return $this->test;
			}
			 				
			if(!$validator->isValid( $password))
			{
				return $this->test;
			}
			$validator->setMax(50);
			$validator->setMin(2);
				
			if(!$validator->isValid( $firstname))
			{
				return $this->test;
			}

			if(!$validator->isValid($lastname))
			{
				return $this->test;
			}

			if($adminOrUser=="User")
			{
				$adminOrUser=1;
			}
			else if($adminOrUser=="Admin")
			{
				$adminOrUser=2 ;
			}
			else
			{
				return $this->test;
			}

			$salt=substr(mt_rand(),0,9);
			$pasWithSalt=$password.$salt;
			$hash=sha1($pasWithSalt);

		 	$query ="call selectCheckUser( '".$username."')" ;
		 	$te=$this->conn->result($query);

		 	if( is_array($te))
		 	{
			 	$this->test->type="error";
			 	$this->test->info="duplicate";
				$this->test->message="duplicate User";
			 	return $this->test;
		 	}

		 	$query2 ="call selectCeckEmail( '".$email."')" ;

		 	$te2=$this->conn->result($query2);
		  
		 	if( is_array($te2))
		 	{
			 	$this->test->type="error";
			 	$this->test->info="duplicate";
			 	$this->test->message="duplicate Email";
			 	return $this->test;
		 	}
		 	$admin=$this->conn->getAdminId();

		 	if($adminOrUser==1)
		 	{
				$query3 ="call  insertUser( '".$username."','". $hash."','".$money."','".$firstname."','".$lastname."','".$email."','".$dates."','".$adminOrUser."','".$salt."','".$admin."')" ;
		 	}
		 	else if($adminOrUser==2)
		 	{
		 		$query3 ="call  insertAdmin( '".$username."','". $hash."','".$money."','".$firstname."','".$lastname."','".$email."','".$dates."','".$adminOrUser."','".$salt."','".$admin."')" ;
		 	}
		 	
		 	return $this->conn->insert( $query3 );	   
		}
		else
		{
			$this->test->type="error";
			$this->test->info="nologin";
			return $this->test;
		}			
	}

	public function selectPlayersService ($param,$playerOrAdmin)
	{
		if($this->conn->checkAdmin())
		{
			$int = new Zend_Validate_Int();
			 
	 		if(!$int->isValid($param))
	 		{
	 			return $this->test;
	 		}
	 	 
	 		if(!$int->isValid($playerOrAdmin))
	 		{
	 			return $this->test;
	 		}	
	 	 
	 		$query ="call selectUsers('".$param."','".$playerOrAdmin."')" ;
	 		return $this->conn->multiresultbackArray( $query );
		}
		else
		{
			$this->test->type="error";
			$this->test->info="nologin";
			return $this->test;
		}	
	}

	public function callTransactions($user,$datefirst,$datesecond,$status)
	{
		if($this->conn->checkAdmin())
		{
			$validator = new Zend_Validate_StringLength(15,20);
			 
			$int = new Zend_Validate_Int();

			if(!$validator->isValid( $datefirst))
			{
				return $this->test;
			}
			 
			if(!$validator->isValid( $datesecond))
			{
				return $this->test;
			}
			$validator->setMin(3);
			$validator->setMax(6);

			if(!$validator->isValid($status))
			{
				return $this->test;
			}

	 		if(!$int->isValid($user))
	 		{
	 			return $this->test;
	 		}
	 	 
		 	$query ="call  selectTransactions('".$user."','".$datefirst."','".$datesecond."','".$status."')" ;
		 	return $this->conn->result( $query );
		}
		else
		{
			if($this->conn->checkUser())
			{
				$validator = new Zend_Validate_StringLength(15,20);
					
				$int = new Zend_Validate_Int();

				if(!$validator->isValid( $datefirst))
				{
					return $this->test;
				}
					
				if(!$validator->isValid( $datesecond))
				{
					return $this->test;
				}
				$validator->setMin(3);
				$validator->setMax(6);

				if(!$validator->isValid($status))
				{
					return $this->test;
				}
				
				if(!$int->isValid($user))
				{
					return $this->test;
				}

				$userID=$this->conn->getAdminId();
					
				$query ="call  selectTransactions('".$userID."','".$datefirst."','".$datesecond."','".$status."')" ;
				return $this->conn->result( $query );					
			}
			else
			{
				$this->test->type="error";
				$this->test->info="nologin";
				return $this->test;
			}		
		}
	}

	public function userFunds($user)
	{
		if($this->conn->checkAdmin())
		{
			$int = new Zend_Validate_Int();
			 
	 		if(!$int->isValid($user))
	 		{
	 			return $this->test;
	 		}

	 		$query ="call usertSelectMoney('".$user."')" ;
	 		return $this->conn->result( $query );
		}
		else
		{
			if($this->conn->checkUser())
			{
				$int = new Zend_Validate_Int();
					
				if(!$int->isValid($user))
				{
					return $this->test;
				}

				$userID=$this->conn->getAdminId();
				$query ="call usertSelectMoney('".$userID."')" ;
				return $this->conn->result( $query );	
			}
			else
			{
				$this->test->type="error";
				$this->test->info="nologin";
				return $this->test;
			}
		}
	}
	 
	public function searchUser($pagging,$critera,$termin)
	{
		if($this->conn->checkAdmin())
		{
			$int = new Zend_Validate_Int();
				 
		 	if(!$int->isValid($critera))
		 	{
		 		return $this->test;
		 	}
		 	 
		 	if(!$int->isValid($pagging))
		 	{
		 		return $this->test;
		 	}
		 	 
		 	$validator = new Zend_Validate_StringLength(1,100);
	
		 	if(!$validator->isValid($termin))
		 	{
		 		return $this->test;
		 	}
	
		 	$query ="call selectSearchUser('".$pagging."','".$critera."','".$termin."')" ;
		 	 
		 	return $this->conn->multiresultbackArray( $query );
		 	 
		}
		else
		{
			$this->test->type="error";
			$this->test->info="nologin";
			return $this->test;
		}
			
	}
	 
	public function serviceTransaction($money,$status,$userId)
	{
		if($this->conn->checkAdmin())
		{
			$dates = date("Y-m-d H:i:s") ;

			$float = new Zend_Validate_Float();

			$int = new Zend_Validate_Int();
			if(!$int->isValid($status))
			{
				return $this->test;
			}			 
			 
			if(!$int->isValid($status))
			{
				return $this->test;
			}

			if($money<0.01)
			{
				return $this->test;
			}
			 
			if(!$float->isValid($userId))
			{
				return $this->test;
			}

			$query ="call insertTransactions('".$money."','".$status."','".$userId."','".$dates."')" ;
				
			return $this->conn->multiresultbackArray( $query );	  	
		}
		else
		{
			$this->test->type="error";
			$this->test->info="nologin";
			return $this->test;
		}
	}
}