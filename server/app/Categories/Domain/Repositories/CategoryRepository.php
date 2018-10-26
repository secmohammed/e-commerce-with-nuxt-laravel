<?php

namespace App\Categories\Domain\Repositories;

use App\App\Domain\Repositories\Repository;
use App\Categories\Domain\Models\Category;

class CategoryRepository extends Repository {
    protected $model;
    public function __construct(Category $category) {
        $this->model = $category;
    }
}