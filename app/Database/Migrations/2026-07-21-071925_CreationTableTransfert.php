<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreationTableTransfert extends Migration
{
    public function up()
    {
        $sql = file_get_contents(ROOTPATH . 'base-alea-1.sql');
        $this->db->query($sql);
    }

    public function down()
    {
        //
    }
}
