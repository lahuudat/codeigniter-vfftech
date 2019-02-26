<div>
    <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="active">Sách văn học</li>
    </ol>
</div>
<!-- /.div -->

<div class="row">

    <?php foreach ($productCat as $proCat ) {
        ?>

        <div class="col-md-4 text-center col-sm-6 col-xs-6">
            <div class="thumbnail product-box">
             <img src="<?php echo base_url(); ?>images/product/<?php echo $proCat->image; ?>" alt="" />
             <div class="caption">
                <h3><a href="#"><?php echo $proCat->product_name; ?> </a></h3>
                <p>Price : <strong>$ <?php echo $proCat->price; ?></strong>  </p>
                <p><a href="#"><?php echo $proCat->author_name; ?> </a></p>
                <p><?php echo $proCat->publisher; ?></p>
                <p><a href="#" class="btn btn-success" role="button">Add To Cart</a> <a href="#" class="btn btn-primary" role="button">See Details</a></p>
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
<!-- /.col -->
</div>
<!-- /.row -->
</div>
<!-- /.container -->
