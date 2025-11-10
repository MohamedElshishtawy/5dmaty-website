<?php

namespace Tests\Feature;

use App\Models\Language;
use App\Models\User;
use App\Support\Settings;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AdminSettingsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Ensure roles table is ready
        if (!Role::query()->where('name', 'admin')->exists()) {
            Role::create(['name' => 'admin']);
        }
        if (!Language::query()->where('code', 'ar')->exists()) {
            Language::create(['code' => 'ar', 'name' => 'العربية', 'is_active' => true, 'is_rtl' => true]);
        }
    }

    public function test_admin_can_add_and_toggle_language(): void
    {
        $admin = $this->actingAsAdmin();

        // Add new language
        $response = $this->post(route('admin.languages.store'), [
            'code' => 'en',
            'name' => 'English',
            'is_rtl' => 0,
        ]);
        $response->assertRedirect();
        $this->assertDatabaseHas('languages', [
            'code' => 'en',
            'name' => 'English',
            'is_active' => 1,
            'is_rtl' => 0,
        ]);

        $lang = Language::where('code', 'en')->firstOrFail();
        // Toggle language (deactivate)
        $response = $this->post(route('admin.languages.toggle', $lang));
        $response->assertRedirect();
        $this->assertDatabaseHas('languages', [
            'id' => $lang->id,
            'is_active' => 0,
        ]);
    }

    protected function actingAsAdmin(): User
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        return $user;
    }

    public function test_admin_can_update_text_settings(): void
    {
        $admin = $this->actingAsAdmin();

        $payload = [
            'seo' => [
                'ar' => [
                    'title' => 'عنوان SEO',
                    'description' => 'وصف SEO',
                    'keywords' => 'كلمات, مفتاحية',
                ],
            ],
            'hero' => [
                'ar' => [
                    'title' => 'عنوان الهيرو',
                    'subtitle' => 'وصف قصير للهيرو',
                ],
            ],
        ];

        $response = $this->post(route('admin.settings.update'), $payload);
        $response->assertRedirect();

        // Values persisted
        $this->assertDatabaseHas('settings', [
            'key' => 'seo.home.title',
            'locale' => 'ar',
            'value' => 'عنوان SEO',
        ]);
        $this->assertDatabaseHas('settings', [
            'key' => 'home.hero.subtitle',
            'locale' => 'ar',
            'value' => 'وصف قصير للهيرو',
        ]);

        // Settings helper returns saved values
        $this->assertSame('عنوان SEO', Settings::get('seo.home.title', null, 'ar'));
        $this->assertSame('عنوان الهيرو', Settings::get('home.hero.title', null, 'ar'));
    }

    public function test_admin_can_upload_logo_and_favicon(): void
    {
        $admin = $this->actingAsAdmin();
        Storage::fake('public');

        $payload = [
            'site_logo' => UploadedFile::fake()->image('logo.png', 120, 40),
            'site_favicon' => UploadedFile::fake()->create('favicon.ico', 12, 'image/vnd.microsoft.icon'),
            'home_hero_logo' => UploadedFile::fake()->image('hero.png', 200, 80),
        ];

        $response = $this->post(route('admin.settings.update'), $payload);
        $response->assertRedirect();

        // Check DB entries exist
        $this->assertDatabaseHas('settings', ['key' => 'site.logo', 'locale' => null]);
        $this->assertDatabaseHas('settings', ['key' => 'site.favicon', 'locale' => null]);
        $this->assertDatabaseHas('settings', ['key' => 'home.hero.logo', 'locale' => null]);

        // Confirm files stored
        $logoPath = Settings::get('site.logo');
        $faviconPath = Settings::get('site.favicon');
        $heroPath = Settings::get('home.hero.logo');

        Storage::disk('public')->assertExists($logoPath);
        Storage::disk('public')->assertExists($faviconPath);
        Storage::disk('public')->assertExists($heroPath);
    }
}


