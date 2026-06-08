<!DOCTYPE html>
<html lang="gu" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>વસ્તી ગણતરી પત્રક | Census Portal</title>
    <!-- Google Fonts: Inter & Plus Jakarta Sans & Noto Sans Gujarati/Devanagari for local scripts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Noto+Sans+Gujarati:wght@400;600;700&family=Noto+Sans:wght@400;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
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
            
            /* Inputs & Selection Pills */
            --input-bg: hsl(0, 0%, 100%);
            --input-border: hsl(214, 32%, 85%);
            --input-focus-border: hsl(243, 75%, 59%);
            --input-focus-shadow: hsla(243, 75%, 59%, 0.15);
            --pill-inactive-bg: hsl(210, 40%, 96.1%);
            --pill-inactive-text: hsl(215, 25%, 35%);
            --pill-active-bg: hsl(243, 75%, 96%);
            --pill-active-border: hsl(243, 75%, 59%);
            --pill-active-text: hsl(243, 75%, 45%);
            
            /* Section Header Accents */
            --section-title-bg: hsl(210, 40%, 95%);
            --section-num-bg: hsl(243, 75%, 59%);
            
            /* Buttons */
            --btn-bg: hsl(243, 75%, 59%);
            --btn-hover: hsl(243, 75%, 50%);
            --btn-text: hsl(0, 0%, 100%);
            
            /* Theme & Lang Switchers */
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
            
            /* Inputs & Selection Pills */
            --input-bg: hsl(222, 47%, 8%);
            --input-border: hsl(222, 47%, 18%);
            --input-focus-border: hsl(243, 75%, 68%);
            --input-focus-shadow: hsla(243, 75%, 68%, 0.2);
            --pill-inactive-bg: hsl(222, 47%, 14%);
            --pill-inactive-text: hsl(213, 27%, 78%);
            --pill-active-bg: hsla(243, 75%, 68%, 0.12);
            --pill-active-border: hsl(243, 75%, 68%);
            --pill-active-text: hsl(243, 75%, 85%);
            
            /* Section Header Accents */
            --section-title-bg: hsl(222, 47%, 14%);
            --section-num-bg: hsl(243, 75%, 68%);
            
            /* Buttons */
            --btn-bg: hsl(243, 75%, 64%);
            --btn-hover: hsl(243, 75%, 72%);
            --btn-text: hsl(222, 47%, 6%);
            
            /* Theme & Lang Switchers */
            --toggle-bg: hsl(222, 47%, 14%);
            --toggle-active-bg: hsl(222, 47%, 20%);
            --toggle-border: hsl(222, 47%, 18%);
            
            --glow-opacity: 0.18;
            --card-shadow: 0 20px 40px -15px hsla(0, 0%, 0%, 0.35);
            --text-error: hsl(343, 85%, 65%);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: var(--font-family);
            background-color: var(--bg-body);
            background-image: 
                radial-gradient(circle at 50% 0%, hsla(243, 75%, 59%, var(--glow-opacity)) 0%, transparent 60%),
                radial-gradient(var(--bg-grid-dot) 1px, transparent 1px);
            background-size: 100% 100%, 28px 28px;
            color: var(--text-body);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding: 2rem 1rem;
            position: relative;
            overflow-x: hidden;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .container {
            width: 100%;
            max-width: 960px;
            z-index: 1;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        /* Top Bar with Language Switcher & Theme toggle */
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            background: rgba(255, 255, 255, 0.02);
            backdrop-filter: blur(8px);
            border-radius: 16px;
            padding: 0.75rem 1.25rem;
            border: 1px solid var(--card-border);
        }

        .bar-left {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .logo-text {
            font-weight: 700;
            letter-spacing: -0.02em;
            color: var(--text-title);
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .bar-right {
            display: flex;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        /* Control switchers */
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

        /* Form Header Section */
        .form-header-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 24px;
            padding: 2.5rem;
            box-shadow: var(--card-shadow);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .form-header-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, hsl(243, 75%, 59%), hsl(174, 75%, 45%));
        }

        .form-header-card h1 {
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--text-title);
            margin-bottom: 0.75rem;
            letter-spacing: -0.03em;
            line-height: 1.25;
        }

        .form-header-card p {
            color: var(--text-muted);
            font-size: 1.05rem;
            max-width: 600px;
            margin: 0 auto 1.5rem auto;
            line-height: 1.6;
        }

        /* Progress Tracker */
        .progress-container {
            max-width: 450px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .progress-label-bar {
            display: flex;
            justify-content: space-between;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-muted);
        }

        .progress-bar-bg {
            background: var(--toggle-bg);
            height: 8px;
            border-radius: 999px;
            overflow: hidden;
            width: 100%;
        }

        .progress-bar-fill {
            background: linear-gradient(90deg, hsl(243, 75%, 59%), hsl(243, 75%, 68%));
            height: 100%;
            width: 0%;
            border-radius: 999px;
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Mode Switcher Banner Container */
        .mode-selection-container {
            display: flex;
            justify-content: center;
            margin-top: 1rem;
        }

        /* Form Layout */
        .census-form {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        /* Section Cards */
        .section-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 24px;
            padding: 2rem 2.5rem;
            box-shadow: var(--card-shadow);
            display: flex;
            flex-direction: column;
            gap: 1.75rem;
            transition: var(--transition);
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            border-bottom: 1px solid var(--card-border);
            padding-bottom: 1rem;
        }

        .section-number {
            width: 32px;
            height: 32px;
            background: var(--section-num-bg);
            color: white;
            font-weight: 700;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.95rem;
            flex-shrink: 0;
            box-shadow: 0 4px 10px hsla(243, 75%, 59%, 0.25);
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-title);
            letter-spacing: -0.01em;
        }

        /* Grid for form inputs */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }

        .full-width {
            grid-column: span 2;
        }

        .half-width {
            grid-column: span 1;
        }

        /* Form controls */
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.6rem;
            position: relative;
        }

        .form-label {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-title);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .question-number {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--toggle-bg);
            color: var(--text-muted);
            font-size: 0.75rem;
            font-weight: 700;
            border-radius: 6px;
            min-width: 20px;
            height: 20px;
            padding: 0 4px;
        }

        .form-input {
            width: 100%;
            padding: 0.8rem 1rem;
            background-color: var(--input-bg);
            border: 1.5px solid var(--input-border);
            border-radius: 12px;
            color: var(--text-title);
            font-family: inherit;
            font-size: 0.95rem;
            outline: none;
            transition: var(--transition);
        }

        .form-input::placeholder {
            color: var(--text-muted);
            opacity: 0.45;
        }

        .form-input:focus {
            border-color: var(--input-focus-border);
            box-shadow: 0 0 0 4px var(--input-focus-shadow);
        }

        /* Validation Error Highlight */
        .form-input-error {
            border-color: var(--text-error) !important;
            box-shadow: 0 0 0 4px hsla(343, 75%, 50%, 0.18) !important;
        }

        /* Choice Cards / Options Grid */
        .options-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 0.6rem;
        }

        .choice-card {
            flex: 1 1 calc(33.333% - 0.6rem);
            min-width: 130px;
            position: relative;
            cursor: pointer;
        }

        .choice-card input[type="radio"],
        .choice-card input[type="checkbox"] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .choice-pill {
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 0.75rem 1rem;
            background-color: var(--pill-inactive-bg);
            border: 1.5px solid transparent;
            border-radius: 10px;
            font-size: 0.88rem;
            font-weight: 600;
            color: var(--pill-inactive-text);
            transition: var(--transition);
            user-select: none;
        }

        .choice-card:hover .choice-pill {
            background-color: var(--toggle-bg);
            color: var(--text-title);
        }

        /* Active option states */
        .choice-card input:checked + .choice-pill {
            background-color: var(--pill-active-bg);
            border-color: var(--pill-active-border);
            color: var(--pill-active-text);
            box-shadow: 0 4px 10px hsla(243, 75%, 59%, 0.08);
        }

        /* Checkbox-pill variation indicator */
        .choice-card input[type="checkbox"] + .choice-pill::before {
            content: '';
            width: 8px;
            height: 8px;
            border-radius: 2px;
            border: 1.5px solid var(--text-muted);
            margin-right: 8px;
            display: inline-block;
            transition: var(--transition);
        }

        .choice-card input[type="checkbox"]:checked + .choice-pill::before {
            background: var(--pill-active-border);
            border-color: var(--pill-active-border);
        }

        /* Submit Action Area */
        .submit-section {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 24px;
            padding: 2rem;
            box-shadow: var(--card-shadow);
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
        }

        .submit-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.6rem;
            padding: 1.1rem 2.5rem;
            font-size: 1.05rem;
            font-weight: 700;
            background-color: var(--btn-bg);
            color: var(--btn-text);
            border: none;
            border-radius: 14px;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 8px 24px hsla(243, 75%, 59%, 0.3);
            width: 100%;
            max-width: 320px;
        }

        .submit-btn:hover {
            background-color: var(--btn-hover);
            transform: translateY(-2px);
            box-shadow: 0 10px 28px hsla(243, 75%, 59%, 0.38);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .submit-btn svg {
            width: 20px;
            height: 20px;
            fill: none;
            stroke: currentColor;
            stroke-width: 2.5;
            transition: transform 0.2s ease;
        }

        .submit-btn:hover svg {
            transform: translateX(4px);
        }

        /* Responsive Breakpoints */
        @media (max-width: 768px) {
            body {
                padding: 1rem 0.5rem;
            }
            .form-grid {
                grid-template-columns: 1fr;
                gap: 1.25rem;
            }
            .half-width {
                grid-column: span 1;
            }
            .section-card {
                padding: 1.5rem 1.25rem;
            }
            .form-header-card {
                padding: 1.75rem 1.25rem;
            }
            .choice-card {
                flex: 1 1 calc(50% - 0.6rem);
            }
        }

        @media (max-width: 480px) {
            .choice-card {
                flex: 1 1 100%;
            }
            .top-bar {
                flex-direction: column;
                align-items: stretch;
            }
            .switcher-group {
                justify-content: center;
            }
        }
        .error-message {
            color: var(--text-error);
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 6px;
            margin-top: 4px;
        }

        .error-message svg {
            width: 14px;
            height: 14px;
            flex-shrink: 0;
            stroke: var(--text-error);
        }

        .form-label.label-error {
            color: var(--text-error);
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Top Nav/Control Bar -->
    <div class="top-bar">
        <div class="bar-left">
            <span class="logo-text">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="color: var(--section-num-bg);"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                <span data-localize="portal_title">વસ્તી ગણતરી પોર્ટલ</span>
            </span>
        </div>
        <div class="bar-right">
            <!-- Language Switcher -->
            <div class="switcher-group" id="lang-switcher">
                <button class="switch-btn" data-lang="gu">ગુજરાતી</button>
                <button class="switch-btn" data-lang="hi">हिन्दी</button>
                <button class="switch-btn" data-lang="en">English</button>
            </div>
            
            <!-- Theme Toggle -->
            <div class="switcher-group" id="theme-switcher">
                <button class="switch-btn" data-theme-val="light">
                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>
                </button>
                <button class="switch-btn" data-theme-val="dark">
                    <svg viewBox="0 0 24 24"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Banner Card -->
    <div class="form-header-card">
        <h1 data-localize="form_title">વસ્તી ગણતરી માટેના ૩૪ પ્રશ્નોની યાદી</h1>
        <p data-localize="form_desc">રાષ્ટ્રીય જનગણના પત્રક પૂર્ણ કરવા માટે નીચે આપેલ તમામ ૩૪ પ્રશ્નોના જવાબો ચોકસાઈપૂર્વક ભરો.</p>
        
        <!-- Field Progress Tracker -->
        <div class="progress-container">
            <div class="progress-label-bar">
                <span data-localize="completion_progress">ફોર્મ ભરવાની પ્રગતિ</span>
                <span id="progress-val">0%</span>
            </div>
            <div class="progress-bar-bg">
                <div class="progress-bar-fill" id="progress-indicator"></div>
            </div>
        </div>

        <!-- House / Shop Mode Toggle -->
        <div class="mode-selection-container">
            <div class="switcher-group" id="mode-switcher">
                <button type="button" class="switch-btn active" data-mode="house">
                    <span data-localize="mode_house">મકાન (House)</span>
                </button>
                <button type="button" class="switch-btn" data-mode="shop">
                    <span data-localize="mode_shop">દુકાન (Shop)</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Main Registration Form -->
    <form id="census-form" class="census-form" action="#" method="POST" novalidate>
        @csrf
        
        <!-- SECTION 1: Administrative Details -->
        <div class="section-card">
            <div class="section-header">
                <div class="section-number">1</div>
                <div class="section-title" data-localize="sec_1_title">વહીવટી વિગતો (Administrative Details)</div>
            </div>
            <div class="form-grid">
                <!-- 1. Line No -->
                <div class="form-group half-width">
                    <label class="form-label" for="q1">
                        <span class="question-number">1</span>
                        <span data-localize="q1_label">લીટી નં:</span>
                    </label>
                    <input type="number" id="q1" name="line_no" class="form-input tracking-input" placeholder="e.g. 1">
                </div>

                <!-- 2. House No -->
                <div class="form-group half-width">
                    <label class="form-label" for="q2">
                        <span class="question-number">2</span>
                        <span data-localize="q2_label">મકાન નં:</span>
                    </label>
                    <input type="text" id="q2" name="house_no" class="form-input tracking-input" placeholder="e.g. A-102">
                </div>

                <!-- 3. Census House No -->
                <div class="form-group half-width">
                    <label class="form-label" for="q3">
                        <span class="question-number">3</span>
                        <span data-localize="q3_label">જન ગણના ઘર નં:</span>
                    </label>
                    <input type="text" id="q3" name="census_house_no" class="form-input tracking-input" placeholder="e.g. CH-990">
                </div>

                <!-- 9. Household No -->
                <div class="form-group half-width">
                    <label class="form-label" for="q9">
                        <span class="question-number">9</span>
                        <span data-localize="q9_label">કુટુંબ નં:</span>
                    </label>
                    <input type="number" id="q9" name="household_no" class="form-input tracking-input" placeholder="e.g. 15">
                </div>

                <!-- 34. Mobile No -->
                <div class="form-group full-width">
                    <label class="form-label" for="q34">
                        <span class="question-number">34</span>
                        <span data-localize="q34_label">મો.નં:</span>
                    </label>
                    <input type="tel" id="q34" name="mobile_no" class="form-input tracking-input" placeholder="e.g. 9876543210">
                </div>
            </div>
        </div>

        <!-- SECTION 2: Housing & Facilities Details -->
        <div class="section-card">
            <div class="section-header">
                <div class="section-number">2</div>
                <div class="section-title" data-localize="sec_2_title">મકાન અને સુવિધાઓની વિગતો (Housing & Facilities)</div>
            </div>
            <div class="form-grid">
                <!-- 4. Floor Material -->
                <div class="form-group full-width">
                    <label class="form-label">
                        <span class="question-number">4</span>
                        <span data-localize="q4_label">ભોંયતળિયું (ફ્લોરિંગ સામગ્રી):</span>
                    </label>
                    <div class="options-grid">
                        <label class="choice-card">
                            <input type="radio" name="floor_material" value="mud" class="tracking-input">
                            <span class="choice-pill" data-localize="q4_opt_1">માટી</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="floor_material" value="wood" class="tracking-input">
                            <span class="choice-pill" data-localize="q4_opt_2">લાકડું</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="floor_material" value="stone" class="tracking-input">
                            <span class="choice-pill" data-localize="q4_opt_3">પથ્થર</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="floor_material" value="cement" class="tracking-input">
                            <span class="choice-pill" data-localize="q4_opt_4">સિમેન્ટ</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="floor_material" value="tiles" class="tracking-input">
                            <span class="choice-pill" data-localize="q4_opt_5">ટાઈલ્સ</span>
                        </label>
                    </div>
                </div>

                <!-- 5. Wall Material -->
                <div class="form-group full-width">
                    <label class="form-label">
                        <span class="question-number">5</span>
                        <span data-localize="q5_label">દિવાલ:</span>
                    </label>
                    <div class="options-grid">
                        <label class="choice-card">
                            <input type="radio" name="wall_material" value="grass_bamboo" class="tracking-input">
                            <span class="choice-pill" data-localize="q5_opt_1">ઘાસ/વાંસ</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="wall_material" value="plastic" class="tracking-input">
                            <span class="choice-pill" data-localize="q5_opt_2">પ્લાસ્ટિક</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="wall_material" value="mud" class="tracking-input">
                            <span class="choice-pill" data-localize="q5_opt_3">માટી</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="wall_material" value="wood" class="tracking-input">
                            <span class="choice-pill" data-localize="q5_opt_4">લાકડું</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="wall_material" value="stone" class="tracking-input">
                            <span class="choice-pill" data-localize="q5_opt_5">પથ્થર</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="wall_material" value="burnt_brick" class="tracking-input">
                            <span class="choice-pill" data-localize="q5_opt_6">પાકી ઈંટ</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="wall_material" value="concrete" class="tracking-input">
                            <span class="choice-pill" data-localize="q5_opt_7">કોંક્રીટ</span>
                        </label>
                    </div>
                </div>

                <!-- 6. Roof Material -->
                <div class="form-group full-width">
                    <label class="form-label">
                        <span class="question-number">6</span>
                        <span data-localize="q6_label">છત:</span>
                    </label>
                    <div class="options-grid">
                        <label class="choice-card">
                            <input type="radio" name="roof_material" value="grass" class="tracking-input">
                            <span class="choice-pill" data-localize="q6_opt_1">ઘાસ</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="roof_material" value="tiles" class="tracking-input">
                            <span class="choice-pill" data-localize="q6_opt_2">નળિયા</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="roof_material" value="metal" class="tracking-input">
                            <span class="choice-pill" data-localize="q6_opt_3">પતરા</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="roof_material" value="stone" class="tracking-input">
                            <span class="choice-pill" data-localize="q6_opt_4">પથ્થર</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="roof_material" value="slate" class="tracking-input">
                            <span class="choice-pill" data-localize="q6_opt_5">સ્લેટ</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="roof_material" value="concrete" class="tracking-input">
                            <span class="choice-pill" data-localize="q6_opt_6">કોંક્રીટ</span>
                        </label>
                    </div>
                </div>

                <!-- 7. Use of House -->
                <div class="form-group full-width">
                    <label class="form-label">
                        <span class="question-number">7</span>
                        <span data-localize="q7_label">ઉપયોગ:</span>
                    </label>
                    <div class="options-grid">
                        <label class="choice-card">
                            <input type="radio" name="house_use" value="residential" class="tracking-input">
                            <span class="choice-pill" data-localize="q7_opt_1">રહેઠાણ</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="house_use" value="residential_shop" class="tracking-input">
                            <span class="choice-pill" data-localize="q7_opt_2">રહેઠાણ + દુકાન</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="house_use" value="school" class="tracking-input">
                            <span class="choice-pill" data-localize="q7_opt_3">શાળા</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="house_use" value="other" class="tracking-input">
                            <span class="choice-pill" data-localize="q7_opt_4">અન્ય</span>
                        </label>
                    </div>
                </div>

                <!-- 8. Condition -->
                <div class="form-group full-width">
                    <label class="form-label">
                        <span class="question-number">8</span>
                        <span data-localize="q8_label">સ્થિતિ:</span>
                    </label>
                    <div class="options-grid">
                        <label class="choice-card">
                            <input type="radio" name="house_condition" value="good" class="tracking-input">
                            <span class="choice-pill" data-localize="q8_opt_1">સારી</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="house_condition" value="livable" class="tracking-input">
                            <span class="choice-pill" data-localize="q8_opt_2">રહેવાલાયક</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="house_condition" value="dilapidated" class="tracking-input">
                            <span class="choice-pill" data-localize="q8_opt_3">ખંડેર</span>
                        </label>
                    </div>
                </div>

                <!-- 14. Ownership -->
                <div class="form-group full-width">
                    <label class="form-label">
                        <span class="question-number">14</span>
                        <span data-localize="q14_label">માલિકી:</span>
                    </label>
                    <div class="options-grid">
                        <label class="choice-card">
                            <input type="radio" name="ownership" value="owned" class="tracking-input">
                            <span class="choice-pill" data-localize="q14_opt_1">પોતાનું</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="ownership" value="rented_other" class="tracking-input">
                            <span class="choice-pill" data-localize="q14_opt_2">ભાડાનું (બીજે છે)</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="ownership" value="rented_none" class="tracking-input">
                            <span class="choice-pill" data-localize="q14_opt_3">ભાડાનું (નથી)</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="ownership" value="other" class="tracking-input">
                            <span class="choice-pill" data-localize="q14_opt_4">અન્ય</span>
                        </label>
                    </div>
                </div>

                <!-- 15. Rooms -->
                <div class="form-group half-width">
                    <label class="form-label" for="q15">
                        <span class="question-number">15</span>
                        <span data-localize="q15_label">ઓરડા:</span>
                    </label>
                    <input type="number" id="q15" name="dwelling_rooms" class="form-input tracking-input" placeholder="e.g. 3">
                </div>

                <!-- 17. Drinking Water Source -->
                <div class="form-group full-width">
                    <label class="form-label">
                        <span class="question-number">17</span>
                        <span data-localize="q17_label">પાણી (પીવાના પાણીનો સ્ત્રોત):</span>
                    </label>
                    <div class="options-grid">
                        <label class="choice-card">
                            <input type="radio" name="drinking_water" value="tap_treated" class="tracking-input">
                            <span class="choice-pill" data-localize="q17_opt_1">નળ(શુદ્ધ)</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="drinking_water" value="tap_untreated" class="tracking-input">
                            <span class="choice-pill" data-localize="q17_opt_2">નળ(અશુદ્ધ)</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="drinking_water" value="handpump" class="tracking-input">
                            <span class="choice-pill" data-localize="q17_opt_3">ડંકી</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="drinking_water" value="borewell" class="tracking-input">
                            <span class="choice-pill" data-localize="q17_opt_4">બોર</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="drinking_water" value="river_pond" class="tracking-input">
                            <span class="choice-pill" data-localize="q17_opt_5">નદી/તળાવ</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="drinking_water" value="bottled" class="tracking-input">
                            <span class="choice-pill" data-localize="q17_opt_6">બોટલ</span>
                        </label>
                    </div>
                </div>

                <!-- 18. Water Availability -->
                <div class="form-group full-width">
                    <label class="form-label">
                        <span class="question-number">18</span>
                        <span data-localize="q18_label">ઉપલબ્ધતા (પાણીનો સ્ત્રોત ક્યાં છે):</span>
                    </label>
                    <div class="options-grid">
                        <label class="choice-card">
                            <input type="radio" name="water_availability" value="premises" class="tracking-input">
                            <span class="choice-pill" data-localize="q18_opt_1">પરિસરમાં</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="water_availability" value="near" class="tracking-input">
                            <span class="choice-pill" data-localize="q18_opt_2">નજીક</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="water_availability" value="away" class="tracking-input">
                            <span class="choice-pill" data-localize="q18_opt_3">દૂર</span>
                        </label>
                    </div>
                </div>

                <!-- 19. Lighting Source -->
                <div class="form-group full-width">
                    <label class="form-label">
                        <span class="question-number">19</span>
                        <span data-localize="q19_label">પ્રકાશ (પ્રકાશનો મુખ્ય સ્ત્રોત):</span>
                    </label>
                    <div class="options-grid">
                        <label class="choice-card">
                            <input type="radio" name="lighting_source" value="electricity" class="tracking-input">
                            <span class="choice-pill" data-localize="q19_opt_1">વીજળી</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="lighting_source" value="kerosene" class="tracking-input">
                            <span class="choice-pill" data-localize="q19_opt_2">કેરોસીન</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="lighting_source" value="solar" class="tracking-input">
                            <span class="choice-pill" data-localize="q19_opt_3">સૌર</span>
                        </label>
                    </div>
                </div>

                <!-- 20. Latrine Facility -->
                <div class="form-group full-width">
                    <label class="form-label">
                        <span class="question-number">20</span>
                        <span data-localize="q20_label">શૌચાલય (ઘરમાં શૌચાલયની સગવડ):</span>
                    </label>
                    <div class="options-grid">
                        <label class="choice-card">
                            <input type="radio" name="latrine_facility" value="private" class="tracking-input">
                            <span class="choice-pill" data-localize="q20_opt_1">ખાસ</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="latrine_facility" value="shared" class="tracking-input">
                            <span class="choice-pill" data-localize="q20_opt_2">વહેંચાયેલ</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="latrine_facility" value="open" class="tracking-input">
                            <span class="choice-pill" data-localize="q20_opt_3">ખુલ્લામાં</span>
                        </label>
                    </div>
                </div>

                <!-- 21. Type of Latrine -->
                <div class="form-group half-width">
                    <label class="form-label" for="q21">
                        <span class="question-number">21</span>
                        <span data-localize="q21_label">પ્રકાર (શૌચાલયનો પ્રકાર):</span>
                    </label>
                    <input type="text" id="q21" name="latrine_type" class="form-input tracking-input" placeholder="e.g. Flush/Pit">
                </div>

                <!-- 22. Waste Water Disposal -->
                <div class="form-group full-width">
                    <label class="form-label">
                        <span class="question-number">22</span>
                        <span data-localize="q22_label">નિકાલ (ગંદા પાણીનો નિકાલ):</span>
                    </label>
                    <div class="options-grid">
                        <label class="choice-card">
                            <input type="radio" name="drainage_system" value="sewer" class="tracking-input">
                            <span class="choice-pill" data-localize="q22_opt_1">ગટર</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="drainage_system" value="septic" class="tracking-input">
                            <span class="choice-pill" data-localize="q22_opt_2">સેપ્ટિક</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="drainage_system" value="pit" class="tracking-input">
                            <span class="choice-pill" data-localize="q22_opt_3">ખાડો</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="drainage_system" value="closed_drain" class="tracking-input">
                            <span class="choice-pill" data-localize="q22_opt_4">બંધ</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="drainage_system" value="open_drain" class="tracking-input">
                            <span class="choice-pill" data-localize="q22_opt_5">ખુલ્લી</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="drainage_system" value="none" class="tracking-input">
                            <span class="choice-pill" data-localize="q22_opt_6">નથી</span>
                        </label>
                    </div>
                </div>

                <!-- 23. Bathing Facility -->
                <div class="form-group half-width">
                    <label class="form-label">
                        <span class="question-number">23</span>
                        <span data-localize="q23_label">સ્નાનગૃહ:</span>
                    </label>
                    <div class="options-grid">
                        <label class="choice-card">
                            <input type="radio" name="bathroom_facility" value="yes" class="tracking-input">
                            <span class="choice-pill" data-localize="yes">હા</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="bathroom_facility" value="no" class="tracking-input">
                            <span class="choice-pill" data-localize="no">ના</span>
                        </label>
                    </div>
                </div>

                <!-- 24. Kitchen Facility -->
                <div class="form-group half-width">
                    <label class="form-label">
                        <span class="question-number">24</span>
                        <span data-localize="q24_label">રસોડું:</span>
                    </label>
                    <div class="options-grid">
                        <label class="choice-card">
                            <input type="radio" name="kitchen_facility" value="yes" class="tracking-input">
                            <span class="choice-pill" data-localize="yes">હા</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="kitchen_facility" value="no" class="tracking-input">
                            <span class="choice-pill" data-localize="no">ના</span>
                        </label>
                    </div>
                </div>

                <!-- 25. Cooking Fuel -->
                <div class="form-group full-width">
                    <label class="form-label">
                        <span class="question-number">25</span>
                        <span data-localize="q25_label">બળતણ / ઈંધણ:</span>
                    </label>
                    <div class="options-grid">
                        <label class="choice-card">
                            <input type="radio" name="cooking_fuel" value="firewood" class="tracking-input">
                            <span class="choice-pill" data-localize="q25_opt_1">લાકડું</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="cooking_fuel" value="cowdung" class="tracking-input">
                            <span class="choice-pill" data-localize="q25_opt_2">છાણા</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="cooking_fuel" value="lpg_png" class="tracking-input">
                            <span class="choice-pill" data-localize="q25_opt_3">LPG/PNG</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="cooking_fuel" value="solar" class="tracking-input">
                            <span class="choice-pill" data-localize="q25_opt_4">સૌર</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION 3: Household Members & Demographics -->
        <div class="section-card">
            <div class="section-header">
                <div class="section-number">3</div>
                <div class="section-title" data-localize="sec_3_title">કુટુંબના સભ્યો અને વસ્તી વિષયક (Demographics)</div>
            </div>
            <div class="form-grid">
                <!-- 11. Head of Household -->
                <div class="form-group full-width">
                    <label class="form-label" for="q11">
                        <span class="question-number">11</span>
                        <span data-localize="q11_label">મુખ્ય માણસ (કુટુંબના વડાનું નામ):</span>
                    </label>
                    <input type="text" id="q11" name="head_name" class="form-input tracking-input" placeholder="e.g. Rameshbhai Patel">
                </div>

                <!-- 12. Gender of Head -->
                <div class="form-group full-width">
                    <label class="form-label">
                        <span class="question-number">12</span>
                        <span data-localize="q12_label">જાતિ (મુખ્ય માણસની જાતિ):</span>
                    </label>
                    <div class="options-grid">
                        <label class="choice-card">
                            <input type="radio" name="head_gender" value="male" class="tracking-input">
                            <span class="choice-pill" data-localize="q12_opt_1">પુરુષ</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="head_gender" value="female" class="tracking-input">
                            <span class="choice-pill" data-localize="q12_opt_2">સ્ત્રી</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="head_gender" value="trans" class="tracking-input">
                            <span class="choice-pill" data-localize="q12_opt_3">ટ્રાન્સ</span>
                        </label>
                    </div>
                </div>

                <!-- 13. Social Category / Caste Detail -->
                <div class="form-group full-width">
                    <label class="form-label">
                        <span class="question-number">13</span>
                        <span data-localize="q13_label">જાતિ વિગત (સામાજિક વર્ગીકરણ):</span>
                    </label>
                    <div class="options-grid">
                        <label class="choice-card">
                            <input type="radio" name="social_category" value="sc" class="tracking-input">
                            <span class="choice-pill">SC</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="social_category" value="st" class="tracking-input">
                            <span class="choice-pill">ST</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="social_category" value="other" class="tracking-input">
                            <span class="choice-pill" data-localize="other">અન્ય</span>
                        </label>
                    </div>
                </div>

                <!-- 10. Total Persons -->
                <div class="form-group half-width">
                    <label class="form-label" for="q10">
                        <span class="question-number">10</span>
                        <span data-localize="q10_label">વ્યક્તિ (સભ્યોની સંખ્યા):</span>
                    </label>
                    <input type="number" id="q10" name="total_members" class="form-input tracking-input" placeholder="e.g. 5">
                </div>

                <!-- 16. Married Couples -->
                <div class="form-group half-width">
                    <label class="form-label" for="q16">
                        <span class="question-number">16</span>
                        <span data-localize="q16_label">દંપતિ (પરિણીત યુગલોની સંખ્યા):</span>
                    </label>
                    <input type="number" id="q16" name="married_couples" class="form-input tracking-input" placeholder="e.g. 1">
                </div>
            </div>
        </div>

        <!-- SECTION 4: Assets & Connectivity -->
        <div class="section-card">
            <div class="section-header">
                <div class="section-number">4</div>
                <div class="section-title" data-localize="sec_4_title">ઘરગથ્થુ અસ્કયામતો અને કનેક્ટિવિટી (Assets & Connectivity)</div>
            </div>
            <div class="form-grid">
                <!-- 26. Radio -->
                <div class="form-group half-width">
                    <label class="form-label">
                        <span class="question-number">26</span>
                        <span data-localize="q26_label">રેડિયો:</span>
                    </label>
                    <div class="options-grid">
                        <label class="choice-card">
                            <input type="radio" name="has_radio" value="yes" class="tracking-input">
                            <span class="choice-pill" data-localize="yes">હા</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="has_radio" value="no" class="tracking-input">
                            <span class="choice-pill" data-localize="no">ના</span>
                        </label>
                    </div>
                </div>

                <!-- 27. TV -->
                <div class="form-group half-width">
                    <label class="form-label">
                        <span class="question-number">27</span>
                        <span data-localize="q27_label">ટીવી:</span>
                    </label>
                    <div class="options-grid">
                        <label class="choice-card">
                            <input type="radio" name="has_tv" value="yes" class="tracking-input">
                            <span class="choice-pill" data-localize="yes">હા</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="has_tv" value="no" class="tracking-input">
                            <span class="choice-pill" data-localize="no">ના</span>
                        </label>
                    </div>
                </div>

                <!-- 28. Internet -->
                <div class="form-group half-width">
                    <label class="form-label">
                        <span class="question-number">28</span>
                        <span data-localize="q28_label">નેટ:</span>
                    </label>
                    <div class="options-grid">
                        <label class="choice-card">
                            <input type="radio" name="has_internet" value="yes" class="tracking-input">
                            <span class="choice-pill" data-localize="yes">હા</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="has_internet" value="no" class="tracking-input">
                            <span class="choice-pill" data-localize="no">ના</span>
                        </label>
                    </div>
                </div>

                <!-- 29. PC -->
                <div class="form-group half-width">
                    <label class="form-label">
                        <span class="question-number">29</span>
                        <span data-localize="q29_label">PC (કમ્પ્યુટર/લેપટોપ):</span>
                    </label>
                    <div class="options-grid">
                        <label class="choice-card">
                            <input type="radio" name="has_pc" value="yes" class="tracking-input">
                            <span class="choice-pill" data-localize="yes">હા</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="has_pc" value="no" class="tracking-input">
                            <span class="choice-pill" data-localize="no">ના</span>
                        </label>
                    </div>
                </div>

                <!-- 30. Phone Type -->
                <div class="form-group full-width">
                    <label class="form-label">
                        <span class="question-number">30</span>
                        <span data-localize="q30_label">ફોન:</span>
                    </label>
                    <div class="options-grid">
                        <label class="choice-card">
                            <input type="radio" name="phone_type" value="smartphone" class="tracking-input">
                            <span class="choice-pill" data-localize="q30_opt_1">સ્માર્ટફોન</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="phone_type" value="featurephone" class="tracking-input">
                            <span class="choice-pill" data-localize="q30_opt_2">સામાન્ય</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="phone_type" value="both" class="tracking-input">
                            <span class="choice-pill" data-localize="q30_opt_3">બંને</span>
                        </label>
                    </div>
                </div>

                <!-- 31. Two Wheeler / Bicycle -->
                <div class="form-group full-width">
                    <label class="form-label">
                        <span class="question-number">31</span>
                        <span data-localize="q31_label">વાહન (સાયકલ / બાઈક):</span>
                    </label>
                    <div class="options-grid">
                        <label class="choice-card">
                            <input type="checkbox" name="vehicles[]" value="bicycle" class="tracking-input">
                            <span class="choice-pill" data-localize="q31_opt_1">સાયકલ</span>
                        </label>
                        <label class="choice-card">
                            <input type="checkbox" name="vehicles[]" value="motorcycle" class="tracking-input">
                            <span class="choice-pill" data-localize="q31_opt_2">બાઈક</span>
                        </label>
                    </div>
                </div>

                <!-- 32. Car/Jeep/Van -->
                <div class="form-group half-width">
                    <label class="form-label">
                        <span class="question-number">32</span>
                        <span data-localize="q32_label">કાર (કાર/જીપ/વેન):</span>
                    </label>
                    <div class="options-grid">
                        <label class="choice-card">
                            <input type="radio" name="has_car" value="yes" class="tracking-input">
                            <span class="choice-pill" data-localize="yes">હા</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="has_car" value="no" class="tracking-input">
                            <span class="choice-pill" data-localize="no">ના</span>
                        </label>
                    </div>
                </div>

                <!-- 33. Main Cereal -->
                <div class="form-group half-width">
                    <label class="form-label">
                        <span class="question-number">33</span>
                        <span data-localize="q33_label">અનાજ (મુખ્ય ખોરાક):</span>
                    </label>
                    <div class="options-grid">
                        <label class="choice-card">
                            <input type="radio" name="main_cereal" value="wheat" class="tracking-input">
                            <span class="choice-pill" data-localize="q33_opt_1">ઘૌં</span>
                        </label>
                        <label class="choice-card">
                            <input type="radio" name="main_cereal" value="millet" class="tracking-input">
                            <span class="choice-pill" data-localize="q33_opt_2">બાજરી</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Panel -->
        <div class="submit-section">
            <button type="submit" class="submit-btn">
                <span data-localize="submit_button">માહિતી સબમિટ કરો</span>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </button>
        </div>
    </form>
</div>

<script>
    // Theme Engine Setup
    const themeButtons = document.querySelectorAll('#theme-switcher button');
    
    function setTheme(theme) {
        themeButtons.forEach(btn => btn.classList.remove('active'));
        const activeBtn = document.querySelector(`[data-theme-val="${theme}"]`);
        if (activeBtn) activeBtn.classList.add('active');
        document.documentElement.setAttribute('data-theme', theme);
        localStorage.setItem('user-theme', theme);
    }

    const savedTheme = localStorage.getItem('user-theme') || 'dark';
    setTheme(savedTheme);

    themeButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            setTheme(btn.getAttribute('data-theme-val'));
        });
    });

    // House / Shop Switcher Setup
    const modeButtons = document.querySelectorAll('#mode-switcher button');
    let currentMode = localStorage.getItem('user-mode') || 'house';

    function setMode(mode) {
        currentMode = mode;
        localStorage.setItem('user-mode', mode);
        modeButtons.forEach(btn => {
            btn.classList.remove('active');
            if (btn.getAttribute('data-mode') === mode) {
                btn.classList.add('active');
            }
        });
        // At this moment all fields remain displayed as requested.
    }

    modeButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            setMode(btn.getAttribute('data-mode'));
        });
    });

    setMode(currentMode);

    // Multilingual Localization System
    const localization = {
        gu: {
            portal_title: "વસ્તી ગણતરી પોર્ટલ",
            form_title: "વસ્તી ગણતરી માટેના ૩૪ પ્રશ્નોની યાદી",
            form_desc: "રાષ્ટ્રીય જનગણના પત્રક પૂર્ણ કરવા માટે નીચે આપેલ તમામ ૩૪ પ્રશ્નોના જવાબો ચોકસાઈપૂર્વક ભરો.",
            completion_progress: "ફોર્મ ભરવાની પ્રગતિ",
            sec_1_title: "વહીવટી વિગતો (Administrative Details)",
            sec_2_title: "મકાન અને સુવિધાઓની વિગતો (Housing & Facilities)",
            sec_3_title: "કુટુંબના સભ્યો અને વસ્તી વિષયક (Demographics)",
            sec_4_title: "ઘરગથ્થુ અસ્કયામતો અને કનેક્ટિવિટી (Assets & Connectivity)",
            
            yes: "હા",
            no: "ના",
            other: "અન્ય",
            submit_button: "માહિતી સબમિટ કરો",
            submit_success: "વસ્તી ગણતરી ફોર્મ સફળતાપૂર્વક સબમિટ કરવામાં આવ્યું છે!",

            mode_house: "મકાન (House)",
            mode_shop: "દુકાન (Shop)",

            q1_label: "લીટી નં:",
            q2_label: "મકાન નં:",
            q3_label: "જન ગણના ઘર નં:",
            q4_label: "ભોંયતળિયું:",
            q4_opt_1: "માટી",
            q4_opt_2: "લાકડું",
            q4_opt_3: "પથ્થર",
            q4_opt_4: "સિમેન્ટ",
            q4_opt_5: "ટાઈલ્સ",

            q5_label: "દિવાલ:",
            q5_opt_1: "ઘાસ/વાંસ",
            q5_opt_2: "પ્લાસ્ટિક",
            q5_opt_3: "માટી",
            q5_opt_4: "લાકડું",
            q5_opt_5: "પથ્થર",
            q5_opt_6: "પાકી ઈંટ",
            q5_opt_7: "કોંક્રીટ",

            q6_label: "છત:",
            q6_opt_1: "ઘાસ",
            q6_opt_2: "નળિયા",
            q6_opt_3: "પતરા",
            q6_opt_4: "પથ્થર",
            q6_opt_5: "સ્લેટ",
            q6_opt_6: "કોંક્રીટ",

            q7_label: "ઉપયોગ:",
            q7_opt_1: "રહેઠાણ",
            q7_opt_2: "રહેઠાણ + દુકાન",
            q7_opt_3: "શાળા",
            q7_opt_4: "અન્ય",

            q8_label: "સ્થિતિ:",
            q8_opt_1: "સારી",
            q8_opt_2: "રહેવાલાયક",
            q8_opt_3: "ખંડેર",

            q9_label: "કુટુંબ નં:",
            q10_label: "વ્યક્તિ (સભ્યોની સંખ્યા):",
            q11_label: "મુખ્ય માણસનું નામ:",
            
            q12_label: "જાતિ:",
            q12_opt_1: "પુરુષ",
            q12_opt_2: "સ્ત્રી",
            q12_opt_3: "ટ્રાન્સ",

            q13_label: "જાતિ વિગત:",
            
            q14_label: "માલિકી:",
            q14_opt_1: "પોતાનું",
            q14_opt_2: "ભાડાનું (બીજે છે)",
            q14_opt_3: "ભાડાનું (નથી)",
            q14_opt_4: "અન્ય",

            q15_label: "ઓરડા:",
            q16_label: "દંપતિ:",
            
            q17_label: "પાણી (સ્ત્રોત):",
            q17_opt_1: "નળ(શુદ્ધ)",
            q17_opt_2: "નળ(અશુદ્ધ)",
            q17_opt_3: "ડંકી",
            q17_opt_4: "બોર",
            q17_opt_5: "નદી/તળાવ",
            q17_opt_6: "બોટલ",

            q18_label: "ઉપલબ્ધતા:",
            q18_opt_1: "પરિસરમાં",
            q18_opt_2: "નજીક",
            q18_opt_3: "દૂર",

            q19_label: "પ્રકાશ:",
            q19_opt_1: "વીજળી",
            q19_opt_2: "કેરોસીન",
            q19_opt_3: "સૌર",

            q20_label: "શૌચાલય:",
            q20_opt_1: "ખાસ",
            q20_opt_2: "વહેંચાયેલ",
            q20_opt_3: "ખુલ્લામાં",

            q21_label: "પ્રકાર:",
            
            q22_label: "નિકાલ:",
            q22_opt_1: "ગટર",
            q22_opt_2: "સેપ્ટિક",
            q22_opt_3: "ખાડો",
            q22_opt_4: "બંધ",
            q22_opt_5: "ખુલ્લી",
            q22_opt_6: "નથી",

            q23_label: "સ્નાનગૃહ:",
            q24_label: "રસોડું:",
            
            q25_label: "બળતણ / ઈંધણ:",
            q25_opt_1: "લાકડું",
            q25_opt_2: "છાણા",
            q25_opt_3: "LPG/PNG",
            q25_opt_4: "સૌર",

            q26_label: "રેડિયો:",
            q27_label: "ટીવી:",
            q28_label: "નેટ:",
            q29_label: "PC:",
            
            q30_label: "ફોન (મોબાઈલ):",
            q30_opt_1: "સ્માર્ટફોન",
            q30_opt_2: "સામાન્ય",
            q30_opt_3: "બંને",

            q31_label: "વાહન:",
            q31_opt_1: "સાયકલ",
            q31_opt_2: "બાઈક",

            q32_label: "કાર (ફોર વ્હીલર):",
            
            q33_label: "અનાજ:",
            q33_opt_1: "ઘઉં",
            q33_opt_2: "બાજરી",

            q34_label: "મો.નં:"
        },
        hi: {
            portal_title: "जनगणना पोर्टल",
            form_title: "जनगणना के लिए ३४ प्रश्नों की सूची",
            form_desc: "राष्ट्रीय जनगणना प्रपत्र को पूरा करने के लिए नीचे दिए गए सभी ३४ प्रश्नों के उत्तर ध्यानपूर्वक भरें।",
            completion_progress: "फॉर्म भरने की प्रगति",
            sec_1_title: "प्रशासनिक विवरण (Administrative Details)",
            sec_2_title: "आवास और सुविधाएं (Housing & Facilities)",
            sec_3_title: "परिवार के सदस्य और जनसांख्यिकी (Demographics)",
            sec_4_title: "घरेलू संपत्ति और कनेक्टिविटी (Assets & Connectivity)",
            
            yes: "हाँ",
            no: "नहीं",
            other: "अन्य",
            submit_button: "डेटा जमा करें",
            submit_success: "जनगणना फॉर्म सफलतापूर्वक जमा कर दिया गया है!",

            mode_house: "मकान (House)",
            mode_shop: "दुकान (Shop)",

            q1_label: "पंक्ति संख्या:",
            q2_label: "मकान संख्या:",
            q3_label: "जनगणना मकान संख्या:",
            q4_label: "फर्श सामग्री:",
            q4_opt_1: "मिट्टी",
            q4_opt_2: "लकड़ी",
            q4_opt_3: "पत्थर",
            q4_opt_4: "सीमेंट",
            q4_opt_5: "टाइल्स",

            q5_label: "दीवार:",
            q5_opt_1: "घास/बांस",
            q5_opt_2: "प्लास्टिक",
            q5_opt_3: "मिट्टी",
            q5_opt_4: "लकड़ी",
            q5_opt_5: "पत्थर",
            q5_opt_6: "पक्की ईंट",
            q5_opt_7: "कंक्रीट",

            q6_label: "छत:",
            q6_opt_1: "घास",
            q6_opt_2: "खपरैल",
            q6_opt_3: "टीन शेड",
            q6_opt_4: "पत्थर",
            q6_opt_5: "स्लेट",
            q6_opt_6: "कंक्रीट",

            q7_label: "उपयोग:",
            q7_opt_1: "आवास",
            q7_opt_2: "आवास + दुकान",
            q7_opt_3: "स्कूल",
            q7_opt_4: "अन्य",

            q8_label: "स्थिति:",
            q8_opt_1: "अच्छी",
            q8_opt_2: "रहने योग्य",
            q8_opt_3: "जर्जर",

            q9_label: "परिवार संख्या:",
            q10_label: "कुल व्यक्ति (सदस्य):",
            q11_label: "मुखिया का नाम:",
            
            q12_label: "लिंग:",
            q12_opt_1: "पुरुष",
            q12_opt_2: "महिला",
            q12_opt_3: "ट्रांसजेंडर",

            q13_label: "सामाजिक श्रेणी:",
            
            q14_label: "स्वामित्व:",
            q14_opt_1: "खुद का",
            q14_opt_2: "किराए का (अन्य जगह)",
            q14_opt_3: "किराए का (नहीं है)",
            q14_opt_4: "अन्य",

            q15_label: "कमरों की संख्या:",
            q16_label: "विवाहित जोड़े:",
            
            q17_label: "पेयजल का स्रोत:",
            q17_opt_1: "नल (उपचारित)",
            q17_opt_2: "नल (अनुपचारित)",
            q17_opt_3: "हैंडपंप",
            q17_opt_4: "बोरवेल",
            q17_opt_5: "नदी/तालाब",
            q17_opt_6: "बोतल बंद",

            q18_label: "उपलब्धता:",
            q18_opt_1: "परिसर के भीतर",
            q18_opt_2: "पास में",
            q18_opt_3: "दूर",

            q19_label: "रोशनी का स्रोत:",
            q19_opt_1: "बिजली",
            q19_opt_2: "केरोसिन",
            q19_opt_3: "सौर ऊर्जा",

            q20_label: "शौचालय की सुविधा:",
            q20_opt_1: "निजी",
            q20_opt_2: "साझा",
            q20_opt_3: "खुले में",

            q21_label: "शौचालय प्रकार:",
            
            q22_label: "अपशिष्ट जल निकासी:",
            q22_opt_1: "सीवर",
            q22_opt_2: "सेप्टिक",
            q22_opt_3: "गड्ढा",
            q22_opt_4: "बंद नाली",
            q22_opt_5: "खुली नाली",
            q22_opt_6: "कोई नहीं",

            q23_label: "स्नानगृह:",
            q24_label: "रसोई की सुविधा:",
            
            q25_label: "रसोई ईंधन:",
            q25_opt_1: "लकड़ी",
            q25_opt_2: "कंडा/उपले",
            q25_opt_3: "एलपीजी/पीएनजी",
            q25_opt_4: "सौर",

            q26_label: "रेडियो:",
            q27_label: "टीवी:",
            q28_label: "इंटरनेट:",
            q29_label: "कम्प्यूटर:",
            
            q30_label: "टेलीफोन / मोबाइल:",
            q30_opt_1: "स्मार्टफोन",
            q30_opt_2: "साधारण फोन",
            q30_opt_3: "दोनों",

            q31_label: "वाहन:",
            q31_opt_1: "साइकिल",
            q31_opt_2: "बाइक",

            q32_label: "कार / जीप / वैन:",
            
            q33_label: "मुख्य अनाज:",
            q33_opt_1: "गेहूँ",
            q33_opt_2: "बाजरा",

            q34_label: "मोबाइल नंबर:"
        },
        en: {
            portal_title: "Census Portal",
            form_title: "Census List of 34 Questions",
            form_desc: "Please accurately fill out all 34 questions below to complete the national census registration form.",
            completion_progress: "Form Progress",
            sec_1_title: "Administrative Details",
            sec_2_title: "Housing & Facilities",
            sec_3_title: "Demographics",
            sec_4_title: "Assets & Connectivity",
            
            yes: "Yes",
            no: "No",
            other: "Other",
            submit_button: "Submit Information",
            submit_success: "Census form submitted successfully!",

            mode_house: "House",
            mode_shop: "Shop",

            q1_label: "Line No:",
            q2_label: "House No:",
            q3_label: "Census House No:",
            q4_label: "Floor Material:",
            q4_opt_1: "Mud",
            q4_opt_2: "Wood",
            q4_opt_3: "Stone",
            q4_opt_4: "Cement",
            q4_opt_5: "Tiles",

            q5_label: "Wall Material:",
            q5_opt_1: "Grass/Bamboo",
            q5_opt_2: "Plastic",
            q5_opt_3: "Mud",
            q5_opt_4: "Wood",
            q5_opt_5: "Stone",
            q5_opt_6: "Burnt Brick",
            q5_opt_7: "Concrete",

            q6_label: "Roof Material:",
            q6_opt_1: "Grass",
            q6_opt_2: "Tiles",
            q6_opt_3: "Metal Sheets",
            q6_opt_4: "Stone",
            q6_opt_5: "Slate",
            q6_opt_6: "Concrete",

            q7_label: "Use of House:",
            q7_opt_1: "Residential",
            q7_opt_2: "Residence + Shop",
            q7_opt_3: "School",
            q7_opt_4: "Other",

            q8_label: "Condition:",
            q8_opt_1: "Good",
            q8_opt_2: "Livable",
            q8_opt_3: "Dilapidated",

            q9_label: "Household No:",
            q10_label: "Total Persons:",
            q11_label: "Head of Household:",
            
            q12_label: "Gender of Head:",
            q12_opt_1: "Male",
            q12_opt_2: "Female",
            q12_opt_3: "Transgender",

            q13_label: "Social Category:",
            
            q14_label: "Ownership:",
            q14_opt_1: "Owned",
            q14_opt_2: "Rented (elsewhere)",
            q14_opt_3: "Rented (none)",
            q14_opt_4: "Other",

            q15_label: "Dwelling Rooms:",
            q16_label: "Married Couples:",
            
            q17_label: "Drinking Water Source:",
            q17_opt_1: "Tap (Treated)",
            q17_opt_2: "Tap (Untreated)",
            q17_opt_3: "Handpump",
            q17_opt_4: "Tubewell",
            q17_opt_5: "River/Pond",
            q17_opt_6: "Bottled",

            q18_label: "Water Availability:",
            q18_opt_1: "Within premises",
            q18_opt_2: "Near premises",
            q18_opt_3: "Away",

            q19_label: "Lighting Source:",
            q19_opt_1: "Electricity",
            q19_opt_2: "Kerosene",
            q19_opt_3: "Solar",

            q20_label: "Latrine Facility:",
            q20_opt_1: "Private",
            q20_opt_2: "Shared",
            q20_opt_3: "Open/None",

            q21_label: "Type of Latrine:",
            
            q22_label: "Waste Water Disposal:",
            q22_opt_1: "Sewer",
            q22_opt_2: "Septic",
            q22_opt_3: "Pit",
            q22_opt_4: "Closed drain",
            q22_opt_5: "Open drain",
            q22_opt_6: "None",

            q23_label: "Bathing Facility:",
            q24_label: "Kitchen Facility:",
            
            q25_label: "Cooking Fuel:",
            q25_opt_1: "Firewood",
            q25_opt_2: "Cowdung cake",
            q25_opt_3: "LPG/PNG",
            q25_opt_4: "Solar",

            q26_label: "Radio/Transistor:",
            q27_label: "Television:",
            q28_label: "Internet Connection:",
            q29_label: "Computer/Laptop:",
            
            q30_label: "Phone Type:",
            q30_opt_1: "Smartphone",
            q30_opt_2: "Feature Phone",
            q30_opt_3: "Both",

            q31_label: "Vehicle:",
            q31_opt_1: "Bicycle",
            q31_opt_2: "Motorcycle",

            q32_label: "Car/Jeep/Van:",
            
            q33_label: "Main Cereal:",
            q33_opt_1: "Wheat",
            q33_opt_2: "Millet",

            q34_label: "Mobile Number:"
        }
    };

    let currentLang = localStorage.getItem('user-lang') || 'gu';

    function setLanguage(lang) {
        if (!localization[lang]) {
            lang = 'gu';
        }
        currentLang = lang;
        localStorage.setItem('user-lang', lang);
        document.documentElement.setAttribute('lang', lang);
        
        // Active button highlight
        document.querySelectorAll('#lang-switcher button').forEach(btn => {
            btn.classList.remove('active');
            if (btn.getAttribute('data-lang') === lang) {
                btn.classList.add('active');
            }
        });

        // Translate labels/text using data attributes
        document.querySelectorAll('[data-localize]').forEach(el => {
            const key = el.getAttribute('data-localize');
            if (localization[lang] && localization[lang][key]) {
                el.textContent = localization[lang][key];
            }
        });

        // Update placeholder texts dynamically
        const placeholderMapping = {
            q1: 'e.g. 1',
            q2: 'e.g. A-102',
            q3: 'e.g. CH-990',
            q9: 'e.g. 15',
            q10: 'e.g. 5',
            q11: lang === 'en' ? 'e.g. Rameshbhai Patel' : (lang === 'hi' ? 'उदा. रमेशभाई पटेल' : 'દા.ત. રમેશભાઈ પટેલ'),
            q15: 'e.g. 3',
            q16: 'e.g. 1',
            q21: lang === 'en' ? 'e.g. Flush/Pit' : (lang === 'hi' ? 'उदा. फ्लश/गड्ढा' : 'દા.ત. ફ્લશ/ખાડો'),
            q34: 'e.g. 9876543210'
        };

        for (const [id, val] of Object.entries(placeholderMapping)) {
            const inputEl = document.getElementById(id);
            if (inputEl) {
                inputEl.placeholder = val;
            }
        }

        // Translate any active validation messages on-the-fly when changing language
        document.querySelectorAll('.error-message').forEach(errorDiv => {
            const errorKey = errorDiv.getAttribute('data-error-key');
            if (errorKey && localization[lang] && localization[lang][errorKey]) {
                errorDiv.querySelector('.error-text').textContent = localization[lang][errorKey];
            }
        });
    }

    // Initialize switcher events
    document.querySelectorAll('#lang-switcher button').forEach(btn => {
        btn.addEventListener('click', () => {
            setLanguage(btn.getAttribute('data-lang'));
            calculateProgress();
        });
    });

    // Run on startup
    setLanguage(currentLang);

    // Form Completion Progress Engine
    const trackingInputs = document.querySelectorAll('.tracking-input');
    const progressVal = document.getElementById('progress-val');
    const progressIndicator = document.getElementById('progress-indicator');

    function calculateProgress() {
        // We group inputs by name to count radio button groups as single answers
        const uniqueGroups = new Set();
        trackingInputs.forEach(input => {
            uniqueGroups.add(input.name || input.id);
        });

        let answeredCount = 0;
        uniqueGroups.forEach(groupName => {
            if (!groupName) return;
            // Safe selection using DOM APIs to avoid selector parsing errors on brackets
            let inputs = [];
            const byName = document.getElementsByName(groupName);
            if (byName.length > 0) {
                inputs = Array.from(byName);
            } else {
                const byId = document.getElementById(groupName);
                if (byId) inputs = [byId];
            }
            
            let answered = false;
            inputs.forEach(input => {
                if (input.type === 'radio' || input.type === 'checkbox') {
                    if (input.checked) answered = true;
                } else {
                    if (input.value.trim() !== '') answered = true;
                }
            });

            if (answered) answeredCount++;
        });

        const totalQuestions = uniqueGroups.size;
        const percentage = totalQuestions > 0 ? Math.round((answeredCount / totalQuestions) * 100) : 0;
        
        progressVal.textContent = `${percentage}%`;
        progressIndicator.style.width = `${percentage}%`;
    }

    trackingInputs.forEach(input => {
        input.addEventListener('input', calculateProgress);
        input.addEventListener('change', calculateProgress);
    });

    // Run first calculation
    calculateProgress();

    // --- Dynamic Form Validation Engine ---
    function validateField(input) {
        const name = input.name || input.id;
        if (!name) return { isValid: true, errorKey: null };

        // For radio groups, validate the group
        if (input.type === 'radio') {
            const group = document.querySelectorAll(`input[name="${name}"]`);
            const isRequired = Array.from(group).some(i => i.hasAttribute('required'));
            if (isRequired) {
                const checked = Array.from(group).some(i => i.checked);
                if (!checked) return { isValid: false, errorKey: 'error_choice' };
            }
            return { isValid: true, errorKey: null };
        }

        // For checkbox groups
        if (input.type === 'checkbox') {
            if (input.hasAttribute('required')) {
                const group = document.querySelectorAll(`input[name="${input.name}"]`);
                const checked = Array.from(group).some(i => i.checked);
                if (!checked) return { isValid: false, errorKey: 'error_choice' };
            }
            return { isValid: true, errorKey: null };
        }

        // For other inputs (text, number, tel)
        const value = input.value.trim();
        const isRequired = input.hasAttribute('required');

        if (isRequired && value === '') {
            return { isValid: false, errorKey: 'error_required' };
        }

        if (value !== '') {
            if (input.type === 'number') {
                const numVal = Number(value);
                if (isNaN(numVal)) {
                    return { isValid: false, errorKey: 'error_number' };
                }
                if (['q1', 'q9', 'q10', 'q15'].includes(input.id)) {
                    if (numVal <= 0 || !Number.isInteger(numVal)) {
                        return { isValid: false, errorKey: 'error_positive' };
                    }
                }
                if (input.id === 'q16') {
                    if (numVal < 0 || !Number.isInteger(numVal)) {
                        return { isValid: false, errorKey: 'error_non_negative' };
                    }
                    // Cross-field validation: married couples <= total members
                    const totalMembersInput = document.getElementById('q10');
                    if (totalMembersInput && totalMembersInput.value.trim() !== '') {
                        const total = Number(totalMembersInput.value);
                        if (!isNaN(total) && numVal > total) {
                            return { isValid: false, errorKey: 'error_couples' };
                        }
                    }
                }
            }

            if (input.id === 'q34') {
                const phoneRegex = /^[6-9]\d{9}$/;
                if (!phoneRegex.test(value)) {
                    return { isValid: false, errorKey: 'error_mobile' };
                }
            }

            if (input.id === 'q11') {
                const nameRegex = /^[a-zA-Z\s\u0A80-\u0AFF\u0900-\u097F]+$/;
                if (!nameRegex.test(value) || value.length < 2) {
                    return { isValid: false, errorKey: 'error_name' };
                }
            }
        }

        return { isValid: true, errorKey: null };
    }

    function displayError(input, errorKey) {
        const $input = $(input);
        const $group = $input.closest('.form-group');
        if (!$group.length) return;

        // Highlight input field or selection container
        if (input.type === 'radio' || input.type === 'checkbox') {
            const $grid = $group.find('.options-grid');
            if ($grid.length) $grid.addClass('form-input-error');
        } else {
            $input.addClass('form-input-error');
        }

        // Highlight input label
        $group.find('.form-label').addClass('label-error');

        // Add error message text
        let $errorDiv = $group.find('.error-message');
        if (!$errorDiv.length) {
            $errorDiv = $('<div>', { class: 'error-message' }).html(`
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
                <span class="error-text"></span>
            `);
            $group.append($errorDiv);
        }
        
        $errorDiv.attr('data-error-key', errorKey);
        $errorDiv.find('.error-text').text(localization[currentLang][errorKey] || errorKey);
    }

    function clearFieldStyle(input) {
        const $input = $(input);
        const $group = $input.closest('.form-group');
        if (!$group.length) return;

        if (input.type === 'radio' || input.type === 'checkbox') {
            const $grid = $group.find('.options-grid');
            if ($grid.length) $grid.removeClass('form-input-error');
        } else {
            $input.removeClass('form-input-error');
        }

        $group.find('.form-label').removeClass('label-error');
        $group.find('.error-message').remove();
    }

    function runFieldValidation(input) {
        clearFieldStyle(input);
        const res = validateField(input);
        if (!res.isValid) {
            displayError(input, res.errorKey);
            return false;
        }
        
        // If it is q10 (total members), re-evaluate q16 (married couples) cross-field rule
        if (input.id === 'q10') {
            const q16 = document.getElementById('q16');
            if (q16 && q16.value.trim() !== '') {
                const q16Res = validateField(q16);
                if (q16Res.isValid) {
                    clearFieldStyle(q16);
                } else {
                    displayError(q16, q16Res.errorKey);
                }
            }
        }
        return true;
    }

    // Attach listeners for real-time validation feedback using jQuery
    $('.tracking-input').on('input', function() {
        const input = this;
        if ($(input).hasClass('form-input-error') || $(input).closest('.form-group').find('.options-grid').hasClass('form-input-error') || input.type === 'number') {
            runFieldValidation(input);
        }
    }).on('change blur', function() {
        runFieldValidation(this);
    });



    // Form submit interceptor
    const form = document.getElementById('census-form');
    form.addEventListener('submit', (event) => {
        event.preventDefault();
        
        let firstInvalidElement = null;
        let isFormValid = true;

        // Validate all fields
        const processedGroups = new Set();
        trackingInputs.forEach(input => {
            const name = input.name || input.id;
            if (input.type === 'radio' || input.type === 'checkbox') {
                if (processedGroups.has(name)) return;
                processedGroups.add(name);
            }

            const isValid = runFieldValidation(input);
            if (!isValid) {
                isFormValid = false;
                if (!firstInvalidElement) {
                    firstInvalidElement = input;
                }
            }
        });

        if (isFormValid) {
            alert(localization[currentLang].submit_success || 'Submitted successfully!');
        } else if (firstInvalidElement) {
            // Scroll to the first error smoothly
            const group = firstInvalidElement.closest('.form-group');
            if (group) {
                group.scrollIntoView({ behavior: 'smooth', block: 'center' });
                // Focus the element if it's text/number
                if (firstInvalidElement.type !== 'radio' && firstInvalidElement.type !== 'checkbox') {
                    firstInvalidElement.focus({ preventScroll: true });
                }
            }
        }
    });
</script>
</body>
</html>
