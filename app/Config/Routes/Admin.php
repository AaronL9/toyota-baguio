<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');

$routes->group('admin', ['filter' => 'admin'], function ($routes) {
    $routes->get('login', 'Admin\Auth::index');

    $routes->post('login', 'Admin\Auth::login');
});

$routes->group('admin', ['filter' => 'adminlogin'], function ($routes) {
    $routes->get('vehicles', "Admin\Vehicle::index");
    $routes->put('vehicles/(:segment)', 'Admin\Vehicle::update/$1');

    $routes->get('vehicles/new', "Admin\Vehicle::new");
    $routes->get('vehicles/edit/(:segment)', "Admin\Vehicle::edit/$1");

    $routes->get('banners', "Admin\Banner::index");
    $routes->post('banners', "Admin\Banner::create");
    $routes->delete('banners/(:segment)', "Admin\Banner::delete/$1");

    $routes->get('banners/new', "Admin\Banner::new");
});

try {
    $db = \Config\Database::connect();
    $dynamicRoutes = $db->table('vehicles')
        ->where('vehicle_delete', 0)
        ->where('vehicle_inactive', 0)
        ->get()
        ->getResultArray();

    foreach ($dynamicRoutes as $row) {
        $uri = url_title($row['vehicle_title'], '-', true);

        $routes->get($uri, "Vehicle::show/{$row['vehicle_no']}");
        $routes->get("admin/vehicles/{$uri}/new", "Admin\Variant::new/{$row['vehicle_no']}");

        $routes->get("admin/vehicles/{$uri}", "Admin\Variant::index/{$row['vehicle_no']}");
        $routes->post("admin/vehicles/{$uri}", "Admin\Variant::create");

        $routes->get("admin/vehicles/{$uri}/(:segment)", "Admin\Variant::edit/$1/{$row['vehicle_no']}");
        $routes->put("admin/vehicles/{$uri}/(:segment)", "Admin\Variant::update/$1/{$row['vehicle_no']}");

        // $routes->get("admin/vehicles/{$uri}/variant/specifications/(:segment)", "Admin\Variant::specifications/$1");
        // $routes->post("admin/vehicles/{$uri}/variant/specifications/(:segment)", "Admin\Variant::specifications/$1");

        $routes->get("admin/vehicles/{$uri}/variant/photo/(:segment)", "Admin\Variants::getPhoto/$1");
        $routes->post("admin/vehicles/{$uri}/variant/photo/(:segment)", "Admin\Variants::postUploadPhoto/$1");
        $routes->delete("admin/vehicles/{$uri}/variant/photo/(:segment)", "Admin\Variants::deleteVariantPhoto/$1");

        $routes->get("admin/vehicles/{$uri}/variant/gallery/(:segment)", "Admin\Variants::getGallery/$1");
        $routes->post("admin/vehicles/{$uri}/variant/gallery/(:segment)", "Admin\Variants::postUploadGallery/$1");
        $routes->delete("admin/vehicles/{$uri}/variant/gallery/(:segment)/(:segment)", "Admin\Variants::deleteGalleryPhoto/$1/$2");
    }
} catch (\Throwable $e) {
    // Silently fail if DB isn't ready (e.g. during migrations)
    log_message('error', 'Dynamic routes failed: ' . $e->getMessage());
}
