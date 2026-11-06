<?php

namespace App\Models;

use CodeIgniter\Model;

class VehicleModel extends Model
{
    protected $table            = 'vehicles';
    protected $primaryKey       = 'vehicle_no';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "vcat_no",
        "vehicle_title",
        "vehicle_tagline",
        "vehicle_encode",
        "vehicle_encode_date",
        "vehicle_inactive",
        "vehicle_delete"
    ];
}
