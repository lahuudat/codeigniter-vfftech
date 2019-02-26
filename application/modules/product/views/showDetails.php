		<div class="col-md-9">
			<div>
				<ol class="breadcrumb">
					<li><a href="#">Home</a></li>
					<li class="active">Product Ditails</li>
				</ol>
			</div>
			<?php foreach ($products as $product ) {
                ?>
			<div class="row">
				<div class="col-md-6">
					<img style="width: 100%; " src="<?php echo base_url(); ?>images/product/<?php echo $product->image; ?>" alt="" />
				</div>
				<div class="col-md-6">
					<h4><?php echo $product->product_name; ?></h4>
					<p>Author: <a href="#"><?php echo $product->author_name; ?></a></p>
					<p>Category: <a href="#"><?php echo $product->category_name; ?></a></p>
					<p>Publishing: <?php echo $product->publishing; ?> </p>
					<p>Publisher: <?php echo $product->publisher; ?> </p>
					<p>price: <span><?php echo $product->price; ?></span></p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<p><?php echo $product->description; ?></p>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</div>