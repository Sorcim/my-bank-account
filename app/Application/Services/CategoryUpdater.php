<?php

namespace App\Application\Services;

use App\Domain\Entities\Category;

class CategoryUpdater {
    public function update(Category $category, array $data): Category
    {
        if(isset($data['name'])){
            $category->name = $data['name'];
        }
        if(isset($data['color'])){
            $category->color = $data['color'];
        }

        return $category;
    }
}
