<?php

namespace App\Models;

use CodeIgniter\Model;

class ConfigModel extends Model
{
    protected $table            = 'configs';
    protected $primaryKey       = 'config_no';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

    public function getConfigs()
    {
        $sql = <<<SQL
            SELECT 
                config_no AS id,
                config_code AS code,
                config_title AS title,
                config_value AS value
            FROM configs
            SQL;

        $results = $this->db->query($sql)->getResultObject();

        $data = [];
        foreach ($results as $row) {
            $data[$row->code] = $row;
        }

        return $data;
    }
}
