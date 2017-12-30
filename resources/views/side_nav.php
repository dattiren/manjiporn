<?php 
$Myclass = new App\MyLibs\MyClass;

$allCategories = $Myclass->getCategories();
?>
<div class="container-side">
			<nav class="contaier-side-category">
				<h1><i class="fa fa-bed" aria-hidden="true"></i>CATEGORY</h1>
				<ul class="contaier-side-category-list">
					<?php foreach($allCategories as $category):?>
						<?php if(isset($category_id)):?>
						<li>
							<i class="fa fa-square-o" <?php echo $category_id == $category->id ? 'id="selected_mark"' : '';?> aria-hidden="true"></i>
							<a href="/category?category_id=<?php echo $category->id;?>" <?php echo $category_id == $category->id ? 'id="selected_char"' : '';?> ><?php echo $category->name;?></a>
						</li>
						<?php else:?>
						<li>
							<i class="fa fa-square-o" aria-hidden="true"></i>
							<a href="/category?category_id=<?php echo $category->id;?>"><?php echo $category->name;?></a>
						</li>
						<?php endif;?>
					<?php endforeach; ?>
				</ul>
			</nav>
			<div class="contaier-side-adsence">ad</div>
			<div class="contaier-side-adsence">ad</div>
		</div>