<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard - BookDoctor</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Variables */
        :root {
            --primary: #4f46e5;
            --primary-dark: #4338ca;
            --secondary: #7c3aed;
            --light: #f9fafb;
            --dark: #1f2937;
            --gray: #6b7280;
            --light-gray: #e5e7eb;
            --notification: #ef4444;
        }
        
        /* Base styles */
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
            padding-top: 70px;
        }
        
        /* Language switcher */
        .language-switcher {
            position: relative;
            margin-right: 15px;
        }
        
        .language-btn {
            background: #eef2ff;
            border: none;
            border-radius: 20px;
            padding: 8px 15px;
            cursor: pointer;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--primary);
            transition: all 0.3s;
        }
        
        .language-btn:hover {
            background: #e0e7ff;
        }
        
        .language-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            padding: 10px 0;
            min-width: 140px;
            display: none;
            z-index: 1000;
        }
        
        .language-switcher:hover .language-dropdown {
            display: block;
        }
        
        .language-option {
            display: flex;
            align-items: center;
            padding: 8px 15px;
            text-decoration: none;
            color: var(--dark);
            gap: 10px;
            transition: background 0.2s;
        }
        
        .language-option:hover {
            background: #f0f5ff;
        }
        
        .flag-icon {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }
        
        /* Header */
        header {
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
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
        
        /* Hamburger menu */
        .hamburger-menu {
            display: none;
            flex-direction: column;
            justify-content: space-between;
            width: 30px;
            height: 21px;
            cursor: pointer;
            position: relative;
            z-index: 110;
        }
        
        .hamburger-menu span {
            display: block;
            height: 3px;
            width: 100%;
            background-color: var(--primary);
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        
        nav {
            display: flex;
            transition: all 0.3s ease;
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
        
        nav a:hover, nav a.active {
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
        
        /* Notification icons */
        .notification-container {
            position: relative;
            margin-right: 5px;
        }
        
        .notification-btn {
            position: relative;
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s;
        }
        
        .notification-btn:hover {
            background: var(--light-gray);
        }
        
        .notification-count {
            position: absolute;
            top: -2px;
            right: -2px;
            background: var(--notification);
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
        
        .notification-icon {
            font-size: 18px;
            color: var(--gray);
        }
        
        .notification-btn:hover .notification-icon {
            color: var(--primary);
        }
        
        .notifications-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            width: 320px;
            max-height: 400px;
            overflow-y: auto;
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
        
        .notification-container:hover .notifications-dropdown,
        .notification-container.active .notifications-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        .dropdown-header {
            padding: 12px 16px;
            border-bottom: 1px solid var(--light-gray);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .dropdown-header h3 {
            font-size: 16px;
            font-weight: 600;
            color: var(--dark);
        }
        
        .mark-all-read {
            color: var(--primary);
            background: none;
            border: none;
            cursor: pointer;
            font-size: 13px;
            font-weight: 500;
        }
        
        .notification-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 12px 16px;
            text-decoration: none;
            color: var(--dark);
            transition: background 0.2s;
            position: relative;
        }
        
        .notification-item.unread {
            background: #f0f5ff;
        }
        
        .notification-item:hover {
            background: #f8fafc;
        }
        
        .notification-icon-item {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #eef2ff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 14px;
            flex-shrink: 0;
        }
        
        .notification-content {
            flex: 1;
        }
        
        .notification-title {
            font-weight: 500;
            margin-bottom: 4px;
            font-size: 14px;
        }
        
        .notification-time {
            color: var(--gray);
            font-size: 12px;
        }
        
        .unread-indicator {
            position: absolute;
            top: 20px;
            right: 16px;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--notification);
        }
        
        .dropdown-footer {
            text-align: center;
            padding: 10px;
            border-top: 1px solid var(--light-gray);
        }
        
        .view-all {
            color: var(--primary);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
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
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s, box-shadow 0.3s;
            border-left: 4px solid var(--primary);
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }
        
        .stat-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
        }
        
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: #eef2ff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 20px;
        }
        
        .stat-title {
            font-size: 16px;
            color: var(--gray);
        }
        
        .stat-value {
            font-size: 24px;
            font-weight: 700;
            color: var(--dark);
        }
        
        .stat-desc {
            font-size: 14px;
            color: var(--gray);
            margin-top: 5px;
        }
        
        /* Layout */
        .content-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 25px;
        }
        
        @media (min-width: 992px) {
            .content-grid {
                grid-template-columns: 2fr 1fr;
            }
        }
        
        .panel {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }
        
        .panel-header {
            padding: 18px 20px;
            border-bottom: 1px solid var(--light-gray);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .panel-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--dark);
        }
        
        .panel-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .appointment-list {
            padding: 10px 0;
        }
        
        .appointment-item {
            padding: 15px 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            border-bottom: 1px solid var(--light-gray);
            transition: background 0.2s;
        }
        
        .appointment-item:last-child {
            border-bottom: none;
        }
        
        .appointment-item:hover {
            background: #f9fafb;
        }
        
        .appointment-icon {
            width: 45px;
            height: 45px;
            border-radius: 10px;
            background: #f0f5ff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 18px;
            flex-shrink: 0;
        }
        
        .appointment-details {
            flex: 1;
        }
        
        .appointment-title {
            font-weight: 600;
            margin-bottom: 3px;
            color: var(--dark);
        }
        
        .appointment-meta {
            display: flex;
            gap: 15px;
            color: var(--gray);
            font-size: 14px;
        }
        
        .appointment-meta i {
            margin-right: 5px;
        }
        
        .appointment-status {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
        }
        
        .status-confirmed {
            background: #dcfce7;
            color: #166534;
        }
        
        .status-pending {
            background: #fef9c3;
            color: #854d0e;
        }
        
        /* Documents */
        .documents-list {
            padding: 10px 0;
        }
        
        .document-item {
            padding: 15px 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            border-bottom: 1px solid var(--light-gray);
        }
        
        .document-item:last-child {
            border-bottom: none;
        }
        
        .document-icon {
            width: 45px;
            height: 45px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }
        
        .pdf-icon {
            background: #fee2e2;
            color: #dc2626;
        }
        
        .doc-icon {
            background: #dcfce7;
            color: #166534;
        }
        
        .doc-details {
            flex: 1;
        }
        
        .doc-title {
            font-weight: 500;
            color: var(--dark);
            margin-bottom: 3px;
        }
        
        .doc-date {
            color: var(--gray);
            font-size: 14px;
        }
        
        .doc-download {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--light);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            cursor: pointer;
            transition: background 0.2s;
        }
        
        .doc-download:hover {
            background: #eef2ff;
        }
        
        /* Footer */
        footer {
            background: white;
            border-top: 1px solid var(--light-gray);
            padding: 30px 0;
            margin-top: 50px;
        }
        
        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }
        
        .footer-logo {
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }
        
        .footer-text {
            color: var(--gray);
            font-size: 15px;
        }
        
        /* Mobile Menu Overlay */
        .mobile-menu-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 99;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        
        .mobile-menu-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .hamburger-menu {
                display: flex;
            }
            
            nav {
                position: fixed;
                top: 0;
                right: -300px;
                width: 300px;
                height: 100vh;
                background: white;
                flex-direction: column;
                box-shadow: -5px 0 15px rgba(0, 0, 0, 0.1);
                padding: 80px 20px 20px;
                z-index: 100;
                transition: right 0.3s ease;
            }
            
            nav.active {
                right: 0;
            }
            
            nav ul {
                flex-direction: column;
                gap: 15px;
            }
            
            nav a {
                padding: 15px 0;
                display: block;
            }
            
            nav a.active::after {
                display: none;
            }
            
            .profile-name {
                display: none;
            }
            
            .header-container {
                padding: 0 15px;
            }
            
            .notifications-dropdown {
                width: 280px;
                right: -10px;
            }
            
            .notification-btn {
                width: 36px;
                height: 36px;
            }
            
            .notification-count {
                top: 0;
                right: 0;
            }
            
            .language-switcher {
                margin-right: 10px;
            }
            
            .language-btn {
                padding: 6px 10px;
                font-size: 14px;
            }
        }
        
        @media (max-width: 480px) {
            .header-actions {
                gap: 10px;
            }
            
            .logo-text {
                font-size: 18px;
            }
            
            .logo-icon {
                font-size: 20px;
            }
            
            .notifications-dropdown {
                width: 260px;
                max-height: 300px;
            }
            
            nav {
                width: 250px;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
        
        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .fade-in {
            animation: fadeIn 0.4s ease forwards;
        }
        
        /* Pulse animation for notification */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
        
        .notification-count {
            animation: pulse 1.5s infinite;
        }
        
        /* Hamburger animation */
        .hamburger-menu.active span:nth-child(1) {
            transform: translateY(9px) rotate(45deg);
        }
        
        .hamburger-menu.active span:nth-child(2) {
            opacity: 0;
        }
        
        .hamburger-menu.active span:nth-child(3) {
            transform: translateY(-9px) rotate(-45deg);
        }
        
        /* Profile Styles */
        .profile-header {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            padding: 60px 0 40px;
            color: white;
            margin-bottom: 30px;
        }
        
        .header-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        
        @media (min-width: 768px) {
            .header-inner {
                flex-direction: row;
                text-align: left;
            }
        }
        
        .avatar-section {
            position: relative;
            margin-bottom: 20px;
        }
        
        @media (min-width: 768px) {
            .avatar-section {
                margin-right: 40px;
                margin-bottom: 0;
            }
        }
        
        .profile-avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 4px solid rgba(255, 255, 255, 0.5);
            object-fit: cover;
            position: relative;
            box-shadow: 0 0 0 8px rgba(255, 255, 255, 0.1);
        }
        
        .edit-icon {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: white;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .edit-icon:hover {
            background: #f0f5ff;
            transform: scale(1.1);
        }
        
        .edit-icon i {
            color: var(--primary);
            font-size: 16px;
        }
        
        .profile-info {
            flex: 1;
        }
        
        .profile-name {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .profile-contact {
            margin-bottom: 15px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            align-items: center;
        }
        
        @media (min-width: 768px) {
            .profile-contact {
                justify-content: flex-start;
            }
        }
        
        .profile-contact i {
            margin-right: 5px;
        }
        
        .separator {
            display: none;
        }
        
        @media (min-width: 768px) {
            .separator {
                display: inline;
                margin: 0 15px;
                opacity: 0.7;
            }
        }
        
        .badges {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
        }
        
        @media (min-width: 768px) {
            .badges {
                justify-content: flex-start;
            }
        }
        
        .badge {
            background-color: rgba(255, 255, 255, 0.2);
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 14px;
            display: flex;
            align-items: center;
        }
        
        .badge i {
            margin-right: 5px;
        }
        
        .stat-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        .appointment-card {
            border-left: 4px solid #4f46e5;
        }
        
        .history-card {
            border-top: 3px solid #7c3aed;
        }
        
        .avatar-upload input {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            opacity: 0;
            cursor: pointer;
        }
        
        .tabs .tab {
            position: relative;
            padding-bottom: 8px;
            cursor: pointer;
        }
        
        .tabs .tab.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: #4f46e5;
            border-radius: 3px;
        }
        
        .purchase-banner {
            background: linear-gradient(135deg, #7c3aed 0%, #4f46e5 100%);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(124, 58, 237, 0.3);
            transition: transform 0.3s ease;
        }
        
        .purchase-banner:hover {
            transform: translateY(-3px);
        }
        
        .purchase-banner .pulse {
            animation: pulse 2s infinite;
        }
        
        .tab-content {
            display: none;
        }
        
        .tab-content.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }
        
        @keyframes pulse {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(124, 58, 237, 0.7); }
            70% { transform: scale(1); box-shadow: 0 0 0 12px rgba(124, 58, 237, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(124, 58, 237, 0); }
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Styles pour les notifications */
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: #ef4444;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            font-weight: bold;
            animation: pulse-badge 1.5s infinite;
        }
        
        .notification-panel {
            position: absolute;
            top: 100%;
            right: 0;
            width: 350px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            z-index: 1000;
            max-height: 400px;
            overflow-y: auto;
            display: none;
        }
        
        .notification-item {
            padding: 15px;
            border-bottom: 1px solid #f1f1f1;
            cursor: pointer;
            transition: background 0.2s;
        }
        
        .notification-item:hover {
            background: #f9fafb;
        }
        
        .notification-item.unread {
            background: #f0f9ff;
        }
        
        .notification-time {
            font-size: 0.75rem;
            color: #6b7280;
        }
        
        @keyframes pulse-badge {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #374151;
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
            border-color: #4f46e5;
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
            background-color: #4f46e5;
            color: white;
            border: none;
        }
        
        .btn-primary:hover {
            background-color: #4338ca;
        }
        
        .health-indicator {
            height: 8px;
            border-radius: 4px;
            margin-top: 8px;
            background-color: #e5e7eb;
            overflow: hidden;
        }
        
        .health-indicator-fill {
            height: 100%;
            border-radius: 4px;
        }
        
        .security-item {
            display: flex;
            align-items: center;
            padding: 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            background-color: white;
        }
        
        .security-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            flex-shrink: 0;
        }
        
        .security-details {
            flex-grow: 1;
        }
        
        .security-status {
            font-size: 0.875rem;
            font-weight: 500;
        }
        
        /* Profile page specific */
        .profile-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .profile-content {
            display: grid;
            grid-template-columns: 1fr;
            gap: 30px;
            margin-top: 30px;
        }
        
        @media (min-width: 992px) {
            .profile-content {
                grid-template-columns: 1fr 2fr;
            }
        }
        
        .profile-sidebar {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        
        .profile-main {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        
        .personal-info {
            margin-bottom: 30px;
        }
        
        .info-item {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #f3f4f6;
        }
        
        .info-item:last-child {
            border-bottom: none;
        }
        
        .info-label {
            font-weight: 500;
            color: #6b7280;
        }
        
        .info-value {
            color: #1f2937;
            text-align: right;
        }
        
        .tabs-container {
            margin-top: 20px;
        }
        
        .tabs {
            display: flex;
            border-bottom: 1px solid #e5e7eb;
            margin-bottom: 20px;
        }
        
        .tab {
            padding: 12px 20px;
            cursor: pointer;
            font-weight: 500;
            color: #6b7280;
            position: relative;
        }
        
        .tab.active {
            color: #4f46e5;
        }
        
        .tab.active::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
            height: 2px;
            background: #4f46e5;
        }
        
        .appointment-history .appointment-item {
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
        }
        
        .health-metrics {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        
        .metric-card {
            background: #f9fafb;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
        }
        
        .metric-value {
            font-size: 24px;
            font-weight: 700;
            color: #4f46e5;
            margin: 10px 0;
        }
        
        .metric-label {
            color: #6b7280;
            font-size: 14px;
        }
        
        .prescription-item {
            display: flex;
            justify-content: space-between;
            padding: 15px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        
        .prescription-info {
            flex: 1;
        }
        
        .prescription-title {
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .prescription-details {
            color: #6b7280;
            font-size: 14px;
        }
        
        .prescription-status {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 15px;
        }
        
        .status-active {
            background: #dcfce7;
            color: #166534;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
        }
        
        .status-completed {
            background: #dbeafe;
            color: #1e40af;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
        }
        
        /* Language specific */
        .lang-en { display: block; }
        .lang-fr { display: none; }
        
        body.lang-fr .lang-en { display: none; }
        body.lang-fr .lang-fr { display: block; }
    </style>
</head>
<body class="lang-en">
    <!-- Header -->
    <header>
        <div class="header-container">
            <a href="#" class="logo">
                <i class="fas fa-heartbeat logo-icon"></i>
                <span class="logo-text">BookDoctor</span>
            </a>
            
            <!-- Hamburger Menu -->
            <div class="hamburger-menu" id="hamburgerMenu">
                <span></span>
                <span></span>
                <span></span>
            </div>
            
            <nav id="mainNav">
                <ul>
                    <li>
                        <a href="#" class="active">
                            <span class="lang-en">Home</span>
                            <span class="lang-fr">Accueil</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="lang-en">My Appointments</span>
                            <span class="lang-fr">Mes rendez-vous</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="lang-en">Medical History</span>
                            <span class="lang-fr">Historique médical</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="lang-en">Documents</span>
                            <span class="lang-fr">Documents</span>
                        </a>
                    </li>

                </ul>
            </nav>
            
            <div class="header-actions">
                <!-- Language switcher -->
                <div class="language-switcher">
                    <button class="language-btn" id="languageBtn">
                        <i class="fas fa-globe"></i>
                        <span class="lang-en">EN</span>
                        <span class="lang-fr">FR</span>
                    </button>
                    <div class="language-dropdown">
                        <a href="#" class="language-option" data-lang="en">
                            <div class="flag-icon" style="background-color: #3c3b6e; color: white;">
                                <i class="fas fa-flag-usa"></i>
                            </div>
                            <span>English</span>
                        </a>
                        <a href="#" class="language-option" data-lang="fr">
                            <div class="flag-icon" style="background-color: #002654; color: white;">
                                <i class="fas fa-flag"></i>
                            </div>
                            <span>Français</span>
                        </a>
                    </div>
                </div>
                
                <!-- Notification icon -->
                <div class="notification-container" id="notificationContainer">
                    <button class="notification-btn" id="notificationBtn">
                        <i class="fas fa-bell notification-icon"></i>
                        <span class="notification-count">3</span>
                    </button>
                    
                    <div class="notifications-dropdown fade-in">
                        <div class="dropdown-header">
                            <h3 class="lang-en">Notifications</h3>
                            <h3 class="lang-fr">Notifications</h3>
                            <button class="mark-all-read">
                                <span class="lang-en">Mark all as read</span>
                                <span class="lang-fr">Tout marquer comme lu</span>
                            </button>
                        </div>
                        
                        <div class="notification-item unread">
                            <div class="notification-icon-item">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <div class="notification-content">
                                <div class="notification-title lang-en">New appointment confirmed</div>
                                <div class="notification-title lang-fr">Rendez-vous confirmé</div>
                                <div class="notification-time lang-en">15 minutes ago</div>
                                <div class="notification-time lang-fr">Il y a 15 minutes</div>
                            </div>
                            <span class="unread-indicator"></span>
                        </div>
                        
                        <div class="notification-item unread">
                            <div class="notification-icon-item">
                                <i class="fas fa-file-medical"></i>
                            </div>
                            <div class="notification-content">
                                <div class="notification-title lang-en">Your results are available</div>
                                <div class="notification-title lang-fr">Vos résultats sont disponibles</div>
                                <div class="notification-time lang-en">2 hours ago</div>
                                <div class="notification-time lang-fr">Il y a 2 heures</div>
                            </div>
                            <span class="unread-indicator"></span>
                        </div>
                        
                        <div class="notification-item">
                            <div class="notification-icon-item">
                                <i class="fas fa-comment-medical"></i>
                            </div>
                            <div class="notification-content">
                                <div class="notification-title lang-en">New message from your doctor</div>
                                <div class="notification-title lang-fr">Nouveau message de votre médecin</div>
                                <div class="notification-time lang-en">Yesterday, 2:30 PM</div>
                                <div class="notification-time lang-fr">Hier, 14:30</div>
                            </div>
                        </div>
                        
                        <div class="notification-item">
                            <div class="notification-icon-item">
                                <i class="fas fa-prescription-bottle"></i>
                            </div>
                            <div class="notification-content">
                                <div class="notification-title lang-en">Reminder: Take your medication</div>
                                <div class="notification-title lang-fr">Rappel : Prenez vos médicaments</div>
                                <div class="notification-time lang-en">Yesterday, 9:15 AM</div>
                                <div class="notification-time lang-fr">Hier, 09:15</div>
                            </div>
                        </div>
                        
                        <div class="dropdown-footer">
                            <a href="#" class="view-all">
                                <span class="lang-en">View all notifications</span>
                                <span class="lang-fr">Voir toutes les notifications</span>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Profile dropdown -->
                <div class="profile-container" id="profileContainer">
                    <button class="profile-btn" id="profileBtn">
                        <img src="{{ $user->patient->image}}" 
                             alt="Profile picture" class="profile-img">
                    </button>
                    
                    <div class="profile-dropdown fade-in">
                        <div class="dropdown-header">
                            <h3 class="lang-en">{{ $user->full_name }}</h3>
                            <h3 class="lang-fr">Marie Dupont</h3>
                            <p class="lang-fr">marie.dupont@example.com</p>
                        </div>
                        

                        <a href="#" class="dropdown-item" id="editLink">
                            <i class="fas fa-edit"></i>
                            <span class="lang-en">Edit Profile</span>
                            <span class="lang-fr">Modifier le profil</span>
                        </a>

                        
                        <div class="dropdown-divider"></div>
                        
                        <a href="#" class="dropdown-item" id="logoutLink">
                            <i class="fas fa-sign-out-alt"></i>
                            <span class="lang-en">Logout</span>
                            <span class="lang-fr">Déconnexion</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Mobile Menu Overlay -->
        <div class="mobile-menu-overlay" id="mobileMenuOverlay"></div>
    </header>

    <!-- Profile Header -->
    <div class="profile-header">
        <div class="header-inner">
            <div class="avatar-section">
                <img class="profile-avatar" src="{{ $user->patient->image}}">
                <div class="edit-icon">
                    <i class="fas fa-pencil-alt"></i>
                    <!-- <input type="file" id="avatar" name="avatar" accept="image/*"> -->
                </div>
            </div>
            <div class="profile-info">
                <h1 class="profile-name lang-en">{{ $user->full_name }}</h1>
                <h1 class="profile-name lang-fr">Marie Dupont</h1>
                <p class="profile-contact">
                    <i class="fas fa-envelope"></i>
                    <span class="lang-en">{{ $user->email }}</span>
                    <span class="lang-fr">marie.dupont@example.com</span>
                    <span class="separator">|</span>
                    <i class="fas fa-phone"></i>
                    <span>{{ $user->number_phone }}</span>
                </p>
                <div class="badges">
                    <span class="badge"><i class="fas fa-tint"></i> <span class="lang-en">Blood Type: {{ $user->patient->groupe_sanguin}}</span><span class="lang-fr">Groupe sanguin: O+</span></span>
                    <span class="badge"><i class="fas fa-allergies"></i> <span class="lang-en">Allergies:  {{ $user->patient->groupe_sanguin != null ?  $user->patient->groupe_sanguin : "none" }}</span><span class="lang-fr">Allergies: Aucune</span></span>
                    <span class="badge"><i class="fas fa-birthday-cake"></i> <span class="lang-en">Date of Birth: 03/15/1985</span><span class="lang-fr">Date de naissance: 15/03/1985</span></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="main-container">
        <h1 class="dashboard-title">
            <span class="lang-en">Dashboard</span>
            <span class="lang-fr">Tableau de bord</span>
        </h1>
        
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div>
                        <div class="stat-title lang-en">Next Appointment</div>
                        <div class="stat-title lang-fr">Prochain rendez-vous</div>
                        <div class="stat-value lang-en">June 15, 2:30 PM</div>
                        <div class="stat-value lang-fr">15 Juin, 14:30</div>
                    </div>
                </div>
                <div class="stat-desc lang-en">Dr. Smith - Cardiologist</div>
                <div class="stat-desc lang-fr">Dr. Smith - Cardiologue</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="fas fa-prescription-bottle-alt"></i>
                    </div>
                    <div>
                        <div class="stat-title lang-en">Active Prescriptions</div>
                        <div class="stat-title lang-fr">Ordonnances actives</div>
                        <div class="stat-value">2</div>
                    </div>
                </div>
                <div class="stat-desc lang-en">Renewal in 7 days</div>
                <div class="stat-desc lang-fr">Renouvellement dans 7 jours</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="fas fa-heartbeat"></i>
                    </div>
                    <div>
                        <div class="stat-title lang-en">Last Checkup</div>
                        <div class="stat-title lang-fr">Dernier examen</div>
                        <div class="stat-value lang-en">June 10, 2023</div>
                        <div class="stat-value lang-fr">10 Juin 2023</div>
                    </div>
                </div>
                <div class="stat-desc lang-en">Blood Test - Normal results</div>
                <div class="stat-desc lang-fr">Analyse sanguine - Résultats normaux</div>
            </div>
        </div>
        
        <div class="content-grid">
            <div class="panel appointment-card">
                <div class="panel-header">
                    <h3 class="panel-title lang-en">Upcoming Appointments</h3>
                    <h3 class="panel-title lang-fr">Rendez-vous à venir</h3>
                    <a href="#" class="panel-link">
                        <span class="lang-en">View All</span>
                        <span class="lang-fr">Tout voir</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
                <div class="appointment-list">
                    <div class="appointment-item">
                        <div class="appointment-icon">
                            <i class="fas fa-stethoscope"></i>
                        </div>
                        <div class="appointment-details">
                            <div class="appointment-title lang-en">General Consultation</div>
                            <div class="appointment-title lang-fr">Consultation générale</div>
                            <div class="appointment-meta">
                                <span><i class="fas fa-user-md"></i> <span class="lang-en">Dr. John Smith</span><span class="lang-fr">Dr. Jean Martin</span></span>
                                <span><i class="fas fa-clock"></i> <span class="lang-en">June 15, 2:30 PM</span><span class="lang-fr">15 Juin, 14:30</span></span>
                            </div>
                        </div>
                        <div class="appointment-status status-confirmed lang-en">Confirmed</div>
                        <div class="appointment-status status-confirmed lang-fr">Confirmé</div>
                    </div>
                    
                    <div class="appointment-item">
                        <div class="appointment-icon">
                            <i class="fas fa-heartbeat"></i>
                        </div>
                        <div class="appointment-details">
                            <div class="appointment-title lang-en">Cardiac Exam</div>
                            <div class="appointment-title lang-fr">Examen cardiaque</div>
                            <div class="appointment-meta">
                                <span><i class="fas fa-user-md"></i> <span class="lang-en">Dr. Marie Johnson</span><span class="lang-fr">Dr. Marie Jeanne</span></span>
                                <span><i class="fas fa-clock"></i> <span class="lang-en">June 22, 10:00 AM</span><span class="lang-fr">22 Juin, 10:00</span></span>
                            </div>
                        </div>
                        <div class="appointment-status status-pending lang-en">Pending</div>
                        <div class="appointment-status status-pending lang-fr">En attente</div>
                    </div>
                </div>
            </div>
            
            <div class="panel history-card">
                <div class="panel-header">
                    <h3 class="panel-title lang-en">Medical Documents</h3>
                    <h3 class="panel-title lang-fr">Documents médicaux</h3>
                    <a href="#" class="panel-link">
                        <span class="lang-en">View All</span>
                        <span class="lang-fr">Tout voir</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
                <div class="documents-list">
                    <div class="document-item">
                        <div class="document-icon pdf-icon">
                            <i class="fas fa-file-pdf"></i>
                        </div>
                        <div class="doc-details">
                            <div class="doc-title lang-en">Blood Test Results</div>
                            <div class="doc-title lang-fr">Résultats d'analyse sanguine</div>
                            <div class="doc-date lang-en">June 10, 2023</div>
                            <div class="doc-date lang-fr">10 Juin 2023</div>
                        </div>
                        <div class="doc-download">
                            <i class="fas fa-download"></i>
                        </div>
                    </div>
                    
                    <div class="document-item">
                        <div class="document-icon doc-icon">
                            <i class="fas fa-file-medical"></i>
                        </div>
                        <div class="doc-details">
                            <div class="doc-title lang-en">Medical Prescription</div>
                            <div class="doc-title lang-fr">Ordonnance médicale</div>
                            <div class="doc-date lang-en">June 5, 2023</div>
                            <div class="doc-date lang-fr">5 Juin 2023</div>
                        </div>
                        <div class="doc-download">
                            <i class="fas fa-download"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <a href="#" class="footer-logo">
                <i class="fas fa-heartbeat"></i>
                <span class="logo-text">BookDoctor</span>
            </a>
            <p class="footer-text">
                <span class="lang-en">&copy; 2023 BookDoctor. All rights reserved.</span>
                <span class="lang-fr">&copy; 2023 BookDoctor. Tous droits réservés.</span>
            </p>
        </div>
    </footer>

    <script>
        // Language switching functionality
        const languageOptions = document.querySelectorAll('.language-option');
        const languageBtn = document.getElementById('languageBtn');
        
        languageOptions.forEach(option => {
            option.addEventListener('click', function(e) {
                e.preventDefault();
                const lang = this.getAttribute('data-lang');
                document.body.className = `lang-${lang}`;
                
                // Update button text
                const langText = lang === 'en' ? 'EN' : 'FR';
                languageBtn.querySelector('.lang-en, .lang-fr').textContent = langText;
                
                // Close all dropdowns
                document.querySelector('.language-dropdown').style.display = 'none';
                profileContainer.classList.remove('active');
                notificationContainer.classList.remove('active');
            });
        });
        
        // Mobile menu functionality
        const hamburgerMenu = document.getElementById('hamburgerMenu');
        const mainNav = document.getElementById('mainNav');
        const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
        
        hamburgerMenu.addEventListener('click', function() {
            this.classList.toggle('active');
            mainNav.classList.toggle('active');
            mobileMenuOverlay.classList.toggle('active');
            
            // Close other dropdowns
            profileContainer.classList.remove('active');
            notificationContainer.classList.remove('active');
        });
        
        mobileMenuOverlay.addEventListener('click', function() {
            hamburgerMenu.classList.remove('active');
            mainNav.classList.remove('active');
            this.classList.remove('active');
        });
        
        // Close mobile menu when clicking on nav links
        document.querySelectorAll('nav a').forEach(link => {
            link.addEventListener('click', function() {
                hamburgerMenu.classList.remove('active');
                mainNav.classList.remove('active');
                mobileMenuOverlay.classList.remove('active');
            });
        });
        
        // Profile dropdown management
        const profileContainer = document.getElementById('profileContainer');
        const profileBtn = document.getElementById('profileBtn');
        
        // Notification elements
        const notificationContainer = document.getElementById('notificationContainer');
        const notificationBtn = document.getElementById('notificationBtn');
        const markAllReadBtn = document.querySelector('.mark-all-read');
        const notificationItems = document.querySelectorAll('.notification-item');
        const notificationCount = document.querySelector('.notification-count');
        
        // Open menu on mobile click
        profileBtn.addEventListener('click', function(e) {
            // Close other dropdowns
            notificationContainer.classList.remove('active');
            
            // Toggle profile dropdown
            profileContainer.classList.toggle('active');
            e.stopPropagation();
        });
        
        // Open notifications menu on click
        notificationBtn.addEventListener('click', function(e) {
            // Close other dropdowns
            profileContainer.classList.remove('active');
            
            // Toggle notifications dropdown
            notificationContainer.classList.toggle('active');
            e.stopPropagation();
        });
        
        // Close menus when clicking elsewhere
        document.addEventListener('click', function(e) {
            if (!profileContainer.contains(e.target)) {
                profileContainer.classList.remove('active');
            }
            if (!notificationContainer.contains(e.target)) {
                notificationContainer.classList.remove('active');
            }
        });
        
        // Mark all notifications as read
        markAllReadBtn.addEventListener('click', function(e) {
            e.preventDefault();
            notificationItems.forEach(item => {
                item.classList.remove('unread');
            });
            document.querySelectorAll('.unread-indicator').forEach(indicator => {
                indicator.style.display = 'none';
            });
            notificationCount.textContent = '0';
            notificationCount.style.display = 'none';
            
            Swal.fire({
                title: document.body.classList.contains('lang-en') ? 
                    'Notifications marked as read' : 'Notifications marquées comme lues',
                icon: 'success',
                confirmButtonColor: '#4f46e5'
            });
        });
        
        // Mark individual notification as read
        notificationItems.forEach(item => {
            item.addEventListener('click', function(e) {
                if(this.classList.contains('unread')) {
                    this.classList.remove('unread');
                    const indicator = this.querySelector('.unread-indicator');
                    if(indicator) indicator.style.display = 'none';
                    
                    // Update notification count
                    const currentCount = parseInt(notificationCount.textContent);
                    if(currentCount > 0) {
                        notificationCount.textContent = currentCount - 1;
                    }
                    
                    if(notificationCount.textContent === '0') {
                        notificationCount.style.display = 'none';
                    }
                }
            });
        });
        
        // Menu action management

        
        document.getElementById('editLink').addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: document.body.classList.contains('lang-en') ? 
                    'Edit Profile' : 'Modifier le profil',
                text: document.body.classList.contains('lang-en') ? 
                    'Editing profile information' : 'Édition des informations du profil',
                icon: 'info',
                confirmButtonColor: '#4f46e5'
            });
            profileContainer.classList.remove('active');
        });
        
        document.getElementById('settingsLink').addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: document.body.classList.contains('lang-en') ? 
                    'Settings' : 'Paramètres',
                text: document.body.classList.contains('lang-en') ? 
                    'Modifying account settings' : 'Modification des paramètres du compte',
                icon: 'info',
                confirmButtonColor: '#4f46e5'
            });
            profileContainer.classList.remove('active');
        });
        
        document.getElementById('logoutLink').addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: document.body.classList.contains('lang-en') ? 
                    'Logout' : 'Déconnexion',
                text: document.body.classList.contains('lang-en') ? 
                    'You have been successfully logged out' : 'Vous avez été déconnecté avec succès',
                icon: 'success',
                confirmButtonColor: '#4f46e5'
            }).then(() => {
                // Redirect to login page
                window.location.href = '/login';
            });
            profileContainer.classList.remove('active');
        });
        
        // Simulate document download
        document.querySelectorAll('.doc-download').forEach(icon => {
            icon.addEventListener('click', function() {
                Swal.fire({
                    icon: 'info',
                    title: document.body.classList.contains('lang-en') ? 
                        'Download' : 'Téléchargement',
                    text: document.body.classList.contains('lang-en') ? 
                        'This feature will be available in the full version' : 
                        'Cette fonctionnalité sera disponible dans la version complète',
                    confirmButtonColor: '#4f46e5'
                });
            });
        });
        
        // Show notification indicator pulse
        setInterval(() => {
            notificationCount.classList.toggle('pulse');
        }, 3000);
        
        // Avatar upload functionality
        document.getElementById('avatar').addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    document.querySelector('.profile-avatar').src = e.target.result;
                    
                    Swal.fire({
                        title: document.body.classList.contains('lang-en') ? 
                            'Profile picture updated' : 'Photo de profil mise à jour',
                        text: document.body.classList.contains('lang-en') ? 
                            'Your profile picture has been changed successfully' : 
                            'Votre photo de profil a été modifiée avec succès',
                        icon: 'success',
                        confirmButtonColor: '#4f46e5'
                    });
                }
                
                reader.readAsDataURL(e.target.files[0]);
            }
        });
    </script>

    
</body>
</html>