<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CensusRecord
 * 
 * Represents a single census response containing 34 questions and mode.
 * 
 * @package App\Models
 */
class CensusRecord extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'census_records';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'mode',
        'line_no',
        'house_no',
        'census_house_no',
        'floor_material',
        'wall_material',
        'roof_material',
        'house_use',
        'house_condition',
        'household_no',
        'total_members',
        'head_name',
        'head_gender',
        'social_category',
        'ownership',
        'dwelling_rooms',
        'married_couples',
        'drinking_water',
        'water_availability',
        'lighting_source',
        'latrine_facility',
        'latrine_type',
        'drainage_system',
        'bathroom_facility',
        'kitchen_facility',
        'cooking_fuel',
        'has_radio',
        'has_tv',
        'has_internet',
        'has_pc',
        'phone_type',
        'vehicles',
        'has_car',
        'main_cereal',
        'mobile_no',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'user_id' => 'integer',
        'line_no' => 'integer',
        'household_no' => 'integer',
        'total_members' => 'integer',
        'dwelling_rooms' => 'integer',
        'married_couples' => 'integer',
        'vehicles' => 'array', // Cast JSON to PHP array automatically
    ];

    /**
     * The "booted" method of the model.
     * Automatically scopes queries and sets user association.
     */
    protected static function booted(): void
    {
        static::creating(function ($record) {
            if (auth()->check() && !$record->user_id) {
                $record->user_id = auth()->id();
            }
        });

        static::addGlobalScope('user_records', function ($builder) {
            if (auth()->check()) {
                $builder->where('census_records.user_id', auth()->id());
            }
        });
    }
}
