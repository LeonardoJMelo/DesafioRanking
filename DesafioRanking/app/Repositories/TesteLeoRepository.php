<?php
namespace App\Repositories;

use App\Models\TesteLeo;
use Exception;

class TesteLeoRepository extends RepositoryBase
{
    public function __construct()
    {
        $this->model = new TesteLeo();
    }
}