<?php

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    #[Locked]
    public string $token = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Mount the component.
     */
    public function mount(string $token): void
    {
        $this->token = $token;

        $this->email = request()->string('email');
    }

    /**
     * Reset the password for the given user.
     */
    public function resetPassword(): void
    {
        $this->validate([
            'token' => ['required'],
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $this->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) {
                $user->forceFill([
                    'password' => Hash::make($this->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        if ($status != Password::PasswordReset) {
            $this->addError('email', __($status));

            return;
        }

        Session::flash('status', __($status));

        $this->redirectRoute('login', navigate: true);
    }
}; ?>

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
        @keyframes pop {
            0% { transform: scale(0.85);}
            50% { transform: scale(1.03);}
            100% { transform: scale(1);}
        }
        .animate-fade-in-up { animation: fade-in-up 0.6s cubic-bezier(.4,2,.6,1) both; }
        .animate-pop { animation: pop 0.7s cubic-bezier(.4,2,.6,1) both; }
        input[type="email"], input[type="password"] {
            transition: box-shadow 0.2s, border-color 0.2s;
            background: rgba(255,255,255,0.95);
            box-shadow: 0 1px 3px rgba(31,38,135,0.06);
            color: #003366 !important;
        }
        input[type="email"]:focus, input[type="password"]:focus {
            border-color: #00509e;
            box-shadow: 0 2px 8px #00509e15;
        }
        .flux\:button, button[type="submit"] {
            background: #18B981 !important;
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
        label, .flux\:input label { color: #003366 !important; }
        .text-sm, .text-center, .text-muted, .flux\:link, .text-zinc-400 { color: #456 !important; }
        input::placeholder { color: #8696b8; opacity: 1; }
        h1, h2, .x-auth-header__title { color: #003366 !important; font-weight: bold; }
        button, .flux\:button, button[type="submit"] { color: #fff !important; text-shadow: 0 1px 6px rgba(0,80,158,0.11);}
    </style>
    <div class="login-glass w-full max-w-md mx-auto rounded-2xl shadow-2xl p-8 flex flex-col gap-8 animate-fade-in-up">
        <div class="flex flex-col items-center gap-2 mb-4 animate-pop">
            <div class="w-16 h-16 rounded-full bg-gradient-to-br from-blue-400 to-blue-900 flex items-center justify-center shadow-lg mb-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M9 2a7 7 0 017 7v1h1a1 1 0 110 2h-1v1a7 7 0 11-14 0v-1H1a1 1 0 110-2h1V9a7 7 0 017-7z" />
                </svg>
            </div>
            <h1 class="text-3xl font-extrabold tracking-tight text-[#003366] drop-shadow">Hospital EKO</h1>
        </div>
        <x-auth-header :title="__('Restablecer contraseña')" :description="__('Por favor, ingresa tu nueva contraseña a continuación')" />

        <x-auth-session-status class="text-center" :status="session('status')" />

        <form wire:submit.prevent="resetPassword" class="flex flex-col gap-6">
            <!-- Email Address -->
            <flux:input
                wire:model="email"
                :label="__('Correo electrónico')"
                type="email"
                required
                autocomplete="email"
            />

            <!-- Password -->
            <flux:input
                wire:model="password"
                :label="__('Contraseña')"
                type="password"
                required
                autocomplete="new-password"
                placeholder="Contraseña"
                viewable
            />

            <!-- Confirm Password -->
            <flux:input
                wire:model="password_confirmation"
                :label="__('Confirmar contraseña')"
                type="password"
                required
                autocomplete="new-password"
                placeholder="Confirmar contraseña"
                viewable
            />

            <div class="flex items-center justify-end">
                <flux:button type="submit" variant="primary" class="w-full">
                    {{ __('Restablecer contraseña') }}
                </flux:button>
            </div>
        </form>
    </div>
</div>
