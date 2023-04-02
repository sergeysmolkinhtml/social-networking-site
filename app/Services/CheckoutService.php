<?php

namespace App\Services;

class CheckoutService
{
    private array $pricing_rules;
    public int $total = 0;

    public function __construct($pricing_rules)
    {
        $this->pricing_rules = $pricing_rules;
    }

    public function scan(string $item): void
    {
        $product = Product::where('product_code',$item)->first();
        if($product){
            Cart:create(['product_id' => $product->id]);
            $this->total = $this->getTotal();
        }
    }

    public function getTotal(): int
    {
        $cart_products = Cart::query()
            ->join('products','carts.product_id','=','products.id')
            ->selectRaw('products.product_code, product.price, sum(carts.qty) as quantity')
            ->groupByRaw('products.product_code,products.price')
            ->get();

        $total = 0;

        foreach ($cart_products as $product ) {
            $rule = $this->pricing_rules[$product->product_code] ?? NULL;
            if (!is_null($rule)) {
                $total += $this->{$rule[0]}($product, $rule[1], $rule[2]);
            } else {
                $total += $product->quantity * $product->price;
            }
        }

        return $total;
    }

    private function getOneFree($product,$rule1,$rule2)
    {
        $quantity = floor($product->quantity / 2) + $product->quantity % 2;
        return $quantity * $product->price;
    }

    private function bulkDiscount($product,$rule1,$rule2)
    {
        return $product->quantity * $product->price;
    }



}

