<?php

namespace App\Http\Middleware;

use App\Traits\DataRetrievalTrait;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    use DataRetrievalTrait;
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'user/app';

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
        $user = $request->user();
        $budgetYears = $this->getAllYears();
        $activeYear = $this->getActiveYear();
        
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $user ? $user->only('id', 'name', 'email', 'unit_id') : null,
                'roles' => $user ? $user->getRoles() : [],
                'budgetYears' => $budgetYears ? $budgetYears : [],
                'activeYear' => $activeYear,
            ],
        ]);
    }
}
