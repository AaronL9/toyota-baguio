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

    /**
     * Show the form for editing a specific CMS section.
     *
     * @param string|int $id
     * @return void
     */
    public function editHeroSection()
    {
        $this->addJsEntries('js /admin/cms_edit.js');
        $model = new ContentManagementModel();

        $data['cms'] = $model->getHeroSectionContent();

        // if (!$data['cms']) {
        //     return redirect()->to('/admin/cms')->with('error', 'Content not found.');
        // }

        return view('admin/cms/hero_section', $data);
    }
}
