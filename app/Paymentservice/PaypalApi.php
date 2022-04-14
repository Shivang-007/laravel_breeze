<?php

namespace App\Paymentservice;

class PaypalApi
{
    protected $trans_id;
    public function __construct($trans_id)
    { 
        $this->trans_id=$trans_id;
        
    }
    public function pay(){
        return [
            'amount' => 500,
            'transaction' => $this->trans_id
        ];    
    }
}