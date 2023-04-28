<?php
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateOrUpdate()
    {
        // create test data
        $role = 'customer';
        $consumer_type = 'paid';
        $request = [
            'role' => $role,
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => 'password123',
            'consumer_type' => $consumer_type,
            'customer_type' => 'B2B',
            'username' => 'testusername',
            'post_code' => '12345',
            'address' => '123 Test Street',
            'city' => 'Test City',
            'town' => 'Test Town',
            'country' => 'Test Country',
            'reference' => 'yes',
            'additional_info' => 'Additional test info',
            'cost_place' => 'Test Cost Place',
            'fee' => 'Test Fee',
            'time_to_charge' => 'Test Time to Charge',
            'time_to_pay' => 'Test Time to Pay',
            'charge_ob' => 'Test Charge OB',
            'customer_id' => 'Test Customer ID',
            'charge_km' => 'Test Charge KM',
            'maximum_km' => 'Test Maximum KM',
            'translator_type' => 'Test Translator Type',
            'worked_for' => 'yes',
            'organization_number' => 'Test Organization Number',
            'gender' => 'Test Gender',
            'translator_level' => 'Test Translator Level',
            'translator_ex' => [1, 2, 3]
        ];

        // create user and assert data
        $response = $this->post('/user', $request);
        $response->assertStatus(302);
        $this->assertDatabaseHas('users', ['email' => $request['email']]);
        $user = User::where('email', $request['email'])->first();
        $this->assertEquals($request['role'], $user->user_type);
        $this->assertEquals($request['name'], $user->name);
        $this->assertEquals($request['email'], $user->email);
        $this->assertEquals($request['dob_or_orgid'], $user->dob_or_orgid);
        $this->assertEquals($request['phone'], $user->phone);
        $this->assertEquals($request['mobile'], $user->mobile);
        $this->assertTrue(Hash::check($request['password'], $user->password));
        $this->assertEquals($request['company_id'], $user->company_id);
        $this->assertEquals($request['department_id'], $user->department_id);

        // assert user meta data
        $userMeta = UserMeta::where('user_id', $user->id)->first();
        $this->assertEquals($request['consumer_type'], $userMeta->consumer_type);
        $this->assertEquals($request['customer_type'], $userMeta->customer_type);
        $this->assertEquals($request['username'], $userMeta->username);
        $this->assertEquals($request['post_code'], $userMeta->post_code);
        $this->assertEquals($request['address'], $userMeta->address);
        $this->assertEquals($request['city'], $userMeta->city);
        $this->assertEquals($request['town'], $userMeta->town);
        $this->assertEquals($request['country'], $userMeta->country);
        $this->assertEquals('1', $userMeta->reference);


    }
}