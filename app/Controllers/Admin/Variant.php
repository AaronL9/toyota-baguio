<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\AdminBaseController;
use App\Models\CategoryModel;
use App\Models\VariantsModel;
use App\Models\VehicleModel;
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
}
