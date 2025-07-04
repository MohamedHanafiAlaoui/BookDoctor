<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des périodes de disponibilité - BookDoctor</title>
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

        body {
            background-color: #f8fafc;
            font-family: 'Inter', sans-serif;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .logo {
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .logo-icon {
            font-size: 1.5rem;
            color: var(--primary);
        }

        .logo-text {
            font-weight: 700;
            font-size: 1.25rem;
            color: var(--dark);
            margin-left: 0.5rem;
        }

        nav ul {
            display: flex;
            list-style: none;
            gap: 1.5rem;
        }

        nav a {
            text-decoration: none;
            color: var(--gray);
            font-weight: 500;
            transition: color 0.2s;
        }

        nav a:hover,
        nav a.active {
            color: var(--primary);
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .notification-btn {
            position: relative;
            background: none;
            border: none;
            color: var(--gray);
            font-size: 1.25rem;
            cursor: pointer;
        }

        .notification-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: var(--notification);
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            font-weight: bold;
        }

        .profile-btn {
            display: flex;
            align-items: center;
            background: none;
            border: none;
            cursor: pointer;
            gap: 0.5rem;
        }

        .avatar-placeholder {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: #e0e7ff;
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .profile-name {
            font-weight: 500;
            color: var(--dark);
        }

        .availability-card {
            border: 1px solid #e5e7eb;
            border-radius: 0.75rem;
            padding: 1.25rem;
            transition: all 0.3s;
            position: relative;
            background-color: white;
        }

        .availability-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .card-actions {
            position: absolute;
            top: 1rem;
            right: 1rem;
            display: flex;
            gap: 0.5rem;
        }

        .action-btn {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
        }

        .edit-btn {
            background-color: #e0e7ff;
            color: var(--primary);
        }

        .edit-btn:hover {
            background-color: #c7d2fe;
        }

        .delete-btn {
            background-color: #fee2e2;
            color: #ef4444;
        }

        .delete-btn:hover {
            background-color: #fecaca;
        }

        .time-slot {
            background: #e0e7ff;
            color: var(--primary);
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            display: inline-flex;
            align-items: center;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .time-slot i {
            margin-right: 0.5rem;
        }

        .add-btn {
            display: inline-flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            background-color: var(--primary);
            color: white;
            border-radius: 0.5rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
        }

        .add-btn:hover {
            background-color: var(--primary-dark);
        }

        .add-btn i {
            margin-right: 0.5rem;
        }

        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        .modal-content {
            background-color: white;
            border-radius: 0.75rem;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            background-color: #f9fafb;
            transition: border-color 0.2s;
            margin-bottom: 1rem;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--dark);
        }

        .time-input-wrapper {
            position: relative;
        }

        .time-input-wrapper i {
            position: absolute;
            right: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary);
        }

        .error-message {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: -0.5rem;
            margin-bottom: 1rem;
        }

        .modal-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
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

        .btn-secondary {
            background-color: #e5e7eb;
            color: var(--dark);
            border: none;
        }

        .btn-secondary:hover {
            background-color: #d1d5db;
        }

        .btn-danger {
            background-color: #ef4444;
            color: white;
            border: none;
        }

        .btn-danger:hover {
            background-color: #dc2626;
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
            animation: fadeIn 0.3s ease forwards;
        }
    </style>
</head>

<body class="min-h-screen">
    <!-- Header de navigation -->
    <header>
        <div class="header-container">
            <a href="#" class="logo">
                <i class="fas fa-heartbeat logo-icon"></i>
                <span class="logo-text">BookDoctor</span>
            </a>

            <nav>
                <ul>
                    <li><a href="#">Aperçu</a></li>
                    <li><a href="#" class="active">Mon agenda</a></li>
                    <li><a href="#">Mes patients</a></li>
                    <li><a href="#">Documents</a></li>
                </ul>
            </nav>

            <div class="header-actions">
                <div class="notification-container">
                    <button class="notification-btn">
                        <i class="far fa-bell"></i>
                        <span class="notification-count">3</span>
                    </button>
                </div>

                <div class="profile-container">
                    <button class="profile-btn">
                        <div class="profile-img avatar-placeholder">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <span class="profile-name">Dr. Dupont</span>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-6 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Gestion des périodes de disponibilité</h1>
                <p class="text-gray-600 mt-2">Définissez vos créneaux de disponibilité pour que vos patients puissent
                    prendre rendez-vous</p>
            </div>
            <button id="add-period-btn" class="add-btn">
                <i class="fas fa-plus"></i>Ajouter une période
            </button>
        </div>

        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-900">Périodes existantes</h2>
                <p class="text-sm text-gray-500">Vos périodes de disponibilité actuelles</p>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" id="availability-list">
                    <!-- Les périodes seront ajoutées ici dynamiquement -->
                </div>

                <div class="mt-6 text-center">
                    <button class="text-indigo-600 hover:text-indigo-800 font-medium">
                        <i class="fas fa-history mr-2"></i>Voir toutes les périodes
                    </button>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal pour ajouter/modifier une période -->
    <div id="period-modal" class="modal hidden">
        <div class="modal-content fade-in">
            <div class="modal-header">
                <h3 class="text-lg font-medium text-gray-900" id="modal-title">Ajouter une période</h3>
                <button id="close-modal" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="availabilityForm">
                    <input type="hidden" id="edit_id">

                    <div class="mb-4">
                        <label class="form-label">Date</label>
                        <div class="relative">
                            <input type="date" id="date" class="form-input" required>
                            <i class="fas fa-calendar-day absolute right-3 top-3 text-indigo-500"></i>
                        </div>
                        <div id="date-error" class="error-message hidden">La date est requise</div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="form-label">Heure de début</label>
                            <div class="time-input-wrapper">
                                <input type="time" id="start_time" class="form-input" value="09:00" required>
                                <i class="fas fa-clock"></i>
                            </div>
                            <div id="start-time-error" class="error-message hidden">Veuillez entrer une heure valide
                            </div>
                        </div>

                        <div>
                            <label class="form-label">Heure de fin</label>
                            <div class="time-input-wrapper">
                                <input type="time" id="end_time" class="form-input" value="17:00" required>
                                <i class="fas fa-clock"></i>
                            </div>
                            <div id="end-time-error" class="error-message hidden">Veuillez entrer une heure valide</div>
                        </div>
                    </div>

                    <div id="time-error" class="mt-4 p-3 bg-red-50 text-red-700 rounded-lg hidden">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <span>L'heure de fin doit être après l'heure de début</span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="cancel-btn" class="btn btn-secondary">
                    Annuler
                </button>
                <button type="button" id="delete-btn" class="btn btn-danger hidden">
                    <i class="fas fa-trash mr-2"></i>Supprimer
                </button>
                <button type="button" id="save-btn" class="btn btn-primary">
                    <i class="fas fa-save mr-2"></i>Enregistrer
                </button>
            </div>
        </div>
    </div>

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
        // Données de démonstration
        let availabilities = [
            { id: 1, date: getFormattedDate(1), start: "09:00", end: "12:30" },
            { id: 2, date: getFormattedDate(2), start: "14:00", end: "18:00" },
            { id: 3, date: getFormattedDate(3), start: "08:30", end: "16:00" },
            { id: 4, date: getFormattedDate(4), start: "10:00", end: "15:30" }
        ];

        // Fonction utilitaire pour formater les dates
        function getFormattedDate(daysFromToday) {
            const date = new Date();
            date.setDate(date.getDate() + daysFromToday);
            return date.toISOString().split('T')[0];
        }

        // Formater la date pour l'affichage
        function formatDate(dateString) {
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            return new Date(dateString).toLocaleDateString('fr-FR', options);
        }

        // Formater l'heure pour l'affichage
        function formatTime(timeString) {
            return timeString.substring(0, 5);
        }

        // Rendu de la liste des périodes
        function renderAvailabilityList() {
            const container = document.getElementById('availability-list');
            container.innerHTML = '';

            availabilities.forEach(availability => {
                const card = document.createElement('div');
                card.className = 'availability-card fade-in';
                card.innerHTML = `
                    <div class="card-actions">
                        <button class="action-btn edit-btn" data-id="${availability.id}">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="action-btn delete-btn" data-id="${availability.id}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <div class="flex items-center mb-2">
                        <div class="bg-indigo-100 text-indigo-800 px-2 py-1 rounded-full text-xs">
                            <i class="fas fa-calendar mr-1"></i>${formatDate(availability.date)}
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="time-slot text-sm">
                            <i class="fas fa-play-circle"></i>
                            <span>${formatTime(availability.start)}</span>
                        </div>
                        <div class="text-gray-500 mx-2">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                        <div class="time-slot text-sm">
                            <i class="fas fa-stop-circle"></i>
                            <span>${formatTime(availability.end)}</span>
                        </div>
                    </div>
                `;
                container.appendChild(card);
            });

            // Ajout des écouteurs d'événements
            document.querySelectorAll('.edit-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    const id = this.getAttribute('data-id');
                    editAvailability(id);
                });
            });

            document.querySelectorAll('.delete-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    const id = this.getAttribute('data-id');
                    deleteAvailability(id);
                });
            });
        }

        // Éditer une période
        function editAvailability(id) {
            const availability = availabilities.find(a => a.id == id);
            if (!availability) return;

            // Pré-remplir le formulaire
            document.getElementById('edit_id').value = availability.id;
            document.getElementById('date').value = availability.date;
            document.getElementById('start_time').value = availability.start;
            document.getElementById('end_time').value = availability.end;

            // Configurer le modal pour l'édition
            document.getElementById('modal-title').textContent = "Modifier la période";
            document.getElementById('delete-btn').classList.remove('hidden');

            // Ouvrir le modal
            document.getElementById('period-modal').classList.remove('hidden');
        }

        // Supprimer une période
        function deleteAvailability(id) {
            Swal.fire({
                title: 'Confirmer la suppression',
                text: "Êtes-vous sûr de vouloir supprimer cette période de disponibilité?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Oui, supprimer',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Supprimer de la liste
                    availabilities = availabilities.filter(a => a.id != id);

                    // Re-rendre la liste
                    renderAvailabilityList();

                    Swal.fire(
                        'Supprimé!',
                        'La période a été supprimée avec succès.',
                        'success'
                    );
                }
            });
        }

        // Valider les heures
        function validateTimes() {
            const startTime = document.getElementById('start_time').value;
            const endTime = document.getElementById('end_time').value;
            const errorDiv = document.getElementById('time-error');

            if (startTime && endTime && startTime >= endTime) {
                errorDiv.classList.remove('hidden');
                return false;
            } else {
                errorDiv.classList.add('hidden');
                return true;
            }
        }

        // Sauvegarder une période
        function saveAvailability() {
            // Validation basique
            let isValid = true;
            if (!document.getElementById('date').value) {
                document.getElementById('date-error').classList.remove('hidden');
                isValid = false;
            } else {
                document.getElementById('date-error').classList.add('hidden');
            }

            if (!document.getElementById('start_time').value) {
                document.getElementById('start-time-error').classList.remove('hidden');
                isValid = false;
            } else {
                document.getElementById('start-time-error').classList.add('hidden');
            }

            if (!document.getElementById('end_time').value) {
                document.getElementById('end-time-error').classList.remove('hidden');
                isValid = false;
            } else {
                document.getElementById('end-time-error').classList.add('hidden');
            }

            // Validation des heures
            if (!validateTimes()) {
                isValid = false;
            }

            if (!isValid) {
                return;
            }

            // Préparer l'objet période
            const availability = {
                date: document.getElementById('date').value,
                start: document.getElementById('start_time').value,
                end: document.getElementById('end_time').value
            };

            const editId = document.getElementById('edit_id').value;

            if (editId) {
                // Mettre à jour une période existante
                const index = availabilities.findIndex(a => a.id == editId);
                if (index !== -1) {
                    availability.id = parseInt(editId);
                    availabilities[index] = availability;

                    Swal.fire({
                        title: 'Mise à jour réussie!',
                        text: 'La période a été mise à jour avec succès.',
                        icon: 'success',
                        confirmButtonColor: '#4f46e5',
                        confirmButtonText: 'OK'
                    });
                }
            } else {
                // Ajouter une nouvelle période
                availability.id = availabilities.length > 0
                    ? Math.max(...availabilities.map(a => a.id)) + 1
                    : 1;
                availabilities.push(availability);

                Swal.fire({
                    title: 'Période créée!',
                    text: 'La nouvelle période a été enregistrée avec succès.',
                    icon: 'success',
                    confirmButtonColor: '#4f46e5',
                    confirmButtonText: 'OK'
                });
            }

            // Re-rendre la liste et fermer le modal
            renderAvailabilityList();
            closeModal();
        }



        // Initialiser la page
        document.addEventListener('DOMContentLoaded', function () {
            // Rendre la liste initiale
            renderAvailabilityList();

            // Écouteurs d'événements
            document.getElementById('close-modal').addEventListener('click', closeModal);
            document.getElementById('cancel-btn').addEventListener('click', closeModal);
            document.getElementById('save-btn').addEventListener('click', saveAvailability);

            // Validation en temps réel
            document.getElementById('start_time').addEventListener('change', validateTimes);
            document.getElementById('end_time').addEventListener('change', validateTimes);
        });
    </script>
</body>

</html>