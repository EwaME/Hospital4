<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    /**
     * Send an email verification notification to the user.
     */
    public function sendVerification(): void
    {
        if (Auth::user()->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);

            return;
        }

        Auth::user()->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }

    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
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
        .login-glass, .login-glass * { color: #1a2442 !important; }
        h1, h2, h3 { color: #003366 !important; font-weight: bold; }
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
        .flux\:link, a.flux\:link {
            color: #18B981 !important;
            text-decoration: underline;
            cursor: pointer;
            font-weight: 500;
            letter-spacing: 0.01em;
        }
        .flux\:link:hover { color: #14996b !important; }
        .font-medium { font-weight: 600 !important; }
        .text-green-600 { color: #13a463 !important; }
        .text-center { text-align: center !important; }
    </style>
    <div class="login-glass w-full max-w-md mx-auto rounded-2xl shadow-2xl p-8 flex flex-col gap-8 animate-fade-in-up">
        <div class="flex flex-col items-center gap-2 mb-4 animate-pop">
            <div class="w-16 h-16 rounded-full bg-gradient-to-br from-blue-400 to-blue-900 flex items-center justify-center shadow-lg mb-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M9 2a7 7 0 017 7v1h1a1 1 0 110 2h-1v1a7 7 0 11-14 0v-1H1a1 1 0 110-2h1V9a7 7 0 017-7z" />
                </svg>
            </div>
            <h1 class="text-2xl font-extrabold tracking-tight text-[#003366] drop-shadow">Hospital EKO</h1>
        </div>

        <div class="flex flex-col gap-6 mt-2">
            <flux:text class="text-center">
                {{ __('Por favor, verifica tu correo electrónico haciendo clic en el enlace que te enviamos.') }}
            </flux:text>

            @if (session('status') == 'verification-link-sent')
                <flux:text class="text-center font-medium text-green-600">
                    {{ __('Se ha enviado un nuevo enlace de verificación al correo que registraste.') }}
                </flux:text>
            @endif

            <div class="flex flex-col items-center justify-between space-y-3 mt-2">
                <flux:button wire:click="sendVerification" variant="primary" class="w-full">
                    {{ __('Reenviar correo de verificación') }}
                </flux:button>
                <flux:link class="text-sm cursor-pointer" wire:click="logout">
                    {{ __('Cerrar sesión') }}
                </flux:link>
            </div>
        </div>
    </div>
</div>
