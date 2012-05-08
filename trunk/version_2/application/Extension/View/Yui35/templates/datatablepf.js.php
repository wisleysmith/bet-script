<?php
echo $this->getTable()->getId()?>.plug( Y.Plugin.DataTablePFPlugin,
	{ 
		paginator:<?php echo $this->getPaginator()->getId()?>,
		elementNamespace:'<?php echo $this->getModelName()?>',
		urls:'<?php echo json_encode($this->getUrls())?>',
		filterForm:'<?php echo $this->getHtmlIds('filters_form') ?>'
	}
);
 
 
<?php echo $this->getPaginator()->getId();?>.on('changeRequest', function(state)
{  
	this.setPage(state.page, true);  
	this.setRowsPerPage(state.rowsPerPage, true);
	Y.one('<?php echo $this->getHtmlIds('limitStart',true) ?>').setAttribute('value',(state.page-1)*state.rowsPerPage); 
	Y.one('<?php echo $this->getHtmlIds('limitEnd',true) ?>').setAttribute('value',state.rowsPerPage); 
	<?php echo $this->getTable()->getId()?>.datagridpf.filter('<?php echo $this->getHtmlIds('filters_form') ?>');
	 
});

Y.one('<?php echo $this->getHtmlIds('limitStart',true) ?>').setAttribute('value',0); 
Y.one('<?php echo $this->getHtmlIds('limitEnd',true) ?>').setAttribute('value',<?php echo $this->getPaginator()->getId();?>.getRowsPerPage()); 
 
<?php 
$filters = $this->getFilters();
$filtersSize = sizeof($filters); 
 
if($filtersSize>0&&$this->isFilterButtonEnabled()===true)
	{ 
	?>
	 
	Y.one('<?php echo $this->getHtmlIds('filterButton',true) ?>').on('click',
		function()
		{ 
			<?php echo $this->getTable()->getId()?>.datagridpf.filter('<?php echo $this->getHtmlIds('filters_form') ?>');
		} 
	) 
	<?php 
} 
	?> 
