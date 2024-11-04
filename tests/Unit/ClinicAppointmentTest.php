<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClinicAppointmentTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Membuat tiga pasien
        $this->postJson('/api/patient', ['name' => 'Budi'])->assertStatus(201);
        $this->postJson('/api/patient', ['name' => 'Indah'])->assertStatus(201);
        $this->postJson('/api/patient', ['name' => 'Siska'])->assertStatus(201);

        // Membuat tiga diagnosa
        $this->postJson('/api/diagnose', ['name' => 'Ringan'])->assertStatus(201);
        $this->postJson('/api/diagnose', ['name' => 'Berat'])->assertStatus(201);
        $this->postJson('/api/diagnose', ['name' => 'Kritis'])->assertStatus(201);

        // Membuat tiga layanan
        $this->postJson('/api/service', ['name' => 'Obat'])->assertStatus(201);
        $this->postJson('/api/service', ['name' => 'Rawat Inap'])->assertStatus(201);
        $this->postJson('/api/service', ['name' => 'ICU'])->assertStatus(201);

        // Membuat janji temu untuk setiap pasien sesuai skenario
        $this->postJson('/api/appointment', [
            'patient_id' => 1,
            'diagnose_id' => 1,
        ])->assertStatus(201);

        $this->postJson('/api/appointment', [
            'patient_id' => 2,
            'diagnose_id' => 2,
        ])->assertStatus(201);

        $this->postJson('/api/appointment', [
            'patient_id' => 3,
            'diagnose_id' => 3,
        ])->assertStatus(201);

        // Menjalankan queue secara sinkron
        $this->artisan('queue:work --once');
    }

    /** @test */
    public function it_can_update_appointment_status_to_completed()
    {
        // Update status appointment pertama menjadi selesai
        $response = $this->patchJson('/api/appointment/1', [
            'patient_id' => 1,
            'diagnose_id' => 1,
            'status' => 1,
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('appointments', ['id' => 1, 'status' => 1]);

        // Update status appointment kedua (masih dalam proses)
        $response = $this->patchJson('/api/appointment/2', [
            'patient_id' => 2,
            'diagnose_id' => 2,
            'status' => 0,
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('appointments', ['id' => 2, 'status' => 0]);

        // Update status appointment ketiga menjadi selesai
        $response = $this->patchJson('/api/appointment/3', [
            'patient_id' => 3,
            'diagnose_id' => 3,
            'status' => 1,
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('appointments', ['id' => 3, 'status' => 1]);
    }
}
