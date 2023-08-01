<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Notebook;

class NotebookControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testCanCreateNotebook()
    {
        $data = [
            'full_name' => 'John Doe',
            'phone' => '+1234567890',
            'email' => 'john.doe@example.com',
        ];

        $response = $this->postJson('/api/v1/notebook', $data);

        $response->assertStatus(201)
            ->assertJson([
                'full_name' => 'John Doe',
                'phone' => '+1234567890',
                'email' => 'john.doe@example.com',
            ]);
    }

    public function testCanRetrieveNotebook()
    {
        $note = Notebook::factory()->create();

        $response = $this->getJson("/api/v1/notebook/{$note->id}");

        $response->assertStatus(200)
            ->assertJson([
                'id' => $note->id,
                'full_name' => $note->full_name,
                'phone' => $note->phone,
                'email' => $note->email,
            ]);
    }

    public function testCannotCreateNotebookWithoutFullName()
    {
        $data = [
            'phone' => '+1234567890',
            'email' => 'john.doe@example.com',
        ];

        $response = $this->postJson('/api/v1/notebook', $data);

        $response->assertStatus(422)
            ->assertJsonValidationErrors('full_name');
    }

    public function testCannotCreateNotebookWithInvalidPhoneFormat()
    {
        $data = [
            'full_name' => 'John Doe',
            'phone' => 'invalid_phone_format',
            'email' => 'john.doe@example.com',
        ];

        $response = $this->postJson('/api/v1/notebook', $data);

        $response->assertStatus(422)
            ->assertJsonValidationErrors('phone');
    }

    public function testCanRetrieveAllNotebooksPaginated()
    {
        Notebook::factory()->count(15)->create();

        $response = $this->getJson('/api/v1/notebook');

        $response->assertStatus(200)
            ->assertJsonCount(10, 'data') // Assuming pagination limit of 10
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'full_name', 'phone', 'email', 'date_of_birth', 'company', 'photo', 'created_at', 'updated_at'],
                ],
            ]);
    }

    public function testCanUpdateNotebook()
    {
        $note = Notebook::factory()->create();

        $data = [
            'full_name' => 'Updated Name',
            'phone' => '+9876543210',
            'email' => 'updated.email@example.com',
        ];

        $response = $this->postJson("/api/v1/notebook/{$note->id}", $data);

        $response->assertStatus(200)
            ->assertJson([
                'id' => $note->id,
                'full_name' => 'Updated Name',
                'phone' => '+9876543210',
                'email' => 'updated.email@example.com',
            ]);
    }

    public function testCanDeleteNotebook()
    {
        $note = Notebook::factory()->create();

        $response = $this->deleteJson("/api/v1/notebook/{$note->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('notebooks', ['id' => $note->id]);
    }

    public function testCannotDeleteNonExistingNotebook()
    {
        // Maybe it will be better to swap this code with double delete, so we can be sure that there will be no record.
        $response = $this->deleteJson("/api/v1/notebook/-123"); // in theory, id cannot have negative value

        $response->assertStatus(404);
    }
}
