<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

class CartService
{
    private const MAX_QUANTITY = 5;
    private const MIN_QUANTITY = 1;

    public function getCart(): array
    {
        return Session::get('cart', []);
    }

    public function addItem(array $book, int $quantity): void
    {
        $cart = $this->getCart();
        $bookId = $book['id'];

        if (isset($cart[$bookId])) {
            $cart[$bookId]['quantity'] = min(
                $cart[$bookId]['quantity'] + $quantity,
                self::MAX_QUANTITY
            );
        } else {
            $cart[$bookId] = [
                'id' => $book['id'],
                'title' => $book['title'],
                'author' => $book['author'],
                'price' => $book['price'],
                'image' => $book['image'],
                'quantity' => min($quantity, self::MAX_QUANTITY)
            ];
        }

        Session::put('cart', $cart);
    }

    public function updateQuantity(int $itemId, int $quantity): void
    {
        $cart = $this->getCart();

        if (isset($cart[$itemId])) {
            $cart[$itemId]['quantity'] = max(
                self::MIN_QUANTITY,
                min($quantity, self::MAX_QUANTITY)
            );
            Session::put('cart', $cart);
        }
    }

    public function removeItem(int $itemId): ?string
    {
        $cart = $this->getCart();

        if (isset($cart[$itemId])) {
            $itemTitle = $cart[$itemId]['title'];
            unset($cart[$itemId]);
            Session::put('cart', $cart);
            return $itemTitle;
        }

        return null;
    }

    public function clearCart(): void
    {
        Session::forget('cart');
    }

    public function getTotal(): float
    {
        return array_reduce($this->getCart(), function ($total, $item) {
            return $total + ($item['price'] * $item['quantity']);
        }, 0);
    }

    public function isEmpty(): bool
    {
        return empty($this->getCart());
    }
}
