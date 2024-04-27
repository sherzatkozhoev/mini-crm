<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

/**
 * Контроллер для работы c Dashboard
 */
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->hasRole('Admin')) {
            return view('admin.dashboard', [
                'organizations' => Organization::latest()->get()
            ]);
        }

        return view('dashboard', [
            'organization' => $user->organization,
            'department'   => $user->department,
            'position'     => $user->position,
        ]);
    }
}
