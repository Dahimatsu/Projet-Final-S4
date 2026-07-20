<?php
namespace App\Models;
use CodeIgniter\Model;

class HistoriqueGainModel extends Model
{
    protected $table = 'historique_gain';
    protected $primaryKey = 'id_historique_gain';
    protected $allowedFields = ['montant_gain', 'date_gain'];
}