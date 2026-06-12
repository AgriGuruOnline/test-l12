<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class CensusRecordResource
 * 
 * Formats Eloquent model fields into standardized camelCase JSON properties.
 * 
 * @property int $id
 * @property string $mode
 * @property int $line_no
 * @property string $house_no
 * @property string $census_house_no
 * @property string $floor_material
 * @property string $wall_material
 * @property string $roof_material
 * @property string $house_use
 * @property string $house_condition
 * @property int $household_no
 * @property int $total_members
 * @property string $head_name
 * @property string $head_gender
 * @property string $social_category
 * @property string $ownership
 * @property int $dwelling_rooms
 * @property int $married_couples
 * @property string $drinking_water
 * @property string $water_availability
 * @property string $lighting_source
 * @property string $latrine_facility
 * @property string|null $latrine_type
 * @property string $drainage_system
 * @property string $bathroom_facility
 * @property string $kitchen_facility
 * @property string $cooking_fuel
 * @property string $has_radio
 * @property string $has_tv
 * @property string $has_internet
 * @property string $has_pc
 * @property string $phone_type
 * @property array|null $vehicles
 * @property string $has_car
 * @property string $main_cereal
 * @property string $mobile_no
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * 
 * @package App\Http\Resources
 */
class CensusRecordResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'mode' => $this->mode,
            'lineNo' => $this->line_no,
            'houseNo' => $this->house_no,
            'censusHouseNo' => $this->census_house_no,
            'floorMaterial' => $this->floor_material,
            'wallMaterial' => $this->wall_material,
            'roofMaterial' => $this->roof_material,
            'houseUse' => $this->house_use,
            'houseCondition' => $this->house_condition,
            'householdNo' => $this->household_no,
            'totalMembers' => $this->total_members,
            'headName' => $this->head_name,
            'headGender' => $this->head_gender,
            'socialCategory' => $this->social_category,
            'ownership' => $this->ownership,
            'dwellingRooms' => $this->dwelling_rooms,
            'marriedCouples' => $this->married_couples,
            'drinkingWater' => $this->drinking_water,
            'waterAvailability' => $this->water_availability,
            'lightingSource' => $this->lighting_source,
            'latrineFacility' => $this->latrine_facility,
            'latrineType' => $this->latrine_type,
            'drainageSystem' => $this->drainage_system,
            'bathroomFacility' => $this->bathroom_facility,
            'kitchenFacility' => $this->kitchen_facility,
            'cookingFuel' => $this->cooking_fuel,
            'hasRadio' => $this->has_radio,
            'hasTv' => $this->has_tv,
            'hasInternet' => $this->has_internet,
            'hasPc' => $this->has_pc,
            'phoneType' => $this->phone_type,
            'vehicles' => $this->vehicles ?? [],
            'hasCar' => $this->has_car,
            'mainCereal' => $this->main_cereal,
            'mobileNo' => $this->mobile_no,
            'createdAt' => $this->created_at?->toIso8601String(),
            'updatedAt' => $this->updated_at?->toIso8601String(),
        ];
    }
}
