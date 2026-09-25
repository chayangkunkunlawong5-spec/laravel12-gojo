<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มพนักงาน</title>

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

        button, a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 18px;
            border: none;
            border-radius: 6px;
            text-decoration: none;
        }

        button {
            background: #4f46e5;
            color: white;
            cursor: pointer;
        }

        a {
            background: #ddd;
            color: #333;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>เพิ่มพนักงาน</h1>

    <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">

        @csrf

        <label>ชื่อพนักงาน</label>
        <input type="text" name="name" required>

        <label>ตำแหน่ง</label>
        <input type="text" name="position" required>

        <label>เงินเดือน</label>
        <input type="number" name="salary" step="0.01" min="0" required>

        <label>แผนก</label>
        <input type="text" name="department" required>

        <label>รูปโปรไฟล์</label>
        <input type="file" name="profile_image" accept="image/*">

        <button type="submit">บันทึกพนักงาน</button>

        <a href="{{ route('employees.index') }}">กลับ</a>

    </form>

</div>

</body>
</html>