<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Session;

class CartIndex extends Component
{
    public $cart = [];
    public $total = 0;

    public function mount()
    {
        $this->updateCart();
    }

    public function updateCart()
    {
        $this->cart = Session::get('cart', []);
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->total = 0;
        foreach ($this->cart as $item) {
            $this->total += $item['price'] * $item['quantity'];
        }
    }

    public function increment($itemId)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$itemId]) && $cart[$itemId]['quantity'] < 5) {
            $cart[$itemId]['quantity']++;
            Session::put('cart', $cart);
            $this->updateCart();

            $this->dispatch(
                'show-notification',
                type: 'success',
                message: 'Cantidad aumentada'
            );
        }
    }

    public function decrement($itemId)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$itemId]) && $cart[$itemId]['quantity'] > 1) {
            $cart[$itemId]['quantity']--;
            Session::put('cart', $cart);
            $this->updateCart();

            $this->dispatch(
                'show-notification',
                type: 'success',
                message: 'Cantidad disminuida'
            );
        }
    }

    public function updateQuantity($itemId, $quantity)
    {
        $quantity = (int) $quantity;

        if ($quantity < 1) $quantity = 1;
        if ($quantity > 5) $quantity = 5;

        $cart = Session::get('cart', []);

        if (isset($cart[$itemId])) {
            $cart[$itemId]['quantity'] = $quantity;
            Session::put('cart', $cart);
            $this->updateCart();

            $this->dispatch(
                'show-notification',
                type: 'success',
                message: 'Cantidad actualizada'
            );
        }
    }

    public function removeItem($itemId)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$itemId])) {
            $itemTitle = $cart[$itemId]['title'];
            unset($cart[$itemId]);
            Session::put('cart', $cart);

            $this->updateCart();

            $this->dispatch(
                'show-notification',
                type: 'success',
                message: "{$itemTitle} eliminado del carrito"
            );
        }
    }

    public function clearCart()
    {
        Session::forget('cart');
        $this->updateCart();

        $this->dispatch(
            'show-notification',
            type: 'success',
            message: 'Carrito vaciado correctamente'
        );
    }

    #[On('cart-updated')]
    public function refreshCart()
    {
        $this->updateCart();
    }

    public function render()
    {
        return view('livewire.cart-index');
    }
}
