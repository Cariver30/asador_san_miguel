@php
    $coverTextColor = $settings->text_color_cover ?? '#ffffff';
    $accentColor = $settings->button_color_cover ?? '#000000';
    $cardOpacity = $settings->card_opacity_cover ?? 1;
    $buttonFontSize = $settings->button_font_size_cover ?? 18;
    $fixedFontSize = $settings->fixed_bottom_font_size ?? 14;
    $fixedFontColor = $settings->fixed_bottom_font_color ?? '#000000';
    $fontFamily = $settings->font_family_cover ?? 'Arial, sans-serif';

    $parseHex = function ($hex) {
        $hex = ltrim($hex, '#');
        if (strlen($hex) === 3) {
            $hex = $hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2];
        }
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
        return [$r, $g, $b];
    };

    [$textR, $textG, $textB] = $parseHex($coverTextColor);
    [$accentR, $accentG, $accentB] = $parseHex($accentColor);
    $textRgb = "$textR, $textG, $textB";
    $accentRgb = "$accentR, $accentG, $accentB";
@endphp
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Asador San Miguel · Portada</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/flowbite@2.3.0/dist/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />

    <style>
        :root {
            --accent-color: {{ $accentColor }};
            --accent-rgb: {{ $accentRgb }};
            --text-color: {{ $coverTextColor }};
            --text-rgb: {{ $textRgb }};
            --card-opacity: {{ $cardOpacity }};
            --card-bg: rgba(0, 0, 0, {{ $cardOpacity }});
            --card-border: rgba({{ $textRgb }}, 0.18);
            --button-font-size: {{ $buttonFontSize }}px;
            --fixed-font-size: {{ $fixedFontSize }}px;
            --fixed-font-color: {{ $fixedFontColor }};
        }
        * {
            box-sizing: border-box;
        }
        body {
            font-family: {{ $fontFamily }};
            color: var(--text-color);
            min-height: 100vh;
            @if($settings && $settings->background_image_cover)
                background: url('{{ asset('storage/' . $settings->background_image_cover) }}') no-repeat center center fixed;
                background-size: cover;
            @else
                background-color: #000000;
            @endif
        }
        .panel {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 26px;
            padding: 1.6rem;
        }
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.35rem 0.9rem;
            border-radius: 999px;
            background: rgba(var(--accent-rgb), 0.18);
            color: var(--text-color);
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.2em;
        }
        .hero-title {
            font-size: clamp(1.8rem, 4vw, 2.6rem);
            font-weight: 600;
            line-height: 1.1;
        }
        .hero-text {
            font-size: 1rem;
            color: rgba(var(--text-rgb), 0.85);
        }
        .action-link {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.9rem 1rem;
            border-radius: 18px;
            border: 1px solid var(--card-border);
            background: var(--card-bg);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .action-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.12);
        }
        .action-icon {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            background: rgba(var(--accent-rgb), 0.2);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: var(--text-color);
        }
        .action-title {
            font-weight: 600;
        }
        .action-sub {
            font-size: 0.85rem;
            color: rgba(var(--text-rgb), 0.75);
        }
        .primary-cta {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.85rem 1.6rem;
            border-radius: 999px;
            background: var(--accent-color);
            color: #ffffff;
            font-weight: 600;
            font-size: var(--button-font-size);
            box-shadow: 0 12px 25px rgba(var(--accent-rgb), 0.35);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .primary-cta:hover {
            transform: translateY(-1px);
            box-shadow: 0 18px 30px rgba(var(--accent-rgb), 0.4);
        }
        .secondary-cta {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.8rem 1.4rem;
            border-radius: 999px;
            border: 1px solid var(--card-border);
            color: var(--text-color);
            font-weight: 600;
            font-size: calc(var(--button-font-size) * 0.9);
            background: var(--card-bg);
        }
        .vip-button {
            position: relative;
            width: 100%;
            height: 3.1rem;
            border-radius: 9999px;
            font-weight: 600;
            color: #fff;
            background: var(--accent-color);
            font-size: var(--button-font-size);
            transition: transform .2s ease, box-shadow .2s ease;
            overflow: hidden;
        }
        .vip-button::after {
            content: '';
            position: absolute;
            inset: 4px;
            border-radius: 9999px;
            border: 2px dashed rgba(255,255,255,0.6);
            animation: vipBlink 2.2s linear infinite;
            pointer-events: none;
        }
        .vip-button:hover {
            transform: scale(1.02);
            box-shadow: 0 0 22px rgba(var(--accent-rgb), 0.35);
        }
        .logo-shell {
            width: 110px;
            height: 110px;
            border-radius: 26px;
            padding: 10px;
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .logo-shell img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        .info-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 18px;
            padding: 1rem 1.2rem;
        }
        .info-label {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            color: rgba(var(--text-rgb), 0.75);
        }
        .info-value {
            margin-top: 0.35rem;
            font-weight: 600;
            font-size: 0.95rem;
        }
        .social-button {
            width: 48px;
            height: 48px;
            border-radius: 999px;
            background: var(--accent-color);
            color: #ffffff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.2s ease, background 0.2s ease, color 0.2s ease;
        }
        .social-button:hover {
            transform: scale(1.08);
            background: #ffffff;
            color: #000000;
        }
        .social-footer {
            position: fixed;
            bottom: 1.5rem;
            left: 0;
            right: 0;
            display: flex;
            justify-content: center;
            gap: 1rem;
            z-index: 40;
        }
        .special-card {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.9rem 1.1rem;
            border-radius: 18px;
            border: 1px solid var(--card-border);
            background: var(--card-bg);
            max-width: 360px;
            width: 100%;
            justify-content: space-between;
        }
        .special-card span {
            font-weight: 600;
        }
        }
        .fixed-info {
            font-size: var(--fixed-font-size);
            color: var(--fixed-font-color);
        }
        @keyframes vipBlink {
            0%, 100% { opacity: 0.2; }
            50% { opacity: 1; }
        }
        @media (min-width: 768px) {
            .logo-shell {
                width: 130px;
                height: 130px;
            }
        }
    </style>
