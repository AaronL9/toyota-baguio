<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\AdminBaseController;
use App\Models\CategoryModel;
use App\Models\VehicleModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Vehicle extends AdminBaseController
{
    /** @var VehicleModel */
    protected $vehicleModel;

    /** @var CategoryModel */
    protected $categoryModel;

    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger,
    ) {
        parent::initController($request, $response, $logger);

        // Add your code here.
        $this->vehicleModel = model(VehicleModel::class);
        $this->categoryModel = model(CategoryModel::class);
    }

    /**
     * Show the list of vehicles
     *
     * @param string|null $id
     * @return void
     */
    public function index($id = null)
    {
        $this->addJsEntries('js/admin/vehicles.js');

        if ($id) {
            $data["cc"] = $this->vehicleModel->find($id);
            return view("admin/vehicles/vehicles-show-view", $data);
        }

        $data['page'] = 'vehicles';
        return view("admin/vehicles/vehicles", $data);
    }

    /**
     * Display the vehicle creation form
     *
     * @return void
     */
    public function new()
    {
        $this->addJsEntries('js/admin/vehicles_new.js');

        $data["category"] = $this->categoryModel
            ->select("cat_no, cat_title",)
            ->where("cat_delete", 0)
            ->findAll();

        return view("admin/vehicles/vehicles_new", $data);
    }
}
