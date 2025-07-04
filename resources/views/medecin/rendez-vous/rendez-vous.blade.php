<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visites Hebdomadaires - BookDoctor</title>
    <script src="https://cdn.tailwindcss.com"></script>
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

        .section-card {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border-radius: 0.75rem;
            overflow: hidden;
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
            overflow-x: auto;
        }
        
        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
        }
        
        .status-confirmed {
            background-color: #d1fae5;
            color: #065f46;
        }
        
        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
        }
        
        .status-canceled {
            background-color: #fee2e2;
            color: #b91c1c;
        }
        
        .status-completed {
            background-color: #dbeafe;
            color: #1e40af;
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
        
        .table-header {
            background-color: #f9fafb;
            text-transform: uppercase;
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--gray);
        }
        
        .table-row {
            border-bottom: 1px solid #f1f1f1;
            transition: background-color 0.2s;
        }
        
        .table-row:hover {
            background-color: #f9fafb;
        }
        
        .action-btn {
            padding: 0.4rem 0.8rem;
            border-radius: 0.375rem;
            font-size: 0.875rem;
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
        
        .btn-outline {
            background-color: white;
            border: 1px solid #d1d5db;
            color: #374151;
        }
        
        .btn-outline:hover {
            background-color: #f9fafb;
        }
        
        .week-navigation {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }
        
        .week-days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 0.5rem;
            margin-bottom: 1rem;
        }
        
        .day-card {
            text-align: center;
            padding: 0.75rem;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .day-card:hover {
            background-color: #eef2ff;
        }
        
        .day-card.active {
            background-color: var(--primary);
            color: white;
        }
        
        .day-name {
            font-size: 0.875rem;
            color: var(--gray);
        }
        
        .day-card.active .day-name {
            color: white;
        }
        
        .day-number {
            font-size: 1.25rem;
            font-weight: 600;
            margin-top: 0.25rem;
        }
        
        .empty-state {
            text-align: center;
            padding: 2rem;
            color: #6b7280;
        }
        
        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #d1d5db;
        }
        
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }
        
        @media (min-width: 768px) {
            .summary-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }
        
        .time-info {
            display: inline-block;
            background-color: #f3f4f6;
            padding: 0.25rem 0.5rem;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header de navigation -->
    <header>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <a href="#" class="logo flex items-center">
                <i class="fas fa-heartbeat text-indigo-600 text-2xl mr-2"></i>
                <span class="text-xl font-bold text-indigo-600">BookDoctor</span>
            </a>

            <nav class="hidden md:block">
                <ul class="flex space-x-6">
                    <li><a href="#" class="text-gray-600 hover:text-indigo-600">Accueil</a></li>
                    <li><a href="#" class="font-medium text-indigo-600">Visites</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-indigo-600">Patients</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-indigo-600">Documents</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-indigo-600">Statistiques</a></li>
                </ul>
            </nav>

            <div class="flex items-center">
                <div class="mr-4 relative">
                    <button class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600">
                        <i class="far fa-bell"></i>
                        <span class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span>
                    </button>
                </div>
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 mr-2">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <span class="hidden md:block">Dr. Martin Dupont</span>
                </div>
            </div>
        </div>
    </header>

    <!-- En-tête de la page -->
    <div class="profile-header py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-white">Visites Hebdomadaires</h1>
                    <p class="mt-2 text-indigo-100">Tous les rendez-vous prévus pour cette semaine</p>
                </div>
                <div class="mt-4 md:mt-0 flex space-x-3">
                    <button class="bg-white bg-opacity-20 text-white px-4 py-2 rounded-lg hover:bg-opacity-30 transition">
                        <i class="fas fa-print mr-2"></i> Imprimer
                    </button>
                    <button class="bg-white bg-opacity-20 text-white px-4 py-2 rounded-lg hover:bg-opacity-30 transition">
                        <i class="fas fa-download mr-2"></i> Exporter
                    </button>
                </div>
            </div>
        </div>
    </div>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Navigation par semaine -->
        <div class="week-navigation bg-white rounded-lg shadow-sm p-4 mb-6">
            <button class="px-3 py-1 bg-indigo-100 text-indigo-700 rounded-lg">
                <i class="fas fa-chevron-left mr-2"></i> Semaine précédente
            </button>
            
            <div class="text-center">
                <h2 class="text-lg font-semibold">Semaine du 23 au 29 juin 2025</h2>
                <p class="text-sm text-gray-500">6 rendez-vous prévus</p>
            </div>
            
            <button class="px-3 py-1 bg-indigo-100 text-indigo-700 rounded-lg">
                Semaine suivante <i class="fas fa-chevron-right ml-2"></i>
            </button>
        </div>
        
        <!-- Sélecteur de jours -->
        <div class="week-days">
            <div class="day-card">
                <div class="day-name">Lun</div>
                <div class="day-number">23</div>
            </div>
            <div class="day-card">
                <div class="day-name">Mar</div>
                <div class="day-number">24</div>
            </div>
            <div class="day-card">
                <div class="day-name">Mer</div>
                <div class="day-number">25</div>
            </div>
            <div class="day-card">
                <div class="day-name">Jeu</div>
                <div class="day-number">26</div>
            </div>
            <div class="day-card">
                <div class="day-name">Ven</div>
                <div class="day-number">27</div>
            </div>
            <div class="day-card">
                <div class="day-name">Sam</div>
                <div class="day-number">28</div>
            </div>
            <div class="day-card active">
                <div class="day-name">Dim</div>
                <div class="day-number">29</div>
            </div>
        </div>
        
        <!-- Tableau des visites (sans colonne Durée) -->
        <div class="section-card">
            <div class="section-header">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-lg font-medium text-gray-900">Visites du Dimanche 29 juin 2025</h2>
                        <p class="text-sm text-gray-500">3 rendez-vous prévus aujourd'hui</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="relative">
                            <input type="text" placeholder="Rechercher..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500">
                            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>
                        <button class="px-3 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                            <i class="fas fa-plus mr-2"></i> Ajouter
                        </button>
                    </div>
                </div>
            </div>
            <div class="section-content">
                <table class="w-full">
                    <thead>
                        <tr class="table-header">
                            <th class="py-3 px-4 text-left">Heure</th>
                            <th class="py-3 px-4 text-left">Patient</th>
                            <th class="py-3 px-4 text-left">Motif</th>
                            <th class="py-3 px-4 text-left">Statut</th>
                            <th class="py-3 px-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Visite 1 -->
                        <tr class="table-row">
                            <td class="py-4 px-4">
                                <div class="font-medium">10:00</div>
                                <span class="time-info">20 min</span>
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex items-center">
                                    <div class="patient-avatar">JD</div>
                                    <div>
                                        <div class="font-medium">Jean Dubois</div>
                                        <div class="text-sm text-gray-500">37 ans</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="font-medium">Consultation de routine</div>
                                <div class="text-sm text-gray-500">Dernière visite: 12/06/2025</div>
                            </td>
                            <td class="py-4 px-4">
                                <span class="status-badge status-confirmed">
                                    <i class="fas fa-check-circle mr-1"></i> Confirmé
                                </span>
                            </td>
                            <td class="py-4 px-4 text-right">
                                <div class="flex justify-end space-x-2">
                                    <button class="action-btn btn-outline">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn btn-outline">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <button class="action-btn btn-primary">
                                        Démarrer
                                    </button>
                                </div>
                            </td>
                        </tr>
                        
                        <!-- Visite 2 -->
                        <tr class="table-row">
                            <td class="py-4 px-4">
                                <div class="font-medium">11:30</div>
                                <span class="time-info">30 min</span>
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex items-center">
                                    <div class="patient-avatar">ML</div>
                                    <div>
                                        <div class="font-medium">Marie Lambert</div>
                                        <div class="text-sm text-gray-500">44 ans</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="font-medium">Suivi traitement</div>
                                <div class="text-sm text-gray-500">Prescription: Antibiotiques</div>
                            </td>
                            <td class="py-4 px-4">
                                <span class="status-badge status-pending">
                                    <i class="fas fa-clock mr-1"></i> En attente
                                </span>
                            </td>
                            <td class="py-4 px-4 text-right">
                                <div class="flex justify-end space-x-2">
                                    <button class="action-btn btn-outline">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn btn-outline">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <button class="action-btn btn-outline" disabled>
                                        Démarrer
                                    </button>
                                </div>
                            </td>
                        </tr>
                        
                        <!-- Visite 3 -->
                        <tr class="table-row bg-blue-50">
                            <td class="py-4 px-4">
                                <div class="font-medium">15:30</div>
                                <span class="time-info">30 min</span>
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex items-center">
                                    <div class="patient-avatar">MR</div>
                                    <div>
                                        <div class="font-medium">Marc Roy</div>
                                        <div class="text-sm text-gray-500">54 ans</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="font-medium">Bilan annuel</div>
                                <div class="text-sm text-gray-500">Analyses à discuter</div>
                            </td>
                            <td class="py-4 px-4">
                                <span class="status-badge status-completed">
                                    <i class="fas fa-check-circle mr-1"></i> Terminé
                                </span>
                            </td>
                            <td class="py-4 px-4 text-right">
                                <div class="flex justify-end space-x-2">
                                    <button class="action-btn btn-outline">
                                        <i class="fas fa-file-medical"></i> Dossier
                                    </button>
                                    <button class="action-btn btn-primary">
                                        <i class="fas fa-receipt mr-1"></i> Facture
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <!-- Résumé du jour -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <div class="summary-grid">
                        <div class="bg-indigo-50 p-4 rounded-lg">
                            <div class="text-indigo-800 font-medium">Total des visites</div>
                            <div class="text-2xl font-bold mt-1">3</div>
                        </div>
                        <div class="bg-green-50 p-4 rounded-lg">
                            <div class="text-green-800 font-medium">Confirmés</div>
                            <div class="text-2xl font-bold mt-1">1</div>
                        </div>
                        <div class="bg-yellow-50 p-4 rounded-lg">
                            <div class="text-yellow-800 font-medium">En attente</div>
                            <div class="text-2xl font-bold mt-1">1</div>
                        </div>
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <div class="text-blue-800 font-medium">Terminés</div>
                            <div class="text-2xl font-bold mt-1">1</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Section supplémentaire pour équilibrer la mise en page -->
        <div class="mt-8 grid grid-cols-1 gap-6">
            <div class="section-card">
                <div class="section-header">
                    <h2 class="text-lg font-medium text-gray-900">
                        <i class="fas fa-calendar-check text-indigo-600 mr-2"></i>
                        Prochains rendez-vous
                    </h2>
                </div>
                <div class="section-content">
                    <div class="flex flex-col space-y-4">
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <div>
                                <div class="font-medium">Lundi 30 juin - 10:00</div>
                                <div class="text-sm text-gray-500">Sophie Gagnon - Consultation prénatale</div>
                            </div>
                            <span class="status-badge status-confirmed">
                                Confirmé
                            </span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <div>
                                <div class="font-medium">Mardi 1er juillet - 14:30</div>
                                <div class="text-sm text-gray-500">Paul Tremblay - Contrôle douleurs</div>
                            </div>
                            <span class="status-badge status-pending">
                                En attente
                            </span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <div>
                                <div class="font-medium">Mercredi 2 juillet - 09:15</div>
                                <div class="text-sm text-gray-500">Marie Lambert - Suivi traitement</div>
                            </div>
                            <span class="status-badge status-confirmed">
                                Confirmé
                            </span>
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
                        <i class="fas fa-heartbeat text-indigo-600 text-xl"></i>
                        <span class="ml-2 text-lg font-bold text-indigo-600">BookDoctor</span>
                    </div>
                </div>
                <div class="mt-8 md:mt-0 md:order-1">
                    <p class="text-center text-sm text-gray-500">
                        &copy; 2025 BookDoctor. Tous droits réservés.
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Fonctionnalité de sélection des jours
        document.querySelectorAll('.day-card').forEach(card => {
            card.addEventListener('click', function() {
                document.querySelectorAll('.day-card').forEach(c => c.classList.remove('active'));
                this.classList.add('active');
                
                // Mise à jour du titre avec la date sélectionnée
                const dayNumber = this.querySelector('.day-number').textContent;
                const dayName = this.querySelector('.day-name').textContent;
                document.querySelector('.section-header h2').textContent = `Visites du ${dayName} ${dayNumber} juin 2025`;
            });
        });
        
        // Fonctionnalité pour afficher/masquer les détails
        document.querySelectorAll('.table-row').forEach(row => {
            row.addEventListener('click', function(e) {
                if (!e.target.closest('button')) {
                    this.classList.toggle('bg-blue-50');
                }
            });
        });
    </script>
</body>
</html>