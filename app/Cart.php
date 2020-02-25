<?php

namespace App;



class Cart 
{
	public $groupItems = Null;
	public $totalPrice =0 ;
	public $totalQty =0;

	public function __construct($oldCart){

		if ($oldCart) {
			 
			 $this->groupItems = $oldCart->groupItems;
			 $this->totalPrice = $oldCart->totalPrice;
			 $this->totalQty = $oldCart->totalQty;
		}
	}
	public function add($products,$qty){

		$storeItems =['qty' =>0 , 'price' => $products->price, 'items' => $products];
			if ($this->groupItems) {
				if (array_key_exists($products->id, $this->groupItems)) {
					$storeItems = $this->groupItems;
				}
			}
		$storeItems['qty'] = $qty;
		$storeItems['price'] = $products->price * $storeItems['qty'];
		$this->totalQty++;
		$this->totalPrice += $products->price * $storeItems['qty'];
		$this->groupItems[$products->id] = $storeItems;
	}
	public function delete($product){
		if($this->groupItems){
			$this->groupItems[$product->id]['qty']--;
			$this->groupItems[$product->id]['price']--;
			$this->totalPrice -= $this->groupItems[$product->id]['price'];
			$this->totalQty--;
			unset($this->groupItems[$product->id]);
		}
	}
}
