<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prendre rendez-vous - BookDoctor</title>
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
        .doctor-card {
            transition: all 0.3s ease;
            border-radius: 0.75rem;
            overflow: hidden;
        }
        .doctor-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in {
            animation: fadeIn 0.5s ease;
        }
        .step-indicator {
            position: relative;
            display: flex;
            justify-content: space-between;
            max-width: 600px;
            margin: 0 auto 2rem;
        }
        .step {
            position: relative;
            flex: 1;
            text-align: center;
            z-index: 2;
        }
        .step-number {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 0.5rem;
            font-weight: bold;
            color: #6b7280;
            transition: all 0.3s ease;
        }
        .step.active .step-number {
            background-color: #4f46e5;
            color: white;
        }
        .step-label {
            font-size: 0.875rem;
            color: #6b7280;
            transition: all 0.3s ease;
        }
        .step.active .step-label {
            color: #4f46e5;
            font-weight: 500;
        }
        .step-indicator::before {
            content: '';
            position: absolute;
            top: 18px;
            left: 0;
            right: 0;
            height: 2px;
            background-color: #e5e7eb;
            z-index: 1;
        }
        .step:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 18px;
            right: -50%;
            width: 100%;
            height: 2px;
            background-color: #4f46e5;
            z-index: 1;
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }
        .step.active:not(:last-child)::after {
            transform: scaleX(1);
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
                    <nav class="ml-10 hidden md:flex space-x-8">
                        <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Tableau de bord</a>
                        <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Mes rendez-vous</a>
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
                            <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Photo de profil">
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
                    <h1 class="text-3xl font-bold">Prendre un rendez-vous</h1>
                    <p class="mt-2 text-indigo-100 max-w-2xl">
                        Choisissez un médecin, une date et un créneau pour votre consultation médicale.
                    </p>
                </div>
                <div class="mt-4 md:mt-0 flex space-x-2">
                    <button class="px-4 py-2 bg-white bg-opacity-20 text-white font-medium rounded-lg hover:bg-opacity-30 transition-colors duration-300 flex items-center">
                        <i class="fas fa-question-circle mr-2"></i> Aide
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Indicateur d'étapes -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
        <div class="step-indicator">
            <div class="step active" id="step1">
                <div class="step-number">1</div>
                <div class="step-label">Choisir un médecin</div>
            </div>
            <div class="step" id="step2">
                <div class="step-number">2</div>
                <div class="step-label">Sélectionner une date</div>
            </div>
            <div class="step" id="step3">
                <div class="step-number">3</div>
                <div class="step-label">Choisir un créneau</div>
            </div>
            <div class="step" id="step4">
                <div class="step-number">4</div>
                <div class="step-label">Confirmer</div>
            </div>
        </div>
    </div>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <!-- Étape 1: Choisir un médecin -->
        <div id="step1-content" class="step-content active fade-in">
            <div class="mb-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Sélectionnez un médecin ou une spécialité</h2>
                <div class="flex flex-col sm:flex-row gap-4 mb-6">
                    <div class="relative flex-grow">
                        <input type="text" placeholder="Rechercher un médecin, une spécialité..." class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <i class="fas fa-search absolute left-3 top-3.5 text-gray-400"></i>
                    </div>
                    <select class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option>Toutes les spécialités</option>
                        <option>Médecin généraliste</option>
                        <option>Cardiologie</option>
                        <option>Dermatologie</option>
                        <option>Pédiatrie</option>
                        <option>Ophtalmologie</option>
                        <option>ORL</option>
                        <option>Gynécologie</option>
                    </select>

                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Médecin 1 -->
                <div class="doctor-card bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-start">
                            <img class="h-16 w-16 rounded-full object-cover" src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Dr. Marie Dupont">
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">Dr. Marie Dupont</h3>
                                <p class="text-sm text-gray-500">Cardiologue</p>
                                <div class="mt-2 flex items-center">
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <span class="ml-1 text-sm font-medium text-gray-900">4.8</span>
                                    <span class="mx-2 text-gray-300">•</span>
                                    <span class="text-sm text-gray-500">15 ans d'expérience</span>
                                </div>
                                <div class="mt-2 flex items-center text-sm text-gray-500">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span>12 Rue de la Paix, Paris</span>
                                </div>
                                <div class="mt-2 flex items-center text-sm text-gray-500">
                                    <i class="fas fa-euro-sign mr-2"></i>
                                    <span>Consultation: 60€</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-200 flex justify-between">
                            <div class="flex items-center">
                                <i class="fas fa-video text-indigo-600 mr-2"></i>
                                <span class="text-sm">Visio disponible</span>
                            </div>
                            <button class="select-doctor-btn px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 transition-colors" data-doctor-id="1">
                                Sélectionner
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Médecin 2 -->
                <div class="doctor-card bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-start">
                            <img class="h-16 w-16 rounded-full object-cover" src="https://images.unsplash.com/photo-1537368910025-700350fe46c7?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Dr. Jean Lambert">
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">Dr. Jean Lambert</h3>
                                <p class="text-sm text-gray-500">Dentiste</p>
                                <div class="mt-2 flex items-center">
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <span class="ml-1 text-sm font-medium text-gray-900">4.7</span>
                                    <span class="mx-2 text-gray-300">•</span>
                                    <span class="text-sm text-gray-500">12 ans d'expérience</span>
                                </div>
                                <div class="mt-2 flex items-center text-sm text-gray-500">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span>45 Bd Saint-Germain, Paris</span>
                                </div>
                                <div class="mt-2 flex items-center text-sm text-gray-500">
                                    <i class="fas fa-euro-sign mr-2"></i>
                                    <span>Consultation: 50€</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-200 flex justify-between">
                            <div class="flex items-center">
                                <i class="fas fa-video text-gray-400 mr-2"></i>
                                <span class="text-sm text-gray-400">Visio non disponible</span>
                            </div>
                            <button class="select-doctor-btn px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 transition-colors" data-doctor-id="2">
                                Sélectionner
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Médecin 3 -->
                <div class="doctor-card bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-start">
                            <img class="h-16 w-16 rounded-full object-cover" src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Dr. Sophie Martin">
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">Dr. Sophie Martin</h3>
                                <p class="text-sm text-gray-500">Pédiatre</p>
                                <div class="mt-2 flex items-center">
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <span class="ml-1 text-sm font-medium text-gray-900">4.9</span>
                                    <span class="mx-2 text-gray-300">•</span>
                                    <span class="text-sm text-gray-500">18 ans d'expérience</span>
                                </div>
                                <div class="mt-2 flex items-center text-sm text-gray-500">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span>32 Av. des Ternes, Paris</span>
                                </div>
                                <div class="mt-2 flex items-center text-sm text-gray-500">
                                    <i class="fas fa-euro-sign mr-2"></i>
                                    <span>Consultation: 55€</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-200 flex justify-between">
                            <div class="flex items-center">
                                <i class="fas fa-video text-indigo-600 mr-2"></i>
                                <span class="text-sm">Visio disponible</span>
                            </div>
                            <button class="select-doctor-btn px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 transition-colors" data-doctor-id="3">
                                Sélectionner
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Étape 2: Sélectionner une date -->
        <div id="step2-content" class="step-content hidden fade-in">
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex justify-between items-center">
                        <h2 class="text-lg font-medium text-gray-900">Choisissez une date</h2>
                        <div class="flex items-center">
                            <div class="flex items-center mr-4">
                                <img class="h-10 w-10 rounded-full mr-3" src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Dr. Marie Dupont">
                                <div>
                                    <div class="text-sm font-medium text-gray-900">Dr. Marie Dupont</div>
                                    <div class="text-sm text-gray-500">Cardiologie</div>
                                </div>
                            </div>
                            <div class="relative">
                                <select class="pl-8 pr-10 py-2 border border-gray-300 rounded-md bg-white">
                                    <option>En cabinet</option>
                                    <option>En ligne</option>
                                </select>
                                <i class="fas fa-map-marker-alt absolute left-3 top-3 text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="mb-6">
                        <div class="flex justify-between mb-4">
                            <button id="prevMonth" class="p-2 rounded-full hover:bg-gray-100">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <h4 class="text-lg font-semibold text-gray-900" id="currentMonthYear">Juin 2023</h4>
                            <button id="nextMonth" class="p-2 rounded-full hover:bg-gray-100">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                        
                        <div class="grid grid-cols-7 gap-1 mb-2">
                            <div class="text-center py-2 text-sm font-medium text-gray-500">Lun</div>
                            <div class="text-center py-2 text-sm font-medium text-gray-500">Mar</div>
                            <div class="text-center py-2 text-sm font-medium text-gray-500">Mer</div>
                            <div class="text-center py-2 text-sm font-medium text-gray-500">Jeu</div>
                            <div class="text-center py-2 text-sm font-medium text-gray-500">Ven</div>
                            <div class="text-center py-2 text-sm font-medium text-gray-500">Sam</div>
                            <div class="text-center py-2 text-sm font-medium text-gray-500">Dim</div>
                        </div>
                        
                        <div class="grid grid-cols-7 gap-1" id="calendarDays">
                            <!-- Les jours du calendrier seront générés dynamiquement -->
                        </div>
                    </div>
                    
                    <div class="mt-8 flex justify-between">
                        <button class="back-step-btn px-6 py-3 bg-gray-100 text-gray-800 font-medium rounded-lg hover:bg-gray-200 transition-colors">
                            <i class="fas fa-arrow-left mr-2"></i> Retour
                        </button>
                        <button class="next-step-btn px-6 py-3 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition-colors disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                            Suivant <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Étape 3: Choisir un créneau -->
        <div id="step3-content" class="step-content hidden fade-in">
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex justify-between items-center">
                        <h2 class="text-lg font-medium text-gray-900">Choisissez un créneau</h2>
                        <div class="flex items-center">
                            <div class="flex items-center mr-4">
                                <img class="h-10 w-10 rounded-full mr-3" src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Dr. Marie Dupont">
                                <div>
                                    <div class="text-sm font-medium text-gray-900">Dr. Marie Dupont</div>
                                    <div class="text-sm text-gray-500">Cardiologie</div>
                                </div>
                            </div>
                            <div class="text-sm bg-indigo-50 text-indigo-700 px-3 py-1 rounded-md">
                                <i class="far fa-calendar mr-2"></i>
                                <span id="selectedDateDisplay">Jeudi 15 juin 2023</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="mb-6">
                        <h4 class="text-md font-medium text-gray-900 mb-4">Créneaux disponibles</h4>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3" id="timeSlotsContainer">
                            <!-- Les créneaux horaires seront générés dynamiquement -->
                        </div>
                    </div>
                    
                    <div class="mt-8 flex justify-between">
                        <button class="back-step-btn px-6 py-3 bg-gray-100 text-gray-800 font-medium rounded-lg hover:bg-gray-200 transition-colors">
                            <i class="fas fa-arrow-left mr-2"></i> Retour
                        </button>
                        <button class="next-step-btn px-6 py-3 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition-colors disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                            Suivant <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Étape 4: Confirmation -->
        <div id="step4-content" class="step-content hidden fade-in">
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-900">Confirmez votre rendez-vous</h2>
                </div>
                <div class="p-6">
                    <div class="flex flex-col md:flex-row gap-8">
                        <div class="md:w-2/3">
                            <div class="appointment-card bg-white rounded-xl shadow-sm p-6">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-indigo-100 rounded-lg p-3">
                                        <i class="fas fa-stethoscope text-indigo-600 text-xl"></i>
                                    </div>
                                    <div class="ml-4 flex-1">
                                        <div class="flex items-center justify-between">
                                            <h3 class="text-md font-medium text-gray-900">Consultation de cardiologie</h3>
                                        </div>
                                        <p class="mt-2 text-sm text-gray-500">
                                            <i class="far fa-calendar mr-2"></i>
                                            <span id="confirmationDate">Jeudi 15 Juin 2023 - 10:30</span>
                                        </p>
                                        <p class="text-sm text-gray-500">
                                            <i class="fas fa-user-md mr-2"></i>
                                            <span id="confirmationDoctor">Dr. Marie Dupont - Cardiologie</span>
                                        </p>
                                        <p class="text-sm text-gray-500 mt-1">
                                            <i class="fas fa-map-marker-alt mr-2"></i>
                                            <span id="confirmationLocation">Cabinet de Cardiologie, 12 Rue de la Paix, Paris</span>
                                        </p>
                                        <div class="mt-4">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Motif de consultation</label>
                                            <textarea class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Décrivez brièvement le motif de votre consultation..." rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-6 bg-blue-50 border border-blue-100 rounded-lg p-4">
                                <h4 class="text-sm font-medium text-blue-800 flex items-center">
                                    <i class="fas fa-info-circle mr-2"></i> Informations importantes
                                </h4>
                                <ul class="mt-2 text-sm text-blue-700 list-disc pl-5 space-y-1">
                                    <li>Veuillez arriver 10 minutes avant votre rendez-vous</li>
                                    <li>Pensez à apporter votre carte vitale et votre pièce d'identité</li>
                                    <li>En cas d'annulation, merci de nous prévenir au moins 24h à l'avance</li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="md:w-1/3">
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Récapitulatif</h3>
                                <div class="space-y-4">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Consultation</span>
                                        <span class="font-medium">60€</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Frais de dossier</span>
                                        <span class="font-medium">5€</span>
                                    </div>
                                    <div class="border-t border-gray-200 pt-4 mt-4">
                                        <div class="flex justify-between">
                                            <span class="text-gray-900 font-medium">Total</span>
                                            <span class="text-gray-900 font-medium">65€</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-6">
                                    <button id="confirmAppointmentBtn" class="w-full py-3 bg-indigo-600 text-white font-medium rounded-md hover:bg-indigo-700 transition-colors flex items-center justify-center">
                                        <i class="fas fa-calendar-check mr-2"></i> Confirmer le rendez-vous
                                    </button>
                                </div>
                                <div class="mt-4 text-center">
                                    <button class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                                        <i class="fas fa-file-pdf mr-1"></i> Télécharger le reçu
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-8 flex justify-between">
                        <button class="back-step-btn px-6 py-3 bg-gray-100 text-gray-800 font-medium rounded-lg hover:bg-gray-200 transition-colors">
                            <i class="fas fa-arrow-left mr-2"></i> Retour
                        </button>
                        <button class="px-6 py-3 bg-white border border-gray-300 text-gray-800 font-medium rounded-lg hover:bg-gray-50 transition-colors">
                            <i class="fas fa-print mr-2"></i> Imprimer
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
        // Variables globales
        let selectedDoctor = null;
        let selectedDate = null;
        let selectedTime = null;
        let currentMonth = 5; // Juin (0-indexed)
        let currentYear = 2023;
        
        // Initialisation
        document.addEventListener('DOMContentLoaded', function() {
            generateCalendar(currentMonth, currentYear);
            generateTimeSlots();
            
            // Navigation entre les étapes
            document.querySelectorAll('.next-step-btn').forEach(btn => {
                btn.addEventListener('click', nextStep);
            });
            
            document.querySelectorAll('.back-step-btn').forEach(btn => {
                btn.addEventListener('click', previousStep);
            });
            
            // Sélection du médecin
            document.querySelectorAll('.select-doctor-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    selectedDoctor = this.getAttribute('data-doctor-id');
                    document.getElementById('step1').classList.remove('active');
                    document.getElementById('step2').classList.add('active');
                    document.getElementById('step1-content').classList.remove('active');
                    document.getElementById('step1-content').classList.add('hidden');
                    document.getElementById('step2-content').classList.remove('hidden');
                    document.getElementById('step2-content').classList.add('active');
                });
            });
            
            // Navigation dans le calendrier
            document.getElementById('prevMonth').addEventListener('click', function() {
                currentMonth--;
                if (currentMonth < 0) {
                    currentMonth = 11;
                    currentYear--;
                }
                generateCalendar(currentMonth, currentYear);
            });
            
            document.getElementById('nextMonth').addEventListener('click', function() {
                currentMonth++;
                if (currentMonth > 11) {
                    currentMonth = 0;
                    currentYear++;
                }
                generateCalendar(currentMonth, currentYear);
            });
            
            // Confirmation du rendez-vous
            document.getElementById('confirmAppointmentBtn').addEventListener('click', function() {
                Swal.fire({
                    title: 'Rendez-vous confirmé!',
                    text: 'Votre consultation a été réservée avec succès.',
                    icon: 'success',
                    confirmButtonColor: '#4f46e5',
                    confirmButtonText: 'OK'
                }).then(() => {
                    // Réinitialiser pour un nouveau rendez-vous
                    resetAppointmentProcess();
                });
            });
        });
        
        // Fonctions
        function nextStep() {
            const currentStep = document.querySelector('.step.active');
            const nextStep = currentStep.nextElementSibling;
            
            if (nextStep) {
                currentStep.classList.remove('active');
                nextStep.classList.add('active');
                
                const currentStepContent = document.querySelector('.step-content.active');
                currentStepContent.classList.remove('active');
                currentStepContent.classList.add('hidden');
                
                const nextStepId = nextStep.id.replace('step', 'step') + '-content';
                const nextStepContent = document.getElementById(nextStepId);
                nextStepContent.classList.remove('hidden');
                nextStepContent.classList.add('active');
            }
        }
        
        function previousStep() {
            const currentStep = document.querySelector('.step.active');
            const prevStep = currentStep.previousElementSibling;
            
            if (prevStep) {
                currentStep.classList.remove('active');
                prevStep.classList.add('active');
                
                const currentStepContent = document.querySelector('.step-content.active');
                currentStepContent.classList.remove('active');
                currentStepContent.classList.add('hidden');
                
                const prevStepId = prevStep.id.replace('step', 'step') + '-content';
                const prevStepContent = document.getElementById(prevStepId);
                prevStepContent.classList.remove('hidden');
                prevStepContent.classList.add('active');
            }
        }
        
        function generateCalendar(month, year) {
            const calendarDays = document.getElementById('calendarDays');
            calendarDays.innerHTML = '';
            
            const monthNames = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];
            document.getElementById('currentMonthYear').textContent = `${monthNames[month]} ${year}`;
            
            // Premier jour du mois
            const firstDay = new Date(year, month, 1).getDay();
            // Dernier jour du mois
            const daysInMonth = new Date(year, month + 1, 0).getDate();
            
            // Remplir les jours vides avant le premier jour
            for (let i = 0; i < firstDay; i++) {
                const emptyDay = document.createElement('div');
                emptyDay.classList.add('calendar-day', 'text-center', 'py-3', 'relative', 'text-gray-400');
                calendarDays.appendChild(emptyDay);
            }
            
            // Remplir les jours du mois
            const today = new Date();
            const currentDate = today.getDate();
            const currentMonth = today.getMonth();
            const currentYear = today.getFullYear();
            
            for (let day = 1; day <= daysInMonth; day++) {
                const dayElement = document.createElement('div');
                dayElement.classList.add('calendar-day', 'text-center', 'py-3', 'relative');
                dayElement.textContent = day;
                
                // Ajouter des rendez-vous fictifs pour certains jours
                if (day % 4 === 0 || day % 7 === 0) {
                    dayElement.classList.add('has-appointment');
                }
                
                // Marquer aujourd'hui
                if (day === currentDate && month === currentMonth && year === currentYear) {
                    dayElement.classList.add('font-bold', 'text-indigo-600');
                    dayElement.innerHTML = `${day}<span class="absolute bottom-1 left-1/2 transform -translate-x-1/2 w-1 h-1 bg-indigo-600 rounded-full"></span>`;
                }
                
                // Désactiver les jours passés
                if ((year < currentYear) || 
                    (year === currentYear && month < currentMonth) || 
                    (year === currentYear && month === currentMonth && day < currentDate)) {
                    dayElement.classList.add('text-gray-400');
                } else {
                    dayElement.addEventListener('click', function() {
                        if (!this.classList.contains('text-gray-400')) {
                            document.querySelectorAll('.calendar-day').forEach(d => {
                                d.classList.remove('selected', 'bg-indigo-600', 'text-white');
                            });
                            this.classList.add('selected', 'bg-indigo-600', 'text-white');
                            
                            // Activer le bouton suivant
                            document.querySelector('#step2-content .next-step-btn').disabled = false;
                            
                            // Stocker la date sélectionnée
                            selectedDate = new Date(year, month, day);
                            const options = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' };
                            document.getElementById('selectedDateDisplay').textContent = selectedDate.toLocaleDateString('fr-FR', options);
                        }
                    });
                }
                
                calendarDays.appendChild(dayElement);
            }
        }
        
        function generateTimeSlots() {
            const container = document.getElementById('timeSlotsContainer');
            container.innerHTML = '';
            
            const times = [
                '08:00', '08:30', '09:00', '09:30', '10:00', 
                '10:30', '11:00', '11:30', '14:00', '14:30', 
                '15:00', '15:30', '16:00', '16:30', '17:00'
            ];
            
            times.forEach(time => {
                const slot = document.createElement('div');
                slot.classList.add('appointment-time-slot');
                slot.textContent = time;
                
                // Marquer certains créneaux comme indisponibles
                if (time === '08:00' || time === '14:30') {
                    slot.classList.add('bg-gray-100', 'text-gray-400');
                    slot.style.cursor = 'not-allowed';
                } else {
                    slot.addEventListener('click', function() {
                        document.querySelectorAll('.appointment-time-slot').forEach(s => {
                            s.classList.remove('selected', 'bg-indigo-600', 'text-white');
                        });
                        this.classList.add('selected', 'bg-indigo-600', 'text-white');
                        
                        // Activer le bouton suivant
                        document.querySelector('#step3-content .next-step-btn').disabled = false;
                        
                        // Stocker le créneau sélectionné
                        selectedTime = time;
                        document.getElementById('confirmationDate').textContent = `Jeudi 15 Juin 2023 - ${time}`;
                    });
                }
                
                container.appendChild(slot);
            });
        }
        
        function resetAppointmentProcess() {
            // Réinitialiser les sélections
            selectedDoctor = null;
            selectedDate = null;
            selectedTime = null;
            
            // Réinitialiser l'interface
            document.querySelectorAll('.step').forEach((step, index) => {
                step.classList.remove('active');
                if (index === 0) step.classList.add('active');
            });
            
            document.querySelectorAll('.step-content').forEach((content, index) => {
                content.classList.remove('active');
                content.classList.add('hidden');
                if (index === 0) {
                    content.classList.remove('hidden');
                    content.classList.add('active');
                }
            });
            
            // Réinitialiser le calendrier
            const today = new Date();
            currentMonth = today.getMonth();
            currentYear = today.getFullYear();
            generateCalendar(currentMonth, currentYear);
            
            // Réinitialiser les boutons
            document.querySelectorAll('.next-step-btn').forEach(btn => {
                btn.disabled = true;
            });
        }
    </script>
</body>
</html>