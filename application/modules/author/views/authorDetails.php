            
            <div class="col-md-9">
                <div>
                    <ol class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li class="active">Author</li>
                    </ol>
                </div>
                <!-- /.div -->
                
                <div class="row">

                    <?php foreach ($author as $author ) {
                    ?>

                    <div style="padding-left: 30px" class="col-md-12">
                        <h4><?php echo $author->name; ?></h4>
                        <p>
                            <?php echo $author->information; ?>
                        </p>                    
                    </div>    
                    <?php } ?>               
                </div>
                <!-- /.row -->
                
            
                