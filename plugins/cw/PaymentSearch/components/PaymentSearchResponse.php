<?php
namespace Cw\PaymentSearch\Components;

use Illuminate\Support\Facades\URL;

class PaymentSearchResponse
{
    private $query;
    private $url;

    public function __construct($query)
    {
        $this->validateQuery($query);
    }

    private function validateQuery($query)
    {
        if ($query !== null && $query !== "")
            $this->query = "'dealervehicleid:{$query}'";
        else
            $this->query = "";
    }

    public function getFinance()
    {
        $this->url = 'https://services.codeweavers.net/public/v2/paymentsearch/search';

        $request = new PaymentSearchRequest();
        $request->setCredentials(env('CW_API_KEY'), env('CW_SYSTEM_KEY'));
        $request->setCustomerReference("SESSIONID");
        $request->setParameters("36", "10", "Percemtage", "10000");
        $request->setSearch(100, 1000, $this->query);
        $request->setOptions(true, false, "RegularPaymentDescending", 1, 50, "true");

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
            return $response;
        } catch (\Exception $e) {
            return 'Something went wrong';
        }
    }
}