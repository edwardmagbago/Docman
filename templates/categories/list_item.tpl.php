<?php
/**
 * @version		$Id: list_item.tpl.php 1010 2009-12-04 17:07:02Z tom $
 * @category	DOCman
 * @package		DOCman15
 * @copyright	Copyright (C) 2003 - 2009 Johan Janssens and Mathias Verraes. All rights reserved.
 * @license	    This file can not be redistributed without the written consent of the 
 				original copyright holder. This file is not licensed under the GPL. 
 * @link     	http://www.joomladocman.org
 */
defined('_JEXEC') or die('Restricted access');


/*
* Display a category list item (called by categories/list.tpl.php)
*
* General variables  :
*	$this->theme->path (string) : template path
* 	$this->theme->name (string) : template name
* 	$this->theme->conf (object) : template configuartion parameters
*	$this->theme->icon (string) : template icon path
*   $this->theme->png  (boolean): browser png transparency support
*
* Template variables :
*	$item->data		(object) : holds the category data
*  $item->links 	(object) : holds the category operations
*  $item->paths 	(object) : holds the category paths
*/

?>

<?php $path = $item->data->image ? $item->paths->thumb : $item->paths->icon; ?>

<div class="dm_row line">
	<div class="unit size1of10">
		<div class="dm_cat_icon">
			<?php // output category icon/thumb
			if($this->theme->conf->cat_image) : ?>
				<a href="<?php echo $item->links->view;?>">
					<img src="<?php echo $path;?>" alt="<?php echo $item->data->name; ?>" />
				</a>
			<?php endif; ?>
			</div>
		<div class="dm_cat_files_count">
		<?php // output files inside category
			if ( $this->theme->conf->cat_files ) : ?>	
				<small>( <?php echo $item->data->files;?> <?php echo _DML_TPL_FILES; ?> )</small>
			<?php endif; ?>
		</div>
	</div>
	<div class="unit size9of10 lastUnit">
		<h3 class="dm_title">
			<a href="<?php echo $item->links->view;?>">
				<?php // output category name 
				echo $item->data->name; ?>
			</a>
		</h3>
	    <?php
	    if($item->data->description) :
	        ?><div class="dm_description"><?php echo $item->data->description;?></div><?php
	    endif;
	    ?>
	</div>
</div>