-- ==========================================================
-- THE LISTENING COMMONS — DATABASE SCHEMA (MySQL 8.x)
-- "Where conversations become common ground."
-- ==========================================================

-- 1. GUESTS TABLE
CREATE TABLE IF NOT EXISTS `guests` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL UNIQUE,
    `designation` VARCHAR(255) NOT NULL,
    `affiliation` VARCHAR(255) NULL,
    `bio` TEXT NOT NULL,
    `photo_url` VARCHAR(1024) NULL,
    `website_url` VARCHAR(1024) NULL,
    `linkedin_url` VARCHAR(1024) NULL,
    `twitter_url` VARCHAR(1024) NULL,
    `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_guests_slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- 2. THEMES TABLE
CREATE TABLE IF NOT EXISTS `themes` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL UNIQUE,
    `tagline` VARCHAR(255) NULL,
    `description` TEXT NOT NULL,
    `color_accent` VARCHAR(50) DEFAULT '#C59B27',
    `icon_svg` TEXT NULL,
    `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_themes_slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- 3. EPISODES TABLE (MASTER SINGLE-SOURCE RECORD)
CREATE TABLE IF NOT EXISTS `episodes` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `episode_number` INT UNSIGNED NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL UNIQUE,
    `guest_id` BIGINT UNSIGNED NOT NULL,
    `host_names` VARCHAR(255) DEFAULT 'Marcus Chen & The Listening Commons Team',
    
    -- Descriptions & Content
    `short_description` TEXT NOT NULL,
    `full_show_notes` LONGTEXT NOT NULL,
    `key_quotations` JSON NULL,
    `relevant_links` JSON NULL,
    `transcript` LONGTEXT NULL,
    
    -- Media Enclosures & External Links
    `artwork_url` VARCHAR(1024) NULL,
    `audio_url` VARCHAR(1024) NOT NULL,
    `audio_duration_seconds` INT UNSIGNED DEFAULT 0,
    `audio_bytes` BIGINT UNSIGNED DEFAULT 0,
    `youtube_url` VARCHAR(1024) NULL,
    `youtube_id` VARCHAR(50) NULL,
    `spotify_url` VARCHAR(1024) NULL,
    `apple_podcasts_url` VARCHAR(1024) NULL,
    `amazon_music_url` VARCHAR(1024) NULL,
    
    -- Editorial & Publishing Status
    `is_published` TINYINT(1) DEFAULT 1,
    `is_featured` TINYINT(1) DEFAULT 0,
    `published_at` DATETIME NOT NULL,
    
    -- SEO Metadata
    `seo_title` VARCHAR(255) NULL,
    `meta_description` TEXT NULL,
    `keywords` VARCHAR(500) NULL,
    `canonical_url` VARCHAR(1024) NULL,
    
    -- Metrics
    `plays_count` BIGINT UNSIGNED DEFAULT 0,
    `views_count` BIGINT UNSIGNED DEFAULT 0,
    
    `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX `idx_episodes_slug` (`slug`),
    INDEX `idx_episodes_published_at` (`published_at`),
    INDEX `idx_episodes_guest` (`guest_id`),
    CONSTRAINT `fk_episodes_guest` FOREIGN KEY (`guest_id`) REFERENCES `guests` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- 4. EPISODE_THEME (PIVOT TABLE)
CREATE TABLE IF NOT EXISTS `episode_theme` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `episode_id` BIGINT UNSIGNED NOT NULL,
    `theme_id` BIGINT UNSIGNED NOT NULL,
    `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    
    UNIQUE KEY `uniq_episode_theme` (`episode_id`, `theme_id`),
    INDEX `idx_pivot_episode` (`episode_id`),
    INDEX `idx_pivot_theme` (`theme_id`),
    CONSTRAINT `fk_pivot_episode` FOREIGN KEY (`episode_id`) REFERENCES `episodes` (`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_pivot_theme` FOREIGN KEY (`theme_id`) REFERENCES `themes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- 5. ARTICLES & EDITORIAL REFLECTIONS (INGESTED FROM SUBSTACK)
CREATE TABLE IF NOT EXISTS `articles` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL UNIQUE,
    `author_name` VARCHAR(255) NOT NULL DEFAULT 'Dr. Aninda Sidhana',
    `episode_id` BIGINT UNSIGNED NULL,
    `theme_id` BIGINT UNSIGNED NULL,
    `summary` TEXT NOT NULL,
    `body` LONGTEXT NOT NULL,
    `cover_url` VARCHAR(1024) NULL,
    `substack_guid` VARCHAR(255) NULL UNIQUE,
    `substack_url` VARCHAR(1024) NULL,
    `substack_synced_at` DATETIME NULL,
    `published_at` DATETIME NOT NULL,
    `is_published` TINYINT(1) DEFAULT 1,
    `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX `idx_articles_slug` (`slug`),
    INDEX `idx_articles_published` (`published_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- 6. WEBSITE SETTINGS & TYPOGRAPHY PRESETS
CREATE TABLE IF NOT EXISTS `settings` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `key` VARCHAR(255) NOT NULL UNIQUE,
    `value` TEXT NULL,
    `description` VARCHAR(255) NULL,
    `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- ==========================================================
-- SEED DATA: THEMES, GUESTS, MASTER EPISODES & DISTRIBUTION DRAFTS
-- ==========================================================

INSERT INTO `themes` (`id`, `name`, `slug`, `tagline`, `description`, `color_accent`) VALUES
(1, 'Mental Health', 'mental-health', 'Healing, interiority, and relational resilience', 'Examining the deep terrain of psychic well-being, grief, and emotional sanctuary in an accelerating world.', '#C59B27'),
(2, 'Human Dignity', 'human-dignity', 'The inviolable worth of every voice', 'Conversations rooted in moral courage, human rights, and the recognition of our collective humanity.', '#0E1738'),
(3, 'Peace & Reconciliation', 'peace-reconciliation', 'Building bridges across intractable divides', 'Exploring restorative justice, conflict transformation, and dialogue where listening becomes radical hospitality.', '#C59B27'),
(4, 'Gender & Belonging', 'gender-belonging', 'Power, care, and equitable futures', 'Interrogating structural identity, feminist perspectives, and the cultivation of spaces where everyone can flourish.', '#0E1738'),
(5, 'AI & Humanity', 'ai-humanity', 'Ethics, consciousness, and preserving what is human', 'Probing how artificial intelligence reshapes human meaning, relational bonds, and cultural autonomy.', '#C59B27'),
(6, 'Responsible Storytelling', 'responsible-storytelling', 'The ethics of voice and representation', 'Crafting narratives that protect vulnerability, counter dehumanization, and honor lived experience.', '#0E1738'),
(7, 'Culture & Lived Experience', 'culture-lived-experience', 'Wisdom passed through generations and memory', 'Stories drawn from oral histories, diaspora memories, and the quiet dignity of ordinary perseverance.', '#C59B27');


INSERT INTO `guests` (`id`, `name`, `slug`, `designation`, `affiliation`, `bio`, `photo_url`, `website_url`, `linkedin_url`, `twitter_url`) VALUES
(1, 'Patricia Elias', 'patricia-elias', 'Senior Advisor on Peacebuilding & UNSCR 1325 Lead', 'Global Women, Peace & Security Initiative', 'Patricia Elias is an international senior advisor specializing in the implementation of United Nations Security Council Resolution 1325 (UNSCR 1325), female leadership in conflict negotiation, and human dignity diplomacy.', 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=600&q=80', 'https://listeningcommons.com', 'https://linkedin.com/in/example', 'https://twitter.com/example'),
(2, 'Dr. Kersi Chavda', 'dr-kersi-chavda', 'Senior Consultant Psychiatrist & Former President BPS', 'P.D. Hinduja Hospital & National Mental Health Advisory', 'Dr. Kersi Chavda is one of India\'s foremost consultant psychiatrists, celebrated for pioneering adolescent psychiatric care, LGBTQ+ affirmative therapy, and ethical guidelines for national suicide prevention.', 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=600&q=80', 'https://listeningcommons.com', 'https://linkedin.com/in/example', 'https://twitter.com/example'),
(3, 'Dr. Nimesh Desai', 'dr-nimesh-desai', 'Senior Psychiatrist & Former Director IHBAS', 'Institute of Human Behaviour and Allied Sciences', 'Dr. Nimesh Desai is an eminent public mental health pioneer and former director of IHBAS Delhi, dedicated to psychiatric education, the courage to unlearn dogma, and patient-centered clinical compassion.', 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=600&q=80', 'https://listeningcommons.com', 'https://linkedin.com/in/example', 'https://twitter.com/example'),
(4, 'Praver Awal', 'praver-awal', 'Filmmaker, Creative Director & Organ Donation Advocate', 'Lived Experience & Resilience Studio', 'Praver Awal is an acclaimed Indian filmmaker and creator who survived a historic 39-hour emergency liver transplant, inspiring thousands through his journey of resilience, mindfulness, and creative rebirth ("Praver Awal 2.0").', 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=600&q=80', 'https://listeningcommons.com', 'https://linkedin.com/in/example', 'https://twitter.com/example');


INSERT INTO `episodes` (
    `id`, `episode_number`, `title`, `slug`, `guest_id`, `host_names`,
    `short_description`, `full_show_notes`,
    `key_quotations`, `relevant_links`, `transcript`,
    `artwork_url`, `audio_url`, `audio_duration_seconds`, `audio_bytes`,
    `youtube_url`, `youtube_id`,
    `is_published`, `is_featured`, `published_at`,
    `seo_title`, `meta_description`, `keywords`
) VALUES
(
    1,
    1,
    'Women, Peace & Security: UNSCR 1325 and Global Humanitarian Diplomacy',
    'patricia-elias-women-peace-security-unscr-1325',
    1,
    'Scott Douglas Jacobsen & The Listening Commons Team',
    'Senior Advisor Patricia Elias joins host Scott Douglas Jacobsen to examine United Nations Security Council Resolution 1325, the indispensable leadership of women in war de-escalation, and restoring human dignity across shattered borders.',
    '<h3>About this Dialogue</h3><p>In this foundational conversation on <em>The Listening Commons</em>, Senior Advisor Patricia Elias joins host Scott Douglas Jacobsen to reflect on United Nations Security Council Resolution 1325 (UNSCR 1325) and the transformative role of women in peace negotiation and conflict reconciliation.</p><h3>Core Themes Explored</h3><ul><li>Why sustainable peace requires women at the center of constitutional and ceasefire dialogues.</li><li>Moving past transactional diplomacy toward relational trust and generational dignity.</li><li>De-escalation practices in zones of deep ideological and geopolitical friction.</li></ul>',
    '[
        {"quote": "Peace is not the passive absence of gunfire; it is the active, deliberate architecture of dignity and inclusion.", "speaker": "Patricia Elias"},
        {"quote": "When women negotiate peace, communities heal not just treaties, but the wounded fabric of their collective memory.", "speaker": "Scott Douglas Jacobsen"}
    ]',
    '[
        {"label": "UN Security Council Resolution 1325 Official Text", "url": "https://www.un.org/womenwatch/osagi/wps/"},
        {"label": "WICCI National Mental Health Council", "url": "https://listeningcommons.com"}
    ]',
    '[00:00:00] Scott Douglas Jacobsen: Welcome to The Listening Commons, where conversations become common ground. Today, we are privileged to welcome Senior Advisor Patricia Elias.\n\n[00:01:15] Patricia Elias: Thank you, Scott. When we speak about UNSCR 1325, we are not speaking about an abstract bureaucratic framework. We are speaking about the lived reality of women on frontlines.\n\n[00:07:30] Patricia Elias: Real peacebuilding requires us to listen first to the grief that has never been acknowledged. Only through genuine listening can reconciliation emerge.',
    'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=800&q=80',
    'https://traffic.libsyn.com/secure/listeningcommons/episode_1_patricia_elias.mp3',
    3480,
    55680000,
    'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
    'dQw4w9WgXcQ',
    1,
    1,
    '2026-09-18 09:00:00',
    'Women, Peace & Security with Patricia Elias | The Listening Commons',
    'Senior Advisor Patricia Elias on UNSCR 1325, female peacebuilding leadership, and conflict diplomacy on The Listening Commons.',
    'peace, UNSCR 1325, diplomacy, human dignity, conflict resolution, gender'
),
(
    2,
    2,
    'Psychiatry, LGBTQ+ Dignity & Young Minds: Unlearning Systematic Stigma',
    'kersi-chavda-psychiatry-lgbtq-mental-health-young-minds',
    2,
    'Scott Douglas Jacobsen & The Listening Commons Team',
    'Renowned Consultant Psychiatrist Dr. Kersi Chavda discusses adolescent mental health crises, affirmative psychiatric care for LGBTQ+ youth, and breaking generational silence through non-judgmental listening.',
    '<h3>About this Dialogue</h3><p>In this landmark interview, Dr. Kersi Chavda (P.D. Hinduja Hospital) joins host Scott Douglas Jacobsen to unpack the modern mental health landscape. From the epidemic of youth loneliness to the vital necessity of LGBTQ+ affirmative care, Dr. Chavda demonstrates how deep listening restores human dignity.</p><h3>Key Points Discussed</h3><ul><li>Why modern adolescents face unprecedented identity fragmentation in the digital age.</li><li>The duty of clinical psychiatry to affirm, rather than pathologize, diverse lived experiences.</li><li>Practical strategies for families and educators to create compassionate listening sanctuaries.</li></ul>',
    '[
        {"quote": "When a young person feels genuinely heard without diagnostic judgment, their path to psychological survival begins.", "speaker": "Dr. Kersi Chavda"},
        {"quote": "Stigma thrives in isolation. Empathy thrives when we sit together without rushing to fix.", "speaker": "Scott Douglas Jacobsen"}
    ]',
    '[
        {"label": "Hinduja Hospital Department of Psychiatry", "url": "https://www.hindujahospital.com"},
        {"label": "Bombay Psychiatric Society Archives", "url": "https://listeningcommons.com"}
    ]',
    '[00:00:00] Scott Douglas Jacobsen: Welcome back to The Listening Commons. Our guest today is Dr. Kersi Chavda, one of the most respected psychiatric voices in South Asia.\n\n[00:01:45] Dr. Kersi Chavda: Good day, Scott. In our clinical work, the hardest battle is often not the biological syndrome, but the crushing social stigma.\n\n[00:09:20] Dr. Kersi Chavda: For LGBTQ+ youth, simply being affirmed in their authentic self by an authority figure can literally be life-saving.',
    'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=800&q=80',
    'https://traffic.libsyn.com/secure/listeningcommons/episode_2_kersi_chavda.mp3',
    3720,
    59520000,
    'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
    'dQw4w9WgXcQ',
    1,
    0,
    '2026-09-14 09:00:00',
    'Psychiatry, LGBTQ+ Dignity & Young Minds with Dr. Kersi Chavda | The Listening Commons',
    'Consultant Psychiatrist Dr. Kersi Chavda on adolescent well-being, LGBTQ+ affirmative care, and unlearning stigma on The Listening Commons.',
    'psychiatry, mental health, LGBTQ+, youth, human dignity, empathy'
),
(
    3,
    3,
    'Suicide Prevention in India: Mental Health, Responsible Media & Ethical AI',
    'suicide-prevention-india-kersi-chavda-mental-health-ai-media',
    2,
    'Scott Douglas Jacobsen & The Listening Commons Team',
    'Dr. Kersi Chavda returns for an urgent examination of public health strategies for suicide prevention, the ethics of sensationalist media, and the perils of algorithmic mental health bots.',
    '<h3>About this Dialogue</h3><p>An urgent and compassionate special edition on suicide prevention in India. Host Scott Douglas Jacobsen and Dr. Kersi Chavda analyze responsible reporting guidelines, school intervention networks, and the ethical safeguards required before introducing AI into crisis counseling.</p>',
    '[
        {"quote": "Responsible storytelling around mental crises saves lives; sensationalism and graphic spectacle cost them.", "speaker": "Dr. Kersi Chavda"}
    ]',
    '[
        {"label": "Kiran National Helpline (India): 1800-599-0019", "url": "https://www.mohfw.gov.in"}
    ]',
    '[00:00:00] Scott Douglas Jacobsen: Today on The Listening Commons, we address a critical public health conversation on suicide prevention and ethical media.\n\n[00:02:10] Dr. Kersi Chavda: When a crisis occurs, the media often turns it into drama. We must replace spectacle with helpline access and destigmatized hope.',
    'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=800&q=80',
    'https://traffic.libsyn.com/secure/listeningcommons/episode_3_suicide_prevention.mp3',
    3300,
    52800000,
    'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
    'dQw4w9WgXcQ',
    1,
    0,
    '2026-09-10 09:00:00',
    'Suicide Prevention in India with Dr. Kersi Chavda | The Listening Commons',
    'Public mental health, ethical media guidelines, and AI safety in suicide prevention on The Listening Commons.',
    'mental health, suicide prevention, AI ethics, media responsibility, public health'
),
(
    4,
    4,
    'Teachers\' Day Special: The Courage to Unlearn in Modern Psychiatry',
    'nimesh-desai-teachers-day-psychiatry-unlearn',
    3,
    'Scott Douglas Jacobsen & The Listening Commons Team',
    'Senior Psychiatrist and former IHBAS Director Dr. Nimesh Desai reflects on pedagogical mentorship, clinical humility, institutional reform, and why every physician must remain a lifelong listener.',
    '<h3>About this Dialogue</h3><p>In this Teachers’ Day tribute, Dr. Nimesh Desai reflects on four decades of psychiatry in India. He shares poignant lessons on institutional governance, resisting diagnostic rigidity, and honoring the mentors who modeled radical empathy.</p>',
    '[
        {"quote": "The greatest teacher is the patient who defies the textbook, reminding us of the unfathomable depth of human consciousness.", "speaker": "Dr. Nimesh Desai"}
    ]',
    '[
        {"label": "Institute of Human Behaviour and Allied Sciences (IHBAS)", "url": "http://ihbas.delhigovt.nic.in"}
    ]',
    '[00:00:00] Scott Douglas Jacobsen: On this Teachers\' Day edition of The Listening Commons, we are honored to speak with Dr. Nimesh Desai.\n\n[00:01:30] Dr. Nimesh Desai: Education is not the filling of a bucket; it is lighting a fire of inquiry. In medicine, listening to the patient’s narrative is 90% of genuine care.',
    'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=800&q=80',
    'https://traffic.libsyn.com/secure/listeningcommons/episode_4_nimesh_desai.mp3',
    3120,
    49920000,
    'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
    'dQw4w9WgXcQ',
    1,
    0,
    '2026-09-05 09:00:00',
    'Teachers\' Day Special with Dr. Nimesh Desai | The Listening Commons',
    'Dr. Nimesh Desai on unlearning medical dogma, clinical humility, and institutional psychiatric reform.',
    'psychiatry, education, clinical care, mental health, leadership, humility'
),
(
    5,
    5,
    'Praver Awal 2.0: Resilience, a 39-Hour Liver Transplant & Lived Experience',
    'praver-awal-2-0-comeback-39-hour-liver-transplant-resilience',
    4,
    'Scott Douglas Jacobsen & The Listening Commons Team',
    'Indian filmmaker Praver Awal shares his extraordinary comeback after surviving an emergency 39-hour liver transplant surgery, rediscovering mortality, and redefining purpose through lived experience.',
    '<h3>About this Dialogue</h3><p>In this deeply moving exploration of lived resilience, Praver Awal joins host Scott Douglas Jacobsen to detail his experience of confronting near-fatal medical catastrophe and emerging with a transformed perspective on life, creativity, and organ donation awareness.</p>',
    '[
        {"quote": "When you wake up on the other side of a 39-hour surgery, every single breath ceases to be an assumption and becomes a sacred gift.", "speaker": "Praver Awal"}
    ]',
    '[
        {"label": "Organ Donation India Advocacy Network", "url": "https://notto.mohfw.gov.in"}
    ]',
    '[00:00:00] Scott Douglas Jacobsen: Welcome to The Listening Commons. Today we share an unforgettable story of resilience with filmmaker Praver Awal.\n\n[00:01:25] Praver Awal: In 2022, my life collapsed into emergency rooms. 39 hours on an operating table changes your relationship with time completely.',
    'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=800&q=80',
    'https://traffic.libsyn.com/secure/listeningcommons/episode_5_praver_awal.mp3',
    3840,
    61440000,
    'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
    'dQw4w9WgXcQ',
    1,
    0,
    '2026-08-28 09:00:00',
    'Praver Awal 2.0: Resilience & Lived Experience | The Listening Commons',
    'Filmmaker Praver Awal on surviving a 39-hour liver transplant, resilience, and creative purpose on The Listening Commons.',
    'lived experience, resilience, organ donation, survival, filmmaking, storytelling'
);


-- Link Episodes to Themes
INSERT INTO `episode_theme` (`episode_id`, `theme_id`) VALUES
(1, 2), -- Ep 1 -> Human Dignity
(1, 3), -- Ep 1 -> Peace & Reconciliation
(1, 4), -- Ep 1 -> Gender & Belonging
(2, 1), -- Ep 2 -> Mental Health
(2, 2), -- Ep 2 -> Human Dignity
(2, 4), -- Ep 2 -> Gender & Belonging
(3, 1), -- Ep 3 -> Mental Health
(3, 5), -- Ep 3 -> AI & Humanity
(3, 6), -- Ep 3 -> Responsible Storytelling
(4, 1), -- Ep 4 -> Mental Health
(4, 2), -- Ep 4 -> Human Dignity
(4, 7), -- Ep 4 -> Culture & Lived Experience
(5, 1), -- Ep 5 -> Mental Health
(5, 2), -- Ep 5 -> Human Dignity
(5, 6), -- Ep 5 -> Responsible Storytelling
(5, 7); -- Ep 5 -> Culture & Lived Experience




