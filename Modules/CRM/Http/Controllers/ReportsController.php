<?php

namespace Modules\CRM\Http\Controllers;

use Illuminate\Routing\Controller;
use Inertia\Inertia;

class ReportsController extends Controller
{
    public function index()
    {
        return Inertia::render('Reports/Index');
    }
}
