<?php

namespace App\Models;

use CodeIgniter\Model;

class ContentManagementModel extends Model
{
    protected $table            = 'cms_section_contents';
    protected $primaryKey       = 'content_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'section_id',
        'content_data',
        'created_at',
        'updated_at'
    ];

    public function getWebContent()
    {
        $sql = <<<SQL
            SELECT * FROM cms_section_contents a
            LEFT JOIN cms_sections b ON a.section_id = b.section_id
            WHERE section_type = 'hero'
            SQL;

        $query = $this->db->query($sql);

        $result = $query->getResult();

        return $result;
    }
}
