<?php

namespace App\Services;

use App\Models\CensusRecord;
use App\Repositories\Contracts\CensusRecordRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

/**
 * Class CensusRecordService
 * 
 * Orchestrates business logic rules and operations for Census Records.
 * 
 * @package App\Services
 */
class CensusRecordService
{
    /**
     * The repository instance.
     * 
     * @var CensusRecordRepositoryInterface
     */
    protected $repository;

    /**
     * CensusRecordService constructor.
     * 
     * @param CensusRecordRepositoryInterface $repository
     */
    public function __construct(CensusRecordRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all census records.
     * 
     * @return Collection<int, CensusRecord>
     */
    public function getAllRecords(): Collection
    {
        Log::info('Fetching all census records.');
        return $this->repository->all();
    }

    /**
     * Get paginated census records.
     * 
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getPaginatedRecords(int $perPage = 15): LengthAwarePaginator
    {
        Log::info("Fetching paginated census records. Per page: {$perPage}");
        return $this->repository->paginate($perPage);
    }

    /**
     * Find a census record by its ID.
     * 
     * @param int $id
     * @return CensusRecord|null
     */
    public function getRecordById(int $id): ?CensusRecord
    {
        Log::info("Retrieving census record ID: {$id}");
        return $this->repository->findById($id);
    }

    /**
     * Create a new census record.
     * 
     * @param array $data
     * @return CensusRecord
     */
    public function createRecord(array $data): CensusRecord
    {
        Log::info('Creating a new census record.', [
            'mode' => $data['mode'] ?? 'unknown',
            'house_no' => $data['house_no'] ?? 'unknown',
            'head_name' => $data['head_name'] ?? 'unknown'
        ]);

        // Clean arrays/fields if they come from forms (e.g. empty inputs or specific checkboxes)
        if (isset($data['vehicles']) && !is_array($data['vehicles'])) {
            $data['vehicles'] = array_filter(explode(',', $data['vehicles']));
        }

        // If latrine facility is open, latrine type must be null
        if (isset($data['latrine_facility']) && $data['latrine_facility'] === 'open') {
            $data['latrine_type'] = null;
        }

        // Prevent duplicate creation by performing an upsert check on exact house_no and mode
        if (!empty($data['house_no']) && !empty($data['mode'])) {
            $existing = CensusRecord::where('house_no', $data['house_no'])
                ->where('mode', $data['mode'])
                ->first();
            
            if ($existing) {
                Log::info("Record already exists for house_no: {$data['house_no']} in mode: {$data['mode']}. Updating existing record to prevent duplicates.");
                return $this->updateRecord($existing->id, $data);
            }
        }

        return $this->repository->create($data);
    }

    /**
     * Update an existing census record.
     * 
     * @param int $id
     * @param array $data
     * @return CensusRecord|null
     */
    public function updateRecord(int $id, array $data): ?CensusRecord
    {
        Log::info("Updating census record ID: {$id}");

        // Clean vehicles checkbox list
        if (isset($data['vehicles']) && !is_array($data['vehicles'])) {
            $data['vehicles'] = array_filter(explode(',', $data['vehicles']));
        }

        // If latrine facility is open, latrine type must be null
        if (isset($data['latrine_facility']) && $data['latrine_facility'] === 'open') {
            $data['latrine_type'] = null;
        }

        return $this->repository->update($id, $data);
    }

    /**
     * Delete a census record.
     * 
     * @param int $id
     * @return bool
     */
    public function deleteRecord(int $id): bool
    {
        Log::warning("Deleting census record ID: {$id}");
        return $this->repository->delete($id);
    }

    /**
     * Get a census record by house number and mode.
     * 
     * @param string $houseNo
     * @param string $mode
     * @return CensusRecord|null
     */
    public function getRecordByHouseNo(string $houseNo, string $mode): ?CensusRecord
    {
        Log::info("Retrieving census record by house_no: {$houseNo}, mode: {$mode}");
        return $this->repository->findByHouseNo($houseNo, $mode);
    }

    /**
     * Restore a soft deleted census record.
     * 
     * @param int $id
     * @return bool
     */
    public function restoreRecord(int $id): bool
    {
        Log::info("Restoring census record ID: {$id}");
        return $this->repository->restore($id);
    }

    /**
     * Force delete a census record.
     * 
     * @param int $id
     * @return bool
     */
    public function forceDeleteRecord(int $id): bool
    {
        Log::warning("Force deleting census record ID: {$id}");
        return $this->repository->forceDelete($id);
    }
}
