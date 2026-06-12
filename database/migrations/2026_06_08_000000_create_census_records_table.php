<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('census_records', function (Blueprint $bluePrint) {
            $bluePrint->id();
            
            // House/Shop Mode (Strictly Required)
            $bluePrint->string('mode', 20)->default('house')->index();

            // 1-3. Basic Identifiers
            $bluePrint->unsignedInteger('line_no')->nullable();
            $bluePrint->string('house_no', 50)->index(); // House No is required for search lookup
            $bluePrint->string('census_house_no', 50)->nullable();

            // 4-6. Construction Materials
            $bluePrint->string('floor_material', 50)->nullable();
            $bluePrint->string('wall_material', 50)->nullable();
            $bluePrint->string('roof_material', 50)->nullable();

            // 7-8. Use and Condition
            $bluePrint->string('house_use', 50)->nullable();
            $bluePrint->string('house_condition', 50)->nullable();

            // 9-12. Household Information
            $bluePrint->unsignedInteger('household_no')->nullable();
            $bluePrint->unsignedInteger('total_members')->nullable();
            $bluePrint->string('head_name', 255)->nullable()->index();
            $bluePrint->string('head_gender', 20)->nullable();

            // 13-14. Caste & Ownership
            $bluePrint->string('social_category', 20)->nullable();
            $bluePrint->string('ownership', 50)->nullable();

            // 15-16. Rooms & Couples
            $bluePrint->unsignedInteger('dwelling_rooms')->nullable();
            $bluePrint->unsignedInteger('married_couples')->nullable();

            // 17-18. Drinking Water
            $bluePrint->string('drinking_water', 50)->nullable();
            $bluePrint->string('water_availability', 50)->nullable();

            // 19. Lighting Source
            $bluePrint->string('lighting_source', 50)->nullable();

            // 20-22. Sanitation & Drainage
            $bluePrint->string('latrine_facility', 50)->nullable();
            $bluePrint->string('latrine_type', 100)->nullable();
            $bluePrint->string('drainage_system', 50)->nullable();

            // 23-24. Bath & Kitchen Facilities
            $bluePrint->string('bathroom_facility', 10)->nullable(); // yes/no
            $bluePrint->string('kitchen_facility', 10)->nullable();  // yes/no

            // 25. Cooking Fuel
            $bluePrint->string('cooking_fuel', 50)->nullable();

            // 26-29. Electronics & Media
            $bluePrint->string('has_radio', 10)->nullable();    // yes/no
            $bluePrint->string('has_tv', 10)->nullable();       // yes/no
            $bluePrint->string('has_internet', 10)->nullable(); // yes/no
            $bluePrint->string('has_pc', 10)->nullable();       // yes/no

            // 30. Phone Type
            $bluePrint->string('phone_type', 50)->nullable();

            // 31-32. Transport Vehicles
            $bluePrint->json('vehicles')->nullable(); // holds arrays like ['bicycle', 'motorcycle']
            $bluePrint->string('has_car', 10)->nullable();       // yes/no

            // 33. Food habits
            $bluePrint->string('main_cereal', 50)->nullable();

            // 34. Contact Details
            $bluePrint->string('mobile_no', 20)->nullable()->index();

            // Timestamps
            $bluePrint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('census_records');
    }
};
