<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - MonApp</title>
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

        .radio-card {
            transition: all 0.3s ease;
        }

        .radio-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .radio-card.selected {
            border-color: #3b82f6;
            background-color: #eff6ff;
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
    </style>
</head>

<body class="bg-gradient-to-br from-blue-50 to-indigo-50 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full">
        <div class="bg-white rounded-xl shadow-xl overflow-hidden">
            <!-- Header avec dégradé -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 py-6 px-8 text-center">
                <div class="inline-block bg-white/20 backdrop-blur-sm p-3 rounded-full mb-4">
                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                </div>
                <h1 class="text-2xl font-bold text-white">BookDoctor</h1>
                <h2 class="mt-2 text-xl font-semibold text-blue-100">Créer votre compte</h2>
                <p class="mt-1 text-blue-100/80">Rejoignez-nous en quelques minutes</p>
            </div>

            <!-- Formulaire -->
            <form class="space-y-5 p-6 md:p-8" onsubmit="handleRegister(event)" action="{{ route('register') }}"
                method="POST">
                @csrf

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

                <!-- Nom complet -->
                <div>
                    <label for="full_name" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-user mr-1 text-blue-500"></i> Nom complet *
                    </label>
                    <input id="full_name" name="full_name" type="text" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                        placeholder="Votre nom complet">
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-envelope mr-1 text-blue-500"></i> Adresse e-mail *
                    </label>
                    <input id="email" name="email" type="email" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                        placeholder="exemple@email.com">
                </div>

                <!-- Téléphone (champ unique) -->
                <div>
                    <label for="number_phone" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-phone mr-1 text-blue-500"></i> Numéro de téléphone *
                    </label>
                    <div class="relative">
                        <input id="number_phone" name="number_phone" type="tel" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                            placeholder="Ex: 0612345678">
                        <span id="phone-format-hint" class="text-xs text-gray-500 absolute -bottom-5 left-0">
                            Format: 0612345678 (10 chiffres)
                        </span>
                    </div>
                </div>

                <!-- Type d'utilisateur -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">
                        <i class="fas fa-users mr-1 text-blue-500"></i> Type d'utilisateur *
                    </label>
                    <div class="grid grid-cols-2 gap-4">
                        <label class="relative">
                            <input type="radio" name="id_role" value="2" required class="sr-only peer user-type-radio">
                            <div id="doctor-card"
                                class="radio-card w-full p-4 border-2 border-gray-200 rounded-xl cursor-pointer bg-white hover:bg-gray-50 peer-checked:border-blue-500 peer-checked:bg-blue-50 transition duration-200">
                                <div class="flex flex-col items-center">
                                    <div
                                        class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mb-2">
                                        <i class="fas fa-user-md text-blue-600"></i>
                                    </div>
                                    <span class="text-sm font-medium text-gray-800">Docteur</span>
                                </div>
                            </div>
                        </label>

                        <label class="relative">
                            <input type="radio" name="id_role" value="3" required class="sr-only peer user-type-radio">
                            <div id="patient-card"
                                class="radio-card w-full p-4 border-2 border-gray-200 rounded-xl cursor-pointer bg-white hover:bg-gray-50 peer-checked:border-blue-500 peer-checked:bg-blue-50 transition duration-200">
                                <div class="flex flex-col items-center">
                                    <div
                                        class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mb-2">
                                        <i class="fas fa-user-injured text-green-600"></i>
                                    </div>
                                    <span class="text-sm font-medium text-gray-800">Patient</span>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Mot de passe -->
                <div class="relative">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-lock mr-1 text-blue-500"></i> Mot de passe *
                    </label>
                    <div class="relative">
                        <input id="password" name="password" type="password" required minlength="8"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                            placeholder="Créez un mot de passe">
                        <span class="password-toggle" onclick="togglePassword('password')">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                    <p class="mt-2 text-xs text-gray-500">
                        <i class="fas fa-info-circle mr-1"></i> Doit contenir au moins 8 caractères, une majuscule, une
                        minuscule, un chiffre et un symbole
                    </p>
                </div>

                <!-- Confirmation mot de passe -->
                <div class="relative">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-lock mr-1 text-blue-500"></i> Confirmer le mot de passe *
                    </label>
                    <div class="relative">
                        <input id="password_confirmation" name="password_confirmation" type="password" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                            placeholder="Confirmez votre mot de passe">
                        <span class="password-toggle" onclick="togglePassword('password_confirmation')">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                </div>

                <!-- Conditions d'utilisation -->
                <div class="flex items-start">
                    <input id="terms" name="terms" type="checkbox" required
                        class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded mt-1">
                    <label for="terms" class="ml-3 block text-sm text-gray-700">
                        J'accepte les <a href="#" class="text-blue-600 hover:text-blue-500 font-medium">conditions
                            d'utilisation</a> et la <a href="#"
                            class="text-blue-600 hover:text-blue-500 font-medium">politique de confidentialité</a>
                    </label>
                </div>

                <!-- Bouton d'inscription -->
                <div>
                    <button type="submit"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-base font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-blue-700 hover:to-indigo-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300 transform hover:-translate-y-0.5">
                        <i class="fas fa-user-plus mr-2"></i> Créer mon compte
                    </button>
                </div>
            </form>

            <!-- Déjà inscrit -->
            <div class="bg-gray-50 px-6 py-4 text-center border-t border-gray-200">
                <p class="text-sm text-gray-600">
                    Vous avez déjà un compte ?
                    <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500">
                        Connectez-vous ici
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

        // Animation pour les cartes de rôle
        document.querySelectorAll('.user-type-radio').forEach(radio => {
            radio.addEventListener('change', function () {
                document.querySelectorAll('.radio-card').forEach(card => {
                    card.classList.remove('selected');
                });

                if (this.value === '2') {
                    document.getElementById('doctor-card').classList.add('selected');
                } else {
                    document.getElementById('patient-card').classList.add('selected');
                }
            });
        });

        // Fonction pour nettoyer le numéro de téléphone
        function cleanPhoneNumber(phone) {
            return phone.replace(/[^\d]/g, '');
        }

        // Validation et soumission du formulaire
        function handleRegister(event) {
            event.preventDefault();

            const formData = new FormData(event.target);
            const rawPhone = formData.get('number_phone');
            const cleanedPhone = cleanPhoneNumber(rawPhone);

            const data = {
                full_name: formData.get('full_name'),
                email: formData.get('email'),
                number_phone: cleanedPhone,
                id_role: formData.get('id_role'),
                password: formData.get('password'),
                password_confirmation: formData.get('password_confirmation'),
                terms: formData.get('terms')
            };

            // Regex de validation
            const nameRegex = /^[a-zA-ZÀ-ÿ\s'-]{2,50}$/;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            // Nouveau regex très flexible pour numéro de téléphone international
            const phoneRegex = /^\+?[\d\s\-()]{8,20}$/;

            const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;

            let errors = [];

            // Validation des champs
            if (!nameRegex.test(data.full_name)) {
                errors.push("Nom complet invalide (2-50 caractères, lettres uniquement)");
            }

            if (!emailRegex.test(data.email)) {
                errors.push("Adresse email invalide");
            }

            if (!phoneRegex.test(rawPhone)) {
                errors.push("Numéro de téléphone invalide. Entrez un numéro valide au format international ou local.");
                const phoneInput = document.getElementById('number_phone');
                phoneInput.classList.add('phone-error');
                setTimeout(() => {
                    phoneInput.classList.remove('phone-error');
                }, 500);
            }

            if (!data.id_role) {
                errors.push("Veuillez sélectionner un type d'utilisateur");
            }

            if (!passwordRegex.test(data.password)) {
                errors.push("Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un symbole");
            }

            if (data.password !== data.password_confirmation) {
                errors.push("Les mots de passe ne correspondent pas");
            }

            if (!data.terms) {
                errors.push("Vous devez accepter les conditions d'utilisation");
            }

            if (errors.length > 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Erreurs de validation',
                    html: errors.join('<br>'),
                    confirmButtonColor: '#3b82f6'
                });
                return;
            }

            Swal.fire({
                icon: 'success',
                title: 'Inscription réussie !',
                text: `Bienvenue ${data.full_name}, votre compte a été créé avec succès.`,
                confirmButtonColor: '#3b82f6'
            }).then(() => {
                event.target.submit();
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            document.querySelector('.user-type-radio[value="2"]').checked = true;
            document.getElementById('doctor-card').classList.add('selected');
        });
    </script>

</body>

</html>