<?php


class ProductController extends BaseController
{
    private $product;

    /**
     * ProductController constructor.
     */
    public function __construct()
    {
        $this->product = new Product();
    }

    /**
     * Get products with ratings
     */
    public function index()
    {
        $item = $this->product->get('products');

        $ratings = $this->product->getRatings();

        foreach ($item as $itemKey => $itemValue) {
            if($ratings){
                foreach ($ratings as $rating) {
                    if ($rating['product_id'] == $itemValue['id']) {
                        $item[$itemKey]['rate'] = $rating['rate'];
                    }
                }
            }
        }

        $this->product->getUserBalance();

        $this->getView('product', $item);
    }

    /**
     * Rate a product
     */
    public function rate()
    {

        $productId = $_GET['productId'];
        $userId = $_SESSION['userId'];
        $rate = $_GET['rate'];

        $exist = $this->product->get('product_ratings', null, 'product_id', $productId, 'user_id', $userId);

        if($exist){
            echo json_encode(['error' => 1]);
        } else {
            $this->product->insert('product_ratings', ['product_id', 'rating', 'user_id'], [$productId, $rate, $userId]);
        }
    }
}