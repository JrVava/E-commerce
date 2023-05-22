<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class APIController extends Controller
{
    public function unauthorized(Request $request)
    {
        return Response::json(['message' => 'Authentication is required'], 401);
    }
}