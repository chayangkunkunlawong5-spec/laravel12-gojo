<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 1100px;
            margin: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
        }

        .btn {
            padding: 10px 16px;
            border-radius: 7px;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: #4f46e5;
            color: white;
        }

        .btn-edit {
            background: #f59e0b;
            color: white;
        }

        .btn-delete {
            background: #dc2626;
            color: white;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .search-form {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr auto;
            gap: 10px;
        }

        input,
        select {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            width: 100%;
            box-sizing: border-box;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            text-align: left;
        }

        th {
            background: #f8fafc;
        }

        .profile {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            object-fit: cover;
        }

        .no-image {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            background: #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .actions {
            display: flex;
            gap: 6px;
        }

        .empty {
            text-align: center;
            padding: 30px;
            color: #777;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">
        <h1>Employee Management</h1>

        <a href="{{ route('employees.create') }}" class="btn btn-primary">
            + เพิ่มพนักงาน
        </a>
    </div>

    @if (session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">

        <form method="GET" action="{{ route('employees.index') }}" class="search-form">

            <input
                type="text"
                name="search"
                placeholder="ค้นหาชื่อหรือตำแหน่ง"
                value="{{ request('search') }}"
            >

            <select name="department">
                <option value="">ทุกแผนก</option>

                @foreach ($departments as $department)
                    <option value="{{ $department }}"
                        {{ request('department') == $department ? 'selected' : '' }}>
                        {{ $department }}
                    </option>
                @endforeach
            </select>

            <select name="position">
                <option value="">ทุกตำแหน่ง</option>

                @foreach ($positions as $position)
                    <option value="{{ $position }}"
                        {{ request('position') == $position ? 'selected' : '' }}>
                        {{ $position }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="btn btn-primary">
                ค้นหา
            </button>

        </form>

    </div>

    <div class="card">

        @if ($employees->count() > 0)

            <table>

                <thead>
                    <tr>
                        <th>รูป</th>
                        <th>ชื่อ</th>
                        <th>ตำแหน่ง</th>
                        <th>เงินเดือน</th>
                        <th>แผนก</th>
                        <th>จัดการ</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($employees as $employee)

                        <tr>

                            <td>
                                @if ($employee->profile_image)
                                    <img
                                        src="{{ asset('storage/' . $employee->profile_image) }}"
                                        alt="{{ $employee->name }}"
                                        class="profile"
                                    >
                                @else
                                    <div class="no-image">
                                        ไม่มีรูป
                                    </div>
                                @endif
                            </td>

                            <td>{{ $employee->name }}</td>

                            <td>{{ $employee->position }}</td>

                            <td>{{ number_format($employee->salary, 2) }} บาท</td>

                            <td>{{ $employee->department }}</td>

                            <td>

                                <div class="actions">

                                    <a
                                        href="{{ route('employees.edit', $employee) }}"
                                        class="btn btn-edit">
                                        แก้ไข
                                    </a>

                                    <form
                                        action="{{ route('employees.destroy', $employee) }}"
                                        method="POST"
                                        onsubmit="return confirm('ยืนยันการลบพนักงานคนนี้หรือไม่?');"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-delete">
                                            ลบ
                                        </button>
                                    </form>

                                </div>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        @else

            <div class="empty">
                ยังไม่มีข้อมูลพนักงาน
            </div>

        @endif

    </div>

</div>

</body>
</html>