<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\AdminBaseController;
use App\Models\CategoryModel;
use App\Models\SpecificationsCategoryModel;
use App\Models\SpecificationsTypeModel;
use App\Models\VariantsModel;
use App\Models\VariantSpecCatModel;
use App\Models\VariantsSpecificationsModel;
use App\Models\VehicleModel;
use App\Models\VehiclesModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Variant extends AdminBaseController
{
    use ResponseTrait;

    /** @var VehicleModel */
    protected $vehicleModel;

    /** @var CategoryModel */
    protected $categoryModel;

    /** @var VariantsModel */
    protected $variantModel;

    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger,
    ) {
        parent::initController($request, $response, $logger);

        // Add your code here.
        $this->vehicleModel = model(VehicleModel::class);
        $this->categoryModel = model(CategoryModel::class);
        $this->variantModel = model(VariantsModel::class);
    }

    /**
     * View variant
     *
     * @param string $id
     * @return void
     */
    public function index($id = null)
    {
        $this->addJsEntries('js/admin/variants.js');

        $data['page'] = 'vehicles-variants';
        $data['cc'] = $this->vehicleModel->find($id);

        return view('admin/variants/variants', $data);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function new($id = null)
    {
        if (!$id) {
            return redirect()->back();
        }

        $this->addJsEntries('js/admin/variants_create.js');

        $data['page'] = 'vehicles-variants-create';
        $data['cc'] = $this->vehicleModel->find($id);
        $data["categories"] = $this->categoryModel
            ->select("cat_no, cat_title",)
            ->where("cat_delete", 0)
            ->findAll();

        return view('admin/variants/variants_create', $data);
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $data = $this->request->getPost();

        $rules = [
            'vehicle' => 'required',
            'model' => 'required',
        ];

        if (!$this->validate($rules)) {
            return $this->respond([
                "csrf_token" => csrf_hash(),
                "message" => "Validation Error",
                "errors" => $this->validator->getErrors()
            ], 422);
        }

        $entry = [
            'vehicle_no' => $data['vehicle'],
            'variant_model' => $data['model'],
            'variant_price' => $data['price'],
            'variant_price_month' => $data['price_month'],
            'variant_isdefault' => $data['isdefault'] ?? 0,
            'variant_isshowprice' => $data['isshowprice'] ?? 0,
            'variant_encode' => session()->get('admin')['user_no'] ?? null
        ];

        if ($entry['variant_isdefault'] == 1) {
            $variant = $this->variantModel
                ->where('vehicle_no', $entry['vehicle_no'])
                ->where('variant_isdefault', 1)
                ->first();

            if ($variant) {
                $this->variantModel->update($variant->variant_no, ['variant_isdefault' => 0]);
            }
        }

        $isInserted = $this->variantModel->insert($entry, false);

        if (!$isInserted) {
            return $this->respond([
                "csrf_token" => csrf_hash(),
                "message" => "Something went wrong",
                "errors" => $this->variantModel->errors(),
            ]);
        }

        return $this->respond([
            "csrf_token" => csrf_hash(),
            "message" => "You have successfully add variants",
            "errors" => null,
        ]);
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null, $vehicle_no = null)
    {
        $this->addJsEntries('js/admin/variants_edit.js');

        $data['cc'] = $this->vehicleModel->find($vehicle_no);

        $data['variant'] = $this->variantModel
            ->join('vehicles', 'variants.vehicle_no = vehicles.vehicle_no', 'left')
            ->find($id);

        $data["categories"] = $this->categoryModel
            ->select("cat_no, cat_title",)
            ->where("cat_delete", 0)
            ->findAll();

        return view('admin/variants/variants_edit', $data);
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
                "errors" => $this->validator->getErrors()
            ], 400);
        }

        $json = $this->request->getPost();

        if (isset($json['inactive'])) {
            $this->variantModel->update($id, ['variant_inactive' => $json['inactive']]);

            return $this->respond([
                "csrf_token" => csrf_hash(),
                "message" => "Variant status change",
                "errors" => null,
            ]);
        }

        $rules = [
            'vehicle' => 'required',
            'model' => 'required',
        ];

        if (!$this->validate($rules)) {
            return $this->respond([
                "csrf_token" => csrf_hash(),
                "message" => "Validation Error",
                "errors" => $this->validator->getErrors()
            ], 422);
        }

        $data['vehicle_no'] = $json['vehicle'];
        $data['variant_model'] = $json['model'];
        $data['variant_price'] = $json['price'];
        $data['variant_price_month'] = $json['price_month'];
        $data['variant_isdefault'] = $json['isdefault'] ?? 0;
        $data['variant_isshowprice'] = $json['isshowprice'] ?? 0;
        $data['variant_encode'] = session()->get('admin')['user_no'] ?? null;

        if ($data['variant_isdefault'] == 1) {
            $variant = $this->variantModel
                ->where('vehicle_no', $data['vehicle_no'])
                ->where('variant_isdefault', 1)
                ->first();

            if ($variant) {
                $this->variantModel->update($variant->variant_no, ['variant_isdefault' => 0]);
            }
        }

        $isInserted = $this->variantModel->update($id, $data);

        if (!$isInserted) {
            return $this->respond([
                "csrf_token" => csrf_hash(),
                "message" => "Something went wrong",
                "errors" => $this->variantModel->errors(),
            ]);
        }

        return $this->respond([
            "csrf_token" => csrf_hash(),
            "message" => "You have successfully updated variant",
            "errors" => null,
        ]);
    }

    /**
     * Show variant specification
     *
     * @param string $id
     * @return void
     */
    public function specifications($id = null)
    {
        if (!$id) {
            return redirect()->to('admin/variants');
        }

        $this->addJsEntries('js/admin/variant_specifications.js');

        $data['page'] = 'variant-add-spec';

        $data['cc'] = $this->variantModel
            ->select('variants.*, vehicles.vehicle_title')
            ->join('vehicles', 'variants.vehicle_no = vehicles.vehicle_no', 'left')
            ->find($id);

        $model = new VehiclesModel();

        $data['vehicles'] = $model->findAll();
        $data['spec_categories'] = (new SpecificationsCategoryModel())->where('scat_delete', 0)->orderBy('scat_title')->findAll();
        $data['spec_type'] = (new SpecificationsTypeModel())->where('spec_delete', 0)->orderBy('spec_title')->findAll();
        $data['id'] = $id;

        return view('admin/variants/variant_specifications', $data);
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function createSpecifications()
    {
        $json = $this->request->getPost();
        $vscModel = new VariantSpecCatModel();
        $model = new VariantsSpecificationsModel();

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

        $isInserted = $model->insert([
            'vsc_no' => $id,
            'spec_no' => $json['spec_type'],
            'vs_value' => $json['vs_value'] ?? null
        ], false);

        if (!$isInserted) {
            return $this->respond([
                "csrf_token" => csrf_hash(),
                "message" => "Something went wrong",
                "errors" => $model->errors(),
            ]);
        }

        return $this->respond([
            "csrf_token" => csrf_hash(),
            "message" => "You have successfully add specification",
            "errors" => null,
        ]);
    }
}
