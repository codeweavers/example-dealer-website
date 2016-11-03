<?php namespace Cw\StockManagement\Controllers;

use Db;
use Cw\StockManagement\Models\StockVehicle;
use Backend\Classes\Controller;

class Index extends Controller {

    public function index()
    {
        $stockVehicle = new StockVehicle();
        $stockVehicle->description = "3 SERIES DIESEL TOURING 320D SPORT";
        $stockVehicle->colour = "Alpine White";
        $stockVehicle->doors = "5";
        $stockVehicle->engineSize = "2000";
        $stockVehicle->fuelType = "Diesel";
        $stockVehicle->manufacturer = "BMW";
        $stockVehicle->mileage = "4501";
        $stockVehicle->model = "";
        $stockVehicle->registrationNumber = "SL14LVH";
        $stockVehicle->transmission = "Manual";
        $stockVehicle->vehicleType = "Car";
        $stockVehicle->year = 2016;
        $stockVehicle->stockId = "70344";

        $this->vars['users'] = Db::select('select * from cw_stock_vehicles where cw_stock_vehicles.email = ?', [1]);

        $this->vars['stockVehicle'] = $stockVehicle;
    }
}