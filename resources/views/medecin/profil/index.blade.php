<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Médecin - BookDoctor</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            --warning: #f59e0b;
            --success: #10b981;
        }

        .profile-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        }

        .stat-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-left: 4px solid var(--primary);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .appointment-card {
            border-left: 4px solid var(--primary);
        }

        .history-card {
            border-top: 3px solid var(--primary);
        }

        .avatar-upload {
            position: relative;
            display: inline-block;
        }

        .avatar-upload input {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            opacity: 0;
            cursor: pointer;
        }

        .edit-icon {
            position: absolute;
            bottom: 5px;
            right: 5px;
            background: white;
            border-radius: 50%;
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .tabs .tab {
            position: relative;
            padding-bottom: 8px;
            cursor: pointer;
        }

        .tabs .tab.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--primary);
            border-radius: 3px;
        }

        .purchase-banner {
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(79, 70, 229, 0.3);
            transition: transform 0.3s ease;
        }

        .purchase-banner:hover {
            transform: translateY(-3px);
        }

        .purchase-banner .pulse {
            animation: pulse 2s infinite;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }

        @keyframes pulse {
            0% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(79, 70, 229, 0.7);
            }

            70% {
                transform: scale(1);
                box-shadow: 0 0 0 12px rgba(79, 70, 229, 0);
            }

            100% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(79, 70, 229, 0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: var(--notification);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            font-weight: bold;
            animation: pulse-badge 1.5s infinite;
        }

        .notification-panel {
            position: absolute;
            top: 100%;
            right: 0;
            width: 350px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            max-height: 400px;
            overflow-y: auto;
            display: none;
        }

        .notification-item {
            padding: 15px;
            border-bottom: 1px solid #f1f1f1;
            cursor: pointer;
            transition: background 0.2s;
        }

        .notification-item:hover {
            background: #f9fafb;
        }

        .notification-item.unread {
            background: #f0f9ff;
        }

        .notification-time {
            font-size: 0.75rem;
            color: #6b7280;
        }

        @keyframes pulse-badge {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
            }
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #374151;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            background-color: #f9fafb;
            transition: border-color 0.2s;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 0.375rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
            border: none;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
        }

        .calendar-day {
            height: 80px;
            border: 1px solid #e5e7eb;
            padding: 4px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .calendar-day:hover {
            background-color: #f0fdfa;
        }

        .calendar-day.today {
            background-color: #e0e7ff;
        }

        .calendar-day.appointment {
            background-color: #c7d2fe;
        }

        .calendar-day.appointment:hover {
            background-color: #a5b4fc;
        }

        .patient-card {
            border-left: 3px solid var(--primary);
            transition: transform 0.2s;
        }

        .patient-card:hover {
            transform: translateX(5px);
        }

        .rating-stars {
            color: #f59e0b;
        }

        .availability-time {
            display: inline-block;
            padding: 4px 8px;
            margin: 4px;
            background-color: #e0e7ff;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .availability-time:hover {
            background-color: var(--primary);
            color: white;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        @media (min-width: 1024px) {
            .dashboard-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        .sidebar {
            background-color: #f9fafb;
            border-radius: 0.75rem;
            padding: 1.5rem;
            height: fit-content;
        }

        .main-content {
            grid-column: 1 / -1;
        }

        .chart-container {
            height: 300px;
            position: relative;
        }

        .quick-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1rem;
        }

        .quick-stat {
            background-color: white;
            border-radius: 0.75rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        /* Header styles */
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

        nav a:hover,
        nav a.active {
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
            background-color: #e0e7ff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-weight: bold;
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

        .mobile-nav a:hover,
        .mobile-nav a.active {
            background: #f0f5ff;
            color: var(--primary);
        }

        .mobile-nav a.active {
            border-left: 4px solid var(--primary);
        }

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

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.4s ease forwards;
        }

        .doctor-info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .info-card {
            background: white;
            border-radius: 0.75rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .info-card h3 {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .info-card ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .info-card li {
            padding: 0.75rem 0;
            border-bottom: 1px solid #f1f1f1;
            display: flex;
            align-items: center;
        }

        .info-card li:last-child {
            border-bottom: none;
        }

        .info-card .label {
            font-weight: 500;
            color: var(--dark);
            min-width: 140px;
        }

        .info-card .value {
            color: var(--gray);
        }

        .specialty-badge {
            background-color: #e0e7ff;
            color: var(--primary);
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .data-null {
            color: var(--warning);
            font-style: italic;
        }

        .placeholder-text {
            color: #9ca3af;
            font-style: italic;
        }

        .avatar-placeholder {
            background: #e0e7ff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-weight: bold;
            font-size: 3rem;
        }

        .no-data {
            text-align: center;
            padding: 2rem;
            color: #6b7280;
        }

        .no-data i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #d1d5db;
        }

        .appointment-badge {
            background-color: #e0f2fe;
            color: #0ea5e9;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .patient-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #e0e7ff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-weight: bold;
            margin-right: 12px;
        }

        .patient-info {
            flex: 1;
        }

        .appointment-item {
            display: flex;
            align-items: center;
            padding: 16px;
            border-bottom: 1px solid #f1f1f1;
            transition: background-color 0.2s;
        }

        .appointment-item:hover {
            background-color: #f9fafb;
        }

        .appointment-time {
            min-width: 80px;
            text-align: center;
            font-weight: 500;
            color: var(--primary);
        }

        .appointment-action {
            margin-left: auto;
        }

        .stats-chart {
            height: 200px;
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.1) 0%, rgba(67, 56, 202, 0.1) 100%);
            border-radius: 8px;
            margin: 20px 0;
            display: flex;
            align-items: flex-end;
            justify-content: space-around;
            padding: 0 20px;
        }

        .chart-bar {
            width: 40px;
            background: linear-gradient(to top, var(--primary) 0%, var(--secondary) 100%);
            border-radius: 4px 4px 0 0;
            position: relative;
        }

        .chart-label {
            position: absolute;
            bottom: -25px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 0.75rem;
            color: var(--gray);
        }

        .stats-summary {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }

        .stat-item {
            text-align: center;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
        }

        .stat-label {
            font-size: 0.875rem;
            color: var(--gray);
        }

        /* Nouveaux styles pour la section combinée */
        .combined-section {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        @media (min-width: 1024px) {
            .combined-section {
                grid-template-columns: 1fr 1fr;
            }
        }

        .section-header {
            background-color: white;
            border-radius: 0.75rem 0.75rem 0 0;
            padding: 1.5rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .section-content {
            padding: 1.5rem;
            background-color: white;
            border-radius: 0 0 0.75rem 0.75rem;
        }

        .section-card {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border-radius: 0.75rem;
            overflow: hidden;
            height: 100%;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen">
    <!-- Header de navigation -->
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
                    <li><a href="#" class="active">Aperçu</a></li>
                    <li><a href="#">Mon agenda</a></li>
                    <li><a href="#">Mes patients</a></li>
                    <li><a href="#">Documents</a></li>
                </ul>
            </nav>

            <div class="header-actions">
                <div class="notification-container" id="notificationContainer">
                    <button class="notification-btn" id="notificationBtn">
                        <i class="far fa-bell"></i>
                        <span class="notification-count" id="notificationCount">3</span>
                    </button>

                    <div class="notification-dropdown fade-in">
                        <div class="notification-header">
                            <h3>Notifications</h3>
                            <button class="mark-read" id="markReadBtn">Tout marquer comme lu</button>
                        </div>

                        <ul class="notification-list">
                            <li class="notification-item unread">
                                <div class="notification-icon">
                                    <i class="fas fa-calendar-check"></i>
                                </div>
                                <div class="notification-content">
                                    <div class="notification-title">Nouveau rendez-vous</div>
                                    <div class="notification-desc">M. Dupont a réservé un rendez-vous pour demain à
                                        14h30</div>
                                    <div class="notification-time">Il y a 10 min</div>
                                </div>
                            </li>
                            <li class="notification-item unread">
                                <div class="notification-icon">
                                    <i class="fas fa-file-medical"></i>
                                </div>
                                <div class="notification-content">
                                    <div class="notification-title">Document signé</div>
                                    <div class="notification-desc">Le consentement éclairé de M. Martin est signé</div>
                                    <div class="notification-time">Il y a 2 heures</div>
                                </div>
                            </li>
                            <li class="notification-item">
                                <div class="notification-icon">
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="notification-content">
                                    <div class="notification-title">Nouvel avis</div>
                                    <div class="notification-desc">Mme Dubois a laissé un avis sur votre consultation
                                    </div>
                                    <div class="notification-time">Hier à 18h45</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Profile container -->
                <div class="profile-container" id="profileContainer">
                    <button class="profile-btn" id="profileBtn">
                        <div class="profile-img avatar-placeholder">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <span class="profile-name">Dr. Dupont</span>
                    </button>

                    <div class="profile-dropdown fade-in">
                        <div class="dropdown-header">
                            <h3>Dr. Dupont</h3>
                            <p>
                                Cardiologue
                            </p>
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

                        <a href="/logout" class="dropdown-item" id="logoutLink">
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
                <li><a href="#" class="active">Aperçu</a></li>
                <li><a href="#">Mon agenda</a></li>
                <li><a href="#">Mes patients</a></li>
                <li><a href="#">Documents</a></li>
                <li><a href="#">Paramètres</a></li>
                <li><a href="#">Aide</a></li>
            </ul>
        </div>
    </header>

    <!-- En-tête du profil -->
    <div class="profile-header py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center">
                <div class="avatar-upload relative mr-6 mb-6 md:mb-0">
                    <div class="h-32 w-32 rounded-full border-4 border-white shadow-lg avatar-placeholder">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <div class="edit-icon">
                        <i class="fas fa-pencil-alt text-indigo-600 text-sm"></i>
                    </div>
                    <input type="file" id="avatar" name="avatar" accept="image/*">
                </div>
                <div class="text-center md:text-left">
                    <h1 class="text-3xl font-bold text-white">Dr. {{ $user->full_name }}</h1>
                    <p class="mt-2 text-indigo-100">
                        <i class="fas fa-stethoscope mr-2"></i>
                        <span>
                            {{ $user->medecin->specialite->name ?? 'Spécialité non renseignée' }}
                        </span>
                        <span class="mx-3">|</span>
                        <i class="fas fa-hospital mr-2"></i>
                        <span>
                            {{ $user->medecin->etablissement ?? 'Établissement non spécifié' }}
                        </span>
                    </p>
                    <div class="mt-4 flex flex-wrap justify-center md:justify-start gap-3">
                        <div
                            class="flex items-center px-3 py-1 bg-indigo-800 bg-opacity-50 text-white rounded-full text-sm">
                            <i class="fas fa-star mr-1"></i>
                            <span>4.8/5 (42 avis)</span>
                        </div>
                        <span class="px-3 py-1 bg-indigo-800 bg-opacity-50 text-white rounded-full text-sm">
                            Expérience: {{ $user->medecin->years_of_experience ?? 'Non spécifiée' }} ans
                        </span>
                        <span class="px-3 py-1 bg-indigo-800 bg-opacity-50 text-white rounded-full text-sm">
                            Licence: {{ $user->medecin->license_number ?? 'Non renseignée' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Section Informations du médecin -->
        <div class="mb-12">
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-900">Informations Professionnelles</h2>
                    <p class="text-sm text-gray-500">Complétez votre profil pour améliorer votre visibilité</p>
                </div>
                <div class="p-6">
                    <div class="doctor-info-grid">
                        <!-- Informations personnelles -->
                        <div class="info-card">
                            <h3><i class="fas fa-user-md text-indigo-600"></i> Informations Personnelles</h3>
                            <ul>
                                <li>
                                    <span class="label">Nom complet:</span>
                                    <span class="value">{{ $user->full_name }}</span>
                                </li>
                                <li>
                                    <span class="label">Email:</span>
                                    <span class="value">{{ $user->email }}</span>
                                </li>
                                <li>
                                    <span class="label">Téléphone:</span>
                                    <span class="value">{{ $user->number_phone ?? 'Non renseigné' }}</span>
                                </li>
                                <li>
                                    <span class="label">Adresse:</span>
                                    <span class="value">{{ $user->medecin->adresse ?? 'Non renseignée' }}</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Informations professionnelles -->
                        <div class="info-card">
                            <h3><i class="fas fa-briefcase-medical text-indigo-600"></i> Informations Professionnelles
                            </h3>
                            <ul>
                                <li>
                                    <span class="label">Spécialité:</span>
                                    @if($user->medecin->specialite_id)
                                        <span class="specialty-badge">{{ $user->medecin->specialite->name }}</span>
                                    @else
                                        <span class="specialty-badge data-null">Non spécifiée</span>
                                    @endif
                                </li>
                                <li>
                                    <span class="label">N° Licence:</span>
                                    <span class="value">{{ $user->medecin->license_number ?? 'Non renseigné' }}</span>
                                </li>
                                <li>
                                    <span class="label">Expérience:</span>
                                    <span class="value">
                                        @if($user->medecin->years_of_experience)
                                            {{ $user->medecin->years_of_experience }} années
                                        @else
                                            Non spécifiée
                                        @endif
                                    </span>
                                </li>
                                <li>
                                    <span class="label">Établissement:</span>
                                    <span class="value">{{ $user->medecin->etablissement ?? 'Non renseigné' }}</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Description et compétences -->
                        <div class="info-card">
                            <h3><i class="fas fa-file-medical text-indigo-600"></i> Description & Compétences</h3>
                            <div class="mt-4 text-gray-600">
                                @if($user->medecin->description)
                                    {{ $user->medecin->description }}
                                @else
                                    <span class="data-null">Aucune description professionnelle n'a été fournie. Veuillez
                                        compléter votre profil.</span>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Statistiques rapides -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="stat-card bg-white rounded-xl shadow-sm p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-indigo-100">
                        <i class="fas fa-users text-indigo-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium text-gray-900">Patients actifs</h3>
                        <p class="mt-1 text-2xl font-semibold text-gray-900">24</p>
                        <p class="text-gray-500">+5% ce mois-ci</p>
                    </div>
                </div>
            </div>
            <div class="stat-card bg-white rounded-xl shadow-sm p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-green-100">
                        <i class="fas fa-calendar-check text-green-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium text-gray-900">Rendez-vous aujourd'hui</h3>
                        <p class="mt-1 text-2xl font-semibold text-gray-900">8</p>
                        <p class="text-gray-500">5 confirmés, 3 en attente</p>
                    </div>
                </div>
            </div>
            <div class="stat-card bg-white rounded-xl shadow-sm p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-purple-100">
                        <i class="fas fa-chart-line text-purple-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium text-gray-900">Taux de remplissage</h3>
                        <p class="mt-1 text-2xl font-semibold text-gray-900">78%</p>
                        <p class="text-gray-500">+12% ce mois-ci</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Nouvelle section combinée -->
        <div class="combined-section mb-8">
            <!-- Section des avis patients -->
            <div class="section-card">
                <div class="section-header">
                    <h2 class="text-lg font-medium text-gray-900">Derniers avis patients</h2>
                </div>
                <div class="section-content">
                    <div class="divide-y divide-gray-100">
                        <div class="p-4">
                            <div class="flex items-center mb-2">
                                <div class="rating-stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="ml-auto text-sm text-gray-500">Hier</div>
                            </div>
                            <div class="font-medium mb-1">Marie Dubois</div>
                            <p class="text-gray-600 text-sm">"Le Dr. Dupont est très à l'écoute et m'a donné des
                                conseils précieux. Je recommande vivement !"</p>
                        </div>
                        <div class="p-4">
                            <div class="flex items-center mb-2">
                                <div class="rating-stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                                <div class="ml-auto text-sm text-gray-500">5 juin</div>
                            </div>
                            <div class="font-medium mb-1">Thomas Leroy</div>
                            <p class="text-gray-600 text-sm">"Consultation très professionnelle. Un peu d'attente mais
                                le médecin a pris le temps nécessaire."</p>
                        </div>
                    </div>
                    <div class="mt-4 text-center">
                        <a href="#" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">
                            Voir tous les avis <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Section des documents -->
            <div class="section-card">
                <div class="section-header">
                    <h2 class="text-lg font-medium text-gray-900">Modèles de documents</h2>
                </div>
                <div class="section-content">
                    <div class="p-4">
                        <div class="flex items-center mb-4">
                            <div class="p-2 rounded-lg bg-blue-100 text-blue-600">
                                <i class="fas fa-file-medical"></i>
                            </div>
                            <div class="ml-3">
                                <div class="font-medium">Consentement éclairé</div>
                                <div class="text-sm text-gray-500">Dernière modification: 12/05/2023</div>
                            </div>
                            <div class="ml-auto">
                                <button class="text-indigo-600 hover:text-indigo-900">
                                    <i class="fas fa-download"></i>
                                </button>
                            </div>
                        </div>
                        <div class="flex items-center mb-4">
                            <div class="p-2 rounded-lg bg-green-100 text-green-600">
                                <i class="fas fa-file-prescription"></i>
                            </div>
                            <div class="ml-3">
                                <div class="font-medium">Ordonnance type</div>
                                <div class="text-sm text-gray-500">Dernière modification: 02/06/2023</div>
                            </div>
                            <div class="ml-auto">
                                <button class="text-indigo-600 hover:text-indigo-900">
                                    <i class="fas fa-download"></i>
                                </button>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="p-2 rounded-lg bg-purple-100 text-purple-600">
                                <i class="fas fa-file-contract"></i>
                            </div>
                            <div class="ml-3">
                                <div class="font-medium">Certificat médical</div>
                                <div class="text-sm text-gray-500">Dernière modification: 20/05/2023</div>
                            </div>
                            <div class="ml-auto">
                                <button class="text-indigo-600 hover:text-indigo-900">
                                    <i class="fas fa-download"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 text-center">
                        <button
                            class="text-indigo-600 hover:text-indigo-900 text-sm font-medium flex items-center justify-center">
                            <i class="fas fa-plus mr-2"></i> Ajouter un nouveau modèle
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-white border-t mt-12">
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex justify-center md:justify-start">
                    <div class="flex items-center">
                        <i class="fas fa-heartbeat text-indigo-600 text-xl"></i>
                        <span class="ml-2 text-lg font-bold text-indigo-600">BookDoctor</span>
                    </div>
                </div>
                <div class="mt-8 md:mt-0 md:order-1">
                    <p class="text-center text-sm text-gray-500">
                        &copy; 2023 BookDoctor. Tous droits réservés.
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Toggle mobile menu
        const hamburger = document.getElementById('hamburger');
        const mobileNav = document.getElementById('mobileNav');

        hamburger.addEventListener('click', function () {
            this.classList.toggle('active');
            mobileNav.classList.toggle('active');
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', function (e) {
            if (!hamburger.contains(e.target) && !mobileNav.contains(e.target)) {
                hamburger.classList.remove('active');
                mobileNav.classList.remove('active');
            }
        });

        // Gestion du menu déroulant du profil
        const profileContainer = document.getElementById('profileContainer');
        const profileBtn = document.getElementById('profileBtn');

        profileBtn.addEventListener('click', function (e) {
            if (window.innerWidth < 768) {
                profileContainer.classList.toggle('active');
                e.stopPropagation();
            }
        });

        document.addEventListener('click', function (e) {
            if (!profileContainer.contains(e.target)) {
                profileContainer.classList.remove('active');
            }
        });

        // Gestion des notifications
        const notificationContainer = document.getElementById('notificationContainer');
        const notificationBtn = document.getElementById('notificationBtn');
        const notificationCount = document.getElementById('notificationCount');

        notificationBtn.addEventListener('click', function (e) {
            if (window.innerWidth < 768) {
                notificationContainer.classList.toggle('active');
                e.stopPropagation();
            }
        });

        document.addEventListener('click', function (e) {
            if (!notificationContainer.contains(e.target)) {
                notificationContainer.classList.remove('active');
            }
        });

        // Marquer toutes les notifications comme lues
        document.getElementById('markReadBtn').addEventListener('click', function (e) {
            e.stopPropagation();
            document.querySelectorAll('.notification-item.unread').forEach(item => {
                item.classList.remove('unread');
            });
            notificationCount.textContent = '0';

            Swal.fire({
                icon: 'success',
                title: 'Notifications marquées comme lues',
                text: 'Toutes les notifications ont été marquées comme lues.',
                confirmButtonColor: '#4f46e5'
            });
        });

        // Gestion des actions du menu
        document.getElementById('profileLink').addEventListener('click', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Mon Profil',
                html: `
                    <div class="text-left">
                        <p class="mb-4">Vous consultez votre profil médical.</p>
                        <div class="bg-blue-50 border-l-4 border-blue-400 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-info-circle text-blue-400 text-xl"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-blue-700">
                                        Votre profil est visible à 85% par les patients.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                `,
                icon: 'info',
                confirmButtonColor: '#4f46e5',
                confirmButtonText: 'Compléter mon profil'
            });
            profileContainer.classList.remove('active');
        });

        document.getElementById('editLink').addEventListener('click', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Modification du profil',
                text: 'Édition des informations du profil',
                icon: 'info',
                confirmButtonColor: '#4f46e5'
            });
            profileContainer.classList.remove('active');
        });

        document.getElementById('settingsLink').addEventListener('click', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Paramètres',
                text: 'Modification des paramètres du compte',
                icon: 'info',
                confirmButtonColor: '#4f46e5'
            });
            profileContainer.classList.remove('active');
        });

        document.getElementById('logoutLink').addEventListener('click', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Déconnexion',
                text: 'Vous êtes sur le point de vous déconnecter',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#4f46e5',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Se déconnecter',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Déconnexion réussie',
                        text: 'Vous avez été déconnecté avec succès',
                        icon: 'success',
                        confirmButtonColor: '#4f46e5'
                    }).then(() => {
                        window.location.href = '/logout';
                    });
                }
            });
            profileContainer.classList.remove('active');
        });

        // Gestion de la bannière de statistiques
        document.getElementById('statsBtn').addEventListener('click', function () {
            Swal.fire({
                title: 'Rapport statistique complet',
                html: `
                    <div class="text-left">
                        <div class="flex justify-between mb-4">
                            <div>
                                <p class="font-semibold">Statistiques mensuelles détaillées</p>
                                <p class="text-gray-500">${new Date().toLocaleDateString('fr-FR', { month: 'long', year: 'numeric' })}</p>
                            </div>
                        </div>
                        
                        <div class="bg-gray-50 p-4 rounded-lg mb-4">
                            <div class="flex justify-between">
                                <div>
                                    <div class="text-sm text-gray-500">Consultations totales</div>
                                    <div class="text-xl font-bold">78</div>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-500">Nouveaux patients</div>
                                    <div class="text-xl font-bold">24</div>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-500">Taux de remplissage</div>
                                    <div class="text-xl font-bold">78%</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-center my-4">
                            <div class="w-32 h-32 rounded-full border-8 border-blue-500 flex items-center justify-center">
                                <div class="text-center">
                                    <div class="text-2xl font-bold">94%</div>
                                    <div class="text-sm text-gray-500">Satisfaction</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-sm text-gray-500 mt-6">
                            Ces données sont actualisées quotidiennement à minuit.
                        </div>
                    </div>
                `,
                showCloseButton: true,
                showConfirmButton: false,
                width: 500
            });
        });

        // Gestion de l'upload d'avatar
        document.getElementById('avatar').addEventListener('change', function (e) {
            if (e.target.files && e.target.files[0]) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    // Créer une nouvelle image
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('h-32', 'w-32', 'rounded-full', 'border-4', 'border-white', 'shadow-lg');
                    img.alt = "Photo de profil médecin";

                    // Remplacer le placeholder
                    const placeholder = document.querySelector('.avatar-upload .avatar-placeholder');
                    placeholder.parentNode.replaceChild(img, placeholder);

                    // Mettre à jour l'image du profil dans le header
                    document.querySelector('.profile-img').src = e.target.result;

                    Swal.fire({
                        title: 'Avatar mis à jour!',
                        text: 'Votre photo de profil a été modifiée avec succès.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                }

                reader.readAsDataURL(e.target.files[0]);
            }
        });
    </script>
</body>

</html>