<?php

namespace Tests\Unit;

use App\Company;
use App\Employee;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class CompanyTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCompanyCreate()
    {
        Storage::fake('public');
        $user = factory(User::class)->create();
        $file = UploadedFile::fake()->image('logo.jpg', 100, 100);
        $response = $this->actingAs($user)->JSON('POST', '/companies', ['name' => 'TestCompany', 'email' => 'testing@company.com', 'logo' => $file, 'website' => 'test.pl']);
        Storage::disk('public')->assertExists("company/logos/" . $file->hashName());
        $response->assertStatus(302);
    }

    public function testCompanyCreateWithoutName()
    {
        Storage::fake('public');
        $user = factory(User::class)->create();
        $file = UploadedFile::fake()->image('logo.jpg', 100, 100);
        $response = $this->actingAs($user)->JSON('POST', '/companies', ['name' => null, 'email' => 'testing@company.com', 'logo' => $file, 'website' => 'test.pl']);
        Storage::disk('public')->assertMissing("company/logos/" . $file->hashName());
        $response->assertStatus(422);
    }

    public function testCompanyUpdate()
    {
        Storage::fake('public');
        $user = factory(User::class)->create();
        $company = factory(Company::class)->create();
        $file = UploadedFile::fake()->image('logo.jpg', 100, 100);
        $response = $this->actingAs($user)->put('/companies/'. $company->id, ['name' => 'TestCompany', 'email' => 'testing@company.com', 'logo' => $file, 'website' => 'test.pl']);
        Storage::disk('public')->assertExists("company/logos/" . $file->hashName());
        $response->assertStatus(302);
    }

    public function testCompanyDelete()
    {
        $user = factory(User::class)->create();
        $company = factory(Company::class)->create();

        factory(Employee::class, 20)->create(['company_id' => $company->id]);
        $file = $company->logo;
        $response = $this->actingAs($user)->delete('/companies/'. $company->id);
        Storage::disk('public')->assertMissing($file);
        $response->assertStatus(302);
        assertEquals(Employee::where('company_id', $company->id)->count(), 0);
    }
}
