<?php namespace Cw\PaymentSearch\Components;

use Cms\Classes\ComponentBase;

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
        $response = new FinanceDetailsResponse($stockId);
        return $response->getFinance();
    }

    public function onRun()
    {
        $this->page['finance'] = $this->search($this->property('query'));
    }
}

