<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use App\Models\City;
use App\Models\Article;
use App\Models\Person;
use App\Models\Brand;
use App\Models\MagazineEdition;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Super Admin User
        User::updateOrCreate(
            ['email' => 'admin@cityicons.in'],
            [
                'name' => 'CityIcons Admin',
                'password' => Hash::make('password123'),
                'role' => 'super_admin',
            ]
        );

        // 2. Default Site Settings
        $settings = [
            'site_name' => 'CITYICONS',
            'tagline' => 'India\'s City Magazine',
            'hero_headline' => 'Bhavnagar, Documented.',
            'hero_subline' => 'Selected with purpose. Documented with responsibility.',
            'contact_email' => 'editorial@cityicons.in',
            'instagram_url' => 'https://instagram.com/cityicons.in',
            'disclosure_text' => 'CityIcons operates under strict independent editorial guidelines. Editorial recognition cannot be purchased. Commercial partnerships are clearly labeled as Paid Collaboration or Partner Content.',
        ];
        foreach ($settings as $key => $val) {
            Setting::updateOrCreate(['key' => $key], ['value' => $val, 'group' => 'general']);
        }

        // 3. Categories
        $categoriesList = [
            'Fashion'      => ['#c0613b', 'article'],
            'Beauty'       => ['#b5456e', 'article'],
            'Culture'      => ['#2a7d6e', 'article'],
            'Food'         => ['#c97d2e', 'article'],
            'Events'       => ['#8b1a1a', 'article'],
            'People'       => ['#1a4a8a', 'both'],
            'Places'       => ['#3d5a99', 'article'],
            'Street Style' => ['#6b1f3a', 'article'],
            'Weddings'     => ['#b5860d', 'article'],
            'Business'     => ['#2d6a4f', 'both'],
            'Art'          => ['#8b1a1a', 'both'],
        ];

        $catMap = [];
        $sort = 1;
        foreach ($categoriesList as $name => $meta) {
            $cat = Category::updateOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'name' => $name,
                    'color' => $meta[0],
                    'type' => $meta[1] === 'both' ? 'article' : $meta[1],
                    'sort_order' => $sort++,
                ]
            );
            $catMap[$name] = $cat->id;
        }

        // 4. Tags
        $tagNames = [
            'Fashion', 'Handloom', 'Heritage', 'Designers', 'Luxury', 'Culture', 'Art',
            'Expression', 'Beauty', 'Wellness', 'Ayurveda', 'Street Style', 'Mumbai',
            'Jewellery', 'Style', 'Runway', 'Trends', 'Accessories', 'Festival', 'Diwali',
            'Architecture', 'Goa', 'Food', 'Indian Cuisine', 'Chai', 'Changemakers', 'India',
            'Travel', 'Hidden Gems', 'Events', 'Walk', 'Local', 'Beach', 'Nature', 'Business',
            'Youth', 'Bandhani', 'Craft', 'Couture', 'Rajasthani Cuisine', 'Royal',
            'Literature', 'Nightlife', 'Delhi', 'Startups', 'Tech', 'Coffee', 'Craft Beer',
            'Durga Puja', 'CityOfJoy', 'Weddings', 'Bridal Makeup'
        ];
        $tagMap = [];
        foreach ($tagNames as $name) {
            $tag = Tag::firstOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name]
            );
            $tagMap[$name] = $tag->id;
        }

        // 5. Cities
        $citiesData = [
            [
                'id' => 'bhavnagar',
                'name' => 'Bhavnagar',
                'state' => 'Gujarat',
                'tagline' => 'The Jewel of Saurashtra',
                'hero_image' => 'https://images.unsplash.com/photo-1706285654021-4b2f69f0e773?w=1400&q=80',
                'accent_color' => '#c0613b'
            ],
            [
                'id' => 'mumbai',
                'name' => 'Mumbai',
                'state' => 'Maharashtra',
                'tagline' => 'City of Dreams',
                'hero_image' => 'https://images.unsplash.com/photo-1529253355930-ddbe423a2ac7?w=1400&q=80',
                'accent_color' => '#8b1a1a'
            ],
            [
                'id' => 'surat',
                'name' => 'Surat',
                'state' => 'Gujarat',
                'tagline' => 'The Diamond City',
                'hero_image' => 'https://images.unsplash.com/photo-1587474260584-136574528ed5?w=1400&q=80',
                'accent_color' => '#c97d2e'
            ],
            [
                'id' => 'ahmedabad',
                'name' => 'Ahmedabad',
                'state' => 'Gujarat',
                'tagline' => 'Heritage & Modernity',
                'hero_image' => 'https://images.unsplash.com/photo-1598511757337-fe2cafc31ba0?w=1400&q=80',
                'accent_color' => '#3d5a99'
            ],
            [
                'id' => 'rajkot',
                'name' => 'Rajkot',
                'state' => 'Gujarat',
                'tagline' => 'City of Culture',
                'hero_image' => 'https://images.unsplash.com/photo-1570168007204-dfb528c6958f?w=1400&q=80',
                'accent_color' => '#2a7d6e'
            ],
            [
                'id' => 'vadodara',
                'name' => 'Vadodara',
                'state' => 'Gujarat',
                'tagline' => 'City of Fine Arts',
                'hero_image' => 'https://images.unsplash.com/photo-1541089404510-5c9a779841fc?w=1400&q=80',
                'accent_color' => '#b5860d'
            ],
            [
                'id' => 'delhi',
                'name' => 'Delhi',
                'state' => 'Delhi',
                'tagline' => 'Heart of India',
                'hero_image' => 'https://images.unsplash.com/photo-1587474260584-136574528ed5?w=1400&q=80',
                'accent_color' => '#6b1f3a'
            ],
            [
                'id' => 'bengaluru',
                'name' => 'Bengaluru',
                'state' => 'Karnataka',
                'tagline' => 'Garden City',
                'hero_image' => 'https://images.unsplash.com/photo-1596176530529-78163a4f7af2?w=1400&q=80',
                'accent_color' => '#2d6a4f'
            ],
            [
                'id' => 'jaipur',
                'name' => 'Jaipur',
                'state' => 'Rajasthan',
                'tagline' => 'The Pink City',
                'hero_image' => 'https://images.unsplash.com/photo-1477587458883-47145ed68ac5?w=1400&q=80',
                'accent_color' => '#b5456e'
            ],
            [
                'id' => 'kolkata',
                'name' => 'Kolkata',
                'state' => 'West Bengal',
                'tagline' => 'City of Joy',
                'hero_image' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=1400&q=80',
                'accent_color' => '#1a4a8a'
            ],
        ];

        $cityMap = [];
        foreach ($citiesData as $c) {
            $city = City::updateOrCreate(
                ['slug' => $c['id']],
                [
                    'name' => $c['name'],
                    'state' => $c['state'],
                    'tagline' => $c['tagline'],
                    'hero_image' => $c['hero_image'],
                    'accent_color' => $c['accent_color'],
                    'is_active' => true,
                ]
            );
            $cityMap[$c['id']] = $city->id;
        }

        // 6. Articles Seed
        $articles = [
            [
                'title' => 'The Renaissance of Handloom: Bridging Tradition and Modernity',
                'excerpt' => 'India\'s master weavers are redefining luxury, one thread at a time. How heritage craft is making its way onto global runways.',
                'author_name' => 'Priya Mehta',
                'category' => 'Fashion',
                'city' => null,
                'cover_image' => 'https://images.unsplash.com/photo-1610030469983-98e550d6193c?w=1800&q=85',
                'is_cover' => true,
                'is_featured' => true,
                'read_time' => '8 min read',
                'tags' => ['Fashion', 'Handloom', 'Heritage'],
            ],
            [
                'title' => '5 Designers Redefining Indian Luxury for the Next Generation',
                'excerpt' => 'Meet the new guard of Indian fashion who are blending local craft with global sensibility.',
                'author_name' => 'Ananya Kapoor',
                'category' => 'Fashion',
                'city' => null,
                'cover_image' => 'https://images.unsplash.com/photo-1483985988355-763728e1935b?w=800&q=80',
                'is_cover' => false,
                'is_featured' => true,
                'read_time' => '5 min read',
                'tags' => ['Fashion', 'Designers', 'Luxury'],
            ],
            [
                'title' => 'The Untold Stories of India\'s Art Scene: A New Wave of Expression',
                'excerpt' => 'Contemporary Indian artists are breaking boundaries and challenging conventions in the most unexpected ways.',
                'author_name' => 'Riya Nair',
                'category' => 'Culture',
                'city' => null,
                'cover_image' => 'https://images.unsplash.com/photo-1541961017774-22349e4a1262?w=800&q=80',
                'is_cover' => false,
                'is_featured' => true,
                'read_time' => '6 min read',
                'tags' => ['Culture', 'Art', 'Expression'],
            ],
            [
                'title' => 'Aromatic Encounters: Essential Oils for Summer Wellness',
                'excerpt' => 'Ancient Ayurvedic wisdom meets modern wellness routines in this season\'s most coveted beauty rituals.',
                'author_name' => 'Meera Pillai',
                'category' => 'Beauty',
                'city' => null,
                'cover_image' => 'https://images.unsplash.com/photo-1608571423902-eed4a5ad8108?w=800&q=80',
                'is_cover' => false,
                'is_featured' => true,
                'read_time' => '4 min read',
                'tags' => ['Beauty', 'Wellness', 'Ayurveda'],
            ],
            [
                'title' => 'The City\'s Best Moments: A Celebration of Culture and Community',
                'excerpt' => 'Bhavnagar\'s vibrant festival scene brings together centuries of tradition with modern celebration.',
                'author_name' => 'Alok Sharma',
                'category' => 'Events',
                'city' => 'bhavnagar',
                'cover_image' => 'https://images.unsplash.com/photo-1604480132736-44c188fe4d20?w=1200&q=80',
                'is_cover' => false,
                'is_featured' => true,
                'read_time' => '5 min read',
                'tags' => ['Events', 'Culture', 'Festival'],
            ],
            [
                'title' => 'Heritage Walks: Discovering the Soul of Old Bhavnagar',
                'excerpt' => 'The narrow lanes of Bhavnagar\'s old city hide stories that go back centuries — here\'s how to find them.',
                'author_name' => 'Mira Desai',
                'category' => 'Culture',
                'city' => 'bhavnagar',
                'cover_image' => 'https://images.unsplash.com/photo-1570168007204-dfb528c6958f?w=800&q=80',
                'is_cover' => false,
                'is_featured' => false,
                'read_time' => '6 min read',
                'tags' => ['Culture', 'Heritage', 'Walk'],
            ],
            [
                'title' => 'Authentic Flavors: A Foodie\'s Guide to the Best Local Eateries',
                'excerpt' => 'From Gathiya to Dabeli — the street food of Bhavnagar that you must try before you leave.',
                'author_name' => 'Priti Shah',
                'category' => 'Food',
                'city' => 'bhavnagar',
                'cover_image' => 'https://images.unsplash.com/photo-1546833999-b9f581a1996d?w=800&q=80',
                'is_cover' => false,
                'is_featured' => false,
                'read_time' => '4 min read',
                'tags' => ['Food', 'Local'],
            ],
            [
                'title' => 'Startup Hub Growth: Young Entrepreneurs Transforming Bhavnagar',
                'excerpt' => 'A new generation of founders is building the future from one of Gujarat\'s most storied cities.',
                'author_name' => 'Priti Shah',
                'category' => 'People',
                'city' => 'bhavnagar',
                'cover_image' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=800&q=80',
                'is_cover' => false,
                'is_featured' => false,
                'read_time' => '5 min read',
                'tags' => ['People', 'Business', 'Youth'],
            ],
            [
                'title' => 'Bhavnagar\'s Bandhani: The Tie-Dye Tradition Goes Global',
                'excerpt' => 'Local artisans are bringing this ancient Gujarati textile art to international fashion weeks.',
                'author_name' => 'Alok Sharma',
                'category' => 'Fashion',
                'city' => 'bhavnagar',
                'cover_image' => 'https://images.unsplash.com/photo-1610030469983-98e550d6193c?w=800&q=80',
                'is_cover' => false,
                'is_featured' => false,
                'read_time' => '6 min read',
                'tags' => ['Fashion', 'Bandhani', 'Craft'],
            ],
            [
                'title' => 'Colaba Causeway: Mumbai\'s Most Iconic Fashion Street',
                'excerpt' => 'Where bohemian meets glamour — Colaba\'s street fashion is a world unto itself.',
                'author_name' => 'Zara Ahmed',
                'category' => 'Fashion',
                'city' => 'mumbai',
                'cover_image' => 'https://images.unsplash.com/photo-1529253355930-ddbe423a2ac7?w=1200&q=80',
                'is_cover' => false,
                'is_featured' => true,
                'read_time' => '5 min read',
                'tags' => ['Fashion', 'Street Style', 'Mumbai'],
            ],
        ];

        foreach ($articles as $artData) {
            $catId = isset($catMap[$artData['category']]) ? $catMap[$artData['category']] : null;
            $cityId = ($artData['city'] && isset($cityMap[$artData['city']])) ? $cityMap[$artData['city']] : null;

            $slug = Str::slug($artData['title']);
            $body = '<p>' . e($artData['excerpt']) . '</p><p>Selected with purpose. Documented with responsibility. CityIcons documents the individuals, cultural custodians, and visionary minds building the fabric of our cities.</p>';

            $article = Article::updateOrCreate(
                ['slug' => $slug],
                [
                    'title' => $artData['title'],
                    'excerpt' => $artData['excerpt'],
                    'body' => $body,
                    'author_name' => $artData['author_name'],
                    'category_id' => $catId,
                    'city_id' => $cityId,
                    'cover_image' => $artData['cover_image'],
                    'is_cover' => $artData['is_cover'],
                    'is_featured' => $artData['is_featured'],
                    'read_time' => $artData['read_time'],
                    'status' => 'published',
                    'published_at' => now()->subDays(rand(1, 15)),
                ]
            );

            if (!empty($artData['tags'])) {
                $attachTagIds = [];
                foreach ($artData['tags'] as $tagName) {
                    if (isset($tagMap[$tagName])) {
                        $attachTagIds[] = $tagMap[$tagName];
                    }
                }
                $article->tags()->sync($attachTagIds);
            }
        }

        // 7. People Directory (Bhavnagar Icons, Rising Stars, Voices)
        $people = [
            [
                'name' => 'Dr. Hitesh Vaghela',
                'type' => 'icon',
                'tagline' => 'Pioneer in Maritime Engineering & Heritage Conservation',
                'profession' => 'Marine Engineer & Historian',
                'organization' => 'Alang Heritage Trust',
                'city' => 'bhavnagar',
                'category' => 'People',
                'portrait_image' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=800&q=80',
                'year' => 2026,
                'month' => 11,
                'is_featured' => true,
            ],
            [
                'name' => 'Nandini Raichura',
                'type' => 'icon',
                'tagline' => 'Preserving Saurashtra Bandhani for the Modern Wardrobe',
                'profession' => 'Master Textile Designer',
                'organization' => 'Raichura Weaves Studio',
                'city' => 'bhavnagar',
                'category' => 'Fashion',
                'portrait_image' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=800&q=80',
                'year' => 2026,
                'month' => 11,
                'is_featured' => true,
            ],
            [
                'name' => 'Aarav Parekh',
                'type' => 'rising',
                'tagline' => 'Building Sustainable Agri-Tech Solutions from Bhavnagar',
                'profession' => 'AgriTech Founder',
                'organization' => 'Saurashtra Greens Tech',
                'city' => 'bhavnagar',
                'category' => 'Business',
                'portrait_image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=800&q=80',
                'year' => 2026,
                'month' => 11,
                'is_featured' => true,
            ],
            [
                'name' => 'Kavita Trivedi',
                'type' => 'voice',
                'tagline' => 'Documenting the Oral Folk Histories of Saurashtra Coast',
                'profession' => 'Author & Cultural Anthropologist',
                'organization' => 'Coastal Folklore Collective',
                'city' => 'bhavnagar',
                'category' => 'Culture',
                'portrait_image' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=800&q=80',
                'year' => 2026,
                'month' => 11,
                'is_featured' => true,
            ],
        ];

        foreach ($people as $p) {
            $catId = isset($catMap[$p['category']]) ? $catMap[$p['category']] : null;
            $cityId = isset($cityMap[$p['city']]) ? $cityMap[$p['city']] : null;

            Person::updateOrCreate(
                ['slug' => Str::slug($p['name'])],
                [
                    'name' => $p['name'],
                    'type' => $p['type'],
                    'tagline' => $p['tagline'],
                    'bio' => '<p>' . e($p['tagline']) . ' Dr. Hitesh has been a cornerstone in documenting the maritime legacy of Gujarat, working tirelessly to preserve both physical artifacts and oral history for future generations.</p>',
                    'profession' => $p['profession'],
                    'organization' => $p['organization'],
                    'portrait_image' => $p['portrait_image'],
                    'cover_image' => $p['portrait_image'],
                    'city_id' => $cityId,
                    'category_id' => $catId,
                    'year' => $p['year'],
                    'month' => $p['month'],
                    'is_featured' => $p['is_featured'],
                    'status' => 'published',
                ]
            );
        }

        // 8. Magazine Edition
        MagazineEdition::updateOrCreate(
            ['issue_number' => 1],
            [
                'title' => 'Issue 01 — Bhavnagar Flagship Edition',
                'cover_image' => 'https://images.unsplash.com/photo-1706285654021-4b2f69f0e773?w=1000&q=85',
                'description' => 'The inaugural print edition celebrating 25 people who define the cultural and commercial spirit of Bhavnagar.',
                'published_date' => '2026-11-01',
                'is_active' => true,
            ]
        );

        // 9. Featured Brand Partners
        $brands = [
            [
                'name' => 'Nilambagh Palace Heritage Hotel',
                'website_url' => 'https://nilambaghpalace.com',
                'description' => 'A royal heritage hotel dating back to 1859, reflecting the rich architecture of the Gohil dynasty.',
                'disclosure_text' => 'Official Heritage Partner of Bhavnagar Icons Issue 01.',
            ],
            [
                'name' => 'Saurashtra Weavers Guild',
                'website_url' => 'https://saurashtraweaves.org',
                'description' => 'A cooperative representing over 400 traditional Bandhani and Patola artisans across Gujarat.',
                'disclosure_text' => 'Cultural Preservation Partner.',
            ],
        ];

        foreach ($brands as $b) {
            Brand::updateOrCreate(
                ['slug' => Str::slug($b['name'])],
                [
                    'name' => $b['name'],
                    'website_url' => $b['website_url'],
                    'description' => $b['description'],
                    'disclosure_text' => $b['disclosure_text'],
                    'is_active' => true,
                    'is_featured' => true,
                ]
            );
        }
    }
}
