<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - BookDoctor</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6b7280;
        }

        .phone-error {
            animation: shake 0.5s;
            border-color: #ef4444 !important;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-5px);
            }

            75% {
                transform: translateX(5px);
            }
        }

        .remember-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .social-login-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .social-login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .google-btn {
            background-color: #fff;
            border: 1px solid #e0e0e0;
            color: #5f6368;
        }

        .facebook-btn {
            background-color: #3b5998;
            color: white;
        }

        .separator {
            display: flex;
            align-items: center;
            text-align: center;
            color: #6b7280;
            margin: 20px 0;
        }

        .separator::before,
        .separator::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #e5e7eb;
        }

        .separator::before {
            margin-right: .75em;
        }

        .separator::after {
            margin-left: .75em;
        }

        .floating-label-group {
            position: relative;
            margin-bottom: 20px;
        }

        .floating-label {
            position: absolute;
            top: 16px;
            left: 15px;
            font-size: 14px;
            color: #6b7280;
            transition: all 0.2s ease;
            pointer-events: none;
        }

        .form-input:focus~.floating-label,
        .form-input:not(:placeholder-shown)~.floating-label {
            top: -10px;
            left: 10px;
            font-size: 12px;
            background-color: white;
            padding: 0 5px;
            color: #3b82f6;
        }

        .form-input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .pulse-animation {
            animation: pulse 2s infinite;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-blue-50 to-indigo-50 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full">
        <div class="bg-white rounded-xl shadow-xl overflow-hidden">
            <!-- Header avec dégradé -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 py-6 px-8 text-center relative">
                <div class="absolute top-4 right-4">
                    <span class="bg-white/20 backdrop-blur-sm py-1 px-3 rounded-full text-sm text-white">
                        <i class="fas fa-lock mr-1"></i>Sécurisé
                    </span>
                </div>

                <div class="inline-block bg-white/20 backdrop-blur-sm p-3 rounded-full mb-4">
                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center pulse-animation">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                </div>
                <h1 class="text-2xl font-bold text-white">BookDoctor</h1>
                <h2 class="mt-2 text-xl font-semibold text-blue-100">Connexion à votre compte</h2>
                <p class="mt-1 text-blue-100/80">Accédez à votre espace personnel</p>
            </div>



            <!-- Formulaire de connexion -->
            <form class="space-y-5 p-6 md:p-8" onsubmit="handleLogin(event)" action="{{ route('login') }}"
                method="POST">
                @csrf

                @if (session('success'))
                    <div class="bg-green-100 border border-green-200 text-green-800 px-4 py-3 rounded relative mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                @if($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">Erreur !</strong>
                        <ul class="mt-2 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Identifiant (email ou téléphone) -->
                <div class="floating-label-group">
                    <input id="login" name="identifier" type="text" required
                        class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-transparent focus:outline-none transition duration-200"
                        placeholder=" ">
                    <label for="identifier" class="floating-label">
                        <i class="fas fa-user mr-1 text-blue-500"></i> Email ou Téléphone *
                    </label>
                </div>

                <!-- Mot de passe -->
                <div class="relative floating-label-group">
                    <input id="password" name="password" type="password" required
                        class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-transparent focus:outline-none transition duration-200"
                        placeholder=" ">
                    <label for="password" class="floating-label">
                        <i class="fas fa-lock mr-1 text-blue-500"></i> Mot de passe *
                    </label>
                    <span class="password-toggle" onclick="togglePassword('password')">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>

                <!-- Se souvenir de moi et mot de passe oublié -->
                <div class="remember-container">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox"
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">
                            Se souvenir de moi
                        </label>
                    </div>
                    <a href="#" class="text-sm text-blue-600 hover:text-blue-500 font-medium">
                        Mot de passe oublié ?
                    </a>
                </div>

                <!-- Bouton de connexion -->
                <div>
                    <button type="submit"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-base font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-blue-700 hover:to-indigo-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300 transform hover:-translate-y-0.5">
                        <i class="fas fa-sign-in-alt mr-2"></i> Se connecter
                    </button>
                </div>

                <!-- Séparateur -->
                <div class="separator">
                    <span>Ou continuer avec</span>
                </div>

                <!-- Connexion sociale -->
                <div class="grid grid-cols-2 gap-4">
                    <button type="button" class="social-login-btn google-btn">
                        <i class="fab fa-google mr-2"></i> Google
                    </button>
                    <button type="button" class="social-login-btn facebook-btn">
                        <i class="fab fa-facebook-f mr-2"></i> Facebook
                    </button>
                </div>
            </form>

            <!-- Pas encore inscrit -->
            <div class="bg-gray-50 px-6 py-4 text-center border-t border-gray-200">
                <p class="text-sm text-gray-600">
                    Pas encore de compte ?
                    <a href="{{ route('inscription') }}" class="font-medium text-blue-600 hover:text-blue-500">
                        Créez votre compte
                    </a>
                </p>
            </div>
        </div>
    </div>

    <script>
        // Fonction pour basculer la visibilité du mot de passe
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const toggleIcon = field.nextElementSibling.querySelector('i');

            if (field.type === 'password') {
                field.type = 'text';
                toggleIcon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                field.type = 'password';
                toggleIcon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }

        // Fonction pour nettoyer le numéro de téléphone
        function cleanPhoneNumber(phone) {
            return phone.replace(/[^\d]/g, '');
        }

        // Validation et soumission du formulaire
        function handleLogin(event) {
            event.preventDefault();

            const formData = new FormData(event.target);

            const login = formData.get('identifier');
            const password = formData.get('password');

            let errors = [];

            // Détecter si l'identifiant est un email ou un téléphone
            const isEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(login);
            const isPhone = /^(0[5-79]\d{8})$/.test(cleanPhoneNumber(login));

            if (!isEmail && !isPhone) {
                errors.push("Format d'identifiant invalide. Utilisez un email valide ou un numéro de téléphone (05|06|07|09XXXXXXXX)");

                // Animation d'erreur
                const loginInput = document.getElementById('login');
                loginInput.classList.add('phone-error');
                setTimeout(() => {
                    loginInput.classList.remove('phone-error');
                }, 500);
            }

            if (!password || password.length < 6) {
                errors.push("Le mot de passe doit contenir au moins 6 caractères");

                // Animation d'erreur
                const passwordInput = document.getElementById('password');
                passwordInput.classList.add('phone-error');
                setTimeout(() => {
                    passwordInput.classList.remove('phone-error');
                }, 500);
            }

            // Affichage des erreurs
            if (errors.length > 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Erreurs de validation',
                    html: errors.join('<br>'),
                    confirmButtonColor: '#3b82f6'
                });
                return;
            }

            // Simulation de connexion réussie
            Swal.fire({
                title: 'Connexion en cours...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                    setTimeout(() => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Connexion réussie !',
                            text: 'Redirection vers votre espace...',
                            confirmButtonColor: '#3b82f6',
                            timer: 50000,
                            timerProgressBar: true,
                            willClose: () => {
                                // Soumission réelle du formulaire
                                event.target.submit();
                            }
                        });
                    }, 1500);
                }
            });
        }

        // Initialisation des champs avec étiquettes flottantes
        document.addEventListener('DOMContentLoaded', function () {
            // Ajouter l'animation de pulsation au logo
            const logo = document.querySelector('.pulse-animation');
            setTimeout(() => {
                logo.classList.remove('pulse-animation');
                setTimeout(() => logo.classList.add('pulse-animation'), 100);
            }, 2000);
        });
    </script>
</body>

</html>