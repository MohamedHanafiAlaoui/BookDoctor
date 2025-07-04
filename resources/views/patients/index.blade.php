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
                <!-- Notification container -->
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
                                    <div class="notification-title">Rendez-vous confirmé</div>
                                    <div class="notification-desc">Votre rendez-vous avec le Dr. Dupont a été confirmé pour le 15 Juin à 10:30.</div>
                                    <div class="notification-time">Il y a 5 minutes</div>
                                </div>
                            </li>
                            
                            <li class="notification-item unread">
                                <div class="notification-icon">
                                    <i class="fas fa-file-medical"></i>
                                </div>
                                <div class="notification-content">
                                    <div class="notification-title">Nouveau document</div>
                                    <div class="notification-desc">Vos résultats d'analyse sanguine sont maintenant disponibles.</div>
                                    <div class="notification-time">Il y a 1 heure</div>
                                </div>
                            </li>
                            
                            <li class="notification-item">
                                <div class="notification-icon">
                                    <i class="fas fa-user-md"></i>
                                </div>
                                <div class="notification-content">
                                    <div class="notification-title">Message du médecin</div>
                                    <div class="notification-desc">Dr. Lambert vous a envoyé un message concernant votre prochain rendez-vous.</div>
                                    <div class="notification-time">Hier, 14:30</div>
                                </div>
                            </li>
                            
                            <li class="notification-item">
                                <div class="notification-icon">
                                    <i class="fas fa-pills"></i>
                                </div>
                                <div class="notification-content">
                                    <div class="notification-title">Rappel de médicament</div>
                                    <div class="notification-desc">N'oubliez pas de prendre votre traitement ce matin.</div>
                                    <div class="notification-time">Hier, 08:15</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <!-- Profile container -->
                <div class="profile-container" id="profileContainer">
                    <button class="profile-btn" id="profileBtn">
                        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" 
                             alt="Photo de profil" class="profile-img">
                        <span class="profile-name">Marie D.</span>
                    </button>
                    
                    <div class="profile-dropdown fade-in">
                        <div class="dropdown-header">
                            <h3>Marie Dupont</h3>
                            <p>marie.dupont@example.com</p>
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

    <!-- Main Content -->
    <main class="main-container">
        <h1 class="dashboard-title">Tableau de bord</h1>
        
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div>
                        <div class="stat-title">Prochain rendez-vous</div>
                        <div class="stat-value">15 Juin 2023</div>
                    </div>
                </div>
                <div class="stat-desc">Dr. Dupont - Cardiologie</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="fas fa-file-medical"></i>
                    </div>
                    <div>
                        <div class="stat-title">Documents médicaux</div>
                        <div class="stat-value">12</div>
                    </div>
                </div>
                <div class="stat-desc">5 nouveaux depuis la dernière visite</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="fas fa-heartbeat"></i>
                    </div>
                    <div>
                        <div class="stat-title">Dernier examen</div>
                        <div class="stat-value">Analyse sanguine</div>
                    </div>
                </div>
                <div class="stat-desc">10 Mai 2023 - Résultats normaux</div>
            </div>
        </div>
        
        <div class="content-grid">
            <div class="panel">
                <div class="panel-header">
                    <h2 class="panel-title">Prochains rendez-vous</h2>
                    <a href="#" class="panel-link">Tout voir <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="appointment-list">
                    <div class="appointment-item">
                        <div class="appointment-icon">
                            <i class="fas fa-stethoscope"></i>
                        </div>
                        <div class="appointment-details">
                            <div class="appointment-title">Consultation de suivi</div>
                            <div class="appointment-meta">
                                <span><i class="far fa-calendar"></i> Jeu. 15 Juin - 10:30</span>
                                <span><i class="fas fa-user-md"></i> Dr. Dupont</span>
                            </div>
                        </div>
                        <div class="appointment-status status-confirmed">Confirmé</div>
                    </div>
                    
                    <div class="appointment-item">
                        <div class="appointment-icon">
                            <i class="fas fa-vial"></i>
                        </div>
                        <div class="appointment-details">
                            <div class="appointment-title">Prise de sang</div>
                            <div class="appointment-meta">
                                <span><i class="far fa-calendar"></i> Lun. 19 Juin - 08:15</span>
                                <span><i class="fas fa-clinic-medical"></i> Laboratoire Central</span>
                            </div>
                        </div>
                        <div class="appointment-status status-pending">En attente</div>
                    </div>
                    
                    <div class="appointment-item">
                        <div class="appointment-icon">
                            <i class="fas fa-tooth"></i>
                        </div>
                        <div class="appointment-details">
                            <div class="appointment-title">Contrôle dentaire</div>
                            <div class="appointment-meta">
                                <span><i class="far fa-calendar"></i> Ven. 30 Juin - 14:00</span>
                                <span><i class="fas fa-user-md"></i> Dr. Lambert</span>
                            </div>
                        </div>
                        <div class="appointment-status status-confirmed">Confirmé</div>
                    </div>
                </div>
            </div>
            
            <div class="panel">
                <div class="panel-header">
                    <h2 class="panel-title">Documents récents</h2>
                    <a href="#" class="panel-link">Tout voir <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="documents-list">
                    <div class="document-item">
                        <div class="document-icon pdf-icon">
                            <i class="fas fa-file-pdf"></i>
                        </div>
                        <div class="doc-details">
                            <div class="doc-title">Résultats analyse sanguine</div>
                            <div class="doc-date">Ajouté le 12/05/2023</div>
                        </div>
                        <div class="doc-download">
                            <i class="fas fa-download"></i>
                        </div>
                    </div>
                    
                    <div class="document-item">
                        <div class="document-icon">
                            <i class="fas fa-file-medical"></i>
                        </div>
                        <div class="doc-details">
                            <div class="doc-title">Ordonnance médicale</div>
                            <div class="doc-date">Ajouté le 10/05/2023</div>
                        </div>
                        <div class="doc-download">
                            <i class="fas fa-download"></i>
                        </div>
                    </div>
                    
                    <div class="document-item">
                        <div class="document-icon">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <div class="doc-details">
                            <div class="doc-title">Compte rendu consultation</div>
                            <div class="doc-date">Ajouté le 10/05/2023</div>
                        </div>
                        <div class="doc-download">
                            <i class="fas fa-download"></i>
                        </div>
                    </div>
                    
                    <div class="document-item">
                        <div class="document-icon">
                            <i class="fas fa-x-ray"></i>
                        </div>
                        <div class="doc-details">
                            <div class="doc-title">Radiographie thoracique</div>
                            <div class="doc-date">Ajouté le 02/04/2023</div>
                        </div>
                        <div class="doc-download">
                            <i class="fas fa-download"></i>
                        </div>
                    </div>
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
        // Toggle mobile menu
        const hamburger = document.getElementById('hamburger');
        const mobileNav = document.getElementById('mobileNav');
        
        hamburger.addEventListener('click', function() {
            this.classList.toggle('active');
            mobileNav.classList.toggle('active');
        });
        
        // Close mobile menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!hamburger.contains(e.target) && !mobileNav.contains(e.target)) {
                hamburger.classList.remove('active');
                mobileNav.classList.remove('active');
            }
        });
        
        // Gestion du menu déroulant du profil
        const profileContainer = document.getElementById('profileContainer');
        const profileBtn = document.getElementById('profileBtn');
        
        // Ouvrir le menu au clic sur mobile
        profileBtn.addEventListener('click', function(e) {
            // Pour les écrans mobiles, on utilise un toggle
            if (window.innerWidth < 768) {
                profileContainer.classList.toggle('active');
                e.stopPropagation();
            }
        });
        
        // Fermer le menu quand on clique ailleurs
        document.addEventListener('click', function(e) {
            if (!profileContainer.contains(e.target)) {
                profileContainer.classList.remove('active');
            }
        });
        
        // Gestion des notifications
        const notificationContainer = document.getElementById('notificationContainer');
        const notificationBtn = document.getElementById('notificationBtn');
        const notificationCount = document.getElementById('notificationCount');
        const markReadBtn = document.getElementById('markReadBtn');
        const unreadItems = document.querySelectorAll('.notification-item.unread');
        
        // Ouvrir le menu au clic sur mobile
        notificationBtn.addEventListener('click', function(e) {
            // Pour les écrans mobiles, on utilise un toggle
            if (window.innerWidth < 768) {
                notificationContainer.classList.toggle('active');
                e.stopPropagation();
            }
        });
        
        // Fermer le menu quand on clique ailleurs
        document.addEventListener('click', function(e) {
            if (!notificationContainer.contains(e.target)) {
                notificationContainer.classList.remove('active');
            }
        });
        
        // Marquer toutes les notifications comme lues
        markReadBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            unreadItems.forEach(item => {
                item.classList.remove('unread');
                item.style.backgroundColor = 'white';
            });
            notificationCount.textContent = '0';
            notificationCount.style.display = 'none';
            
            // Show confirmation
            Swal.fire({
                icon: 'success',
                title: 'Notifications marquées comme lues',
                showConfirmButton: false,
                timer: 1500
            });
        });
        
        // Gestion des actions du menu
        document.getElementById('profileLink').addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Mon Profil',
                text: 'Affichage des informations du profil',
                icon: 'info',
                confirmButtonColor: '#4f46e5'
            });
            profileContainer.classList.remove('active');
        });
        
        document.getElementById('editLink').addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Modification du profil',
                text: 'Édition des informations du profil',
                icon: 'info',
                confirmButtonColor: '#4f46e5'
            });
            profileContainer.classList.remove('active');
        });
        
        document.getElementById('settingsLink').addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Paramètres',
                text: 'Modification des paramètres du compte',
                icon: 'info',
                confirmButtonColor: '#4f46e5'
            });
            profileContainer.classList.remove('active');
        });
        
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
            profileContainer.classList.remove('active');
        });
        
        // Simulation de téléchargement
        document.querySelectorAll('.doc-download').forEach(icon => {
            icon.addEventListener('click', function() {
                Swal.fire({
                    icon: 'info',
                    title: 'Téléchargement',
                    text: 'Cette fonctionnalité sera disponible dans la version complète',
                    confirmButtonColor: '#4f46e5'
                });
            });
        });
        
        // Notification click handling
        document.querySelectorAll('.notification-item').forEach(item => {
            item.addEventListener('click', function() {
                if (this.classList.contains('unread')) {
                    this.classList.remove('unread');
                    const unreadCount = document.querySelectorAll('.notification-item.unread').length;
                    notificationCount.textContent = unreadCount;
                    if (unreadCount === 0) {
                        notificationCount.style.display = 'none';
                    }
                    
                    Swal.fire({
                        icon: 'info',
                        title: this.querySelector('.notification-title').textContent,
                        text: this.querySelector('.notification-desc').textContent,
                        confirmButtonColor: '#4f46e5'
                    });
                }
            });
        });
    </script>
</body>
</html>