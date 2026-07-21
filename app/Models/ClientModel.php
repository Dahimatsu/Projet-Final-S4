<?php
namespace App\Models;
use CodeIgniter\Model;

class ClientModel extends Model
{
    protected $table = 'compte_client';
    protected $primaryKey = 'id_client';
    protected $allowedFields = ['numero_telephone', 'nom', 'prenom', 'solde', 'epargne'];
}