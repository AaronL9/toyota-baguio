<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\AdminBaseController;
use App\Models\CategoryModel;
use App\Models\VehicleModel;
use App\Models\VehiclesCategoryModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Vehicle extends AdminBaseController
{
    use ResponseTrait;

    /** @var VehicleModel */
    protected $vehicleModel;

    /** @var CategoryModel */
    protected $categoryModel;

    /** @var VehiclesCategoryModel */
    protected $vehiclesCategoryModel;

    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger,
    ) {
        parent::initController($request, $response, $logger);

        // Add your code here.
        $this->vehicleModel = model(VehicleModel::class);
        $this->categoryModel = model(CategoryModel::class);
        $this->vehiclesCategoryModel = model(VehiclesCategoryModel::class);
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

    /**
     * Display edit form
     *
     * @param string|null $id
     * @return void
     */
    public function edit($id = null)
    {
        if (!$id) {
            return redirect()->to('admin/vehicles');
        }

        $this->addJsEntries('js/admin/vehicles_edit.js');

        $data["categories"] = $this->categoryModel
            ->select("cat_no, cat_title",)
            ->where("cat_delete", 0)
            ->findAll();

        $data['vehicle_categories'] = $this->vehiclesCategoryModel->getVehicleCategoriesId($id);
        $data['cc'] = $this->vehicleModel->find($id);
        $data['id'] = $id;

        return view('admin/vehicles/vehicles_edit', $data);
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        if (!$id) {
            return $this->respond([
                "csrf_token" => csrf_hash(),
                "message" => "No resources found",
                "errors" => 'Not found',
            ], 404);
        }

        $json = $this->request->getPost();

        // return $this->respond(["data from server" => $json]);

        if (isset($json['inactive'])) {
            $this->vehicleModel->update($id, ['vehicle_inactive' => $json['inactive']]);

            return $this->respond([
                "csrf_token" => csrf_hash(),
                "message" => "Vehicle status change",
                "errors" => null,
            ]);
        }


        if (!$this->validate('vehicle')) {
            return $this->respond([
                "csrf_token" => csrf_hash(),
                "message" => "Validation Error",
                "errors" => $this->validator->getErrors()
            ], 422);
        }

        $vehicleEntry = [
            'vehicle_title' => $json['title'],
            'vehicle_tagline' => $json['tagline'],
            'vehicle_encode' => session()->get('admin')['user_no'] ?? null,
            'vehicle_encode_date' => date('Y-m-d H:i:s')
        ];

        try {
            $this->vehicleModel->db->transException(true)->transStart();

            $this->vehicleModel->update($id, $vehicleEntry);
            $this->vehicleModel->builder('vehicles_category')->where('vehicle_no', $id)->delete();

            $categoryEntry = [];
            foreach ($json['categories'] as $value) {
                $categoryEntry[] = [
                    'vehicle_no' => $id,
                    'cat_no' => $value
                ];
            }

            $this->vehicleModel->builder('vehicles_category')->insertBatch($categoryEntry, true);

            $this->vehicleModel->db->transComplete();

            return $this->respond([
                "csrf_token" => csrf_hash(),
                "message" => "You have successfully saved vehicle",
                "errors" => null,
            ]);
        } catch (DatabaseException $e) {
            return $this->respond([
                "csrf_token" => csrf_hash(),
                "message" => "Something went wrong",
                "errors" => $this->vehicleModel->errors(),
            ]);
        }
    }
}
