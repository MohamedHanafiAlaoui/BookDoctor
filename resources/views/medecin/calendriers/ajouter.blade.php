<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une période de disponibilité - BookDoctor</title>
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

        .form-container {
            background: white;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .form-header {
            padding: 1.5rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .form-content {
            padding: 1.5rem;
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

        .btn-secondary {
            background-color: #e5e7eb;
            color: var(--dark);
            border: none;
        }

        .btn-secondary:hover {
            background-color: #d1d5db;
        }

        .error-message {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .calendar-preview {
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.1) 0%, rgba(67, 56, 202, 0.1) 100%);
            border-radius: 0.75rem;
            padding: 1.5rem;
            margin-top: 1.5rem;
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

        .additional-day {
            background-color: #f9fafb;
            border-radius: 0.5rem;
            padding: 1.25rem;
            margin-top: 1.5rem;
            border: 1px solid #e5e7eb;
            position: relative;
        }

        .remove-day {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            background: none;
            border: none;
            color: #ef4444;
            cursor: pointer;
            font-size: 1.25rem;
        }

        .additional-days-container {
            margin-top: 1.5rem;
            border-top: 1px solid #e5e7eb;
            padding-top: 1.5rem;
        }

        .add-day-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 0.75rem;
            background-color: #f3f4f6;
            border: 1px dashed #d1d5db;
            border-radius: 0.5rem;
            color: var(--primary);
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
        }

        .add-day-btn:hover {
            background-color: #e5e7eb;
            border-color: var(--primary);
        }

        .add-day-btn i {
            margin-right: 0.5rem;
        }

                .alert-danger {
            background-color: #fee2e2;
            border-left: 4px solid #ef4444;
            color: #b91c1c;
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 0.375rem;
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

    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Créer une période de disponibilité</h1>
            <p class="text-gray-600 mt-2">Définissez vos créneaux de disponibilité pour que vos patients puissent
                prendre rendez-vous</p>
        </div>

             @if ($errors->any())
            <div class="alert-danger mb-6 fade-in">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-triangle h-5 w-5"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium">Des erreurs se sont produites</h3>
                        <div class="mt-2 text-sm">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="form-container fade-in">
            <div class="form-header">
                <h2 class="text-lg font-medium text-gray-900">Nouvelle période</h2>
                <p class="text-sm text-gray-500">Remplissez les informations ci-dessous pour créer un nouveau créneau
                </p>
            </div>


            <div class="form-content">


                <form id="availabilityForm" action="{{ route('medecin.calendriers.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Date Field -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                            <div class="relative">
                                <input type="date" id="date" class="form-input" required>
                                <i class="fas fa-calendar-day absolute right-3 top-3 text-indigo-500"></i>
                            </div>
                            <div id="date-error" class="error-message hidden">La date est requise</div>
                        </div>

                        <!-- Empty div for spacing -->
                        <div></div>

                        <!-- Start Time -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Heure de début</label>
                            <div class="time-input-wrapper">
                                <input type="time" id="start_time" class="form-input" value="09:00" required>
                                <i class="fas fa-clock"></i>
                            </div>
                            <div id="start-time-error" class="error-message hidden">Veuillez entrer une heure valide
                            </div>
                        </div>

                        <!-- End Time -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Heure de fin</label>
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

                    <!-- Additional days container -->
                    <div class="additional-days-container">
                        <h3 class="text-md font-medium text-gray-700 mb-3">Ajouter plusieurs jours</h3>
                        <button type="button" id="add-day-btn" class="add-day-btn">
                            <i class="fas fa-plus-circle"></i>
                            Ajouter un autre jour
                        </button>

                        <div id="additional-days"></div>
                    </div>

                    <div class="calendar-preview mt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Aperçu des périodes</h3>
                        <div class="flex items-center mb-4">
                            <div class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-medium">
                                <i class="fas fa-calendar mr-1"></i>
                                <span id="preview-date">Sélectionnez une date</span>
                            </div>
                        </div>

                        <div class="flex flex-wrap">
                            <div class="time-slot">
                                <i class="fas fa-play-circle"></i>
                                <span id="preview-start">09:00</span>
                            </div>
                            <div class="text-gray-500 flex items-center mx-2">
                                <i class="fas fa-arrow-right"></i>
                            </div>
                            <div class="time-slot">
                                <i class="fas fa-stop-circle"></i>
                                <span id="preview-end">17:00</span>
                            </div>
                        </div>

                        <div id="additional-preview" class="mt-4"></div>
                    </div>

                    <div class="flex justify-end space-x-3 mt-8">
                        <button type="button" class="btn btn-secondary">
                            Annuler
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-2"></i>Enregistrer
                        </button>
                    </div>
                </form>
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
        const form = document.getElementById('availabilityForm');

        // إعداد التاريخ الافتراضي ليوم الغد
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        const formattedDate = tomorrow.toISOString().split('T')[0];
        document.getElementById('date').value = formattedDate;
        document.getElementById('preview-date').textContent = formatDate(formattedDate);

        function formatDate(dateString) {
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            return new Date(dateString).toLocaleDateString('fr-FR', options);
        }

        function formatTime(timeString) {
            return timeString.substring(0, 5);
        }

        document.getElementById('date').addEventListener('change', function () {
            document.getElementById('preview-date').textContent = formatDate(this.value);
        });

        document.getElementById('start_time').addEventListener('change', function () {
            document.getElementById('preview-start').textContent = formatTime(this.value);
            validateTimes();
        });

        document.getElementById('end_time').addEventListener('change', function () {
            document.getElementById('preview-end').textContent = formatTime(this.value);
            validateTimes();
        });

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

        function addDayForm() {
            const additionalDaysContainer = document.getElementById('additional-days');
            const previewContainer = document.getElementById('additional-preview');

            const dayContainer = document.createElement('div');
            dayContainer.className = 'additional-day fade-in';

            let baseDate = new Date();
            if (additionalDaysContainer.lastChild) {
                const lastDateInput = additionalDaysContainer.lastChild.querySelector('.additional-date');
                if (lastDateInput) baseDate = new Date(lastDateInput.value);
            } else {
                const mainDateInput = document.getElementById('date');
                if (mainDateInput.value) baseDate = new Date(mainDateInput.value);
            }
            baseDate.setDate(baseDate.getDate() + 1);
            const newDate = baseDate.toISOString().split('T')[0];

            const startTime = document.getElementById('start_time').value;
            const endTime = document.getElementById('end_time').value;

            dayContainer.innerHTML = `
            <button type="button" class="remove-day" title="Supprimer ce jour">
                <i class="fas fa-times"></i>
            </button>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                    <div class="relative">
                        <input type="date" class="form-input additional-date" value="${newDate}" required>
                        <i class="fas fa-calendar-day absolute right-3 top-3 text-indigo-500"></i>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Heure de début</label>
                    <div class="time-input-wrapper">
                        <input type="time" class="form-input additional-start-time" value="${startTime}" required>
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Heure de fin</label>
                    <div class="time-input-wrapper">
                        <input type="time" class="form-input additional-end-time" value="${endTime}" required>
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
            </div>
        `;

            additionalDaysContainer.appendChild(dayContainer);

            dayContainer.querySelector('.remove-day').addEventListener('click', function () {
                dayContainer.classList.add('fade-out');
                setTimeout(() => {
                    dayContainer.remove();
                    updatePreview();
                }, 300);
            });

            dayContainer.querySelector('.additional-date').addEventListener('change', updatePreview);
            dayContainer.querySelector('.additional-start-time').addEventListener('change', updatePreview);
            dayContainer.querySelector('.additional-end-time').addEventListener('change', updatePreview);

            updatePreview();
        }

        function updatePreview() {
            const previewContainer = document.getElementById('additional-preview');
            previewContainer.innerHTML = '';

            document.querySelectorAll('.additional-day').forEach(day => {
                const dateInput = day.querySelector('.additional-date');
                const startInput = day.querySelector('.additional-start-time');
                const endInput = day.querySelector('.additional-end-time');

                if (dateInput.value && startInput.value && endInput.value) {
                    const dayPreview = document.createElement('div');
                    dayPreview.className = 'mt-4';
                    dayPreview.innerHTML = `
                    <div class="flex items-center mb-2">
                        <div class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-medium">
                            <i class="fas fa-calendar mr-1"></i>
                            <span>${formatDate(dateInput.value)}</span>
                        </div>
                    </div>
                    <div class="flex flex-wrap">
                        <div class="time-slot">
                            <i class="fas fa-play-circle"></i>
                            <span>${formatTime(startInput.value)}</span>
                        </div>
                        <div class="text-gray-500 flex items-center mx-2">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                        <div class="time-slot">
                            <i class="fas fa-stop-circle"></i>
                            <span>${formatTime(endInput.value)}</span>
                        </div>
                    </div>
                `;
                    previewContainer.appendChild(dayPreview);
                }
            });
        }

        document.getElementById('add-day-btn').addEventListener('click', addDayForm);

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            // إزالة الحقول الإضافية القديمة
            document.querySelectorAll('.extra-input').forEach(el => el.remove());

            // التحقق من صحة البيانات
            let isValid = true;
            if (!document.getElementById('date').value) {
                document.getElementById('date-error').classList.remove('hidden');
                isValid = false;
            }
            if (!document.getElementById('start_time').value) {
                document.getElementById('start-time-error').classList.remove('hidden');
                isValid = false;
            }
            if (!document.getElementById('end_time').value) {
                document.getElementById('end-time-error').classList.remove('hidden');
                isValid = false;
            }
            if (!validateTimes()) isValid = false;

            document.querySelectorAll('.additional-day').forEach(day => {
                const dateInput = day.querySelector('.additional-date');
                const startInput = day.querySelector('.additional-start-time');
                const endInput = day.querySelector('.additional-end-time');
                if (!dateInput.value || !startInput.value || !endInput.value || startInput.value >= endInput.value) {
                    isValid = false;
                }
            });

            if (!isValid) {
                Swal.fire({
                    title: 'Erreur de validation',
                    text: 'Veuillez vérifier toutes les dates et heures saisies',
                    icon: 'error',
                    confirmButtonColor: '#ef4444',
                    confirmButtonText: 'OK'
                });
                return;
            }

            // توليد الحقول داخل الفورم
            const allPeriods = [];

            allPeriods.push({
                date: document.getElementById('date').value,
                start: document.getElementById('start_time').value,
                end: document.getElementById('end_time').value
            });

            document.querySelectorAll('.additional-day').forEach(day => {
                allPeriods.push({
                    date: day.querySelector('.additional-date').value,
                    start: day.querySelector('.additional-start-time').value,
                    end: day.querySelector('.additional-end-time').value
                });
            });

            allPeriods.forEach((period, index) => {
                ['date', 'start', 'end'].forEach(field => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = `periods[${index}][${field}]`;
                    input.value = period[field];
                    input.classList.add('extra-input');
                    form.appendChild(input);
                });
            });

            form.submit();
        });
    </script>

</body>

</html>