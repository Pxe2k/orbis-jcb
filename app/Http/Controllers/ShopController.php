<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{
    CatalogType,
    Company,
    Category,
    Subcategory,
    Product,
};

class ShopController extends Controller
{
    public function getCatalogType(CatalogType $catalogType) {
        $catalogType->products = Product::where('catalog_type_id', $catalogType->id)->get();

        return response ([
            'catalogType' => $catalogType,
        ]);
    }

    public function getCategory(Category $category)
    {
        $category->products = Product::where('category_id', $category->id)->get();

        return response ([
            'Category' => $category,
        ]);
    }

    public function getSubcategory(Subcategory $subcategory)
    {
        $subcategory->products = Product::where('subcategory_id', $subcategory->id)->get();

        return response ([
            'Subcategory' => $subcategory,
        ]);
    }

    public function getProduct(Product $product)
    {
        $products = Product::where('id', $product->id)->get();
        
        return response ([
            'product' => $product,
        ],200);
    }
}
