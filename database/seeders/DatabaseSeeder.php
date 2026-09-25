<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Episode;
use App\Models\Guest;
use App\Models\Theme;
use App\Models\User;
use App\Services\ListeningCommonsRepository;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::updateOrCreate(
            ['email' => 'admin@listeningcommons.com'],
            [
                'name' => 'Scott Douglas Jacobsen & Editorial Team',
                'password' => bcrypt('password'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Editorial Staff',
                'password' => bcrypt('password'),
            ]
        );

        // Seed Core Reflections & Essays from lc.txt
        $articles = [
            [
                'title' => 'The Fear of Not Mattering',
                'slug' => 'the-fear-of-not-mattering',
                'author_name' => 'Dr. Aninda Sidhana',
                'summary' => 'In a hyper-visible yet deeply isolated world, the dread of emotional erasure quietly dismantles human dignity. How clinical empathy restores what society ignores.',
                'body' => "Across clinical encounters, the most persistent sorrow is rarely grief over circumstance alone—it is the quiet agony of feeling unseen. When people ask whether their pain has weight in the eyes of others, they are not asking for diagnosis. They are seeking confirmation of their humanity.\n\nIn our hurried modern landscape, attention has been replaced by transaction. We nod to acknowledge, but we rarely pause to witness. The Listening Commons was built upon this singular conviction: to listen deeply is to confer dignity.",
                'cover_url' => 'https://images.unsplash.com/photo-1518495973542-4542c06a5843?auto=format&fit=crop&w=1000&q=80',
                'published_at' => now()->subDays(2),
                'is_published' => true,
            ],
            [
                'title' => 'No One Heals Alone',
                'slug' => 'no-one-heals-alone',
                'author_name' => 'Dr. Aninda Sidhana & Scott Douglas Jacobsen',
                'summary' => 'Healing is not a solitary metric of resilience. Sometimes another person reaches a sanctuary inside us that we could never have arrived at unassisted.',
                'body' => "The modern ethos of hyper-individualism teaches that recovery is an inward climb undertaken in solitude. Yet neurological, psychiatric, and cultural wisdom all reveal the opposite: safety is co-created.\n\nWhen we sit with another human being without an agenda to fix, label, or dismiss, the nervous system recognizes safe harbor. In that collective quiet, what was once fractured begins to stitch itself back into wholeness.",
                'cover_url' => 'https://images.unsplash.com/photo-1499209974431-9dddcece7f88?auto=format&fit=crop&w=1000&q=80',
                'published_at' => now()->subDays(5),
                'is_published' => true,
            ],
            [
                'title' => 'When Systems Learn to Listen',
                'slug' => 'when-systems-learn-to-listen',
                'author_name' => 'Dr. Aninda Sidhana',
                'summary' => 'What happens when clinical, institutional, and social structures stop treating lived experience as an inconvenient statistic and start treating it as curriculum?',
                'body' => "Institutions are built for predictability, but human suffering is unpredictable and tender. When hospitals, courts, and universities operate solely on procedural compliance, the vulnerable are flattened into case numbers.\n\nA survivor-informed framework does not diminish rigorous standards; it infuses them with accountability and soul. A system that listens is a system that can finally begin to heal.",
                'cover_url' => 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?auto=format&fit=crop&w=1000&q=80',
                'published_at' => now()->subDays(8),
                'is_published' => true,
            ],
            [
                'title' => 'The Human Behind the Role',
                'slug' => 'the-human-behind-the-role',
                'author_name' => 'Scott Douglas Jacobsen',
                'summary' => 'Beyond titles, accolades, and public reputations: why the most urgent conversations happen when we strip away the armor of professional performance.',
                'body' => "In over a decade of long-form interviewing, the turning point of every dialogue occurs when the speaker forgets their official biography. We spend decades polishing our public facades—our degrees, our offices, our publications.\n\nYet what another person resonates with is never our armor; it is the human heart beating beneath it. Curiosity before certainty is not merely an interview technique; it is a way of seeing the world.",
                'cover_url' => 'https://images.unsplash.com/photo-1457369804613-52c61a468e7d?auto=format&fit=crop&w=1000&q=80',
                'published_at' => now()->subDays(12),
                'is_published' => true,
            ],
            [
                'title' => 'What We Carry Into the Room',
                'slug' => 'what-we-carry-into-the-room',
                'author_name' => 'Scott Douglas Jacobsen',
                'summary' => 'The invisible architecture of an interview: historical memory, unvoiced doubts, and why every conversation leaves one central question open.',
                'body' => "Every time two people sit across a microphone or a table, they carry centuries of conditioning into the room. We bring our family histories, our cultural prohibitions, and our private defenses.\n\nTo conduct an interview in The Listening Commons is to hold that invisible baggage with reverence. We do not demand instant answers. We invite people to dwell with the questions they are still carrying.",
                'cover_url' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=1000&q=80',
                'published_at' => now()->subDays(15),
                'is_published' => true,
            ],
        ];

        foreach ($articles as $art) {
            Article::updateOrCreate(['slug' => $art['slug']], $art);
        }

        // Seed Themes, Guests, and Master Episodes
        $repo = app(ListeningCommonsRepository::class);

        foreach ($repo->fallbackThemes() as $t) {
            Theme::updateOrCreate(
                ['slug' => $t->slug],
                [
                    'name' => $t->name,
                    'tagline' => $t->tagline,
                    'description' => $t->description,
                    'color_accent' => $t->color_accent,
                ]
            );
        }

        foreach ($repo->fallbackGuests() as $g) {
            Guest::updateOrCreate(
                ['slug' => $g->slug],
                [
                    'name' => $g->name,
                    'designation' => $g->designation,
                    'affiliation' => $g->affiliation,
                    'bio' => $g->bio,
                    'photo_url' => $g->photo_url,
                    'website_url' => $g->website_url,
                    'linkedin_url' => $g->linkedin_url,
                    'twitter_url' => $g->twitter_url,
                ]
            );
        }

        foreach ($repo->fallbackEpisodes() as $ep) {
            $guest = Guest::where('slug', $ep->guest->slug)->first();
            if ($guest) {
                $episode = Episode::updateOrCreate(
                    ['slug' => $ep->slug],
                    [
                        'episode_number' => $ep->episode_number,
                        'title' => $ep->title,
                        'guest_id' => $guest->id,
                        'host_names' => $ep->host_names,
                        'short_description' => $ep->short_description,
                        'full_show_notes' => $ep->full_show_notes,
                        'key_quotations' => $ep->key_quotations,
                        'relevant_links' => $ep->relevant_links,
                        'transcript' => $ep->transcript,
                        'artwork_url' => $ep->artwork_url,
                        'audio_url' => $ep->audio_url,
                        'audio_duration_seconds' => $ep->audio_duration_seconds,
                        'audio_bytes' => $ep->audio_bytes,
                        'youtube_url' => $ep->youtube_url,
                        'youtube_id' => $ep->youtube_id,
                        'spotify_url' => $ep->spotify_url,
                        'apple_podcasts_url' => $ep->apple_podcasts_url,
                        'is_published' => $ep->is_published,
                        'is_featured' => $ep->is_featured,
                        'published_at' => $ep->published_at,
                    ]
                );

                $themeSlugs = collect($ep->themes)->pluck('slug')->toArray();
                $themeIds = Theme::whereIn('slug', $themeSlugs)->pluck('id');
                $episode->themes()->sync($themeIds);
            }
        }
    }
}
