<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Patient - BookDoctor</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .profile-header {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        }
        .stat-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .appointment-card {
            border-left: 4px solid #4f46e5;
        }
        .history-card {
            border-top: 3px solid #7c3aed;
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
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
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
            background: #4f46e5;
            border-radius: 3px;
        }
        .purchase-banner {
            background: linear-gradient(135deg, #7c3aed 0%, #4f46e5 100%);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(124, 58, 237, 0.3);
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
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(124, 58, 237, 0.7); }
            70% { transform: scale(1); box-shadow: 0 0 0 12px rgba(124, 58, 237, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(124, 58, 237, 0); }
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        /* Styles pour les notifications */
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: #ef4444;
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
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
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
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
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
            border-color: #4f46e5;
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
            background-color: #4f46e5;
            color: white;
            border: none;
        }
        .btn-primary:hover {
            background-color: #4338ca;
        }
        .health-indicator {
            height: 8px;
            border-radius: 4px;
            margin-top: 8px;
            background-color: #e5e7eb;
            overflow: hidden;
        }
        .health-indicator-fill {
            height: 100%;
            border-radius: 4px;
        }
        .security-item {
            display: flex;
            align-items: center;
            padding: 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            background-color: white;
        }
        .security-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            flex-shrink: 0;
        }
        .security-details {
            flex-grow: 1;
        }
        .security-status {
            font-size: 0.875rem;
            font-weight: 500;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen">
    <!-- Header de navigation -->
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <svg class="h-8 w-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        <span class="ml-2 text-xl font-bold text-indigo-600">BookDoctor</span>
                    </div>
                    <nav class="ml-10 flex space-x-8">
                        <a href="/profil" class="border-indigo-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Tableau de bord</a>
                        <a href="/rendez-vous" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Mes rendez-vous</a>
                        <a href="/Historique" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Historique médical</a>
                        <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Documents</a>
                    </nav>
                </div>
                <div class="flex items-center space-x-4">
                    <!-- Bouton de notifications -->
                    <div class="relative">
                        <button id="notificationBtn" class="relative p-2 rounded-full text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <i class="fas fa-bell text-xl"></i>
                            <span class="notification-badge">3</span>
                        </button>
                        
                        <!-- Panneau de notifications -->
                        <div id="notificationPanel" class="notification-panel">
                            <div class="px-4 py-3 border-b">
                                <h3 class="text-lg font-medium text-gray-900">Notifications</h3>
                            </div>
                            <div class="divide-y divide-gray-100">
                                <div class="notification-item unread">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 pt-1">
                                            <div class="w-3 h-3 rounded-full bg-indigo-600"></div>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">Nouveau document disponible</p>
                                            <p class="text-sm text-gray-500">Votre résultat de test sanguin est maintenant disponible</p>
                                            <p class="notification-time">Il y a 15 minutes</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="notification-item">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 pt-1">
                                            <div class="w-3 h-3 rounded-full bg-gray-300"></div>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">Rappel de rendez-vous</p>
                                            <p class="text-sm text-gray-500">Votre consultation avec Dr. Dupont est demain à 10:30</p>
                                            <p class="notification-time">Il y a 2 heures</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="notification-item unread">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 pt-1">
                                            <div class="w-3 h-3 rounded-full bg-indigo-600"></div>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">Message du Dr. Lambert</p>
                                            <p class="text-sm text-gray-500">"Votre radiographie est prête pour examen"</p>
                                            <p class="notification-time">Il y a 1 jour</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="notification-item">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 pt-1">
                                            <div class="w-3 h-3 rounded-full bg-gray-300"></div>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">Mise à jour de votre dossier</p>
                                            <p class="text-sm text-gray-500">Votre dossier médical a été mis à jour avec de nouvelles informations</p>
                                            <p class="notification-time">Il y a 3 jours</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-3 bg-gray-50 text-center">
                                <a href="#" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">
                                    Voir toutes les notifications <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Avatar utilisateur -->
                    <div class="relative">
                        <button class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Photo de profil">
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- En-tête du profil -->
    <div class="profile-header py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center">
                <div class="avatar-upload relative mr-6 mb-6 md:mb-0">
                    <img class="h-32 w-32 rounded-full border-4 border-white shadow-lg" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=400&q=80" alt="Photo de profil patient">
                    <div class="edit-icon">
                        <i class="fas fa-pencil-alt text-indigo-600 text-sm"></i>
                    </div>
                    <input type="file" id="avatar" name="avatar" accept="image/*">
                </div>
                <div class="text-center md:text-left">
                    <h1 class="text-3xl font-bold text-white">Sophie Martin</h1>
                    <p class="mt-2 text-indigo-100">
                        <i class="fas fa-envelope mr-2"></i>sophie.martin@example.com
                        <span class="mx-3">|</span>
                        <i class="fas fa-phone mr-2"></i>06 12 34 56 78
                    </p>
                    <div class="mt-4 flex flex-wrap justify-center md:justify-start gap-3">
                        <span class="px-3 py-1 bg-indigo-800 bg-opacity-50 text-white rounded-full text-sm">Groupe sanguin: O+</span>
                        <span class="px-3 py-1 bg-indigo-800 bg-opacity-50 text-white rounded-full text-sm">Allergies: Aucune</span>
                        <span class="px-3 py-1 bg-indigo-800 bg-opacity-50 text-white rounded-full text-sm">Date de naissance: 15/03/1985</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation par onglets -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
        <div class="tabs flex space-x-8 border-b border-gray-200">
            <div class="tab text-gray-900 font-medium active" data-tab="overview">
                <span class="py-2">Aperçu</span>
            </div>
            <div class="tab text-gray-500 font-medium hover:text-gray-700" data-tab="personal">
                <span class="py-2">Informations personnelles</span>
            </div>
            <div class="tab text-gray-500 font-medium hover:text-gray-700" data-tab="health">
                <span class="py-2">Santé</span>
            </div>
            <div class="tab text-gray-500 font-medium hover:text-gray-700" data-tab="documents">
                <span class="py-2">Documents</span>
            </div>

        </div>
    </div>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Contenu des onglets -->
        <div id="overview-tab" class="tab-content active">
            <!-- Statistiques rapides -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="stat-card bg-white rounded-xl shadow-sm p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-lg bg-blue-100">
                            <i class="fas fa-calendar-check text-blue-600 text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">Prochain rendez-vous</h3>
                            <p class="mt-1 text-2xl font-semibold text-gray-900">15 Juin 2023</p>
                            <p class="text-gray-500">Dr. Dupont - Cardiologie</p>
                        </div>
                    </div>
                </div>
                <div class="stat-card bg-white rounded-xl shadow-sm p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-lg bg-green-100">
                            <i class="fas fa-file-medical text-green-600 text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">Documents médicaux</h3>
                            <p class="mt-1 text-2xl font-semibold text-gray-900">12</p>
                            <p class="text-gray-500">5 nouveaux depuis la dernière visite</p>
                        </div>
                    </div>
                </div>
                <div class="stat-card bg-white rounded-xl shadow-sm p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-lg bg-purple-100">
                            <i class="fas fa-heartbeat text-purple-600 text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">Dernier examen</h3>
                            <p class="mt-1 text-2xl font-semibold text-gray-900">Analyse sanguine</p>
                            <p class="text-gray-500">10 Mai 2023 - Résultats normaux</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grille principale -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Colonne de gauche -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Prochains rendez-vous -->
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-medium text-gray-900">Prochains rendez-vous</h2>
                        </div>
                        <ul class="divide-y divide-gray-200">
                            <li class="appointment-card px-6 py-4 hover:bg-gray-50">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-indigo-100 rounded-lg p-3">
                                        <i class="fas fa-stethoscope text-indigo-600 text-xl"></i>
                                    </div>
                                    <div class="ml-4 flex-1">
                                        <div class="flex items-center justify-between">
                                            <h3 class="text-md font-medium text-gray-900">Consultation de suivi</h3>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Confirmé
                                            </span>
                                        </div>
                                        <p class="mt-1 text-sm text-gray-500">
                                            <i class="far fa-calendar mr-2"></i>Jeu. 15 Juin 2023 - 10:30
                                        </p>
                                        <p class="text-sm text-gray-500">
                                            <i class="fas fa-user-md mr-2"></i>Dr. Dupont - Cabinet de Cardiologie
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="appointment-card px-6 py-4 hover:bg-gray-50">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-indigo-100 rounded-lg p-3">
                                        <i class="fas fa-vial text-indigo-600 text-xl"></i>
                                    </div>
                                    <div class="ml-4 flex-1">
                                        <div class="flex items-center justify-between">
                                            <h3 class="text-md font-medium text-gray-900">Prise de sang</h3>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                En attente
                                            </span>
                                        </div>
                                        <p class="mt-1 text-sm text-gray-500">
                                            <i class="far fa-calendar mr-2"></i>Lun. 19 Juin 2023 - 08:15
                                        </p>
                                        <p class="text-sm text-gray-500">
                                            <i class="fas fa-clinic-medical mr-2"></i>Laboratoire Médical Central
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="appointment-card px-6 py-4 hover:bg-gray-50">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-indigo-100 rounded-lg p-3">
                                        <i class="fas fa-tooth text-indigo-600 text-xl"></i>
                                    </div>
                                    <div class="ml-4 flex-1">
                                        <div class="flex items-center justify-between">
                                            <h3 class="text-md font-medium text-gray-900">Contrôle dentaire</h3>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                Confirmé
                                            </span>
                                        </div>
                                        <p class="mt-1 text-sm text-gray-500">
                                            <i class="far fa-calendar mr-2"></i>Ven. 30 Juin 2023 - 14:00
                                        </p>
                                        <p class="text-sm text-gray-500">
                                            <i class="fas fa-user-md mr-2"></i>Dr. Lambert - Cabinet Dentaire
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="px-6 py-4 bg-gray-50 text-center">
                            <a href="#" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">
                                Voir tous les rendez-vous <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Notification d'achat de document -->
                    <div class="purchase-banner">
                        <div class="flex flex-col md:flex-row items-center justify-between p-6">
                            <div class="flex items-center mb-4 md:mb-0">
                                <div class="pulse flex-shrink-0 mr-4 bg-white bg-opacity-20 rounded-full p-4">
                                    <i class="fas fa-file-medical text-white text-3xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-white">Accédez à votre historique médical complet</h3>
                                    <p class="mt-1 text-indigo-100 max-w-lg">
                                        Pour consulter ou télécharger l'intégralité de votre dossier médical, achetez l'accès à votre historique complet.
                                    </p>
                                </div>
                            </div>
                            <button id="purchaseBtn" class="px-6 py-3 bg-white text-indigo-600 font-semibold rounded-lg shadow-md hover:bg-indigo-50 transition-colors duration-300 flex items-center">
                                <i class="fas fa-shopping-cart mr-2"></i> Acheter maintenant (19,99€)
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Colonne de droite -->
                <div class="space-y-8">
                    <!-- Informations santé -->
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-medium text-gray-900">Informations santé</h2>
                        </div>
                        <div class="p-6">
                            <div class="mb-6">
                                <h3 class="text-sm font-medium text-gray-500 mb-2">Allergies</h3>
                                <div class="flex flex-wrap gap-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Aucune allergie connue
                                    </span>
                                </div>
                            </div>

                            <div class="mb-6">
                                <h3 class="text-sm font-medium text-gray-500 mb-2">Conditions médicales</h3>
                                <div class="flex flex-wrap gap-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Hypertension artérielle
                                    </span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Diabète type 2
                                    </span>
                                </div>
                            </div>

                            <div class="mb-6">
                                <h3 class="text-sm font-medium text-gray-500 mb-2">Médicaments actuels</h3>
                                <ul class="mt-2 space-y-2">
                                    <li class="flex items-start">
                                        <div class="flex-shrink-0 mt-0.5">
                                            <div class="w-3 h-3 rounded-full bg-indigo-600"></div>
                                        </div>
                                        <p class="ml-3 text-sm text-gray-700">Lisinopril 10mg - 1 comprimé par jour</p>
                                    </li>
                                    <li class="flex items-start">
                                        <div class="flex-shrink-0 mt-0.5">
                                            <div class="w-3 h-3 rounded-full bg-indigo-600"></div>
                                        </div>
                                        <p class="ml-3 text-sm text-gray-700">Metformine 500mg - 2 comprimés par jour</p>
                                    </li>
                                    <li class="flex items-start">
                                        <div class="flex-shrink-0 mt-0.5">
                                            <div class="w-3 h-3 rounded-full bg-indigo-600"></div>
                                        </div>
                                        <p class="ml-3 text-sm text-gray-700">Atorvastatine 20mg - 1 comprimé le soir</p>
                                    </li>
                                </ul>
                            </div>

                            <div>
                                <h3 class="text-sm font-medium text-gray-500 mb-2">Personne à contacter</h3>
                                <div class="mt-2">
                                    <p class="text-sm font-medium text-gray-900">Pierre Martin</p>
                                    <p class="text-sm text-gray-500">Conjoint</p>
                                    <p class="text-sm text-gray-700 mt-1">
                                        <i class="fas fa-phone mr-2"></i>06 98 76 54 32
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="px-6 py-4 bg-gray-50">
                            <button class="w-full text-indigo-600 hover:text-indigo-900 text-sm font-medium flex items-center justify-center">
                                <i class="fas fa-edit mr-2"></i> Mettre à jour les informations santé
                            </button>
                        </div>
                    </div>

                    <!-- Documents récents -->
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-medium text-gray-900">Documents récents</h2>
                        </div>
                        <div class="p-6">
                            <ul class="space-y-4">
                                <li class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="p-2 rounded-lg bg-indigo-100">
                                            <i class="fas fa-file-pdf text-red-600"></i>
                                        </div>
                                        <div class="ml-4">
                                            <h3 class="text-sm font-medium text-gray-900">Résultats analyse sanguine</h3>
                                            <p class="text-xs text-gray-500">Ajouté le 12/05/2023</p>
                                        </div>
                                    </div>
                                    <button class="text-indigo-600 hover:text-indigo-900">
                                        <i class="fas fa-download"></i>
                                    </button>
                                </li>
                                <li class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="p-2 rounded-lg bg-indigo-100">
                                            <i class="fas fa-file-medical text-green-600"></i>
                                        </div>
                                        <div class="ml-4">
                                            <h3 class="text-sm font-medium text-gray-900">Ordonnance médicale</h3>
                                            <p class="text-xs text-gray-500">Ajouté le 10/05/2023</p>
                                        </div>
                                    </div>
                                    <button class="text-indigo-600 hover:text-indigo-900">
                                        <i class="fas fa-download"></i>
                                    </button>
                                </li>
                                <li class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="p-2 rounded-lg bg-indigo-100">
                                            <i class="fas fa-file-invoice text-blue-600"></i>
                                        </div>
                                        <div class="ml-4">
                                            <h3 class="text-sm font-medium text-gray-900">Compte rendu consultation</h3>
                                            <p class="text-xs text-gray-500">Ajouté le 10/05/2023</p>
                                        </div>
                                    </div>
                                    <button class="text-indigo-600 hover:text-indigo-900">
                                        <i class="fas fa-download"></i>
                                    </button>
                                </li>
                                <li class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="p-2 rounded-lg bg-indigo-100">
                                            <i class="fas fa-x-ray text-yellow-600"></i>
                                        </div>
                                        <div class="ml-4">
                                            <h3 class="text-sm font-medium text-gray-900">Radiographie thoracique</h3>
                                            <p class="text-xs text-gray-500">Ajouté le 02/04/2023</p>
                                        </div>
                                    </div>
                                    <button class="text-indigo-600 hover:text-indigo-900">
                                        <i class="fas fa-download"></i>
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="px-6 py-4 bg-gray-50 text-center">
                            <a href="#" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">
                                Voir tous les documents <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Onglet Informations personnelles -->
        <div id="personal-tab" class="tab-content">
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-900">Informations personnelles</h2>
                </div>
                <div class="p-6">
                    <form>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="form-group">
                                <label class="form-label">Nom</label>
                                <input type="text" class="form-input" value="Martin">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Prénom</label>
                                <input type="text" class="form-input" value="Sophie">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Date de naissance</label>
                                <input type="date" class="form-input" value="1985-03-15">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Genre</label>
                                <select class="form-input">
                                    <option>Femme</option>
                                    <option>Homme</option>
                                    <option>Autre</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Adresse email</label>
                                <input type="email" class="form-input" value="sophie.martin@example.com">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Téléphone</label>
                                <input type="tel" class="form-input" value="0612345678">
                            </div>
                            <div class="form-group md:col-span-2">
                                <label class="form-label">Adresse</label>
                                <input type="text" class="form-input" value="12 Rue de la Paix">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Code postal</label>
                                <input type="text" class="form-input" value="75001">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Ville</label>
                                <input type="text" class="form-input" value="Paris">
                            </div>
                        </div>
                        <div class="mt-8 flex justify-end">
                            <button type="button" class="btn btn-primary">
                                <i class="fas fa-save mr-2"></i> Enregistrer les modifications
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Onglet Santé -->
        <div id="health-tab" class="tab-content">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-medium text-gray-900">Informations médicales</h2>
                    </div>
                    <div class="p-6">
                        <div class="mb-6">
                            <h3 class="text-sm font-medium text-gray-500 mb-2">Allergies</h3>
                            <div class="flex flex-wrap gap-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Aucune allergie connue
                                </span>
                            </div>
                        </div>

                        <div class="mb-6">
                            <h3 class="text-sm font-medium text-gray-500 mb-2">Conditions médicales</h3>
                            <div class="flex flex-wrap gap-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    Hypertension artérielle
                                </span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    Diabète type 2
                                </span>
                            </div>
                        </div>

                        <div class="mb-6">
                            <h3 class="text-sm font-medium text-gray-500 mb-2">Médicaments actuels</h3>
                            <ul class="mt-2 space-y-2">
                                <li class="flex items-start">
                                    <div class="flex-shrink-0 mt-0.5">
                                        <div class="w-3 h-3 rounded-full bg-indigo-600"></div>
                                    </div>
                                    <p class="ml-3 text-sm text-gray-700">Lisinopril 10mg - 1 comprimé par jour</p>
                                </li>
                                <li class="flex items-start">
                                    <div class="flex-shrink-0 mt-0.5">
                                        <div class="w-3 h-3 rounded-full bg-indigo-600"></div>
                                    </div>
                                    <p class="ml-3 text-sm text-gray-700">Metformine 500mg - 2 comprimés par jour</p>
                                </li>
                                <li class="flex items-start">
                                    <div class="flex-shrink-0 mt-0.5">
                                        <div class="w-3 h-3 rounded-full bg-indigo-600"></div>
                                    </div>
                                    <p class="ml-3 text-sm text-gray-700">Atorvastatine 20mg - 1 comprimé le soir</p>
                                </li>
                            </ul>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-2">Personne à contacter</h3>
                            <div class="mt-2">
                                <p class="text-sm font-medium text-gray-900">Pierre Martin</p>
                                <p class="text-sm text-gray-500">Conjoint</p>
                                <p class="text-sm text-gray-700 mt-1">
                                    <i class="fas fa-phone mr-2"></i>06 98 76 54 32
                                </p>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>

        <!-- Onglet Documents -->
        <div id="documents-tab" class="tab-content">
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex justify-between items-center">
                        <h2 class="text-lg font-medium text-gray-900">Documents médicaux</h2>
       
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <div class="relative w-64">
                            <input type="text" placeholder="Rechercher un document..." class="form-input pl-10">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                        <div>
                            <select class="form-input">
                                <option>Tous les types</option>
                                <option>Ordonnances</option>
                                <option>Analyses</option>
                                <option>Comptes rendus</option>
                                <option>Imagerie</option>
                            </select>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Document</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Médecin</th>
                                    <th class="px-6 py-3 bg-gray-50"></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <i class="fas fa-file-pdf text-red-600 text-xl mr-3"></i>
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">Résultats analyse sanguine</div>
                                                <div class="text-sm text-gray-500">1.2 MB</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Analyse</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">12/05/2023</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Dr. Dupont</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                        <button class="text-indigo-600 hover:text-indigo-900 mr-3">
                                            <i class="fas fa-download"></i>
                                        </button>

                                    </td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <i class="fas fa-file-medical text-green-600 text-xl mr-3"></i>
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">Ordonnance médicale</div>
                                                <div class="text-sm text-gray-500">0.8 MB</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Ordonnance</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">10/05/2023</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Dr. Lambert</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                        <button class="text-indigo-600 hover:text-indigo-900 mr-3">
                                            <i class="fas fa-download"></i>
                                        </button>
                                        <button class="text-gray-500 hover:text-gray-700">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <i class="fas fa-file-invoice text-blue-600 text-xl mr-3"></i>
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">Compte rendu consultation</div>
                                                <div class="text-sm text-gray-500">1.5 MB</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Compte rendu</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">10/05/2023</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Dr. Dupont</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                        <button class="text-indigo-600 hover:text-indigo-900 mr-3">
                                            <i class="fas fa-download"></i>
                                        </button>
                                        <button class="text-gray-500 hover:text-gray-700">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <i class="fas fa-x-ray text-yellow-600 text-xl mr-3"></i>
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">Radiographie thoracique</div>
                                                <div class="text-sm text-gray-500">5.7 MB</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Imagerie</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">02/04/2023</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Dr. Lambert</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                        <button class="text-indigo-600 hover:text-indigo-900 mr-3">
                                            <i class="fas fa-download"></i>
                                        </button>
                                        <button class="text-gray-500 hover:text-gray-700">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Onglet Sécurité -->

    </main>

    <footer class="bg-white border-t mt-12">
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex justify-center md:justify-start">
                    <div class="flex items-center">
                        <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
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
        // Gestion des onglets
        document.querySelectorAll('.tab').forEach(tab => {
            tab.addEventListener('click', function() {
                const tabName = this.getAttribute('data-tab');
                
                // Mise à jour des onglets
                document.querySelectorAll('.tab').forEach(t => {
                    t.classList.remove('active', 'text-gray-900');
                    t.classList.add('text-gray-500', 'hover:text-gray-700');
                });
                
                this.classList.add('active', 'text-gray-900');
                this.classList.remove('text-gray-500', 'hover:text-gray-700');
                
                // Affichage du contenu de l'onglet
                document.querySelectorAll('.tab-content').forEach(content => {
                    content.classList.remove('active');
                });
                document.getElementById(`${tabName}-tab`).classList.add('active');
            });
        });

        // Simulation de téléchargement
        document.querySelectorAll('[class*="fa-download"]').forEach(icon => {
            icon.addEventListener('click', function() {
                Swal.fire({
                    icon: 'info',
                    title: 'Téléchargement',
                    text: 'Cette fonctionnalité sera disponible dans la version complète',
                    confirmButtonColor: '#4f46e5'
                });
            });
        });

        // Animation au survol des cartes de statistiques
        document.querySelectorAll('.stat-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.boxShadow = '0 10px 25px rgba(0, 0, 0, 0.1)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.boxShadow = '';
            });
        });
        
        // Gestion de l'achat du document
        document.getElementById('purchaseBtn').addEventListener('click', function() {
            Swal.fire({
                title: 'Achat de votre historique médical',
                html: `
                    <div class="text-left">
                        <p class="mb-4">Vous êtes sur le point d'acheter l'accès complet à votre historique médical pour <span class="font-bold">19,99€</span>.</p>
                        <div class="bg-indigo-50 p-4 rounded-lg mb-4">
                            <p class="font-semibold">Ce document comprend:</p>
                            <ul class="list-disc pl-5 mt-2">
                                <li>Votre historique médical complet</li>
                                <li>Tous les comptes rendus de consultation</li>
                                <li>Vos résultats d'analyses et d'examens</li>
                                <li>Vos prescriptions médicales</li>
                                <li>Vos certificats médicaux</li>
                            </ul>
                        </div>
                        <p>Le document sera disponible au format PDF immédiatement après le paiement.</p>
                    </div>
                `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#4f46e5',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Confirmer l\'achat',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Simulation de chargement
                    Swal.fire({
                        title: 'Traitement en cours...',
                        html: 'Veuillez patienter pendant le traitement de votre paiement.',
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading()
                        }
                    }).then(() => {
                        // Succès
                        Swal.fire({
                            title: 'Achat réussi!',
                            text: 'Votre historique médical complet est maintenant disponible.',
                            icon: 'success',
                            confirmButtonColor: '#4f46e5'
                        });
                    });
                }
            });
        });
        
        // Gestion des notifications
        const notificationBtn = document.getElementById('notificationBtn');
        const notificationPanel = document.getElementById('notificationPanel');
        
        // Ouvrir/fermer le panneau de notifications
        notificationBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            notificationPanel.style.display = notificationPanel.style.display === 'block' ? 'none' : 'block';
            
            // Marquer toutes les notifications comme lues
            document.querySelectorAll('.notification-item.unread').forEach(item => {
                item.classList.remove('unread');
                const dot = item.querySelector('.rounded-full');
                if(dot) {
                    dot.classList.remove('bg-indigo-600');
                    dot.classList.add('bg-gray-300');
                }
            });
            
            // Réinitialiser le badge de notification
            const badge = document.querySelector('.notification-badge');
            badge.style.display = 'none';
        });
        
        // Fermer le panneau quand on clique ailleurs
        document.addEventListener('click', function(e) {
            if (!notificationPanel.contains(e.target) && e.target !== notificationBtn) {
                notificationPanel.style.display = 'none';
            }
        });
        
        // Fermer le panneau quand on clique sur une notification
        document.querySelectorAll('.notification-item').forEach(item => {
            item.addEventListener('click', function() {
                notificationPanel.style.display = 'none';
            });
        });
    </script>
</body>
</html>