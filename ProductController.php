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
        $item = $this->product->get('products', 'product_ratings', null, null, 'id', 'product_id');

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
        $rate = $_GET['rate'];

        $itemCount = $this->product->get('product_ratings', null, 'product_id', $productId);

        if($itemCount && count($itemCount) == 1){
            echo json_encode(['error' => 1]);
        } else {
            $this->product->insert('product_ratings', ['product_id', 'rating', 'user_id'], [$productId, $rate, 1]);
        }
    }
}