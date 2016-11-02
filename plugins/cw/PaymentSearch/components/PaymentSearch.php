<?php namespace Cw\PaymentSearch\Components;

use Cms\Classes\ComponentBase;
use Url;

class PaymentSearch extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Payment Information',
            'description' => 'Display requested payment information'
        ];
    }

    public function defineProperties()
    {
        return [
            'query' => [
                'title'   => 'Query',
                'type'    => 'text',
                'default' => ''
            ]
        ];
    }

    public function search($query = "")
    {
        if($query !== null && $query !== "")
            $query = "'dealervehicleid:{$query}'";
        else
            $query = "";

        $url = 'https://services.codeweavers.net/public/v2/paymentsearch/search';

        $request = [
            'Credentials' => [
                'ApiKey' => env('CW_API_KEY'),
                "SystemKey" => env('CW_SYSTEM_KEY')
            ],
            'Customer' => [
                'Reference' => "SESSIONID"
            ],
            'Parameters' => [
                'Term' => "36",
                'Deposit' => "10",
                'DepositType' => "Percentage",
                'AnnualMileage' => "10000"
            ],
            'Search' => [
                'MinimumPayment' => 100,
                'MaximumPayment' => 1000,
                'Query' => $query
            ],
            'Options' => [
                'HasProductsGroupedByVehicle' => true,
                'ReturnErrors' => false,
                'SortBy' => "RegularPaymentDescending",
                'PageNumber' => 1,
                'ResultsPerPage' => 50,
                'IncludeVehiclesWithNoDescription' => "true"
            ]
        ];

        $options = [
            'http' => [
                'header' => [
                    "Referer: " . URL::to('/'),
                    "Content-type: application/json",
                    "Accept: application/json",
                    sprintf('Content-Length: %d', strlen(json_encode($request)))
                ],
                'method' => 'POST',
                'content' => json_encode($request),
            ]
        ];

        $context = stream_context_create($options);
        $response = json_decode(file_get_contents($url, false, $context));

        return $response;
    }

    public function onRun()
    {
        $this->page['message'] = $this->search($this->property('query'));
    }
}