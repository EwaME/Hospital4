<?php

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    public function login(): void
    {
        $this->validate();
        $this->ensureIsNotRateLimited();

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        $user = Auth::user();

        // Permitir solo admin (idRol == 1)
        if ($user->idRol !== 1) {
            Auth::logout();
            throw ValidationException::withMessages([
                'email' => 'Las credenciales no corresponden a un administrador.',
            ]);
        }

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();
        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }

    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }
        event(new Lockout(request()));
        $seconds = RateLimiter::availableIn($this->throttleKey());
        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
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

        /* Animaciones */
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
        /* Personaliza tus tabs y botones */
        .custom-tab-button {
            --color: #00509e;
            font-family: inherit;
            width: 8em;
            height: 2.6em;
            line-height: 2.5em;
            position: relative;
            cursor: pointer;
            overflow: hidden;
            border: 2px solid var(--color);
            transition: color 0.5s, box-shadow 0.3s;
            z-index: 1;
            font-size: 16px;
            border-radius: 6px;
            font-weight: 500;
            color: var(--color);
            background-color: white;
            box-shadow: 0 1px 6px rgba(31, 38, 135, 0.08);
        }
        .custom-tab-button:before {
            content: "";
            position: absolute;
            z-index: -1;
            background: var(--color);
            height: 150px;
            width: 200px;
            border-radius: 50%;
            top: 100%;
            left: 100%;
            transition: all 0.7s;
        }
        .custom-tab-button:hover {
            box-shadow: 0 3px 12px #00509e30;
            color: #ffffffff;
        }
        .custom-tab-button:hover:before {
            top: -30px;
            left: -30px;
        }
        .custom-tab-button:active:before {
            background: #003366;
            transition: background 0s;
        }
        .custom-tab-button-active {
            background-color: #306ba5ff !important;
            color: #ffffffff !important;
            font-weight: bold;
            box-shadow: 0 4px 10px rgba(0, 80, 158, 0.15);
        }

        /* Input styles extra */
        input[type="email"], input[type="password"] {
            transition: box-shadow 0.2s, border-color 0.2s;
            background: rgba(255,255,255,0.95);
            box-shadow: 0 1px 3px rgba(31,38,135,0.06);
        }
        input[type="email"]:focus, input[type="password"]:focus {
            border-color: #00509e;
            box-shadow: 0 2px 8px #00509e15;
        }
        .flux\:button, button[type="submit"] {
            transition: transform 0.18s, box-shadow 0.18s;
        }
        .flux\:button:hover, button[type="submit"]:hover {
            transform: scale(1.045);
            box-shadow: 0 4px 14px #00509e25;
        }

        .flux\:button, button[type="submit"] {
            background: #18B981 !important;  /* Verde personalizado */
            color: #fff !important;
            border: none;
        }
        .flux\:button:hover, button[type="submit"]:hover {
            background: #14996b !important; /* Un verde un poco más oscuro */
        }

        /* Fuerza a que TODOS los textos normales sean oscuros y legibles */
        .login-glass, 
        .login-glass * {
            color: #1a2442 !important;
        }

        /* Para los labels de los inputs de flux, por si algún label queda fuera */
        label, .flux\:input label, .flux\:checkbox label {
            color: #003366 !important;
            font-weight: 600;
            font-size: 1rem;
            letter-spacing: 0.01em;
        }

        /* Forzar textos auxiliares y de links secundarios */
        .text-sm, .text-center, .text-muted, .flux\:link, .text-zinc-600, .text-zinc-400 {
            color: #456 !important;
        }

        /* Placeholder también más visible */
        input::placeholder {
            color: #8696b8;
            opacity: 1;
        }

        /* El título principal y subtítulos */
        h1, h2, h3, h4, .x-auth-header__title {
            color: #003366 !important;
            font-weight: bold;
            letter-spacing: 0.02em;
        }

        /* Asegura que TODOS los botones tengan texto blanco, incluso los de flux */
        button, .flux\:button, button[type="submit"] {
            color: #fff !important;
            text-shadow: 0 1px 6px rgba(0,80,158,0.11);
            font-weight: 600;
            letter-spacing: 0.04em;
        }

        a.button, a.flux\:button {
            color: #ffffff !important;
        }

        .custom-tab-button-active,.flux\:button, button[type="submit"]  {
            color: #ffffffff !important;
        }
        .flux\:button, button[type="submit"] {
            color: #ffffff !important;
        }

    </style>
    <div class="login-glass w-full max-w-md mx-auto rounded-2xl shadow-2xl p-8 flex flex-col gap-8 animate-fade-in-up">
        <div class="flex flex-col items-center gap-2 mb-6 animate-pop">
            <div class="w-16 h-16 rounded-full bg-gradient-to-br from-red-400 to-red-900 flex items-center justify-center shadow-lg mb-1 animate-bounce">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M9 2a7 7 0 017 7v1h1a1 1 0 110 2h-1v1a7 7 0 11-14 0v-1H1a1 1 0 110-2h1V9a7 7 0 017-7z" />
                </svg>
            </div>
            <h1 class="text-3xl font-extrabold tracking-tight text-[#c92a2a] drop-shadow animate-fade-in">Panel Admin</h1>
        </div>
        
        <!-- Mensaje de bienvenida solo para admins -->
        <div class="mb-2 text-center animate-fade-in" style="color:#c92a2a;">
            ¡Bienvenido, administrador! Ingresa con tus credenciales para acceder al panel de gestión del sistema.
        </div>

        <x-auth-session-status class="text-center" :status="session('status')" />

        <form wire:submit.prevent="login" class="flex flex-col gap-6">
            <flux:input
                wire:model.defer="email"
                :label="__('Correo electrónico')"
                type="email"
                required
                autofocus
                autocomplete="email"
                placeholder="admin@example.com"
                label-classes="!text-[#c92a2a] !font-semibold"
                input-classes="!text-[#c92a2a]"
            />

            <div class="relative">
                <flux:input
                    wire:model.defer="password"
                    :label="__('Contraseña')"
                    type="password"
                    required
                    autocomplete="current-password"
                    placeholder="Contraseña"
                    viewable
                />

                @if (Route::has('password.request'))
                    <flux:link class="absolute end-0 top-0 text-sm" :href="route('password.request')" wire:navigate>
                        {{ __('¿Olvidaste tu contraseña?') }}
                    </flux:link>
                @endif
            </div>

            <flux:checkbox wire:model.defer="remember" :label="__('Recordarme')" />

            <div class="flex items-center justify-end">
                <flux:button variant="primary" type="submit" class="w-full">{{ __('Iniciar sesión') }}</flux:button>
            </div>
        </form>
    </div>
</div>