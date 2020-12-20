<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContainerStatus;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index()
    {
        $container_statuses = ContainerStatus::all();

        return response()->json(compact('container_statuses'));
    }
}
