<?php

namespace App\Repositories\Contracts;

use App\Models\CensusRecord;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface CensusRecordRepositoryInterface
 * 
 * Defines the contract for data operations on Census Records.
 * 
 * @package App\Repositories\Contracts
 */
interface CensusRecordRepositoryInterface
{
    /**
     * Get all census records.
     * 
     * @return Collection<int, CensusRecord>
     */
    public function all(): Collection;

    /**
     * Get paginated census records.
     * 
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 15): LengthAwarePaginator;

    /**
     * Find a census record by its ID.
     * 
     * @param int $id
     * @return CensusRecord|null
     */
    public function findById(int $id): ?CensusRecord;

    /**
     * Create a new census record.
     * 
     * @param array $data
     * @return CensusRecord
     */
    public function create(array $data): CensusRecord;

    /**
     * Update an existing census record.
     * 
     * @param int $id
     * @param array $data
     * @return CensusRecord|null
     */
    public function update(int $id, array $data): ?CensusRecord;

    /**
     * Delete a census record.
     * 
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;

    /**
     * Find a census record by house number and mode.
     * 
     * @param string $houseNo
     * @param string $mode
     * @return CensusRecord|null
     */
    public function findByHouseNo(string $houseNo, string $mode): ?CensusRecord;

    /**
     * Restore a soft deleted census record.
     * 
     * @param int $id
     * @return bool
     */
    public function restore(int $id): bool;

    /**
     * Force delete a census record.
     * 
     * @param int $id
     * @return bool
     */
    public function forceDelete(int $id): bool;
}
