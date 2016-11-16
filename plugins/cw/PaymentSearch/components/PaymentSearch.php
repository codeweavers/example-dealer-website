<?php namespace Cw\PaymentSearch\Components;

use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\Input;

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

    public function search($query = "", $isStockId = false)
    {
        $response = new PaymentSearchResponse($query, $isStockId);
        return $response->getFinance();

    }

    public function onRun()
    {
        if(Input::has('search'))
        {
            $this->page['search'] = Input::get('search');
            $this->page['vehicles'] = $this->search(Input::get('search'));
        }
        else
        {
            $this->page['search'] = '';
            $this->page['vehicles'] = $this->search($this->property('query'), true);
        }
    }
}

