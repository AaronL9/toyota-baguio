<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\AdminBaseController;
use App\Models\CategoryModel;
use CodeIgniter\HTTP\ResponseInterface;

class Category extends AdminBaseController
{
    protected $data = [];

    public function __construct()
    {
        $this->data["page"] = "vehicles-category";
    }

    public function index($id = null)
    {
        if ($id) {
            $data["page"] = "vehicles-category-update";

            $model = model(CategoryModel::class);
            $data["cc"] = $model->find($id);

            return view("admin/vehicles-category/vehicles-category-update-view", $data);
        }

        $data["page"] = "vehicles-category";
        return view("admin/vehicles-category/vehicles-category-view", $data);
    }

    public function create()
    {
        $data["page"] = "vehicles-category-create";
        return view("admin/vehicles-category/vehicles-category-create-view", $data);
    }
}
