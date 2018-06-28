<?php include "header.php"; ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <?php foreach ($datas as $data) { ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            <a href="#"><img class="card-img-top" src="<?php echo '/images/'.$data['image'] ;?>" alt=""></a>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="#"><?php echo $data['name']; ?></a>
                                </h4>
                                <h5>$<?php echo getPrice($data['price']); ?></h5>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet
                                    numquam aspernatur!</p>
                            </div>
                            <div class="count-input space-bottom">
                                <a class="incr-btn" data-action="decrease" href="#">–</a>
                                <input class="quantity" type="number" name="quantity" value="1"
                                       id="quantity_<?php echo $data['id']; ?>"/>
                                <a class="incr-btn" data-action="increase" href="#">&plus;</a>
                            </div>
                            <a href="javascript:void(0);" class="btn btn-info btn-lg addToCart"
                               data-id="<?php echo $data['id']; ?>"
                               data-url="<?php echo $this->getWithBasePath('/cart/add') ?>">
                                <span class="glyphicon glyphicon-shopping-cart"></span> Add To Cart
                            </a>


                            <div class="card-footer">
                                <small class="text-muted">
                                    <?php $data['rate'] = isset($data['rate']) ? $data['rate'] : 0; ?>
                                    <?php if ($data['rate'] != 0) { ?>
                                        <?php for ($i = 1; $i <= ceil($data['rate']); $i++) { ?>
                                            &#9733;
                                        <?php } ?>
                                    <?php } ?>

                                    <?php for ($i = 0; $i < 5 - ceil($data['rate']); $i++) { ?>
                                        &#9734;
                                    <?php } ?>
                                </small>
                            </div>


                            <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css"
                                  rel="stylesheet" id="bootstrap-css">
                            <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
                            <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
                            <!------ Include the above in your HEAD tag ---------->

                            <div class="marginLeft50">


                                <h3>Rating</h3>
                                <div class="row lead evaluation">
                                    <div id="colorstar" class="starrr ratable starrr<?php echo $data['id']; ?>"
                                         data-id="<?php echo $data['id']; ?>" data-rate=""
                                         data-url="<?php echo $this->getWithBasePath('/product/rate') ?>"></div>
                                    <span id="count" class="starrrcount<?php echo $data['id']; ?>">0</span> star(s) -
                                    <span id="meaning"> </span>
                                    <div class='indicators' style="display:none">
                                        <div id='textwr'>What went wrong?</div>
                                        <input id="rate[]" name="rate[]" type="text" placeholder=""
                                               class="form-control input-md" style="display:none;">
                                        <input id="rating[]" name="rating[]" type="text" placeholder=""
                                               class="form-control input-md rateval" style="display:none;">

                                    </div>


                                </div>

                            </div>


                            </section>


                        </div>
                    </div>
                <?php } ?>


            </div>
            <!-- /.row -->

        </div>
        <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

<?php include "footer.php" ?>