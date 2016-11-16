<?php namespace Cw\PaymentSearch;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name' => 'search',
            'description' => 'No description provided yet...',
            'author' => 'cw',
            'icon' => 'icon-leaf'
        ];
    }

    public function registerComponents()
    {
        return [
            '\Cw\PaymentSearch\Components\PaymentSearch' => 'search',
            '\Cw\PaymentSearch\Components\FinanceDetails' => 'financeDetails'
        ];
    }
}