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
    public function getProduct(Product $product)
    {
        $productWithCompany = Product::with('company')->where('id', $product->id)->first();

        return response([
            'product' => $productWithCompany,
        ], 200);
    }
    public function filterProducts(Request $request)
    {
        $category_id = $request->input('category_id');
        $subcategory_id = $request->input('subcategory_id');
        $catalog_type_id = $request->input('catalog_type_id');
        $company_id = $request->input('company_id');
        $min_price = $request->input('min_price');
        $max_price = $request->input('max_price');
        $min_year = $request->input('min_year');
        $max_year = $request->input('max_year');
        $search = $request->input('search');

        $query = Product::query();

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
        if ($min_year && $max_year) {
            $query->whereBetween('year', [$min_year, $max_year]);
        } elseif ($min_year) {
            $query->where('year', '>=', $min_year);
        } elseif ($max_year) {
            $query->where('year', '<=', $max_year);
        }
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%$search%")
                    ->orWhere('description', 'LIKE', "%$search%");
            });
        }

        $products = $query->with('company', 'category')->get();

        return response([
            'products' => $products,
        ],200);
    }

    public function getProductsByIds($ids)
    {
        $idsArray = explode(',', $ids);
        $products = Product::whereIn('id', $idsArray)
            ->with('company')
            ->get();

        return response([
            'products' => $products,
        ],200);
    }

    public function allCompanies()
    {
        $companies = Company::with('products')->get();

        return response([
            'companies' => $companies,
        ]);
    }

    public function getAllCategoriesWithSubcategories()
    {
        $categories = Category::with('subcategories')->get();

        return response([
          'categories' => $categories
        ]);
    }
}
