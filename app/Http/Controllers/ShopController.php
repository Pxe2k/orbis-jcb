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

        $query = DB::table('products')
            ->join('companies', 'products.company_id', '=', 'companies.id')
            ->select('products.*', 'companies.name as companyName', 'companies.image as companyImage');

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
        $idsArray = explode(',', $ids);
        $products = Product::whereIn('id', $idsArray)->get();

        return response ([
            'products' => $products,
        ],200);
    }

    public function allCompanies ()
    {
        $companies = Company::all();

        return response([
            'companies' => $companies
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
