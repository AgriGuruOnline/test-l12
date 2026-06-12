<?php

namespace Database\Factories;

use App\Models\CensusRecord;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CensusRecord>
 */
class CensusRecordFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CensusRecord::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $mode = $this->faker->randomElement(['house', 'shop']);
        $totalMembers = $this->faker->numberBetween(1, 8);
        
        // Logical check: Married couples cannot exceed total members and usually is at most floor(totalMembers/2)
        $marriedCouples = 0;
        if ($totalMembers > 1) {
            $maxCouples = min(2, (int) floor($totalMembers / 2));
            $marriedCouples = $this->faker->numberBetween(0, $maxCouples);
        }

        // Realistic Indian/Gujarati names
        $firstNames = [
            'Rameshbhai', 'Sureshbhai', 'Rajeshbhai', 'Dineshbhai', 'Hiteshbhai',
            'Manishbhai', 'Anitaben', 'Savitaben', 'Priyaben', 'Kiranbhai',
            'Vikrambhai', 'Sanjaybhai', 'Jyotsnaben', 'Geetaben', 'Ashokbhai'
        ];
        $lastNames = [
            'Patel', 'Shah', 'Mehta', 'Joshi', 'Trivedi', 'Solanki', 'Parmar',
            'Vaghela', 'Chavda', 'Rathod', 'Gohil', 'Jadeja', 'Panchal', 'Darji'
        ];
        $headName = $this->faker->randomElement($firstNames) . ' ' . $this->faker->randomElement($lastNames);

        $latrineFacility = $this->faker->randomElement(['private', 'shared', 'open']);
        $latrineType = $latrineFacility !== 'open' ? $this->faker->randomElement(['Flush', 'Pit', 'Pour Flush']) : null;

        // Custom array of vehicles
        $vehiclesList = ['bicycle', 'motorcycle'];
        $vehicles = [];
        if ($this->faker->boolean(70)) { // 70% chance of owning some vehicle
            $vehicles = $this->faker->randomElements($vehiclesList, $this->faker->numberBetween(1, 2));
        }

        return [
            'mode' => $mode,
            'line_no' => $this->faker->unique()->numberBetween(1, 10000),
            'house_no' => strtoupper($this->faker->bothify('?-###')),
            'census_house_no' => strtoupper($this->faker->bothify('CH-####')),
            
            'floor_material' => $this->faker->randomElement(['mud', 'wood', 'stone', 'cement', 'tiles']),
            'wall_material' => $this->faker->randomElement(['grass_bamboo', 'plastic', 'mud', 'wood', 'stone', 'burnt_brick', 'concrete']),
            'roof_material' => $this->faker->randomElement(['grass', 'tiles', 'metal', 'stone', 'slate', 'concrete']),
            
            'house_use' => $this->faker->randomElement(['residential', 'residential_shop', 'school', 'other']),
            'house_condition' => $this->faker->randomElement(['good', 'livable', 'dilapidated']),
            
            'household_no' => $this->faker->numberBetween(1, 500),
            'total_members' => $totalMembers,
            'head_name' => $headName,
            'head_gender' => $this->faker->randomElement(['male', 'female', 'trans']),
            
            'social_category' => $this->faker->randomElement(['sc', 'st', 'other']),
            'ownership' => $this->faker->randomElement(['owned', 'rented_other', 'rented_none', 'other']),
            
            'dwelling_rooms' => $this->faker->numberBetween(1, 6),
            'married_couples' => $marriedCouples,
            
            'drinking_water' => $this->faker->randomElement(['tap_treated', 'tap_untreated', 'handpump', 'borewell', 'river_pond', 'bottled']),
            'water_availability' => $this->faker->randomElement(['premises', 'near', 'away']),
            
            'lighting_source' => $this->faker->randomElement(['electricity', 'kerosene', 'solar']),
            
            'latrine_facility' => $latrineFacility,
            'latrine_type' => $latrineType,
            'drainage_system' => $this->faker->randomElement(['sewer', 'septic', 'pit', 'closed_drain', 'open_drain', 'none']),
            
            'bathroom_facility' => $this->faker->randomElement(['yes', 'no']),
            'kitchen_facility' => $this->faker->randomElement(['yes', 'no']),
            'cooking_fuel' => $this->faker->randomElement(['firewood', 'cowdung', 'lpg_png', 'solar']),
            
            'has_radio' => $this->faker->randomElement(['yes', 'no']),
            'has_tv' => $this->faker->randomElement(['yes', 'no']),
            'has_internet' => $this->faker->randomElement(['yes', 'no']),
            'has_pc' => $this->faker->randomElement(['yes', 'no']),
            
            'phone_type' => $this->faker->randomElement(['smartphone', 'featurephone', 'both']),
            'vehicles' => $vehicles,
            'has_car' => $this->faker->randomElement(['yes', 'no']),
            
            'main_cereal' => $this->faker->randomElement(['wheat', 'millet']),
            'mobile_no' => $this->faker->regexify('[6-9][0-9]{9}'),
        ];
    }
}
