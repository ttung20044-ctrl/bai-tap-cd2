<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Management System</title>
    <style>
        body { display: flex; font-family: Arial, sans-serif; margin: 0; background: #f9f9f9; }
        .sidebar { width: 220px; background: #343a40; padding: 20px; height: 100vh; position: fixed; color: white; }
        .sidebar h3 { text-align: center; border-bottom: 1px solid #4f5962; padding-bottom: 10px; }
        .sidebar a { display: block; padding: 12px; text-decoration: none; color: #c2c7d0; margin-bottom: 5px; border-radius: 4px; }
        .sidebar a:hover { background: #4f5962; color: white; }
        .main-content { margin-left: 260px; padding: 30px; width: calc(100% - 260px); }
    </style>
</head>
<body>
    <div class="sidebar">
        <h3>Hệ Thống <br> Quản Lý</h3>
        <a href="{{ route('dashboard') }}">📊 Dashboard</a>
        <a href="{{ route('courses.index') }}">📚 Khóa Học (Courses)</a>
        <a href="{{ route('enrollments.index') }}">👥 Đăng Ký (Enrollments)</a>
    </div>

    <div class="main-content">
        <x-alert />
        
        @yield('content')
    </div>
</body>
</html>