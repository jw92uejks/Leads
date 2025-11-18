<?php

declare(strict_types=1);

namespace App\DTOs;

class PaymentDTO
{
    public function __construct(
        public float $amount,
        public ?string $orderId,
        public string $callbackUrl,
        public ?string $redirectUrl,
        public ?string $cancelUrl,
        public string $paymentType,
        public string $paymentMethod,
        public int $installments = 1,
        public ?array $card,
        public ?array $pix,
        public array $customer,
        public ?array $products,
        public ?array $subscription,
    ) {}

    public function toArray(): array
    {
        $data = [
            'amount'      => $this->amount,
            'order_id'    => $this->orderId,
            'callback_url' => $this->callbackUrl,
            'redirect_url' => $this->redirectUrl,
            'cancel_url'  => $this->cancelUrl,
            'payment' => [
                'type' => $this->paymentType,
                'method' => $this->paymentMethod,
                'installments' => $this->installments,
            ],
        ];

        if ($this->card) {
            $data['payment']['card'] = $this->card;
        }

        if ($this->pix) {
            $data['payment'] = array_merge($data['payment'], $this->pix);
        }

        if ($this->customer) {
            $data['customer'] = $this->customer;
        }

        if ($this->products) {
            $data['products'] = $this->products;
        }

        if ($this->subscription) {
            $data['subscription'] = $this->subscription;
        }

        return $data;
    }
}
