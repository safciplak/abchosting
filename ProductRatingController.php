<?php


class ProductController extends BaseController
{


    public function index()
	{
		$product = new Product();

//		$product->insert('product_ratings', ['product_id', 'rating'], [1,4]);

		foreach($product->get('products', 'product_ratings', 'id', 'product_id') as $item){
//		    echo($item['name']. " - " . number_format($item['price'])) . "<br>";
        }

        $item = $product->get('products', 'product_ratings', 'id', 'product_id');

		$this->getView('product', $item);


	}
}