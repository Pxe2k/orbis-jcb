<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\{
    ServiceApplication
};

class ApplicationController extends Controller
{
    public function serviceApplicationCreate(Request $request)
    {
        // $fields = $request->validate([
        //     'name' => 'required|string',
        //     'phone' =>'required|string',
        // ]);

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
            'manufacturer' => $fields ['manufacturer'],
            'model' => $fields ['model'],
            'year' => $fields ['year'],
            'location' => $fields ['location'],
            'comment' => $fields ['comment']]);

        $response = [
            'application' => $application,
        ];

        return response($response, 201);
    }
}
