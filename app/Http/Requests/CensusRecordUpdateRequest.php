<?php

namespace App\Http\Requests;

/**
 * Class CensusRecordUpdateRequest
 * 
 * Validates request data for updating an existing Census Record.
 * Inherits all validation logic from the store request to prevent code duplication.
 * 
 * @package App\Http\Requests
 */
class CensusRecordUpdateRequest extends CensusRecordStoreRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
