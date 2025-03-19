<?php

namespace App\Services;

use App\Models\SanPham;

class CartService
{
    public function __construct()
    {
        if (!session()->has('cart')) {
            session()->put('cart', []);
        }
    }

    public function add($productId, $quantity = 1)
    {
        $product = SanPham::findOrFail($productId);
        $cart = session()->get('cart');

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'id' => $product->id,
                'slug' => $product->slug,
                'name' => $product->ten_san_pham,
                'price' => $product->gia,
                'quantity' => $quantity,
                'image' => $product->anh_dai_dien
            ];
        }

        session()->put('cart', $cart);
    }

    public function update($productId, $quantity)
    {
        $cart = session()->get('cart');

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $quantity;
            session()->put('cart', $cart);
        }
    }

    public function remove($productId)
    {
        $cart = session()->get('cart');

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }
    }

    public function clear()
    {
        session()->forget('cart');
    }

    public function content()
    {
        return session()->get('cart');
    }

    public function count()
    {
        $cart = session()->get('cart');
        return array_sum(array_column($cart, 'quantity'));
    }

    public function total()
    {
        $cart = session()->get('cart');
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return $total;
    }
} 