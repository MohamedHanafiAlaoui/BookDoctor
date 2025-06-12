<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chronologie Médicale - BookDoctor</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .timeline-item {
            position: relative;
            padding-left: 20px;
            margin-bottom: 25px;
        }
        .timeline-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 5px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: #4f46e5;
        }
        .medical-card {
            transition: all 0.3s ease;
            border-left: 3px solid #4f46e5;
        }
        .filter-btn.active {
            background-color: #4f46e5;
            color: white;
        }
        .tab-content {
            display: none;
            animation: fadeIn 0.5s ease;
        }
        .tab-content.active {
            display: block;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .main-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .section-title {
            font-size: 1.2rem;
            font-weight: bold;
            color: #374151;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #e5e7eb;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header de navigation simplifié -->
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <svg class="h-8 w-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        <span class="ml-2 text-xl font-bold text-indigo-600">BookDoctor</span>
                    </div>
                </div>
                <div class="flex items-center">
                    <nav class="flex space-x-4">
                        <a href="#" class="text-gray-500 hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium">Historique médical</a>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <!-- Contenu principal -->
    <main class="main-container px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Chronologie Médicale</h1>
            <p class="text-gray-600">Historique complet des événements médicaux</p>
        </div>

        <!-- Filtres -->
        <div class="mb-8 flex flex-wrap gap-3">
            <div class="flex items-center">
                <span class="mr-2 text-gray-700">Filtrer :</span>
            </div>
            <button class="filter-btn px-3 py-1.5 bg-indigo-600 text-white rounded text-sm active" data-filter="all">Tout</button>
            <button class="filter-btn px-3 py-1.5 bg-gray-200 rounded text-sm" data-filter="consultations">Consultations</button>
            <button class="filter-btn px-3 py-1.5 bg-gray-200 rounded text-sm" data-filter="hospitalisations">Hospitalisations</button>
            <button class="filter-btn px-3 py-1.5 bg-gray-200 rounded text-sm" data-filter="analyses">Analyses</button>
            <button class="filter-btn px-3 py-1.5 bg-gray-200 rounded text-sm" data-filter="vaccins">Vaccinations</button>
            
            <div class="ml-auto">
                <div class="relative">
                    <input type="text" placeholder="Rechercher..." class="pl-8 pr-3 py-1.5 rounded border border-gray-300 focus:outline-none focus:ring-1 focus:ring-indigo-500 text-sm">
                    <i class="fas fa-search absolute left-2 top-2 text-gray-400 text-sm"></i>
                </div>
            </div>
        </div>

        <!-- Chronologie médicale simplifiée -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="p-5">
                <div class="max-w-3xl mx-auto">
                    <!-- Année 2023 -->
                    <div class="mb-8">
                        <h3 class="section-title">2023</h3>
                        
                        <div class="timeline-item">
                            <div class="medical-card bg-white rounded p-4 shadow-sm">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <span class="inline-block px-2 py-0.5 bg-indigo-100 text-indigo-800 rounded text-xs font-medium mb-1">Consultation</span>
                                        <h4 class="font-semibold text-gray-900 mb-1">Consultation de suivi - Cardiologie</h4>
                                        <p class="text-gray-600 text-sm"><i class="fas fa-user-md mr-1 text-indigo-500"></i>Dr. Dupont</p>
                                    </div>
                                    <span class="text-gray-500 text-xs">15 juin 2023</span>
                                </div>
                                <div class="mt-2">
                                    <p class="text-gray-700 text-sm">Consultation de suivi pour hypertension. Tension artérielle stabilisée.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="timeline-item">
                            <div class="medical-card bg-white rounded p-4 shadow-sm">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <span class="inline-block px-2 py-0.5 bg-purple-100 text-purple-800 rounded text-xs font-medium mb-1">Analyse</span>
                                        <h4 class="font-semibold text-gray-900 mb-1">Bilan sanguin complet</h4>
                                        <p class="text-gray-600 text-sm"><i class="fas fa-clinic-medical mr-1 text-purple-500"></i>Laboratoire Médical Central</p>
                                    </div>
                                    <span class="text-gray-500 text-xs">12 mai 2023</span>
                                </div>
                                <div class="mt-2">
                                    <p class="text-gray-700 text-sm">Analyse sanguine de routine. Résultats dans les normes.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="timeline-item">
                            <div class="medical-card bg-white rounded p-4 shadow-sm">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <span class="inline-block px-2 py-0.5 bg-green-100 text-green-800 rounded text-xs font-medium mb-1">Vaccination</span>
                                        <h4 class="font-semibold text-gray-900 mb-1">Rappel vaccin tétanos</h4>
                                        <p class="text-gray-600 text-sm"><i class="fas fa-syringe mr-1 text-green-500"></i>Centre de vaccination</p>
                                    </div>
                                    <span class="text-gray-500 text-xs">2 avril 2023</span>
                                </div>
                                <div class="mt-2">
                                    <p class="text-gray-700 text-sm">Rappel décennal du vaccin contre le tétanos.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Année 2022 -->
                    <div class="mb-8">
                        <h3 class="section-title">2022</h3>
                        
                        <div class="timeline-item">
                            <div class="medical-card bg-white rounded p-4 shadow-sm">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <span class="inline-block px-2 py-0.5 bg-yellow-100 text-yellow-800 rounded text-xs font-medium mb-1">Hospitalisation</span>
                                        <h4 class="font-semibold text-gray-900 mb-1">Appendicectomie</h4>
                                        <p class="text-gray-600 text-sm"><i class="fas fa-hospital mr-1 text-yellow-500"></i>Hôpital Saint-Louis</p>
                                    </div>
                                    <span class="text-gray-500 text-xs">15-18 août 2022</span>
                                </div>
                                <div class="mt-2">
                                    <p class="text-gray-700 text-sm">Hospitalisation de 3 jours pour appendicite aiguë.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="timeline-item">
                            <div class="medical-card bg-white rounded p-4 shadow-sm">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <span class="inline-block px-2 py-0.5 bg-blue-100 text-blue-800 rounded text-xs font-medium mb-1">Imagerie</span>
                                        <h4 class="font-semibold text-gray-900 mb-1">Échographie abdominale</h4>
                                        <p class="text-gray-600 text-sm"><i class="fas fa-x-ray mr-1 text-blue-500"></i>Centre d'imagerie médicale</p>
                                    </div>
                                    <span class="text-gray-500 text-xs">10 août 2022</span>
                                </div>
                                <div class="mt-2">
                                    <p class="text-gray-700 text-sm">Échographie abdominale réalisée pour douleurs abdominales.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Bouton pour ajouter un nouvel événement -->
                    <div class="mt-6 text-center">
                        <button class="px-4 py-2 bg-indigo-600 text-white rounded font-medium hover:bg-indigo-700 transition duration-300 flex items-center justify-center mx-auto text-sm">
                            <i class="fas fa-plus-circle mr-2"></i> Ajouter un événement
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-white border-t mt-8">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 text-center text-sm text-gray-500">
            &copy; 2025 BookDoctor. Tous droits réservés.
        </div>
    </footer>

    <script>
        // Gestion des filtres
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const filter = this.getAttribute('data-filter');
                
                // Mise à jour des boutons de filtre
                document.querySelectorAll('.filter-btn').forEach(b => {
                    b.classList.remove('active', 'bg-indigo-600', 'text-white');
                    b.classList.add('bg-gray-200');
                });
                
                this.classList.add('active', 'bg-indigo-600', 'text-white');
                this.classList.remove('bg-gray-200');
                
                // Filtrage des éléments de la chronologie
                document.querySelectorAll('.timeline-item').forEach(item => {
                    const type = item.querySelector('.inline-block').textContent.toLowerCase();
                    const shouldShow = filter === 'all' || 
                                     (filter === 'consultations' && type.includes('consultation')) ||
                                     (filter === 'hospitalisations' && type.includes('hospitalisation')) ||
                                     (filter === 'analyses' && type.includes('analyse')) ||
                                     (filter === 'vaccins' && type.includes('vaccination'));
                    
                    item.style.display = shouldShow ? 'block' : 'none';
                });
            });
        });

        // Bouton ajouter événement
        document.querySelector('.mt-6 button').addEventListener('click', function() {
            Swal.fire({
                title: 'Ajouter un événement',
                html: `
                    <div class="text-left">
                        <div class="mb-3">
                            <label class="block text-gray-700 text-sm font-bold mb-1">Type d'événement</label>
                            <select class="w-full px-2 py-1 border rounded text-sm">
                                <option>Consultation</option>
                                <option>Analyse</option>
                                <option>Vaccination</option>
                                <option>Hospitalisation</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="block text-gray-700 text-sm font-bold mb-1">Date</label>
                            <input type="date" class="w-full px-2 py-1 border rounded text-sm">
                        </div>
                        <div class="mb-3">
                            <label class="block text-gray-700 text-sm font-bold mb-1">Description</label>
                            <textarea class="w-full px-2 py-1 border rounded text-sm" rows="2"></textarea>
                        </div>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: 'Enregistrer',
                confirmButtonColor: '#4f46e5',
                cancelButtonText: 'Annuler',
                customClass: {
                    popup: 'text-sm'
                }
            });
        });
    </script>
</body>
</html>