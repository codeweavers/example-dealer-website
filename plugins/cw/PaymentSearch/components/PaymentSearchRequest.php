<?php
namespace Cw\PaymentSearch\Components;

class PaymentSearchRequest
{

    public $Credentials;
    public $Customer;
    public $Parameters;
    public $Search;
    public $Options;

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

    public function setSearch($minimumPayment, $maximumPayment, $query)
    {
        $this->Search = new \stdClass();
        $this->Search->MinimumPayment = $minimumPayment;
        $this->Search->MaximumPayment = $maximumPayment;
        $this->Search->Query = $query;
    }

    public function setOptions($hasProductsGroupedByVehicle, $returnErrors, $sortBy, $pageNumber, $resultsPerPage, $includeVehiclesWithNoDescription)
    {
        $this->Options = new \stdClass();
        $this->Options->HasProductsGroupedByVehicle = $hasProductsGroupedByVehicle;
        $this->Options->ReturnErrors = $returnErrors;
        $this->Options->SortBy = $sortBy;
        $this->Options->PageNumber = $pageNumber;
        $this->Options->ResultsPerPage = $resultsPerPage;
        $this->Options->IncludeVehiclesWithNoDescription = $includeVehiclesWithNoDescription;
    }

    public function getJson()
    {
        return json_encode($this);
    }
}