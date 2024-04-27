<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Контроллер для работы с организациями
 */
class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        return view('admin.organizations.index', [
            'organizations' => Organization::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): View
    {
        return view('admin.organizations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request          $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Organization::create($request->all());

        return redirect()->route('organizations.index')->with('status', 'Организация успешно создана!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int                            $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(int $id): View
    {
        $organization = Organization::findOrFail($id);
        $departments  = $organization->departments()->latest()->get();

        return view('admin.organizations.show', compact('organization', 'departments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int                            $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(int $id): View
    {
        return view('admin.organizations.edit', [
            'organization' => Organization::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request         $request
     * @param  int                              $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $organization = Organization::findOrFail($id);
        $organization->update($request->all());

        return redirect()->route('organizations.index')->with('status', 'Организация успешно обновлена!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        //
    }
}
