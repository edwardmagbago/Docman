<?php
/**
 * @version		$Id: list.tpl.php 1010 2009-12-04 17:07:02Z tom $
 * @category	DOCman
 * @package		DOCman15
 * @copyright	Copyright (C) 2003 - 2009 Johan Janssens and Mathias Verraes. All rights reserved.
 * @license	    This file can not be redistributed without the written consent of the 
 				original copyright holder. This file is not licensed under the GPL. 
 * @link     	http://www.joomladocman.org
 */
defined('_JEXEC') or die('Restricted access');


/*
* Display the documents list (required)
*
* General variables  :
*	$this->theme->path (string) : template path
* 	$this->theme->name (string) : template name
* 	$this->theme->conf (object) : template configuartion parameters
*	$this->theme->icon (string) : template icon path
*   $this->theme->png  (boolean): browser png transparency support
*
* Template variables :
*	$this->items (array)  : holds an array of dcoument items
*	$this->order (object) : holds the document list order information
*/
?>

<?php if(count($this->items)) { ?>
    <?php include $this->loadTemplate('documents/list_order.tpl.php'); ?>
    <div id="dm_docs">
		<div class="docs_heading line">
			<div class="unit size9of10"><div class="details">&nbsp;</div></div>
			<div class="unit size1of7 lastUnit">
				<div class="docs_additional_info"><span>Downloads</span></div>
			</div>
		</div>
    <?php
    /*
     * Include the documents list ordering template
    */
    ?>
    <?php /*<dl >*/?>
    <?php
        /*
         * Include the list_item template and pass the item to it
        */
    	foreach($this->items as $item) :
    		$this->doc = &$item; //add item to template variables
    		include $this->loadTemplate('documents/list_item.tpl.php');
    	endforeach;
    ?>
    <?php /*</dl >*/?>
    </div>
<?php } else { ?>
    <br />
    <div id="dm_docs">
        <i><?php echo _DML_TPL_NO_DOCS ?></i>
    </div>
<?php } ?>