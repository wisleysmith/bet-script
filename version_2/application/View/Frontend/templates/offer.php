 
<div class="fullWidthTableFrontEnd"  style="padding:10px" >
	<div class="innerTable"> 
		<?php echo $this->getEventListWidget();?>
	</div>
</div> 

<?php 
foreach ($this->getOfferList() as $o)
{
?>
<div class="fullWidthTableFrontEnd"  >
	<div class="innerTable"> 
		<?php echo $o;?>
	</div>
</div> 
<?php 
}
?>