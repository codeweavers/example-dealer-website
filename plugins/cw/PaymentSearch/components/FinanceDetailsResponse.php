<?php
namespace Cw\PaymentSearch\Components;

use Psy\Exception\ErrorException;
use Illuminate\Support\Facades\URL;

class FinanceDetailsResponse
{
    private $stockId;
    private $url;

    public function __construct($stockId)
    {
        $this->validateStockId($stockId);
    }

    private function validateStockId($stockId)
    {
        if ($stockId === null || $stockId === "")
            throw new ErrorException("Stock Id not provided");

        $this->stockId = $stockId;
    }

    public function getFinance()
    {
        $this->url = 'https://services.codeweavers.net/public/v3/JsonFinance/Calculate';

        $request = new FinanceDetailsRequest();
        $request->setCredentials(env('CW_API_KEY'), env('CW_SYSTEM_KEY'));
        $request->setCustomerReference("SESSIONID");
        $request->setParameters("36", "10", "Percentage", "10000");
        $request->setVehicleRequests("1234", $this->stockId);

        $headers = [
            'http' => [
                'header' => [
                    "Referer: " . URL::to('/'),
                    "Content-type: application/json",
                    "Accept: application/json",
                    sprintf('Content-Length: %d', strlen($request->getJson()))
                ],
                'method' => 'POST',
                'content' => $request->getJson(),
            ]
        ];

        $context = stream_context_create($headers);

        try {
            $response = json_decode(file_get_contents($this->url, false, $context));
            return $response->VehicleResults[0]->FinanceProductResults[0];
        } catch (\Exception $e) {
            return 'Something went wrong';
        }
    }
}