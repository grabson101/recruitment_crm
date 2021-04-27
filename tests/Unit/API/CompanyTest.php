<?php

namespace Tests\Unit\API;

use App\Company;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

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
        $response = $this->actingAs($user, 'api')->JSON('POST', '/api/companies', ['name' => 'TestCompany', 'email' => 'testing@company.com', 'logo' => $file, 'website' => 'test.pl']);
        Storage::disk('public')->assertExists("company/logos/" . $file->hashName());
        $response->assertStatus(201);
    }

    public function testCompanyIndex()
    {
        factory(Company::class, 5)->create();
        $user = factory(User::class)->create();
        $response = $this->actingAs($user, 'api')->JSON('GET', '/api/companies');
        $response->assertStatus(200);
    }
}
