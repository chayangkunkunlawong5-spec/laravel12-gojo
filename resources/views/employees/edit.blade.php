<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขพนักงาน</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            margin: 0;
            padding: 40px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
        }

        h1 {
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }

        .current-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
            margin-top: 10px;
        }

        button,
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 18px;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            cursor: pointer;
        }

        button {
            background: #f59e0b;
            color: white;
        }

        a {
            background: #ddd;
            color: #333;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>แก้ไขพนักงาน</h1>

    <form
        action="{{ route('employees.update', $employee) }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')

        <label>ชื่อพนักงาน</label>
        <input
            type="text"
            name="name"
            value="{{ $employee->name }}"
            required
        >

        <label>ตำแหน่ง</label>
        <input
            type="text"
            name="position"
            value="{{ $employee->position }}"
            required
        >

        <label>เงินเดือน</label>
        <input
            type="number"
            name="salary"
            value="{{ $employee->salary }}"
            step="0.01"
            min="0"
            required
        >

        <label>แผนก</label>
        <input
            type="text"
            name="department"
            value="{{ $employee->department }}"
            required
        >

        <label>รูปโปรไฟล์ใหม่</label>
        <input
            type="file"
            name="profile_image"
            accept="image/*"
        >

        @if ($employee->profile_image)
            <p>รูปปัจจุบัน:</p>
            <img
                src="{{ asset('storage/' . $employee->profile_image) }}"
                class="current-image"
                alt="{{ $employee->name }}"
            >
        @endif

        <br>

        <button type="submit">
            บันทึกการแก้ไข
        </button>

        <a href="{{ route('employees.index') }}">
            กลับ
        </a>

    </form>

</div>

</body>
</html>