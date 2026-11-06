<?php

namespace App\Controllers\Admin;

use App\Models\UserModel;
use App\Models\UserModuleModel;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends AdminBaseController
{
    /** @var UserModuleModel */
    protected $userModuleModel;

    /** @var UserModel */
    protected $userModel;

    public function __construct()
    {
        $this->userModel = model(UserModel::class);
        $this->userModuleModel = model(UserModuleModel::class);
    }

    public function index()
    {
        return view("admin/login-view");
    }

    /**
     * Authenticate an administrator using the provided login credentials.
     *
     * Validates the user's credentials, retrieves their assigned modules,
     * and stores their authentication details and access permissions in the session.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse 
     * Redirects to the admin vehicles page on success or back to the login page on failure.
     */
    public function login()
    {
        $session = session();

        $loginCredentials = $this->request->getPost();

        $user = $this->userModel
            ->where("user_uname", $loginCredentials["username"])
            ->where("user_delete", 0)
            ->where("user_inactive", 0)
            ->first();

        if (!$user) {
            return redirect()->back()->with("login_error", "Invalid Credentials");
        }

        if (!password_verify($loginCredentials["password"], $user->user_pword)) {
            return redirect()->back()->with("login_error", "Invalid Credentials");
        }

        $modules = $this->userModuleModel
            ->select('modules.mod_no, modules.mod_link')
            ->join('modules', 'modules.mod_no = users_modules.mod_no')
            ->where('users_modules.user_no', $user->user_no)
            ->where('users_modules.um_inactive', 0)
            ->orderBy('modules.mod_order')
            ->findAll();

        $newdata = [
            'name'  => "{$user->user_fname} {$user->user_lname}",
            'user_no' => $user->user_no,
            'logged_in' => true,
            'modules' => array_map(fn($item) => $item->mod_no, $modules),
            'access' => array_map(fn($item) => $item->mod_link, $modules)
        ];

        $session->set('admin', $newdata);

        return redirect()->to("/admin/vehicles");
    }

    /**
     * Log out the currently authenticated administrator.
     *
     * Destroys the current session and clears the cached module data.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse Redirects to the admin login page.
     */
    public function logout()
    {
        session()->destroy();
        cache()->delete('modules');

        return redirect()->to('admin/login');
    }
}
