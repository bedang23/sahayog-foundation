<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Page;
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
            'pageCount' => Page::query()->count(),
            'galleryCount' => Gallery::query()->count(),
            'recentPages' => Page::query()->latest()->limit(5)->get(),
        ]);
    }
}
