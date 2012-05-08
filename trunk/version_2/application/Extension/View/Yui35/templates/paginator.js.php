var <?php echo $this->getId();?> = new Y.Paginator(
{
	   <?php echo $this->getJSWidgetContructorJson(); ?>  
});

<?php echo $this->getId();?>.render('<?php echo $this->getHtmlElementId(true)?>');

