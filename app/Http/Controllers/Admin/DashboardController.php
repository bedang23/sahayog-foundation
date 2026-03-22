<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CmsService;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(private readonly CmsService $cms)
    {
    }

    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'pages' => $this->cms->pagesForDashboard(),
        ]);
    }
}
