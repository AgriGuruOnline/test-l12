<?php

namespace App\Http\Controllers;

use App\Http\Requests\CensusRecordStoreRequest;
use App\Http\Requests\CensusRecordUpdateRequest;
use App\Http\Resources\CensusRecordResource;
use App\Services\CensusRecordService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

/**
 * Class CensusRecordController
 * 
 * Handles CRUD HTTP requests for Census Records.
 * 
 * @package App\Http\Controllers
 */
class CensusRecordController extends Controller
{
    /**
     * The service instance.
     * 
     * @var CensusRecordService
     */
    protected $service;

    /**
     * CensusRecordController constructor.
     * 
     * @param CensusRecordService $service
     */
    public function __construct(CensusRecordService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the census records.
     * 
     * GET /census
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $perPage = $request->query('per_page', 15);
            $records = $this->service->getPaginatedRecords((int) $perPage);
            
            return response()->json([
                'success' => true,
                'message' => 'Census records retrieved successfully.',
                'data' => CensusRecordResource::collection($records),
                'meta' => [
                    'current_page' => $records->currentPage(),
                    'last_page' => $records->lastPage(),
                    'per_page' => $records->perPage(),
                    'total' => $records->total(),
                ]
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve census records.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Check if a record exists for a given house number and mode.
     * 
     * GET /census/check-house
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function checkHouse(Request $request): JsonResponse
    {
        try {
            $houseNo = $request->query('house_no');
            $mode = $request->query('mode', 'house');

            if (empty($houseNo)) {
                return response()->json([
                    'success' => false,
                    'message' => 'House number is required.'
                ], 400);
            }

            $record = $this->service->getRecordByHouseNo($houseNo, $mode);

            return response()->json([
                'success' => true,
                'found' => (bool) $record,
                'data' => $record ? new CensusRecordResource($record) : null
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to check house number.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created census record in storage.
     * 
     * POST /census
     *
     * @param CensusRecordStoreRequest $request
     * @return JsonResponse
     */
    public function store(CensusRecordStoreRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();
            $record = $this->service->createRecord($validated);

            return response()->json([
                'success' => true,
                'message' => 'Census record created successfully.',
                'data' => new CensusRecordResource($record)
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create census record.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified census record.
     * 
     * GET /census/{id}
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $record = $this->service->getRecordById($id);

            if (!$record) {
                return response()->json([
                    'success' => false,
                    'message' => 'Census record not found.'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Census record details retrieved successfully.',
                'data' => new CensusRecordResource($record)
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve census record details.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified census record in storage.
     * 
     * PUT/PATCH /census/{id}
     *
     * @param CensusRecordUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(CensusRecordUpdateRequest $request, int $id): JsonResponse
    {
        try {
            $validated = $request->validated();
            $record = $this->service->updateRecord($id, $validated);

            if (!$record) {
                return response()->json([
                    'success' => false,
                    'message' => 'Census record not found.'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Census record updated successfully.',
                'data' => new CensusRecordResource($record)
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update census record.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified census record from storage.
     * 
     * DELETE /census/{id}
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $deleted = $this->service->deleteRecord($id);

            if (!$deleted) {
                return response()->json([
                    'success' => false,
                    'message' => 'Census record not found or could not be deleted.'
                ], 404);
            }

            $activeCount = \App\Models\CensusRecord::count();
            $trashedCount = \App\Models\CensusRecord::onlyTrashed()->count();

            return response()->json([
                'success' => true,
                'message' => 'Census record deleted successfully.',
                'counts' => [
                    'active' => $activeCount,
                    'trashed' => $trashedCount
                ]
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete census record.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Restore the specified soft-deleted census record.
     *
     * POST /census/{id}/restore
     *
     * @param int $id
     * @return JsonResponse
     */
    public function restore(int $id): JsonResponse
    {
        try {
            $restored = $this->service->restoreRecord($id);

            if (!$restored) {
                return response()->json([
                    'success' => false,
                    'message' => 'Census record not found in trash or could not be restored.'
                ], 404);
            }

            $activeCount = \App\Models\CensusRecord::count();
            $trashedCount = \App\Models\CensusRecord::onlyTrashed()->count();

            return response()->json([
                'success' => true,
                'message' => 'Census record restored successfully.',
                'counts' => [
                    'active' => $activeCount,
                    'trashed' => $trashedCount
                ]
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to restore census record.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Permanently delete the specified soft-deleted census record.
     *
     * DELETE /census/{id}/force
     *
     * @param int $id
     * @return JsonResponse
     */
    public function forceDelete(int $id): JsonResponse
    {
        try {
            $deleted = $this->service->forceDeleteRecord($id);

            if (!$deleted) {
                return response()->json([
                    'success' => false,
                    'message' => 'Census record not found in trash or could not be permanently deleted.'
                ], 404);
            }

            $activeCount = \App\Models\CensusRecord::count();
            $trashedCount = \App\Models\CensusRecord::onlyTrashed()->count();

            return response()->json([
                'success' => true,
                'message' => 'Census record deleted permanently.',
                'counts' => [
                    'active' => $activeCount,
                    'trashed' => $trashedCount
                ]
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to permanently delete census record.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the download page listing all census records.
     *
     * GET /download-data
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function downloadPage(Request $request)
    {
        $lang = $request->query('lang', 'gu');
        if (!in_array($lang, ['gu', 'hi', 'en'])) {
            $lang = 'gu';
        }
        
        // If it's an AJAX call or Datatable data call:
        if ($request->ajax() || $request->wantsJson() || $request->has('draw') || $request->query('draw') !== null) {
            $draw = intval($request->query('draw', 1));
            $start = intval($request->query('start', 0));
            $length = intval($request->query('length', 10));
            $searchValue = $request->query('search')['value'] ?? '';
            $orderColumnIdx = intval($request->query('order')[0]['column'] ?? 0);
            $orderDir = $request->query('order')[0]['dir'] ?? 'desc';
            if (!in_array($orderDir, ['asc', 'desc'])) {
                $orderDir = 'desc';
            }

            // Columns mapping to DB fields matching table structure exactly, shifted by 1 for Actions
            $columns = [
                0 => 'id',
                1 => 'mode',
                2 => 'line_no',
                3 => 'house_no',
                4 => 'census_house_no',
                5 => 'floor_material',
                6 => 'wall_material',
                7 => 'roof_material',
                8 => 'house_use',
                9 => 'house_condition',
                10 => 'household_no',
                11 => 'total_members',
                12 => 'head_name',
                13 => 'head_gender',
                14 => 'social_category',
                15 => 'ownership',
                16 => 'dwelling_rooms',
                17 => 'married_couples',
                18 => 'drinking_water',
                19 => 'water_availability',
                20 => 'lighting_source',
                21 => 'latrine_facility',
                22 => 'latrine_type',
                23 => 'drainage_system',
                24 => 'bathroom_facility',
                25 => 'kitchen_facility',
                26 => 'cooking_fuel',
                27 => 'has_radio',
                28 => 'has_tv',
                29 => 'has_internet',
                30 => 'has_pc',
                31 => 'phone_type',
                32 => 'vehicles',
                33 => 'has_car',
                34 => 'main_cereal',
                35 => 'mobile_no',
            ];

            $sortColumn = $columns[$orderColumnIdx] ?? 'id';

            $isTrashedTable = $request->query('only_trashed') ? true : false;
            if ($isTrashedTable) {
                $query = \App\Models\CensusRecord::onlyTrashed();
            } else {
                $query = \App\Models\CensusRecord::query();
            }

            // Total records before filtering
            $totalRecords = $query->count();

            // Apply global search on key indexable columns for maximum query speed
            if (!empty($searchValue)) {
                $query->where(function($q) use ($searchValue) {
                    $q->where('head_name', 'like', "%{$searchValue}%")
                      ->orWhere('house_no', 'like', "%{$searchValue}%")
                      ->orWhere('census_house_no', 'like', "%{$searchValue}%")
                      ->orWhere('mobile_no', 'like', "%{$searchValue}%");
                });
            }

            // Count records after filter
            $filteredRecords = $query->count();

            // Paginated dataset
            $records = $query->orderBy($sortColumn, $orderDir)
                             ->offset($start)
                             ->limit($length)
                             ->get();

            $translations = $this->getTranslations($lang);
            $data = [];
            foreach ($records as $record) {
                $row = $this->getMappedRecordRow($record, $lang, $translations);
                
                // Construct striped badge layout HTML
                $modeBadge = '<span class="badge-mode ' . (in_array(strtolower($record->mode), ['દુકાન', 'shop', 'दुकान']) ? 'shop' : 'house') . '">' . $row['mode'] . '</span>';
                
                if ($isTrashedTable) {
                    $actionHtml = '<div class="action-btn-group">' .
                                  '<button class="btn-action btn-restore" data-id="' . $record->id . '" title="Restore"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="23 4 23 10 17 10"></polyline><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path></svg></button>' .
                                  '<button class="btn-action btn-force-delete" data-id="' . $record->id . '" data-house-no="' . htmlspecialchars($row['house_no'], ENT_QUOTES, 'UTF-8') . '" title="Delete Permanently"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 6h18"></path><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button>' .
                                  '</div>';
                } else {
                    $actionHtml = '<button class="btn-action btn-delete" data-id="' . $record->id . '" data-house-no="' . htmlspecialchars($row['house_no'], ENT_QUOTES, 'UTF-8') . '" title="Delete"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 6h18"></path><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></button>';
                }
                
                $data[] = [
                    $actionHtml,
                    $modeBadge,
                    $row['line_no'],
                    '<strong>' . htmlspecialchars($row['house_no']) . '</strong>',
                    $row['census_house_no'],
                    $row['floor_material'],
                    $row['wall_material'],
                    $row['roof_material'],
                    $row['house_use'],
                    $row['house_condition'],
                    $row['household_no'],
                    $row['total_members'],
                    $row['head_name'],
                    $row['head_gender'],
                    $row['social_category'],
                    $row['ownership'],
                    $row['dwelling_rooms'],
                    $row['married_couples'],
                    $row['drinking_water'],
                    $row['water_availability'],
                    $row['lighting_source'],
                    $row['latrine_facility'],
                    $row['latrine_type'],
                    $row['drainage_system'],
                    $row['bathroom_facility'],
                    $row['kitchen_facility'],
                    $row['cooking_fuel'],
                    $row['has_radio'],
                    $row['has_tv'],
                    $row['has_internet'],
                    $row['has_pc'],
                    $row['phone_type'],
                    $row['vehicles'],
                    $row['has_car'],
                    $row['main_cereal'],
                    $row['mobile_no']
                ];
            }

            return response()->json([
                'draw' => $draw,
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => $filteredRecords,
                'data' => $data
            ]);
        }

        // Initial non-AJAX view
        $totalCount = \App\Models\CensusRecord::count();
        $trashedCount = \App\Models\CensusRecord::onlyTrashed()->count();
        $translations = $this->getTranslations($lang);

        // Fetch first 10 records for initial render (instant loading on slow internet)
        $initialRecords = [];
        if ($totalCount > 0) {
            $records = \App\Models\CensusRecord::orderBy('id', 'desc')
                                 ->limit(10)
                                 ->get();
            foreach ($records as $record) {
                $row = $this->getMappedRecordRow($record, $lang, $translations);
                $isShop = in_array(strtolower($record->mode), ['દુકાન', 'shop', 'દુકાન', 'दुकान', 'shop']);
                $initialRecords[] = [
                    'id' => $record->id,
                    'is_shop' => $isShop,
                    'row' => $row
                ];
            }
        }

        return view('download', [
            'initialRecords' => $initialRecords,
            'currentLang' => $lang,
            'translations' => $translations,
            'rawRecordsCount' => $totalCount,
            'rawTrashedCount' => $trashedCount
        ]);
    }

    /**
     * Export all census records as an Excel/CSV file.
     *
     * GET /download-data/excel
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function exportExcel(Request $request)
    {
        $lang = $request->query('lang', 'gu');
        if (!in_array($lang, ['gu', 'hi', 'en'])) {
            $lang = 'gu';
        }
        
        $translations = $this->getTranslations($lang);
        $records = $this->service->getAllRecords();
        
        // Define columns
        $headers = [
            $translations['mode'],
            $translations['q1'],
            $translations['q2'],
            $translations['q3'],
            $translations['q4'],
            $translations['q5'],
            $translations['q6'],
            $translations['q7'],
            $translations['q8'],
            $translations['q9'],
            $translations['q10'],
            $translations['q11'],
            $translations['q12'],
            $translations['q13'],
            $translations['q14'],
            $translations['q15'],
            $translations['q16'],
            $translations['q17'],
            $translations['q18'],
            $translations['q19'],
            $translations['q20'],
            $translations['q21'],
            $translations['q22'],
            $translations['q23'],
            $translations['q24'],
            $translations['q25'],
            $translations['q26'],
            $translations['q27'],
            $translations['q28'],
            $translations['q29'],
            $translations['q30'],
            $translations['q31'],
            $translations['q32'],
            $translations['q33'],
            $translations['q34'],
        ];

        $filename = "census_data_" . $lang . "_" . date('Ymd_His') . ".xls";

        $callback = function() use ($records, $lang, $translations, $headers) {
            echo '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">' . "\n";
            echo '<head>' . "\n";
            echo '  <meta http-equiv="Content-type" content="text/html;charset=utf-8" />' . "\n";
            echo '  <!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>Census Data</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]-->' . "\n";
            echo '  <style>' . "\n";
            echo '    th {' . "\n";
            echo '      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;' . "\n";
            echo '      font-weight: bold;' . "\n";
            echo '      font-size: 13pt;' . "\n"; // Font size increase for headers
            echo '      background-color: #E2E8F0;' . "\n"; // Distinct light gray background
            echo '      color: #000000;' . "\n";
            echo '      border: 0.5pt solid #000000;' . "\n";
            echo '      padding: 6px 12px;' . "\n";
            echo '    }' . "\n";
            echo '    td {' . "\n";
            echo '      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;' . "\n";
            echo '      font-size: 10pt;' . "\n";
            echo '      border: 0.5pt solid #CBD5E1;' . "\n";
            echo '      padding: 4px 8px;' . "\n";
            echo '    }' . "\n";
            echo '  </style>' . "\n";
            echo '</head>' . "\n";
            echo '<body>' . "\n";
            echo '  <table>' . "\n";
            echo '    <thead>' . "\n";
            echo '      <tr>' . "\n";
            foreach ($headers as $header) {
                echo '        <th>' . htmlspecialchars($header) . '</th>' . "\n";
            }
            echo '      </tr>' . "\n";
            echo '    </thead>' . "\n";
            echo '    <tbody>' . "\n";
            foreach ($records as $record) {
                $row = $this->getMappedRecordRow($record, $lang, $translations);
                echo '      <tr>' . "\n";
                foreach ($row as $val) {
                    echo '        <td>' . htmlspecialchars($val) . '</td>' . "\n";
                }
                echo '      </tr>' . "\n";
            }
            echo '    </tbody>' . "\n";
            echo '  </table>' . "\n";
            echo '</body>' . "\n";
            echo '</html>' . "\n";
        };

        return response()->stream($callback, 200, [
            "Content-type"        => "application/vnd.ms-excel; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ]);
    }

    /**
     * Render the print-ready PDF template of census records.
     *
     * GET /download-data/pdf
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function exportPdf(Request $request)
    {
        $lang = $request->query('lang', 'gu');
        if (!in_array($lang, ['gu', 'hi', 'en'])) {
            $lang = 'gu';
        }
        
        $records = $this->service->getAllRecords();
        $translations = $this->getTranslations($lang);
        
        $mappedRecords = [];
        foreach ($records as $record) {
            $mappedRecords[] = $this->getMappedRecordRow($record, $lang, $translations);
        }
        
        return view('print-pdf', [
            'records' => $mappedRecords,
            'currentLang' => $lang,
            'translations' => $translations
        ]);
    }

    /**
     * Get translation maps for specific locales.
     */
    protected function getTranslations($lang)
    {
        $translations = [
            'gu' => [
                'actions' => 'ક્રિયાઓ',
                'mode' => 'પ્રકાર',
                'house' => 'મકાન',
                'shop' => 'દુકાન',
                'q1' => '૧. લીટી નં',
                'q2' => '૨. મકાન નં',
                'q3' => '૩. જન ગણના ઘર નં',
                'q4' => '૪. ભોંયતળિયું',
                'q5' => '૫. દિવાલ',
                'q6' => '૬. છત',
                'q7' => '૭. ઉપયોગ',
                'q8' => '૮. સ્થિતિ',
                'q9' => '૯. કુટુંબ નં',
                'q10' => '૧૦. વ્યક્તિ',
                'q11' => '૧૧. મુખ્ય માણસનું નામ',
                'q12' => '૧૨. જાતિ',
                'q13' => '૧૩. જાતિ વિગત',
                'q14' => '૧૪. માલિકી',
                'q15' => '૧૫. ઓરડા',
                'q16' => '૧૬. દંપતિ',
                'q17' => '૧૭. પાણી (સ્ત્રોત)',
                'q18' => '૧૮. ઉપલબ્ધતા',
                'q19' => '૧૯. પ્રકાશ',
                'q20' => '૨૦. શૌચાલય',
                'q21' => '૨૧. પ્રકાર',
                'q22' => '૨૨. નિકાલ',
                'q23' => '૨૩. સ્નાનગૃહ',
                'q24' => '૨૪. રસોડું',
                'q25' => '૨૫. બળતણ / ઈંધણ',
                'q26' => '૨૬. રેડિયો',
                'q27' => '૨૭. ટીવી',
                'q28' => '૨૮. નેટ',
                'q29' => '૨૯. PC',
                'q30' => '૩૦. ફોન',
                'q31' => '૩૧. વાહન',
                'q32' => '૩૨. કાર',
                'q33' => '૩૩. અનાજ',
                'q34' => '૩૪. મો.નં',
                'empty' => 'ભરેલ નથી',
                'mud' => 'માટી',
                'wood' => 'લાકડું',
                'stone' => 'પથ્થર',
                'cement' => 'સિમેન્ટ',
                'tiles' => 'ટાઈલ્સ',
                'grass_bamboo' => 'ઘાસ/વાંસ',
                'plastic' => 'પ્લાસ્ટિક',
                'burnt_brick' => 'પાકી ઈંટ',
                'concrete' => 'કોંક્રીટ',
                'grass' => 'ઘાસ',
                'metal' => 'પતરા',
                'slate' => 'સ્લેટ',
                'residential' => 'રહેઠાણ',
                'residential_shop' => 'રહેઠાણ + દુકાન',
                'school' => 'શાળા',
                'other' => 'અન્ય',
                'good' => 'સારી',
                'livable' => 'રહેવાલાયક',
                'dilapidated' => 'ખંડેર',
                'male' => 'પુરુષ',
                'female' => 'સ્ત્રી',
                'trans' => 'ટ્રાન્સ',
                'sc' => 'SC',
                'st' => 'ST',
                'owned' => 'પોતાનું',
                'rented_other' => 'ભાડાનું (બીજે છે)',
                'rented_none' => 'ભાડાનું (નથી)',
                'tap_treated' => 'નળ(શુદ્ધ)',
                'tap_untreated' => 'નળ(અશુદ્ધ)',
                'handpump' => 'ડંકી',
                'borewell' => 'બોર',
                'river_pond' => 'નદી/તળાવ',
                'bottled' => 'બોટલ',
                'premises' => 'પરિસરમાં',
                'near' => 'નજીક',
                'away' => 'દૂર',
                'electricity' => 'વીજળી',
                'kerosene' => 'કેરોસીન',
                'solar' => 'સૌર',
                'private' => 'ખાસ',
                'shared' => 'વહેંચાયેલ',
                'open' => 'ખુલ્લામાં',
                'sewer' => 'ગટર',
                'septic' => 'સેપ્ટિક',
                'pit' => 'ખાડો',
                'closed_drain' => 'બંધ',
                'open_drain' => 'ખુલ્લી',
                'none' => 'નથી',
                'firewood' => 'લાકડું',
                'cowdung' => 'છાણા',
                'lpg_png' => 'LPG/PNG',
                'smartphone' => 'સ્માર્ટફોન',
                'featurephone' => 'સામાન્ય',
                'both' => 'બંને',
                'bicycle' => 'સાયકલ',
                'motorcycle' => 'બાઈક',
                'wheat' => 'ઘૌં',
                'millet' => 'બાજરી',
                'yes' => 'હા',
                'no' => 'ના',
            ],
            'hi' => [
                'actions' => 'कार्रवाई',
                'mode' => 'प्रकार',
                'house' => 'मकान',
                'shop' => 'दुकान',
                'q1' => '१. पंक्ति संख्या',
                'q2' => '२. मकान संख्या',
                'q3' => '३. जनगणना मकान संख्या',
                'q4' => '४. फर्श सामग्री',
                'q5' => '५. दीवार',
                'q6' => '६. छत',
                'q7' => '७. उपयोग',
                'q8' => '८. स्थिति',
                'q9' => '९. परिवार संख्या',
                'q10' => '१०. कुल व्यक्ति',
                'q11' => '११. मुखिया का नाम',
                'q12' => '१२. लिंग',
                'q13' => '१३. सामाजिक श्रेणी',
                'q14' => '१४. स्वामित्व',
                'q15' => '१५. कमरों की संख्या',
                'q16' => '१६. विवाहित जोड़े',
                'q17' => '१७. पेयजल का स्रोत',
                'q18' => '१८. उपलब्धता',
                'q19' => '१९. रोशनी का स्रोत',
                'q20' => '२०. शौचालय की सुविधा',
                'q21' => '२१. शौचालय प्रकार',
                'q22' => '२२. अपशिष्ट जल निकासी',
                'q23' => '२३. स्नानगृह',
                'q24' => '२४. रसोई की सुविधा',
                'q25' => '२५. रसोई ईंधन',
                'q26' => '२६. रेडियो',
                'q27' => '२७. टीवी',
                'q28' => '२८. इंटरनेट',
                'q29' => '२९. कम्प्यूटर',
                'q30' => '३०. टेलीफोन / मोबाइल',
                'q31' => '३१. वाहन',
                'q32' => '३२. कार / जीप / वैन',
                'q33' => '३३. मुख्य अनाज',
                'q34' => '३४. मोबाइल नंबर',
                'empty' => 'नहीं भरा गया',
                'mud' => 'मिट्टी',
                'wood' => 'लकड़ी',
                'stone' => 'पत्थर',
                'cement' => 'सीमेंट',
                'tiles' => 'टाइल्स',
                'grass_bamboo' => 'घास/बांस',
                'plastic' => 'प्लास्टिक',
                'burnt_brick' => 'पक्की ईंट',
                'concrete' => 'कंक्रीट',
                'grass' => 'घास',
                'metal' => 'टीन शेड',
                'slate' => 'स्लेट',
                'residential' => 'आवास',
                'residential_shop' => 'आवास + दुकान',
                'school' => 'स्कूल',
                'other' => 'अन्य',
                'good' => 'अच्छी',
                'livable' => 'रहने योग्य',
                'dilapidated' => 'जर्जर',
                'male' => 'पुरुष',
                'female' => 'महिला',
                'trans' => 'ट्रांसजेंडर',
                'sc' => 'SC',
                'st' => 'ST',
                'owned' => 'खुद का',
                'rented_other' => 'किराए का (अन्य जगह)',
                'rented_none' => 'किराए का (नहीं है)',
                'tap_treated' => 'नल (उपचारित)',
                'tap_untreated' => 'नल (अनुपचारित)',
                'handpump' => 'हैंडपंप',
                'borewell' => 'बोरवेल',
                'river_pond' => 'नदी/तालाब',
                'bottled' => 'बोतल बंद',
                'premises' => 'परिसर के भीतर',
                'near' => 'पास में',
                'away' => 'दूर',
                'electricity' => 'बिजली',
                'kerosene' => 'केरोसिन',
                'solar' => 'सौर ऊर्जा',
                'private' => 'निजी',
                'shared' => 'साझा',
                'open' => 'खुले में',
                'sewer' => 'सीवर',
                'septic' => 'सेप्टिक',
                'pit' => 'गड्ढा',
                'closed_drain' => 'बंद नाली',
                'open_drain' => 'खुली नाली',
                'none' => 'कोई नहीं',
                'firewood' => 'लकड़ी',
                'cowdung' => 'कंडा/उपले',
                'lpg_png' => 'एलपीजी/पीएनजी',
                'smartphone' => 'स्मार्टफोन',
                'featurephone' => 'साधारण फोन',
                'both' => 'दोनों',
                'bicycle' => 'साइकिल',
                'motorcycle' => 'बाइक',
                'wheat' => 'गेहूँ',
                'millet' => 'बाजरा',
                'yes' => 'हाँ',
                'no' => 'नहीं',
            ],
            'en' => [
                'actions' => 'Actions',
                'mode' => 'Mode',
                'house' => 'House',
                'shop' => 'Shop',
                'q1' => '1. Line No',
                'q2' => '2. House No',
                'q3' => '3. Census House No',
                'q4' => '4. Floor Material',
                'q5' => '5. Wall Material',
                'q6' => '6. Roof Material',
                'q7' => '7. Use of House',
                'q8' => '8. Condition',
                'q9' => '9. Household No',
                'q10' => '10. Total Persons',
                'q11' => '11. Head of Household',
                'q12' => '12. Gender of Head',
                'q13' => '13. Social Category',
                'q14' => '14. Ownership',
                'q15' => '15. Dwelling Rooms',
                'q16' => '16. Married Couples',
                'q17' => '17. Drinking Water Source',
                'q18' => '18. Water Availability',
                'q19' => '19. Lighting Source',
                'q20' => '20. Latrine Facility',
                'q21' => '21. Type of Latrine',
                'q22' => '22. Waste Water Disposal',
                'q23' => '23. Bathing Facility',
                'q24' => '24. Kitchen Facility',
                'q25' => '25. Cooking Fuel',
                'q26' => '26. Radio/Transistor',
                'q27' => '27. Television',
                'q28' => '28. Internet Connection',
                'q29' => '29. Computer/Laptop',
                'q30' => '30. Phone Type',
                'q31' => '31. Vehicle',
                'q32' => '32. Car/Jeep/Van',
                'q33' => '33. Main Cereal',
                'q34' => '34. Mobile Number',
                'empty' => 'Not Filled',
                'mud' => 'Mud',
                'wood' => 'Wood',
                'stone' => 'Stone',
                'cement' => 'Cement',
                'tiles' => 'Tiles',
                'grass_bamboo' => 'Grass/Bamboo',
                'plastic' => 'Plastic',
                'burnt_brick' => 'Burnt Brick',
                'concrete' => 'Concrete',
                'grass' => 'Grass',
                'metal' => 'Metal Sheets',
                'slate' => 'Slate',
                'residential' => 'Residential',
                'residential_shop' => 'Residence + Shop',
                'school' => 'School',
                'other' => 'Other',
                'good' => 'Good',
                'livable' => 'Livable',
                'dilapidated' => 'Dilapidated',
                'male' => 'Male',
                'female' => 'Female',
                'trans' => 'Transgender',
                'sc' => 'SC',
                'st' => 'ST',
                'owned' => 'Owned',
                'rented_other' => 'Rented (elsewhere)',
                'rented_none' => 'Rented (none)',
                'tap_treated' => 'Tap (Treated)',
                'tap_untreated' => 'Tap (Untreated)',
                'handpump' => 'Handpump',
                'borewell' => 'Tubewell',
                'river_pond' => 'River/Pond',
                'bottled' => 'Bottled',
                'premises' => 'Within premises',
                'near' => 'Near premises',
                'away' => 'Away',
                'electricity' => 'Electricity',
                'kerosene' => 'Kerosene',
                'solar' => 'Solar',
                'private' => 'Private',
                'shared' => 'Shared',
                'open' => 'Open/None',
                'sewer' => 'Sewer',
                'septic' => 'Septic',
                'pit' => 'Pit',
                'closed_drain' => 'Closed drain',
                'open_drain' => 'Open drain',
                'none' => 'None',
                'firewood' => 'Firewood',
                'cowdung' => 'Cowdung cake',
                'lpg_png' => 'LPG/PNG',
                'smartphone' => 'Smartphone',
                'featurephone' => 'Feature Phone',
                'both' => 'Both',
                'bicycle' => 'Bicycle',
                'motorcycle' => 'Motorcycle',
                'wheat' => 'Wheat',
                'millet' => 'Millet',
                'yes' => 'Yes',
                'no' => 'No',
            ]
        ];

        return $translations[$lang] ?? $translations['gu'];
    }

    /**
     * Helper to translate standard database values.
     */
    protected function translateValue($value, $lang, $translations)
    {
        if (is_array($value)) {
            $translatedArr = [];
            foreach ($value as $val) {
                $translatedArr[] = $translations[$val] ?? $val;
            }
            return implode(', ', $translatedArr);
        }

        if (is_null($value) || $value === '') {
            return $translations['empty'];
        }

        $lowerValue = strtolower($value);
        if ($lowerValue === 'yes') {
            return $translations['yes'];
        }
        if ($lowerValue === 'no') {
            return $translations['no'];
        }

        return $translations[$value] ?? $value;
    }

    /**
     * Map database columns to a translated array matching the form sequence.
     */
    protected function getMappedRecordRow($record, $lang, $translations)
    {
        return [
            'mode' => $this->translateValue($record->mode, $lang, $translations),
            'line_no' => $record->line_no ?? $translations['empty'],
            'house_no' => $record->house_no ?? $translations['empty'],
            'census_house_no' => $record->census_house_no ?? $translations['empty'],
            'floor_material' => $this->translateValue($record->floor_material, $lang, $translations),
            'wall_material' => $this->translateValue($record->wall_material, $lang, $translations),
            'roof_material' => $this->translateValue($record->roof_material, $lang, $translations),
            'house_use' => $this->translateValue($record->house_use, $lang, $translations),
            'house_condition' => $this->translateValue($record->house_condition, $lang, $translations),
            'household_no' => $record->household_no ?? $translations['empty'],
            'total_members' => $record->total_members ?? $translations['empty'],
            'head_name' => $record->head_name ?? $translations['empty'],
            'head_gender' => $this->translateValue($record->head_gender, $lang, $translations),
            'social_category' => $this->translateValue($record->social_category, $lang, $translations),
            'ownership' => $this->translateValue($record->ownership, $lang, $translations),
            'dwelling_rooms' => $record->dwelling_rooms ?? $translations['empty'],
            'married_couples' => $record->married_couples ?? $translations['empty'],
            'drinking_water' => $this->translateValue($record->drinking_water, $lang, $translations),
            'water_availability' => $this->translateValue($record->water_availability, $lang, $translations),
            'lighting_source' => $this->translateValue($record->lighting_source, $lang, $translations),
            'latrine_facility' => $this->translateValue($record->latrine_facility, $lang, $translations),
            'latrine_type' => $record->latrine_type ?? $translations['empty'],
            'drainage_system' => $this->translateValue($record->drainage_system, $lang, $translations),
            'bathroom_facility' => $this->translateValue($record->bathroom_facility, $lang, $translations),
            'kitchen_facility' => $this->translateValue($record->kitchen_facility, $lang, $translations),
            'cooking_fuel' => $this->translateValue($record->cooking_fuel, $lang, $translations),
            'has_radio' => $this->translateValue($record->has_radio, $lang, $translations),
            'has_tv' => $this->translateValue($record->has_tv, $lang, $translations),
            'has_internet' => $this->translateValue($record->has_internet, $lang, $translations),
            'has_pc' => $this->translateValue($record->has_pc, $lang, $translations),
            'phone_type' => $this->translateValue($record->phone_type, $lang, $translations),
            'vehicles' => $this->translateValue($record->vehicles, $lang, $translations),
            'has_car' => $this->translateValue($record->has_car, $lang, $translations),
            'main_cereal' => $this->translateValue($record->main_cereal, $lang, $translations),
            'mobile_no' => $record->mobile_no ?? $translations['empty'],
        ];
    }
}

