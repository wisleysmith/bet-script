var <?php echo $this->getId()?> = new Y.DataTable({<?php echo $this->getJSWidgetContructorJson(); ?>});
<?php echo $this->getId()?>.render('<?php echo $this->getHtmlElementId(true)?>');
 