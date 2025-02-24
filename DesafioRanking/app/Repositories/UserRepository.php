<?php
namespace App\Repositories;

use App\Models\User;
use Exception;

class UserRepository extends RepositoryBase
{
    public function __construct()
    {
        $this->model = new User();
    }
}