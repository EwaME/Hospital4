<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Paciente;
use App\Models\Doctor;
use App\Models\HistorialClinico;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $roleAdmin = Role::create(['name' => 'Admin']);
        $rolePaciente = Role::create(['name' => 'Paciente']);
        $roleDoctor = Role::create(['name' => 'Doctor']);

        Permission::create(['name' => 'Ver Bitacoras']);
        Permission::create(['name' => 'Ver Citas']);
        Permission::create(['name' => 'Ver Consultas']);
        Permission::create(['name' => 'Ver Doctores']);
        Permission::create(['name' => 'Ver Historiales']);
        Permission::create(['name' => 'Ver Pacientes']);
        Permission::create(['name' => 'Ver Roles']);
        Permission::create(['name' => 'Ver Usuarios']);
        Permission::create(['name' => 'Ver Enfermedades']);
        Permission::create(['name' => 'Ver Medicamentos']);
        Permission::create(['name' => 'Ver ConsultaMedicamentos']);
        Permission::create(['name' => 'Agendar Cita']);
        Permission::create(['name' => 'Cancelar Cita']);
        Permission::create(['name' => 'Ver Administradores']);

        $AdminUser = User::create([
            'nombre' => 'Admin',
            'usuario' => 'admin',
            'email' => 'admin@local.com',
            'password' => Hash::make('12345'),
            'telefono' => '1111-1111',
            'idRol' => $roleAdmin->id,
            'email_verified_at' => now(),
        ]);

        $PacienteUser = User::create([
            'nombre' => 'Paciente',
            'usuario' => 'paciente',
            'email' => 'paciente@local.com',
            'password' => Hash::make('12345'),
            'telefono' => '2222-2222',
            'idRol' => $rolePaciente->id,
            'email_verified_at' => now(),
        ]);

        $DoctorUser = User::create([
            'nombre' => 'Doctor',
            'usuario' => 'doctor',
            'email' => 'doctor@local.com',
            'password' => Hash::make('12345'),
            'telefono' => '3333-3333',
            'idRol' => $roleDoctor->id,
            'email_verified_at' => now(),
        ]);

        $AdminUser->assignRole($roleAdmin);
        $PacienteUser->assignRole($rolePaciente);
        $DoctorUser->assignRole($roleDoctor);

        $controlTotal=Permission::query()->pluck('name');

        $roleAdmin->syncPermissions($controlTotal);
        $rolePaciente->syncPermissions([
            'Ver Citas',
            'Ver Consultas',
            'Ver Historiales',
            'Agendar Cita',
            'Cancelar Cita',
        ]);
        $roleDoctor->syncPermissions([
            'Ver Pacientes',
            'Ver Citas',
            'Ver Consultas',
            'Ver Historiales',
            'Ver Medicamentos',
            'Ver ConsultaMedicamentos',
        ]);

        $paciente = Paciente::create([
            'idPaciente' => $PacienteUser->id,  
            'fechaNacimiento' => '2000-01-01',
            'genero' => 'No especificado'
        ]);

        HistorialClinico::create([
            'idPaciente' => $PacienteUser->id,
            'resumen' => 'Historial creado automáticamente por el seeder.'
        ]);

        $doctor = Doctor::create([
            'idDoctor' => $DoctorUser->id, 
            'especialidad' => 'GENERAL'
        ]);

        $pacienteD = Paciente::create([
            'idPaciente' => $DoctorUser->id,  
            'fechaNacimiento' => '2000-01-01',
            'genero' => 'No especificado'
        ]);

        HistorialClinico::create([
            'idPaciente' => $DoctorUser->id,
            'resumen' => 'Historial creado automáticamente por el seeder.'
        ]);
    }
}
