<ul class="slides">   
	<?php if ( (count($this->images)>1) || (count($this->videos) && count($this->images)) ) {?>
		<?php foreach($this->images as $k=>$image){ ?>
			<?php if(count($this->images) < 5) {
				print '<img class="jshop_img_thumb span3" src="' . $this->image_product_path.'/'. $image->image_thumb .'" alt="' . htmlspecialchars($image->_title) .'" title="' . htmlspecialchars($image->_title).'" onclick="showImage(' . $image->image_id.')" />';
			} else { ?>
				<?php if($k%4 == 0 ){
					print '<div class="row-fluid">';
					$k = 0;								
				}?>
				<img class="jshop_img_thumb span3" src="<?php print $this->image_product_path?>/<?php print $image->image_thumb?>" alt="<?php print htmlspecialchars($image->_title)?>" title="<?php print htmlspecialchars($image->_title)?>" onclick="showImage(<?php print $image->image_id?>)" />
				<?php if ($k%4== 3){
					print '</div>';
				} ?>
			<?php } ?>
			
		<?php }?>
		<?php if ($k%(count($this->images)-1)!=count($this->images)-2 && count($this->images) > 4) print "</div>";?>
	<?php }?>
</ul>
