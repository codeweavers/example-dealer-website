<?php
namespace Cw\PaymentSearch\Components;

class FinanceDetailsRequest
{
    public $Credentials;
    public $Customer;
    public $Parameters;
    public $VehicleRequests;

    public function setCredentials($apiKey, $systemKey)
    {
        $this->Credentials = new \stdClass();
        $this->Credentials->ApiKey = $apiKey;
        $this->Credentials->SystemKey = $systemKey;
    }

    public function setCustomerReference($reference)
    {
        $this->Customer = new \stdClass();
        $this->Customer->Reference = $reference;
    }

    public function setParameters($term, $deposit, $depositType, $annualMileage)
    {
        $this->Parameters = new \stdClass();
        $this->Parameters->Term = $term;
        $this->Parameters->Deposit = $deposit;
        $this->Parameters->DepositType = $depositType;
        $this->Parameters->AnnualMileage = $annualMileage;
    }

    public function setVehicleRequests($id, $stockId)
    {
        $this->VehicleRequests = [
            [
                'Id' => $id,
                'Vehicle' => [
                    'StockId' => $stockId
                ]
            ]
        ];
    }

    public function getJson()
    {
        return json_encode($this);
    }
}