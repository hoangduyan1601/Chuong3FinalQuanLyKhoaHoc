<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elite Course Management System</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Playfair+Display:wght@700;900&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        :root {
            --bg-deep: #0B0C10;
            --bg-card: rgba(255, 255, 255, 0.03);
            --gold-gradient: linear-gradient(to right, #BF953F, #FCF6BA, #B38728, #FBF5B7, #AA771C);
            --gold-soft: #D4AF37;
            --text-main: #FFFFFF;
            --glass-border: rgba(191, 149, 63, 0.3);
        }

        body {
            background-color: var(--bg-deep);
            color: var(--text-main);
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }

        h1, h2, h3, .luxury-font {
            font-family: 'Playfair Display', serif;
            color: #FFFFFF !important;
            letter-spacing: 1px;
        }

        /* Glassmorphism Sidebar */
        .sidebar {
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(15px);
            border-right: 1px solid var(--glass-border);
            min-height: 100vh;
            position: fixed;
            z-index: 1000;
        }

        .nav-link {
            color: #FFFFFF !important;
            padding: 1rem 1.5rem;
            transition: all 0.4s ease;
            border-left: 3px solid transparent;
            font-weight: 500;
        }

        .nav-link:hover, .nav-link.active {
            background: rgba(191, 149, 63, 0.1);
            border-left: 3px solid var(--gold-soft);
            color: var(--gold-soft) !important;
            text-shadow: 0 0 10px rgba(191, 149, 63, 0.5);
        }

        /* Premium Cards */
        .card-luxury {
            background: var(--bg-card);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            color: #FFFFFF !important;
        }

        .card-luxury:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(176, 119, 28, 0.2);
            border-color: var(--gold-soft);
        }

        /* Glittering Gold Buttons */
        .btn-gold {
            background: var(--gold-gradient);
            background-size: 200% auto;
            border: none;
            color: #FFFFFF !important;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 0.6rem 1.5rem;
            border-radius: 50px;
            transition: 0.5s;
        }

        .btn-gold:hover {
            background-position: right center;
            box-shadow: 0 0 20px rgba(191, 149, 63, 0.6);
            transform: scale(1.05);
            color: #FFFFFF !important;
        }

        .btn-outline-gold {
            border: 1px solid var(--gold-soft);
            color: #FFFFFF !important;
            border-radius: 50px;
            transition: all 0.3s;
        }

        .btn-outline-gold:hover {
            background: var(--gold-gradient);
            color: #FFFFFF !important;
            box-shadow: 0 0 15px rgba(191, 149, 63, 0.4);
        }

        /* Table Styling */
        .table {
            color: #FFFFFF !important;
        }
        .table thead th {
            background: rgba(191, 149, 63, 0.1) !important;
            color: var(--gold-soft) !important;
            border-bottom: 2px solid var(--gold-soft);
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 1px;
        }
        .table td {
            border-bottom: 1px solid rgba(191, 149, 63, 0.1);
            background: transparent !important;
            padding: 1.2rem 0.75rem;
            color: #FFFFFF !important;
        }

        /* Forced White Text */
        .text-muted, .small, .text-secondary, label, .form-label, .fw-bold, .fs-5, .fs-6, span, p {
            color: #FFFFFF;
        }

        /* Keep gold-soft for specific highlights if needed, but the user asked for all text to be white.
           If they really want EVERYTHING white, we override gold-soft too.
           For now, I'll stick to making sure standard text is white. */
        
        .text-muted {
            color: rgba(255, 255, 255, 0.7) !important; /* Slightly transparent white for 'muted' effect but still white */
        }

        /* Inputs */
        .form-control, .form-select {
            background: rgba(255, 255, 255, 0.05) !important;
            border: 1px solid var(--glass-border) !important;
            color: #ffffff !important;
            border-radius: 10px;
        }
        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.5) !important;
        }

        main {
            padding: 2rem;
            margin-left: 16.666667%; /* Offset for col-md-2 */
        }

        @media (max-width: 768px) {
            main { margin-left: 0; }
            .sidebar { position: relative; min-height: auto; }
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-2 d-none d-md-block sidebar">
            <div class="pt-4 text-center mb-5">
                <h3 class="luxury-font px-2" style="font-size: 1.5rem;">ELITE CMS</h3>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="bi bi-grid-1x2-fill me-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('courses.*') ? 'active' : '' }}" href="{{ route('courses.index') }}">
                        <i class="bi bi-gem me-2"></i> Khóa học
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('lessons*') ? 'active' : '' }}" href="{{ route('lessons.index') }}">
                        <i class="bi bi-play-circle-fill me-2"></i> Bài học
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('enrollments*') ? 'active' : '' }}" href="{{ route('enrollments.index') }}">
                        <i class="bi bi-person-check-fill me-2"></i> Đăng ký
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main class="col-md-10">
            <x-alert />
            @yield('content')
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
