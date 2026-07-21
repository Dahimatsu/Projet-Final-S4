<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnsToCompteClient extends Migration
{
    public function up()
    {
        $sql = file_get_contents(ROOTPATH . 'base-alea-2.sql');
        $this->db->query($sql);
    }

    public function down()
    {
        //
    }
}
