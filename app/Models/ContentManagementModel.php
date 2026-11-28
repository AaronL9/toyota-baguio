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

    public function getAllCms()
    {
        $sql = <<<SQL
            SELECT * FROM cms_section_contents a
            LEFT JOIN cms_sections b ON a.section_id = b.section_id
            SQL;

        $query = $this->db->query($sql);

        $result = $query->getResult();

        return $result;
    }

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

    public function getHeroSectionContent()
    {
        $sql = <<<SQL
            SELECT * FROM configs
            WHERE config_code IN 
                ('hero_title', 
                'hero_subtitle', 
                'hero_button_text', 
                'hero_button_link', 
                'hero_background_image')
            SQL;

        $query = $this->db->query($sql);

        $result = $query->getResult();

        return $result;
    }
}
