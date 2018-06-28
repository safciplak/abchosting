<?php

class CartController extends BaseController
{


    /**
     * Get all cart items
     */
    public function index()
    {

        $cart = new Cart();
//        session_destroy();
        $cartProducts = $_SESSION['productId'];

        $productIds = array_keys($cartProducts);

        $items = $cart->getCartItems('products', $productIds);

        $subTotal = 0;
        foreach ($items as $itemKey => $item)
        {
            foreach ($cartProducts as $cartProductId => $cartProduct)
            {
                if ($item['id'] == $cartProductId)
                {
                    $items[$itemKey]['quantity'] = $cartProduct;
                    $items[$itemKey]['quantity_price'] = $item['price'] * $cartProduct;
                    $subTotal += $item['price'] * $cartProduct;;
                }
            }
        }

        $_SESSION['items'] = $items;
        $_SESSION['subTotal'] = $subTotal;

        $cart->getUserBalance();

        $this->getView('cart', $items);
    }

    /**
     * Add to cart
     */
    public function add()
    {
        $quantity = $_GET['quantity'];
        $productId = $_GET['productId'];

        if ($quantity != null && $productId != null)
        {
            $_SESSION['productId'][$productId] = $quantity;
        }


        echo json_encode($_SESSION);
    }

    /**
     * Add Cargo price to total price
     */
    public function cargo()
    {
        if($_GET['cargoPrice'] != 'null'){
            $total = $_SESSION['subTotal'] + $_GET['cargoPrice'];
            echo json_encode(['cargoPrice' => $_GET['cargoPrice'], 'total' => getPrice($total)]);
        }
    }

    /**
     * Checkout Process
     */
    public function checkout()
    {
        $total = $_POST['total'];
        $products = $_SESSION['items'];


        $cart = new Cart();
        $cart->getUserBalance();
        $error = 0;
        if ($_SESSION['userBalance'] > $total){

            $cart->update('users', $total);

            $users = $cart->get('users', null, 'id', 1);

            foreach($users as $user){
                $userBalance = $user['balance'];
            }
        } else {
            $error = 1;
        }




        include "checkoutview.php";
    }
}