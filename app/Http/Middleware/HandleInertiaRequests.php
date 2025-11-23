<?php

namespace App\Http\Middleware;

use Inertia\Middleware;
use App\Models\Category;
use App\Models\ProductCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    public function rootView(Request $request)
    {
        if ($request->is('admin/*')) {
            return 'admin';
        }

        return $this->rootView;
    }

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $totalcarts = 0;
        if (Auth::check()) {
            $totalcarts = ProductCart::where('user_id', Auth::user()->id)->count();
        }

        $categories = Category::all();

        return [
            'flash' => [
                'status' => fn() => $request->session()->get('status'),
                'message' => fn() => $request->session()->get('message'),
                'errors' => fn() => $request->session()->get('errors')
                    ? $request->session()->get('errors')->getBag('default')->getMessages()
                    : (object) [],

            ],
            'totalcarts' => $totalcarts,
            'authUser' => Auth::check()?Auth::user():null,
            'categories' => $categories
        ];
    }
}
