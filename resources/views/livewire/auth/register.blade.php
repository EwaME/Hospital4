<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $nombre = '';
    public string $usuario = '';
    public string $telefono = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register()
    {
        $validated = $this->validate([
            'nombre' => ['required', 'string', 'max:100'],
            'usuario' => ['required', 'string', 'max:50', 'unique:' . User::class . ',usuario'],
            'telefono' => ['required', 'string', 'max:15'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $userData = [
            'nombre' => $validated['nombre'],
            'usuario' => $validated['usuario'],
            'telefono' => $validated['telefono'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'idRol' => 4,
            'activo' => true,
        ];

        event(new Registered(($user = User::create($userData))));

        session()->flash('status', 'Registro exitoso. Debe esperar a que el administrador valide su usuario y le asigne un rol.');
        return $this->redirect(route('login', absolute: false), navigate: true);
    }

}; 
?>

<div class="login-bg min-h-screen flex items-center justify-center">
    <style>
        .login-bg {
            background: #ffffff;
        }
        .login-glass {
            background: linear-gradient(135deg, rgba(245,250,255,0.99) 0%, rgba(48,107,165,0.11) 100%);
            border-radius: 2rem;
            border: 1.5px solid #b5d5fa;
            box-shadow: 0 8px 40px 0 rgba(0, 80, 158, 0.10), 0 2px 16px #00509e15;
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            transition: box-shadow 0.3s, background 0.5s;
        }
        label {
            color: #003366;
            font-weight: 600;
            letter-spacing: 0.01em;
            font-size: 1rem;
            transition: color 0.3s;
        }
        @keyframes fade-in-up {
            from { opacity: 0; transform: translateY(30px);}
            to { opacity: 1; transform: translateY(0);}
        }
        @keyframes fade-in {
            from { opacity: 0;}
            to { opacity: 1;}
        }
        @keyframes pop {
            0% { transform: scale(0.85);}
            50% { transform: scale(1.03);}
            100% { transform: scale(1);}
        }
        @keyframes bounce {
            0%, 100% {transform: translateY(0);}
            50% {transform: translateY(-8px);}
        }
        .animate-fade-in-up { animation: fade-in-up 0.6s cubic-bezier(.4,2,.6,1) both; }
        .animate-fade-in { animation: fade-in 1.2s cubic-bezier(.4,2,.6,1) both; }
        .animate-pop { animation: pop 0.7s cubic-bezier(.4,2,.6,1) both; }
        .animate-bounce { animation: bounce 1.1s cubic-bezier(.4,2,.6,1) both; }

        input[type="email"], input[type="password"], input[type="text"] {
            transition: box-shadow 0.2s, border-color 0.2s;
            background: rgba(255,255,255,0.95);
            box-shadow: 0 1px 3px rgba(31,38,135,0.06);
            color: #003366 !important;
        }
        input[type="email"]:focus, input[type="password"]:focus, input[type="text"]:focus {
            border-color: #00509e;
            box-shadow: 0 2px 8px #00509e15;
        }

        .flux\:button, button[type="submit"] {
            background: #18B981 !important;  /* Verde personalizado */
            color: #fff !important;
            border: none;
            transition: transform 0.18s, box-shadow 0.18s;
            font-weight: 600;
            letter-spacing: 0.03em;
        }
        .flux\:button:hover, button[type="submit"]:hover {
            background: #14996b !important;
            transform: scale(1.045);
            box-shadow: 0 4px 14px #00509e25;
        }
        .login-glass, .login-glass * { color: #1a2442 !important; }
        label, .flux\:input label, .flux\:checkbox label { color: #003366 !important; }
        .text-sm, .text-center, .text-muted, .flux\:link, .text-zinc-600, .text-zinc-400 { color: #456 !important; }
        input::placeholder { color: #8696b8; opacity: 1; }
        h1, h2, h3, h4, .x-auth-header__title { color: #003366 !important; font-weight: bold; }
        button, .flux\:button, button[type="submit"] { color: #fff !important; text-shadow: 0 1px 6px rgba(0,80,158,0.11);}
    </style>
    <div class="login-glass w-full max-w-md mx-auto rounded-2xl shadow-2xl p-8 flex flex-col gap-8 animate-fade-in-up">
        <div class="flex flex-col items-center gap-2 mb-4 animate-pop">
            <div class="w-16 h-16 rounded-full bg-gradient-to-br from-blue-400 to-blue-900 flex items-center justify-center shadow-lg mb-1 animate-bounce">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M9 2a7 7 0 017 7v1h1a1 1 0 110 2h-1v1a7 7 0 11-14 0v-1H1a1 1 0 110-2h1V9a7 7 0 017-7z" />
                </svg>
            </div>
            <h1 class="text-3xl font-extrabold tracking-tight text-[#003366] drop-shadow animate-fade-in">Hospital EKO</h1>
        </div>
        <x-auth-header :title="__('Crear cuenta')" :description="__('Ingresa tus datos para registrarte')" />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form wire:submit.prevent="register" class="flex flex-col gap-6">
            <flux:input
                wire:model.defer="nombre"
                :label="__('Nombre completo')"
                type="text"
                required
                autofocus
                autocomplete="name"
                placeholder="Nombre y apellido"
                label-classes="!text-[#003366] !font-semibold"
                input-classes="!text-[#003366]"
            />
            <flux:input
                wire:model.defer="usuario"
                :label="__('Nombre de usuario')"
                type="text"
                required
                autocomplete="username"
                placeholder="Usuario único"
                label-classes="!text-[#003366] !font-semibold"
                input-classes="!text-[#003366]"
            />
            <flux:input
                wire:model.defer="telefono"
                :label="__('Teléfono')"
                type="text"
                required
                autocomplete="tel"
                placeholder="Ej: 9856-1122"
                label-classes="!text-[#003366] !font-semibold"
                input-classes="!text-[#003366]"
            />
            <flux:input
                wire:model.defer="email"
                :label="__('Correo electrónico')"
                type="email"
                required
                autocomplete="email"
                placeholder="email@example.com"
                label-classes="!text-[#003366] !font-semibold"
                input-classes="!text-[#003366]"
            />
            <flux:input
                wire:model.defer="password"
                :label="__('Contraseña')"
                type="password"
                required
                autocomplete="new-password"
                placeholder="Contraseña"
                viewable
            />
            <flux:input
                wire:model.defer="password_confirmation"
                :label="__('Confirmar contraseña')"
                type="password"
                required
                autocomplete="new-password"
                placeholder="Confirma la contraseña"
                viewable
            />
            <div class="flex items-center justify-end">
                <flux:button type="submit" variant="primary" class="w-full">
                    {{ __('Crear cuenta') }}
                </flux:button>
            </div>
        </form>

        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400 mt-2">
            <span>{{ __('¿Ya tienes cuenta?') }}</span>
            <flux:link :href="route('login')" wire:navigate>{{ __('Inicia sesión') }}</flux:link>
        </div>
    </div>
</div>
