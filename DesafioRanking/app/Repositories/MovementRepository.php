<?php
namespace App\Repositories;

use App\Models\Movement;
use Exception;

class MovementRepository extends RepositoryBase
{
    public function __construct()
    {
        $this->model = new Movement();
    }
}