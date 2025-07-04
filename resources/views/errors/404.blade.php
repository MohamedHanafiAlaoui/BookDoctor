<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page non trouvée - BookDoctor</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4f46e5',
                        'primary-dark': '#4338ca',
                        secondary: '#7c3aed',
                        notification: '#ef4444',
                        warning: '#f59e0b',
                        dark: '#1f2937',
                        gray: '#6b7280',
                        'light-gray': '#e5e7eb'
                    },
                    animation: {
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'float': 'float 6s ease-in-out infinite',
                        'bounce-slow': 'bounce 3s infinite'
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-20px)' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            padding: 20px;
            overflow-x: hidden;
        }
        
        .error-container {
            max-width: 800px;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 10;
            text-align: center;
        }
        
        .error-animation {
            position: relative;
            width: 300px;
            height: 300px;
            margin-bottom: 40px;
            animation: float 6s ease-in-out infinite;
        }
        
        .error-animation .circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(239, 68, 68, 0.05);
            animation: pulse-slow 4s infinite;
        }
        
        .circle-1 {
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }
        
        .circle-2 {
            width: 80%;
            height: 80%;
            top: 10%;
            left: 10%;
            animation-delay: 0.5s;
        }
        
        .circle-3 {
            width: 60%;
            height: 60%;
            top: 20%;
            left: 20%;
            animation-delay: 1s;
        }
        
        .error-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 8rem;
            color: #ef4444;
            animation: bounce-slow 3s infinite;
        }
        
        .error-content {
            padding: 0 20px;
        }
        
        .error-content h1 {
            font-size: 5rem;
            font-weight: 800;
            color: #1f2937;
            margin-bottom: 10px;
            line-height: 1;
            background: linear-gradient(45deg, #ef4444, #f59e0b);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .error-content h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 20px;
        }
        
        .error-content p {
            font-size: 1.25rem;
            color: #4b5563;
            margin-bottom: 40px;
            line-height: 1.6;
            max-width: 600px;
        }
        
        .btn-container {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            justify-content: center;
            margin-bottom: 40px;
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            padding: 14px 28px;
            font-weight: 600;
            border-radius: 12px;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            font-size: 1.1rem;
        }
        
        .btn-primary {
            background-color: #4f46e5;
            color: white;
        }
        
        .btn-primary:hover {
            background-color: #4338ca;
            transform: translateY(-3px);
            box-shadow: 0 10px 15px rgba(79, 70, 229, 0.3);
        }
        
        .btn-secondary {
            background-color: white;
            color: #4f46e5;
            border: 2px solid #e0e7ff;
        }
        
        .btn-secondary:hover {
            background-color: #eef2ff;
            transform: translateY(-3px);
            box-shadow: 0 10px 15px rgba(79, 70, 229, 0.1);
        }
        
        .btn i {
            margin-right: 10px;
            font-size: 1.2rem;
        }
        
        .error-links {
            display: flex;
            gap: 25px;
            margin-top: 30px;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .error-links a {
            color: #4f46e5;
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            padding: 8px 16px;
            border-radius: 8px;
        }
        
        .error-links a:hover {
            background-color: #eef2ff;
            transform: translateY(-2px);
        }
        
        @media (max-width: 768px) {
            .error-animation {
                width: 220px;
                height: 220px;
            }
            
            .error-icon {
                font-size: 6rem;
            }
            
            .error-content h1 {
                font-size: 4rem;
            }
            
            .error-content h2 {
                font-size: 2rem;
            }
            
            .error-content p {
                font-size: 1.1rem;
            }
            
            .btn {
                padding: 12px 24px;
                font-size: 1rem;
            }
        }
        
        @media (max-width: 480px) {
            .error-animation {
                width: 180px;
                height: 180px;
                margin-bottom: 30px;
            }
            
            .error-icon {
                font-size: 5rem;
            }
            
            .error-content h1 {
                font-size: 3rem;
            }
            
            .error-content h2 {
                font-size: 1.5rem;
            }
            
            .btn-container {
                flex-direction: column;
                width: 100%;
                max-width: 300px;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- Contenu principal -->
    <div class="error-container">
        <div class="error-animation">
            <div class="circle circle-1"></div>
            <div class="circle circle-2"></div>
            <div class="circle circle-3"></div>
            <div class="error-icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
        </div>
        
        <div class="error-content">
            <h1>404</h1>
            <h2>Page non trouvée</h2>
            <p>Désolé, la page que vous cherchez semble introuvable. Il est possible que l'adresse soit incorrecte ou que la page ait été déplacée.</p>
            

        </div>
    </div>

    <script>
        // Animation des cercles
        document.addEventListener('DOMContentLoaded', function() {
            const circles = document.querySelectorAll('.circle');
            circles.forEach((circle, index) => {
                circle.style.animationDelay = `${index * 0.5}s`;
            });
            
            // Animation des boutons au survol
            const buttons = document.querySelectorAll('.btn');
            buttons.forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-3px)';
                    this.style.boxShadow = '0 10px 15px rgba(0, 0, 0, 0.15)';
                });
                
                button.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                    this.style.boxShadow = '0 4px 6px rgba(0, 0, 0, 0.1)';
                });
            });
            
            // Animation des liens utiles
            const links = document.querySelectorAll('.error-links a');
            links.forEach(link => {
                link.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px)';
                });
                
                link.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
</body>
</html>