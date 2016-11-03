<?php namespace Cw\StockManagement;

use Backend;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name' => 'stock',
            'description' => 'No description provided yet...',
            'author' => 'cw',
            'icon' => 'icon-car'
        ];
    }

    public function registerNavigation()
    {
        return [
            'stock' => [
                'label'       => 'Stock Vehicles',
                'url'         => Backend::url('cw/stockmanagement'),
                'icon'        => 'icon-car',
            ]
        ];
    }
}