<?php

namespace App\Http\Controllers\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class ReportsController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }
}
