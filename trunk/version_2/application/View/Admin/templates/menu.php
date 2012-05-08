<div id="<?php echo $this->getId()?>" class="yui3-menu yui3-menu-horizontal"><!-- Bounding box -->
    <div class="yui3-menu-content"><!-- Content box -->
        <ul>
            <?php 
            	foreach ($this->getLinks() as $l)
            	{
            		?>
            		<li><a <?php 
            		 
            		foreach ($l['attributes'] as $key=>$lInner)
            		{
            			echo $key.'="'.$lInner;
            		} 
          				?>><?php echo $l['content']?></a></li>
            <?php 		 	
            	}
            ?>
        </ul>
    </div>
</div>