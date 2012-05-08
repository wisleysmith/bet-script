<?php
class Extension_View_Yui35_Paginator extends Extension_Core_View_Yui_Template
{
	public function __construct($elementName = 'default_paginator')
	{
		$this->setId($elementName);  
		$this->setWidgetDependencies('gallery-paginator');
		$this->addConstructorOption('rowsPerPageOptions',array('20','50','100','200'),true);
		$this->addConstructorOption('template','{FirstPageLink} {PreviousPageLink} {PageLinks} {NextPageLink} {LastPageLink} <span class="rpp">Rows per page:</span> {RowsPerPageDropdown}',true);
		$this->addConstructorOption('firstPageLinkLabel','|&lt;',true);
		$this->addConstructorOption('previousPageLinkLabel','&lt;',true);
		$this->addConstructorOption('nextPageLinkLabel','&gt;',true);
		$this->addConstructorOption('lastPageLinkLabel','&gt;|',true);
		$this->setHtmlElementId('pg_'.$this->getId() );
		 
		/**
		totalRecords: 155,
		rowsPerPage: 10,
		template: '{FirstPageLink} {PreviousPageLink} {PageLinks} {NextPageLink} {LastPageLink} <span class="rpp">Rows per page:</span> {RowsPerPageDropdown}',
		rowsPerPageOptions:    [5,10],
		firstPageLinkLabel:    '|&lt;',
		previousPageLinkLabel: '&lt;',
		nextPageLinkLabel:     '&gt;',
		lastPageLinkLabel:     '&gt;|'
		*/
	} 
}
?>