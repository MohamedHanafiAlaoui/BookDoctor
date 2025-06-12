<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookDoctor - Gestion des Rendez-vous Médicaux</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2a7cc7;
            --primary-dark: #1a5a9e;
            --secondary: #34b4a9;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --success: #28a745;
            --danger: #dc3545;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Open Sans', sans-serif;
            color: var(--dark);
            line-height: 1.6;
            background-color: #f5f7fa;
            overflow-x: hidden;
        }
        
        h1, h2, h3, h4, h5 {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
        }
        
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        /* Header Styles */
        header {
            background-color: white;
            box-shadow: var(--shadow);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }
        
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
        }
        
        .logo {
            display: flex;
            align-items: center;
        }
        
        .logo i {
            color: var(--primary);
            font-size: 32px;
            margin-right: 10px;
        }
        
        .logo h1 {
            font-size: 24px;
            color: var(--primary);
        }
        
        .logo span {
            color: var(--secondary);
        }
        
        .nav-links {
            display: flex;
            list-style: none;
        }
        
        .nav-links li {
            margin-left: 30px;
        }
        
        .nav-links a {
            text-decoration: none;
            color: var(--dark);
            font-weight: 500;
            transition: var(--transition);
            position: relative;
        }
        
        .nav-links a:hover {
            color: var(--primary);
        }
        
        .nav-links a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            background: var(--primary);
            bottom: -5px;
            left: 0;
            transition: var(--transition);
        }
        
        .nav-links a:hover::after {
            width: 100%;
        }
        
        .btn {
            display: inline-block;
            padding: 12px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
            cursor: pointer;
            border: none;
            font-size: 16px;
        }
        
        .btn-primary {
            background-color: var(--primary);
            color: white;
        }
        
        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        .btn-secondary {
            background-color: var(--secondary);
            color: white;
        }
        
        .btn-secondary:hover {
            background-color: #2a9d8f;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        .btn-outline {
            background-color: transparent;
            border: 2px solid var(--primary);
            color: var(--primary);
        }
        
        .btn-outline:hover {
            background-color: var(--primary);
            color: white;
        }
        
        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, rgba(42, 124, 199, 0.1) 0%, rgba(52, 180, 169, 0.1) 100%);
            padding: 160px 0 100px;
            position: relative;
            overflow: hidden;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            background: rgba(42, 124, 199, 0.05);
            top: -300px;
            right: -200px;
        }
        
        .hero-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .hero-text {
            flex: 1;
            padding-right: 40px;
        }
        
        .hero-text h1 {
            font-size: 48px;
            line-height: 1.2;
            margin-bottom: 20px;
            color: var(--primary-dark);
        }
        
        .hero-text p {
            font-size: 18px;
            color: var(--gray);
            margin-bottom: 30px;
        }
        
        .hero-buttons {
            display: flex;
            gap: 15px;
        }
        
        .hero-image {
            flex: 1;
            text-align: center;
        }
        
        .hero-image img {
            max-width: 100%;
            border-radius: 10px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }
        
        /* Features Section */
        .section {
            padding: 100px 0;
        }
        
        .section-header {
            text-align: center;
            max-width: 700px;
            margin: 0 auto 60px;
        }
        
        .section-header h2 {
            font-size: 36px;
            color: var(--primary-dark);
            margin-bottom: 15px;
        }
        
        .section-header p {
            color: var(--gray);
            font-size: 18px;
        }
        
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }
        
        .feature-card {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: var(--shadow);
            transition: var(--transition);
            text-align: center;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }
        
        .feature-icon {
            width: 80px;
            height: 80px;
            background: rgba(42, 124, 199, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }
        
        .feature-icon i {
            font-size: 32px;
            color: var(--primary);
        }
        
        .feature-card h3 {
            margin-bottom: 15px;
            color: var(--primary-dark);
        }
        
        .feature-card p {
            color: var(--gray);
        }
        
        /* Patients Section */
        .patients {
            background-color: #f8f9fa;
        }
        
        /* Doctors Section */
        .doctors {
            background: linear-gradient(135deg, rgba(42, 124, 199, 0.05) 0%, rgba(52, 180, 169, 0.05) 100%);
        }
        
        /* Stats Section */
        .stats {
            background-color: var(--primary);
            color: white;
            padding: 70px 0;
        }
        
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
            text-align: center;
        }
        
        .stat-item h3 {
            font-size: 48px;
            margin-bottom: 10px;
        }
        
        .stat-item p {
            font-size: 18px;
            opacity: 0.9;
        }
        
        /* Testimonials */
        .testimonials {
            padding: 100px 0;
            background-color: white;
        }
        
        .testimonial-container {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
        }
        
        .testimonial {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 10px;
            margin: 30px 0;
            box-shadow: var(--shadow);
            position: relative;
        }
        
        .testimonial::before {
            content: '"';
            position: absolute;
            font-size: 100px;
            color: rgba(42, 124, 199, 0.1);
            top: -30px;
            left: 20px;
            font-family: serif;
        }
        
        .testimonial p {
            font-style: italic;
            margin-bottom: 20px;
            color: var(--dark);
        }
        
        .testimonial-author {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .author-img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: #ddd;
            margin-right: 15px;
            overflow: hidden;
        }
        
        .author-info h4 {
            color: var(--primary-dark);
            margin-bottom: 5px;
        }
        
        .author-info p {
            color: var(--gray);
            margin: 0;
            font-style: normal;
        }
        
        /* CTA Section */
        .cta {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 100px 0;
            text-align: center;
        }
        
        .cta h2 {
            font-size: 36px;
            margin-bottom: 20px;
        }
        
        .cta p {
            max-width: 600px;
            margin: 0 auto 30px;
            font-size: 18px;
            opacity: 0.9;
        }
        
        .cta .btn {
            background: white;
            color: var(--primary);
            font-weight: 600;
            padding: 15px 40px;
        }
        
        /* Footer */
        footer {
            background-color: var(--dark);
            color: white;
            padding: 70px 0 20px;
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }
        
        .footer-column h3 {
            color: white;
            margin-bottom: 20px;
            font-size: 20px;
            position: relative;
            padding-bottom: 10px;
        }
        
        .footer-column h3::after {
            content: '';
            position: absolute;
            width: 50px;
            height: 2px;
            background: var(--primary);
            bottom: 0;
            left: 0;
        }
        
        .footer-links {
            list-style: none;
        }
        
        .footer-links li {
            margin-bottom: 12px;
        }
        
        .footer-links a {
            color: #aaa;
            text-decoration: none;
            transition: var(--transition);
        }
        
        .footer-links a:hover {
            color: white;
            padding-left: 5px;
        }
        
        .social-icons {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }
        
        .social-icons a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            transition: var(--transition);
        }
        
        .social-icons a:hover {
            background: var(--primary);
            transform: translateY(-5px);
        }
        
        .footer-bottom {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: #aaa;
            font-size: 14px;
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .hero-content {
                flex-direction: column;
                text-align: center;
            }
            
            .hero-text {
                padding-right: 0;
                margin-bottom: 40px;
            }
            
            .hero-buttons {
                justify-content: center;
            }
            
            .hero-text h1 {
                font-size: 36px;
            }
        }
        
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
            
            .hero {
                padding: 140px 0 60px;
            }
            
            .section {
                padding: 60px 0;
            }
            
            .section-header h2 {
                font-size: 28px;
            }
            
            .hero-text h1 {
                font-size: 32px;
            }
            
            .hero-buttons {
                flex-direction: column;
                gap: 10px;
            }
            
            .btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <nav class="navbar">
                <div class="logo">
                    <i class="fas fa-heartbeat"></i>
                    <h1>Book<span>Doctor</span></h1>
                </div>
                <ul class="nav-links">
                    <li><a href="#features">Fonctionnalités</a></li>
                    <li><a href="#patients">Patients</a></li>
                    <li><a href="#doctors">Médecins</a></li>
                    <li><a href="#testimonials">Témoignages</a></li>
                    <li><a href="{{ route('inscription') }}" class="btn btn-outline">Connexion</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h1>Simplifiez votre parcours de santé</h1>
                    <p>BookDoctor est la plateforme qui connecte patients et médecins pour une prise de rendez-vous médicale simple, rapide et efficace. Prenez rendez-vous en quelques clics ou gérez votre cabinet avec facilité.</p>
                    <div class="hero-buttons">
                        <a href="#" class="btn btn-primary">Prendre un rendez-vous</a>
                        <a href="#" class="btn btn-outline">En savoir plus</a>
                    </div>
                </div>
                <div class="hero-image">
                    <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwxfDB8MXxyYW5kb218MHx8aG9zcGl0YWwsZG9jdG9yfHx8fHx8MTY4NjI1OTY0NA&ixlib=rb-4.0.3&q=80&utm_campaign=api-credit&utm_medium=referral&utm_source=unsplash_source&w=600" alt="Interface BookDoctor">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="section">
        <div class="container">
            <div class="section-header">
                <h2>Pourquoi choisir BookDoctor ?</h2>
                <p>Une plateforme complète qui simplifie la gestion des rendez-vous médicaux pour tous</p>
            </div>
            <div class="features">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3>Trouvez un médecin</h3>
                    <p>Recherchez facilement parmi des milliers de médecins généralistes et spécialistes près de chez vous.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h3>Réservation en ligne</h3>
                    <p>Prenez rendez-vous en quelques clics à tout moment, 24h/24 et 7j/7, sans attente téléphonique.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-bell"></i>
                    </div>
                    <h3>Rappels automatiques</h3>
                    <p>Recevez des notifications et rappels par SMS ou email pour ne manquer aucun rendez-vous.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-file-medical"></i>
                    </div>
                    <h3>Dossier médical</h3>
                    <p>Consultez votre historique de rendez-vous et documents médicaux en un seul endroit.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <h3>Gestion de cabinet</h3>
                    <p>Pour les médecins, gérez votre emploi du temps et vos patients simplement.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-comments"></i>
                    </div>
                    <h3>Communication facilitée</h3>
                    <p>Échangez directement avec votre médecin via la plateforme sécurisée.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Patients Section -->
    <section id="patients" class="section patients">
        <div class="container">
            <div class="section-header">
                <h2>Pour les patients</h2>
                <p>Une expérience simplifiée pour votre santé</p>
            </div>
            <div class="features">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h3>Recherche géolocalisée</h3>
                    <p>Trouvez les médecins disponibles près de votre domicile ou lieu de travail.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <h3>Profils vérifiés</h3>
                    <p>Consultez les profils détaillés des médecins, leurs spécialités et les avis des patients.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3>Disponibilités en temps réel</h3>
                    <p>Voyez les créneaux disponibles et réservez instantanément.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Doctors Section -->
    <section id="doctors" class="section doctors">
        <div class="container">
            <div class="section-header">
                <h2>Pour les médecins</h2>
                <p>Optimisez la gestion de votre cabinet</p>
            </div>
            <div class="features">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <h3>Agenda intelligent</h3>
                    <p>Gérez vos rendez-vous, modifiez votre emploi du temps et définissez vos disponibilités.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h3>Validation des RDV</h3>
                    <p>Validez ou refusez les demandes de rendez-vous en un clic.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>Gestion des patients</h3>
                    <p>Consultez les dossiers patients, historique et notes médicales.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="container">
            <div class="stats-container">
                <div class="stat-item">
                    <h3>15K+</h3>
                    <p>Patients satisfaits</p>
                </div>
                <div class="stat-item">
                    <h3>2K+</h3>
                    <p>Médecins partenaires</p>
                </div>
                <div class="stat-item">
                    <h3>85K+</h3>
                    <p>Rendez-vous mensuels</p>
                </div>
                <div class="stat-item">
                    <h3>98%</h3>
                    <p>Satisfaction clients</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section id="testimonials" class="testimonials">
        <div class="container">
            <div class="section-header">
                <h2>Ce que nos utilisateurs disent</h2>
                <p>Découvrez les témoignages de nos patients et médecins partenaires</p>
            </div>
            <div class="testimonial-container">
                <div class="testimonial">
                    <p>"BookDoctor a révolutionné la gestion de mon cabinet. Je gagne un temps précieux sur l'administration et je peux me concentrer sur mes patients. La prise de rendez-vous en ligne a réduit mon taux d'annulation de 30%."</p>
                    <div class="testimonial-author">
                        <div class="author-img">
                            <i class="fas fa-user-md" style="font-size: 32px; color: #777; padding-top: 14px;"></i>
                        </div>
                        <div class="author-info">
                            <h4>Dr. Sophie Martin</h4>
                            <p>Médecin généraliste, Paris</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial">
                    <p>"En tant que patiente régulière, BookDoctor m'a changé la vie. Plus besoin d'appeler pendant des heures pour un rendez-vous. Je trouve un spécialiste disponible près de chez moi en quelques minutes, même le soir ou le week-end."</p>
                    <div class="testimonial-author">
                        <div class="author-img">
                            <i class="fas fa-user" style="font-size: 32px; color: #777; padding-top: 14px;"></i>
                        </div>
                        <div class="author-info">
                            <h4>Émilie Dubois</h4>
                            <p>Patiente depuis 2 ans</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="container">
            <h2>Prêt à simplifier votre parcours médical ?</h2>
            <p>Rejoignez des milliers de patients et médecins qui utilisent déjà BookDoctor</p>
            <a href="#" class="btn">Commencer maintenant</a>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>BookDoctor</h3>
                    <p>La plateforme de référence pour la prise de rendez-vous médicaux en ligne. Simplifiez votre santé avec nous.</p>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="footer-column">
                    <h3>Liens rapides</h3>
                    <ul class="footer-links">
                        <li><a href="#">Accueil</a></li>
                        <li><a href="#features">Fonctionnalités</a></li>
                        <li><a href="#patients">Pour les patients</a></li>
                        <li><a href="#doctors">Pour les médecins</a></li>
                        <li><a href="#testimonials">Témoignages</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Informations</h3>
                    <ul class="footer-links">
                        <li><a href="#">À propos de nous</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Carrières</a></li>
                        <li><a href="#">Presse</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Légal</h3>
                    <ul class="footer-links">
                        <li><a href="#">Conditions d'utilisation</a></li>
                        <li><a href="#">Politique de confidentialité</a></li>
                        <li><a href="#">Mentions légales</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 BookDoctor. Tous droits réservés. Conçu avec <i class="fas fa-heart" style="color: var(--primary);"></i> pour votre santé</p>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    window.scrollTo({
                        top: target.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });
        
        // Header scroll effect
        window.addEventListener('scroll', function() {
            const header = document.querySelector('header');
            if (window.scrollY > 100) {
                header.style.boxShadow = '0 4px 10px rgba(0, 0, 0, 0.1)';
            } else {
                header.style.boxShadow = '0 4px 6px rgba(0, 0, 0, 0.1)';
            }
        });
    </script>
</body>
</html>