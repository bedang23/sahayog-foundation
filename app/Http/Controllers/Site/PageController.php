<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Services\CmsService;
use Illuminate\View\View;

class PageController extends Controller
{
    public function __construct(private readonly CmsService $cms)
    {
    }

    public function home(): View
    {
        return $this->renderPage('home');
    }

    public function about(): View
    {
        return $this->renderPage('about');
    }

    public function programs(): View
    {
        return $this->renderPage('programs');
    }

    public function donate(): View
    {
        return $this->renderPage('donate');
    }

    public function contact(): View
    {
        return $this->renderPage('contact');
    }

    private function renderPage(string $slug): View
    {
        $config = $this->cms->pageConfig($slug);
        $payload = $this->cms->getPagePayload($slug);

        return view($config['view'], $payload);
    }
}
