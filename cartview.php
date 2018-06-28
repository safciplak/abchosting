<?php include "header.php"; ?>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-10 col-md-offset-1">
                <form action="<?php echo $this->getWithBasePath('/cart/checkout') ;?>" method="POST" id="checkoutForm">
                    <input type="hidden" name="total" id="totalHidden" value="<?php echo $_SESSION['subTotal']; ?>" />
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Total</th>
<!--                            <th> </th>-->
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($datas as $item) { ?>
                            <tr>
                                <td class="col-sm-8 col-md-6">
                                    <div class="media">
                                        <a class="thumbnail pull-left" href="#"> <img class="media-object"
                                                                                      src="<?php echo getImage($item['image']);?>"
                                                                                      style="width: 72px; height: 72px;">
                                        </a>
                                        <div class="media-body">
                                            <h4 class="media-heading"><a href="#"><?php echo $item['name']; ?></a></h4>
                                            <h5 class="media-heading"> by <a href="#">Brand name</a></h5>
                                            <span>Status: </span><span
                                                    class="text-success"><strong>In Stock</strong></span>
                                        </div>
                                    </div>
                                </td>
                                <td class="col-sm-1 col-md-1" style="text-align: center">
                                    <input type="email" class="form-control" id="exampleInputEmail1"
                                           value="<?php echo $item['quantity']; ?>">
                                </td>
                                <td class="col-sm-1 col-md-1 text-center">
                                    <strong>$<?php echo getPrice($item['price']); ?></strong></td>
                                <td class="col-sm-1 col-md-1 text-center">
                                    <strong>$<?php echo getPrice($item['quantity_price']); ?></strong></td>
                                <td class="col-sm-1 col-md-1">
                                    <button type="button" class="btn btn-danger remove-cart-item" data-id="<?php echo $item['id']; ?>" data-url="<?php echo $this->getWithBasePath('/cart/removeCartItem'); ?>">
                                        <span class="glyphicon glyphicon-remove"></span> Remove
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>

                        <tr>
                            <td>  </td>
                            <td>  </td>
                            <td>  </td>
                            <td><h5>Subtotal</h5></td>
                            <td class="text-right"><h5><strong>$<?php echo $_SESSION['subTotal']; ?></strong></h5></td>
                        </tr>
                        <tr>
                            <td>  </td>
                            <td>  </td>
                            <td>  </td>
                            <td><h5>Estimated shipping</h5>

                                <div class="form-group">
                                    <select class="form-control" id="selectCargo" name="selectCargo"
                                            data-url="<?php echo $this->getWithBasePath('/cart/cargo'); ?>" required>
                                        <option value="null">Select</option>
                                        <option value="0">Pick up</option>
                                        <option value="5">UPS</option>
                                    </select>
                                </div>
                            </td>
                            <td class="text-right"><h5><strong>$<span id="cargoPrice">0.00</span></strong></h5></td>
                        </tr>
                        <tr>
                            <td>  </td>
                            <td>  </td>
                            <td>  </td>
                            <td><h3>Total</h3></td>
                            <td class="text-right"><h3><strong>$<span
                                                id="total"><?php echo getPrice($_SESSION['subTotal']); ?></span></strong></h3>
                            </td>
                        </tr>
                        <tr>
                            <td>  </td>
                            <td>  </td>
                            <td>  </td>
                            <td>
                                <a href="<?php echo $this->getWithBasePath('/product/index'); ?>"
                                   class="btn btn-default">
                                    <span class="glyphicon glyphicon-shopping-cart"></span> Continue Shopping
                                </a></td>
                            <td>
                                <button type="button" class="btn btn-success checkout-button">
                                    Checkout <span class="glyphicon glyphicon-play"></span>
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
<?php include "footer.php"; ?>