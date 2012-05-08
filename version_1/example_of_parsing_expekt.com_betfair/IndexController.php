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
	 * execute action and c/p displayed html page in sql
	 * page will generate query to database
	 */
	class  IndexController extends Zend_Controller_Action
	{
		private $eventHolder=array();
		private $title;
		private $link;
		private $description;
		private $image;
		private $parsedData=array();
		private $counter=0;
		private $innerCounter=0;
		private $htmlData;
	
	/*
	 * expekt xml file is download to localhost because its to slow to parse online version
	 * use this as examples
	 */
	public function indexAction()
	{
		$activeGroup=array();
			
		//groups ID in database must be mached with expekt rss ID
		$this->codesArray=array();
		$this->codesArray["SOCMENEURITAFST"]=1;
		$this->codesArray["SOCMENEURESPFST"]=2;
		$this->codesArray["SOCMENEURGERFST"]=3;
		$this->codesArray["SOCMENEURCROHNL"]=4;
		$this->codesArray["SOCMENEURENGFST"]=5;
		$this->codesArray["SOCMENEURINTCUPCLG"]=6;
		$this->codesArray["SOCMENEURINTCUPUEF"]=7;
		$this->codesArray["SOCMENEURINTEURQUA"]=8;
		$this->codesArray["SOCMENEURDENFST"]=9;
		$this->codesArray["SOCMENEURNORFST"]=10;
		$this->codesArray["SOCMENEURSWESPR"]=11;
		$this->codesArray["SOCMENEURBULVYS"]=12;
		$this->codesArray["SOCMENASTASTLEA"]=13;
		$this->codesArray["SOCMENEURPORCUP"]=14;
		$this->codesArray["SOCMENEURGRECUP"]=16;
		$this->codesArray["SOCMENASIINTASC"]=17;
		$this->codesArray["SOCMENEURITACUPNRM"]=18;
		$this->codesArray["SOCMENEURHOLFST"]=19;
		$this->codesArray["SOCMENEURFRAFST"]=20;
		$this->codesArray["SOCMENEURGERCUP"]=21;
		$this->codesArray["SOCMENEURESPCUP"]=22;
		$this->codesArray["SOCMENSAMBRACAR"]=23;
		$this->codesArray["SOCMENEURFRALEACUP"]=24;
		$this->codesArray["SOCMENEURSCOCUP"]=25;
		$this->codesArray["SOCMENEURENGFAC"]=26;
		
	
		//$xmlurl="http://exportServlet.xml"; 	 http://odds.expekt.com/exportServlet?category=SOC%25
		$xmlurl="http://localhost/exportServlet.xml";
		$xml = $this->get_web_page($xmlurl);
		$dom=new DomDocument('1.0');
		$dom->loadXML($xml['content']);
		$games=$dom->getElementsByTagName('game') ;
		$betId=1;
		$betHolder=array();
		foreach($games as $g)
		{
			$echoResult=false;
			$category=$g->getElementsByTagName('category');
			$typeArray=$g->getElementsByTagName('type');
		
			foreach($category as $c)
			{
				if($this->checkGroup($c->getAttribute('id'))!=false)
				{
					$this->eventHolder[$g->getAttribute('id')]['id']=$g->getAttribute('id');
					$this->eventHolder[$g->getAttribute('id')]['stringId']=$c->getAttribute('id');
					$this->eventHolder[$g->getAttribute('id')]['betId']=
					$echoResult=true;
					//print_r("Id:".$c->getAttribute('id')."  Name".$c->nodeValue."<br/>");
					foreach($typeArray as $t)
					{
						$this->eventHolder[$g->getAttribute('id')]['type']=$t->getAttribute('id');
					}
					
					$description=$g->getElementsByTagName('description') ;
					foreach($description as $d)
					{
						$desc=str_replace($c->nodeValue,"",$d->nodeValue);
						if(strpos($desc,":")===false)
						{
							$this->eventHolder[$g->getAttribute('id')]['betId']=$betId;
							
							$betHolder[$desc]=$betId;
							$betId++;
						}
						else
						{
							$descPreg=preg_replace('/:.*/',"",$desc);
							$this->eventHolder[$g->getAttribute('id')]['betId']=$betHolder[$descPreg];
						}
					}
				}
		 
			}
		
			$alternatives=$g->getElementsByTagName('alternative');
			if($echoResult)
			{
				foreach($alternatives as $a)
				{
					$this->eventHolder[$g->getAttribute('id')]['odds'][]=array('odds'=>$a->getAttribute('odds'),'value'=>$a->nodeValue);
					//print_r("odds:".$a->getAttribute('odds')."  Pick".$a->nodeValue."<br/>");
				}
			}
			if($echoResult)
			{
				$description=$g->getElementsByTagName('description') ;
				foreach($description as $d)
				{
					$this->eventHolder[$g->getAttribute('id')]['description']=addslashes( str_replace($c->nodeValue,"",$d->nodeValue));
					//	print_r("Event".$d->nodeValue."<br/>");
				}
				$this->eventHolder[$g->getAttribute('id')]['date']= substr($g->getAttribute('date'),0,4)."-".substr($g->getAttribute('date'),4,2)."-".substr($g->getAttribute('date'),6,2)." ".substr($g->getAttribute('time'),0,2).":".substr($g->getAttribute('time'),2,2).":00";
				//print_r("Vrijeme:".$g->getAttribute('date')."<br/><br/><br/><br/>");
				if(!$this->checkEvent($this->eventHolder[$g->getAttribute('id')]['stringId'],$this->eventHolder[$g->getAttribute('id')]['type']))
				{
					unset($this->eventHolder[$g->getAttribute('id')]);
				}
			}
		}
		
		$betIsSet=array();
		foreach($this->eventHolder as $e)
		{
			$isBetExist=false;
			foreach($betIsSet as $b)
			{
				if($e['betId']==$b)
				{
					$isBetExist=true;
				}
			}
			if(!$isBetExist)
			{
				echo "insert into bets (bets_id, bet_name, groups_id_FK, add_date, end_date,  bet_active)values(".$e['betId'].",'".$e['description']."',".$this->checkGroup($e['stringId']).",now(),'".$e['date']."',now());<br/>";
				$betIsSet[]=$e['betId'];
			}	
		 
			echo "insert into event_bets (event_bets_id, bets_id_FK, event_id_FK, event_bets_name, score, correctType) values(null,".$e['betId'].",".$e['type'].",'".$e['description']."',  null,null) ;<br/>";
			echo "SET @firstLastInsertId=LAST_INSERT_ID();<br/>";
			if(isset($e['odds']))
			{
				foreach($e['odds'] as $odds)
				{
					echo "insert into bets_type (bet_types_id, event_bets_id_FK, name, date_created, teams_has_bets_id_FK) values(null, @firstLastInsertId, '".$odds['value']."', now(), null);<br/>";
					echo "insert into odd_value (odd_value_id, odd_value, bet_types_id_FK, data_created) values(null, '".$odds['odds']."', LAST_INSERT_ID(), now());<br/>";
				}
			}
		 
			$betHolder[]=$e['betId'];
				echo "<pre>";
				//	var_dump($e);
				echo "</pre>";
		}
		
		echo "<br/><br/><br/>";
		echo "update groups set active=0;";
		echo "<br/><br/>";
		foreach($this->activeGroup as $key=>$a)
		{
			echo "update groups set active ='".$a."' where groups_id=".$key.";<br />";
		}
	}
		
		//bet types mapped to database
		//if not exist will not create query for them.
	public function soccerManage($name)
	{
		$var=false;
		switch ($name)
		{
			case 0:
			$var=true;
			break;
			case 80:
			$var=true;
			break;
			case 81:
			$var=true;
			break;
			case 82:
			$var=true;
			break;
			
			/*  case 15:
			 $var=true;
			 break;*/
			case 20:
			$var=true;
			break;
			case 25:
			$var=true;
			break;
		}
		return $var;
	}
		
	public function checkEvent($id,$name)
	{
		if(array_key_exists($id,$this->codesArray))
		{
			return $this->soccerManage($name);
		}
	}
		
	public function checkGroup($group)
	{
		if(array_key_exists($group,$this->codesArray))
		{
			$this->activeGroup[$this->codesArray[$group]]="1";
			return $this->codesArray[$group];
		}
		return false;
	}
	 
	function get_web_page( $url )
	{
	$options = array(
	CURLOPT_RETURNTRANSFER => true,     // return web page
	CURLOPT_HEADER         => false,    // don't return headers
	CURLOPT_FOLLOWLOCATION => true,     // follow redirects
	CURLOPT_ENCODING       => "",       // handle compressed
	CURLOPT_USERAGENT      => "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)", // who am i
	CURLOPT_AUTOREFERER    => true,     // set referer on redirect
	CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
	CURLOPT_TIMEOUT        => 120,      // timeout on response
	CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
	);
	
	$ch      = curl_init( $url );
	curl_setopt_array( $ch, $options );
	$content = curl_exec( $ch );
	$err     = curl_errno( $ch );
	$errmsg  = curl_error( $ch );
	$header  = curl_getinfo( $ch );
	curl_close( $ch );
	
	$header['errno']   = $err;
	$header['errmsg']  = $errmsg;
	$header['content'] = $content;
	return $header;
	}
}