<?php namespace Cw\PaymentSearch\Components;

use Cms\Classes\ComponentBase;
use Url;

class FinanceDetails extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Vehicle Finance Information',
            'description' => 'Display requested vehicle finance information'
        ];
    }

    public function defineProperties()
    {
        return [
            'query' => [
                'title' => 'Query',
                'type' => 'text',
                'default' => ''
            ]
        ];
    }

    public function search($stockId)
    {
        $url = 'https://services.codeweavers.net/public/v3/JsonFinance/Calculate';

        $request = [
            'Credentials' => [
                'ApiKey' => env('CW_API_KEY'),
                'SystemKey' => env('CW_SYSTEM_KEY')
            ],
            'Customer' => [
                'Reference' => 'SESSIONID'
            ],
            'Parameters' => [
                'Term' => '36',
                'Deposit' => '10',
                'DepositType' => 'Percentage',
                'AnnualMileage' => '10000'
            ],
            'VehicleRequests' => [
                [
                    'Id' => '1234',
                    'Vehicle' => [
                        'StockId' => $stockId
                    ]
                ]
            ]
        ];

        $options = [
            'http' => [
                'header' => [
                    "Referer: " . URL::to('/'),
                    'Content-type: application/json',
                    'Accept: application/json',
                    sprintf('Content-Length: %d', strlen(json_encode($request)))
                ],
                'method' => 'POST',
                'content' => json_encode($request),
            ]
        ];

        $context = stream_context_create($options);
        $response = json_decode(file_get_contents($url, false, $context));
        return $response->VehicleResults[0]->FinanceProductResults[0];
    }

    public function onRun()
    {
        $this->page['finance'] = $this->search($this->property('query'));
    }
}