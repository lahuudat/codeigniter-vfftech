    
                <div>
                    <ol class="breadcrumb">
                        <li class="active">author's product</li>
                    </ol>
                </div>
                <!-- /.div -->
                
                <div class="row">

                    <?php foreach ($authorProduct as $authorProduct ) {
                ?>

                    <div class="col-md-4 text-center col-sm-6 col-xs-6">
                        <div class="thumbnail product-box">
                            <img src="<?php echo base_url(); ?>images/product/<?php echo $authorProduct->image; ?>" alt="" />
                            <div class="caption">
                                <h3><a href="<?php echo site_url("product/productController/productDetails/{$authorProduct->id_product}"); ?>"><?php echo $authorProduct->product_name; ?> </a></h3>
                                <p>Price : <strong>$ <?php echo $authorProduct->price; ?></strong>  </p>
                                <p><a href="<?php echo site_url("author/AuthorController/index/{$authorProduct->id_author}"); ?>"><?php echo $authorProduct->author_name; ?> </a></p>
                                <p><?php echo $authorProduct->publisher; ?></p>
                                <p><a href="#" class="btn btn-success" role="button">Add To Cart</a> <a href="<?php echo site_url("product/productController/productDetails/{$authorProduct->id_product}"); ?>" class="btn btn-primary" role="button">See Details</a></p>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                <?php } ?>             
                </div>
                <!-- /.row -->
                
            </div>
        </div>
    </div>
        
                