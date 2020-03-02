<?php


namespace App\Services\Category;


use App\Models\Category;

interface CategoryServiceInterface
{
    public function create(array $category): Category;


    public function update($id, array $data): Category;


    public function delete($id): Category;
}