<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PedidoConfirmado extends Mailable
{
    use Queueable, SerializesModels;

    public $cart;
    public $user;
    public $voucherPath;

    /**
     * Create a new message instance.
     */
    /* public function __construct($cart, $user, $voucherPath = null)
    {
        $this->cart = $cart;
        $this->user = $user;
        $this->voucherPath = $voucherPath;
    } */

    public function __construct($cart, $user, $voucherPath = null)
    {
        $this->cart = $cart;
        $this->user = $user;
        $this->voucherPath = $voucherPath;

        // Calcular el total
        $this->total = 0;
        foreach ($cart as $item) {
            $this->total += $item['price'] * $item['quantity'];
        }
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pedido Confirmado',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content()
    {
        return new Content(
            view: 'email.pedido-confirmado',
            with: [
                'cart' => $this->cart,
                'user' => $this->user,
                'total' => $this->total, // Pasar el total a la vista
                'voucherPath' => $this->voucherPath
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $attachments = [];

        if ($this->voucherPath) {
            $attachments[] = \Illuminate\Mail\Mailables\Attachment::fromPath(
                storage_path('app/public/' . $this->voucherPath)
            )
                ->as('voucher.' . pathinfo($this->voucherPath, PATHINFO_EXTENSION))
                ->withMime(mime_content_type(storage_path('app/public/' . $this->voucherPath)));
        }

        return $attachments;
    }
}
