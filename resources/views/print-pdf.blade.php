<!DOCTYPE html>
<html lang="{{ $currentLang }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>વસ્તી ગણતરી પત્રક - પ્રિન્ટ રિપોર્ટ | Census Report</title>
    <!-- Google Fonts for local scripts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Gujarati:wght@400;700&family=Noto+Sans:wght@400;700&display=swap" rel="stylesheet">
    <style>
        @page {
            size: A4 landscape;
            margin: 10mm 6mm 12mm 6mm;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Noto Sans Gujarati', 'Noto Sans', sans-serif;
            font-size: 6.5px;
            color: #111111;
            background-color: #ffffff;
            line-height: 1.1;
            padding-bottom: 5mm; /* space for fixed footer */
        }

        .report-header {
            width: 100%;
            margin-bottom: 5px;
            border-bottom: 1px solid #111111;
            padding-bottom: 5px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }

        .header-title h1 {
            font-size: 11px;
            font-weight: 700;
            color: #000000;
            text-transform: uppercase;
        }

        .header-title p {
            font-size: 7px;
            color: #444444;
            margin-top: 1px;
        }

        .header-meta {
            text-align: right;
            font-size: 7px;
            color: #333333;
        }

        /* Print Table Styles */
        table.print-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        table.print-table thead {
            display: table-header-group;
        }

        table.print-table tr {
            page-break-inside: avoid;
        }

        table.print-table th {
            background-color: #e5e5e5;
            color: #000000;
            font-weight: bold;
            font-size: 7.8px;
            line-height: 1.0;
            text-align: center;
            vertical-align: middle;
            border: 0.5px solid #111111;
            padding: 4px 0.5px;
            word-wrap: break-word;
            white-space: normal;
        }

        table.print-table td {
            border: 0.5px solid #111111;
            padding: 2.5px 1px;
            text-align: center;
            vertical-align: middle;
            word-wrap: break-word;
            white-space: normal;
            font-size: 5.8px;
        }

        table.print-table tr:nth-child(even) td {
            background-color: #fafafa;
        }

        /* Bold House No */
        .house-no-cell {
            font-weight: 700;
        }

        /* Highlight mode */
        .badge-mode {
            text-transform: uppercase;
            font-weight: 700;
            font-size: 5px;
        }

        /* Printing Footer (Page numbers) */
        .print-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            display: flex;
            justify-content: space-between;
            font-size: 6px;
            color: #555555;
            border-top: 0.3px solid #666666;
            padding-top: 2px;
            background-color: #ffffff;
        }

        .page-num::after {
            content: "Page " counter(page);
        }

        /* Hide Print controls on print media */
        .print-controls {
            position: fixed;
            top: 10px;
            right: 10px;
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid #ccc;
            padding: 8px 12px;
            border-radius: 6px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            z-index: 9999;
            display: flex;
            gap: 8px;
        }

        .btn-print-action {
            background: #2437F4;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 8px;
            font-weight: bold;
            cursor: pointer;
        }
        .btn-print-action.cancel {
            background: #666;
        }

        @media print {
            .print-controls {
                display: none !important;
            }
            body {
                padding-bottom: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Print action controls overlay (visible in preview, hidden during actual print) -->
    <div class="print-controls">
        <button class="btn-print-action" onclick="window.print()">{{ $currentLang === 'en' ? 'Print Report' : ($currentLang === 'hi' ? 'प्रिंट करें' : 'પ્રિન્ટ કરો') }}</button>
        <button class="btn-print-action cancel" onclick="window.close()">{{ $currentLang === 'en' ? 'Close Window' : ($currentLang === 'hi' ? 'बंद करें' : 'બંધ કરો') }}</button>
    </div>

    <!-- Report Header -->
    <div class="report-header">
        <div class="header-title">
            @if($currentLang === 'gu')
                <h1>વસ્તી ગણતરી રજિસ્ટર પત્રક (૩૪ પ્રશ્નોની નોંધણી)</h1>
                <p>રાષ્ટ્રીય જનગણના પત્રક વિગતો - કલેક્ટર કચેરી પોર્ટલ રિપોર્ટ</p>
            @elseif($currentLang === 'hi')
                <h1>जनगणना रजिस्टर प्रपत्र (३४ प्रश्नों की प्रविष्टि)</h1>
                <p>राष्ट्रीय जनगणना प्रपत्र विवरण - जिला कलेक्टर कार्यालय रिपोर्ट</p>
            @else
                <h1>National Census Register Sheet (34 Questions Records)</h1>
                <p>National Census Survey Records - Administration Registry Report</p>
            @endif
        </div>
        <div class="header-meta">
            @if($currentLang === 'gu')
                <div>પ્રિન્ટ તારીખ: {{ date('d-m-Y H:i') }}</div>
                <div>કુલ રેકોર્ડ્સ: <strong>{{ count($records) }}</strong></div>
            @elseif($currentLang === 'hi')
                <div>प्रिंट तिथि: {{ date('d-m-Y H:i') }}</div>
                <div>कुल रिकॉर्ड: <strong>{{ count($records) }}</strong></div>
            @else
                <div>Printed On: {{ date('d-m-Y H:i') }}</div>
                <div>Total Records: <strong>{{ count($records) }}</strong></div>
            @endif
        </div>
    </div>

    <!-- Data Table -->
    <table class="print-table">
        <!-- Define column widths strictly for landscape page fitting -->
        <colgroup>
            <col style="width: 2.8%;"> <!-- Mode -->
            <col style="width: 2%;"> <!-- Q1: Line No -->
            <col style="width: 2.5%;"> <!-- Q2: House No -->
            <col style="width: 3%;"> <!-- Q3: Census House No -->
            <col style="width: 2.5%;"> <!-- Q4: Floor Material -->
            <col style="width: 3.2%;"> <!-- Q5: Wall Material -->
            <col style="width: 2.8%;"> <!-- Q6: Roof Material -->
            <col style="width: 3.2%;"> <!-- Q7: Use -->
            <col style="width: 2.5%;"> <!-- Q8: Condition -->
            <col style="width: 2%;"> <!-- Q9: Household No -->
            <col style="width: 1.8%;"> <!-- Q10: Total Persons -->
            <col style="width: 6.8%;"> <!-- Q11: Head Name -->
            <col style="width: 2.5%;"> <!-- Q12: Gender -->
            <col style="width: 2.5%;"> <!-- Q13: Social Cat -->
            <col style="width: 3.2%;"> <!-- Q14: Ownership -->
            <col style="width: 2%;"> <!-- Q15: Dwelling Rooms -->
            <col style="width: 2%;"> <!-- Q16: Couples -->
            <col style="width: 3.8%;"> <!-- Q17: Water Source -->
            <col style="width: 3%;"> <!-- Q18: Water Avail -->
            <col style="width: 2.5%;"> <!-- Q19: Light -->
            <col style="width: 3%;"> <!-- Q20: Latrine Fac -->
            <col style="width: 3%;"> <!-- Q21: Latrine Type -->
            <col style="width: 3.2%;"> <!-- Q22: Drainage -->
            <col style="width: 2%;"> <!-- Q23: Bath -->
            <col style="width: 2%;"> <!-- Q24: Kitchen -->
            <col style="width: 3.2%;"> <!-- Q25: Fuel -->
            <col style="width: 1.8%;"> <!-- Q26: Radio -->
            <col style="width: 1.8%;"> <!-- Q27: TV -->
            <col style="width: 1.8%;"> <!-- Q28: Internet -->
            <col style="width: 1.8%;"> <!-- Q29: PC -->
            <col style="width: 3.2%;"> <!-- Q30: Phone -->
            <col style="width: 3.5%;"> <!-- Q31: Vehicle -->
            <col style="width: 1.8%;"> <!-- Q32: Car -->
            <col style="width: 2.5%;"> <!-- Q33: Cereal -->
            <col style="width: 4%;"> <!-- Q34: Mobile -->
        </colgroup>
        <thead>
            <tr>
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
            @foreach($records as $row)
            <tr>
                <td>
                    <span class="badge-mode">
                        {{ $row['mode'] }}
                    </span>
                </td>
                <td>{{ $row['line_no'] }}</td>
                <td class="house-no-cell">{{ $row['house_no'] }}</td>
                <td>{{ $row['census_house_no'] }}</td>
                <td>{{ $row['floor_material'] }}</td>
                <td>{{ $row['wall_material'] }}</td>
                <td>{{ $row['roof_material'] }}</td>
                <td>{{ $row['house_use'] }}</td>
                <td>{{ $row['house_condition'] }}</td>
                <td>{{ $row['household_no'] }}</td>
                <td>{{ $row['total_members'] }}</td>
                <td><strong>{{ $row['head_name'] }}</strong></td>
                <td>{{ $row['head_gender'] }}</td>
                <td>{{ $row['social_category'] }}</td>
                <td>{{ $row['ownership'] }}</td>
                <td>{{ $row['dwelling_rooms'] }}</td>
                <td>{{ $row['married_couples'] }}</td>
                <td>{{ $row['drinking_water'] }}</td>
                <td>{{ $row['water_availability'] }}</td>
                <td>{{ $row['lighting_source'] }}</td>
                <td>{{ $row['latrine_facility'] }}</td>
                <td>{{ $row['latrine_type'] }}</td>
                <td>{{ $row['drainage_system'] }}</td>
                <td>{{ $row['bathroom_facility'] }}</td>
                <td>{{ $row['kitchen_facility'] }}</td>
                <td>{{ $row['cooking_fuel'] }}</td>
                <td>{{ $row['has_radio'] }}</td>
                <td>{{ $row['has_tv'] }}</td>
                <td>{{ $row['has_internet'] }}</td>
                <td>{{ $row['has_pc'] }}</td>
                <td>{{ $row['phone_type'] }}</td>
                <td>{{ $row['vehicles'] }}</td>
                <td>{{ $row['has_car'] }}</td>
                <td>{{ $row['main_cereal'] }}</td>
                <td>{{ $row['mobile_no'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Page numbers and report footer -->
    <div class="print-footer">
        @if($currentLang === 'gu')
            <span>વસ્તી ગણતરી રજિસ્ટર પત્રક - જિલ્લા જનગણના કમિશનર ઑફિસ</span>
            <span>ભાષા: ગુજરાતી (GU)</span>
        @elseif($currentLang === 'hi')
            <span>जनगणना रजिस्टर शीट - जिला जनगणना आयुक्त कार्यालय</span>
            <span>भाषा: हिन्दी (HI)</span>
        @else
            <span>Census Registry Sheet - District Census Commissioner Office</span>
            <span>Language: English (EN)</span>
        @endif
        <span class="page-num"></span>
    </div>

    <script>
        // Automatic trigger for browser's print dialog on load
        window.addEventListener('DOMContentLoaded', () => {
            // Give layout a small duration to settle down before print dialog triggers
            setTimeout(() => {
                window.print();
            }, 500);
        });
    </script>
</body>
</html>
