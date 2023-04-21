<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{
    HeaderContact,
    Banner,
    AboutUs,
    Company,
    Category,
    WarehouseEquipment,
    Contact,
    Social,
    Location
};

class MainController extends Controller
{
    public function index(Request $request) {
        $header = HeaderContact::all();
        $banners = Banner::all();
        $aboutUs = AboutUs::first();
        $companies = Company::all();
        foreach ($companies as $company) {
            $company->categories = Category::where('company_id', $company->id)->get();
        }
        $warehouseEquipments = WarehouseEquipment::all();

        $footer = [
            'contacts' => Contact::all(),
            'socials' => Social::all(),
        ];

        $response = [
            'headers' => $header,
            'banners' => $banners,
            'aboutUs' => $aboutUs,
            'companies' => $companies,
            'warehouseEquipments' => $warehouseEquipments,
            'footer' => $footer
        ];

        return response(
            $response, 200
        );
    }

    public function location(Request $request) {
        $locations = Location::all();

        $response = [
            'locations' => $locations,
        ];

        return response(
            $response, 200
        );
    }
}
