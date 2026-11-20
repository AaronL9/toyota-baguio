<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\AdminBaseController;
use App\Models\AgentsModel;
use CodeIgniter\HTTP\ResponseInterface;

class Employee extends AdminBaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new AgentsModel();
    }

    /**
     * Show the list of employees
     *
     * @return string
     */
    public function index()
    {
        $data['page'] = 'agents';

        return view('admin/agents/agents-view', $data);
    }

    /**
     * Show create page for employee
     * 
     * @return string
     */
    public function new()
    {
        $data['page'] = 'agents-create';
        return view('admin/agents/agents-create-view', $data);
    }

    /**
     * Undocumented function
     *
     * @param string|int|null $id
     * 
     * @return \CodeIgniter\HTTP\RedirectResponse|string
     */
    public function edit($id = null)
    {
        if (!$id) {
            return redirect()->to('/admin/agents');
        }

        $model = new AgentsModel();

        $data['page'] = 'agents-edit';
        $data['cc'] = $model->find($id);

        return view('admin/agents/agents-edit-view', $data);
    }

    /**
     * Undocumented function
     *
     * @param string|int|null $id
     * @return void
     */
    public function profilePicture($id = null)
    {
        if (!$id) {
            return redirect()->to('admin/agents');
        }

        $data['cc'] = $this->model->find($id);

        return view('admin/employee_photo_upload', $data);
    }
}
