<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class ValidationController extends Controller
{
    public function index()
    {
        $data = [
            "username" => "admin",
            "password" => "rahasia"
        ];

        $rules = [
            "username" => "required|email|max:100",
            "password" => ["required", "min:6", "max:20"],
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            Log::info($validator->errors()->toJson(JSON_PRETTY_PRINT));
            return response()->json($validator->errors());
        }

        return "Validasi berhasil";
    }
}
