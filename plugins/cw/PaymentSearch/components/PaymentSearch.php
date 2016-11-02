<?php namespace Cw\PaymentSearch\Components;

use Cms\Classes\ComponentBase;

class PaymentSearch extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name' => 'Payment Information',
            'description' => 'Display requested payment information'
        ];
    }

    public function search()
    {
        $url = 'https://services.codeweavers.net/public/v2/JsonFinance/Calculate';

        $request = [
            'Credentials' => [
                'ApiKey' =>  env('CW_API_KEY')
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
            'VehicleRequests' => [
                [
                    'Id' => '1234',
                    'Vehicle' => [
                        'CashPrice' => "10000",
                        'IsNew' => "true",
                        'Identifier' => "CAP_ID",
                        'IdentifierType' => "CapShortCode",
                        'Type' => "Car",
                        'StockId' => "12345",
                        'ImageUrl' => "http://notworking.com/1234.jpg",
                        'DealerVehicleUrl' => "http://notworking.com/1234/",
                        'IsVatQualifying' => "true"
                    ]
                ]
            ]
        ];

        $options = [
            'http' => [
                'header'  => [
                    "Referer: http://localhost",
                    "Content-type: application/json",
                    "Accept: application/json",
                    sprintf('Content-Length: %d', strlen(json_encode($request)))
                ],
                'method'  => 'POST',
                'content' => json_encode($request),
            ]
        ];

        $context  = stream_context_create($options);
        $response = file_get_contents($url, false, $context);

        return $response;
    }

    public function onRun()
    {
        $this->page['message'] = $this->search();
    }
}