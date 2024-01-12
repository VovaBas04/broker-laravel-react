<?php

namespace App\Services\company;

use App\Models\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class CompanyService
{
    public function store(array $data):Model
    {
        return Company::query()->create($data);
    }
    public function index():Collection
    {
        return Company::all();
    }
}
