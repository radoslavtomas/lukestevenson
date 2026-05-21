<?php

namespace App\Http\Controllers\UI;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Navigation;
use App\Models\Page;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class PagesController extends Controller
{
    public function index()
    {
        $page = Page::where('name', 'Home')->firstOrFail();

        return Inertia::render('Home', [
            'page' => [
                'name' => $page['name'],
                'title' => $page['title'],
                'body' => $page['body']
            ]
        ]);
    }

    public function contact()
    {
        return Inertia::render('Contact');
    }

    public function getInTouch()
    {
        $page = Page::where('name', 'Get in touch')->firstOrFail();

        return Inertia::render('GetInTouch', [
            'page' => [
                'name' => $page['name'],
                'title' => $page['title'],
                'body' => $page['body']
            ]
        ]);
    }

    public function page(Request $request, $any)
    {
        $page = Navigation::with('page')->where('route', $any)->firstOrFail();

        return Inertia::render('PageView', [
            'page' => [
                'name' => $page['name'],
                'title' => $page['page']['title'],
                'body' => $page['page']['body']
            ]
        ]);
    }

    public function practice($page)
    {
        $page = Category::with('page')->where('url', $page)->firstOrFail();

        return Inertia::render('PageView', [
            'page' => [
                'name' => $page['name'],
                'title' => $page['page']['title'],
                'body' => $page['page']['body']
            ]
        ]);
    }
}
