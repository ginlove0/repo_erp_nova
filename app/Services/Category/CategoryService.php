<?php


namespace App\Services\Category;


use App\Models\Category;

class CategoryService implements CategoryServiceInterface
{

    public function create(array $category): Category
    {

        return Category::create($category);
    }

    public function update($id, array $data): Category
    {
        $category = Category::findOrFail($id);
        $category->fill($data);
        $category->save();
        return $category;
    }

    public function delete($id): Category
    {
        $category = Category::findOrFail($id);
        $category->delete();
        $category->save();
        return $category;
    }
}