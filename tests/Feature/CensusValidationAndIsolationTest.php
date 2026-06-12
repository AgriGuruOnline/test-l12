<?php

namespace Tests\Feature;

use App\Models\CensusRecord;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CensusValidationAndIsolationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that validation is strict for house mode.
     */
    public function test_validation_is_strict_for_house_mode(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->postJson('/census', [
                'mode' => 'house',
                'house_no' => 'H-101',
                // other required fields are missing
            ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors([
            'line_no', 'census_house_no', 'floor_material', 'wall_material',
            'roof_material', 'house_use', 'house_condition', 'household_no',
            'total_members', 'head_name', 'head_gender', 'social_category',
            'ownership', 'dwelling_rooms', 'married_couples', 'drinking_water',
            'water_availability', 'lighting_source', 'latrine_facility',
            'drainage_system', 'bathroom_facility', 'kitchen_facility',
            'cooking_fuel', 'has_radio', 'has_tv', 'has_internet', 'has_pc',
            'phone_type', 'has_car', 'main_cereal', 'mobile_no'
        ]);
    }

    /**
     * Test that validations are removed/optional for shop mode.
     */
    public function test_validation_is_optional_for_shop_mode(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->postJson('/census', [
                'mode' => 'shop',
                'house_no' => 'S-201',
                // all other fields omitted
            ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('census_records', [
            'mode' => 'shop',
            'house_no' => 'S-201',
            'user_id' => $user->id,
        ]);
    }

    /**
     * Test that house submission with all required fields succeeds.
     */
    public function test_house_submission_with_all_fields_succeeds(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->postJson('/census', [
                'mode' => 'house',
                'house_no' => 'H-102',
                'line_no' => 1,
                'census_house_no' => 'CH-102',
                'floor_material' => 'cement',
                'wall_material' => 'concrete',
                'roof_material' => 'concrete',
                'house_use' => 'residential',
                'house_condition' => 'good',
                'household_no' => 10,
                'total_members' => 4,
                'head_name' => 'Rameshbhai Patel',
                'head_gender' => 'male',
                'social_category' => 'other',
                'ownership' => 'owned',
                'dwelling_rooms' => 3,
                'married_couples' => 1,
                'drinking_water' => 'tap_treated',
                'water_availability' => 'premises',
                'lighting_source' => 'electricity',
                'latrine_facility' => 'private',
                'latrine_type' => 'Flush',
                'drainage_system' => 'sewer',
                'bathroom_facility' => 'yes',
                'kitchen_facility' => 'yes',
                'cooking_fuel' => 'lpg_png',
                'has_radio' => 'no',
                'has_tv' => 'yes',
                'has_internet' => 'yes',
                'has_pc' => 'yes',
                'phone_type' => 'smartphone',
                'has_car' => 'no',
                'main_cereal' => 'wheat',
                'mobile_no' => '9876543210'
            ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('census_records', [
            'mode' => 'house',
            'house_no' => 'H-102',
            'user_id' => $user->id,
        ]);
    }

    /**
     * Test that users can only view their own records.
     */
    public function test_users_can_only_view_their_own_records(): void
    {
        $userA = User::factory()->create();
        $userB = User::factory()->create();

        // User A creates a record
        $recordA = CensusRecord::factory()->create(['user_id' => $userA->id]);

        // User B tries to view User A's record via show route
        $response = $this
            ->actingAs($userB)
            ->getJson("/census/{$recordA->id}");

        // The global scope will cause ModelNotFound or null because it filters by user_id
        $response->assertStatus(404);

        // User A views their own record
        $response2 = $this
            ->actingAs($userA)
            ->getJson("/census/{$recordA->id}");
        
        $response2->assertStatus(200);
        $response2->assertJsonPath('data.houseNo', $recordA->house_no);
    }

    /**
     * Test that users can only check house records that belong to them.
     */
    public function test_users_can_only_check_their_own_house_records(): void
    {
        $userA = User::factory()->create();
        $userB = User::factory()->create();

        // User A has a record
        $recordA = CensusRecord::factory()->create([
            'user_id' => $userA->id,
            'house_no' => 'TEST-100',
            'mode' => 'house'
        ]);

        // User B checks for the house
        $response = $this
            ->actingAs($userB)
            ->getJson("/census/check-house?house_no=TEST-100&mode=house");

        $response->assertStatus(200);
        $response->assertJsonPath('found', false); // User B shouldn't find User A's house record

        // User A checks for the house
        $response2 = $this
            ->actingAs($userA)
            ->getJson("/census/check-house?house_no=TEST-100&mode=house");

        $response2->assertStatus(200);
        $response2->assertJsonPath('found', true);
    }

    /**
     * Test that data downloads only contain the logged in user's records.
     */
    public function test_downloads_only_contain_logged_in_users_records(): void
    {
        $userA = User::factory()->create();
        $userB = User::factory()->create();

        // Create records for both users
        CensusRecord::factory()->create(['user_id' => $userA->id, 'house_no' => 'HOUSE-A']);
        CensusRecord::factory()->create(['user_id' => $userB->id, 'house_no' => 'HOUSE-B']);

        // User A calls data table query
        $response = $this
            ->actingAs($userA)
            ->getJson('/download-data');

        $response->assertStatus(200);
        $data = $response->json('data');
        $this->assertCount(1, $data);
        $this->assertStringContainsString('HOUSE-A', $data[0][3]); // house_no is at index 3 in datatable row
        $this->assertStringNotContainsString('HOUSE-B', $data[0][3]);
    }
}
