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
        $response = new PaymentSearchResponse($query);
        return $response->getFinance();

    }

    public function onRun()
    {
        $this->page['vehicles'] = $this->search($this->property('query'));
    }
}

