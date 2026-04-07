<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --cms-pink-main: #ff758c;
            --cms-pink-hover: #ff5c77;
            --cms-pink-light: #ffe4e8;
            --cms-pink-text: #d6336c;
        }

        body { 
            background-color: #fff5f7 !important; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #4a4a4a;
        }
        
        /* SIDEBAR */
        .sidebar-pink { 
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%); 
            min-height: 100vh; 
            width: 260px; 
            box-shadow: 4px 0 15px rgba(255, 154, 158, 0.3); 
        }
        .brand-logo { font-size: 1.5rem; font-weight: 800; color: #fff; text-shadow: 1px 1px 3px rgba(0,0,0,0.1); }
        .nav-link.custom-link { color: rgba(255, 255, 255, 0.9); font-weight: 600; border-radius: 12px; margin-bottom: 8px; transition: 0.3s; padding: 12px 20px; }
        .nav-link.custom-link:hover { background: rgba(255, 255, 255, 0.25); color: #fff; transform: translateX(5px); }
        .nav-link.custom-link.active-pink { background: #fff; color: var(--cms-pink-main); box-shadow: 0 4px 10px rgba(0,0,0,0.08); }

        /* BẢNG BIỂU & CARD */
        .card { border-radius: 16px; border: none; box-shadow: 0 8px 20px rgba(255, 154, 158, 0.15); overflow: hidden; }
        .header-soft { background-color: var(--cms-pink-light) !important; color: var(--cms-pink-text) !important; font-weight: bold; border-bottom: 2px solid #ffb8c6; }
        .table-pink thead th { background-color: var(--cms-pink-light); color: var(--cms-pink-text); border-bottom: 2px solid #ffb8c6; }
        
        /* ĐÃ FIX LỖI LÓA CHỮ CHO BỘ ĐẾM */
        .badge-pink { 
            background-color: var(--cms-pink-text) !important; /* Đổi sang hồng đậm để tương phản tốt hơn */
            color: #ffffff !important; /* Bắt buộc chữ màu trắng */
            font-weight: bold;
        }

        /* NÚT BẤM */
        .btn-primary { background-color: var(--cms-pink-main) !important; border-color: var(--cms-pink-main) !important; border-radius: 10px; color: #fff !important; }
        .btn-primary:hover { background-color: var(--cms-pink-hover) !important; border-color: var(--cms-pink-hover) !important; }
        .btn-dark { background-color: var(--cms-pink-text) !important; border-color: var(--cms-pink-text) !important; border-radius: 10px; color: #fff !important; }
        .btn-dark:hover { background-color: #b02a58 !important; }
        .btn-secondary { background-color: #ffb8c6 !important; border-color: #ffb8c6 !important; color: #8a3f4b !important; border-radius: 10px; }
        .btn-secondary:hover { background-color: #ffa3b5 !important; }

        /* FORM */
        .form-control:focus, .form-select:focus { border-color: var(--cms-pink-main); box-shadow: 0 0 0 0.25rem rgba(255, 117, 140, 0.25); }
        h2 { color: var(--cms-pink-text); font-weight: 800; }
    </style>
</head>
<body>
    <div class="d-flex">
        <div class="sidebar-pink p-3 position-sticky top-0 h-100">
            <div class="text-center mb-4 pb-3 border-bottom border-light border-opacity-25">
                <div class="brand-logo"><i class="fa-solid fa-heart fa-beat text-white me-2"></i>CMS ADMIN</div>
            </div>
            <ul class="nav flex-column gap-1">
                <li class="nav-item"><a href="{{ route('dashboard') }}" class="nav-link custom-link {{ request()->is('/') ? 'active-pink' : '' }}"><i class="fa-solid fa-chart-pie me-2"></i>Dashboard</a></li>
                <li class="nav-item"><a href="{{ route('courses.index') }}" class="nav-link custom-link {{ request()->is('courses*') ? 'active-pink' : '' }}"><i class="fa-solid fa-book-open me-2"></i>Khóa học</a></li>
                <li class="nav-item"><a href="{{ route('lessons.index') }}" class="nav-link custom-link {{ request()->is('lessons*') ? 'active-pink' : '' }}"><i class="fa-solid fa-play-circle me-2"></i>Bài học</a></li>
                <li class="nav-item"><a href="{{ route('enrollments.index') }}" class="nav-link custom-link {{ request()->is('enrollments*') ? 'active-pink' : '' }}"><i class="fa-solid fa-users me-2"></i>Học viên Đăng ký</a></li>
            </ul>
        </div>
        <div class="p-4 w-100">
            @yield('content')
        </div>
    </div>
</body>
</html>