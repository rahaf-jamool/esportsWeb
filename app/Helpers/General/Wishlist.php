<?php

    namespace App\Helpers\General;

    class Wishlist {
        public $items = [];
        public $totalQty = 0;   // total Quantity

        public function __construct($oldWishlist = null)
        {
            // dump($oldWishlist);
            if($oldWishlist) {
                $this->items = $oldWishlist->items;
                $this->totalQty = $oldWishlist->totalQty;
            } else {
                $this->items = [];
                $this->totalQty = 0;
            }
        }


        // add new item to cart
        public function add($item, $id)
        {
            $image = !empty($item->attachments->first()->Path) ? config('app.base_address') . $item->attachments->first()->Path : asset('assets/img/logo.png');

            // Product offer
            if ($item->offers->isNotEmpty()) {
                $priceOfferValue = ($item->offers->first()->DiscountRatio / 100) * $item->SellPrice;
                $price = $item->SellPrice - $priceOfferValue;
            } else {
                $price = $item->SellPrice;
            }

            $storedItem = [
                'id' => $id,
                'qty' => 0,
                'price' => $price,
                'item' => $item,
                'photo' => $image
            ];

            // check if this stored item inside the cart is the same item we currently add
            if ( !array_key_exists($id, $this->items) ) {
                $this->items[$id] = $storedItem;
                $this->totalQty += 1;   // increase the qunatity by one every time we add new item to cart
            }
        }

        // Remove Item From Cart
        public function remove($id)
        {
            // check if this stored item inside the cart is the same item we currently add
            if ( array_key_exists($id, $this->items ) ) {
                // dd($this->items[$id]);
                // descrease the quantity of the items inside the cart
                $this->totalQty -= 1;
                // delete the item it self from the 'items' array (from cart)
                unset($this->items[$id]);
            }
        }

    }
