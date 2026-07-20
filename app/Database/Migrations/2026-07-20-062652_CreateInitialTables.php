<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateInitialTables extends Migration
{
    public function up()
    {
        $sql = file_get_contents(ROOTPATH . 'base.sql');
        $this->db->query($sql);
    }

    public function down()
    {
        //
    }
}
