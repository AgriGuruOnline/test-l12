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
    <!-- jQuery (local with relative path for reliable loading on any domain) -->
    <script src="/js/jquery.min.js"></script>
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

        .options-grid.form-input-error {
            border: 1.5px solid var(--text-error) !important;
            border-radius: 14px;
            padding: 0.5rem;
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
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
            margin-top: 2.5rem;
            border-top: 1px solid var(--card-border);
            padding-top: 2rem;
            width: 100%;
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
                padding: 1rem 0.75rem;
            }
            .form-grid {
                grid-template-columns: 1fr;
                gap: 1.25rem;
            }
            .half-width,
            .full-width {
                grid-column: span 1;
            }
            .section-card {
                padding: 1.5rem 1.25rem;
                border-radius: 20px;
                gap: 1.5rem;
            }
            .form-header-card {
                padding: 1.75rem 1.25rem;
                border-radius: 20px;
            }
            .form-header-card h1 {
                font-size: 1.6rem;
                letter-spacing: -0.02em;
            }
            .form-header-card p {
                font-size: 0.95rem;
                line-height: 1.5;
            }
            .section-title {
                font-size: 1.1rem;
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
                align-items: center;
                text-align: center;
                padding: 1rem;
            }
            .bar-left {
                justify-content: center;
                width: 100%;
            }
            .bar-right {
                flex-direction: column;
                width: 100%;
                gap: 0.75rem;
            }
            .switcher-group {
                width: 100%;
                justify-content: center;
            }
            .switch-btn {
                flex: 1;
                justify-content: center;
                padding: 8px 10px;
                font-size: 0.75rem;
            }
            .form-input {
                font-size: 16px; /* Prevents auto-zooming on iOS */
                padding: 0.75rem 0.9rem;
            }
            .submit-btn {
                max-width: 100%;
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

        /* Confirmation Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            padding: 1.5rem;
        }

        .modal-overlay.active {
            opacity: 1;
            pointer-events: auto;
        }

        .modal-container {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 24px;
            width: 100%;
            max-width: 680px;
            max-height: 85vh;
            display: flex;
            flex-direction: column;
            box-shadow: var(--card-shadow), 0 24px 60px -15px rgba(0, 0, 0, 0.3);
            transform: translateY(30px) scale(0.95);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
        }

        .modal-overlay.active .modal-container {
            transform: translateY(0) scale(1);
        }

        .modal-header {
            padding: 1.5rem 2rem;
            border-bottom: 1px solid var(--card-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: linear-gradient(180deg, var(--card-bg) 0%, var(--bg-body) 100%);
        }

        .modal-title-area {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
            text-align: left;
        }

        .modal-title {
            font-size: 1.3rem;
            font-weight: 800;
            color: var(--text-title);
            letter-spacing: -0.02em;
            margin: 0;
        }

        .modal-subtitle {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin: 0;
        }

        .modal-close-btn {
            background: transparent;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            padding: 8px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }

        .modal-close-btn:hover {
            background: var(--toggle-bg);
            color: var(--text-title);
        }

        .modal-body {
            padding: 2rem;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 1.75rem;
            max-height: 55vh;
            scrollbar-width: thin;
            scrollbar-color: var(--toggle-border) transparent;
            text-align: left;
        }

        .modal-body::-webkit-scrollbar {
            width: 6px;
        }

        .modal-body::-webkit-scrollbar-thumb {
            background-color: var(--toggle-border);
            border-radius: 99px;
        }

        .summary-part-container {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .summary-section-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--section-num-bg);
            margin-bottom: 0.5rem;
            border-bottom: 1px dashed var(--card-border);
            padding-bottom: 0.4rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0.75rem;
        }

        .summary-item {
            background: var(--input-bg);
            border: 1px solid var(--card-border);
            padding: 0.75rem 1rem;
            border-radius: 12px;
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
            transition: var(--transition);
        }

        .summary-item:hover {
            border-color: var(--pill-active-border);
            background: var(--pill-active-bg);
        }

        .summary-item-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .summary-item-value {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--text-title);
            word-break: break-word;
        }

        .summary-item-empty {
            opacity: 0.65;
            background: hsla(215, 16%, 47%, 0.03);
        }

        .summary-item-empty .summary-item-value {
            font-weight: 400;
            font-style: italic;
            color: var(--text-muted);
        }

        .modal-footer {
            padding: 1.25rem 2rem;
            border-top: 1px solid var(--card-border);
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            background: linear-gradient(0deg, var(--card-bg) 0%, var(--bg-body) 100%);
        }

        .modal-btn {
            padding: 0.75rem 1.75rem;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.95rem;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            border: none;
        }

        .modal-btn-cancel {
            background: var(--toggle-bg);
            color: var(--text-body);
            border: 1px solid var(--toggle-border);
        }

        .modal-btn-cancel:hover {
            background: var(--toggle-active-bg);
            color: var(--text-title);
        }

        .modal-btn-submit {
            background: var(--btn-bg);
            color: var(--btn-text);
            box-shadow: 0 4px 12px hsla(243, 75%, 59%, 0.2);
        }

        .modal-btn-submit:hover {
            background: var(--btn-hover);
            transform: translateY(-1px);
        }

        .modal-btn-submit:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        /* Spinner for Loading State */
        .spinner {
            width: 18px;
            height: 18px;
            border: 2px solid currentColor;
            border-bottom-color: transparent;
            border-radius: 50%;
            display: inline-block;
            box-sizing: border-box;
            animation: rotation 0.6s linear infinite;
        }

        @keyframes rotation {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .input-loader {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            width: 18px;
            height: 18px;
            border: 2px solid var(--pill-active-border);
            border-bottom-color: transparent;
            border-radius: 50%;
            box-sizing: border-box;
            animation: rotation 0.6s linear infinite;
            pointer-events: none;
            z-index: 5;
        }



        /* Premium Toast Styles */
        .toast-container {
            position: fixed;
            top: 2rem;
            right: 2rem;
            z-index: 1100;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            max-width: 420px;
            width: calc(100vw - 4rem);
            pointer-events: none;
        }

        .toast-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 16px;
            padding: 1rem 1.25rem;
            box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.25), var(--card-shadow);
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            position: relative;
            overflow: hidden;
            transform: translateX(120%);
            opacity: 0;
            pointer-events: auto;
            transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.4s ease, margin 0.3s ease;
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            text-align: left;
        }

        .toast-card.show {
            transform: translateX(0);
            opacity: 1;
        }

        .toast-card.hide {
            transform: scale(0.9);
            opacity: 0;
        }

        .toast-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            border-radius: 8px;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .toast-card.success {
            border-left: 4px solid hsl(142, 72%, 29%);
        }
        [data-theme="dark"] .toast-card.success {
            border-left: 4px solid hsl(142, 71%, 45%);
        }
        .toast-card.success .toast-icon {
            color: hsl(142, 72%, 29%);
            background: hsla(142, 72%, 29%, 0.1);
        }
        [data-theme="dark"] .toast-card.success .toast-icon {
            color: hsl(142, 71%, 45%);
            background: hsla(142, 71%, 45%, 0.15);
        }

        .toast-card.error {
            border-left: 4px solid var(--text-error);
        }
        .toast-card.error .toast-icon {
            color: var(--text-error);
            background: hsla(343, 75%, 50%, 0.1);
        }
        [data-theme="dark"] .toast-card.error .toast-icon {
            background: hsla(343, 85%, 65%, 0.15);
        }

        .toast-card.info {
            border-left: 4px solid hsl(200, 80%, 40%);
        }
        .toast-card.info .toast-icon {
            color: hsl(200, 80%, 40%);
            background: hsla(200, 80%, 40%, 0.1);
        }
        [data-theme="dark"] .toast-card.info .toast-icon {
            color: hsl(200, 85%, 60%);
            background: hsla(200, 85%, 60%, 0.15);
        }

        .toast-content {
            display: flex;
            flex-direction: column;
            gap: 0.2rem;
            flex-grow: 1;
        }

        .toast-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--text-title);
        }

        .toast-message {
            font-size: 0.85rem;
            color: var(--text-body);
            line-height: 1.4;
        }

        .toast-close-btn {
            background: transparent;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            padding: 4px;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            margin-top: 2px;
        }

        .toast-close-btn:hover {
            background: var(--toggle-bg);
            color: var(--text-title);
        }

        .toast-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            background: var(--pill-active-border);
            width: 100%;
            transform-origin: left;
        }
        
        .toast-card.success .toast-progress {
            background: hsl(142, 71%, 45%);
        }
        .toast-card.error .toast-progress {
            background: var(--text-error);
        }
        .toast-card.info .toast-progress {
            background: hsl(200, 85%, 60%);
        }

        @media (max-width: 768px) {
            .summary-grid {
                grid-template-columns: 1fr;
            }
            .modal-footer {
                flex-direction: column-reverse;
                padding: 1rem 1.5rem;
            }
            .modal-btn {
                width: 100%;
                justify-content: center;
            }
            .modal-header {
                padding: 1.25rem 1.5rem;
            }
            .modal-body {
                padding: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .toast-container {
                top: 1rem;
                right: 1rem;
                left: 1rem;
                width: calc(100vw - 2rem);
            }
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
            <!-- Download Data Button -->
            <a href="/download-data?lang=gu" class="btn-back" style="text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.55rem 1rem; border-radius: 10px; border: 1px solid var(--card-border); background: var(--card-bg); color: var(--text-body); font-size: 0.85rem; font-weight: 600; cursor: pointer; transition: var(--transition); margin-right: 0.25rem;" id="nav-download-btn">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="color: var(--section-num-bg);"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                <span data-localize="nav_download_data">ડાઉનલોડ કરો</span>
            </a>

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
        <input type="hidden" name="record_id" id="record-id" value="">
        <input type="hidden" name="mode" id="form-mode" value="house">
        
        <!-- Main Form Card -->
        <div class="section-card">
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
                    <div style="position: relative; width: 100%;">
                        <input type="text" id="q2" name="house_no" class="form-input tracking-input" placeholder="e.g. A-102" style="padding-right: 2.5rem;">
                        <div id="house-loader" class="input-loader" style="display: none;"></div>
                    </div>
                </div>

                <!-- 3. Census House No -->
                <div class="form-group half-width">
                    <label class="form-label" for="q3">
                        <span class="question-number">3</span>
                        <span data-localize="q3_label">જન ગણના ઘર નં:</span>
                    </label>
                    <input type="text" id="q3" name="census_house_no" class="form-input tracking-input" placeholder="e.g. CH-990">
                </div>

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

                <!-- 9. Household No -->
                <div class="form-group half-width">
                    <label class="form-label" for="q9">
                        <span class="question-number">9</span>
                        <span data-localize="q9_label">કુટુંબ નં:</span>
                    </label>
                    <input type="number" id="q9" name="household_no" class="form-input tracking-input" placeholder="e.g. 15">
                </div>

                <!-- 10. Total Persons -->
                <div class="form-group half-width">
                    <label class="form-label" for="q10">
                        <span class="question-number">10</span>
                        <span data-localize="q10_label">વ્યક્તિ (સભ્યોની સંખ્યા):</span>
                    </label>
                    <input type="number" id="q10" name="total_members" class="form-input tracking-input" placeholder="e.g. 5">
                </div>

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

                <!-- 16. Married Couples -->
                <div class="form-group half-width">
                    <label class="form-label" for="q16">
                        <span class="question-number">16</span>
                        <span data-localize="q16_label">દંપતિ (પરિણીત યુગલોની સંખ્યા):</span>
                    </label>
                    <input type="number" id="q16" name="married_couples" class="form-input tracking-input" placeholder="e.g. 1">
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

                <!-- 34. Mobile No -->
                <div class="form-group full-width">
                    <label class="form-label" for="q34">
                        <span class="question-number">34</span>
                        <span data-localize="q34_label">મો.નં:</span>
                    </label>
                    <input type="tel" id="q34" name="mobile_no" class="form-input tracking-input" placeholder="e.g. 9876543210" maxlength="10" inputmode="numeric">
                </div>
            </div>

            <!-- Submit Panel -->
            <div class="submit-section">
                <button type="submit" class="submit-btn">
                    <span data-localize="submit_button">માહિતી સબમિટ કરો</span>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </button>
            </div>
        </div>
    </form>
</div>

<!-- Confirmation Modal Overlay -->
<div id="confirm-modal-overlay" class="modal-overlay">
    <div class="modal-container">
        <div class="modal-header">
            <div class="modal-title-area">
                <h2 class="modal-title" data-localize="modal_title">માહિતીની ચકાસણી કરો (Review Details)</h2>
                <p class="modal-subtitle" data-localize="modal_subtitle">કૃપા કરીને સબમિટ કરતા પહેલા તમારી વિગતો ચકાસો.</p>
            </div>
            <button type="button" class="modal-close-btn" id="modal-close-btn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>
        <div class="modal-body" id="modal-summary-body">
            <!-- Summary will be dynamically rendered here -->
        </div>
        <div class="modal-footer">
            <button type="button" class="modal-btn modal-btn-cancel" id="modal-cancel-btn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                <span data-localize="modal_btn_edit">સુધારો કરો (Edit)</span>
            </button>
            <button type="button" class="modal-btn modal-btn-submit" id="modal-submit-btn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                <span data-localize="modal_btn_confirm">સબમિટ કરો (Confirm Submit)</span>
            </button>
        </div>
    </div>
</div>

<!-- Toast Container -->
<div id="toast-container" class="toast-container"></div>



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

    function setMode(mode, triggerSearch = true) {
        currentMode = mode;
        localStorage.setItem('user-mode', mode);
        
        // Sync the hidden mode input
        const modeInput = document.getElementById('form-mode');
        if (modeInput) {
            modeInput.value = mode;
        }

        modeButtons.forEach(btn => {
            btn.classList.remove('active');
            if (btn.getAttribute('data-mode') === mode) {
                btn.classList.add('active');
            }
        });
        
        if (!triggerSearch && typeof lastSearchedMode !== 'undefined') {
            lastSearchedMode = mode;
        }

        // At this moment all fields remain displayed as requested.
        if (triggerSearch && typeof checkHouseRecord === 'function') {
            checkHouseRecord();
        }
    }

    modeButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            setMode(btn.getAttribute('data-mode'), true);
        });
    });

    // setMode call is moved to the bottom of the script to prevent hoisting Temporal Dead Zone issues

    // Multilingual Localization System
    const localization = {
        gu: {
            portal_title: "વસ્તી ગણતરી પોર્ટલ",
            loader_title: "માહિતી ચકાસી રહ્યા છીએ...",
            loader_subtitle: "કૃપા કરીને થોડી રાહ જુઓ, ડેટા લોડ થઈ રહ્યો છે.",
            form_title: "વસ્તી ગણતરી માટેના ૩૪ પ્રશ્નોની યાદી",
            form_desc: "રાષ્ટ્રીય જનગણના પત્રક પૂર્ણ કરવા માટે નીચે આપેલ તમામ ૩૪ પ્રશ્નોના જવાબો ચોકસાઈપૂર્વક ભરો.",
            completion_progress: "ફોર્મ ભરવાની પ્રગતિ",
            sec_1_title: "ભાગ ૧: પ્રશ્નો ૧ - ૯ (Part 1: Questions 1 - 9)",
            sec_2_title: "ભાગ ૨: પ્રશ્નો ૧૦ - ૧૮ (Part 2: Questions 10 - 18)",
            sec_3_title: "ભાગ ૩: પ્રશ્નો ૧૯ - ૨૬ (Part 3: Questions 19 - 26)",
            sec_4_title: "ભાગ ૪: પ્રશ્નો ૨૭ - ૩૪ (Part 4: Questions 27 - 34)",
            
            yes: "હા",
            no: "ના",
            other: "અન્ય",
            submit_button: "માહિતી સબમિટ કરો",
            submit_success: "વસ્તી ગણતરી ફોર્મ સફળતાપૂર્વક સબમિટ કરવામાં આવ્યું છે!",
            nav_download_data: "ડેટા ડાઉનલોડ",

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

            q34_label: "મો.નં:",
            error_required: "આ પ્રશ્નનો જવાબ આપવો ફરજિયાત છે.",
            error_choice: "કૃપા કરીને આપેલ વિકલ્પોમાંથી કોઈ એક પસંદ કરો.",
            error_number: "કૃપા કરીને સાચી સંખ્યા દાખલ કરો.",
            error_positive: "કૃપા કરીને શૂન્ય કરતાં મોટી સંખ્યા દાખલ કરો.",
            error_non_negative: "કૃપા કરીને શૂન્ય અથવા ધન પૂર્ણાંક દાખલ કરો.",
            error_couples: "પરિણીત યુગલોની સંખ્યા કુલ સભ્યોની સંખ્યાથી વધુ ન હોઈ શકે.",
            error_mobile: "કૃપા કરીને સાચો ૧૦-અંકનો ભારતીય મોબાઇલ નંબર દાખલ કરો.",
            error_name: "કૃપા કરીને સાચું નામ દાખલ કરો (ફક્ત અક્ષરો).",
            modal_title: "માહિતીની ચકાસણી કરો",
            modal_subtitle: "કૃપા કરીને સબમિટ કરતા પહેલા તમારી વિગતો ચકાસો.",
            modal_btn_edit: "સુધારો કરો",
            modal_btn_confirm: "સબમિટ કરો",
            toast_success_title: "સફળતા",
            toast_success_msg: "વસ્તી ગણતરી ફોર્મ સફળતાપૂર્વક સબમિટ કરવામાં આવ્યું છે!",
            toast_error_title: "ભૂલ",
            toast_error_msg: "સબમિશનમાં ભૂલ આવી છે. કૃપા કરીને ફરી પ્રયાસ કરો.",
            empty_field_msg: "ભરેલ નથી"
        },
        hi: {
            portal_title: "जनगणना पोर्टल",
            loader_title: "विवरण की जांच कर रहे हैं...",
            loader_subtitle: "कृपया कुछ प्रतीक्षा करें, डेटा खोजा जा रहा है...",
            form_title: "जनगणना के लिए ३४ प्रश्नों की सूची",
            form_desc: "राष्ट्रीय जनगणना प्रपत्र को पूरा करने के लिए नीचे दिए गए सभी ३४ प्रश्नों के उत्तर ध्यानपूर्वक भरें।",
            completion_progress: "फॉर्म भरने की प्रगति",
            sec_1_title: "भाग १: प्रश्न १ - ९ (Part 1: Questions 1 - 9)",
            sec_2_title: "भाग २: प्रश्न १० - १८ (Part 2: Questions 10 - 18)",
            sec_3_title: "भाग ३: प्रश्न १९ - २६ (Part 3: Questions 19 - 26)",
            sec_4_title: "भाग ४: प्रश्न २७ - ३४ (Part 4: Questions 27 - 34)",
            
            yes: "हाँ",
            no: "नहीं",
            other: "अन्य",
            submit_button: "डेटा जमा करें",
            submit_success: "जनगणना फॉर्म सफलतापूर्वक जमा कर दिया गया है!",
            nav_download_data: "डेटा डाउनलोड",

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

            q34_label: "मोबाइल नंबर:",
            error_required: "यह फ़ील्ड आवश्यक है।",
            error_choice: "कृपया एक विकल्प चुनें।",
            error_number: "कृपया एक मान्य संख्या दर्ज करें।",
            error_positive: "कृपया शून्य से बड़ी संख्या दर्ज करें।",
            error_non_negative: "कृपया शून्य या धनात्मक पूर्णांक दर्ज करें।",
            error_couples: "विवाहित जोड़ों की संख्या कुल सदस्यों से अधिक नहीं हो सकती।",
            error_mobile: "कृपया एक मान्य 10-अंकीय भारतीय मोबाइल नंबर दर्ज करें।",
            error_name: "कृपया एक मान्य नाम दर्ज करें (केवल अक्षर)।",
            modal_title: "विवरण की समीक्षा करें",
            modal_subtitle: "कृपया सबमिट करने से पहले अपने विवरण सत्यापित करें।",
            modal_btn_edit: "संपादित करें",
            modal_btn_confirm: "पुष्टि करें और सबमिट करें",
            toast_success_title: "सफलता",
            toast_success_msg: "जनगणना फॉर्म सफलतापूर्वक जमा कर दिया गया है!",
            toast_error_title: "त्रुटि",
            toast_error_msg: "सबमिशन में त्रुटि आई। कृपया पुनः प्रयास करें।",
            empty_field_msg: "नहीं भरा गया"
        },
        en: {
            portal_title: "Census Portal",
            loader_title: "Checking Details...",
            loader_subtitle: "Please wait, searching existing database records...",
            form_title: "Census List of 34 Questions",
            form_desc: "Please accurately fill out all 34 questions below to complete the national census registration form.",
            completion_progress: "Form Progress",
            sec_1_title: "Part 1: Questions 1 - 9",
            sec_2_title: "Part 2: Questions 10 - 18",
            sec_3_title: "Part 3: Questions 19 - 26",
            sec_4_title: "Part 4: Questions 27 - 34",
            
            yes: "Yes",
            no: "No",
            other: "Other",
            submit_button: "Submit Information",
            submit_success: "Census form submitted successfully!",
            nav_download_data: "Download Data",

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

            q34_label: "Mobile Number:",
            error_required: "This field is required.",
            error_choice: "Please select an option.",
            error_number: "Please enter a valid number.",
            error_positive: "Please enter a positive integer.",
            error_non_negative: "Please enter a non-negative integer.",
            error_couples: "Married couples cannot exceed total family members.",
            error_mobile: "Please enter a valid 10-digit Indian mobile number.",
            error_name: "Please enter a valid name (letters only).",
            modal_title: "Review Your Details",
            modal_subtitle: "Please verify your filled details before submitting.",
            modal_btn_edit: "Cancel & Edit",
            modal_btn_confirm: "Confirm & Submit",
            toast_success_title: "Success",
            toast_success_msg: "Census form submitted successfully!",
            toast_error_title: "Error",
            toast_error_msg: "Submission failed. Please try again.",
            empty_field_msg: "Not Filled"
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

        // Sync download data link language
        const downloadBtn = document.getElementById('nav-download-btn');
        if (downloadBtn) {
            downloadBtn.href = `/download-data?lang=${lang}`;
        }

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

    // Restrict mobile number input to digits only and maximum 10 digits
    $('#q34').on('keypress', function(e) {
        if (e.which < 48 || e.which > 57) {
            e.preventDefault();
        }
    }).on('input', function() {
        let val = this.value.replace(/\D/g, '');
        if (val.length > 10) {
            val = val.substring(0, 10);
        }
        this.value = val;
    });



    // Form submit interceptor with Confirmation Modal and AJAX submission
    const form = document.getElementById('census-form');
    
    // modal elements
    const modalOverlay = document.getElementById('confirm-modal-overlay');
    const modalCloseBtn = document.getElementById('modal-close-btn');
    const modalCancelBtn = document.getElementById('modal-cancel-btn');
    const modalSubmitBtn = document.getElementById('modal-submit-btn');
    const modalSummaryBody = document.getElementById('modal-summary-body');

    // Show toast function
    function showToast(title, message, type = 'success') {
        const container = document.getElementById('toast-container');
        if (!container) return;

        const toast = document.createElement('div');
        toast.className = `toast-card ${type}`;

        // Pick appropriate SVG icon
        let iconSvg = '';
        if (type === 'success') {
            iconSvg = `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>`;
        } else if (type === 'error') {
            iconSvg = `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>`;
        } else {
            iconSvg = `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="9" x2="12.01" y2="9"></line></svg>`;
        }

        toast.innerHTML = `
            <div class="toast-icon">${iconSvg}</div>
            <div class="toast-content">
                <span class="toast-title">${title}</span>
                <span class="toast-message">${message}</span>
            </div>
            <button class="toast-close-btn" type="button">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
            <div class="toast-progress"></div>
        `;

        container.appendChild(toast);

        // Trigger slide-in animation
        setTimeout(() => toast.classList.add('show'), 10);

        const duration = 4000;
        const progress = toast.querySelector('.toast-progress');
        if (progress) {
            progress.style.transition = `transform ${duration}ms linear`;
            progress.style.transform = 'scaleX(0)';
        }

        const closeToast = () => {
            toast.classList.remove('show');
            toast.classList.add('hide');
            setTimeout(() => toast.remove(), 400);
        };

        const timerId = setTimeout(closeToast, duration);

        toast.querySelector('.toast-close-btn').addEventListener('click', () => {
            clearTimeout(timerId);
            closeToast();
        });
    }

    // Modal open function
    function openConfirmModal() {
        renderModalSummary();
        modalOverlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    // Modal close function
    function closeConfirmModal() {
        modalOverlay.classList.remove('active');
        document.body.style.overflow = '';
        // restore submit button state
        const submitBtnText = modalSubmitBtn.querySelector('span');
        if (submitBtnText) {
            submitBtnText.textContent = localization[currentLang].modal_btn_confirm;
        }
        const spinner = modalSubmitBtn.querySelector('.spinner');
        if (spinner) spinner.remove();
        modalSubmitBtn.removeAttribute('disabled');
    }

    // Render summary data in modal in a single form sequence (no sections)
    function renderModalSummary() {
        modalSummaryBody.innerHTML = '';

        // Gather filled details dynamically
        const summaryData = [];
        $('.form-group').each(function() {
            const $group = $(this);
            const qNumEl = $group.find('.question-number');
            if (!qNumEl.length) return;
            const qNum = parseInt(qNumEl.text().trim(), 10);
            if (isNaN(qNum)) return;

            const labelEl = $group.find('.form-label').clone();
            labelEl.find('.question-number').remove();
            const qLabelText = labelEl.text().replace(/:$/, '').trim();

            let valueText = '';
            const radios = $group.find('input[type="radio"]');
            const checkboxes = $group.find('input[type="checkbox"]');
            const textInputs = $group.find('input[type="text"], input[type="number"], input[type="tel"]');

            if (radios.length > 0) {
                const checkedRadio = radios.filter(':checked');
                if (checkedRadio.length) {
                    valueText = checkedRadio.closest('.choice-card').find('.choice-pill').text().trim();
                } else {
                    valueText = '—';
                }
            } else if (checkboxes.length > 0) {
                const checkedCheckboxes = checkboxes.filter(':checked');
                if (checkedCheckboxes.length) {
                    const vals = [];
                    checkedCheckboxes.each(function() {
                        vals.push($(this).closest('.choice-card').find('.choice-pill').text().trim());
                    });
                    valueText = vals.join(', ');
                } else {
                    valueText = '—';
                }
            } else if (textInputs.length > 0) {
                const val = textInputs.val().trim();
                valueText = val !== '' ? val : '—';
            }

            summaryData.push({
                num: qNum,
                label: qLabelText,
                value: valueText,
                isFilled: valueText !== '—'
            });
        });

        // Sort by question number to ensure exact form sequence
        summaryData.sort((a, b) => a.num - b.num);

        const grid = document.createElement('div');
        grid.className = 'summary-grid';

        summaryData.forEach(item => {
            const itemDiv = document.createElement('div');
            itemDiv.className = `summary-item ${!item.isFilled ? 'summary-item-empty' : ''}`;
            
            const displayVal = item.isFilled ? item.value : (localization[currentLang].empty_field_msg || 'Not Filled');
            itemDiv.innerHTML = `
                <div class="summary-item-label">
                    <span class="question-number" style="min-width:16px;height:16px;font-size:0.7rem;padding:0;">${item.num}</span>
                    <span>${item.label}</span>
                </div>
                <div class="summary-item-value">${displayVal}</div>
            `;
            grid.appendChild(itemDiv);
        });

        modalSummaryBody.appendChild(grid);
    }

    // Modal Action Bindings
    modalCloseBtn.addEventListener('click', closeConfirmModal);
    modalCancelBtn.addEventListener('click', closeConfirmModal);

    modalSubmitBtn.addEventListener('click', () => {
        // Show loading state
        modalSubmitBtn.setAttribute('disabled', 'true');
        const submitBtnText = modalSubmitBtn.querySelector('span');
        if (submitBtnText) {
            submitBtnText.textContent = currentLang === 'en' ? 'Submitting...' : (currentLang === 'hi' ? 'जमा कर रहे हैं...' : 'મોકલી રહ્યું છે...');
        }
        const spinner = document.createElement('span');
        spinner.className = 'spinner';
        modalSubmitBtn.prepend(spinner);

        // Check if updating an existing record
        const recordId = document.getElementById('record-id').value;
        const formData = new FormData(form);
        
        let url = '/census';
        if (recordId) {
            url = `/census/${recordId}`;
            formData.append('_method', 'PUT');
        }

        const doSubmit = (retryCount = 0) => {
            fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (response.ok) {
                    closeConfirmModal();
                    showToast(
                        localization[currentLang].toast_success_title || 'Success',
                        recordId 
                            ? (currentLang === 'en' ? 'Census record updated successfully!' : (currentLang === 'hi' ? 'जनगणना विवरण सफलतापूर्वक अपडेट किया गया!' : 'વસ્તી ગણતરી વિગતો સફળતાપૂર્વક અપડેટ થઈ ગઈ છે!'))
                            : (localization[currentLang].toast_success_msg || 'Census form submitted successfully!'),
                        'success'
                    );
                    // Reset form and recalculate completion progress
                    form.reset();
                    document.getElementById('record-id').value = '';
                    document.getElementById('form-mode').value = currentMode;
                    if (typeof lastSearchedHouseNo !== 'undefined') {
                        lastSearchedHouseNo = '';
                        lastSearchedMode = currentMode;
                    }
                    calculateProgress();
                    // Scroll page back to top smoothly
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                } else if (response.status === 419 && retryCount < 1) {
                    // CSRF Token Expired - fetch a new one in the background and retry
                    console.warn('CSRF token expired. Fetching fresh token and retrying...');
                    return fetch('/refresh-csrf')
                        .then(res => {
                            if (!res.ok) throw new Error('Failed to refresh CSRF token');
                            return res.json();
                        })
                        .then(data => {
                            const newToken = data.token;
                            // Update token in DOM inputs and their defaults to survive resets
                            document.querySelectorAll('input[name="_token"]').forEach(input => {
                                input.value = newToken;
                                input.defaultValue = newToken;
                            });
                            // Update token in FormData object
                            formData.set('_token', newToken);
                            // Retry submission
                            doSubmit(retryCount + 1);
                        });
                } else {
                    throw new Error('Server returned error status: ' + response.status);
                }
            })
            .catch(error => {
                console.error('Submission error:', error);
                closeConfirmModal();
                showToast(
                    localization[currentLang].toast_error_title || 'Error',
                    localization[currentLang].toast_error_msg || 'Submission failed. Please try again.',
                    'error'
                );
            });
        };

        doSubmit();
    });

    // Form submit listener
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
            openConfirmModal();
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

    let lastSearchedHouseNo = '';
    let lastSearchedMode = '';

    // Sync function: searches database by house_no and mode, then populates or resets form
    function checkHouseRecord() {
        const houseNo = $('#q2').val().trim();
        const mode = currentMode;
        const $recordIdInput = $('#record-id');

        if (!houseNo) {
            lastSearchedHouseNo = '';
            lastSearchedMode = mode;
            clearFormExceptHouseNo();
            $recordIdInput.val('');
            return;
        }

        // Don't repeat query if the house number and mode haven't changed
        if (houseNo === lastSearchedHouseNo && mode === lastSearchedMode) {
            return;
        }

        lastSearchedHouseNo = houseNo;
        lastSearchedMode = mode;

        // Show spinner loader
        $('#house-loader').show();

        // Perform AJAX GET request
        $.ajax({
            url: '/census/check-house',
            method: 'GET',
            data: {
                house_no: houseNo,
                mode: mode
            },
            dataType: 'json',
            success: function(response) {
                if (response.success && response.found) {
                    const record = response.data;
                    $recordIdInput.val(record.id);

                    // Sync active mode dynamically if the record's mode in database is different
                    if (record.mode && record.mode !== currentMode) {
                        setMode(record.mode, false);
                    }

                    // Populate form fields with response data
                    populateForm(record);

                    // Recalculate progress bar
                    calculateProgress();

                    // Show custom message toast
                    showToast(
                        currentLang === 'en' ? 'Record Loaded' : (currentLang === 'hi' ? 'विवरण लोड किए गए' : 'માહિતી લોડ થઈ'),
                        currentLang === 'en' ? `Loaded existing details for House Number: ${houseNo}` : (currentLang === 'hi' ? `मकान संख्या: ${houseNo} के लिए मौजूदा विवरण लोड किया गया` : `મકાન નંબર: ${houseNo} માટેની વિગતો લોડ કરવામાં આવી છે`),
                        'info'
                    );
                } else {
                    // Not found in database
                    // If a record was previously loaded (recordId is set), we need to clear the form fields
                    if ($recordIdInput.val()) {
                        clearFormExceptHouseNo();
                        $recordIdInput.val('');
                        calculateProgress();
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error('House search error:', error);
            },
            complete: function() {
                // Hide spinner loader when request completes
                $('#house-loader').hide();
            }
        });
    }

    // Helper to populate all form fields with record data
    function populateForm(record) {
        // Text & Number inputs mappings
        const textInputs = {
            'q1': record.lineNo,
            'q3': record.censusHouseNo,
            'q9': record.householdNo,
            'q10': record.totalMembers,
            'q11': record.headName,
            'q15': record.dwellingRooms,
            'q16': record.marriedCouples,
            'q21': record.latrineType,
            'q34': record.mobileNo
        };

        for (const [id, value] of Object.entries(textInputs)) {
            const input = document.getElementById(id);
            if (input) {
                input.value = value !== null && value !== undefined ? value : '';
                // Clear any validation errors on populated fields
                clearFieldStyle(input);
            }
        }

        // Radio button mappings
        const radios = {
            'floor_material': record.floorMaterial,
            'wall_material': record.wallMaterial,
            'roof_material': record.roofMaterial,
            'house_use': record.houseUse,
            'house_condition': record.houseCondition,
            'head_gender': record.headGender,
            'social_category': record.socialCategory,
            'ownership': record.ownership,
            'drinking_water': record.drinkingWater,
            'water_availability': record.waterAvailability,
            'lighting_source': record.lightingSource,
            'latrine_facility': record.latrineFacility,
            'drainage_system': record.drainageSystem,
            'bathroom_facility': record.bathroomFacility,
            'kitchen_facility': record.kitchenFacility,
            'cooking_fuel': record.cookingFuel,
            'has_radio': record.hasRadio,
            'has_tv': record.hasTv,
            'has_internet': record.hasInternet,
            'has_pc': record.hasPc,
            'phone_type': record.phoneType,
            'has_car': record.hasCar,
            'main_cereal': record.mainCereal
        };

        for (const [name, value] of Object.entries(radios)) {
            if (value !== null && value !== undefined) {
                const radioInput = document.querySelector(`input[name="${name}"][value="${value}"]`);
                if (radioInput) {
                    radioInput.checked = true;
                    clearFieldStyle(radioInput);
                } else {
                    document.querySelectorAll(`input[name="${name}"]`).forEach(r => r.checked = false);
                }
            } else {
                document.querySelectorAll(`input[name="${name}"]`).forEach(r => r.checked = false);
            }
        }

        // Checkbox mapping: vehicles
        const vehicles = record.vehicles || [];
        const checkboxes = document.querySelectorAll('input[name="vehicles[]"]');
        checkboxes.forEach(cb => {
            cb.checked = vehicles.includes(cb.value);
            clearFieldStyle(cb);
        });
    }

    // Helper to reset form except house_no input
    function clearFormExceptHouseNo() {
        const houseNo = $('#q2').val();
        
        // Temporarily reset but preserve house_no
        form.reset();
        
        // Re-set preserved house_no
        $('#q2').val(houseNo);
        
        // Restore active form mode to prevent it from resetting to "house"
        const modeInput = document.getElementById('form-mode');
        if (modeInput) {
            modeInput.value = currentMode;
        }

        // Also clear any styling errors across all elements
        trackingInputs.forEach(input => {
            clearFieldStyle(input);
        });

        // Recalculate progress bar
        calculateProgress();
    }

    // Listen to changes on house number input with debounce on input typing
    let searchTimeout = null;
    $('#q2').on('input change blur keydown', function(e) {
        if (e.type === 'keydown' && e.key !== 'Enter') {
            return;
        }
        if (e.type === 'keydown') {
            e.preventDefault(); // Prevents submitting form if enter is pressed
        }
        
        clearTimeout(searchTimeout);
        
        if (e.type === 'input') {
            searchTimeout = setTimeout(checkHouseRecord, 600); // 600ms debounce
        } else {
            checkHouseRecord();
        }
    });

    // Set initial mode on startup after all references are initialized
    setMode(currentMode, false);
</script>
</body>
</html>
