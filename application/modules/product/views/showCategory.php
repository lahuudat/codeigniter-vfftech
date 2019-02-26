
                
                <div class="row">

                <?php foreach ($products as $product ) {
                ?>

                    <div class="col-md-4 text-center col-sm-6 col-xs-6">
                        <div class="thumbnail product-box">
                            <img src="<?php echo base_url(); ?>images/product/<?php echo $product->image; ?>" alt="" />
                            <div class="caption">
                                <h3><a href="<?php echo site_url("product/productController/productDetails/{$product->id_product}"); ?>"><?php echo $product->product_name; ?> </a></h3>
                                <p>Price : <strong>$ <?php echo $product->price; ?></strong>  </p>
                                <p><a href="#"><?php echo $product->author_name; ?> </a></p>
                                <p><?php echo $product->publisher; ?></p>
                                <p><a href="#" class="btn btn-success" role="button">Add To Cart</a> <a href="<?php echo site_url("product/productController/productDetails/{$product->id_product}"); ?>" class="btn btn-primary" role="button">See Details</a></p>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                <?php } ?>
                   
                </div>
                <!-- /.row -->
                <div class="row">
                    <ul class="pagination alg-right-pad">
                        <li><a href="#">&laquo;</a></li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#">&raquo;</a></li>
                    </ul>
                </div>
                <!-- /.row -->
            </div>
        </div>