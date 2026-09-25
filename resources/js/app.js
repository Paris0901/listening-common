// Listening Common - Audio Player & Portfolio Interactivity

document.addEventListener('DOMContentLoaded', () => {
    // Master Native Audio Engine
    let audio = document.getElementById('master-podcast-player');
    if (!audio) {
        audio = new Audio();
        audio.id = 'master-podcast-player';
        document.body.appendChild(audio);
    }

    // Dock Player Elements
    const dock = document.getElementById('audio-dock');
    const playBtn = document.getElementById('dock-play-btn');
    const playIcon = document.getElementById('dock-play-icon');
    const pauseIcon = document.getElementById('dock-pause-icon');
    const titleEl = document.getElementById('dock-title');
    const subtitleEl = document.getElementById('dock-subtitle');
    const coverArtEl = document.getElementById('dock-cover-art');
    const currentTimeEl = document.getElementById('dock-current-time');
    const totalTimeEl = document.getElementById('dock-total-time');
    const progressBar = document.getElementById('dock-progress-bar');
    const progressBarMobile = document.getElementById('dock-progress-bar-mobile');
    const progressContainer = document.getElementById('dock-progress-container');
    const progressContainerMobile = document.getElementById('dock-progress-container-mobile');
    const speedBtn = document.getElementById('dock-speed-btn');

    let totalSeconds = 0;
    const speedRates = [1.0, 1.25, 1.5, 2.0];
    let currentSpeedIdx = 0;

    function formatTime(seconds) {
        if (isNaN(seconds) || seconds < 0) return '00:00';
        const s = Math.floor(seconds);
        const mins = Math.floor(s / 60);
        const secs = s % 60;
        if (mins >= 60) {
            const hrs = Math.floor(mins / 60);
            const remMins = mins % 60;
            return `${String(hrs).padStart(2, '0')}:${String(remMins).padStart(2, '0')}:${String(secs).padStart(2, '0')}`;
        }
        return `${String(mins).padStart(2, '0')}:${String(secs).padStart(2, '0')}`;
    }

    function setProgressPct(pct) {
        const clamped = Math.max(0, Math.min(100, pct));
        if (progressBar) progressBar.style.width = `${clamped}%`;
        if (progressBarMobile) progressBarMobile.style.width = `${clamped}%`;
    }

    function updatePlayUi(isPlaying) {
        if (isPlaying) {
            if (playIcon) playIcon.classList.add('hidden');
            if (pauseIcon) pauseIcon.classList.remove('hidden');
        } else {
            if (playIcon) playIcon.classList.remove('hidden');
            if (pauseIcon) pauseIcon.classList.add('hidden');
        }
    }

    // Audio Event Handlers
    audio.addEventListener('play', () => updatePlayUi(true));
    audio.addEventListener('pause', () => updatePlayUi(false));
    audio.addEventListener('ended', () => {
        updatePlayUi(false);
        setProgressPct(100);
    });

    audio.addEventListener('timeupdate', () => {
        if (!isNaN(audio.currentTime)) {
            if (currentTimeEl) currentTimeEl.textContent = formatTime(audio.currentTime);
            const duration = audio.duration || totalSeconds;
            if (duration > 0) {
                const pct = (audio.currentTime / duration) * 100;
                setProgressPct(pct);
            }
        }
    });

    audio.addEventListener('loadedmetadata', () => {
        if (audio.duration && !isNaN(audio.duration) && audio.duration > 0) {
            totalSeconds = audio.duration;
            if (totalTimeEl) totalTimeEl.textContent = formatTime(audio.duration);
        }
    });

    audio.addEventListener('error', (e) => {
        console.error('Audio playback error on source:', audio.src, e);
        updatePlayUi(false);
    });

    // Play/Pause Button
    playBtn?.addEventListener('click', () => {
        if (!audio.src) return;
        if (audio.paused) {
            audio.play().catch(err => console.warn('Play was prevented:', err));
        } else {
            audio.pause();
        }
    });

    // Rewind 15s / Forward 30s
    document.getElementById('dock-prev-btn')?.addEventListener('click', () => {
        audio.currentTime = Math.max(0, audio.currentTime - 15);
    });

    document.getElementById('dock-next-btn')?.addEventListener('click', () => {
        const dur = audio.duration || totalSeconds;
        audio.currentTime = Math.min(dur, audio.currentTime + 30);
    });

    // Scrubbing
    function handleScrub(container, e) {
        const rect = container.getBoundingClientRect();
        const clickRatio = Math.max(0, Math.min(1, (e.clientX - rect.left) / rect.width));
        const dur = audio.duration || totalSeconds;
        if (dur > 0) {
            audio.currentTime = clickRatio * dur;
            setProgressPct(clickRatio * 100);
        }
    }

    progressContainer?.addEventListener('click', (e) => handleScrub(progressContainer, e));
    progressContainerMobile?.addEventListener('click', (e) => handleScrub(progressContainerMobile, e));

    // Playback Speed
    speedBtn?.addEventListener('click', () => {
        currentSpeedIdx = (currentSpeedIdx + 1) % speedRates.length;
        const rate = speedRates[currentSpeedIdx];
        audio.playbackRate = rate;
        speedBtn.textContent = `${rate.toFixed(1)}x`;
    });

    function openDockWithTrack(btn) {
        if (!dock) return;
        const audioUrl = btn.dataset.audio || '';
        const title = btn.dataset.title || 'The Listening Commons Conversation';
        const guest = btn.dataset.guest || 'Featured Guest';
        const duration = btn.dataset.duration || '45:00';
        const cover = btn.dataset.cover || '#1';

        if (titleEl) titleEl.textContent = title;
        if (subtitleEl) subtitleEl.textContent = `The Listening Commons \u2022 with ${guest}`;
        if (totalTimeEl) totalTimeEl.textContent = duration;

        // Cover Art Display (Image or Monogram)
        if (coverArtEl) {
            if (cover && (cover.startsWith('http') || cover.startsWith('/'))) {
                coverArtEl.innerHTML = `<img src="${cover}" alt="${title}" class="w-full h-full object-cover">`;
            } else {
                coverArtEl.textContent = cover;
            }
        }

        // Parse duration fallback
        const parts = duration.split(':');
        if (parts.length === 3) {
            totalSeconds = parseInt(parts[0], 10) * 3600 + parseInt(parts[1], 10) * 60 + parseInt(parts[2], 10);
        } else if (parts.length === 2) {
            totalSeconds = parseInt(parts[0], 10) * 60 + parseInt(parts[1], 10);
        } else {
            totalSeconds = 2700;
        }

        // Reveal Dock Player
        dock.classList.add('is-open');
        dock.setAttribute('data-open', 'true');
        dock.classList.remove('translate-y-full', 'opacity-0', 'pointer-events-none', 'invisible');
        dock.style.display = 'block';
        dock.style.transform = 'translateY(0)';
        dock.style.opacity = '1';
        dock.style.visibility = 'visible';
        dock.style.pointerEvents = 'auto';

        // Play real audio stream
        if (audioUrl) {
            if (audio.src !== audioUrl) {
                audio.src = audioUrl;
                audio.load();
            }
            const playPromise = audio.play();
            if (playPromise !== undefined) {
                playPromise.then(() => {
                    updatePlayUi(true);
                }).catch(err => {
                    console.warn('Playback autoplay was blocked by browser. User interaction needed:', err);
                    updatePlayUi(false);
                });
            }
        }
    }

    function closeDockPlayer() {
        if (!dock) return;
        audio.pause();
        updatePlayUi(false);
        dock.classList.remove('is-open');
        dock.removeAttribute('data-open');
        dock.classList.add('translate-y-full', 'opacity-0', 'pointer-events-none', 'invisible');
        dock.style.transform = 'translateY(120%)';
        dock.style.opacity = '0';
        dock.style.visibility = 'hidden';
        dock.style.pointerEvents = 'none';
    }

    // Global Event Delegation for all Play Buttons (Mobile + Desktop)
    document.addEventListener('click', (e) => {
        const btn = e.target.closest('.play-track-btn, .hero-play-btn, [data-play-trigger]');
        if (btn) {
            e.preventDefault();
            e.stopPropagation();
            openDockWithTrack(btn);
            return;
        }

        const close = e.target.closest('#dock-close-btn');
        if (close) {
            e.preventDefault();
            e.stopPropagation();
            closeDockPlayer();
        }
    });

    // Episode Category Filter Pills
    const filterButtons = document.querySelectorAll('.filter-btn');
    const episodeCards = document.querySelectorAll('.episode-card');

    filterButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            filterButtons.forEach(b => {
                b.classList.remove('bg-[#2DD4BF]', 'text-[#060913]', 'active');
                b.classList.add('bg-[#0E1626]', 'text-zinc-300');
            });
            btn.classList.add('bg-[#2DD4BF]', 'text-[#060913]', 'active');
            btn.classList.remove('bg-[#0E1626]', 'text-zinc-300');

            const filter = btn.dataset.filter;
            episodeCards.forEach(card => {
                if (filter === 'all' || card.dataset.category === filter) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

    // Mobile Navigation Drawer Toggle & Slide-Over Animation
    const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
    const mobileNavDrawer = document.getElementById('mobile-nav-drawer');
    const mobileDrawerBackdrop = document.getElementById('mobile-drawer-backdrop');
    const mobileDrawerClose = document.getElementById('mobile-drawer-close');

    function openMobileDrawer() {
        if (!mobileNavDrawer || !mobileDrawerBackdrop) return;
        mobileDrawerBackdrop.classList.remove('opacity-0', 'pointer-events-none');
        mobileDrawerBackdrop.classList.add('opacity-100', 'pointer-events-auto');
        mobileNavDrawer.classList.remove('translate-x-full');
        mobileNavDrawer.classList.add('translate-x-0');
        document.body.style.overflow = 'hidden';
    }

    function closeMobileDrawer() {
        if (!mobileNavDrawer || !mobileDrawerBackdrop) return;
        mobileDrawerBackdrop.classList.remove('opacity-100', 'pointer-events-auto');
        mobileDrawerBackdrop.classList.add('opacity-0', 'pointer-events-none');
        mobileNavDrawer.classList.remove('translate-x-0');
        mobileNavDrawer.classList.add('translate-x-full');
        document.body.style.overflow = '';
    }

    mobileMenuToggle?.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();
        openMobileDrawer();
    });

    mobileDrawerClose?.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();
        closeMobileDrawer();
    });

    mobileDrawerBackdrop?.addEventListener('click', () => {
        closeMobileDrawer();
    });

    // Auto-close mobile drawer when any link inside is tapped
    mobileNavDrawer?.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => {
            closeMobileDrawer();
        });
    });

    // Close on Escape key press
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeMobileDrawer();
        }
    });

    // Waveform bar visual interactivity (matching reference design)
    const waveformBars = document.querySelectorAll('.waveform-bar');
    waveformBars.forEach((bar, idx) => {
        bar.addEventListener('click', () => {
            waveformBars.forEach((b, i) => {
                if (i <= idx) {
                    b.classList.add('bg-[#2DD4BF]');
                    b.classList.remove('bg-[#1E2D4A]');
                } else {
                    b.classList.remove('bg-[#2DD4BF]');
                    b.classList.add('bg-[#1E2D4A]');
                }
            });
        });
    });
});

