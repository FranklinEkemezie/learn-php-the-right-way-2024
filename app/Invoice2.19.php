<?php

declare(strict_types=1);

namespace App;

class Invoice
{

    public string $id;

    public function __construct(
        public float $amount,
        public string $description,
        public string $creditCardNumber = '63906948632452'
    )
    {
        $this->id = uniqid('Invoice_');
    }

    public static function make(float $amount, string $description): static {
        return new static($amount, $description);
    }

    public function __sleep(): array
    {
        // Returns an array of 'property' names to be included
        // during serialization
        return [];
    }

    public function __wakeup(): void
    {
        // Do some necessary restart that the unserialised object 
        // depends on.
    }

    public function __serialize(): array
    {
        // We can be more flexible as what we can returns to be serialized.
        return [
            'id'                => $this->id,
            'amount'             => $this->amount,
            'description'       => $this->description,
            'creditCardNumber'  => base64_encode($this->creditCardNumber),
            'foo'               => 'bar' // add aditional fields if need be
        ];
    }

    public function __unserialize(array $data)
    {
        // Decode the 'credit card number'
        $this->id = $data['id'];
        $this->amount = $data['amount'];
        $this->description = $data['description'];
        $this->creditCardNumber = base64_decode($data['creditCardNumber']);
    }
}