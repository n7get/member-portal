<?php

namespace Database\Factories;

use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

class MemberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Member::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'mailing_address_street' => $this->faker->optional()->streetAddress,
            'mailing_address_city' => $this->faker->optional()->city,
            'mailing_address_state' => $this->faker->optional()->stateAbbr,
            'mailing_address_zip' => $this->faker->optional()->postcode,
            'part_year_nv_resident' => $this->faker->boolean,
            'callsign' => $this->faker->unique()->text(7),
            'expiration' => $this->faker->date,
            'shares_callsign' => $this->faker->optional()->text(10),
            'gmrs_callsign' => $this->faker->optional()->text(10),
            'cellPhone' => $this->faker->phoneNumber,
            'cell_sms_carrier' => $this->faker->word,
            'email' => $this->faker->unique()->safeEmail,
            'winlink_account' => $this->faker->boolean,
        ];
    }
}
