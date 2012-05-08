<!-- 
override of default yui skin
 -->
 <style>
<!--
.yui3-skin-sam .yui3-datatable-cell, .yui3-skin-sam .yui3-datatable-header {
    border-left: 1px solid #CBCBCB;
    border-width: 0 0 0 1px;
    font-size: inherit;
    margin: 0;
    overflow: visible;
    padding: 4px 5px;
}
-->
</style>

<div class="fullWidthTable"  >
	<div class="innerTable">
	<p class="tableHeader" >
	Teams: 
	</p>  
		<?php echo $this->getUsersTablePanel();?>
	</div>
</div>