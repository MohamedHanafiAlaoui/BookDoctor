<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Patient - BookDoctor</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --primary: #4f46e5;
            --primary-dark: #4338ca;
            --secondary: #7c3aed;
            --light: #f9fafb;
            --dark: #1f2937;
            --gray: #6b7280;
            --light-gray: #e5e7eb;
            --notification: #ef4444;
            --success: #10b981;
            --error: #ef4444;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f3f4f6;
            color: var(--dark);
            min-height: 100vh;
        }
        
        /* Header */
        header {
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .header-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 70px;
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }
        
        .logo-icon {
            color: var(--primary);
            font-size: 24px;
        }
        
        .logo-text {
            font-size: 22px;
            font-weight: 700;
            color: var(--primary);
        }
        
        nav ul {
            display: flex;
            list-style: none;
            gap: 30px;
        }
        
        nav a {
            text-decoration: none;
            color: var(--gray);
            font-weight: 500;
            position: relative;
            padding: 25px 0;
            transition: color 0.3s;
        }
        
        nav a:hover, nav a.active {
            color: var(--primary);
        }
        
        nav a.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--primary);
            border-radius: 3px 3px 0 0;
        }
        
        .header-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        /* Notification */
        .notification-container {
            position: relative;
            display: flex;
            align-items: center;
        }
        
        .notification-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: none;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            transition: background 0.3s;
        }
        
        .notification-btn:hover {
            background: var(--light-gray);
        }
        
        .notification-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background: var(--notification);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 600;
        }
        
        .notification-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            width: 320px;
            max-height: 400px;
            overflow-y: auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
            padding: 10px 0;
            margin-top: 10px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.3s ease;
            z-index: 200;
        }
        
        .notification-container:hover .notification-dropdown,
        .notification-container.active .notification-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        .notification-header {
            padding: 12px 16px;
            border-bottom: 1px solid var(--light-gray);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .notification-header h3 {
            font-size: 16px;
            font-weight: 600;
            color: var(--dark);
        }
        
        .mark-read {
            background: none;
            border: none;
            color: var(--primary);
            font-size: 14px;
            cursor: pointer;
            font-weight: 500;
        }
        
        .notification-list {
            list-style: none;
        }
        
        .notification-item {
            padding: 12px 16px;
            display: flex;
            gap: 12px;
            cursor: pointer;
            transition: background 0.2s;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .notification-item:last-child {
            border-bottom: none;
        }
        
        .notification-item:hover {
            background: #f8f9ff;
        }
        
        .notification-item.unread {
            background: #f0f5ff;
        }
        
        .notification-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #eef2ff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 16px;
            flex-shrink: 0;
        }
        
        .notification-content {
            flex: 1;
        }
        
        .notification-title {
            font-weight: 600;
            margin-bottom: 3px;
            color: var(--dark);
        }
        
        .notification-desc {
            font-size: 14px;
            color: var(--gray);
            line-height: 1.4;
        }
        
        .notification-time {
            font-size: 12px;
            color: var(--gray);
            margin-top: 5px;
        }
        
        /* Profile dropdown */
        .profile-container {
            position: relative;
        }
        
        .profile-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 5px;
            border-radius: 50px;
            transition: background 0.3s;
        }
        
        .profile-btn:hover {
            background: var(--light-gray);
        }
        
        .profile-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--primary);
        }
        
        .profile-name {
            font-weight: 500;
            font-size: 15px;
            display: none;
        }
        
        .profile-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            width: 220px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
            padding: 10px 0;
            margin-top: 10px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.3s ease;
            z-index: 200;
        }
        
        .profile-container:hover .profile-dropdown,
        .profile-container.active .profile-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        .dropdown-header {
            padding: 12px 16px;
            border-bottom: 1px solid var(--light-gray);
        }
        
        .dropdown-header h3 {
            font-size: 16px;
            font-weight: 600;
            color: var(--dark);
        }
        
        .dropdown-header p {
            font-size: 14px;
            color: var(--gray);
            margin-top: 3px;
        }
        
        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            text-decoration: none;
            color: var(--dark);
            transition: background 0.2s;
        }
        
        .dropdown-item:hover {
            background: #f0f5ff;
        }
        
        .dropdown-item i {
            width: 20px;
            text-align: center;
            color: var(--primary);
        }
        
        .dropdown-divider {
            height: 1px;
            background: var(--light-gray);
            margin: 5px 0;
        }
        
        /* Hamburger menu */
        .hamburger {
            display: none;
            flex-direction: column;
            justify-content: space-around;
            width: 30px;
            height: 25px;
            background: transparent;
            border: none;
            cursor: pointer;
            padding: 0;
            z-index: 10;
        }
        
        .hamburger span {
            width: 100%;
            height: 3px;
            background: var(--primary);
            border-radius: 3px;
            transition: all 0.3s linear;
            position: relative;
            transform-origin: 1px;
        }
        
        .mobile-nav {
            position: fixed;
            top: 70px;
            right: -100%;
            width: 280px;
            height: calc(100vh - 70px);
            background: white;
            box-shadow: -5px 0 15px rgba(0, 0, 0, 0.1);
            transition: right 0.3s ease;
            z-index: 150;
            overflow-y: auto;
            padding: 20px 0;
        }
        
        .mobile-nav.active {
            right: 0;
        }
        
        .mobile-nav ul {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 0;
        }
        
        .mobile-nav li {
            width: 100%;
        }
        
        .mobile-nav a {
            display: block;
            padding: 15px 25px;
            text-decoration: none;
            color: var(--dark);
            font-weight: 500;
            transition: background 0.3s;
        }
        
        .mobile-nav a:hover, .mobile-nav a.active {
            background: #f0f5ff;
            color: var(--primary);
        }
        
        .mobile-nav a.active {
            border-left: 4px solid var(--primary);
        }
        
        /* Main content */
        .main-container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }
        
        .dashboard-title {
            font-size: 28px;
            margin-bottom: 30px;
            color: var(--dark);
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s, box-shadow 0.3s;
            border-left: 4px solid var(--primary);
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }
        
        .stat-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
        }
        
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: #eef2ff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 20px;
        }
        
        .stat-title {
            font-size: 16px;
            color: var(--gray);
        }
        
        .stat-value {
            font-size: 24px;
            font-weight: 700;
            color: var(--dark);
        }
        
        .stat-desc {
            font-size: 14px;
            color: var(--gray);
            margin-top: 5px;
        }
        
        /* Layout */
        .content-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 25px;
        }
        
        @media (min-width: 992px) {
            .content-grid {
                grid-template-columns: 2fr 1fr;
            }
        }
        
        .panel {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }
        
        .panel-header {
            padding: 18px 20px;
            border-bottom: 1px solid var(--light-gray);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .panel-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--dark);
        }
        
        .panel-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .appointment-list {
            padding: 10px 0;
        }
        
        .appointment-item {
            padding: 15px 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            border-bottom: 1px solid var(--light-gray);
            transition: background 0.2s;
        }
        
        .appointment-item:last-child {
            border-bottom: none;
        }
        
        .appointment-item:hover {
            background: #f9fafb;
        }
        
        .appointment-icon {
            width: 45px;
            height: 45px;
            border-radius: 10px;
            background: #f0f5ff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 18px;
            flex-shrink: 0;
        }
        
        .appointment-details {
            flex: 1;
        }
        
        .appointment-title {
            font-weight: 600;
            margin-bottom: 3px;
            color: var(--dark);
        }
        
        .appointment-meta {
            display: flex;
            gap: 15px;
            color: var(--gray);
            font-size: 14px;
        }
        
        .appointment-meta i {
            margin-right: 5px;
        }
        
        .appointment-status {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
        }
        
        .status-confirmed {
            background: #dcfce7;
            color: #166534;
        }
        
        .status-pending {
            background: #fef9c3;
            color: #854d0e;
        }
        
        /* Documents */
        .documents-list {
            padding: 10px 0;
        }
        
        .document-item {
            padding: 15px 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            border-bottom: 1px solid var(--light-gray);
        }
        
        .document-item:last-child {
            border-bottom: none;
        }
        
        .document-icon {
            width: 45px;
            height: 45px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }
        
        .pdf-icon {
            background: #fee2e2;
            color: #dc2626;
        }
        
        .doc-icon {
            background: #dcfce7;
            color: #166534;
        }
        
        .doc-details {
            flex: 1;
        }
        
        .doc-title {
            font-weight: 500;
            color: var(--dark);
            margin-bottom: 3px;
        }
        
        .doc-date {
            color: var(--gray);
            font-size: 14px;
        }
        
        .doc-download {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--light);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            cursor: pointer;
            transition: background 0.2s;
        }
        
        .doc-download:hover {
            background: #eef2ff;
        }
        
        /* Footer */
        footer {
            background: white;
            border-top: 1px solid var(--light-gray);
            padding: 30px 0;
            margin-top: 50px;
        }
        
        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }
        
        .footer-logo {
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }
        
        .footer-text {
            color: var(--gray);
            font-size: 15px;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            nav {
                display: none;
            }
            
            .hamburger {
                display: flex;
                margin-right: 15px;
            }
            
            .profile-name {
                display: block;
            }
            
            .notification-dropdown {
                width: 280px;
                right: -10px;
            }
        }
        
        @media (max-width: 480px) {
            .header-actions {
                gap: 10px;
            }
            
            .logo-text {
                font-size: 18px;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
        
        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .fade-in {
            animation: fadeIn 0.4s ease forwards;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
        
        .pulse {
            animation: pulse 1.5s infinite;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }
        
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--dark);
        }
        
        .form-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            background-color: white;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            font-size: 1rem;
        }
        
        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: background-color 0.15s ease-in-out;
            font-size: 1rem;
        }
        
        .btn-primary {
            background-color: var(--primary);
            color: white;
            border: none;
        }
        
        .btn-primary:hover {
            background-color: var(--primary-dark);
        }
        
        .grid {
            display: grid;
        }
        
        .gap-6 {
            gap: 1.5rem;
        }
        
        .grid-cols-1 {
            grid-template-columns: repeat(1, minmax(0, 1fr));
        }
        
        .md\:grid-cols-2 {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
        
        .md\:col-span-2 {
            grid-column: span 2 / span 2;
        }
        
        .justify-end {
            justify-content: flex-end;
        }
        
        .flex {
            display: flex;
        }
        
        .mt-8 {
            margin-top: 2rem;
        }
        
        .mr-2 {
            margin-right: 0.5rem;
        }
        
        .bg-white {
            background-color: white;
        }
        
        .rounded-xl {
            border-radius: 0.75rem;
        }
        
        .shadow-sm {
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }
        
        .overflow-hidden {
            overflow: hidden;
        }
        
        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }
        
        .py-4 {
            padding-top: 1rem;
            padding-bottom: 1rem;
        }
        
        .border-b {
            border-bottom-width: 1px;
        }
        
        .border-gray-200 {
            border-color: #e5e7eb;
        }
        
        .p-6 {
            padding: 1.5rem;
        }
        
        .text-lg {
            font-size: 1.125rem;
            line-height: 1.75rem;
        }
        
        .font-medium {
            font-weight: 500;
        }
        
        .text-gray-900 {
            color: #111827;
        }
        
        .error-message {
            color: var(--error);
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: none;
        }
        
        .success-message {
            background-color: #dcfce7;
            color: #166534;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .required-label::after {
            content: " *";
            color: var(--error);
        }
        
        .form-section-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid var(--light-gray);
        }
        
        /* Patient info badge */
        .patient-badge {
            display: inline-flex;
            align-items: center;
            background-color: #eef2ff;
            color: var(--primary);
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="header-container">
            <a href="#" class="logo">
                <i class="fas fa-heartbeat logo-icon"></i>
                <span class="logo-text">BookDoctor</span>
            </a>
            
            <button class="hamburger" id="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </button>
            
            <nav>
                <ul>
                    <li><a href="#" class="active">Accueil</a></li>
                    <li><a href="#">Mes rendez-vous</a></li>
                    <li><a href="#">Historique médical</a></li>
                    <li><a href="#">Documents</a></li>
                </ul>
            </nav>
            
            <div class="header-actions">
                <!-- Profile container -->
                <div class="profile-container" id="profileContainer">
                    <button class="profile-btn" id="profileBtn">
                        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" 
                             alt="Photo de profil" class="profile-img">
                        <span class="profile-name" id="profileName">Marie D.</span>
                    </button>
                    
                    <div class="profile-dropdown fade-in">
                        <div class="dropdown-header">
                            <h3 id="profileFullName">Marie Dupont</h3>
                            <p id="profileEmail">marie.dupont@example.com</p>
                        </div>
                        
                        <a href="#" class="dropdown-item" id="profileLink">
                            <i class="fas fa-user"></i>
                            <span>Mon Profil</span>
                        </a>
                        
                        <a href="#" class="dropdown-item" id="editLink">
                            <i class="fas fa-edit"></i>
                            <span>Modifier le profil</span>
                        </a>
                        
                        <a href="#" class="dropdown-item" id="settingsLink">
                            <i class="fas fa-cog"></i>
                            <span>Paramètres</span>
                        </a>
                        
                        <div class="dropdown-divider"></div>
                        
                        <a href="#" class="dropdown-item" id="logoutLink">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Déconnexion</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Mobile navigation -->
        <div class="mobile-nav" id="mobileNav">
            <ul>
                <li><a href="#" class="active">Accueil</a></li>
                <li><a href="#">Mes rendez-vous</a></li>
                <li><a href="#">Historique médical</a></li>
                <li><a href="#">Documents</a></li>
                <li><a href="#">Messages</a></li>
                <li><a href="#">Paramètres</a></li>
                <li><a href="#">Aide</a></li>
            </ul>
        </div>
    </header>

            <main class="main-container">
        <h1 class="dashboard-title">Mon Profil</h1>
        
        <!-- Success Message -->
        @if(session('success'))
            <div class="success-message">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif
        
        <!-- Updated Profile Section -->
        <div id="personal-tab" class="tab-content">
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-900">Informations personnelles</h2>
                </div>
                <div class="p-6">
                    <form id="patientProfileForm" method="POST" action="{{ route('patients.profil.update') }}">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="form-group">
                                <label class="form-label required-label">Nom complet</label>
                                <input type="text" class="form-input" name="full_name" id="full_name" value="{{ $user->full_name }}" required>
                                <div class="error-message" id="full_name_error"></div>
                            </div>
                            <div class="form-group">
                                <label class="form-label required-label">Adresse email</label>
                                <input type="email" class="form-input" name="email" id="email" value="{{ $user->email }}" required>
                                <div class="error-message" id="email_error"></div>
                            </div>
                            <div class="form-group">
                                <label class="form-label required-label">Téléphone</label>
                                <input type="tel" class="form-input" name="number_phone" id="number_phone" value="{{ $user->number_phone }}" required>
                                <div class="error-message" id="number_phone_error"></div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Groupe sanguin</label>
                                <select class="form-input" name="groupe_sanguin" id="groupe_sanguin">
                                    <option value="">Sélectionner</option>
                                    @php
                                        $bloodGroups = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
                                    @endphp
                                    @foreach($bloodGroups as $group)
                                        <option value="{{ $group }}" {{ $user->patient->groupe_sanguin == $group ? 'selected' : '' }}>{{ $group }}</option>
                                    @endforeach
                                </select>
                                <div class="patient-badge">Patient enregistré</div>
                                <div class="error-message" id="groupe_sanguin_error"></div>
                            </div>
                            <div class="form-group md:col-span-2">
                                <label class="form-label">Adresse</label>
                                <input type="text" class="form-input" name="adresse" id="adresse" value="{{ $user->patient->adresse }}">
                                <div class="error-message" id="adresse_error"></div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Code postal</label>
                                <input type="text" class="form-input" name="code_postal" id="code_postal" value="{{ $user->patient->code_postal }}">
                                <div class="error-message" id="code_postal_error"></div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Ville</label>
                                <input type="text" class="form-input" name="ville" id="ville" value="{{ $user->patient->ville }}">
                                <div class="error-message" id="ville_error"></div>
                            </div>
                            <div class="form-group md:col-span-2">
                                <label class="form-label">Allergies</label>
                                <textarea class="form-input" name="allergies" id="allergies" rows="3">{{ $user->patient->allergies }}</textarea>
                                <div class="error-message" id="allergies_error"></div>
                            </div>
                            <div class="form-group md:col-span-2">
                                <label class="form-label">Antécédents médicaux</label>
                                <textarea class="form-input" name="medical_history" id="medical_history" rows="5">{{ $user->patient->medical_history }}</textarea>
                                <div class="error-message" id="medical_history_error"></div>
                            </div>
                        </div>
                        <div class="mt-8 flex justify-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-2"></i> Enregistrer les modifications
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <a href="#" class="footer-logo">
                <i class="fas fa-heartbeat"></i>
                <span class="logo-text">BookDoctor</span>
            </a>
            <p class="footer-text">&copy; 2023 BookDoctor. Tous droits réservés.</p>
        </div>
    </footer>

     <script>
        // Form validation and submission
        const patientProfileForm = document.getElementById('patientProfileForm');
        
        patientProfileForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Reset error messages
            const errorMessages = document.querySelectorAll('.error-message');
            errorMessages.forEach(el => {
                el.style.display = 'none';
                el.textContent = '';
            });
            
            // Get form values
            const fullName = document.getElementById('full_name').value;
            const email = document.getElementById('email').value;
            const phone = document.getElementById('number_phone').value;
            const bloodGroup = document.getElementById('groupe_sanguin').value;
            const address = document.getElementById('adresse').value;
            const postalCode = document.getElementById('code_postal').value;
            const city = document.getElementById('ville').value;
            const allergies = document.getElementById('allergies').value;
            const medicalHistory = document.getElementById('medical_history').value;
            
            let isValid = true;
            
            // Validate full name
            if (!fullName.trim()) {
                showError('full_name_error', 'Le nom complet est requis.');
                isValid = false;
            } else if (fullName.length > 255) {
                showError('full_name_error', 'Le nom complet ne doit pas dépasser 255 caractères.');
                isValid = false;
            }
            
            // Validate email
            if (!email.trim()) {
                showError('email_error', 'L\'adresse email est requise.');
                isValid = false;
            } else if (!isValidEmail(email)) {
                showError('email_error', 'Veuillez saisir une adresse email valide.');
                isValid = false;
            }
            
            // Validate phone number
            if (!phone.trim()) {
                showError('number_phone_error', 'Le numéro de téléphone est requis.');
                isValid = false;
            } else if (phone.length > 20) {
                showError('number_phone_error', 'Le numéro de téléphone ne doit pas dépasser 20 caractères.');
                isValid = false;
            }
            
            // Validate blood group if provided
            if (bloodGroup && bloodGroup.length > 10) {
                showError('groupe_sanguin_error', 'Le groupe sanguin ne doit pas dépasser 10 caractères.');
                isValid = false;
            }
            
            // Validate address if provided
            if (address && address.length > 255) {
                showError('adresse_error', 'L\'adresse ne doit pas dépasser 255 caractères.');
                isValid = false;
            }
            
            // Validate postal code if provided
            if (postalCode && postalCode.length > 10) {
                showError('code_postal_error', 'Le code postal ne doit pas dépasser 10 caractères.');
                isValid = false;
            }
            
            // Validate city if provided
            if (city && city.length > 100) {
                showError('ville_error', 'La ville ne doit pas dépasser 100 caractères.');
                isValid = false;
            }
            
            // Validate allergies if provided
            if (allergies && allergies.length > 255) {
                showError('allergies_error', 'Les allergies ne doivent pas dépasser 255 caractères.');
                isValid = false;
            }
            
            // Validate medical history if provided
            if (medicalHistory && medicalHistory.length > 2000) {
                showError('medical_history_error', 'Les antécédents médicaux ne doivent pas dépasser 2000 caractères.');
                isValid = false;
            }
            
            if (isValid) {
                // Submit the form
                this.submit();
            }
        });
        
        function showError(elementId, message) {
            const errorElement = document.getElementById(elementId);
            errorElement.textContent = message;
            errorElement.style.display = 'block';
        }
        
        function isValidEmail(email) {
            const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email.toLowerCase());
        }
        
        // Handle logout
        document.getElementById('logoutLink').addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Déconnexion',
                text: 'Vous avez été déconnecté avec succès',
                icon: 'success',
                confirmButtonColor: '#4f46e5'
            }).then(() => {
                // Redirection vers la page de connexion
                window.location.href = '/login';
            });
        });
        
        // Handle profile edit link
        document.getElementById('editLink').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('patientProfileForm').scrollIntoView({
                behavior: 'smooth'
            });
        });
    </script>

</body>
</html>