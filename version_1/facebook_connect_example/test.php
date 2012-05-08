<?php
/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */
require_once('facebook-platform/facebook-platform/php/facebook.php');
$facebook = new Facebook("","");
echo "<pre>Debug:" . print_r($facebook,true) . "</pre>";
?>