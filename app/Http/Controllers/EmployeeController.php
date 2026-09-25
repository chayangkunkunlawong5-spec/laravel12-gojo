<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    /**
     * แสดงรายชื่อพนักงาน + ค้นหา + กรอง
     */
    public function index(Request $request)
    {
        $query = Employee::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('position', 'like', "%{$search}%");
            });
        }

        if ($request->filled('department')) {
            $query->where('department', $request->department);
        }

        if ($request->filled('position')) {
            $query->where('position', $request->position);
        }

        $employees = $query->latest()->get();

        $departments = Employee::select('department')
            ->distinct()
            ->orderBy('department')
            ->pluck('department');

        $positions = Employee::select('position')
            ->distinct()
            ->orderBy('position')
            ->pluck('position');

        return view('employees.index', compact(
            'employees',
            'departments',
            'positions'
        ));
    }

    /**
     * หน้าเพิ่มพนักงาน
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * บันทึกพนักงาน
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0',
            'department' => 'required|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('profile_image')) {
            $validated['profile_image'] =
                $request->file('profile_image')->store('employees', 'public');
        }

        Employee::create($validated);

        return redirect()
            ->route('employees.index')
            ->with('success', 'เพิ่มพนักงานเรียบร้อยแล้ว');
    }

    /**
     * แสดงข้อมูลพนักงาน
     */
    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    /**
     * หน้าแก้ไขพนักงาน
     */
    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    /**
     * อัปเดตข้อมูลพนักงาน
     */
    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0',
            'department' => 'required|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('profile_image')) {
            if ($employee->profile_image) {
                Storage::disk('public')->delete($employee->profile_image);
            }

            $validated['profile_image'] =
                $request->file('profile_image')->store('employees', 'public');
        }

        $employee->update($validated);

        return redirect()
            ->route('employees.index')
            ->with('success', 'แก้ไขข้อมูลพนักงานเรียบร้อยแล้ว');
    }

    /**
     * ลบพนักงาน
     */
    public function destroy(Employee $employee)
    {
        if ($employee->profile_image) {
            Storage::disk('public')->delete($employee->profile_image);
        }

        $employee->delete();

        return redirect()
            ->route('employees.index')
            ->with('success', 'ลบพนักงานเรียบร้อยแล้ว');
    }
}