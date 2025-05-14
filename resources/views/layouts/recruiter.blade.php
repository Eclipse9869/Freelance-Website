<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>myFreelance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/project.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #fff;
        }

        .navbar-custom {
            background-color: #4B007D;
            color: white;
            padding: 1.5rem 2rem;
        }

        .navbar-custom .brand {
            font-weight: bold;
            font-size: 32px;
            color: white;
        }

        .navbar-custom .brand {
            color: white;
        }

        .orange {
            color: #FF7F00;
        }

        .white-bold {
            color: white;
            font-weight: bold;
        }

        .brand-wrapper {
            position: relative;
            display: inline-block;
        }

        .brand {
            font-weight: bold;
            font-size: 32px;
        }

        .recruiter-label {
            position: absolute;
            right: 0;
            bottom: -10px;
            font-size: 14px;
            font-weight: 400;
            color: #DCAEFF;
        }

        .btn-orange {
            background-color: #FF4500;
            color: white;
            border: none;
            padding: 0.6rem 1.4rem;
            font-size: 18px;
            border-radius: 25px;
            font-weight: 500;
        }

        .search-container {
            margin: 3rem auto;
            max-width: 700px;
            background-color: #ddd;
            border-radius: 15px;
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            font-size: 18px;
        }

        .search-container input {
            border: none;
            background: transparent;
            outline: none;
            width: 100%;
            color: #800080;
            font-weight: 500;
        }

        .search-container i {
            color: #FF4500;
            margin-right: 15px;
            font-size: 20px;
        }

        .category-wrapper {
            padding: 2rem 3rem;
        }

        .category-item {
            text-align: center;
            margin-bottom: 3rem;
        }

        .circle-logo {
            width: 120px;
            height: 120px;
            border: 3px solid #4B007D;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto;
            color: #FF4500;
            font-size: 18px;
            font-weight: bold;
        }

        .category-label {
            margin-top: 1rem;
            font-size: 16px;
            font-weight: 500;
        }

        @media (max-width: 576px) {
            .navbar-custom .brand {
                font-size: 24px;
            }

            .btn-orange {
                font-size: 16px;
                padding: 0.4rem 1rem;
            }

            .circle-logo {
                width: 90px;
                height: 90px;
                font-size: 14px;
            }

            .search-container {
                padding: 0.8rem 1rem;
                font-size: 16px;
            }
        }

        .btn-purple {
            background-color: #4B007D;
            color: white;
            border: none;
            padding: 0.6rem 1.4rem;
            border-radius: 10px;
            font-size: 18px;
            font-weight: 500;
        }

        .logo-box {
            background-color: white;
            font-weight: bold;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar-custom d-flex justify-content-between align-items-center">
        <a href="{{ route('dashboard-recruiter') }}">
            <!-- <span class="orange">my</span><span class="white-bold">Freelance</span> -->
            <div class="brand-wrapper position-relative">
                <div class="brand">
                    <span class="orange">my</span><span class="white-bold">Freelance</span>
                </div>
                <div class="recruiter-label">Recruiter</div>
            </div>
        </a>
        <div class="d-flex align-items-center">
            <a href="{{ route('projects.create') }}" class="btn btn-orange me-3">Open Recruitment</a>

            @if (Auth::check())
                <!-- User Dropdown -->
                <div class="dropdown">
                    <button class="btn btn-outline-light dropdown-toggle d-flex align-items-center" type="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                        <!-- Profile Picture -->
                        <!-- <img src="{{ Auth::user()->profile_pic ? asset('storage/' . Auth::user()->profile_pic) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}" alt="Profile" class="rounded-circle me-2" width="32" height="32"> -->
                        <img src="{{ Auth::user()->profile_pic ? asset('storage/' . Auth::user()->profile_pic) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}" 
                        alt="Profile" 
                        style="width: 32px; height: 32px; object-fit: cover; border-radius: 50%; display: block;" 
                        class="me-2">
                        {{ Auth::user()->username }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                        <!-- <li><a class="dropdown-item" href="{{ route('logout') }}">My Project</a></li> -->
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Edit Profile</a></li>
                        <li><a class="dropdown-item" href="{{ route('job') }}">All Job</a></li>
                        <li><a class="dropdown-item" href="{{ route('dashboard') }}">As Applicant</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Log Out</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn btn-orange">Login / Register</a>
            @endif
        </div>
    </div>
    @yield('content')
</body>
</html>