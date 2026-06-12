<?php

namespace App\Repositories\Eloquent;

use App\Models\CensusRecord;
use App\Repositories\Contracts\CensusRecordRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class EloquentCensusRecordRepository
 * 
 * Eloquent implementation of the Census Record database repository operations.
 * 
 * @package App\Repositories\Eloquent
 */
class EloquentCensusRecordRepository implements CensusRecordRepositoryInterface
{
    /**
     * Get all census records.
     * 
     * @return Collection<int, CensusRecord>
     */
    public function all(): Collection
    {
        return CensusRecord::orderBy('created_at', 'desc')->get();
    }

    /**
     * Get paginated census records.
     * 
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return CensusRecord::orderBy('created_at', 'desc')->paginate($perPage);
    }

    /**
     * Find a census record by its ID.
     * 
     * @param int $id
     * @return CensusRecord|null
     */
    public function findById(int $id): ?CensusRecord
    {
        return CensusRecord::find($id);
    }

    /**
     * Create a new census record.
     * 
     * @param array $data
     * @return CensusRecord
     */
    public function create(array $data): CensusRecord
    {
        return CensusRecord::create($data);
    }

    /**
     * Update an existing census record.
     * 
     * @param int $id
     * @param array $data
     * @return CensusRecord|null
     */
    public function update(int $id, array $data): ?CensusRecord
    {
        $record = $this->findById($id);
        
        if ($record) {
            $record->update($data);
            return $record;
        }

        return null;
    }

    /**
     * Delete a census record.
     * 
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $record = $this->findById($id);

        if ($record) {
            return $record->delete();
        }

        return false;
    }

    /**
     * Find a census record by house number and mode.
     * 
     * @param string $houseNo
     * @param string $mode
     * @return CensusRecord|null
     */
    public function findByHouseNo(string $houseNo, string $mode): ?CensusRecord
    {
        $record = CensusRecord::where('house_no', $houseNo)
            ->where('mode', $mode)
            ->first();

        if (!$record) {
            $record = CensusRecord::where('house_no', $houseNo)->first();
        }

        return $record;
    }

    /**
     * Restore a soft deleted census record.
     * 
     * @param int $id
     * @return bool
     */
    public function restore(int $id): bool
    {
        $record = CensusRecord::onlyTrashed()->find($id);

        if ($record) {
            return $record->restore();
        }

        return false;
    }

    /**
     * Force delete a census record.
     * 
     * @param int $id
     * @return bool
     */
    public function forceDelete(int $id): bool
    {
        $record = CensusRecord::onlyTrashed()->find($id);

        if ($record) {
            return $record->forceDelete();
        }

        return false;
    }
}
