<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes rendez-vous - BookDoctor</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .appointment-header {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        }
        .appointment-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-left: 4px solid #4f46e5;
        }
        .appointment-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .filter-btn {
            transition: all 0.2s ease;
        }
        .filter-btn.active {
            background-color: #4f46e5;
            color: white;
        }
        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        .calendar-day {
            transition: all 0.2s ease;
            cursor: pointer;
        }
        .calendar-day:hover {
            background-color: #eef2ff;
        }
        .calendar-day.selected {
            background-color: #4f46e5;
            color: white;
        }
        .calendar-day.has-appointment::after {
            content: '';
            position: absolute;
            bottom: 0.5rem;
            width: 0.5rem;
            height: 0.5rem;
            border-radius: 50%;
            background-color: #4f46e5;
        }
        .appointment-time-slot {
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            padding: 0.75rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .appointment-time-slot:hover {
            background-color: #eef2ff;
            border-color: #4f46e5;
        }
        .appointment-time-slot.selected {
            background-color: #4f46e5;
            color: white;
            border-color: #4f46e5;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .tab-content {
            display: none;
            animation: fadeIn 0.5s ease;
        }
        .tab-content.active {
            display: block;
        }
        .doctor-card {
            transition: all 0.3s ease;
            border-radius: 0.75rem;
            overflow: hidden;
        }
        .doctor-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
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
                        <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Tableau de bord</a>
                        <a href="#" class="border-indigo-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Mes rendez-vous</a>
                        <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Historique médical</a>
                        <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Documents</a>
                    </nav>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <button class="relative p-2 rounded-full text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <i class="fas fa-bell text-xl"></i>
                            <span class="absolute top-0 right-0 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">3</span>
                        </button>
                    </div>
                    <div class="relative">
                        <button class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Photo de profil">
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- En-tête des rendez-vous -->
    <div class="appointment-header py-12 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold">Mes rendez-vous</h1>
                    <p class="mt-2 text-indigo-100 max-w-2xl">
                        Gérez vos consultations médicales, prenez de nouveaux rendez-vous et consultez votre historique.
                    </p>
                </div>
                <button id="newAppointmentBtn" class="mt-4 md:mt-0 px-6 py-3 bg-white text-indigo-600 font-semibold rounded-lg shadow-md hover:bg-indigo-50 transition-colors duration-300 flex items-center">
                    <i class="fas fa-plus mr-2"></i> Nouveau rendez-vous
                </button>
            </div>
        </div>
    </div>

    <!-- Navigation par onglets -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
        <div class="tabs flex space-x-8 border-b border-gray-200">
            <div class="tab text-gray-900 font-medium active" data-tab="upcoming">
                <span class="py-2">À venir</span>
            </div>
            <div class="tab text-gray-500 font-medium hover:text-gray-700" data-tab="past">
                <span class="py-2">Historique</span>
            </div>
            <div class="tab text-gray-500 font-medium hover:text-gray-700" data-tab="schedule">
                <span class="py-2">Prendre rendez-vous</span>
            </div>
        </div>
    </div>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Onglet Rendez-vous à venir -->
        <div id="upcoming-tab" class="tab-content active">
            <div class="flex flex-wrap items-center justify-between mb-6">
                <h2 class="text-xl font-semibold text-gray-900">Vos prochains rendez-vous</h2>
                <div class="flex space-x-2 mt-2 sm:mt-0">
                    <button class="filter-btn px-3 py-1 text-sm rounded-full bg-indigo-100 text-indigo-800 active" data-filter="all">Tous</button>
                    <button class="filter-btn px-3 py-1 text-sm rounded-full bg-gray-100 text-gray-800" data-filter="confirmed">Confirmés</button>
                    <button class="filter-btn px-3 py-1 text-sm rounded-full bg-gray-100 text-gray-800" data-filter="pending">En attente</button>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Rendez-vous 1 -->
                <div class="appointment-card bg-white rounded-xl shadow-sm p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-indigo-100 rounded-lg p-3">
                            <i class="fas fa-stethoscope text-indigo-600 text-xl"></i>
                        </div>
                        <div class="ml-4 flex-1">
                            <div class="flex items-center justify-between">
                                <h3 class="text-md font-medium text-gray-900">Consultation de suivi</h3>
                                <span class="status-badge bg-green-100 text-green-800">
                                    Confirmé
                                </span>
                            </div>
                            <p class="mt-2 text-sm text-gray-500">
                                <i class="far fa-calendar mr-2"></i>Jeu. 15 Juin 2023 - 10:30
                            </p>
                            <p class="text-sm text-gray-500">
                                <i class="fas fa-user-md mr-2"></i>Dr. Dupont - Cardiologie
                            </p>
                            <p class="text-sm text-gray-500 mt-1">
                                <i class="fas fa-map-marker-alt mr-2"></i>Cabinet de Cardiologie, 12 Rue de la Paix, Paris
                            </p>
                            <div class="mt-4 flex space-x-2">
                                <button class="text-xs px-3 py-1 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors">
                                    <i class="fas fa-video mr-1"></i> Rejoindre
                                </button>
                                <button class="text-xs px-3 py-1 bg-gray-100 text-gray-800 rounded-md hover:bg-gray-200 transition-colors">
                                    <i class="fas fa-calendar-alt mr-1"></i> Reporter
                                </button>
                                <button class="text-xs px-3 py-1 bg-gray-100 text-gray-800 rounded-md hover:bg-gray-200 transition-colors">
                                    <i class="fas fa-times mr-1"></i> Annuler
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Rendez-vous 2 -->
                <div class="appointment-card bg-white rounded-xl shadow-sm p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-indigo-100 rounded-lg p-3">
                            <i class="fas fa-vial text-indigo-600 text-xl"></i>
                        </div>
                        <div class="ml-4 flex-1">
                            <div class="flex items-center justify-between">
                                <h3 class="text-md font-medium text-gray-900">Prise de sang</h3>
                                <span class="status-badge bg-yellow-100 text-yellow-800">
                                    En attente
                                </span>
                            </div>
                            <p class="mt-2 text-sm text-gray-500">
                                <i class="far fa-calendar mr-2"></i>Lun. 19 Juin 2023 - 08:15
                            </p>
                            <p class="text-sm text-gray-500">
                                <i class="fas fa-clinic-medical mr-2"></i>Laboratoire Médical Central
                            </p>
                            <p class="text-sm text-gray-500 mt-1">
                                <i class="fas fa-map-marker-alt mr-2"></i>24 Avenue des Champs-Élysées, Paris
                            </p>
                            <div class="mt-4 flex space-x-2">
                                <button class="text-xs px-3 py-1 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors">
                                    <i class="fas fa-check mr-1"></i> Confirmer
                                </button>
                                <button class="text-xs px-3 py-1 bg-gray-100 text-gray-800 rounded-md hover:bg-gray-200 transition-colors">
                                    <i class="fas fa-calendar-alt mr-1"></i> Reporter
                                </button>
                                <button class="text-xs px-3 py-1 bg-gray-100 text-gray-800 rounded-md hover:bg-gray-200 transition-colors">
                                    <i class="fas fa-times mr-1"></i> Annuler
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Rendez-vous 3 -->
                <div class="appointment-card bg-white rounded-xl shadow-sm p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-indigo-100 rounded-lg p-3">
                            <i class="fas fa-tooth text-indigo-600 text-xl"></i>
                        </div>
                        <div class="ml-4 flex-1">
                            <div class="flex items-center justify-between">
                                <h3 class="text-md font-medium text-gray-900">Contrôle dentaire</h3>
                                <span class="status-badge bg-blue-100 text-blue-800">
                                    Confirmé
                                </span>
                            </div>
                            <p class="mt-2 text-sm text-gray-500">
                                <i class="far fa-calendar mr-2"></i>Ven. 30 Juin 2023 - 14:00
                            </p>
                            <p class="text-sm text-gray-500">
                                <i class="fas fa-user-md mr-2"></i>Dr. Lambert - Dentiste
                            </p>
                            <p class="text-sm text-gray-500 mt-1">
                                <i class="fas fa-map-marker-alt mr-2"></i>45 Boulevard Saint-Germain, Paris
                            </p>
                            <div class="mt-4 flex space-x-2">
                                <button class="text-xs px-3 py-1 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors">
                                    <i class="fas fa-directions mr-1"></i> Itinéraire
                                </button>
                                <button class="text-xs px-3 py-1 bg-gray-100 text-gray-800 rounded-md hover:bg-gray-200 transition-colors">
                                    <i class="fas fa-calendar-alt mr-1"></i> Reporter
                                </button>
                                <button class="text-xs px-3 py-1 bg-gray-100 text-gray-800 rounded-md hover:bg-gray-200 transition-colors">
                                    <i class="fas fa-times mr-1"></i> Annuler
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Onglet Historique des rendez-vous -->
        <div id="past-tab" class="tab-content">
            <div class="flex flex-wrap items-center justify-between mb-6">
                <h2 class="text-xl font-semibold text-gray-900">Historique de vos rendez-vous</h2>
                <div class="flex space-x-2 mt-2 sm:mt-0">
                    <select class="px-3 py-1 text-sm rounded-md border border-gray-300 bg-white">
                        <option>Tous les médecins</option>
                        <option>Dr. Dupont</option>
                        <option>Dr. Lambert</option>
                        <option>Laboratoire Médical</option>
                    </select>
                    <select class="px-3 py-1 text-sm rounded-md border border-gray-300 bg-white">
                        <option>3 derniers mois</option>
                        <option>6 derniers mois</option>
                        <option>2023</option>
                        <option>2022</option>
                    </select>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Médecin/Spécialiste</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Motif</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">12 Mai 2023</div>
                                    <div class="text-sm text-gray-500">10:30 - 11:15</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Dr. Dupont</div>
                                            <div class="text-sm text-gray-500">Cardiologie</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">Contrôle trimestriel</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="status-badge bg-green-100 text-green-800">Terminé</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">5 Avril 2023</div>
                                    <div class="text-sm text-gray-500">14:00 - 14:45</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1537368910025-700350fe46c7?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Dr. Lambert</div>
                                            <div class="text-sm text-gray-500">Dentiste</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">Détartrage</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="status-badge bg-green-100 text-green-800">Terminé</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">28 Mars 2023</div>
                                    <div class="text-sm text-gray-500">09:00 - 09:30</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 bg-gray-200 rounded-full flex items-center justify-center">
                                            <i class="fas fa-flask text-gray-500"></i>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Laboratoire Médical</div>
                                            <div class="text-sm text-gray-500">Analyse sanguine</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">Bilan sanguin annuel</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="status-badge bg-green-100 text-green-800">Terminé</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">15 Février 2023</div>
                                    <div class="text-sm text-gray-500">11:30 - 12:15</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Dr. Dupont</div>
                                            <div class="text-sm text-gray-500">Cardiologie</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">Consultation initiale</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="status-badge bg-green-100 text-green-800">Terminé</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 bg-gray-50 text-center">
                    <button class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">
                        Afficher plus de rendez-vous <i class="fas fa-arrow-down ml-1"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Onglet Prendre rendez-vous -->
        <div id="schedule-tab" class="tab-content">
            <div class="grid grid-cols-1 gap-8">
                <div>
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-medium text-gray-900">Choisissez un créneau</h2>
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="text-md font-medium text-gray-900">Dr. Marie Dupont - Cardiologie</h3>
                                <div class="flex items-center">
                                    <span class="text-sm text-gray-500 mr-3">Cabinet principal</span>
                                    <div class="relative">
                                        <select class="pl-8 pr-10 py-2 border border-gray-300 rounded-md bg-white">
                                            <option>En cabinet</option>
                                            <option>En ligne</option>
                                        </select>
                                        <i class="fas fa-map-marker-alt absolute left-3 top-3 text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-6">
                                <div class="flex justify-between mb-4">
                                    <button id="prevWeek" class="p-2 rounded-full hover:bg-gray-100">
                                        <i class="fas fa-chevron-left"></i>
                                    </button>
                                    <h4 class="text-lg font-semibold text-gray-900">Semaine du 12 Juin 2023</h4>
                                    <button id="nextWeek" class="p-2 rounded-full hover:bg-gray-100">
                                        <i class="fas fa-chevron-right"></i>
                                    </button>
                                </div>
                                
                                <div class="grid grid-cols-7 gap-1 mb-4">
                                    <div class="text-center py-2 text-sm font-medium text-gray-500">Lun</div>
                                    <div class="text-center py-2 text-sm font-medium text-gray-500">Mar</div>
                                    <div class="text-center py-2 text-sm font-medium text-gray-500">Mer</div>
                                    <div class="text-center py-2 text-sm font-medium text-gray-500">Jeu</div>
                                    <div class="text-center py-2 text-sm font-medium text-gray-500">Ven</div>
                                    <div class="text-center py-2 text-sm font-medium text-gray-500">Sam</div>
                                    <div class="text-center py-2 text-sm font-medium text-gray-500">Dim</div>
                                    
                                    <!-- Calendar Days -->
                                    <div class="calendar-day text-center py-3 relative">10</div>
                                    <div class="calendar-day text-center py-3 relative">11</div>
                                    <div class="calendar-day text-center py-3 relative">12</div>
                                    <div class="calendar-day selected text-center py-3 relative text-white">13</div>
                                    <div class="calendar-day text-center py-3 relative">14</div>
                                    <div class="calendar-day text-center py-3 relative text-gray-400">15</div>
                                    <div class="calendar-day text-center py-3 relative text-gray-400">16</div>
                                </div>
                            </div>
                            
                            <div>
                                <h4 class="text-md font-medium text-gray-900 mb-4">Créneaux disponibles - Jeudi 13 Juin</h4>
                                <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 gap-3">
                                    <div class="appointment-time-slot">08:00</div>
                                    <div class="appointment-time-slot">08:30</div>
                                    <div class="appointment-time-slot">09:00</div>
                                    <div class="appointment-time-slot">09:30</div>
                                    <div class="appointment-time-slot">10:00</div>
                                    <div class="appointment-time-slot selected">10:30</div>
                                    <div class="appointment-time-slot">11:00</div>
                                    <div class="appointment-time-slot">11:30</div>
                                    <div class="appointment-time-slot">14:00</div>
                                    <div class="appointment-time-slot">14:30</div>
                                    <div class="appointment-time-slot">15:00</div>
                                    <div class="appointment-time-slot">15:30</div>
                                    <div class="appointment-time-slot">16:00</div>
                                    <div class="appointment-time-slot">16:30</div>
                                    <div class="appointment-time-slot">17:00</div>
                                </div>
                            </div>
                            
                            <div class="mt-8">
                                <button class="w-full py-3 bg-indigo-600 text-white font-medium rounded-md hover:bg-indigo-700 transition-colors">
                                    Confirmer le rendez-vous à 10:30
                                </button>
                            </div>
                        </div>
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

        // Gestion des filtres
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.filter-btn').forEach(b => {
                    b.classList.remove('active', 'bg-indigo-100', 'text-indigo-800');
                    b.classList.add('bg-gray-100', 'text-gray-800');
                });
                this.classList.add('active', 'bg-indigo-100', 'text-indigo-800');
                this.classList.remove('bg-gray-100', 'text-gray-800');
            });
        });

        // Gestion de la création d'un nouveau rendez-vous
        document.getElementById('newAppointmentBtn').addEventListener('click', function() {
            // Activer l'onglet "Prendre rendez-vous"
            document.querySelectorAll('.tab').forEach(t => {
                t.classList.remove('active', 'text-gray-900');
                t.classList.add('text-gray-500', 'hover:text-gray-700');
            });
            
            const scheduleTab = document.querySelector('.tab[data-tab="schedule"]');
            scheduleTab.classList.add('active', 'text-gray-900');
            scheduleTab.classList.remove('text-gray-500', 'hover:text-gray-700');
            
            // Afficher le contenu de l'onglet
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.remove('active');
            });
            document.getElementById('schedule-tab').classList.add('active');
            
            // Faire défiler jusqu'à la section
            document.getElementById('schedule-tab').scrollIntoView({ behavior: 'smooth' });
        });

        // Gestion de la sélection de créneaux
        document.querySelectorAll('.appointment-time-slot').forEach(slot => {
            slot.addEventListener('click', function() {
                document.querySelectorAll('.appointment-time-slot').forEach(s => {
                    s.classList.remove('selected', 'bg-indigo-600', 'text-white');
                });
                this.classList.add('selected', 'bg-indigo-600', 'text-white');
            });
        });

        // Gestion de la sélection de jour dans le calendrier
        document.querySelectorAll('.calendar-day').forEach(day => {
            day.addEventListener('click', function() {
                if(!this.classList.contains('text-gray-400')) {
                    document.querySelectorAll('.calendar-day').forEach(d => {
                        d.classList.remove('selected', 'bg-indigo-600', 'text-white');
                    });
                    this.classList.add('selected', 'bg-indigo-600', 'text-white');
                }
            });
        });

        // Simulation d'annulation de rendez-vous
        document.querySelectorAll('.appointment-card .fa-times').forEach(icon => {
            icon.closest('button').addEventListener('click', function() {
                const appointmentCard = this.closest('.appointment-card');
                const appointmentTitle = appointmentCard.querySelector('h3').textContent;
                
                Swal.fire({
                    title: 'Annuler le rendez-vous?',
                    html: `Êtes-vous sûr de vouloir annuler votre rendez-vous pour <b>${appointmentTitle}</b>?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#4f46e5',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Oui, annuler',
                    cancelButtonText: 'Non, garder'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Animation de disparition
                        appointmentCard.style.opacity = '1';
                        let opacity = 1;
                        const fadeEffect = setInterval(() => {
                            if (opacity <= 0) {
                                clearInterval(fadeEffect);
                                appointmentCard.remove();
                                
                                // Message de confirmation
                                Swal.fire({
                                    title: 'Rendez-vous annulé',
                                    text: 'Votre rendez-vous a été annulé avec succès.',
                                    icon: 'success',
                                    confirmButtonColor: '#4f46e5'
                                });
                            } else {
                                opacity -= 0.05;
                                appointmentCard.style.opacity = opacity;
                            }
                        }, 30);
                    }
                });
            });
        });

        // Simulation de confirmation de rendez-vous
        document.querySelectorAll('.appointment-card .fa-check').forEach(icon => {
            icon.closest('button').addEventListener('click', function() {
                const appointmentCard = this.closest('.appointment-card');
                const statusBadge = appointmentCard.querySelector('.status-badge');
                
                statusBadge.textContent = 'Confirmé';
                statusBadge.classList.remove('bg-yellow-100', 'text-yellow-800');
                statusBadge.classList.add('bg-green-100', 'text-green-800');
                
                // Cacher les boutons de confirmation
                this.style.display = 'none';
                
                Swal.fire({
                    title: 'Rendez-vous confirmé!',
                    text: 'Votre rendez-vous a été confirmé avec succès.',
                    icon: 'success',
                    confirmButtonColor: '#4f46e5'
                });
            });
        });
    </script>
</body>
</html>