<?php

namespace App\Http\Controllers;

use DB;
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

    public function filterProducts(Request $request)
    {
        $category_id = $request->input('category_id');
        $subcategory_id = $request->input('subcategory_id');
        $catalog_type_id = $request->input('catalog_type_id');
        $company_id = $request->input('company_id');
        $min_price = $request->input('min_price');
        $max_price = $request->input('max_price');

        $query = DB::table('products');

        if ($category_id) {
            $query->where('category_id', $category_id);
        }

        if ($subcategory_id) {
            $query->where('subcategory_id', $subcategory_id);
        }

        if ($catalog_type_id) {
            $query->where('catalog_type_id', $catalog_type_id);
        }

        if ($company_id) {
            $query->where('company_id', $company_id);
        }

        if ($min_price && $max_price) {
            $query->whereBetween('price', [$min_price, $max_price]);
        } elseif ($min_price) {
            $query->where('price', '>=', $min_price);
        } elseif ($max_price) {
            $query->where('price', '<=', $max_price);
        }

        $products = $query->get();

        return response ([
            'products' => $products,
        ],200);
    }

    public function getProductsByIds($ids)
    {
        // Convert the comma-separated IDs string to an array
        $idsArray = explode(',', $ids);

        // Query the Product model for the products with the given IDs
        $products = Product::whereIn('id', $idsArray)->get();

        // Return the products in the response
        return response ([
            'products' => $products,
        ],200);
    }
}
