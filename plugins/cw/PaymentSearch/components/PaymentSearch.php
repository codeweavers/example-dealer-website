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
        return 'Some Results';
    }

    public function onRun()
    {
        $this->page['message'] = $this->search();
    }
}