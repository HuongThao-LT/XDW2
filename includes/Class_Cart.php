<?php

class Cart {
    private $cartId;
    private $userId;
    private $cartLines;
    private $subTotal;
    private $total;
    private $shippingFee;

    public function __construct($cartId, $userId, $cartLines) 
    {
        $this->cartId = $cartId;
        $this->userId = $userId;
        $this->cartLines = $cartLines;
    }

    public function display()
    {
        $cart = $this;
        require_once('view/cart/cart.php');
    }

    public function displayLines()
    {
        $cartLines = $this->cartLines;
        $shippingFee = 5;
        $subTotal = 0;
        $total = 0;
        foreach ($cartLines as $key => $line) {
            $lineTotal = $line['quantity'] * $line['price'];
            $subTotal += $lineTotal;
            require('view/cart/cart_line.php');
        }

        if ($subTotal > 30) {
            $total = $subTotal + $shippingFee;
        } else {
            $shippingFee = 0;
            $total = $subTotal;
        }

        $this->subTotal = $subTotal;
        $this->shippingFee = $shippingFee;
        $this->total = $total;
    }

    public function getSubTotalView()
    {
        return '$' . $this->subTotal;
    }

    public function getTotalView()
    { 
        return '$' . $this->total;
    }

    public function getShippingFeeView()
    { 
        return '$' . $this->shippingFee;
    }

    public static function loadOrCreate()
    {
        if (Session::get('login_user')) {
            $user_id = Session::get('login_user_id');
            $cart = Database::table('carts')->where([['user_id', '=', $user_id]])->first();
            if (!$cart) {
                Database::table('carts')->insert([
                    'user_id' => $user_id
                ]);
                $cart = Database::table('carts')->where([['user_id', '=', $user_id]])->first();
            }

            $cartId = $cart['id'];
            $userId = $cart['user_id'];
            $cartLines = Database::table('cart_lines')->where([['cart_id', '=', $cart['id']]])->get();

            $cart = new Cart($cartId, $userId, $cartLines);
            return $cart;
        }
    }

    public function isEmpty()
    {
        return empty($this->cartLines);
    }

    public function addToCart($coffeeId, $quantity)
    {
        $coffee = Database::table('coffees')
            ->select(['coffees.*', 'coffee_brands.name as coffee_brand', 'coffee_types.name as coffee_type'])
            ->join('coffee_brands', 'coffees.brand', '=', 'coffee_brands.id')
            ->join('coffee_types', 'coffees.type', '=', 'coffee_types.id')
            ->where([['coffees.id', '=', $coffeeId]])
            ->first();
        if ($coffee) {
            $cartLine = Database::table('cart_lines')->where([
                ['cart_id', '=', $this->cartId], 
                ['coffee_id', '=', $coffeeId]
            ])->first();
            if ($cartLine) {
                $cartLineId = $cartLine['id'];
                $newQty = $cartLine['quantity'] + $quantity;
                Database::table('cart_lines')->where([['id', '=', $cartLineId]])->update(['quantity' => $newQty]);
            } else {
                $data = [
                    'cart_id' => $this->cartId,
                    'coffee_id' => $coffeeId, 
                    'quantity' => $quantity,
                    'price' => $coffee['price'], 
                    'coffee_name' => $coffee['name'], 
                    'coffee_brand' => $coffee['coffee_brand'],
                    'coffee_type' => $coffee['coffee_type']
                ];
                Database::table('cart_lines')->insert($data);
            }
        }

        $this->cartLines = Database::table('cart_lines')->where([['cart_id', '=', $this->cartId]])->get();
    }

    public function emptyCart()
    {
        Database::table('cart_lines')->where([['cart_id', '=', $this->cartId]])->delete();
        $this->cartLines = [];
    }

    public function updateCart($coffeeIdList)
    {
        foreach ($coffeeIdList as $key => $coffee) {
            $coffeeId = $coffee['id'];
            $line = Database::table('cart_lines')->where([
                ['coffee_id', '=', $coffeeId], 
                ['cart_id', '=', $this->cartId]
            ])->first();
            if ($line) {
                $lineId = $line['id'];
                $lineQty = $line['quantity'];
                $newQty = $coffee['qty'];
                if ($newQty == 0) {
                    Database::table('cart_lines')->where([['id', '=', $lineId]])->delete();
                } else {
                    if ($newQty != $lineQty) {
                        Database::table('cart_lines')
                            ->where([['id', '=', $lineId]])
                            ->update(['quantity' => $newQty]);
                    }
                }
            }
        }

        $this->cartLines = Database::table('cart_lines')->where([['cart_id', '=', $this->cartId]])->get();
    }

    public function removeProduct($coffeeId)
    {
        Database::table('cart_lines')->where([
            ['coffee_id', '=', $coffeeId], 
            ['cart_id', '=', $this->cartId]
        ])->delete();
        $this->cartLines = Database::table('cart_lines')->where([['cart_id', '=', $this->cartId]])->get();
    }

}