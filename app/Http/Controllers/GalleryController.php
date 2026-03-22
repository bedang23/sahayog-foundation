<?php

namespace App\Http\Controllers;

use App\Services\CmsService;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function __construct(private readonly CmsService $cms)
    {
    }

    public function index(): View
    {
        $payload = $this->cms->getPagePayload('gallery');

        return view('gallery', $payload);
    }
}
