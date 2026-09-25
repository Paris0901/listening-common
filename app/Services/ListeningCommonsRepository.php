<?php

namespace App\Services;

use App\Models\Episode;
use App\Models\Guest;
use App\Models\Theme;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;

class ListeningCommonsRepository
{
    /**
     * Check whether database tables are present and queryable.
     */
    public function isDatabaseReady(): bool
    {
        try {
            return Schema::hasTable('episodes') && Schema::hasTable('guests') && Schema::hasTable('themes');
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Get all themes with episode counts.
     */
    public function getThemes(): Collection
    {
        if ($this->isDatabaseReady()) {
            return Theme::withCount('episodes')->get();
        }

        return collect($this->fallbackThemes());
    }

    /**
     * Find single theme by slug.
     */
    public function findThemeBySlug(string $slug): ?object
    {
        if ($this->isDatabaseReady()) {
            return Theme::where('slug', $slug)->with(['episodes.guest', 'episodes.themes'])->first();
        }

        return collect($this->fallbackThemes())->firstWhere('slug', $slug);
    }

    /**
     * Get all guests.
     */
    public function getGuests(): Collection
    {
        if ($this->isDatabaseReady()) {
            return Guest::withCount('episodes')->get();
        }

        return collect($this->fallbackGuests());
    }

    /**
     * Find guest by slug with their episodes.
     */
    public function findGuestBySlug(string $slug): ?object
    {
        if ($this->isDatabaseReady()) {
            return Guest::where('slug', $slug)->with('episodes.themes')->first();
        }

        return collect($this->fallbackGuests())->firstWhere('slug', $slug);
    }

    /**
     * Get latest published episodes.
     */
    public function getEpisodes(?string $themeSlug = null, ?string $search = null): Collection
    {
        if ($this->isDatabaseReady()) {
            $query = Episode::with(['guest', 'themes'])
                ->where('is_published', true)
                ->orderByDesc('published_at');

            if ($themeSlug) {
                $query->whereHas('themes', function ($q) use ($themeSlug) {
                    $q->where('slug', $themeSlug);
                });
            }

            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('short_description', 'like', "%{$search}%")
                        ->orWhereHas('guest', function ($g) use ($search) {
                            $g->where('name', 'like', "%{$search}%");
                        });
                });
            }

            return $query->get();
        }

        $episodes = collect($this->fallbackEpisodes());

        if ($themeSlug) {
            $episodes = $episodes->filter(function ($ep) use ($themeSlug) {
                return collect($ep->themes)->contains('slug', $themeSlug);
            });
        }

        if ($search) {
            $s = strtolower($search);
            $episodes = $episodes->filter(function ($ep) use ($s) {
                return str_contains(strtolower($ep->title), $s) ||
                       str_contains(strtolower($ep->short_description), $s) ||
                       str_contains(strtolower($ep->guest->name ?? ''), $s);
            });
        }

