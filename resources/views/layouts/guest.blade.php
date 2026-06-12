<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Google Fonts: Inter, Plus Jakarta Sans, Noto Sans Gujarati -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Noto+Sans+Gujarati:wght@400;600;700&family=Noto+Sans:wght@400;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Dynamic Theme Script (Run early to prevent white flash) -->
        <script>
            const savedTheme = localStorage.getItem('user-theme') || 'dark';
            document.documentElement.setAttribute('data-theme', savedTheme);
        </script>

        <style>
            :root {
                /* Light Theme Palette - HSL Tailored */
                --bg-body: hsl(210, 40%, 96.5%);
                --bg-grid-dot: hsla(215, 25%, 30%, 0.05);
                --card-bg: hsl(0, 0%, 100%);
                --card-border: hsl(214, 32%, 91%);
                --text-title: hsl(222, 47%, 11%);
                --text-body: hsl(215, 25%, 27%);
                --text-muted: hsl(215, 16%, 47%);
                
                /* Inputs */
                --input-bg: hsl(0, 0%, 100%);
                --input-border: hsl(214, 32%, 85%);
                --input-focus-border: hsl(243, 75%, 59%);
                --input-focus-shadow: hsla(243, 75%, 59%, 0.15);
                
                /* Buttons */
                --btn-bg: hsl(243, 75%, 59%);
                --btn-hover: hsl(243, 75%, 50%);
                --btn-text: hsl(0, 0%, 100%);
                
                /* Theme switcher */
                --toggle-bg: hsl(210, 40%, 93%);
                --toggle-active-bg: hsl(0, 0%, 100%);
                --toggle-border: hsl(214, 32%, 88%);
                
                --glow-opacity: 0.05;
                --font-family: 'Plus Jakarta Sans', 'Inter', 'Noto Sans Gujarati', 'Noto Sans', sans-serif;
                --transition: all 0.22s cubic-bezier(0.4, 0, 0.2, 1);
                --card-shadow: 0 12px 34px -10px hsla(222, 47%, 10%, 0.04), 0 2px 8px -2px hsla(222, 47%, 10%, 0.02);
                --text-error: hsl(343, 75%, 50%);
            }

            [data-theme="dark"] {
                /* Premium Dark Theme Palette */
                --bg-body: hsl(222, 47%, 7%);
                --bg-grid-dot: hsla(0, 0%, 100%, 0.02);
                --card-bg: hsl(222, 47%, 11%);
                --card-border: hsl(222, 47%, 16%);
                --text-title: hsl(210, 40%, 98%);
                --text-body: hsl(213, 27%, 84%);
                --text-muted: hsl(215, 16%, 65%);
                
                /* Inputs */
                --input-bg: hsl(222, 47%, 8%);
                --input-border: hsl(222, 47%, 18%);
                --input-focus-border: hsl(243, 75%, 68%);
                --input-focus-shadow: hsla(243, 75%, 68%, 0.2);
                
                /* Buttons */
                --btn-bg: hsl(243, 75%, 64%);
                --btn-hover: hsl(243, 75%, 72%);
                --btn-text: hsl(222, 47%, 6%);
                
                /* Theme switcher */
                --toggle-bg: hsl(222, 47%, 14%);
                --toggle-active-bg: hsl(222, 47%, 20%);
                --toggle-border: hsl(222, 47%, 18%);
                
                --glow-opacity: 0.18;
                --card-shadow: 0 20px 40px -15px hsla(0, 0%, 0%, 0.35);
                --text-error: hsl(343, 85%, 65%);
            }

            body {
                font-family: var(--font-family) !important;
                background-color: var(--bg-body) !important;
                background-image: 
                    radial-gradient(circle at 50% 0%, hsla(243, 75%, 59%, var(--glow-opacity)) 0%, transparent 60%),
                    radial-gradient(var(--bg-grid-dot) 1px, transparent 1px) !important;
                background-size: 100% 100%, 28px 28px !important;
                color: var(--text-body) !important;
                transition: background-color 0.3s ease, color 0.3s ease;
            }

            /* Main Container */
            .auth-container {
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 3rem 1rem;
                position: relative;
                z-index: 1;
            }

            /* Theme Toggle Bar */
            .top-nav {
                position: absolute;
                top: 1.5rem;
                right: 1.5rem;
                z-index: 10;
            }

            .switcher-group {
                display: flex;
                background: var(--toggle-bg);
                border: 1px solid var(--toggle-border);
                padding: 4px;
                border-radius: 12px;
                gap: 2px;
            }

            .switch-btn {
                background: transparent;
                border: none;
                color: var(--text-muted);
                padding: 6px 12px;
                font-size: 0.8rem;
                font-weight: 600;
                font-family: inherit;
                border-radius: 8px;
                cursor: pointer;
                display: flex;
                align-items: center;
                gap: 6px;
                transition: var(--transition);
            }

            .switch-btn.active {
                background: var(--toggle-active-bg);
                color: var(--text-title);
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            }

            .switch-btn svg {
                width: 14px;
                height: 14px;
                fill: none;
                stroke: currentColor;
                stroke-width: 2.5;
            }

            /* Card Styling */
            .auth-card {
                width: 100%;
                max-width: 450px;
                background: var(--card-bg);
                border: 1px solid var(--card-border);
                border-radius: 24px;
                padding: 2.5rem;
                box-shadow: var(--card-shadow);
                position: relative;
                overflow: hidden;
                transition: var(--transition);
                margin-top: 1.5rem;
            }

            .auth-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 4px;
                background: linear-gradient(90deg, hsl(243, 75%, 59%), hsl(174, 75%, 45%));
            }

            /* Header Logo */
            .logo-wrapper {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            /* Labels */
            label, .form-label {
                font-size: 0.88rem !important;
                font-weight: 600 !important;
                color: var(--text-title) !important;
                margin-bottom: 0.5rem;
                display: block;
            }

            /* Inputs Override */
            input[type="text"],
            input[type="email"],
            input[type="password"] {
                width: 100%;
                padding: 0.8rem 1rem !important;
                background-color: var(--input-bg) !important;
                border: 1.5px solid var(--input-border) !important;
                border-radius: 12px !important;
                color: var(--text-title) !important;
                font-family: inherit !important;
                font-size: 0.95rem !important;
                outline: none !important;
                box-shadow: none !important;
                transition: var(--transition) !important;
            }

            input[type="text"]:focus,
            input[type="email"]:focus,
            input[type="password"]:focus {
                border-color: var(--input-focus-border) !important;
                box-shadow: 0 0 0 4px var(--input-focus-shadow) !important;
            }

            /* Buttons Override */
            button[type="submit"],
            .primary-btn-override {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 0.6rem;
                padding: 0.85rem 2rem !important;
                font-size: 0.95rem !important;
                font-weight: 700 !important;
                background-color: var(--btn-bg) !important;
                color: var(--btn-text) !important;
                border: none !important;
                border-radius: 12px !important;
                cursor: pointer !important;
                text-transform: none !important;
                letter-spacing: normal !important;
                width: 100%;
                box-shadow: 0 4px 12px hsla(243, 75%, 59%, 0.2) !important;
                transition: var(--transition) !important;
            }

            button[type="submit"]:hover,
            .primary-btn-override:hover {
                background-color: var(--btn-hover) !important;
                transform: translateY(-1px);
                box-shadow: 0 6px 16px hsla(243, 75%, 59%, 0.28) !important;
            }

            button[type="submit"]:active,
            .primary-btn-override:active {
                transform: translateY(0);
            }

            /* Custom text / helpers inside the auth cards */
            .auth-text-muted {
                color: var(--text-muted) !important;
            }
            .auth-text-title {
                color: var(--text-title) !important;
            }
            .auth-divider {
                border-color: var(--card-border) !important;
            }

            /* Links */
            a.link-override,
            .auth-card a:not([target="_blank"]) {
                color: var(--text-muted);
                font-size: 0.88rem;
                text-decoration: underline;
                transition: var(--transition);
            }

            a.link-override:hover,
            .auth-card a:not([target="_blank"]):hover {
                color: var(--text-title);
            }

            /* Footer credit */
            .auth-footer {
                margin-top: 1.5rem;
                text-align: center;
                font-size: 0.75rem;
                color: var(--text-muted);
            }

            .auth-footer a {
                text-decoration: underline;
                color: var(--text-muted);
                transition: var(--transition);
            }

            .auth-footer a:hover {
                color: var(--text-title);
            }

            /* Checkbox customized */
            input[type="checkbox"] {
                border-radius: 4px !important;
                background-color: var(--input-bg) !important;
                border: 1.5px solid var(--input-border) !important;
                color: hsl(243, 75%, 59%) !important;
                transition: var(--transition) !important;
            }

            input[type="checkbox"]:focus {
                ring-color: hsl(243, 75%, 59%) !important;
                box-shadow: 0 0 0 2px var(--input-focus-shadow) !important;
            }
            
            /* Custom input error list */
            ul.text-red-600, ul.text-sm {
                color: var(--text-error) !important;
                list-style: none !important;
                font-weight: 500 !important;
                padding-left: 0 !important;
                margin-top: 0.5rem !important;
                font-size: 0.82rem !important;
            }
            
            /* Highlight input with error */
            .has-error input {
                border-color: var(--text-error) !important;
                box-shadow: 0 0 0 4px hsla(343, 75%, 50%, 0.18) !important;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="auth-container">
            <div class="top-nav">
                <div class="switcher-group" id="theme-switcher">
                    <button class="switch-btn" data-theme-val="light">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <circle cx="12" cy="12" r="5"></circle>
                            <line x1="12" y1="1" x2="12" y2="3"></line>
                            <line x1="12" y1="21" x2="12" y2="23"></line>
                            <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                            <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                            <line x1="1" y1="12" x2="3" y2="12"></line>
                            <line x1="21" y1="12" x2="23" y2="12"></line>
                            <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                            <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                        </svg>
                        Light
                    </button>
                    <button class="switch-btn" data-theme-val="dark">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                        </svg>
                        Dark
                    </button>
                </div>
            </div>

            <div class="logo-wrapper">
                <a href="/">
                    <x-application-logo />
                </a>
            </div>

            <div class="auth-card">
                {{ $slot }}
            </div>

            <div class="auth-footer">
                Developed by <a href="https://chwebtech.in" target="_blank">Harshit Chavda | CH Web Technologies</a>
            </div>
        </div>

        <script>
            const themeButtons = document.querySelectorAll('[data-theme-val]');
            
            function setTheme(theme) {
                themeButtons.forEach(btn => btn.classList.remove('active'));
                const activeBtn = document.querySelector(`[data-theme-val="${theme}"]`);
                if (activeBtn) activeBtn.classList.add('active');
                document.documentElement.setAttribute('data-theme', theme);
                localStorage.setItem('user-theme', theme);
            }

            const currentTheme = localStorage.getItem('user-theme') || 'dark';
            setTheme(currentTheme);

            themeButtons.forEach(btn => {
                btn.addEventListener('click', () => {
                    setTheme(btn.getAttribute('data-theme-val'));
                });
            });
        </script>
    </body>
</html>
