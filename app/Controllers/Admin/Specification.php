<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SpecificationsCategoryModel;
use App\Models\SpecificationsTypeModel;
use App\Models\VariantsModel;
use App\Models\VariantSpecCatModel;
use App\Models\VehiclesModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Specification extends BaseController
{
    use ResponseTrait;

    /** @var VehicleModel */
    protected $vehicleModel;

    /** @var CategoryModel */
    protected $categoryModel;

    /** @var VariantsModel */
    protected $variantModel;

    /** @var SpecificationsCategoryModel */
    protected $specificationsCategoryModel;

    /** @var SpecificationsTypeModel */
    protected $specTypeModel;

    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger,
    ) {
        parent::initController($request, $response, $logger);

        // Add your code here.
        $this->variantModel = model(VariantsModel::class);
        $this->specificationsCategoryModel = new SpecificationsCategoryModel();
        $this->specTypeModel = new SpecificationsTypeModel();
    }

    public function index($id = null)
    {
        if (!$id) {
            return redirect()->to('admin/variants');
        }

        $data['page'] = 'variant-add-spec';

        $data['cc'] = $this->variantModel
            ->select('variants.*, vehicles.vehicle_title')
            ->join('vehicles', 'variants.vehicle_no = vehicles.vehicle_no', 'left')
            ->find($id);

        $model = new VehiclesModel();

        $data['vehicles'] = $model->findAll();
        $data['spec_categories'] = $this->specificationsCategoryModel->where('scat_delete', 0)->orderBy('scat_title')->findAll();
        $data['spec_type'] = $this->specTypeModel->where('spec_delete', 0)->orderBy('spec_title')->findAll();
        $data['id'] = $id;

        return view('admin/variants/specifications', $data);
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $json = json_decode($this->request->getBody(), true);
        $vscModel = new VariantSpecCatModel();

        if (!$this->validate('variants_spec')) {
            return $this->respond([
                "csrf_token" => csrf_hash(),
                "message" => "Validation Error",
                "errors" => $this->validator->getErrors()
            ], 422);
        }

        $id = $vscModel->insert([
            "variant_no" => $json['variant'],
            'scat_no' => $json['spec_cat'],
            "vsc_order" => $json['order'] ?? null,
            "vsc_encode" => session()->get('admin')['user_no'] ?? null,
            "vsc_encode_date" => date('Y-m-d H:i:s'),
        ]);

        $isInserted = $this->model->insert([
            'vsc_no' => $id,
            'spec_no' => $json['spec_type'],
            'vs_value' => $json['vs_value'] ?? null
        ], false);

        if (!$isInserted) {
            return $this->respond([
                "csrf_token" => csrf_hash(),
                "message" => "Something went wrong",
                "errors" => $this->model->errors(),
            ]);
        }

        return $this->respond([
            "csrf_token" => csrf_hash(),
            "message" => "You have successfully add specification",
            "errors" => null,
        ]);
    }
}
