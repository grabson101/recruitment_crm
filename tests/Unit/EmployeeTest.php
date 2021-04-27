<?php

namespace Tests\Unit;

use App\Company;
use App\Employee;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testEmployeeCreate()
    {
        $user = factory(User::class)->create();
        $company_id = factory(Company::class)->create()->id;

        $response = $this->actingAs($user)->JSON('POST', '/employees', ['first_name' => 'Adam', 'last_name' => 'Kovalski','email' => 'testing@user.com', 'phone' => '+48123456789', 'company_id' => $company_id]);
        $response->assertStatus(302);
    }

    public function testEmployeeCreateWithoutFirstName()
    {
        $user = factory(User::class)->create();
        $company_id = factory(Company::class)->create()->id;

        $response = $this->actingAs($user)->JSON('POST', '/employees', ['last_name' => 'Kovalski','email' => 'testing@user.com', 'phone' => '+48123456789', 'company_id' => $company_id]);
        $response->assertStatus(422);
    }

    public function testEmployeeUpdate()
    {
        $user = factory(User::class)->create();
        $employee = factory(Employee::class)->create();
        $company_id = factory(Company::class)->create()->id;
        
        $response = $this->actingAs($user)->put('/employees/'. $employee->id, ['last_name' => 'Kovalski','email' => 'testing@user.com', 'phone' => '+48123456789', 'company_id' => $company_id]);
        $response->assertStatus(302);
    }

    public function testEmployeeDelete()
    {
        $user = factory(User::class)->create();
        $employee = factory(Employee::class)->create();

        $response = $this->actingAs($user)->delete('/employees/'. $employee->id);
        $response->assertStatus(302);
    }
}
