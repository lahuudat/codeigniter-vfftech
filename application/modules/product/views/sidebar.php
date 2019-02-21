
    <div class="container">
       
        <div class="row">
            <div class="col-md-3">
                <div>
                    <a href="#" class="list-group-item active">Danh mục
                    </a>
                    <ul class="list-group">
                        <?php foreach ($cate as $ct ) {
                        ?>
                        <li class="list-group-item"><?php echo $ct->name; ?>
                            <span class="label label-success pull-right"><?php echo $ct->total; ?></span>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
                <!-- /.div -->

                <div class="well well-lg offer-box offer-colors">


                    <span class="glyphicon glyphicon-star-empty"></span>25 % off  , GRAB IT                 
              
                   <br />
                    <br />
                    <div class="progress progress-striped">
                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"
                            style="width: 70%">
                            <span class="sr-only">70% Complete (success)</span>
                            2hr 35 mins left
                        </div>
                    </div>
                    <a href="#">click here to know more </a>
                </div>
                <!-- /.div -->
            </div>
            <!-- /.col -->