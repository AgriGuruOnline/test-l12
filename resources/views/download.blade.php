<!DOCTYPE html>
<html lang="{{ $currentLang }}" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ડેટા ડાઉનલોડ | Census Records Dashboard</title>
    <!-- Google Fonts: Inter & Plus Jakarta Sans & Noto Sans Gujarati/Devanagari for local scripts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Noto+Sans+Gujarati:wght@400;600;700&family=Noto+Sans:wght@400;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- jQuery (local with relative path for reliable loading on any domain) -->
    <script src="/js/jquery.min.js"></script>

    <!-- DataTables CSS (local with relative path) -->
    <link rel="stylesheet" href="/css/jquery.dataTables.min.css">
    
    <!-- DataTables JS (local with relative path) -->
    <script src="/js/jquery.dataTables.min.js"></script>
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
            
            /* Section Header Accents */
            --section-title-bg: hsl(210, 40%, 95%);
            --section-num-bg: hsl(243, 75%, 59%);
            
            /* Buttons */
            --btn-bg: hsl(243, 75%, 59%);
            --btn-hover: hsl(243, 75%, 50%);
            --btn-text: hsl(0, 0%, 100%);
            
            /* Secondary Buttons */
            --btn-sec-bg: hsl(210, 40%, 96.1%);
            --btn-sec-border: hsl(214, 32%, 88%);
            --btn-sec-text: hsl(215, 25%, 30%);
            --btn-sec-hover: hsl(210, 40%, 92%);

            /* Theme & Lang Switchers */
            --toggle-bg: hsl(210, 40%, 93%);
            --toggle-active-bg: hsl(0, 0%, 100%);
            --toggle-border: hsl(214, 32%, 88%);
            
            --glow-opacity: 0.05;
            --font-family: 'Plus Jakarta Sans', 'Inter', 'Noto Sans Gujarati', 'Noto Sans', sans-serif;
            --transition: all 0.22s cubic-bezier(0.4, 0, 0.2, 1);
            --card-shadow: 0 12px 34px -10px hsla(222, 47%, 10%, 0.04), 0 2px 8px -2px hsla(222, 47%, 10%, 0.02);
            
            /* Table Accents */
            --table-header-bg: hsl(210, 40%, 95%);
            --table-row-hover: hsl(210, 40%, 98%);
            --table-border: hsl(214, 32%, 91%);
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
            
            /* Section Header Accents */
            --section-title-bg: hsl(222, 47%, 14%);
            --section-num-bg: hsl(243, 75%, 68%);
            
            /* Buttons */
            --btn-bg: hsl(243, 75%, 64%);
            --btn-hover: hsl(243, 75%, 72%);
            --btn-text: hsl(222, 47%, 6%);
            
            /* Secondary Buttons */
            --btn-sec-bg: hsl(222, 47%, 14%);
            --btn-sec-border: hsl(222, 47%, 18%);
            --btn-sec-text: hsl(210, 40%, 95%);
            --btn-sec-hover: hsl(222, 47%, 18%);

            /* Theme & Lang Switchers */
            --toggle-bg: hsl(222, 47%, 14%);
            --toggle-active-bg: hsl(222, 47%, 20%);
            --toggle-border: hsl(222, 47%, 18%);
            
            --glow-opacity: 0.18;
            --card-shadow: 0 20px 40px -15px hsla(0, 0%, 0%, 0.35);
            
            /* Table Accents */
            --table-header-bg: hsl(222, 47%, 14%);
            --table-row-hover: hsl(222, 47%, 13%);
            --table-border: hsl(222, 47%, 16%);
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
            max-width: 1200px;
            z-index: 1;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        /* Top Bar with Language Switcher & Theme toggle */
        .top-bar {
            position: relative;
            z-index: 200;
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

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 10px;
            border: 1px solid var(--btn-sec-border);
            background: var(--btn-sec-bg);
            color: var(--btn-sec-text);
            font-size: 0.9rem;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-back:hover {
            background: var(--btn-sec-hover);
            transform: translateX(-2px);
        }

        .logo-text {
            font-weight: 700;
            font-size: 1.15rem;
            color: var(--text-title);
            letter-spacing: -0.5px;
        }

        .bar-right {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        /* Switchers Styles */
        .switcher {
            display: flex;
            background: var(--toggle-bg);
            padding: 2.5px;
            border-radius: 10px;
            border: 1px solid var(--toggle-border);
        }

        .switcher button {
            border: none;
            background: transparent;
            color: var(--text-muted);
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            font-family: var(--font-family);
        }

        .switcher button.active {
            background: var(--toggle-active-bg);
            color: var(--text-title);
            box-shadow: 0 2px 8px -2px rgba(0, 0, 0, 0.12);
        }

        /* Header Card */
        .header-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 24px;
            padding: 2.5rem;
            box-shadow: var(--card-shadow);
            position: relative;
            overflow: hidden;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 2rem;
        }

        .header-info h1 {
            font-size: 1.85rem;
            font-weight: 700;
            color: var(--text-title);
            margin-bottom: 0.5rem;
            letter-spacing: -0.5px;
        }

        .header-info p {
            color: var(--text-muted);
            font-size: 0.95rem;
            max-width: 600px;
            line-height: 1.5;
        }

        /* Download Button Actions */
        .download-actions {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .btn-download {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.85rem 1.6rem;
            border-radius: 12px;
            border: none;
            background: var(--btn-bg);
            color: var(--btn-text);
            font-size: 0.95rem;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            box-shadow: 0 4px 15px -4px hsla(243, 75%, 59%, 0.35);
            transition: var(--transition);
        }

        .btn-download:hover {
            background: var(--btn-hover);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px -4px hsla(243, 75%, 59%, 0.45);
        }

        .btn-download.excel {
            background: hsl(142, 72%, 29%);
            color: #ffffff;
            box-shadow: 0 4px 15px -4px hsla(142, 72%, 29%, 0.35);
        }

        .btn-download.excel:hover {
            background: hsl(142, 72%, 24%);
            box-shadow: 0 8px 20px -4px hsla(142, 72%, 29%, 0.45);
        }

        .btn-download.pdf {
            background: hsl(343, 75%, 50%);
            color: #ffffff;
            box-shadow: 0 4px 15px -4px hsla(343, 75%, 50%, 0.35);
        }

        .btn-download.pdf:hover {
            background: hsl(343, 75%, 44%);
            box-shadow: 0 8px 20px -4px hsla(343, 75%, 50%, 0.45);
        }

        /* Stats Box */
        .stats-badge {
            background: var(--toggle-bg);
            border: 1px solid var(--toggle-border);
            border-radius: 12px;
            padding: 0.6rem 1.2rem;
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-title);
        }

        .stats-count {
            background: var(--btn-bg);
            color: var(--btn-text);
            padding: 2px 8px;
            border-radius: 6px;
            font-weight: 700;
        }

        /* Scrollable Data Table Card */
        .table-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 24px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .table-header-panel {
            padding: 1.5rem 2rem;
            border-bottom: 1px solid var(--table-border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .table-title {
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--text-title);
        }

        /* Custom Scrollbar for horizontal scrolling table */
        .table-responsive {
            width: 100%;
            overflow-x: auto;
            position: relative;
        }

        /* Scrollbar Styling */
        .table-responsive::-webkit-scrollbar {
            height: 10px;
        }
        .table-responsive::-webkit-scrollbar-track {
            background: var(--input-bg);
        }
        .table-responsive::-webkit-scrollbar-thumb {
            background: var(--toggle-border);
            border-radius: 10px;
        }
        .table-responsive::-webkit-scrollbar-thumb:hover {
            background: var(--text-muted);
        }

        .data-table {
            width: max-content;
            min-width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
            text-align: left;
        }

        .data-table th {
            background: var(--table-header-bg);
            color: var(--text-title);
            font-weight: 700;
            padding: 1rem 1.25rem;
            border-bottom: 2px solid var(--table-border);
            white-space: nowrap;
            position: sticky;
            top: 0;
            font-size: 0.8rem;
            letter-spacing: -0.2px;
        }

        .data-table td {
            padding: 0.9rem 1.25rem;
            border-bottom: 1px solid var(--table-border);
            color: var(--text-body);
            white-space: nowrap;
        }

        .data-table tbody tr {
            transition: var(--transition);
        }

        .data-table tbody tr:hover {
            background: var(--table-row-hover);
        }

        /* Badges */
        .badge-mode {
            padding: 3px 8px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
        }
        
        .badge-mode.house {
            background: hsla(243, 75%, 68%, 0.15);
            color: var(--pill-active-border);
            border: 1px solid hsla(243, 75%, 68%, 0.3);
        }

        .badge-mode.shop {
            background: hsla(38, 92%, 50%, 0.12);
            color: hsl(38, 92%, 50%);
            border: 1px solid hsla(38, 92%, 50%, 0.25);
        }

        /* Empty State */
        .empty-state {
            padding: 4rem 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 1.5rem;
            text-align: center;
            color: var(--text-muted);
        }

        .empty-icon {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: var(--toggle-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            margin-bottom: 0.5rem;
        }

        .empty-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-title);
        }

        .empty-desc {
            font-size: 0.9rem;
            max-width: 400px;
            line-height: 1.5;
        }

        /* DataTables Custom Overrides */
        .dataTables_wrapper {
            padding: 1.5rem 0;
            color: var(--text-body) !important;
        }

        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_processing,
        .dataTables_wrapper .dataTables_paginate {
            color: var(--text-muted) !important;
            font-size: 0.85rem;
            margin: 0.75rem 1.5rem;
        }

        .dataTables_wrapper .dataTables_filter {
            float: right;
            text-align: right;
        }

        .dataTables_wrapper .dataTables_length {
            float: left;
        }

        .dataTables_wrapper .dataTables_info {
            clear: both;
            float: left;
            padding-top: 0.75em;
        }

        .dataTables_wrapper .dataTables_paginate {
            float: right;
            padding-top: 0.5em;
        }

        .dataTables_wrapper .dataTables_filter input {
            background-color: var(--input-bg) !important;
            border: 1px solid var(--input-border) !important;
            border-radius: 8px !important;
            padding: 6px 12px !important;
            color: var(--text-title) !important;
            font-family: var(--font-family) !important;
            outline: none !important;
            margin-left: 0.5em !important;
            transition: var(--transition) !important;
        }

        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: var(--input-focus-border) !important;
            box-shadow: 0 0 0 3px hsla(243, 75%, 59%, 0.15) !important;
        }

        .dataTables_wrapper .dataTables_length select {
            background-color: var(--input-bg) !important;
            border: 1px solid var(--input-border) !important;
            border-radius: 8px !important;
            padding: 4px 8px !important;
            color: var(--text-title) !important;
            font-family: var(--font-family) !important;
            outline: none !important;
            margin: 0 4px !important;
        }

        /* Customize Table Borders inside wrapper */
        table.dataTable.no-footer {
            border-bottom: 1px solid var(--table-border) !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            background: var(--toggle-bg) !important;
            border: 1px solid var(--toggle-border) !important;
            color: var(--text-body) !important;
            border-radius: 8px !important;
            padding: 5px 12px !important;
            margin: 0 2px !important;
            font-weight: 600 !important;
            transition: var(--transition) !important;
            cursor: pointer;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: var(--btn-sec-hover) !important;
            color: var(--text-title) !important;
            border-color: var(--btn-sec-border) !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background: var(--btn-bg) !important;
            color: var(--btn-text) !important;
            border-color: var(--btn-bg) !important;
            box-shadow: 0 2px 8px -2px hsla(243, 75%, 59%, 0.3) !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover,
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
            background: transparent !important;
            border-color: transparent !important;
            color: var(--text-muted) !important;
            opacity: 0.5 !important;
            cursor: default !important;
        }

        /* Striped Table Rows */
        .data-table tbody tr:nth-child(even) td {
            background-color: var(--table-header-bg) !important;
        }
        .data-table tbody tr:nth-child(odd) td {
            background-color: var(--card-bg) !important;
        }
        .data-table tbody tr:hover td {
            background-color: var(--table-row-hover) !important;
        }

        /* Dynamic Processing Loader Overlay */
        .dataTables_wrapper .dataTables_processing {
            background-color: var(--card-bg) !important;
            border: 1px solid var(--card-border) !important;
            color: var(--text-title) !important;
            border-radius: 12px !important;
            box-shadow: var(--card-shadow) !important;
            padding: 1rem 2rem !important;
            font-weight: 700 !important;
            font-size: 0.95rem !important;
            z-index: 1000 !important;
            top: 50% !important;
            left: 50% !important;
            transform: translate(-50%, -50%) !important;
            height: auto !important;
            width: auto !important;
            margin: 0 !important;
        }

        /* Sticky Left Column */
        .data-table th:first-child,
        .data-table td:first-child {
            position: sticky !important;
            left: 0 !important;
            z-index: 15 !important;
        }
        .data-table th:first-child {
            z-index: 16 !important;
            background-color: var(--table-header-bg) !important;
            border-right: 2px solid var(--table-border) !important;
            top: 0 !important;
        }
        .data-table tbody tr:nth-child(even) td:first-child {
            background-color: var(--table-header-bg) !important;
            border-right: 2px solid var(--table-border) !important;
        }
        .data-table tbody tr:nth-child(odd) td:first-child {
            background-color: var(--card-bg) !important;
            border-right: 2px solid var(--table-border) !important;
        }
        .data-table tbody tr:hover td:first-child {
            background-color: var(--table-row-hover) !important;
        }

        /* Action Buttons */
        .action-btn-group {
            display: flex;
            gap: 6px;
        }
        .btn-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
            border-radius: 6px;
            border: 1px solid var(--toggle-border);
            background: var(--toggle-bg);
            color: var(--text-body);
            cursor: pointer;
            transition: var(--transition);
        }
        .btn-action:hover {
            background: var(--btn-sec-hover);
            color: var(--text-title);
            transform: scale(1.05);
        }
        .btn-action.btn-delete,
        .btn-action.btn-force-delete {
            color: #DC2626 !important;
            border-color: rgba(220, 38, 38, 0.2) !important;
            background: rgba(220, 38, 38, 0.05) !important;
        }
        .btn-action.btn-delete:hover,
        .btn-action.btn-force-delete:hover {
            background: #DC2626 !important;
            color: white !important;
            border-color: #DC2626 !important;
            box-shadow: 0 0 8px rgba(220, 38, 38, 0.4) !important;
        }
        .btn-action.btn-restore:hover {
            background: hsl(142, 72%, 29%) !important;
            color: white !important;
            border-color: hsl(142, 72%, 29%) !important;
            box-shadow: 0 0 8px hsla(142, 72%, 29%, 0.4) !important;
        }
        .btn-action svg {
            width: 14px;
            height: 14px;
            stroke-width: 2.5px;
            fill: none;
            stroke: currentColor;
        }

        .modal-btn-red {
            background: #DC2626 !important;
            color: white !important;
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.2) !important;
        }
        .modal-btn-red:hover {
            background: #B91C1C !important;
            transform: translateY(-1px) !important;
        }

        .modal-btn-dark-red {
            background: #991B1B !important;
            color: white !important;
            box-shadow: 0 4px 12px rgba(153, 27, 27, 0.2) !important;
        }
        .modal-btn-dark-red:hover {
            background: #7F1D1D !important;
            transform: translateY(-1px) !important;
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
            z-index: 2000;
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
            padding: 1.25rem 1.75rem;
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
            font-size: 1.25rem;
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
            padding: 1.75rem;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            max-height: 55vh;
            scrollbar-width: thin;
            scrollbar-color: var(--toggle-border) transparent;
        }

        .modal-footer {
            padding: 1rem 1.75rem;
            border-top: 1px solid var(--card-border);
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
        }

        .modal-btn {
            padding: 0.65rem 1.5rem;
            border-radius: 10px;
            font-weight: 700;
            font-size: 0.9rem;
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

        /* Premium Toast Styles */
        .toast-container {
            position: fixed;
            top: 2rem;
            right: 2rem;
            z-index: 2100;
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
            border-left: 4px solid hsl(343, 75%, 50%);
        }
        .toast-card.error .toast-icon {
            color: hsl(343, 75%, 50%);
            background: hsla(343, 75%, 50%, 0.1);
        }
        [data-theme="dark"] .toast-card.error .toast-icon {
            background: hsla(343, 85%, 65%, 0.15);
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
            background: hsl(343, 75%, 50%);
        }

        @media (max-width: 768px) {
            .modal-footer {
                flex-direction: column-reverse;
                padding: 1rem 1.5rem;
            }
            .modal-btn {
                width: 100%;
                justify-content: center;
            }
            .modal-header {
                padding: 1rem 1.25rem;
            }
            .modal-body {
                padding: 1.25rem;
            }
            .profile-widget {
                position: relative !important;
            }
            .profile-menu {
                left: auto !important;
                right: 0 !important;
                width: 250px !important;
                top: 48px !important;
                margin-top: 8px !important;
                transform-origin: top right !important;
            }
            /* Hide settings in header on mobile */
            .top-bar .switcher {
                display: none !important;
            }
            /* Show settings in profile dropdown on mobile */
            .profile-settings-section {
                display: flex !important;
                flex-direction: column !important;
            }
        }

        @media (max-width: 480px) {
            .top-bar {
                flex-direction: row !important;
                justify-content: space-between !important;
                align-items: center !important;
                padding: 0.75rem 1rem !important;
            }
            .bar-left {
                width: auto !important;
            }
            .bar-right {
                flex-direction: row !important;
                width: auto !important;
                gap: 0.5rem !important;
            }
        }

        /* Header Profile Widget */
        .profile-widget {
            position: relative;
            z-index: 100;
            font-family: inherit;
        }
        .profile-trigger {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background-color: #4f46e5;
            color: #ffffff;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(79, 70, 229, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.85rem;
            transition: all 0.2s ease;
        }
        .profile-trigger:hover {
            transform: scale(1.05);
            background-color: #4338ca;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.5);
        }
        .profile-menu {
            position: absolute;
            top: 48px;
            right: 0;
            width: 260px;
            z-index: 1000;
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15), var(--card-shadow);
            padding: 16px;
            display: none;
            flex-direction: column;
            gap: 12px;
            transform-origin: top right;
            animation: slideDown 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .profile-menu.show {
            display: flex;
        }
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
        .profile-info {
            border-bottom: 1px solid var(--card-border);
            padding-bottom: 12px;
            text-align: left;
        }
        .profile-name {
            font-weight: 700;
            font-size: 0.95rem;
            color: var(--text-title);
            margin-bottom: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .profile-email {
            font-size: 0.75rem;
            color: var(--text-muted);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .profile-links {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .profile-link {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border-radius: 8px;
            color: var(--text-body);
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
            text-align: left;
        }
        .profile-link:hover {
            background-color: var(--toggle-bg);
            color: var(--text-title);
        }
        .btn-logout-danger {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px;
            background-color: #e11d48;
            color: #ffffff;
            border: none;
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(225, 29, 72, 0.2);
        }
        .btn-logout-danger:hover {
            background-color: #be123c;
            box-shadow: 0 6px 16px rgba(225, 29, 72, 0.4);
        }
        .profile-settings-section {
            display: none; /* Hidden by default (on desktop) */
            border-bottom: 1px solid var(--card-border);
            padding: 12px 0;
            flex-direction: column;
            gap: 12px;
        }
        .profile-settings-section .switcher-group,
        .profile-settings-section .switcher {
            display: flex !important;
            flex-direction: row !important;
            width: 100% !important;
            background: var(--toggle-bg) !important;
            border: 1px solid var(--toggle-border) !important;
            padding: 4px !important;
            border-radius: 12px !important;
            gap: 2px !important;
        }
        .profile-settings-section .switch-btn,
        .profile-settings-section .switcher button {
            flex: 1 !important;
            display: flex !important;
            justify-content: center !important;
            align-items: center !important;
            background: transparent !important;
            border: none !important;
            padding: 6px 8px !important;
            border-radius: 8px !important;
            font-size: 0.75rem !important;
            cursor: pointer !important;
            color: var(--text-body) !important;
            transition: var(--transition) !important;
            box-sizing: border-box !important;
        }
        .profile-settings-section .switch-btn.active,
        .profile-settings-section .switcher button.active {
            background: var(--toggle-active-bg) !important;
            color: var(--text-title) !important;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08) !important;
            border: none !important;
        }
        .setting-item {
            display: flex;
            flex-direction: column;
            gap: 6px;
            text-align: left;
        }
        .setting-label {
            font-size: 0.7rem;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Top Navigation Bar -->
        <div class="top-bar">
            <div class="bar-left">
                <a href="/" class="btn-back">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                    <span id="txt-back">ફોર્મ પર પાછા જાઓ</span>
                </a>
                <span class="logo-text" id="txt-portal">વસ્તી ગણતરી રજિસ્ટર</span>
            </div>
            <div class="bar-right">


                <!-- Theme Controller -->
                <div class="switcher" id="theme-switcher">
                    <button data-theme-val="light" id="btn-theme-light">Light</button>
                    <button data-theme-val="dark" class="active" id="btn-theme-dark">Dark</button>
                </div>
                
                <!-- Language Switcher -->
                <div class="switcher" id="lang-switcher">
                    <button data-lang="gu" class="{{ $currentLang === 'gu' ? 'active' : '' }}">ગુજરાતી</button>
                    <button data-lang="hi" class="{{ $currentLang === 'hi' ? 'active' : '' }}">हिन्दी</button>
                    <button data-lang="en" class="{{ $currentLang === 'en' ? 'active' : '' }}">English</button>
                </div>

                <!-- Profile Widget -->
                <div class="profile-widget" id="profile-widget">
                    <button type="button" class="profile-trigger" id="profile-trigger" title="{{ Auth::user()->name }}">
                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                    </button>
                    <div class="profile-menu" id="profile-menu">
                        <div class="profile-info">
                            <div class="profile-name">{{ Auth::user()->name }}</div>
                            <div class="profile-email">{{ Auth::user()->email }}</div>
                        </div>
                        <!-- Settings Section (Language & Theme toggle) -->
                        <div class="profile-settings-section">
                            <div class="setting-item">
                                <span class="setting-label" id="profile-txt-lang-label">Language / ભાષા / भाषा</span>
                                <div class="switcher" id="profile-lang-switcher">
                                    <button data-lang="gu" class="{{ $currentLang === 'gu' ? 'active' : '' }}">ગુજરાતી</button>
                                    <button data-lang="hi" class="{{ $currentLang === 'hi' ? 'active' : '' }}">हिन्दी</button>
                                    <button data-lang="en" class="{{ $currentLang === 'en' ? 'active' : '' }}">English</button>
                                </div>
                            </div>
                            <div class="setting-item">
                                <span class="setting-label" id="profile-txt-theme-label">Theme / થીમ / थीम</span>
                                <div class="switcher" id="profile-theme-switcher">
                                    <button data-theme-val="light" id="profile-btn-theme-light">Light</button>
                                    <button data-theme-val="dark" class="active" id="profile-btn-theme-dark">Dark</button>
                                </div>
                            </div>
                        </div>
                        <div class="profile-links">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn-logout-danger">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                    <span data-localize="logout_btn" id="txt-logout-btn">Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dashboard Header -->
        <div class="header-card">
            <div class="header-info">
                <h1 id="txt-title">વસ્તી ગણતરી ડેટા ડાઉનલોડ</h1>
                <p id="txt-desc">રજિસ્ટર્ડ વસ્તી ગણતરીના પત્રકોની વિગતો અહીં જુઓ અને તેને વ્યવસ્થિત રીતે એક્સેલ શીટ અથવા A4 પ્રિન્ટ-ફ્રેન્ડલી પીડીએફ ફોર્મેટમાં ડાઉનલોડ કરો.</p>
                <div style="margin-top: 1rem; display: flex; gap: 0.75rem; flex-wrap: wrap;">
                    <div class="stats-badge">
                        <span id="txt-stats">કુલ પત્રકો:</span>
                        <span class="stats-count" id="active-records-count">{{ $rawRecordsCount }}</span>
                    </div>
                    <div class="stats-badge" style="background: hsla(343, 75%, 50%, 0.1); border-color: hsla(343, 75%, 50%, 0.2);">
                        <span id="txt-stats-trashed" style="color: hsl(343, 75%, 60%);">કચરાપેટી (Trash):</span>
                        <span class="stats-count" id="trashed-records-count" style="background: hsl(343, 75%, 50%); color: white;">{{ $rawTrashedCount }}</span>
                    </div>
                </div>
            </div>
            
            <!-- Export Options -->
            @if($rawRecordsCount > 0)
            <div class="download-actions">
                <!-- Download Excel link -->
                <a href="/download-data/excel?lang={{ $currentLang }}" class="btn-download excel" id="btn-excel">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                    <span id="lbl-download-excel">એક્સેલ ડાઉનલોડ (Excel)</span>
                </a>
                
                <!-- Download PDF link -->
                <a href="/download-data/pdf?lang={{ $currentLang }}" target="_blank" class="btn-download pdf" id="btn-pdf">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                    <span id="lbl-download-pdf">પીડીએફ ડાઉનલોડ (A4 PDF)</span>
                </a>
            </div>
            @endif
        </div>

        <!-- Scrollable Table -->
        <div class="table-card">
            <div class="table-header-panel">
                <span class="table-title" id="txt-table-title">તમામ નોંધણીઓ</span>
            </div>
            
            <div class="table-responsive">
                @if($rawRecordsCount > 0)
                <table class="data-table">
                    <thead>
                        <tr>
                            <th class="actions-col">{{ $translations['actions'] ?? 'Actions' }}</th>
                            <th>{{ $translations['mode'] }}</th>
                            <th>{{ $translations['q1'] }}</th>
                            <th>{{ $translations['q2'] }}</th>
                            <th>{{ $translations['q3'] }}</th>
                            <th>{{ $translations['q4'] }}</th>
                            <th>{{ $translations['q5'] }}</th>
                            <th>{{ $translations['q6'] }}</th>
                            <th>{{ $translations['q7'] }}</th>
                            <th>{{ $translations['q8'] }}</th>
                            <th>{{ $translations['q9'] }}</th>
                            <th>{{ $translations['q10'] }}</th>
                            <th>{{ $translations['q11'] }}</th>
                            <th>{{ $translations['q12'] }}</th>
                            <th>{{ $translations['q13'] }}</th>
                            <th>{{ $translations['q14'] }}</th>
                            <th>{{ $translations['q15'] }}</th>
                            <th>{{ $translations['q16'] }}</th>
                            <th>{{ $translations['q17'] }}</th>
                            <th>{{ $translations['q18'] }}</th>
                            <th>{{ $translations['q19'] }}</th>
                            <th>{{ $translations['q20'] }}</th>
                            <th>{{ $translations['q21'] }}</th>
                            <th>{{ $translations['q22'] }}</th>
                            <th>{{ $translations['q23'] }}</th>
                            <th>{{ $translations['q24'] }}</th>
                            <th>{{ $translations['q25'] }}</th>
                            <th>{{ $translations['q26'] }}</th>
                            <th>{{ $translations['q27'] }}</th>
                            <th>{{ $translations['q28'] }}</th>
                            <th>{{ $translations['q29'] }}</th>
                            <th>{{ $translations['q30'] }}</th>
                            <th>{{ $translations['q31'] }}</th>
                            <th>{{ $translations['q32'] }}</th>
                            <th>{{ $translations['q33'] }}</th>
                            <th>{{ $translations['q34'] }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($initialRecords as $rec)
                            <tr>
                                <td>
                                    <button class="btn-action btn-delete" data-id="{{ $rec['id'] }}" data-house-no="{{ $rec['row']['house_no'] }}" title="Delete">
                                        <svg viewBox="0 0 24 24"><path d="M3 6h18"></path><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                    </button>
                                </td>
                                <td>
                                    <span class="badge-mode {{ $rec['is_shop'] ? 'shop' : 'house' }}">{{ $rec['row']['mode'] }}</span>
                                </td>
                                <td>{{ $rec['row']['line_no'] }}</td>
                                <td><strong>{{ $rec['row']['house_no'] }}</strong></td>
                                <td>{{ $rec['row']['census_house_no'] }}</td>
                                <td>{{ $rec['row']['floor_material'] }}</td>
                                <td>{{ $rec['row']['wall_material'] }}</td>
                                <td>{{ $rec['row']['roof_material'] }}</td>
                                <td>{{ $rec['row']['house_use'] }}</td>
                                <td>{{ $rec['row']['house_condition'] }}</td>
                                <td>{{ $rec['row']['household_no'] }}</td>
                                <td>{{ $rec['row']['total_members'] }}</td>
                                <td>{{ $rec['row']['head_name'] }}</td>
                                <td>{{ $rec['row']['head_gender'] }}</td>
                                <td>{{ $rec['row']['social_category'] }}</td>
                                <td>{{ $rec['row']['ownership'] }}</td>
                                <td>{{ $rec['row']['dwelling_rooms'] }}</td>
                                <td>{{ $rec['row']['married_couples'] }}</td>
                                <td>{{ $rec['row']['drinking_water'] }}</td>
                                <td>{{ $rec['row']['water_availability'] }}</td>
                                <td>{{ $rec['row']['lighting_source'] }}</td>
                                <td>{{ $rec['row']['latrine_facility'] }}</td>
                                <td>{{ $rec['row']['latrine_type'] }}</td>
                                <td>{{ $rec['row']['drainage_system'] }}</td>
                                <td>{{ $rec['row']['bathroom_facility'] }}</td>
                                <td>{{ $rec['row']['kitchen_facility'] }}</td>
                                <td>{{ $rec['row']['cooking_fuel'] }}</td>
                                <td>{{ $rec['row']['has_radio'] }}</td>
                                <td>{{ $rec['row']['has_tv'] }}</td>
                                <td>{{ $rec['row']['has_internet'] }}</td>
                                <td>{{ $rec['row']['has_pc'] }}</td>
                                <td>{{ $rec['row']['phone_type'] }}</td>
                                <td>{{ $rec['row']['vehicles'] }}</td>
                                <td>{{ $rec['row']['has_car'] }}</td>
                                <td>{{ $rec['row']['main_cereal'] }}</td>
                                <td>{{ $rec['row']['mobile_no'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                    </div>
                    <span class="empty-title" id="txt-empty-title">કોઈ ડેટા ઉપલબ્ધ નથી</span>
                    <span class="empty-desc" id="txt-empty-desc">હાલમાં કોઈ વસ્તી ગણતરી સબમિટ કરવામાં આવી નથી. કૃપા કરીને પ્રારંભ કરવા માટે ફોર્મમાં ડેટા ઉમેરો.</span>
                </div>
                @endif
            </div>
        </div>

        <!-- Trashed Records Table Card -->
        <div class="table-card" style="margin-top: 2rem;">
            <div class="table-header-panel">
                <span class="table-title" id="txt-trashed-table-title">કચરાપેટીમાં રહેલા પત્રકો (Trashed Records)</span>
            </div>
            
            <div class="table-responsive">
                <table class="data-table trashed-data-table">
                    <thead>
                        <tr>
                            <th class="actions-col">{{ $translations['actions'] ?? 'Actions' }}</th>
                            <th>{{ $translations['mode'] }}</th>
                            <th>{{ $translations['q1'] }}</th>
                            <th>{{ $translations['q2'] }}</th>
                            <th>{{ $translations['q3'] }}</th>
                            <th>{{ $translations['q4'] }}</th>
                            <th>{{ $translations['q5'] }}</th>
                            <th>{{ $translations['q6'] }}</th>
                            <th>{{ $translations['q7'] }}</th>
                            <th>{{ $translations['q8'] }}</th>
                            <th>{{ $translations['q9'] }}</th>
                            <th>{{ $translations['q10'] }}</th>
                            <th>{{ $translations['q11'] }}</th>
                            <th>{{ $translations['q12'] }}</th>
                            <th>{{ $translations['q13'] }}</th>
                            <th>{{ $translations['q14'] }}</th>
                            <th>{{ $translations['q15'] }}</th>
                            <th>{{ $translations['q16'] }}</th>
                            <th>{{ $translations['q17'] }}</th>
                            <th>{{ $translations['q18'] }}</th>
                            <th>{{ $translations['q19'] }}</th>
                            <th>{{ $translations['q20'] }}</th>
                            <th>{{ $translations['q21'] }}</th>
                            <th>{{ $translations['q22'] }}</th>
                            <th>{{ $translations['q23'] }}</th>
                            <th>{{ $translations['q24'] }}</th>
                            <th>{{ $translations['q25'] }}</th>
                            <th>{{ $translations['q26'] }}</th>
                            <th>{{ $translations['q27'] }}</th>
                            <th>{{ $translations['q28'] }}</th>
                            <th>{{ $translations['q29'] }}</th>
                            <th>{{ $translations['q30'] }}</th>
                            <th>{{ $translations['q31'] }}</th>
                            <th>{{ $translations['q32'] }}</th>
                            <th>{{ $translations['q33'] }}</th>
                            <th>{{ $translations['q34'] }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Dynamic Server-Side Content -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Confirm Modal Overlay -->
    <div id="delete-confirm-modal" class="modal-overlay">
        <div class="modal-container" style="max-width: 370px; border-radius: 16px;">
            <div class="modal-header" style="padding: 0.9rem 1.25rem 0.25rem 1.25rem; border-bottom: none; background: transparent;">
                <div class="modal-title-area">
                    <h2 class="modal-title" id="delete-modal-title">Delete Record</h2>
                    <p class="modal-subtitle" id="delete-modal-subtitle">Confirm Action</p>
                </div>
                <button type="button" class="modal-close-btn" id="delete-modal-close-btn">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body" style="gap: 0.35rem; text-align: center; padding: 0.25rem 1.25rem 0.75rem 1.25rem;">
                <div id="delete-modal-icon-container" style="width: 38px; height: 38px; border-radius: 50%; background: rgba(220, 38, 38, 0.1); color: #DC2626; display: inline-flex; align-items: center; justify-content: center; margin: 0 auto 0.1rem;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 6h18"></path><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                </div>
                <p id="delete-modal-message" style="font-size: 0.9rem; color: var(--text-title); font-weight: 700; line-height: 1.35;"></p>
                <p id="delete-modal-warning" style="font-size: 0.75rem; color: var(--text-muted); line-height: 1.3;"></p>
            </div>
            <div class="modal-footer" style="padding: 0.25rem 1.25rem 1.25rem 1.25rem; background: transparent; border-top: none; gap: 0.5rem;">
                <button type="button" class="modal-btn modal-btn-cancel" id="delete-modal-cancel-btn" style="padding: 0.4rem 1.1rem; font-size: 0.8rem; border-radius: 8px; flex: 1; justify-content: center;">Cancel</button>
                <button type="button" class="modal-btn modal-btn-submit" id="delete-modal-confirm-btn" style="padding: 0.4rem 1.1rem; font-size: 0.8rem; border-radius: 8px; flex: 1; justify-content: center;">Delete</button>
            </div>
        </div>
    </div>

    <!-- Toast Notifications Container -->
    <div class="toast-container" id="toast-container"></div>

    <script>
        // Set jQuery AJAX Setup for CSRF token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Language & UI Localization Dictionary (Matches main portal for header texts)
        const localization = {
            gu: {
                title: "વસ્તી ગણતરી ડેટા ડાઉનલોડ",
                desc: "રજિસ્ટર્ડ વસ્તી ગણતરીના પત્રકોની વિગતો અહીં જુઓ અને તેને વ્યવસ્થિત રીતે એક્સેલ શીટ અથવા A4 પ્રિન્ટ-ફ્રેન્ડલી પીડીએફ ફોર્મેટમાં ડાઉનલોડ કરો.",
                stats: "કુલ પત્રકો:",
                back: "ફોર્મ પર પાછા જાઓ",
                portal: "વસ્તી ગણતરી રજિસ્ટર",
                excel: "એક્સેલ ડાઉનલોડ (Excel)",
                pdf: "પીડીએફ ડાઉનલોડ (A4 PDF)",
                tableTitle: "તમામ નોંધણીઓ",
                emptyTitle: "કોઈ ડેટા ઉપલબ્ધ નથી",
                emptyDesc: "હાલમાં કોઈ વસ્તી ગણતરી સબમિટ કરવામાં આવી નથી. કૃપા કરીને પ્રારંભ કરવા માટે ફોર્મમાં ડેટા ઉમેરો.",
                trashedTableTitle: "કચરાપેટીમાં રહેલા પત્રકો (Trashed Records)",
                logout: "લૉગ આઉટ"
            },
            hi: {
                title: "जनगणना डेटा डाउनलोड",
                desc: "पंजीकृत जनगणना प्रपत्रों का विवरण यहाँ देखें और इसे व्यवस्थित रूप से एक्सेल शीट या A4 प्रिंट-अनुकूल पीडीएफ प्रारूप में डाउनलोड करें।",
                stats: "कुल प्रपत्र:",
                back: "फ़ॉर्म पर वापस जाएँ",
                portal: "जनगणना रजिस्टर",
                excel: "एक्सेल डाउनलोड करें (Excel)",
                pdf: "पीडीएफ डाउनलोड करें (A4 PDF)",
                tableTitle: "सभी प्रविष्टियां",
                emptyTitle: "कोई डेटा उपलब्ध नहीं है",
                emptyDesc: "वर्तमान में कोई जनगणना प्रपत्र जमा नहीं किया गया है। कृपया प्रारंभ करने के लिए फ़ॉर्म में डेटा जोड़ें।",
                trashedTableTitle: "हटाए गए रिकॉर्ड्स (Trashed Records)",
                logout: "लॉग आउट"
            },
            en: {
                title: "Download Census Data",
                desc: "View the records of all registered census submissions and download them in a clean Excel spreadsheet or print-ready A4 PDF format.",
                stats: "Total Submissions:",
                back: "Back to Form",
                portal: "Census Registry",
                excel: "Download Excel Spreadsheet",
                pdf: "Download A4 PDF Report",
                tableTitle: "All Submissions",
                emptyTitle: "No Data Available",
                emptyDesc: "No census submissions have been recorded yet. Please add data in the census form to get started.",
                trashedTableTitle: "Trashed Records (Trash Bin)",
                logout: "Logout"
            }
        };

        const deleteLocalization = {
            gu: {
                trashTitle: "પત્રક રદ કરો?",
                trashSubtitle: "કચરાપેટીમાં ખસેડો",
                trashWarning: "નોંધ: આ પત્રકને ટ્રેશ્ડ રેકોર્ડ્સમાં ખસેડવામાં આવશે અને તમે તેને પછીથી પણ પુનઃસ્થાપિત કરી શકો છો.",
                trashConfirm: "ડિલીટ કરો",
                trashMessage: "શું તમે ખરેખર ઘર નંબર <strong>{houseNo}</strong> નું આ પત્રક કચરાપેટીમાં ખસેડવા માંગો છો?",
                
                forceTitle: "કાયમી માટે કાઢી નાખો?",
                forceSubtitle: "આ ક્રિયા પાછી ખેંચી શકાશે નહીં",
                forceWarning: "ચેતવણી: આ પત્રક ડેટાબેઝમાંથી કાયમ માટે કાઢી નાખવામાં આવશે. આ ક્રિયા ક્યારેય પાછી ખેંચી શકાશે નહીં!",
                forceConfirm: "કાયમી ડિલીટ કરો",
                forceMessage: "શું તમે ખરેખર ઘર નંબર <strong>{houseNo}</strong> ના આ પત્રકને કાયમી માટે ડિલીટ કરવા માંગો છો?",
                
                cancel: "રદ કરો",
                restoreSuccess: "પત્રક સફળતાપૂર્વક પુનઃસ્થાપિત કરવામાં આવ્યું છે!",
                trashSuccess: "પત્રક કચરાપેટીમાં ખસેડવામાં આવ્યું છે!",
                forceSuccess: "પત્રક કાયમી માટે ડિલીટ કરવામાં આવ્યું છે!"
            },
            hi: {
                trashTitle: "प्रविष्टि हटाएं?",
                trashSubtitle: "कचरा पेटी (Trash) में ले जाएं",
                trashWarning: "नोट: इस प्रविष्टि को हटाए गए रिकॉर्ड्स में स्थानांतरित किया जाएगा और आप इसे बाद में पुनर्स्थापित कर सकते हैं।",
                trashConfirm: "हटाएं",
                trashMessage: "क्या आप वास्तव में मकान नंबर <strong>{houseNo}</strong> की इस जनगणना प्रविष्टि को कचरा पेटी में ले जाना चाहते हैं?",
                
                forceTitle: "स्थायी रूप से हटाएं?",
                forceSubtitle: "यह क्रिया वापस नहीं ली जा सकती",
                forceWarning: "चेतावनी: यह प्रविष्टि डेटाबेस से स्थायी रूप से हटा दी जाएगी। यह क्रिया कभी वापस नहीं ली जा सकती!",
                forceConfirm: "स्थायी रूप से हटाएं",
                forceMessage: "क्या आप वास्तव में मकान नंबर <strong>{houseNo}</strong> की इस जनगणना प्रविष्टि को स्थायी रूप से हटाना चाहते हैं?",
                
                cancel: "रद्द करें",
                restoreSuccess: "प्रविष्टि को सफलतापूर्वक पुनर्स्थापित कर दिया गया है!",
                trashSuccess: "प्रविष्टि को कचरा पेटी में स्थानांतरित कर दिया गया है!",
                forceSuccess: "प्रविष्टि को स्थायी रूप से हटा दिया गया है!"
            },
            en: {
                trashTitle: "Move to Trash?",
                trashSubtitle: "Soft Delete Record",
                trashWarning: "Note: This record will be moved to the trashed list and can be restored later.",
                trashConfirm: "Move to Trash",
                trashMessage: "Are you sure you want to move the census record for House No. <strong>{houseNo}</strong> to trash?",
                
                forceTitle: "Delete Permanently?",
                forceSubtitle: "Action Cannot Be Undone",
                forceWarning: "Warning: This record will be permanently purged from the database. This action is irreversible!",
                forceConfirm: "Delete Permanently",
                forceMessage: "Are you sure you want to permanently delete the census record for House No. <strong>{houseNo}</strong>?",
                
                cancel: "Cancel",
                restoreSuccess: "Record restored successfully!",
                trashSuccess: "Record moved to trash successfully!",
                forceSuccess: "Record deleted permanently!"
            }
        };

        // Theme Engine
        const themeButtons = document.querySelectorAll('[data-theme-val]');
        function setTheme(theme) {
            themeButtons.forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll(`[data-theme-val="${theme}"]`).forEach(btn => btn.classList.add('active'));
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

        // Language Changer Engine
        const langButtons = document.querySelectorAll('[data-lang]');
        let currentLang = '{{ $currentLang }}';

        function updateUILanguage(lang) {
            currentLang = lang;
            localStorage.setItem('user-lang', lang);
            document.documentElement.setAttribute('lang', lang);

            document.querySelectorAll('[data-lang]').forEach(btn => {
                btn.classList.remove('active');
                if (btn.getAttribute('data-lang') === lang) {
                    btn.classList.add('active');
                }
            });

            // Translate static elements using localization dictionary
            const dict = localization[lang] || localization['gu'];
            
            const elMapping = {
                'txt-title': dict.title,
                'txt-desc': dict.desc,
                'txt-stats': dict.stats,
                'txt-back': dict.back,
                'txt-portal': dict.portal,
                'txt-table-title': dict.tableTitle,
                'txt-empty-title': dict.emptyTitle,
                'txt-empty-desc': dict.emptyDesc,
                'txt-trashed-table-title': dict.trashedTableTitle,
                'txt-logout': dict.logout
            };

            for (const [id, val] of Object.entries(elMapping)) {
                const el = document.getElementById(id);
                if (el) el.textContent = val;
            }

            const excelLabel = document.querySelector('#btn-excel span');
            if (excelLabel) excelLabel.textContent = dict.excel;

            const pdfLabel = document.querySelector('#btn-pdf span');
            if (pdfLabel) pdfLabel.textContent = dict.pdf;
        }

        document.querySelectorAll('[data-lang]').forEach(btn => {
            btn.addEventListener('click', () => {
                const selectedLang = btn.getAttribute('data-lang');
                
                // Redirect to reload the page with new language so headers translate in backend PHP
                window.location.href = `/download-data?lang=${selectedLang}`;
            });
        });

        // Initialize UI translation mapping
        updateUILanguage(currentLang);

        // Toast Helper
        function showToast(title, message, type = 'success') {
            const toastContainer = document.getElementById('toast-container');
            if (!toastContainer) return;

            const toast = document.createElement('div');
            toast.className = `toast-card ${type}`;
            
            const iconSvg = type === 'success' 
                ? '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>'
                : '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>';

            toast.innerHTML = `
                <div class="toast-icon">${iconSvg}</div>
                <div class="toast-content">
                    <span class="toast-title">${title}</span>
                    <span class="toast-message">${message}</span>
                </div>
                <button class="toast-close-btn">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
                <div class="toast-progress"></div>
            `;

            toastContainer.appendChild(toast);
            
            // Trigger animation
            setTimeout(() => toast.classList.add('show'), 50);

            // Setup auto close
            const timer = setTimeout(() => closeToast(toast), 4000);

            toast.querySelector('.toast-close-btn').addEventListener('click', () => {
                clearTimeout(timer);
                closeToast(toast);
            });
        }

        function closeToast(toast) {
            toast.classList.remove('show');
            toast.classList.add('hide');
            toast.addEventListener('transitionend', () => {
                toast.remove();
            });
        }

        // Initialize DataTables with dynamic localization
        $(document).ready(function() {
            let dtLang = {};
            if (currentLang === 'gu') {
                dtLang = {
                    search: "શોધો:",
                    lengthMenu: "દર્શાવો _MENU_ પત્રકો",
                    info: "કુલ _TOTAL_ માંથી _START_ થી _END_ પત્રકો દર્શાવે છે",
                    infoEmpty: "કોઈ પત્રક મળ્યું નથી",
                    infoFiltered: "(કુલ _MAX_ માંથી ફિલ્ટર કરેલ)",
                    zeroRecords: "કોઈ મેળ ખાતા પત્રકો મળ્યા નથી",
                    paginate: {
                        first: "પ્રથમ",
                        previous: "પાછળ",
                        next: "આગળ",
                        last: "અંતિમ"
                    }
                };
            } else if (currentLang === 'hi') {
                dtLang = {
                    search: "खोजें:",
                    lengthMenu: "दर्शाएं _MENU_ प्रविष्टियां",
                    info: "कुल _TOTAL_ में से _START_ से _END_ प्रविष्टियां दर्शा रहा है",
                    infoEmpty: "कोई प्रविष्टि नहीं मिली",
                    infoFiltered: "(कुल _MAX_ में से फ़िल्टर किया गया)",
                    zeroRecords: "कोई मेल खाती प्रविष्टियां नहीं मिलीं",
                    paginate: {
                        first: "प्रथम",
                        previous: "पीछे",
                        next: "आगे",
                        last: "अंतिम"
                    }
                };
            } else {
                dtLang = {
                    search: "Search:",
                    lengthMenu: "Show _MENU_ entries",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    infoEmpty: "Showing 0 to 0 of 0 entries",
                    infoFiltered: "(filtered from _MAX_ total entries)",
                    zeroRecords: "No matching records found",
                    paginate: {
                        first: "First",
                        previous: "Previous",
                        next: "Next",
                        last: "Last"
                    }
                };
            }

            // 1. Initialize Active Submissions DataTable
            const activeTable = $('.data-table:not(.trashed-data-table)').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/download-data',
                    type: 'GET',
                    data: function(d) {
                        d.lang = currentLang;
                    },
                    error: function(xhr, error, thrown) {
                        console.error('DataTable AJAX error:', error, thrown, xhr.responseText);
                    }
                },
                language: dtLang,
                pageLength: 10,
                ordering: true,
                order: [[0, 'desc']],
                columnDefs: [
                    { orderable: false, targets: 0 } // First column (Actions) is not orderable
                ],
                scrollX: false,
                deferLoading: {{ $rawRecordsCount }}
            });

            // 2. Initialize Trashed Submissions DataTable
            const trashedTable = $('.trashed-data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/download-data',
                    type: 'GET',
                    data: function(d) {
                        d.lang = currentLang;
                        d.only_trashed = 1;
                    },
                    error: function(xhr, error, thrown) {
                        console.error('DataTable AJAX error:', error, thrown, xhr.responseText);
                    }
                },
                language: dtLang,
                pageLength: 10,
                ordering: true,
                order: [[0, 'desc']],
                columnDefs: [
                    { orderable: false, targets: 0 } // First column (Actions) is not orderable
                ],
                scrollX: false
            });

            // Modal elements
            const deleteModal = document.getElementById('delete-confirm-modal');
            const deleteModalCloseBtn = document.getElementById('delete-modal-close-btn');
            const deleteModalCancelBtn = document.getElementById('delete-modal-cancel-btn');
            const deleteModalConfirmBtn = document.getElementById('delete-modal-confirm-btn');
            const deleteModalTitle = document.getElementById('delete-modal-title');
            const deleteModalSubtitle = document.getElementById('delete-modal-subtitle');
            const deleteModalMessage = document.getElementById('delete-modal-message');
            const deleteModalWarning = document.getElementById('delete-modal-warning');
            const deleteModalIconContainer = document.getElementById('delete-modal-icon-container');

            let currentAction = null; // 'delete' or 'force'
            let currentRecordId = null;

            function openModal(action, id, houseNo) {
                currentAction = action;
                currentRecordId = id;

                const text = deleteLocalization[currentLang] || deleteLocalization['en'];

                // Apply text and styles depending on the type of deletion
                if (action === 'delete') {
                    deleteModalTitle.textContent = text.trashTitle;
                    deleteModalSubtitle.textContent = text.trashSubtitle;
                    deleteModalMessage.innerHTML = text.trashMessage.replace('{houseNo}', houseNo);
                    deleteModalWarning.textContent = text.trashWarning;
                    deleteModalConfirmBtn.textContent = text.trashConfirm;
                    
                    deleteModalConfirmBtn.style.backgroundColor = ''; // remove inline overrides
                    deleteModalConfirmBtn.classList.remove('modal-btn-dark-red');
                    deleteModalConfirmBtn.classList.add('modal-btn-red');
                    
                    deleteModalIconContainer.style.color = '#DC2626';
                    deleteModalIconContainer.style.backgroundColor = 'rgba(220, 38, 38, 0.1)';
                } else if (action === 'force') {
                    deleteModalTitle.textContent = text.forceTitle;
                    deleteModalSubtitle.textContent = text.forceSubtitle;
                    deleteModalMessage.innerHTML = text.forceMessage.replace('{houseNo}', houseNo);
                    deleteModalWarning.textContent = text.forceWarning;
                    deleteModalConfirmBtn.textContent = text.forceConfirm;
                    
                    deleteModalConfirmBtn.style.backgroundColor = ''; // remove inline overrides
                    deleteModalConfirmBtn.classList.remove('modal-btn-red');
                    deleteModalConfirmBtn.classList.add('modal-btn-dark-red');
                    
                    deleteModalIconContainer.style.color = '#EF4444';
                    deleteModalIconContainer.style.backgroundColor = 'rgba(239, 68, 68, 0.12)';
                }

                deleteModalCancelBtn.textContent = text.cancel;
                deleteModal.classList.add('active');
            }

            function closeModal() {
                deleteModal.classList.remove('active');
                currentAction = null;
                currentRecordId = null;
            }

            deleteModalCloseBtn.addEventListener('click', closeModal);
            deleteModalCancelBtn.addEventListener('click', closeModal);

            // Close modal when clicking outside container
            deleteModal.addEventListener('click', (e) => {
                if (e.target === deleteModal) {
                    closeModal();
                }
            });

            // Handle confirm click
            deleteModalConfirmBtn.addEventListener('click', () => {
                if (!currentRecordId || !currentAction) return;

                // Disable button and show loader spinner
                deleteModalConfirmBtn.disabled = true;
                const originalText = deleteModalConfirmBtn.textContent;
                deleteModalConfirmBtn.innerHTML = '<span class="spinner"></span>';

                let requestUrl = '';
                let requestType = '';

                if (currentAction === 'delete') {
                    requestUrl = `/census/${currentRecordId}`;
                    requestType = 'DELETE';
                } else if (currentAction === 'force') {
                    requestUrl = `/census/${currentRecordId}/force`;
                    requestType = 'DELETE';
                }

                $.ajax({
                    url: requestUrl,
                    type: requestType,
                    success: function(response) {
                        closeModal();
                        deleteModalConfirmBtn.disabled = false;
                        deleteModalConfirmBtn.textContent = originalText;

                        if (response.success) {
                            // Reload tables
                            activeTable.ajax.reload(null, false);
                            trashedTable.ajax.reload(null, false);

                            // Update counts in badges
                            if (response.counts) {
                                $('#active-records-count').text(response.counts.active);
                                $('#trashed-records-count').text(response.counts.trashed);
                            }

                            // Show toast
                            const text = deleteLocalization[currentLang] || deleteLocalization['en'];
                            const toastTitle = currentLang === 'gu' ? 'સફળતા' : currentLang === 'hi' ? 'सफलता' : 'Success';
                            const toastMsg = currentAction === 'delete' ? text.trashSuccess : text.forceSuccess;
                            showToast(toastTitle, toastMsg, 'success');
                        } else {
                            showToast('Error', response.message || 'Operation failed.', 'error');
                        }
                    },
                    error: function(xhr) {
                        closeModal();
                        deleteModalConfirmBtn.disabled = false;
                        deleteModalConfirmBtn.textContent = originalText;
                        const errorMsg = xhr.responseJSON ? xhr.responseJSON.message : 'Something went wrong.';
                        showToast('Error', errorMsg, 'error');
                    }
                });
            });

            // Hook up action button listeners (Using delegation because rows are dynamic)
            
            // Delete record
            $('body').on('click', '.btn-delete', function() {
                const id = $(this).data('id');
                const houseNo = $(this).data('house-no') || $(this).closest('tr').find('td').eq(3).text().trim();
                openModal('delete', id, houseNo);
            });

            // Force delete record
            $('body').on('click', '.btn-force-delete', function() {
                const id = $(this).data('id');
                const houseNo = $(this).data('house-no') || $(this).closest('tr').find('td').eq(3).text().trim();
                openModal('force', id, houseNo);
            });

            // Restore record
            $('body').on('click', '.btn-restore', function() {
                const id = $(this).data('id');
                const btn = $(this);
                
                // Disable button and animate
                btn.prop('disabled', true);
                btn.html('<span class="spinner" style="width: 12px; height: 12px;"></span>');

                $.ajax({
                    url: `/census/${id}/restore`,
                    type: 'POST',
                    success: function(response) {
                        if (response.success) {
                            activeTable.ajax.reload(null, false);
                            trashedTable.ajax.reload(null, false);

                            if (response.counts) {
                                $('#active-records-count').text(response.counts.active);
                                $('#trashed-records-count').text(response.counts.trashed);
                            }

                            const text = deleteLocalization[currentLang] || deleteLocalization['en'];
                            const toastTitle = currentLang === 'gu' ? 'સફળતા' : currentLang === 'hi' ? 'सफलता' : 'Success';
                            showToast(toastTitle, text.restoreSuccess, 'success');
                        } else {
                            btn.prop('disabled', false);
                            btn.html('<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="23 4 23 10 17 10"></polyline><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path></svg>');
                            showToast('Error', response.message || 'Restore failed.', 'error');
                        }
                    },
                    error: function(xhr) {
                        btn.prop('disabled', false);
                        btn.html('<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="23 4 23 10 17 10"></polyline><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path></svg>');
                        const errorMsg = xhr.responseJSON ? xhr.responseJSON.message : 'Restore failed.';
                        showToast('Error', errorMsg, 'error');
                    }
                });
            });
        });
    </script>


    <script>
        // Toggle profile floating menu
        const profileTrigger = document.getElementById('profile-trigger');
        const profileMenu = document.getElementById('profile-menu');
        if (profileTrigger && profileMenu) {
            profileTrigger.addEventListener('click', (e) => {
                e.stopPropagation();
                profileMenu.classList.toggle('show');
            });
            document.addEventListener('click', (e) => {
                if (!profileMenu.contains(e.target) && e.target !== profileTrigger) {
                    profileMenu.classList.remove('show');
                }
            });
        }

        // Auto-refresh CSRF token and keep session alive in the background
        function keepSessionAlive() {
            fetch('/session-keep-alive')
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    }
                    throw new Error('Keep alive request failed');
                })
                .then(data => {
                    const newToken = data.token;
                    
                    // Update CSRF token in meta tag
                    const metaToken = document.querySelector('meta[name="csrf-token"]');
                    if (metaToken) {
                        metaToken.setAttribute('content', newToken);
                    }
                    
                    // Update CSRF token in all form hidden inputs
                    document.querySelectorAll('input[name="_token"]').forEach(input => {
                        input.value = newToken;
                        input.defaultValue = newToken;
                    });

                    // Update jQuery AJAX setup
                    if (window.$ && $.ajaxSetup) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': newToken
                            }
                        });
                    }
                })
                .catch(error => {
                    console.error('Error keeping session alive:', error);
                });
        }

        // Ping every 10 minutes (600,000 milliseconds)
        setInterval(keepSessionAlive, 600000);
    </script>
</body>
</html>
