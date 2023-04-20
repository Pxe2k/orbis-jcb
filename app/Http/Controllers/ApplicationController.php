<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;

use App\Models\{
    ServiceApplication,
    CareerApplication,
    PriceApplication,
};

class ApplicationController extends Controller
{
    public function priceApplicationCreate(Request $request)
    {
        $fields = $request->validate([
            'fullName' => 'required|string',
            'companyName' => 'string',
            'phoneNumber' => 'required|string',
            'email' => 'required|string',
            'address' => 'string',
            'address2' => 'string',
            'city' => 'string',
            'state' => 'string',
            'zipCode' => 'string',
            'companyId' => 'required|int',
            'productId' => 'required|int',
            'year' => 'required|string',
            'location' => 'required|string',
        ]);

        $application = PriceApplication::create([
            'fullName' => $fields ['fullName'],
            'companyName' => $fields ['companyName'],
            'phoneNumber' => $fields ['phoneNumber'],
            'email' => $fields ['email'],
            'address' => $fields ['address'],
            'address2' => $fields ['address2'],
            'city' => $fields ['city'],
            'state' => $fields ['state'],
            'zipCode' => $fields ['zipCode'],
            'company_id' => $fields ['companyId'],
            'product_id' => $fields ['productId'],
            'year' => $fields ['year'],
            'location' => $fields ['location'],
            ]);

        $response = [
            'application' => $application,
        ];

        return response($response, 201);
    }

    public function careerApplicationCreate(Request $request)
    {
        $file = $request->file('file');
        $path = $file->store('uploads');

        $fields = $request->validate([
            'fullName' => 'required|string',
            'email' => 'required|string',
            'phoneNumber' => 'required|string',
            'position' => 'string',
            'comment' => 'string',

        ]);

        $application = CareerApplication::create([
            'fullName' => $fields ['fullName'],
            'email' => $fields ['email'],
            'phoneNumber' => $fields ['phoneNumber'],
            'position' => $fields ['position'],
            'comment' => $fields ['comment'],
            'file' => $path,
        ]);

        $response = [
            'application' => $application,
        ];

        return response($response, 201);
    }

    public function serviceApplicationCreate(Request $request)
    {
        $fields = $request->validate([
            'fullName' => 'required|string',
            'companyName' => 'string',
            'phoneNumber' => 'required|string',
            'email' => 'required|string',
            'address' => 'string',
            'address2' => 'string',
            'city' => 'string',
            'state' => 'string',
            'zipCode' => 'string',
            'companyId' => 'required|int',
            'productId' => 'required|int',
            'year' => 'required|string',
            'location' => 'required|string',
            'comment' => 'string',
        ]);

        $application = ServiceApplication::create([
            'fullName' => $fields ['fullName'],
            'companyName' => $fields ['companyName'],
            'phoneNumber' => $fields ['phoneNumber'],
            'email' => $fields ['email'],
            'address' => $fields ['address'],
            'address2' => $fields ['address2'],
            'city' => $fields ['city'],
            'state' => $fields ['state'],
            'zipCode' => $fields ['zipCode'],
            'company_id' => $fields ['companyId'],
            'product_id' => $fields ['productId'],
            'year' => $fields ['year'],
            'location' => $fields ['location'],
            'comment' => $fields ['comment']]);

        $response = [
            'application' => $application,
        ];

        return response($response, 201);
    }
}
