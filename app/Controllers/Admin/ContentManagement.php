<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ContentManagementModel;
use CodeIgniter\HTTP\ResponseInterface;

class ContentManagement extends AdminBaseController
{
    public function index()
    {
        $model = new ContentManagementModel();

        $data['cms'] = $model->getAllCms();

        return view('admin/cms', $data);
    }
}
