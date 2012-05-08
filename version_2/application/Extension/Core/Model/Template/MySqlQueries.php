<?php
 
class Extension_Core_Model_Template_MySqlQueries extends Core_Model_Template_Queries
{  
	public function __construct()
	{    
		$this->templateQueries['select'] = array('query'=>'SELECT [@select_expr] FROM [@table] ', 'default'=>array('select_expr'=>'*'));
		$this->templateQueries['where'] = array('query'=>'WHERE ([@where_condition])');  
		$this->templateQueries['update'] = array('query'=>'UPDATE [@table] SET [@columns]'); 
		$this->templateQueries['delete'] = array('query'=>'DELETE FROM [@table] ') ; 
		$this->templateQueries['insert'] = array('query'=>'INSERT INTO [@table] [@values]') ; 
		$this->templateQueries['string'] = array('query'=>'[@string]');  
    	$this->templateQueries['limit'] = array('query'=>'LIMIT [@limit]');   
    	$this->templateQueries['leftJoin'] = array('query'=>'left join [@table] on [@condition]');  
    	$this->templateQueries['order'] = array('query'=>'order by [@order]');   
		parent::__construct();
	} 
	
	/**
	 * 
	 * if multiple where is set create just one in place of first where
	 */
	public function onWhere($e)
	{  
		$whereConditionData = "";
		$and = '';
		$sqlObject = $e['currentTarget']['params']['sqlObject'];
		$queriesArray = $sqlObject->getQueryHolder();
		
		$isWhereSet = false;
		$currentWhereQuery = '';
		$and='';
		$numberOfWhere = 0;
		foreach ($queriesArray as &$q)
		{
			if($q['template']=='where')
			{	
				$numberOfWhere = $numberOfWhere + 1;
			}
		}
		//if only one where its ok.
		if($numberOfWhere==1)
		{
			return;
		}
		
		foreach ($queriesArray as &$q)
		{
			if($q['template']=='where')
			{	
				if($isWhereSet)
				{
					$q=null;
					continue;
				}
				else 
				{
					foreach ($queriesArray as &$qInner)
					{
						if($qInner['template']=='where')
						{	 
							$currentWhereQuery.=$and.' ( '.$qInner['values']['where_condition'].' ) ';
							$q['values'] = array('where_condition'=>$currentWhereQuery);
							$and=' AND ';
						}
					}
					$isWhereSet = true;
				} 
			}
		}; 
		$sqlObject->setQueryHolder($queriesArray);
	} 
} 