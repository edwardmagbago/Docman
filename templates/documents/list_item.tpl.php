<?php
/**
 * @version		$Id: list_item.tpl.php 1080 2009-12-15 14:02:55Z tom $
 * @category	DOCman
 * @package		DOCman15
 * @copyright	Copyright (C) 2003 - 2009 Johan Janssens and Mathias Verraes. All rights reserved.
 * @license	    This file can not be redistributed without the written consent of the 
 				original copyright holder. This file is not licensed under the GPL. 
 * @link     	http://www.joomladocman.org
 */
defined('_JEXEC') or die('Restricted access');


/*
* Display a documents list item (called by document/list.tpl.php)
*
* This template is called when u user preform browse the docman
*
* General variables  :
*	$this->theme->path (string) : template path
* 	$this->theme->name (string) : template name
* 	$this->theme->conf (object) : template configuartion parameters
*	$this->theme->icon (string) : template icon path
*   $this->theme->png  (boolean): browser png transparency support


* Template variables :
*   $this->doc->data  (object) : holds the document data
*   $this->doc->links (object) : holds the document operations
*   $this->doc->paths (object) : holds the document paths
*/

// Check if item_title_link is set in themeConfig.php, new since 1.5.1
$item_title_link = isset($this->theme->conf->item_title_link) ? $this->theme->conf->item_title_link : '1'; ?>

<?php $path = $this->doc->data->dmthumbnail ? $this->doc->paths->thumb : $this->doc->paths->icon; ?>

<div class="dm_row line">
	<div class="unit size9of10 details_wrapper">
		<div class="line">
			<?php
			if(!$this->doc->data->approved) {
				?><div class="dm_unapproved"><?php echo _DML_NOAPPROVED_DOWNLOAD; ?></div><?php
			} elseif(!$this->doc->data->published) {
				?><div class="dm_unpublished"><?php echo _DML_NOPUBLISHED_DOWNLOAD; ?></div><?php
			} elseif($this->doc->data->checked_out) {
			    ?><div class="dm_checked_out"><? echo _DML_NOTDOWN; ?></div><?php
			}?>
			<div class="unit size1of7">
				<div class="dm_icon"><img src="<?php echo $path; ?>" /></div>
				<div class="dm_file_size">
					<?php // output file size 
					if($this->theme->conf->item_filesize) : ?>
						<div>File Size:</div>
						<div>(<?php if ($this->doc->data->filesize == 'Link') { echo _DML_UNKNOWN; } else { echo $this->doc->data->filesize; } ?>)</div>
					<?php endif; ?>
				</div>
			</div>
			<div class="unit size6of7 lastUnit">
				<div class="details">
					<h3 class="dm_title">
					<?php
					// output title
					switch($item_title_link) :
					 	case 0 :  //no link
							echo $this->doc->data->dmname;
						break;

						case 1 :  // link to download, if download is allowed
							if(isset($this->doc->buttons['download'])) {
					            ?><a href="<?php echo $this->doc->buttons['download']->link;?>" title="<?php echo $this->doc->data->dmname; ?>">
									<?php echo $this->doc->data->dmname; ?>
								</a><?php
				       		} else {
				            	echo $this->doc->data->dmname;
				        	}
						break;

					 	case 2  :  // link to details
							?><a href="<?php echo $this->doc->data->permalink;?>" title="<?php echo $this->doc->data->dmname; ?>">
								<?php echo $this->doc->data->dmname; ?>
							</a><?php
					 	break;
					endswitch;
					?>
					</h3>
						<?php // output document date added
						if ( $this->theme->conf->item_date ) : ?>
					    	<span class="date_added">Date Added: <?php $this->plugin('dateformat', $this->doc->data->dmdate_published, _DML_TPL_DATEFORMAT_SHORT); ?></span>
						<?php endif; ?>
						<?php // output document date modified
						if ( $this->theme->conf->item_date_modified ) : ?>
					 		<span>Date Updated: <?php  $this->plugin('dateformat', $this->doc->data->dmlastupdateon , _DML_TPL_DATEFORMAT_SHORT); ?></span>
						<?php endif; ?>

					<?php
					//output document description
					if ( $this->theme->conf->item_description AND $this->doc->data->dmdescription ) :
						?>
						<div class="dm_description">
							<?php echo $this->doc->data->dmdescription;?>
						</div>
						<?php
					endif;

					//output document url
					if ( $this->theme->conf->item_homepage && $this->doc->data->dmurl != '') :
						?>
					 	<div class="dm_homepage">
							<?php echo _DML_TPL_HOMEPAGE;?>: <a href="<?php echo $this->doc->data->dmurl;?>"><?php echo $this->doc->data->dmurl;?></a>
						</div>
						<?php
					endif;
					?>
					<div class="dm_taskbar clearfix">
					    <ul>
					    	<?php include $this->loadTemplate('documents/tasks.tpl.php');  ?>
					    </ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="unit size1of7 lastUnit dm_download_count">
		<?php // output document counter
		if ( $this->theme->conf->item_downloads  ) : ?>
			<div class="docs_additional_info"><span><?php echo $this->doc->data->dmcounter;?></span></div>
		<?php endif; ?>
	</div>
</div>