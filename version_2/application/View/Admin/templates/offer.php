<div class="fullWidthTable"  >
	<div class="innerTable">
	 
		<?php echo $this->getEventListWidget();?>
	</div>
</div> 

<?php 
foreach ($this->getOfferList() as $o)
{
?>
<div class="fullWidthTable"  >
	<div class="innerTable"> 
		<?php echo $o;?>
	</div>
</div> 
<?php 
}
?>
  