<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Profil Médical - BookDoctor</title>
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

        .mobile-nav a:hover,
        .mobile-nav a.active {
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
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .dashboard-title i {
            background: #e0e7ff;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
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

        .btn-secondary {
            background-color: white;
            color: var(--gray);
            border: 1px solid #d1d5db;
        }

        .btn-secondary:hover {
            background-color: #f3f4f6;
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
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Avatar upload */
        .avatar-upload {
            position: relative;
            display: inline-block;
            margin-bottom: 1rem;
        }

        .avatar-preview {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--light-gray);
        }

        .avatar-upload-btn {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: white;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            color: var(--primary);
        }

        .avatar-upload input {
            display: none;
        }

        /* Specialty badge */
        .specialty-badge {
            display: inline-flex;
            align-items: center;
            background-color: #eef2ff;
            color: var(--primary);
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 14px;
            margin-top: 5px;
        }

        /* Data display */
        .data-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        .data-card h3 {
            font-size: 1.1rem;
            color: var(--primary);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .data-field {
            display: flex;
            margin-bottom: 12px;
            padding-bottom: 12px;
            border-bottom: 1px solid #f0f0f0;
        }

        .data-label {
            font-weight: 500;
            color: var(--dark);
            min-width: 180px;
        }

        .data-value {
            color: var(--gray);
            flex: 1;
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

            .data-field {
                flex-direction: column;
                gap: 5px;
            }

            .data-label {
                min-width: auto;
            }
        }

        @media (max-width: 480px) {
            .header-actions {
                gap: 10px;
            }

            .logo-text {
                font-size: 18px;
            }
        }

        /* Animation */
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

        .specialty-indicator {
            display: inline-block;
            padding: 5px 12px;
            background: #eef2ff;
            border-radius: 20px;
            color: var(--primary);
            font-weight: 500;
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
                    <li><a href="#">Tableau de bord</a></li>
                    <li><a href="#" class="active">Profil</a></li>
                    <li><a href="#">Rendez-vous</a></li>
                    <li><a href="#">Patients</a></li>
                </ul>
            </nav>

            <div class="header-actions">
                <!-- Profile container -->
                <div class="profile-container" id="profileContainer">
                    <button class="profile-btn" id="profileBtn">
                        <img src="https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&h=200&q=80"
                            alt="Photo de profil" class="profile-img">
                        <span class="profile-name" id="profileName">Dr. {{ explode(' ', $user->full_name)[0] }}</span>
                    </button>

                    <div class="profile-dropdown fade-in">
                        <div class="dropdown-header">
                            <h3 id="profileFullName">Dr. {{ $user->full_name }}</h3>
                            <p id="profileEmail">{{ $user->email }}</p>
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
                <li><a href="#">Tableau de bord</a></li>
                <li><a href="#" class="active">Profil</a></li>
                <li><a href="#">Rendez-vous</a></li>
                <li><a href="#">Patients</a></li>
                <li><a href="#">Documents</a></li>
                <li><a href="#">Paramètres</a></li>
                <li><a href="#">Aide</a></li>
            </ul>
        </div>
    </header>

    <main class="main-container">
        <h1 class="dashboard-title">
            <i class="fas fa-user-md"></i>
            Modifier mon profil médical
        </h1>

        <!-- Success Message -->
        <div class="success-message" id="successMessage" style="display: none;">
            <i class="fas fa-check-circle"></i>
            <span>Votre profil a été mis à jour avec succès!</span>
        </div>

        <!-- Profile Form -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden fade-in">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-900">Modifier les informations professionnelles</h2>
            </div>
            <div class="p-6">
                <form id="doctorProfileForm" action="{{ route('medecin.profil.update') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <input type="hidden" name="medecin_id" value="{{ $user->medecin->id }}">

                    <!-- Photo de profil -->
                    <div class="form-group">
                        <label class="form-label">Photo de profil</label>
                        <div class="avatar-upload">
                            <img src="https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&h=200&q=80"
                                alt="Photo de profil" class="avatar-preview" id="avatarPreview">
                            <div class="avatar-upload-btn">
                                <i class="fas fa-camera"></i>
                                <input type="file" id="avatarInput" name="avatar" accept="image/*">
                            </div>
                        </div>
                    </div>

                    <!-- Informations personnelles -->
                    <div class="form-section-title">
                        <i class="fas fa-user"></i>
                        <span>Informations personnelles</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="form-group">
                            <label class="form-label required-label">Nom complet</label>
                            <input type="text" class="form-input" name="full_name" id="full_name"
                                value="{{ $user->full_name }}" required>
                            <div class="error-message" id="full_name_error"></div>
                        </div>
                        <div class="form-group">
                            <label class="form-label required-label">Adresse email</label>
                            <input type="email" class="form-input" name="email" id="email" value="{{ $user->email }}"
                                required>
                            <div class="error-message" id="email_error"></div>
                        </div>
                        <div class="form-group">
                            <label class="form-label required-label">Téléphone</label>
                            <input type="tel" class="form-input" name="number_phone" id="number_phone"
                                value="{{ $user->number_phone }}" required>
                            <div class="error-message" id="number_phone_error"></div>
                        </div>
                    </div>

                    <!-- Informations professionnelles -->
                    <div class="form-section-title">
                        <i class="fas fa-briefcase-medical"></i>
                        <span>Informations professionnelles</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="form-group">
                            <label class="form-label required-label">Spécialité</label>
                            <select class="form-input" name="specialite_id" id="specialite_id" required>
                                <option value="">Sélectionner une spécialité</option>
                                @foreach($specialites as $specialite)
                                    <option value="{{ $specialite->id }}" {{ $user->medecin->specialite_id == $specialite->id ? 'selected' : '' }}>
                                        {{ $specialite->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="error-message" id="specialite_id_error"></div>
                        </div>
                        <div class="form-group">
                            <label class="form-label required-label">Numéro de licence</label>
                            <input type="text" class="form-input" name="license_number" id="license_number"
                                value="{{ $user->medecin->license_number }}" required>
                            <div class="error-message" id="license_number_error"></div>
                        </div>
                        <div class="form-group">
                            <label class="form-label required-label">Années d'expérience</label>
                            <input type="number" class="form-input" name="years_of_experience" id="years_of_experience"
                                value="{{ $user->medecin->years_of_experience }}" min="0" max="60" required>
                            <div class="error-message" id="years_of_experience_error"></div>
                        </div>
                        <div class="form-group md:col-span-2">
                            <label class="form-label required-label">Adresse professionnelle</label>
                            <input type="text" class="form-input" name="adresse" id="adresse"
                                value="{{ $user->medecin->adresse }}" required>
                            <div class="error-message" id="adresse_error"></div>
                        </div>
                        <div class="form-group md:col-span-2">
                            <label class="form-label">Description professionnelle</label>
                            <textarea class="form-input" name="description" id="description"
                                rows="4">{{ $user->medecin->description }}</textarea>
                            <div class="error-message" id="description_error"></div>
                        </div>
                    </div>

                    <!-- Boutons d'action -->
                    <div class="mt-8 flex flex-wrap gap-4">

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-2"></i> Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer style="margin-top: 50px; padding: 20px; background: white; border-top: 1px solid #eee;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px; text-align: center; color: var(--gray);">
            <a href="#"
                style="display: flex; align-items: center; justify-content: center; gap: 10px; text-decoration: none; margin-bottom: 15px;">
                <i class="fas fa-heartbeat" style="color: var(--primary); font-size: 24px;"></i>
                <span style="font-size: 22px; font-weight: 700; color: var(--primary);">BookDoctor</span>
            </a>
            <p>&copy; {{ date('Y') }} BookDoctor. Tous droits réservés.</p>
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

    document.addEventListener('click', function (e) {
        if (!hamburger.contains(e.target) && !mobileNav.contains(e.target)) {
            hamburger.classList.remove('active');
            mobileNav.classList.remove('active');
        }
    });

    // Profile dropdown toggle
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

    // Avatar preview
    const avatarInput = document.getElementById('avatarInput');
    const avatarPreview = document.getElementById('avatarPreview');

    avatarInput.addEventListener('change', function (e) {
        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                avatarPreview.src = e.target.result;
            }

            reader.readAsDataURL(e.target.files[0]);
        }
    });

    // Validation du formulaire (sans AJAX)
    const doctorProfileForm = document.getElementById('doctorProfileForm');

    doctorProfileForm.addEventListener('submit', function (e) {
        const errorMessages = document.querySelectorAll('.error-message');
        errorMessages.forEach(el => {
            el.style.display = 'none';
            el.textContent = '';
        });

        const fullName = document.getElementById('full_name').value.trim();
        const email = document.getElementById('email').value.trim();
        const phone = document.getElementById('number_phone').value.trim();
        const specialite = document.getElementById('specialite_id').value;
        const licenseNumber = document.getElementById('license_number').value.trim();
        const yearsExperience = document.getElementById('years_of_experience').value;
        const address = document.getElementById('adresse').value.trim();

        let isValid = true;

        if (!fullName) {
            showError('full_name_error', 'Le nom complet est requis.');
            isValid = false;
        }

        if (!email) {
            showError('email_error', 'L\'adresse email est requise.');
            isValid = false;
        } else if (!isValidEmail(email)) {
            showError('email_error', 'Adresse email invalide.');
            isValid = false;
        }

        if (!phone) {
            showError('number_phone_error', 'Le numéro de téléphone est requis.');
            isValid = false;
        }

        if (!specialite) {
            showError('specialite_id_error', 'La spécialité est requise.');
            isValid = false;
        }

        if (!licenseNumber) {
            showError('license_number_error', 'Le numéro de licence est requis.');
            isValid = false;
        }

        if (!yearsExperience || yearsExperience < 0) {
            showError('years_of_experience_error', 'Années d\'expérience non valides.');
            isValid = false;
        }

        if (!address) {
            showError('adresse_error', 'L\'adresse professionnelle est requise.');
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault(); // Empêche l’envoi si des erreurs sont présentes
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
</script>

</body>

</html>