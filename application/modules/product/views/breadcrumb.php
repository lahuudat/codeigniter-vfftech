
            <div class="col-md-9">
                <div>
                    <ol class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <!-- <li class="active">Category</li> -->
                        <?php foreach ($catName as $catNames ) {
                		?>
                		<li class="active"><?php echo $catNames->category_name; ?></li>
                		<?php } ?>
                    </ol>
                </div>
                <!-- /.div -->