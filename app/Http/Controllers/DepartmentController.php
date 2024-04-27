<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Organization;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Контроллер для работы с отделами
 */
class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(int $organizationId)
    {
        return redirect()->route('organizations.show', $organizationId);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(int $organizationId)
    {
        return view('admin.departments.create', [
            'organization' => Organization::findOrFail($organizationId),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, int $organizationId)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Department::create([
            'name'            => (string) $request->input('name'),
            'description'     => (string) $request->input('description'),
            'organization_id' => $organizationId,
        ]);

        return redirect()->route('organizations.show', $organizationId)->with('status', 'Отдел успешно создан!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int                            $organizationId
     * @param  int                            $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(int $organizationId, int $id): View
    {
        $organization = Organization::findOrFail($organizationId);
        $department   = Department::where('organization_id', $organizationId)->findOrFail($id);
        $positions    = $department->positions()->latest()->get();

        return view('admin.departments.show', compact([
            'organization',
            'department',
            'positions',
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int                            $organizationId
     * @param  int                            $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(int $organizationId, int $id): View
    {
        $organization = Organization::findOrFail($organizationId);
        $department   = Department::where('organization_id', $organizationId)->findOrFail($id);

        return view('admin.departments.edit', compact([
            'organization',
            'department',
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request         $request
     * @param  int                              $organizationId
     * @param  int                              $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $organizationId, int $id): RedirectResponse
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $department = Department::findOrFail($id);
        $department->update($request->all());

        return redirect()->route('organizations.show', $organizationId)
            ->with('status', 'Отдел успешно обновлен!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        //
    }
}
