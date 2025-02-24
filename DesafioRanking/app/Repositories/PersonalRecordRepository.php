<?php
namespace App\Repositories;

use App\Models\PersonalRecord;
use Exception;

class PersonalRecordRepository extends RepositoryBase
{
    public function __construct()
    {
        $this->model = new PersonalRecord();
    }
}