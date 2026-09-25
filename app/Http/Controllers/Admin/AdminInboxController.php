<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class AdminInboxController extends Controller
{
    public function index(): View
    {
        // Sample editorial inquiries and subscriber submissions according to lc.txt
        $inquiries = collect([
            (object) [
                'id' => 1,
                'name' => 'Prof. Benno Werlen',
                'email' => 'werlen@jena-declaration.org',
                'type' => 'Guest Proposal',
                'organization' => 'The Jena Declaration / Friedrich Schiller University',
                'message' => 'Proposal regarding discussion on "Can Culture Become the Missing Language of Sustainability?" as noted in the launch guest constellation.',
                'status' => 'Pending Review',
                'received_at' => now()->subHours(4),
            ],
            (object) [
                'id' => 2,
                'name' => 'WICCI National Secretariat',
                'email' => 'secretariat@wicci.in',
                'type' => 'Institutional Collaboration',
                'organization' => 'WICCI National Psychosocial & Mental Wellness Council',
                'message' => 'Joint symposium schedule and responsible media storytelling charter review led by Dr. Aninda Sidhana.',
                'status' => 'Under Discussion',
                'received_at' => now()->subDay(),
            ],
            (object) [
                'id' => 3,
                'name' => 'Penny Slinger',
                'email' => 'studio@pennyslinger.com',
                'type' => 'Editorial Contribution',
                'organization' => 'Feminist Surrealism Archive',
                'message' => 'Draft submission: "What Can Art Reveal About the Female Mind That Psychiatry Cannot?" ready for review.',
                'status' => 'Action Required',
                'received_at' => now()->subDays(2),
            ],
            (object) [
                'id' => 4,
                'name' => 'In-Sight Publishing Editorial',
                'email' => 'editorial@in-sightpublishing.com',
                'type' => 'Syndication Notice',
                'organization' => 'In-Sight Publishing (Canada)',
                'message' => 'Cross-publication metadata synchronized with Scott Douglas Jacobsen interview archives.',
                'status' => 'Reviewed',
                'received_at' => now()->subDays(3),
            ],
        ]);

        $subscribers = collect([
            (object) [
                'email' => 'reader.wellness@harvard.edu',
                'source' => 'Letters from the Commons Modal',
                'subscribed_at' => now()->subHours(2),
                'status' => 'Active',
            ],
            (object) [
                'email' => 'clinical.fellow@tantiamedical.org',
                'source' => 'Homepage Newsletter Form',
                'subscribed_at' => now()->subHours(8),
                'status' => 'Active',
            ],
            (object) [
                'email' => 'editorial.inquiry@thehindu.co.in',
                'source' => 'Collaborations Page',
                'subscribed_at' => now()->subDay(),
                'status' => 'Active',
            ],
            (object) [
                'email' => 'psychiatry.perspectives@nhs.net',
                'source' => 'Substack Cross-Promotion',
                'subscribed_at' => now()->subDays(2),
                'status' => 'Active',
            ],
        ]);

        return view('admin.inbox.index', compact('inquiries', 'subscribers'));
    }
}
