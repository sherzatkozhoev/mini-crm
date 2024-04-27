<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Organization;
use App\Models\Position;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Контроллер для работы с должностями
 */
class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  int                              $organizationId
     * @param  int                              $departmentId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index(int $organizationId, int $departmentId): RedirectResponse
    {
        return redirect()->route('organizations.departments.show', [
            $organizationId,
            $departmentId
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int                            $organizationId
     * @param  int                            $departmentId
     * @return \Illuminate\Contracts\View\View
     */
    public function create(int $organizationId, int $departmentId): View
    {
        $organization = Organization::findOrFail($organizationId);
        $department   = Department::where('organization_id', $organizationId)->findOrFail($departmentId);

        return view('admin.positions.create', compact([
            'organization',
            'department',
        ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request         $request
     * @param  int                              $organizationId
     * @param  int                              $departmentId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, int $organizationId, int $departmentId): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        Position::create([
            'name'          => (string) $request->input('name'),
            'department_id' => $departmentId,
        ]);

        return redirect()->route('organizations.departments.show', [
            $organizationId,
            $departmentId
        ])->with('status', 'Должность успешно создана!');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int                            $organizationId
     * @param  int                            $departmentId
     * @param  int                            $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(int $organizationId, int $departmentId, int $id): View
    {
        $organization = Organization::findOrFail($organizationId);
        $department   = Department::where('organization_id', $organizationId)->findOrFail($departmentId);
        $position     = Position::where('department_id', $departmentId)->findOrFail($id);

        return view('admin.positions.edit', compact([
            'organization',
            'department',
            'position',
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request         $request
     * @param  int                              $organizationId
     * @param  int                              $departmentId
     * @param  int                              $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $organizationId, int $departmentId, int $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $position = Position::findOrFail($id);
        $position->update($request->all());

        return redirect()->route('organizations.departments.show', [
            $organizationId,
            $departmentId,
        ])->with('status', 'Должность успешно обновлена!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        //
    }
}
