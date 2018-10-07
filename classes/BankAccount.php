<?php

class BankAccount implements IfaceBankAccount
{

    private $balance = null;

    public function __construct(Money $openingBalance)
    {
        $this->balance = $openingBalance;
    }

    public function balance()
    {
        return $this->balance;
    }

    public function deposit(Money $amount)
    {
        $this->balance = new Money($this->balance->value() + $amount->value());
    }

    public function transfer(Money $amount, BankAccount $account)
    {
        $this->withdraw($amount);
        $account->deposit($amount);
    }

    public function withdraw(Money $amount)
    {
        $value = $this->balance->value() - $amount->value();

        if($value < 0){
            throw new Exception("Withdrawl amount larger than balance", 401);
        }

        $this->balance = new Money($value);
    }
}