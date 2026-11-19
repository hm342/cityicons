<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Category;
use App\Models\Article;
use App\Models\Person;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CityEditionsSeeder extends Seeder
{
    public function run(): void
    {
        $bhavnagar = City::where('slug', 'bhavnagar')->first();
        if (!$bhavnagar) return;

        $catMap = Category::pluck('id', 'name')->all();

        // ── 1. REAL AUTHENTIC BHAVNAGAR ARTICLES ──────────────────
        $articles = [
            // Hero / Lead Stories
            [
                'title' => 'Nilambag Palace: The Living Architecture of Saurashtra Royalty',
                'excerpt' => 'Built in 1859 by German architect Simonson for Maharaja Takhtsinhji, Nilambag Palace stands as a transcendent synthesis of colonial Victorian grace and Kathiyawadi princely grandeur.',
                'author_name' => 'Kavita Trivedi',
                'category' => 'Culture',
                'cover_image' => 'https://images.unsplash.com/photo-1598511757337-fe2cafc31ba0?w=1600&q=85',
                'read_time' => '7 min read',
                'is_featured' => true,
                'is_cover' => true,
                'section' => 'icons',
            ],
            [
                'title' => 'Alang Maritime Yard: Circular Economy at Continental Scale',
                'excerpt' => 'Where ocean titans find second life. Documenting the engineering precision, steel salvage, and global industrial supply chains pulsing through the Bhavnagar coastline.',
                'author_name' => 'Dr. Hitesh Vora',
                'category' => 'Business',
                'cover_image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=1600&q=85',
                'read_time' => '9 min read',
                'is_featured' => true,
                'is_cover' => false,
                'section' => 'general',
            ],
            [
                'title' => 'Velavadar: The Golden Savannah of the Indian Blackbuck',
                'excerpt' => 'A primeval grassland where the endangered blackbuck leaps against Saurashtra skies. Conservation stewardship, migratory harriers, and the balance of nature in Bhavnagar district.',
                'author_name' => 'Manoj Jadeja',
                'category' => 'Places',
                'cover_image' => 'https://images.unsplash.com/photo-1546833999-b9f581a1996d?w=1600&q=85',
                'read_time' => '6 min read',
                'is_featured' => true,
                'is_cover' => false,
                'section' => 'general',
            ],
            [
                'title' => 'The Barton Library: A Century of Preserved Manuscripts and Rare Texts',
                'excerpt' => 'Founded in 1882 in Ashlar stone architecture, Bhavnagar\'s intellectual sanctum houses over 65,000 priceless historic volumes, palm manuscripts, and civic archives.',
                'author_name' => 'Pooja Bhatt',
                'category' => 'Culture',
                'cover_image' => 'https://images.unsplash.com/photo-1521587760476-6c12a4b040da?w=1600&q=85',
                'read_time' => '8 min read',
                'is_featured' => false,
                'is_cover' => false,
                'section' => 'general',
            ],
            [
                'title' => 'Takhteshwar Temple: High Above the Gulf of Khambhat',
                'excerpt' => 'Perched atop a natural hillock overlooking the city, Takhteshwar’s pure white marble pillared hall offers sunset panoramic vistas unmatched anywhere in western India.',
                'author_name' => 'Nirav Dave',
                'category' => 'Culture',
                'cover_image' => 'https://images.unsplash.com/photo-1587474260584-136574528ed5?w=1600&q=85',
                'read_time' => '5 min read',
                'is_featured' => false,
                'is_cover' => false,
                'section' => 'general',
            ],

            // Section 2: Culinary & Taste (5 Stories)
            [
                'title' => 'The Geometry of Bhavnagari Ganthiya: A 150-Year Morning Ritual',
                'excerpt' => 'Besan, black pepper, ajwain, and pure peanut oil. How master fryers create the melt-in-mouth texture that defines breakfast from Ghogha Gate to international diaspora.',
                'author_name' => 'Rameshwar Vyas',
                'category' => 'Food',
                'cover_image' => 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=1200&q=80',
                'read_time' => '6 min read',
                'is_featured' => true,
                'is_cover' => false,
                'section' => 'general',
            ],
            [
                'title' => 'Bateta Vada of Ghogha Circle: Street Gastronomy at Dusk',
                'excerpt' => 'Crisp golden crust, spiced potato mash infused with fresh coriander and green chilies, served with tang of raw papaya chutney.',
                'author_name' => 'Deepika Joshi',
                'category' => 'Food',
                'cover_image' => 'https://images.unsplash.com/photo-1565299585323-38d6b0865b47?w=1200&q=80',
                'read_time' => '4 min read',
                'is_featured' => false,
                'is_cover' => false,
                'section' => 'general',
            ],
            [
                'title' => 'Kathiyawadi Thali Traditions: Smoky Ringna No Oro and Bajra Rotla',
                'excerpt' => 'Charcoal-roasted eggplants mashed with winter garlic, jaggery, and white butter served alongside steaming hot hand-patted millet rotla.',
                'author_name' => 'Alok Sharma',
                'category' => 'Food',
                'cover_image' => 'https://images.unsplash.com/photo-1613292443284-8d10ef9383fe?w=1200&q=80',
                'read_time' => '7 min read',
                'is_featured' => false,
                'is_cover' => false,
                'section' => 'general',
            ],
            [
                'title' => 'The Sweet Alchemists of Pendawala Street: Pedas of Mawa and Cardamom',
                'excerpt' => 'Slow-reduced milk solids caramelized over teak wood stoves. The century-old confectionery families who never compromised on purity.',
                'author_name' => 'Pooja Bhatt',
                'category' => 'Food',
                'cover_image' => 'https://images.unsplash.com/photo-1509440159596-0249088772ff?w=1200&q=80',
                'read_time' => '5 min read',
                'is_featured' => false,
                'is_cover' => false,
                'section' => 'general',
            ],
            [
                'title' => 'Gopnath Beach Fresh Catch: Coastal Fish Curries and Coastal Life',
                'excerpt' => 'Exploring the seasonal fishing harbors of coastal Saurashtra where generations of Koli fishermen harvest pomfret and prawns at daybreak.',
                'author_name' => 'Kavita Trivedi',
                'category' => 'Food',
                'cover_image' => 'https://images.unsplash.com/photo-1534422298391-e4f8c172dddb?w=1200&q=80',
                'read_time' => '6 min read',
                'is_featured' => false,
                'is_cover' => false,
                'section' => 'general',
            ],

            // Section 3: Fashion & Craft (5 Stories)
            [
                'title' => 'Sihor Brass Craftsmanship: Hammering Heritage into Sacred Vessels',
                'excerpt' => 'Just 20 kilometers from Bhavnagar city, the artisan metallurgists of Sihor continue the centuries-old technique of beating brass and copper into gleaming temple bells and heirloom urns.',
                'author_name' => 'Ananya Kapoor',
                'category' => 'Art',
                'cover_image' => 'https://images.unsplash.com/photo-1610030469983-98e550d6193c?w=1200&q=80',
                'read_time' => '8 min read',
                'is_featured' => true,
                'is_cover' => false,
                'section' => 'general',
            ],
            [
                'title' => 'Gohilwad Bandhani: Precision Knots Transforming Natural Silk',
                'excerpt' => 'The intricate dot-and-knot resist dye tradition practiced across generations of Saurashtra craftswomen.',
                'author_name' => 'Nandini Raichura',
                'category' => 'Fashion',
                'cover_image' => 'https://images.unsplash.com/photo-1483985988355-763728e1935b?w=1200&q=80',
                'read_time' => '6 min read',
                'is_featured' => false,
                'is_cover' => false,
                'section' => 'general',
            ],
            [
                'title' => 'Heirloom Silver Jewelry: The Tribal Filigree of Saurashtra Women',
                'excerpt' => 'Heavy hollow silver anklets, engraved armlets, and talisman pendants reflecting the nomadic beauty of Gujarat\'s Rabari and Bharwad communities.',
                'author_name' => 'Nandini Raichura',
                'category' => 'Fashion',
                'cover_image' => 'https://images.unsplash.com/photo-1535632066927-ab7c9ab60908?w=1200&q=80',
                'read_time' => '5 min read',
                'is_featured' => false,
                'is_cover' => false,
                'section' => 'general',
            ],
            [
                'title' => 'Contemporary Khadi: Bhavnagar Weavers Modernizing Handspun Textiles',
                'excerpt' => 'Organic desi cotton spun on traditional amber charkhas, reimagined into contemporary summer jackets, breathable shirts, and sustainable runway couture.',
                'author_name' => 'Priya Mehta',
                'category' => 'Fashion',
                'cover_image' => 'https://images.unsplash.com/photo-1558769132-cb1aea458c5e?w=1200&q=80',
                'read_time' => '7 min read',
                'is_featured' => false,
                'is_cover' => false,
                'section' => 'general',
            ],
            [
                'title' => 'Embroidery of the Saurashtra Coast: Mirrorwork That Catches the Sun',
                'excerpt' => 'Abhla mirror work and fine silk needlecraft that protected royal robes and wedding torans for generations.',
                'author_name' => 'Priya Mehta',
                'category' => 'Fashion',
                'cover_image' => 'https://images.unsplash.com/photo-1509631179647-0177331693ae?w=1200&q=80',
                'read_time' => '6 min read',
                'is_featured' => false,
                'is_cover' => false,
                'section' => 'general',
            ],

            // Section 5: Editorial Dispatches / Blog Stream (4 Stories)
            [
                'title' => 'Gopnath Sanctuary & The Royal Seaside Retreat of Bhavnagar Kings',
                'excerpt' => 'Once the summer sanctuary of the Gohil kings, Gopnath\'s limestone cliffs and maritime breezes offer an unspoiled sanctuary from modern noise.',
                'author_name' => 'Dr. Hitesh Vora',
                'category' => 'Places',
                'cover_image' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=1200&q=80',
                'read_time' => '6 min read',
                'is_featured' => true,
                'is_cover' => false,
                'section' => 'voices',
            ],
            [
                'title' => 'Victoria Park: The Oldest Protected Urban Forest in Gujarat',
                'excerpt' => 'Spanning over 500 acres inside city limits, Victoria Park shelters blue bulls, peacocks, golden jackals, and over 150 rare bird species in untouched scrubland.',
                'author_name' => 'Manoj Jadeja',
                'category' => 'Places',
                'cover_image' => 'https://images.unsplash.com/photo-1448375240586-882707db888b?w=1200&q=80',
                'read_time' => '5 min read',
                'is_featured' => false,
                'is_cover' => false,
                'section' => 'general',
            ],
            [
                'title' => 'Ship Recycling & Green Steel: The Sustainable Evolution at Alang',
                'excerpt' => 'How environmental certifications, HKC compliance, and sustainable salvage methodologies are turning the shipbreaking hub into a pioneer of global circularity.',
                'author_name' => 'Aarav Parekh',
                'category' => 'Business',
                'cover_image' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=1200&q=80',
                'read_time' => '8 min read',
                'is_featured' => false,
                'is_cover' => false,
                'section' => 'general',
            ],
            [
                'title' => 'The Lost Art of Saurashtra Folk Music: Dayro Evenings Under the Stars',
                'excerpt' => 'All-night musical congregations where Santvani bhajans, Kathiawadi couplets, and classical harmonium melodies preserve the oral spirit of the soil.',
                'author_name' => 'Kavita Trivedi',
                'category' => 'Culture',
                'cover_image' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?w=1200&q=80',
                'read_time' => '7 min read',
                'is_featured' => false,
                'is_cover' => false,
                'section' => 'voices',
            ],
        ];

        foreach ($articles as $art) {
            $catId = $catMap[$art['category']] ?? ($catMap['Culture'] ?? null);
            $slug = Str::slug($art['title']);

            Article::updateOrCreate(
                ['slug' => $slug],
                [
                    'title' => $art['title'],
                    'excerpt' => $art['excerpt'],
                    'body' => '<p>' . e($art['excerpt']) . '</p><p>Documented by Bhavnagar Icons editorial staff. Selected with purpose. Documented with responsibility.</p>',
                    'author_name' => $art['author_name'],
                    'category_id' => $catId,
                    'city_id' => $bhavnagar->id,
                    'cover_image' => $art['cover_image'],
                    'is_cover' => $art['is_cover'],
                    'is_featured' => $art['is_featured'],
                    'read_time' => $art['read_time'],
                    'section' => $art['section'],
                    'status' => 'published',
                    'published_at' => now(),
                ]
            );
        }

        // ── 2. REAL AUTHENTIC BHAVNAGAR CITIZENS & PEOPLE (6 Total for 3x2 Grid) ──
        $people = [
            [
                'name' => 'Dr. Hitesh Vora',
                'type' => 'icon',
                'tagline' => 'Pioneer in Maritime Engineering & Heritage Conservation',
                'profession' => 'Marine Engineer & Historian',
                'organization' => 'Alang Maritime Trust',
                'category' => 'People',
                'portrait_image' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=800&q=80',
            ],
            [
                'name' => 'Nandini Raichura',
                'type' => 'icon',
                'tagline' => 'Preserving Saurashtra Bandhani for the Modern Wardrobe',
                'profession' => 'Master Textile Designer',
                'organization' => 'Raichura Weaves Studio',
                'category' => 'Fashion',
                'portrait_image' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=800&q=80',
            ],
            [
                'name' => 'Aarav Parekh',
                'type' => 'rising',
                'tagline' => 'Building Sustainable Agri-Tech Solutions from Bhavnagar',
                'profession' => 'AgriTech Founder & Tech Pioneer',
                'organization' => 'Saurashtra Greens Tech',
                'category' => 'Business',
                'portrait_image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=800&q=80',
            ],
            [
                'name' => 'Kavita Trivedi',
                'type' => 'voice',
                'tagline' => 'Documenting the Oral Folk Histories of Saurashtra Coast',
                'profession' => 'Author & Cultural Anthropologist',
                'organization' => 'Coastal Folklore Collective',
                'category' => 'Culture',
                'portrait_image' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=800&q=80',
            ],
            [
                'name' => 'Manish Gohil',
                'type' => 'icon',
                'tagline' => 'Restoring Royal Heritage Haveli Architecture in Saurashtra',
                'profession' => 'Principal Conservation Architect',
                'organization' => 'Saurashtra Heritage Guild',
                'category' => 'Art',
                'portrait_image' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=800&q=80',
            ],
            [
                'name' => 'Riddhi Pandya',
                'type' => 'rising',
                'tagline' => 'Empowering Traditional Women Artisans Through Direct Trade',
                'profession' => 'Social Innovator & Educator',
                'organization' => 'Gohilwad Artisan Collective',
                'category' => 'People',
                'portrait_image' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?w=800&q=80',
            ],
        ];

        foreach ($people as $i => $p) {
            $catId = $catMap[$p['category']] ?? null;
            Person::updateOrCreate(
                ['slug' => Str::slug($p['name'])],
                [
                    'name' => $p['name'],
                    'type' => $p['type'],
                    'tagline' => $p['tagline'],
                    'bio' => '<p>' . e($p['tagline']) . ' Recognized for lasting contributions to the civic and cultural life of Bhavnagar.</p>',
                    'profession' => $p['profession'],
                    'organization' => $p['organization'],
                    'portrait_image' => $p['portrait_image'],
                    'cover_image' => $p['portrait_image'],
                    'city_id' => $bhavnagar->id,
                    'category_id' => $catId,
                    'year' => 2026,
                    'month' => 11,
                    'sort_order' => $i + 1,
                    'status' => 'published',
                    'is_featured' => true,
                ]
            );
        }
    }
}
