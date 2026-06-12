<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CensusRecordStoreRequest
 * 
 * Validates request data for storing a new Census Record.
 * Sets optional parameters as nullable to support partial submissions.
 * 
 * @package App\Http\Requests
 */
class CensusRecordStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Mode and House No are strictly required to define the entry
            'mode' => 'required|string|in:house,shop',
            'house_no' => 'required|string|max:50',
            
            // All other questions are set to nullable to support drafts or partial forms
            'line_no' => 'nullable|integer|min:1',
            'census_house_no' => 'nullable|string|max:50',
            'floor_material' => 'nullable|string|in:mud,wood,stone,cement,tiles',
            'wall_material' => 'nullable|string|in:grass_bamboo,plastic,mud,wood,stone,burnt_brick,concrete',
            'roof_material' => 'nullable|string|in:grass,tiles,metal,stone,slate,concrete',
            'house_use' => 'nullable|string|in:residential,residential_shop,school,other',
            'house_condition' => 'nullable|string|in:good,livable,dilapidated',
            'household_no' => 'nullable|integer|min:1',
            'total_members' => 'nullable|integer|min:1',
            
            // Matches English, Hindi, and Gujarati alphabetic characters and spaces
            'head_name' => [
                'nullable',
                'string',
                'min:2',
                'max:255',
                'regex:/^[a-zA-Z\s\x{0A80}-\x{0AFF}\x{0900}-\x{097F}]+$/u'
            ],
            'head_gender' => 'nullable|string|in:male,female,trans',
            'social_category' => 'nullable|string|in:sc,st,other',
            'ownership' => 'nullable|string|in:owned,rented_other,rented_none,other',
            'dwelling_rooms' => 'nullable|integer|min:1',
            'married_couples' => 'nullable|integer|min:0|lte:total_members',
            'drinking_water' => 'nullable|string|in:tap_treated,tap_untreated,handpump,borewell,river_pond,bottled',
            'water_availability' => 'nullable|string|in:premises,near,away',
            'lighting_source' => 'nullable|string|in:electricity,kerosene,solar',
            'latrine_facility' => 'nullable|string|in:private,shared,open',
            'latrine_type' => 'nullable|string|max:100',
            'drainage_system' => 'nullable|string|in:sewer,septic,pit,closed_drain,open_drain,none',
            'bathroom_facility' => 'nullable|string|in:yes,no',
            'kitchen_facility' => 'nullable|string|in:yes,no',
            'cooking_fuel' => 'nullable|string|in:firewood,cowdung,lpg_png,solar',
            'has_radio' => 'nullable|string|in:yes,no',
            'has_tv' => 'nullable|string|in:yes,no',
            'has_internet' => 'nullable|string|in:yes,no',
            'has_pc' => 'nullable|string|in:yes,no',
            'phone_type' => 'nullable|string|in:smartphone,featurephone,both',
            
            'vehicles' => 'nullable|array',
            'vehicles.*' => 'string|in:bicycle,motorcycle',
            
            'has_car' => 'nullable|string|in:yes,no',
            'main_cereal' => 'nullable|string|in:wheat,millet',
            
            // 10-digit Indian Mobile Number starting with 6-9
            'mobile_no' => 'nullable|string|regex:/^[6-9]\d{9}$/',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'head_name.regex' => 'The head of household name must contain only alphabetic characters (English, Hindi, or Gujarati) and spaces.',
            'mobile_no.regex' => 'The mobile number must be a valid 10-digit Indian mobile number starting with 6, 7, 8, or 9.',
            'married_couples.lte' => 'The number of married couples cannot exceed the total family members.',
        ];
    }
}