</head>
<body>
    <div class="min-h-screen flex flex-col">
        <header class="mx-auto w-full max-w-6xl px-6 pt-8">
            <div class="flex flex-col gap-6 text-center lg:flex-row lg:items-center lg:justify-between lg:text-left">
                <div class="flex flex-col items-center gap-4 lg:flex-row">
                    @if($settings && $settings->logo)
                        <div class="logo-shell">
                            <img src="{{ asset('storage/' . $settings->logo) }}" alt="Logo del Restaurante" />
                        </div>
                    @endif
                    <div class="space-y-2">
                        <span class="badge">Asador San Miguel</span>
                        <h1 class="hero-title">Fuego lento, vino honesto.</h1>
                        <p class="hero-text">Una casa de brasas para celebrar en familia, amigos o eventos privados.</p>
                    </div>
                </div>
            </div>
        </header>

        <main class="mx-auto w-full max-w-6xl flex-1 px-6 py-10 pb-28">
            <div class="grid gap-6 lg:grid-cols-[1.05fr_0.95fr]">
                <section class="panel space-y-5">
                    <h2 class="hero-title">Sabores que nacen del fuego y el maridaje perfecto.</h2>
                    <p class="hero-text">Vive una experiencia completa: cortes a la parrilla, coctelería de autor y vinos seleccionados para cada ocasión.</p>
                    <div class="flex flex-wrap gap-3">
                        <a href="/menu" class="primary-cta">Ver menú</a>
                        <a href="{{ route('experiences.index') }}" class="secondary-cta">Eventos especiales</a>
                    </div>

                    <div class="grid gap-3 sm:grid-cols-3">
                        <div class="info-card">
                            <p class="info-label">Horario</p>
                            <p class="info-value">{{ $settings->business_hours ?? 'Horario no configurado' }}</p>
                        </div>
                        <div class="info-card">
                            <p class="info-label">Ambiente</p>
                            <p class="info-value">Pet friendly · Cocina abierta</p>
                        </div>
                        <div class="info-card">
                            <p class="info-label">Contacto</p>
                            <p class="info-value">{{ $settings->phone_number ?? 'Teléfono no configurado' }}</p>
                        </div>
                    </div>
                </section>

                <aside class="panel space-y-5">
                    <div>
                        <p class="text-xs uppercase tracking-[0.35em]">Explorar</p>
                        <h3 class="text-2xl font-semibold mt-2">Accesos rápidos</h3>
                        <p class="action-sub mt-2">Todo lo que necesitas en un solo lugar.</p>
                    </div>

                    <div class="grid gap-3">
                        <a href="/menu" class="action-link">
                            <span class="action-icon">🍽️</span>
                            <div>
                                <p class="action-title">Menú principal</p>
                                <p class="action-sub">Cortes, entradas y especiales</p>
                            </div>
                            <span class="ml-auto">→</span>
                        </a>
                        <a href="/cocktails" class="action-link">
                            <span class="action-icon">🍸</span>
                            <div>
                                <p class="action-title">Cócteles</p>
                                <p class="action-sub">Mixología y clásicos</p>
                            </div>
                            <span class="ml-auto">→</span>
                        </a>
                        <a href="/wines" class="action-link">
                            <span class="action-icon">🍷</span>
                            <div>
                                <p class="action-title">Vinos</p>
                                <p class="action-sub">Etiquetas para cada plato</p>
                            </div>
                            <span class="ml-auto">→</span>
                        </a>
                        <a href="{{ route('experiences.index') }}" class="action-link">
                            <span class="action-icon">🎟️</span>
                            <div>
                                <p class="action-title">Eventos especiales</p>
                                <p class="action-sub">Experiencias, cenas, shows</p>
                            </div>
                            <span class="ml-auto">→</span>
                        </a>
                        <a href="{{ route('reservations.app') }}" class="action-link">
                            <span class="action-icon">📅</span>
                            <div>
                                <p class="action-title">Reservas</p>
                                <p class="action-sub">Asegura tu mesa</p>
                            </div>
                            <span class="ml-auto">→</span>
                        </a>
                    </div>

                    @if(session('notification_success'))
                        <div id="subscriptionStatus" class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                            {{ session('notification_success') }}
                        </div>
                    @endif

                    <div class="info-card">
                        <p class="text-xs uppercase tracking-[0.35em]">Lista VIP</p>
                        <p class="action-sub mt-2">Recibe alertas de cenas especiales y promociones exclusivas.</p>
                        <button id="openNotifyModal" class="vip-button mt-4">Quiero ser VIP</button>
                        <p id="notifyStatus" class="text-xs mt-2 hidden">Ya estás suscrito a las alertas</p>
                    </div>
                </aside>
            </div>

            <div class="mt-6 flex justify-center">
                <a href="/menu#chef-special" class="special-card">
                    <div class="flex items-center gap-3">
                        <span>⭐</span>
                        <div>
                            <span>Especial del chef</span>
                            <p class="action-sub">Ver selección destacada</p>
                        </div>
                    </div>
                    <span>→</span>
                </a>
            </div>

            <div class="mt-8 flex flex-col items-center gap-2 fixed-info text-center">
                <p>{{ $settings->business_hours ?? 'Horario no configurado' }}</p>
                <div class="flex items-center justify-center gap-2">
                    <span>Pet Friendly</span>
                    <i class="fas fa-paw"></i>
                </div>
            </div>
        </main>
    </div>

    <footer class="social-footer">
        <a href="{{ $settings->facebook_url ?? '#' }}" target="_blank" class="social-button" aria-label="Facebook">
            <i class="fab fa-facebook-f"></i>
        </a>
        <a href="{{ $settings->instagram_url ?? '#' }}" target="_blank" class="social-button" aria-label="Instagram">
            <i class="fab fa-instagram"></i>
        </a>
        <a href="tel:{{ $settings->phone_number ?? '' }}" class="social-button" aria-label="Llamar">
            <i class="fas fa-phone"></i>
        </a>
    </footer>

    <div id="notifyModal" class="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center px-4 {{ ($errors->has('name') || $errors->has('email')) ? '' : 'hidden' }} z-50">
        <div class="bg-white text-slate-900 rounded-3xl w-full max-w-md p-6 relative">
            <button id="closeNotifyModal" class="absolute top-4 right-4 text-2xl text-slate-500 hover:text-slate-800" aria-label="Cerrar">&times;</button>
            <p class="text-xs uppercase tracking-[0.35em] text-amber-500 mb-2">Experiencias</p>
            <h2 class="text-2xl mb-2">Recibe las alertas VIP</h2>
            <p class="text-sm text-slate-500 mb-4">Entérate primero de nuevas experiencias, cenas especiales y eventos privados.</p>
            <form action="{{ route('experiences.notify.cover') }}" method="POST" class="space-y-3">
                @csrf
                <div>
                    <input type="text" name="name" placeholder="Tu nombre" value="{{ old('name') }}"
                           class="w-full px-4 py-2.5 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-amber-400">
                    @error('name')
                        <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <input type="email" name="email" placeholder="Correo electrónico" value="{{ old('email') }}"
                           class="w-full px-4 py-2.5 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-amber-400">
                    @error('email')
                        <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="w-full bg-slate-900 text-white py-3 rounded-2xl font-semibold hover:bg-slate-800 transition">
                    Quiero recibir noticias
                </button>
                <p class="text-xs text-slate-400 text-center">Prometemos solo enviar experiencias relevantes.</p>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal = document.getElementById('notifyModal');
            const openBtn = document.getElementById('openNotifyModal');
            const closeBtn = document.getElementById('closeNotifyModal');
            const statusBadge = document.getElementById('notifyStatus');
            const flash = document.getElementById('subscriptionStatus');
            const isRegistered = localStorage.getItem('eventNotifyRegistered') === '1';

            const openModal = () => {
                modal.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            };
            const closeModal = () => {
                modal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            };

            openBtn?.addEventListener('click', openModal);
            closeBtn?.addEventListener('click', closeModal);
            modal?.addEventListener('click', (e) => {
                if (e.target === modal) closeModal();
            });

            if (flash) {
                localStorage.setItem('eventNotifyRegistered', '1');
            }

            if (isRegistered && statusBadge) {
                statusBadge.classList.remove('hidden');
                openBtn.textContent = 'Actualizar datos';
            } else if (window.innerWidth < 768 && !modal.classList.contains('hidden')) {
                // already open due to errors
            } else if (window.innerWidth < 768 && !isRegistered) {
                setTimeout(() => {
                    if (modal.classList.contains('hidden')) {
                        openModal();
                    }
                }, 2000);
            }

            if (!modal.classList.contains('hidden')) {
                document.body.classList.add('overflow-hidden');
            }
        });
    </script>
</body>
</html>
