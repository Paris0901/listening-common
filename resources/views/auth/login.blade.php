<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CMS Editorial Login — The Listening Commons</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#080B11] text-[#F4F4F0] antialiased min-h-screen flex flex-col justify-between selection:bg-[#2DD4BF] selection:text-[#080B11] relative overflow-x-hidden">

    <!-- Ambient Aurora Glow Behind Card -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden z-0">
        <div class="absolute -top-40 left-1/2 -translate-x-1/2 w-[700px] h-[500px] bg-gradient-to-b from-[#2DD4BF]/10 via-[#1C2D4F]/20 to-transparent blur-3xl opacity-60"></div>
        <div class="absolute bottom-0 right-1/4 w-[400px] h-[400px] bg-[#2E1A47]/15 blur-3xl rounded-full"></div>
    </div>

    <!-- Header bar -->
    <header class="relative z-10 w-full border-b border-[#1C263A]/80 bg-[#06080D]/70 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <span class="w-8 h-8 border border-[#2DD4BF]/30 flex items-center justify-center font-display font-bold text-xs tracking-wider bg-[#0E1420] text-[#2DD4BF] group-hover:border-[#2DD4BF] group-hover:bg-[#2DD4BF]/10 transition-all duration-300">
                    LC
                </span>
                <span class="font-display font-medium text-sm tracking-wide text-[#F4F4F0] group-hover:text-[#2DD4BF] transition-colors">
                    The Listening Commons
                </span>
            </a>

            <a href="{{ route('home') }}" class="text-xs font-mono text-[#8E9BB0] hover:text-[#2DD4BF] transition-colors flex items-center gap-1.5">
                <span>&larr; Return to Public Portal</span>
            </a>
        </div>
    </header>

    <!-- Main Login Container -->
    <main class="relative z-10 flex-1 flex items-center justify-center px-4 sm:px-6 py-12 sm:py-16">
        <div class="w-full max-w-md">

            <!-- Brand Seal & Intro -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-14 h-14 border border-[#2DD4BF]/40 bg-[#0E1420] shadow-xl shadow-[#000000]/60 mb-4 relative group">
                    <span class="font-display font-bold text-lg text-[#2DD4BF] tracking-wider">LC</span>
                    <span class="absolute -top-1 -right-1 w-2 h-2 rounded-full bg-[#2DD4BF] animate-pulse"></span>
                </div>
                <h1 class="font-display text-2xl sm:text-3xl font-medium tracking-tight text-[#F4F4F0]">
                    Editorial Publishing CMS
                </h1>
                <p class="text-xs text-[#8E9BB0] mt-2 max-w-xs mx-auto leading-relaxed">
                    Single-source canonical publishing, podcast media syndication, and human-in-the-loop distribution queue.
                </p>
            </div>

            <!-- Flash Alerts -->
            @if(session('success'))
            <div class="mb-6 p-3.5 rounded-lg bg-[#0E1C1A] border border-[#22C55E]/30 text-[#86EFAC] text-xs font-mono flex items-center gap-2.5">
                <svg class="w-4 h-4 shrink-0 text-[#22C55E]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
            @endif

            @if($errors->any())
            <div class="mb-6 p-3.5 rounded-lg bg-[#2A1116] border border-[#EF4444]/30 text-[#FCA5A5] text-xs font-mono">
                <div class="flex items-center gap-2 mb-1 font-semibold">
                    <svg class="w-4 h-4 shrink-0 text-[#EF4444]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <span>Authentication Failed</span>
                </div>
                <p class="text-[11px] text-[#FCA5A5]/90 pl-6">
                    {{ $errors->first() }}
                </p>
            </div>
            @endif

            <!-- Login Card -->
            <div class="bg-[#0C1220]/90 backdrop-blur-xl border border-[#1C263A] rounded-xl p-6 sm:p-8 shadow-2xl shadow-black/80 relative">
                
                <form action="{{ route('login') }}" method="POST" class="space-y-5" id="cms-login-form">
                    @csrf

                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-xs font-mono font-medium uppercase tracking-wider text-[#C5CEE0] mb-2 flex items-center justify-between">
                            <span>Email Address</span>
                            <span class="text-[10px] text-[#8E9BB0] lowercase">required</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-[#5A6882]">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                            </div>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                value="{{ old('email', 'admin@listeningcommons.com') }}" 
                                required 
                                autofocus 
                                autocomplete="email"
                                placeholder="name@listeningcommons.com" 
                                class="w-full pl-10 pr-3.5 py-2.5 rounded-lg bg-[#06080D] border border-[#1C263A] text-xs font-mono text-[#F4F4F0] placeholder-[#5A6882] focus:outline-none focus:border-[#2DD4BF] focus:ring-1 focus:ring-[#2DD4BF] transition-colors"
                            >
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-xs font-mono font-medium uppercase tracking-wider text-[#C5CEE0] mb-2 flex items-center justify-between">
                            <span>Password</span>
                            <span class="text-[10px] text-[#8E9BB0] lowercase">required</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-[#5A6882]">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                value="password" 
                                required 
                                autocomplete="current-password"
                                placeholder="••••••••" 
                                class="w-full pl-10 pr-10 py-2.5 rounded-lg bg-[#06080D] border border-[#1C263A] text-xs font-mono text-[#F4F4F0] placeholder-[#5A6882] focus:outline-none focus:border-[#2DD4BF] focus:ring-1 focus:ring-[#2DD4BF] transition-colors"
                            >
                            <button 
                                type="button" 
                                id="toggle-password" 
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-[#5A6882] hover:text-[#2DD4BF] transition-colors cursor-pointer"
                                aria-label="Toggle password visibility"
                            >
                                <svg id="eye-icon" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between pt-1">
                        <label class="flex items-center gap-2 cursor-pointer select-none">
                            <input 
                                type="checkbox" 
                                name="remember" 
                                id="remember" 
                                checked
                                class="w-4 h-4 rounded border-[#1C263A] bg-[#06080D] text-[#2DD4BF] focus:ring-0 focus:ring-offset-0 accent-[#2DD4BF] cursor-pointer"
                            >
                            <span class="text-xs text-[#8E9BB0] font-mono">Keep me signed in</span>
                        </label>
                        <span class="text-[11px] text-[#5A6882] font-mono">256-bit encrypted</span>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-2">
                        <button 
                            type="submit" 
                            class="w-full py-3 px-4 rounded-lg bg-gradient-to-r from-[#5EEAD4] via-[#2DD4BF] to-[#0D9488] text-[#080B11] font-mono font-bold text-xs uppercase tracking-wider hover:brightness-110 active:scale-[0.99] transition-all shadow-lg shadow-[#2DD4BF]/20 flex items-center justify-center gap-2 cursor-pointer"
                        >
                            <span>Enter the Commons CMS</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                    </div>
                </form>

                <!-- Credentials helper pill for convenient review -->
                <div class="mt-6 pt-5 border-t border-[#1C263A]/80 bg-[#080C16]/60 -mx-6 sm:-mx-8 -mb-6 sm:-mb-8 p-4 sm:px-8 rounded-b-xl">
                    <div class="flex items-center justify-between text-[11px] font-mono">
                        <span class="text-[#8E9BB0]">Editorial Access:</span>
                        <span class="text-[#2DD4BF] font-semibold">admin@listeningcommons.com</span>
                    </div>
                    <div class="flex items-center justify-between text-[11px] font-mono mt-1">
                        <span class="text-[#8E9BB0]">Default Key:</span>
                        <span class="text-[#C5CEE0]">password</span>
                    </div>
                </div>

            </div>

            <!-- Footer note -->
            <div class="text-center mt-8">
                <p class="text-[11px] font-mono text-[#5A6882]">
                    The Listening Commons &bull; Confidential Editorial Portal &bull; &copy; {{ date('Y') }}
                </p>
            </div>

        </div>
    </main>

    <footer class="relative z-10 py-4 text-center text-xs text-[#5A6882] font-mono border-t border-[#1C263A]/50 bg-[#06080D]/50">
        In collaboration with the WICCI National Psychosocial &amp; Mental Wellness Council
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleBtn = document.getElementById('toggle-password');
            const passwordInput = document.getElementById('password');
            if (toggleBtn && passwordInput) {
                toggleBtn.addEventListener('click', function () {
                    const isPassword = passwordInput.getAttribute('type') === 'password';
                    passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                    toggleBtn.innerHTML = isPassword 
                        ? '<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" /></svg>'
                        : '<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>';
                });
            }
        });
    </script>
</body>
</html>
