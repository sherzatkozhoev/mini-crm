<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Organization;
use App\Models\Position;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Контроллер для работы с пользователями
 */
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        return view('admin.users.index', [
            'users' => User::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
     * @param  int                            $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(int $id): View
    {
        return view('admin.users.edit', [
            'user'          => User::findOrFail($id),
            'organizations' => Organization::latest()->get(),
            'departments'   => Department::latest()->get()->groupBy('organization_id'),
            'positions'     => Position::latest()->get()->groupBy('department_id'),
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
            'name'            => 'required|string|max:255',
            'surname'         => 'string|max:255|nullable',
            'patronymic'      => 'string|max:255|nullable',
            'birthday'        => 'date|nullable',
            'gender'          => 'string|in:male,women|nullable',
            'organization_id' => 'required|integer',
            'department_id'   => 'integer|nullable',
            'position_id'     => 'integer|nullable',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->all());

        return redirect()->route('users.index')->with('status', 'Пользователь успешно обновлен!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        //
    }
}
