<?php if(isset($category['childs'])): ?>
	
	<li class="has-children">
		<input type="checkbox" name ="<?=$category['path']?>" id="<?=$category['path']?>">
		<label for="<?=$category['path']?>"><?=$category['title']?></label>
	    <ul>
	    	<?=$this->getMenuHtml($category['childs']) ?>
		</ul>
	</li>
<?php endif; ?>


<?php if(!isset($category['childs'])): ?>
	<li><a href="#"><?=$category['title']?></a></li>
<?php endif; ?>