        return $episodes->values();
    }

    /**
     * Get featured episode for the hero section.
     */
    public function getFeaturedEpisode(): ?object
    {
        if ($this->isDatabaseReady()) {
            return Episode::with(['guest', 'themes'])
                ->where('is_published', true)
                ->where('is_featured', true)
                ->latest('published_at')
                ->first() ?? Episode::with(['guest', 'themes'])->latest('published_at')->first();
        }

        return collect($this->fallbackEpisodes())->firstWhere('is_featured', true) ?? collect($this->fallbackEpisodes())->first();
    }

    /**
     * Find episode by slug.
     */
    public function findEpisodeBySlug(string $slug): ?object
    {
        if ($this->isDatabaseReady()) {
            return Episode::where('slug', $slug)
                ->with(['guest', 'themes'])
                ->first();
        }

        return collect($this->fallbackEpisodes())->firstWhere('slug', $slug);
    }

    /**
     * Generate multi-channel distribution drafts for an episode.
     */
    public function generateDistributionDrafts(object $episode): array
    {
        $guestName = $episode->guest->name ?? 'our guest';
        $guestDesignation = $episode->guest->designation ?? '';
        $title = $episode->title;
        $url = url('/episodes/'.$episode->slug);
        $quotes = is_array($episode->key_quotations) ? $episode->key_quotations : json_decode($episode->key_quotations ?? '[]', true);
        $firstQuote = $quotes[0]['quote'] ?? 'When silence is treated as empty space to be rushed through, we forfeit the sacred stillness where understanding actually takes root.';

        return [
            [
                'channel' => 'substack',
                'title' => "{$title} (The Listening Commons Companion Digest)",
                'status' => 'draft',
                'content' => "Dear Community,\n\nIn our latest conversation on The Listening Commons, {$guestName} ({$guestDesignation}) shared a reflection that cuts straight to the core of our shared human dignity:\n\n\"{$firstQuote}\"\n\nWHY THIS MATTERS:\nIn an accelerating world characterized by reactive noise, deep listening is a revolutionary act of hospitality. This dialogue deconstructs our assumptions and offers practical wisdom for living with intentional presence.\n\nKEY TAKEAWAYS:\n• The distinction between passive silence and fertile stillness.\n• How shared vulnerability builds trust across ideological fissures.\n• Moving from transactional debate to transformative common ground.\n\nListen to the audio, view the film, or read the full crawlable transcript:\n{$url}\n\nWith warmth,\nMarcus Chen & The Listening Commons Editorial Team",
            ],
            [
                'channel' => 'linkedin',
                'title' => "Thought Leadership: {$guestName} on {$title}",
                'status' => 'draft',
                'content' => "What does it mean to build common ground before demanding agreement?\n\nIn our newest episode of The Listening Commons, {$guestName} ({$guestDesignation}) offered a profound insight for leaders, mediators, and cultural thinkers:\n\n\"{$firstQuote}\"\n\nTrue dialogue requires the courage to pause, to listen past discomfort, and to recognize that every lived experience carries inviolable dignity.\n\nExplore the full episode and transcript:\n{$url}?utm_source=linkedin&utm_medium=social\n\n#TheListeningCommons #HumanDignity #Leadership #Dialogue #Culture",
            ],
            [
                'channel' => 'instagram',
                'title' => "Carousel & Audio Reel Hook: Ep. {$episode->episode_number}",
                'status' => 'draft',
                'content' => "\"{$firstQuote}\"\n\n— {$guestName}, on Episode {$episode->episode_number} of The Listening Commons.\n\nSwipe through for 3 key insights from this week's exploration into lived experience and moral courage.\n\n🎧 Full episode, video recording, and complete transcript available at the link in bio or listeningcommons.com.\n\n#TheListeningCommons #DeepListening #MentalHealth #HumanDignity #PodcastCommunity #Stillness",
            ],
            [
                'channel' => 'youtube',
                'title' => "{$title} | {$guestName} | The Listening Commons Ep. {$episode->episode_number}",
                'status' => 'draft',
                'content' => "Welcome to The Listening Commons — where conversations become common ground.\n\nIn Episode {$episode->episode_number}, Marcus Chen sits down with {$guestName} ({$guestDesignation}) to discuss {$episode->short_description}.\n\nTIMESTAMPS & CHAPTERS:\n00:00 - Introduction\n01:30 - The Foundation of Lived Experience\n06:45 - The Courage to Hold Silence\n14:20 - Navigating Complexity & Nuance\n28:50 - Restorative Practices for Daily Life\n\nCanonical Show Notes, Interactive Transcript & Links:\n{$url}\n\nSubscribe to the Podcast:\nSpotify: https://open.spotify.com\nApple Podcasts: https://podcasts.apple.com\n\n#TheListeningCommons #Podcast #Interview",
            ],
            [
                'channel' => 'facebook',
                'title' => "Community Discussion: {$title}",
                'status' => 'draft',
                'content' => "When was the last time a conversation changed how you saw the world?\n\nIn Episode {$episode->episode_number} of The Listening Commons, {$guestName} reminds us: \"{$firstQuote}\"\n\nJoin the conversation and listen here: {$url}?utm_source=facebook&utm_medium=social",
            ],
        ];
    }

    /**
     * Get distribution queue drafts.
     */
    public function getDistributionDrafts(): Collection
    {
        if ($this->isDatabaseReady() && Schema::hasTable('distribution_drafts')) {
            return DistributionDraft::with('episode.guest')->latest()->get();
        }

        return collect($this->fallbackDistributionDrafts());
    }

    /**
     * Fallback Theme Data
     */
    public function fallbackThemes(): array
    {
        return [
            (object) [
                'id' => 1,
                'name' => 'Mental Health',
                'slug' => 'mental-health',
                'tagline' => 'Healing, interiority, and relational resilience',
                'description' => 'Examining the deep terrain of psychic well-being, grief, and emotional sanctuary in an accelerating world.',
                'color_accent' => '#C59B27',
                'episodes_count' => 3,
            ],
            (object) [
                'id' => 2,
                'name' => 'Human Dignity',
                'slug' => 'human-dignity',
                'tagline' => 'The inviolable worth of every voice',
                'description' => 'Conversations rooted in moral courage, human rights, and the recognition of our collective humanity.',
                'color_accent' => '#0E1738',
                'episodes_count' => 3,
            ],
            (object) [
                'id' => 3,
                'name' => 'Peace & Reconciliation',
                'slug' => 'peace-reconciliation',
                'tagline' => 'Building bridges across intractable divides',
                'description' => 'Exploring restorative justice, conflict transformation, and dialogue where listening becomes radical hospitality.',
                'color_accent' => '#C59B27',
                'episodes_count' => 1,
            ],
            (object) [
                'id' => 4,
                'name' => 'Gender & Belonging',
                'slug' => 'gender-belonging',
                'tagline' => 'Power, care, and equitable futures',
                'description' => 'Interrogating structural identity, feminist perspectives, and the cultivation of spaces where everyone can flourish.',
                'color_accent' => '#0E1738',
                'episodes_count' => 2,
            ],
            (object) [
                'id' => 5,
                'name' => 'AI & Humanity',
                'slug' => 'ai-humanity',
                'tagline' => 'Ethics, consciousness, and preserving what is human',
                'description' => 'Probing how artificial intelligence reshapes human meaning, relational bonds, and cultural autonomy.',
                'color_accent' => '#C59B27',
                'episodes_count' => 1,
            ],
            (object) [
                'id' => 6,
                'name' => 'Responsible Storytelling',
                'slug' => 'responsible-storytelling',
                'tagline' => 'The ethics of voice and representation',
                'description' => 'Crafting narratives that protect vulnerability, counter dehumanization, and honor lived experience.',
                'color_accent' => '#0E1738',
                'episodes_count' => 2,
            ],
            (object) [
                'id' => 7,
                'name' => 'Culture & Lived Experience',
                'slug' => 'culture-lived-experience',
                'tagline' => 'Wisdom passed through generations and memory',
                'description' => 'Stories drawn from oral histories, diaspora memories, and the quiet dignity of ordinary perseverance.',
                'color_accent' => '#C59B27',
                'episodes_count' => 2,
            ],
        ];
    }

    /**
     * Fallback Guest Data
     */
    public function fallbackGuests(): array
    {
        return [
            (object) [
                'id' => 1,
                'name' => 'Patricia Elias',
                'slug' => 'patricia-elias',
                'designation' => 'Senior Advisor on Peacebuilding & UNSCR 1325 Lead',
                'affiliation' => 'Global Women, Peace & Security Initiative',
                'bio' => 'Patricia Elias is an international senior advisor specializing in the implementation of United Nations Security Council Resolution 1325 (UNSCR 1325), female leadership in conflict negotiation, and human dignity diplomacy.',
                'photo_url' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=600&q=80',
                'website_url' => 'https://listeningcommons.com',
                'linkedin_url' => 'https://linkedin.com',
                'twitter_url' => 'https://twitter.com',
                'episodes_count' => 1,
            ],
            (object) [
                'id' => 2,
                'name' => 'Dr. Kersi Chavda',
                'slug' => 'dr-kersi-chavda',
                'designation' => 'Senior Consultant Psychiatrist & Former President BPS',
                'affiliation' => 'P.D. Hinduja Hospital & National Mental Health Advisory',
                'bio' => 'Dr. Kersi Chavda is one of India’s foremost consultant psychiatrists, celebrated for pioneering adolescent psychiatric care, LGBTQ+ affirmative therapy, and ethical guidelines for national suicide prevention.',
                'photo_url' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=600&q=80',
                'website_url' => 'https://listeningcommons.com',
                'linkedin_url' => 'https://linkedin.com',
                'twitter_url' => 'https://twitter.com',
                'episodes_count' => 2,
            ],
            (object) [
                'id' => 3,
                'name' => 'Dr. Nimesh Desai',
                'slug' => 'dr-nimesh-desai',
                'designation' => 'Senior Psychiatrist & Former Director IHBAS',
                'affiliation' => 'Institute of Human Behaviour and Allied Sciences',
                'bio' => 'Dr. Nimesh Desai is an eminent public mental health pioneer and former director of IHBAS Delhi, dedicated to psychiatric education, the courage to unlearn dogma, and patient-centered clinical compassion.',
                'photo_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=600&q=80',
                'website_url' => 'https://listeningcommons.com',
                'linkedin_url' => 'https://linkedin.com',
                'twitter_url' => 'https://twitter.com',
                'episodes_count' => 1,
            ],
            (object) [
                'id' => 4,
                'name' => 'Praver Awal',
                'slug' => 'praver-awal',
                'designation' => 'Filmmaker, Creative Director & Organ Donation Advocate',
                'affiliation' => 'Lived Experience & Resilience Studio',
                'bio' => 'Praver Awal is an acclaimed Indian filmmaker and creator who survived a historic 39-hour emergency liver transplant, inspiring thousands through his journey of resilience, mindfulness, and creative rebirth ("Praver Awal 2.0").',
                'photo_url' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=600&q=80',
                'website_url' => 'https://listeningcommons.com',
                'linkedin_url' => 'https://linkedin.com',
                'twitter_url' => 'https://twitter.com',
                'episodes_count' => 1,
            ],
        ];
    }

    /**
     * Fallback Master Episodes Data
     */
    public function fallbackEpisodes(): array
    {
        $guests = $this->fallbackGuests();
        $themes = $this->fallbackThemes();

        return [
            (object) [
                'id' => 1,
                'episode_number' => 1,
                'title' => 'Women, Peace & Security: UNSCR 1325 and Global Humanitarian Diplomacy',
                'slug' => 'patricia-elias-women-peace-security-unscr-1325',
                'guest' => $guests[0],
                'host_names' => 'Scott Douglas Jacobsen & The Listening Commons Team',
                'short_description' => 'Senior Advisor Patricia Elias joins host Scott Douglas Jacobsen to examine United Nations Security Council Resolution 1325, the indispensable leadership of women in war de-escalation, and restoring human dignity across shattered borders.',
                'full_show_notes' => '<h3>About this Dialogue</h3><p>In this foundational conversation on <em>The Listening Commons</em>, Senior Advisor Patricia Elias joins host Scott Douglas Jacobsen to reflect on United Nations Security Council Resolution 1325 (UNSCR 1325) and the transformative role of women in peace negotiation and conflict reconciliation.</p><h3>Core Themes Explored</h3><ul><li>Why sustainable peace requires women at the center of constitutional and ceasefire dialogues.</li><li>Moving past transactional diplomacy toward relational trust and generational dignity.</li><li>De-escalation practices in zones of deep ideological and geopolitical friction.</li></ul>',
                'key_quotations' => [
                    ['quote' => 'Peace is not the passive absence of gunfire; it is the active, deliberate architecture of dignity and inclusion.', 'speaker' => 'Patricia Elias'],
                    ['quote' => 'When women negotiate peace, communities heal not just treaties, but the wounded fabric of their collective memory.', 'speaker' => 'Scott Douglas Jacobsen'],
                ],
                'relevant_links' => [
                    ['label' => 'UN Security Council Resolution 1325 Official Text', 'url' => 'https://www.un.org/womenwatch/osagi/wps/'],
                    ['label' => 'WICCI National Mental Health Council', 'url' => 'https://listeningcommons.com'],
                ],
                'transcript' => "[00:00:00] Scott Douglas Jacobsen: Welcome to The Listening Commons, where conversations become common ground. Today, we are privileged to welcome Senior Advisor Patricia Elias.\n\n[00:01:15] Patricia Elias: Thank you, Scott. When we speak about UNSCR 1325, we are not speaking about an abstract bureaucratic framework. We are speaking about the lived reality of women on frontlines.\n\n[00:07:30] Patricia Elias: Real peacebuilding requires us to listen first to the grief that has never been acknowledged. Only through genuine listening can reconciliation emerge.",
                'artwork_url' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=800&q=80',
                'audio_url' => 'https://traffic.libsyn.com/secure/listeningcommons/episode_1_patricia_elias.mp3',
                'audio_duration_seconds' => 3480,
                'formatted_duration' => '58:00',
                'audio_bytes' => 55680000,
                'youtube_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'youtube_id' => 'dQw4w9WgXcQ',
                'spotify_url' => 'https://open.spotify.com/show/listeningcommons',
                'apple_podcasts_url' => 'https://podcasts.apple.com/podcast/the-listening-commons/id123456789',
                'is_published' => true,
                'is_featured' => true,
                'published_at' => now()->subDays(2),
                'themes' => [$themes[1], $themes[2], $themes[3]],
            ],
            (object) [
                'id' => 2,
                'episode_number' => 2,
                'title' => 'Psychiatry, LGBTQ+ Dignity & Young Minds: Unlearning Systematic Stigma',
                'slug' => 'kersi-chavda-psychiatry-lgbtq-mental-health-young-minds',
                'guest' => $guests[1],
                'host_names' => 'Scott Douglas Jacobsen & The Listening Commons Team',
                'short_description' => 'Renowned Consultant Psychiatrist Dr. Kersi Chavda discusses adolescent mental health crises, affirmative psychiatric care for LGBTQ+ youth, and breaking generational silence through non-judgmental listening.',
                'full_show_notes' => '<h3>About this Dialogue</h3><p>In this landmark interview, Dr. Kersi Chavda (P.D. Hinduja Hospital) joins host Scott Douglas Jacobsen to unpack the modern mental health landscape. From the epidemic of youth loneliness to the vital necessity of LGBTQ+ affirmative care, Dr. Chavda demonstrates how deep listening restores human dignity.</p><h3>Key Points Discussed</h3><ul><li>Why modern adolescents face unprecedented identity fragmentation in the digital age.</li><li>The duty of clinical psychiatry to affirm, rather than pathologize, diverse lived experiences.</li><li>Practical strategies for families and educators to create compassionate listening sanctuaries.</li></ul>',
                'key_quotations' => [
                    ['quote' => 'When a young person feels genuinely heard without diagnostic judgment, their path to psychological survival begins.', 'speaker' => 'Dr. Kersi Chavda'],
                    ['quote' => 'Stigma thrives in isolation. Empathy thrives when we sit together without rushing to fix.', 'speaker' => 'Scott Douglas Jacobsen'],
                ],
                'relevant_links' => [
                    ['label' => 'Hinduja Hospital Department of Psychiatry', 'url' => 'https://www.hindujahospital.com'],
                    ['label' => 'Bombay Psychiatric Society Archives', 'url' => 'https://listeningcommons.com'],
                ],
                'transcript' => "[00:00:00] Scott Douglas Jacobsen: Welcome back to The Listening Commons. Our guest today is Dr. Kersi Chavda, one of the most respected psychiatric voices in South Asia.\n\n[00:01:45] Dr. Kersi Chavda: Good day, Scott. In our clinical work, the hardest battle is often not the biological syndrome, but the crushing social stigma.\n\n[00:09:20] Dr. Kersi Chavda: For LGBTQ+ youth, simply being affirmed in their authentic self by an authority figure can literally be life-saving.",
                'artwork_url' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=800&q=80',
                'audio_url' => 'https://traffic.libsyn.com/secure/listeningcommons/episode_2_kersi_chavda.mp3',
                'audio_duration_seconds' => 3720,
                'formatted_duration' => '1:02:00',
                'audio_bytes' => 59520000,
                'youtube_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'youtube_id' => 'dQw4w9WgXcQ',
                'spotify_url' => 'https://open.spotify.com/show/listeningcommons',
                'apple_podcasts_url' => 'https://podcasts.apple.com/podcast/the-listening-commons/id123456789',
                'is_published' => true,
                'is_featured' => false,
                'published_at' => now()->subDays(6),
                'themes' => [$themes[0], $themes[1], $themes[3]],
            ],
            (object) [
                'id' => 3,
                'episode_number' => 3,
                'title' => 'Suicide Prevention in India: Mental Health, Responsible Media & Ethical AI',
                'slug' => 'suicide-prevention-india-kersi-chavda-mental-health-ai-media',
                'guest' => $guests[1],
                'host_names' => 'Scott Douglas Jacobsen & The Listening Commons Team',
                'short_description' => 'Dr. Kersi Chavda returns for an urgent examination of public health strategies for suicide prevention, the ethics of sensationalist media, and the perils of algorithmic mental health bots.',
                'full_show_notes' => '<h3>About this Dialogue</h3><p>An urgent and compassionate special edition on suicide prevention in India. Host Scott Douglas Jacobsen and Dr. Kersi Chavda analyze responsible reporting guidelines, school intervention networks, and the ethical safeguards required before introducing AI into crisis counseling.</p>',
                'key_quotations' => [
                    ['quote' => 'Responsible storytelling around mental crises saves lives; sensationalism and graphic spectacle cost them.', 'speaker' => 'Dr. Kersi Chavda'],
                ],
                'relevant_links' => [
                    ['label' => 'Kiran National Helpline (India): 1800-599-0019', 'url' => 'https://www.mohfw.gov.in'],
                ],
                'transcript' => "[00:00:00] Scott Douglas Jacobsen: Today on The Listening Commons, we address a critical public health conversation on suicide prevention and ethical media.\n\n[00:02:10] Dr. Kersi Chavda: When a crisis occurs, the media often turns it into drama. We must replace spectacle with helpline access and destigmatized hope.",
                'artwork_url' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=800&q=80',
                'audio_url' => 'https://traffic.libsyn.com/secure/listeningcommons/episode_3_suicide_prevention.mp3',
                'audio_duration_seconds' => 3300,
                'formatted_duration' => '55:00',
                'audio_bytes' => 52800000,
                'youtube_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'youtube_id' => 'dQw4w9WgXcQ',
                'spotify_url' => 'https://open.spotify.com/show/listeningcommons',
                'apple_podcasts_url' => 'https://podcasts.apple.com/podcast/the-listening-commons/id123456789',
                'is_published' => true,
                'is_featured' => false,
                'published_at' => now()->subDays(10),
                'themes' => [$themes[0], $themes[4], $themes[5]],
            ],
            (object) [
                'id' => 4,
                'episode_number' => 4,
                'title' => "Teachers' Day Special: The Courage to Unlearn in Modern Psychiatry",
                'slug' => 'nimesh-desai-teachers-day-psychiatry-unlearn',
                'guest' => $guests[2],
                'host_names' => 'Scott Douglas Jacobsen & The Listening Commons Team',
                'short_description' => 'Senior Psychiatrist and former IHBAS Director Dr. Nimesh Desai reflects on pedagogical mentorship, clinical humility, institutional reform, and why every physician must remain a lifelong listener.',
                'full_show_notes' => '<h3>About this Dialogue</h3><p>In this Teachers’ Day tribute, Dr. Nimesh Desai reflects on four decades of psychiatry in India. He shares poignant lessons on institutional governance, resisting diagnostic rigidity, and honoring the mentors who modeled radical empathy.</p>',
                'key_quotations' => [
                    ['quote' => 'The greatest teacher is the patient who defies the textbook, reminding us of the unfathomable depth of human consciousness.', 'speaker' => 'Dr. Nimesh Desai'],
                ],
                'relevant_links' => [
                    ['label' => 'Institute of Human Behaviour and Allied Sciences (IHBAS)', 'url' => 'http://ihbas.delhigovt.nic.in'],
                ],
                'transcript' => "[00:00:00] Scott Douglas Jacobsen: On this Teachers' Day edition of The Listening Commons, we are honored to speak with Dr. Nimesh Desai.\n\n[00:01:30] Dr. Nimesh Desai: Education is not the filling of a bucket; it is lighting a fire of inquiry. In medicine, listening to the patient’s narrative is 90% of genuine care.",
                'artwork_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=800&q=80',
                'audio_url' => 'https://traffic.libsyn.com/secure/listeningcommons/episode_4_nimesh_desai.mp3',
                'audio_duration_seconds' => 3120,
                'formatted_duration' => '52:00',
                'audio_bytes' => 49920000,
                'youtube_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'youtube_id' => 'dQw4w9WgXcQ',
                'spotify_url' => 'https://open.spotify.com/show/listeningcommons',
                'apple_podcasts_url' => 'https://podcasts.apple.com/podcast/the-listening-commons/id123456789',
                'is_published' => true,
                'is_featured' => false,
                'published_at' => now()->subDays(14),
                'themes' => [$themes[0], $themes[1], $themes[6]],
            ],
            (object) [
                'id' => 5,
                'episode_number' => 5,
                'title' => 'Praver Awal 2.0: Resilience, a 39-Hour Liver Transplant & Lived Experience',
                'slug' => 'praver-awal-2-0-comeback-39-hour-liver-transplant-resilience',
                'guest' => $guests[3],
                'host_names' => 'Scott Douglas Jacobsen & The Listening Commons Team',
                'short_description' => 'Indian filmmaker Praver Awal shares his extraordinary comeback after surviving an emergency 39-hour liver transplant surgery, rediscovering mortality, and redefining purpose through lived experience.',
                'full_show_notes' => '<h3>About this Dialogue</h3><p>In this deeply moving exploration of lived resilience, Praver Awal joins host Scott Douglas Jacobsen to detail his experience of confronting near-fatal medical catastrophe and emerging with a transformed perspective on life, creativity, and organ donation awareness.</p>',
                'key_quotations' => [
                    ['quote' => 'When you wake up on the other side of a 39-hour surgery, every single breath ceases to be an assumption and becomes a sacred gift.', 'speaker' => 'Praver Awal'],
                ],
                'relevant_links' => [
                    ['label' => 'Organ Donation India Advocacy Network', 'url' => 'https://notto.mohfw.gov.in'],
                ],
                'transcript' => "[00:00:00] Scott Douglas Jacobsen: Welcome to The Listening Commons. Today we share an unforgettable story of resilience with filmmaker Praver Awal.\n\n[00:01:25] Praver Awal: In 2022, my life collapsed into emergency rooms. 39 hours on an operating table changes your relationship with time completely.",
                'artwork_url' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=800&q=80',
                'audio_url' => 'https://traffic.libsyn.com/secure/listeningcommons/episode_5_praver_awal.mp3',
                'audio_duration_seconds' => 3840,
                'formatted_duration' => '1:04:00',
                'audio_bytes' => 61440000,
                'youtube_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'youtube_id' => 'dQw4w9WgXcQ',
                'spotify_url' => 'https://open.spotify.com/show/listeningcommons',
                'apple_podcasts_url' => 'https://podcasts.apple.com/podcast/the-listening-commons/id123456789',
                'is_published' => true,
                'is_featured' => false,
                'published_at' => now()->subDays(20),
                'themes' => [$themes[0], $themes[1], $themes[5], $themes[6]],
            ],
        ];
    }

    /**
     * Fallback Distribution Drafts Data
     */
    public function fallbackDistributionDrafts(): array
    {
        $episodes = $this->fallbackEpisodes();

        return [
            (object) [
                'id' => 1,
                'episode' => $episodes[0],
                'channel' => 'substack',
                'title' => 'The Sanctity of Attention: Why Listening Demands Silence (Digest #1)',
                'content' => "In our inaugural episode, Dr. Sunita Raman offered a definition of attention that we have not stopped thinking about: \"Attention is not a productivity metric; it is an act of love.\"\n\nWhy this conversation matters:\nIn an era engineered for outrage and constant reactivity, the discipline of sacred pause is our most radical form of resistance...",
                'status' => 'approved',
                'created_at' => now()->subDays(5),
            ],
            (object) [
                'id' => 2,
                'episode' => $episodes[0],
                'channel' => 'linkedin',
                'title' => 'What happens when we treat human attention as an offering?',
                'content' => "In our conversation on The Listening Commons, Dr. Sunita Raman shared an insight that should challenge every leader, creator, and peacemaker:\n\n\"Listening is not merely the reception of sound waves; it is the radical decision to suspend your ego and make space for another's reality.\"",
                'status' => 'approved',
                'created_at' => now()->subDays(5),
            ],
            (object) [
                'id' => 3,
                'episode' => $episodes[1],
                'channel' => 'substack',
                'title' => 'Peace is Not the Absence of Tension: Lessons from Ambassador David K. Osei',
                'content' => 'Thirty years in international conflict zones taught Ambassador David K. Osei a harder truth: "Peace is not the absence of tension, but the presence of relational justice and acknowledged truth."',
                'status' => 'draft',
                'created_at' => now()->subDays(2),
            ],
            (object) [
                'id' => 4,
                'episode' => $episodes[1],
                'channel' => 'linkedin',
                'title' => 'Thirty years mediating international conflicts taught Ambassador Osei one principle',
                'content' => "You cannot legislate reconciliation. You can sign treaties in palaces, but until two neighbors look into each other's eyes and acknowledge the pain caused, there is no peace.",
                'status' => 'draft',
                'created_at' => now()->subDays(2),
            ],
            (object) [
                'id' => 5,
                'episode' => $episodes[2],
                'channel' => 'substack',
                'title' => 'The Mimicry of Care: What AI Companions Mean for Real Intimacy',
                'content' => 'Computational philosopher Tariq Al-Mansoor joined us for Episode #3: "A machine can compute the probability of your sorrow, but it cannot share your mortality. And without shared mortality, there is no empathy."',
                'status' => 'draft',
                'created_at' => now()->subHours(12),
            ],
        ];
    }
}
