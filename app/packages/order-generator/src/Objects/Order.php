<?php

namespace Manson\OrderGenerator\Objects;
use Stringable;

/**
 * @author  Manson
 * @date    5/30/22
 *
 * @package sandbox
 */
class Order implements Stringable
{
    protected string $id;
    protected string $created;

    public function __construct(
        protected float $amount,
        protected array $products,
    )
    {
        $this->id = $this->generateId();
        $this->created = date('Y-m-d h:i:s');
    }

    public function id(): string
    {
        return $this->id;
    }

    public function amount(): float
    {
        return $this->amount;
    }

    public function products(): array
    {
        return $this->products;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'amount' => $this->amount,
            'products' => $this->products,
            'created' => $this->created,
        ];
    }

    protected function generateId(): string
    {
        return strtoupper($this->generateRandomString());
    }

    public function generateRandomString($length = 10): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function __toString(): string
    {
        return json_encode($this->toArray());
    }
}
