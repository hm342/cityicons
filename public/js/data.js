// ============================================================
// CITYICON MAGAZINE — CENTRALIZED DATA
// ============================================================

const CITYICON_DATA = {

  // ── SITE CONFIG ──────────────────────────────────────────
  siteName: "CITYICON",
  tagline: "India's City Magazine",
  categories: ["Fashion", "Beauty", "Culture", "Food", "Events", "People", "Places", "Street Style", "Weddings"],

  // ── CITIES ───────────────────────────────────────────────
  cities: [
    {
      id: "bhavnagar",
      name: "Bhavnagar",
      state: "Gujarat",
      tagline: "The Jewel of Saurashtra",
      heroImg: "https://images.unsplash.com/photo-1706285654021-4b2f69f0e773?w=1400&q=80",
      accentColor: "#c0613b"
    },
    {
      id: "mumbai",
      name: "Mumbai",
      state: "Maharashtra",
      tagline: "City of Dreams",
      heroImg: "https://images.unsplash.com/photo-1529253355930-ddbe423a2ac7?w=1400&q=80",
      accentColor: "#8b1a1a"
    },
    {
      id: "surat",
      name: "Surat",
      state: "Gujarat",
      tagline: "The Diamond City",
      heroImg: "https://images.unsplash.com/photo-1587474260584-136574528ed5?w=1400&q=80",
      accentColor: "#c97d2e"
    },
    {
      id: "ahmedabad",
      name: "Ahmedabad",
      state: "Gujarat",
      tagline: "Heritage & Modernity",
      heroImg: "https://images.unsplash.com/photo-1598511757337-fe2cafc31ba0?w=1400&q=80",
      accentColor: "#3d5a99"
    },
    {
      id: "rajkot",
      name: "Rajkot",
      state: "Gujarat",
      tagline: "City of Culture",
      heroImg: "https://images.unsplash.com/photo-1570168007204-dfb528c6958f?w=1400&q=80",
      accentColor: "#2a7d6e"
    },
    {
      id: "vadodara",
      name: "Vadodara",
      state: "Gujarat",
      tagline: "City of Fine Arts",
      heroImg: "https://images.unsplash.com/photo-1541089404510-5c9a779841fc?w=1400&q=80",
      accentColor: "#b5860d"
    },
    {
      id: "delhi",
      name: "Delhi",
      state: "Delhi",
      tagline: "Heart of India",
      heroImg: "https://images.unsplash.com/photo-1587474260584-136574528ed5?w=1400&q=80",
      accentColor: "#6b1f3a"
    },
    {
      id: "bengaluru",
      name: "Bengaluru",
      state: "Karnataka",
      tagline: "Garden City",
      heroImg: "https://images.unsplash.com/photo-1596176530529-78163a4f7af2?w=1400&q=80",
      accentColor: "#2d6a4f"
    },
    {
      id: "jaipur",
      name: "Jaipur",
      state: "Rajasthan",
      tagline: "The Pink City",
      heroImg: "https://images.unsplash.com/photo-1477587458883-47145ed68ac5?w=1400&q=80",
      accentColor: "#b5456e"
    },
    {
      id: "kolkata",
      name: "Kolkata",
      state: "West Bengal",
      tagline: "City of Joy",
      heroImg: "https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=1400&q=80",
      accentColor: "#1a4a8a"
    }
  ],

  // ── ARTICLES ─────────────────────────────────────────────
  articles: [
    // === NATIONAL / MAIN ARTICLES ===
    {
      id: 1,
      city: null,
      isCover: true,
      isFeatured: true,
      category: "Fashion",
      title: "The Renaissance of Handloom: Bridging Tradition and Modernity",
      excerpt: "India's master weavers are redefining luxury, one thread at a time. How heritage craft is making its way onto global runways.",
      author: "Priya Mehta",
      date: "2026-11-15",
      readTime: "8 min read",
      image: "https://images.unsplash.com/photo-1610030469983-98e550d6193c?w=1800&q=85",
      tags: ["Fashion", "Handloom", "Heritage"]
    },
    {
      id: 2,
      city: null,
      isFeatured: true,
      category: "Fashion",
      title: "5 Designers Redefining Indian Luxury for the Next Generation",
      excerpt: "Meet the new guard of Indian fashion who are blending local craft with global sensibility.",
      author: "Ananya Kapoor",
      date: "2026-11-14",
      readTime: "5 min read",
      image: "https://images.unsplash.com/photo-1483985988355-763728e1935b?w=800&q=80",
      tags: ["Fashion", "Designers", "Luxury"]
    },
    {
      id: 3,
      city: null,
      isFeatured: true,
      category: "Culture",
      title: "The Untold Stories of India's Art Scene: A New Wave of Expression",
      excerpt: "Contemporary Indian artists are breaking boundaries and challenging conventions in the most unexpected ways.",
      author: "Riya Nair",
      date: "2026-11-13",
      readTime: "6 min read",
      image: "https://images.unsplash.com/photo-1541961017774-22349e4a1262?w=800&q=80",
      tags: ["Culture", "Art", "Expression"]
    },
    {
      id: 4,
      city: null,
      isFeatured: true,
      category: "Beauty",
      title: "Aromatic Encounters: Essential Oils for Summer Wellness",
      excerpt: "Ancient Ayurvedic wisdom meets modern wellness routines in this season's most coveted beauty rituals.",
      author: "Meera Pillai",
      date: "2026-11-12",
      readTime: "4 min read",
      image: "https://images.unsplash.com/photo-1608571423902-eed4a5ad8108?w=800&q=80",
      tags: ["Beauty", "Wellness", "Ayurveda"]
    },
    {
      id: 5,
      city: null,
      category: "Fashion",
      title: "Street Style: Navigating Mumbai's Fashion-Forward Streets",
      excerpt: "The sidewalks of South Mumbai are the city's most dynamic fashion runway.",
      author: "Kabir Shah",
      date: "2026-11-11",
      readTime: "3 min read",
      image: "https://images.unsplash.com/photo-1539109136881-3be0616acf4b?w=800&q=80",
      tags: ["Street Style", "Mumbai", "Fashion"]
    },
    {
      id: 6,
      city: null,
      category: "Fashion",
      title: "The Jewellery Edit: Gold & Gems for the Season",
      excerpt: "From temple jewellery to contemporary minimalism — this season's most covetable pieces.",
      author: "Zara Ahmed",
      date: "2026-11-10",
      readTime: "4 min read",
      image: "https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?w=800&q=80",
      tags: ["Fashion", "Jewellery", "Style"]
    },
    {
      id: 7,
      city: null,
      category: "Fashion",
      title: "Runway Report: Spring Trends That Will Define Your Wardrobe",
      excerpt: "From Lakme Fashion Week to Milan — the looks that matter for the season ahead.",
      author: "Priya Mehta",
      date: "2026-11-09",
      readTime: "7 min read",
      image: "https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&q=80",
      tags: ["Fashion", "Runway", "Trends"]
    },
    {
      id: 8,
      city: null,
      category: "Fashion",
      title: "Accessory Must-Haves: Bags, Shoes & More for the Modern Indian Woman",
      excerpt: "Complete your look with these standout accessories that are worth every rupee.",
      author: "Ananya Kapoor",
      date: "2026-11-08",
      readTime: "4 min read",
      image: "https://images.unsplash.com/photo-1584917865442-de89df76afd3?w=800&q=80",
      tags: ["Fashion", "Accessories", "Style"]
    },
    {
      id: 9,
      city: null,
      category: "Culture",
      title: "Festival Diaries: Diwali Delights Across the Nation",
      excerpt: "How India's most loved festival is celebrated differently in every corner of the country.",
      author: "Riya Nair",
      date: "2026-11-07",
      readTime: "6 min read",
      image: "https://images.unsplash.com/photo-1604480132736-44c188fe4d20?w=800&q=80",
      tags: ["Culture", "Festival", "Diwali"]
    },
    {
      id: 10,
      city: null,
      category: "Culture",
      title: "Architectural Marvels of Ahmedabad: A World Heritage Story",
      excerpt: "Walking through the old walled city of Ahmedabad, India's first UNESCO World Heritage City.",
      author: "Dev Patel",
      date: "2026-11-06",
      readTime: "8 min read",
      image: "https://images.unsplash.com/photo-1598511757337-fe2cafc31ba0?w=800&q=80",
      tags: ["Culture", "Architecture", "Heritage"]
    },
    {
      id: 11,
      city: null,
      category: "Beauty",
      title: "The Art of Slow Living in Goa: Beauty Rituals by the Sea",
      excerpt: "Goa's coast isn't just a beach destination — it's a blueprint for a more intentional beauty routine.",
      author: "Meera Pillai",
      date: "2026-11-05",
      readTime: "5 min read",
      image: "https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800&q=80",
      tags: ["Beauty", "Lifestyle", "Goa"]
    },
    {
      id: 12,
      city: null,
      category: "Food",
      title: "The Great Indian Thali: A Culinary Journey Across Regions",
      excerpt: "One plate, infinite flavours — how the humble thali tells the story of India's diverse culinary traditions.",
      author: "Tanvi Joshi",
      date: "2026-11-04",
      readTime: "7 min read",
      image: "https://images.unsplash.com/photo-1546833999-b9f581a1996d?w=800&q=80",
      tags: ["Food", "Indian Cuisine", "Culture"]
    },
    {
      id: 13,
      city: null,
      category: "Food",
      title: "Chai Culture: The Art of Tea Across India's Cities",
      excerpt: "From Irani chai in Hyderabad to masala chai in Mumbai — the chai stories that define us.",
      author: "Kabir Shah",
      date: "2026-11-03",
      readTime: "4 min read",
      image: "https://images.unsplash.com/photo-1556679343-c7306c1976bc?w=800&q=80",
      tags: ["Food", "Chai", "Culture"]
    },
    {
      id: 14,
      city: null,
      category: "People",
      title: "Changemakers 2026: 10 Indians Shaping the Future",
      excerpt: "Meet the visionaries, activists, artists and entrepreneurs creating the India of tomorrow.",
      author: "Priya Mehta",
      date: "2026-11-02",
      readTime: "10 min read",
      image: "https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=800&q=80",
      tags: ["People", "Changemakers", "India"]
    },
    {
      id: 15,
      city: null,
      category: "Places",
      title: "Hidden Gems: 15 Indian Towns You Need to Visit Before They're Discovered",
      excerpt: "Beyond the tourist trail, these small towns offer experiences that will stay with you forever.",
      author: "Riya Nair",
      date: "2026-11-01",
      readTime: "9 min read",
      image: "https://images.unsplash.com/photo-1524492412937-b28074a5d7da?w=800&q=80",
      tags: ["Places", "Travel", "Hidden Gems"]
    },

    // === BHAVNAGAR ARTICLES ===
    {
      id: 101,
      city: "bhavnagar",
      isFeatured: true,
      category: "Events",
      title: "The City's Best Moments: A Celebration of Culture and Community",
      excerpt: "Bhavnagar's vibrant festival scene brings together centuries of tradition with modern celebration.",
      author: "Alok Sharma",
      date: "2026-11-15",
      readTime: "5 min read",
      image: "https://images.unsplash.com/photo-1604480132736-44c188fe4d20?w=1200&q=80",
      tags: ["Events", "Culture", "Festival"]
    },
    {
      id: 102,
      city: "bhavnagar",
      category: "Culture",
      title: "Heritage Walks: Discovering the Soul of Old Bhavnagar",
      excerpt: "The narrow lanes of Bhavnagar's old city hide stories that go back centuries — here's how to find them.",
      author: "Mira Desai",
      date: "2026-11-14",
      readTime: "6 min read",
      image: "https://images.unsplash.com/photo-1570168007204-dfb528c6958f?w=800&q=80",
      tags: ["Culture", "Heritage", "Walk"]
    },
    {
      id: 103,
      city: "bhavnagar",
      category: "Food",
      title: "Authentic Flavors: A Foodie's Guide to the Best Local Eateries",
      excerpt: "From Gathiya to Dabeli — the street food of Bhavnagar that you must try before you leave.",
      author: "Priti Shah",
      date: "2026-11-13",
      readTime: "4 min read",
      image: "https://images.unsplash.com/photo-1546833999-b9f581a1996d?w=800&q=80",
      tags: ["Food", "Street Food", "Local"]
    },
    {
      id: 104,
      city: "bhavnagar",
      category: "Street Style",
      title: "Street Art Festival: Bhavnagar's Walls Come Alive",
      excerpt: "Local and national artists transformed the city's public spaces into an open-air gallery.",
      author: "Alok Sharma",
      date: "2026-11-12",
      readTime: "3 min read",
      image: "https://images.unsplash.com/photo-1499781350541-7783f6c6a0c8?w=800&q=80",
      tags: ["Street Style", "Art", "Festival"]
    },
    {
      id: 105,
      city: "bhavnagar",
      category: "Places",
      title: "Coastal Calm: A Sunrise at Gopinath Mahadev Beach",
      excerpt: "The best-kept secret of Bhavnagar's coastline offers peace, panoramas and stunning sunrises.",
      author: "Mira Desai",
      date: "2026-11-11",
      readTime: "4 min read",
      image: "https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800&q=80",
      tags: ["Places", "Beach", "Nature"]
    },
    {
      id: 106,
      city: "bhavnagar",
      category: "People",
      title: "Startup Hub Growth: Young Entrepreneurs Transforming Bhavnagar",
      excerpt: "A new generation of founders is building the future from one of Gujarat's most storied cities.",
      author: "Priti Shah",
      date: "2026-11-10",
      readTime: "5 min read",
      image: "https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=800&q=80",
      tags: ["People", "Business", "Youth"]
    },
    {
      id: 107,
      city: "bhavnagar",
      category: "Fashion",
      title: "Bhavnagar's Bandhani: The Tie-Dye Tradition Goes Global",
      excerpt: "Local artisans are bringing this ancient Gujarati textile art to international fashion weeks.",
      author: "Alok Sharma",
      date: "2026-11-09",
      readTime: "6 min read",
      image: "https://images.unsplash.com/photo-1610030469983-98e550d6193c?w=800&q=80",
      tags: ["Fashion", "Bandhani", "Craft"]
    },

    // === MUMBAI ARTICLES ===
    {
      id: 201,
      city: "mumbai",
      isFeatured: true,
      category: "Fashion",
      title: "Colaba Causeway: Mumbai's Most Iconic Fashion Street",
      excerpt: "Where bohemian meets glamour — Colaba's street fashion is a world unto itself.",
      author: "Zara Ahmed",
      date: "2026-11-15",
      readTime: "5 min read",
      image: "https://images.unsplash.com/photo-1529253355930-ddbe423a2ac7?w=1200&q=80",
      tags: ["Fashion", "Street Style", "Mumbai"]
    },
    {
      id: 202,
      city: "mumbai",
      category: "Food",
      title: "Vada Pav to Vegan Brunch: Mumbai's Evolving Food Scene",
      excerpt: "The city that invented the greatest street food sandwich is now reinventing itself for every palate.",
      author: "Tanvi Joshi",
      date: "2026-11-14",
      readTime: "6 min read",
      image: "https://images.unsplash.com/photo-1626804475297-41608ea09aeb?w=800&q=80",
      tags: ["Food", "Street Food", "Restaurants"]
    },
    {
      id: 203,
      city: "mumbai",
      category: "Culture",
      title: "The Art Deco Trail: Walking Through Mumbai's Architectural Soul",
      excerpt: "Marine Drive's iconic skyline is a UNESCO-listed heritage of Art Deco buildings.",
      author: "Dev Patel",
      date: "2026-11-13",
      readTime: "7 min read",
      image: "https://images.unsplash.com/photo-1587474260584-136574528ed5?w=800&q=80",
      tags: ["Culture", "Architecture", "Heritage"]
    },
    {
      id: 204,
      city: "mumbai",
      category: "Events",
      title: "Kala Ghoda Arts Festival: The Event That Defines Mumbai",
      excerpt: "Every February, Mumbai's historic precinct transforms into the country's largest arts festival.",
      author: "Zara Ahmed",
      date: "2026-11-12",
      readTime: "4 min read",
      image: "https://images.unsplash.com/photo-1541961017774-22349e4a1262?w=800&q=80",
      tags: ["Events", "Art", "Festival"]
    },
    {
      id: 205,
      city: "mumbai",
      category: "Street Style",
      title: "Bandra Diaries: Where Mumbai's Street Style Is Born",
      excerpt: "On any given Saturday, the streets of Bandra are more runway than road.",
      author: "Kabir Shah",
      date: "2026-11-11",
      readTime: "3 min read",
      image: "https://images.unsplash.com/photo-1539109136881-3be0616acf4b?w=800&q=80",
      tags: ["Street Style", "Bandra", "Fashion"]
    },
    {
      id: 206,
      city: "mumbai",
      category: "Lifestyle",
      title: "The Gateway of Glamour: Inside Mumbai's Art Deco Sea-Facing Salons",
      excerpt: "Behind the heritage facades of Marine Drive lies a thriving world of bespoke design ateliers.",
      author: "Zara Ahmed",
      date: "2026-11-10",
      readTime: "5 min read",
      image: "https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?w=800&q=80",
      tags: ["Lifestyle", "Mumbai", "Heritage"]
    },
    {
      id: 207,
      city: "mumbai",
      category: "Fashion",
      title: "Beyond Bollywood: The New Wave of Independent Mumbai Couturiers",
      excerpt: "Meet the intrepid designers reshaping South Asian high fashion from their Khar and Kala Ghoda studios.",
      author: "Kabir Shah",
      date: "2026-11-09",
      readTime: "6 min read",
      image: "https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&q=80",
      tags: ["Fashion", "Mumbai", "Couture"]
    },

    // === JAIPUR ARTICLES ===
    {
      id: 301,
      city: "jaipur",
      isFeatured: true,
      category: "Culture",
      title: "The Pink City in Full Bloom: Jaipur's Heritage Season 2026",
      excerpt: "As the weather cools, Jaipur opens its palaces, havelis and forts to the world.",
      author: "Riya Nair",
      date: "2026-11-15",
      readTime: "6 min read",
      image: "https://images.unsplash.com/photo-1477587458883-47145ed68ac5?w=1200&q=80",
      tags: ["Culture", "Heritage", "Festival"]
    },
    {
      id: 302,
      city: "jaipur",
      category: "Fashion",
      title: "Leheriya & Lac: Jaipur's Traditional Crafts in Modern Fashion",
      excerpt: "How Rajasthani textiles are finding a new audience in the wardrobes of the urban chic.",
      author: "Priya Mehta",
      date: "2026-11-14",
      readTime: "5 min read",
      image: "https://images.unsplash.com/photo-1610030469983-98e550d6193c?w=800&q=80",
      tags: ["Fashion", "Craft", "Rajasthan"]
    },
    {
      id: 303,
      city: "jaipur",
      category: "Food",
      title: "Dal Baati Churma and Beyond: Jaipur's Royal Cuisine",
      excerpt: "The kitchens of Rajputana royalty have opened their secrets to the city's finest restaurants.",
      author: "Tanvi Joshi",
      date: "2026-11-13",
      readTime: "5 min read",
      image: "https://images.unsplash.com/photo-1546833999-b9f581a1996d?w=800&q=80",
      tags: ["Food", "Rajasthani Cuisine", "Royal"]
    },
    {
      id: 304,
      city: "jaipur",
      category: "Events",
      title: "Jaipur Literature Festival: A Week of Words and Ideas",
      excerpt: "The world's largest free literary festival returns to Diggi Palace with over 400 speakers.",
      author: "Dev Patel",
      date: "2026-11-12",
      readTime: "4 min read",
      image: "https://images.unsplash.com/photo-1524492412937-b28074a5d7da?w=800&q=80",
      tags: ["Events", "Literature", "Festival"]
    },

    // === AHMEDABAD ARTICLES ===
    {
      id: 401,
      city: "ahmedabad",
      isFeatured: true,
      category: "Culture",
      title: "Pols & Parakeets: The Living Heritage of Ahmedabad's Old City",
      excerpt: "The traditional residential clusters of Ahmedabad are some of the most architecturally rich neighbourhoods in India.",
      author: "Dev Patel",
      date: "2026-11-15",
      readTime: "7 min read",
      image: "https://images.unsplash.com/photo-1598511757337-fe2cafc31ba0?w=1200&q=80",
      tags: ["Culture", "Architecture", "Heritage"]
    },
    {
      id: 402,
      city: "ahmedabad",
      category: "Food",
      title: "Ahmedabad's Khau Gali: A Street Food Lover's Paradise",
      excerpt: "Law Garden Night Market to Manek Chowk — the city's street food scene that never sleeps.",
      author: "Tanvi Joshi",
      date: "2026-11-14",
      readTime: "5 min read",
      image: "https://images.unsplash.com/photo-1626804475297-41608ea09aeb?w=800&q=80",
      tags: ["Food", "Street Food", "Nightlife"]
    },

    // === DELHI ARTICLES ===
    {
      id: 501,
      city: "delhi",
      isFeatured: true,
      category: "Fashion",
      title: "Dilli Haat to Delhi Couture: Fashion in India's Capital",
      excerpt: "Delhi's fashion scene spans centuries — from Mughal-era embroidery to contemporary couture ateliers.",
      author: "Ananya Kapoor",
      date: "2026-11-15",
      readTime: "6 min read",
      image: "https://images.unsplash.com/photo-1483985988355-763728e1935b?w=1200&q=80",
      tags: ["Fashion", "Delhi", "Couture"]
    },
    {
      id: 502,
      city: "delhi",
      category: "Food",
      title: "Butter Chicken & Beyond: Old Delhi's Culinary Landmarks",
      excerpt: "The original Moti Mahal, the legendary kebabs of Karim's — the food history of Old Delhi.",
      author: "Tanvi Joshi",
      date: "2026-11-14",
      readTime: "6 min read",
      image: "https://images.unsplash.com/photo-1546833999-b9f581a1996d?w=800&q=80",
      tags: ["Food", "Delhi", "Heritage"]
    },

    // === BENGALURU ARTICLES ===
    {
      id: 601,
      city: "bengaluru",
      isFeatured: true,
      category: "People",
      title: "Bengaluru's Startup Scene: The Next Silicon Valley Story",
      excerpt: "India's tech capital is breeding a new generation of founders changing industries from fintech to agritech.",
      author: "Kabir Shah",
      date: "2026-11-15",
      readTime: "7 min read",
      image: "https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=1200&q=80",
      tags: ["People", "Tech", "Startups"]
    },
    {
      id: 602,
      city: "bengaluru",
      category: "Food",
      title: "Filter Coffee to Craft Beer: Bengaluru's Beverages",
      excerpt: "The city that mastered the art of filter coffee is now home to India's most vibrant craft beer scene.",
      author: "Tanvi Joshi",
      date: "2026-11-14",
      readTime: "4 min read",
      image: "https://images.unsplash.com/photo-1556679343-c7306c1976bc?w=800&q=80",
      tags: ["Food", "Coffee", "Craft Beer"]
    },

    // === KOLKATA ARTICLES ===
    {
      id: 701,
      city: "kolkata",
      isFeatured: true,
      category: "Culture",
      title: "Durga Puja 2026: The World's Largest Art Festival Returns",
      excerpt: "Every neighbourhood becomes a gallery, every pandal an art installation — Kolkata's Puja is incomparable.",
      author: "Riya Nair",
      date: "2026-11-15",
      readTime: "8 min read",
      image: "https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=1200&q=80",
      tags: ["Culture", "Festival", "Art"]
    },
    {
      id: 702,
      city: "kolkata",
      category: "Food",
      title: "Rosogolla, Mishti Doi & More: Kolkata's Sweet Obsession",
      excerpt: "In Kolkata, the day begins and ends with sweets — and the city's sweetshops are institutions.",
      author: "Tanvi Joshi",
      date: "2026-11-14",
      readTime: "5 min read",
      image: "https://images.unsplash.com/photo-1626804475297-41608ea09aeb?w=800&q=80",
      tags: ["Food", "Sweets", "Bengal"]
    },

    // === SURAT ARTICLES ===
    {
      id: 801,
      city: "surat",
      isFeatured: true,
      category: "Fashion",
      title: "Surat's Diamond Legacy: Where Jewels Meet Fashion",
      excerpt: "The city that cuts 90% of the world's diamonds is now designing jewelry that makes global statements.",
      author: "Zara Ahmed",
      date: "2026-11-15",
      readTime: "6 min read",
      image: "https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?w=1200&q=80",
      tags: ["Fashion", "Diamonds", "Jewellery"]
    },

    // === RAJKOT ARTICLES ===
    {
      id: 901,
      city: "rajkot",
      isFeatured: true,
      category: "Culture",
      title: "Rajkot's Royal Roots: Palaces, Monuments and Living History",
      excerpt: "The former capital of the Saurashtra State is a trove of royal heritage waiting to be explored.",
      author: "Dev Patel",
      date: "2026-11-15",
      readTime: "6 min read",
      image: "https://images.unsplash.com/photo-1570168007204-dfb528c6958f?w=1200&q=80",
      tags: ["Culture", "Heritage", "Rajkot"]
    },

    // === VADODARA ARTICLES ===
    {
      id: 1001,
      city: "vadodara",
      isFeatured: true,
      category: "Culture",
      title: "Vadodara's Navratri: The Dance That Defines a City",
      excerpt: "Nowhere in India is Navratri celebrated with the energy, colour and devotion of Vadodara.",
      author: "Mira Desai",
      date: "2026-11-15",
      readTime: "5 min read",
      image: "https://images.unsplash.com/photo-1541089404510-5c9a779841fc?w=1200&q=80",
      tags: ["Culture", "Navratri", "Festival"]
    },

    // === WEDDINGS & CELEBRATIONS ARTICLES (Matches exact user screenshot) ===
    {
      id: 1101,
      city: "jaipur",
      isFeatured: true,
      category: "Weddings",
      title: "Should you wear your engagement ring to bed? What jewellery experts want you to know",
      excerpt: "From ring care rituals to bedtime preservation: top gemmologists and heritage jewelers weigh in.",
      author: "Shelby Wax",
      date: "2026-11-16",
      readTime: "4 min read",
      image: "https://images.unsplash.com/photo-1583939003579-730e3918a45a?w=800&q=80",
      tags: ["Weddings", "Jewellery", "Bridal"]
    },
    {
      id: 1102,
      city: "jaipur",
      isFeatured: true,
      hasGallery: true,
      category: "Weddings",
      title: "This couple turned the wine cellar of an 11th-century Spanish castle into a nightclub for their wedding after-party",
      excerpt: "Step inside an unforgettable cross-continental destination wedding where historic charm met midnight revelry.",
      author: "Vogue Staff",
      date: "2026-11-15",
      readTime: "5 min read",
      image: "https://images.unsplash.com/photo-1617627143750-d86bc21e42bb?w=800&q=80",
      tags: ["Weddings", "Destination Wedding", "Party"]
    },
    {
      id: 1103,
      city: "delhi",
      isFeatured: true,
      category: "Fashion",
      title: "I discovered that an embroidered jacket could be the most versatile piece in my wedding guest wardrobe",
      excerpt: "Why handcrafted zardozi and architectural tailoring are replacing conventional dupattas this wedding season.",
      author: "Thea Mulchandani",
      date: "2026-11-13",
      readTime: "4 min read",
      image: "https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&q=80",
      tags: ["Fashion", "Weddings", "Couture"]
    },
    {
      id: 1104,
      city: "delhi",
      isFeatured: true,
      category: "Weddings",
      title: "How to make your wedding makeup last through heat, humidity and pollution",
      excerpt: "Celebrity bridal makeup artists share their backstage secrets for flawless, long-lasting wedding looks.",
      author: "Vogue Staff",
      date: "2026-11-12",
      readTime: "4 min read",
      image: "https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?w=800&q=80",
      tags: ["Weddings", "Beauty", "Bridal Makeup"]
    }
  ],

  // ── EVENTS ───────────────────────────────────────────────
  events: [
    {
      id: "e1",
      city: "bhavnagar",
      title: "Bhavnagar Heritage Walk",
      date: "2026-11-22",
      time: "7:00 AM",
      location: "Barton Museum, Bhavnagar",
      image: "https://images.unsplash.com/photo-1570168007204-dfb528c6958f?w=400&q=80",
      category: "Culture"
    },
    {
      id: "e2",
      city: "bhavnagar",
      title: "Food Festival: Taste of Saurashtra",
      date: "2026-11-25",
      time: "5:00 PM",
      location: "Gaurishankar Lake Front, Bhavnagar",
      image: "https://images.unsplash.com/photo-1546833999-b9f581a1996d?w=400&q=80",
      category: "Food"
    },
    {
      id: "e3",
      city: "bhavnagar",
      title: "Bandhani Workshop & Exhibition",
      date: "2026-11-28",
      time: "10:00 AM",
      location: "Nilambagh Palace, Bhavnagar",
      image: "https://images.unsplash.com/photo-1610030469983-98e550d6193c?w=400&q=80",
      category: "Fashion"
    },
    {
      id: "e4",
      city: "mumbai",
      title: "Kala Ghoda Arts Festival",
      date: "2026-11-20",
      time: "11:00 AM",
      location: "Kala Ghoda, Fort, Mumbai",
      image: "https://images.unsplash.com/photo-1541961017774-22349e4a1262?w=400&q=80",
      category: "Events"
    },
    {
      id: "e5",
      city: "jaipur",
      title: "Jaipur Literature Festival",
      date: "2026-11-30",
      time: "9:00 AM",
      location: "Diggi Palace, Jaipur",
      image: "https://images.unsplash.com/photo-1524492412937-b28074a5d7da?w=400&q=80",
      category: "Culture"
    }
  ],

  // ── TRENDING TAGS ────────────────────────────────────────
  trendingTags: {
    bhavnagar: ["#Festival", "#Foodie", "#LocalArt", "#BhavnagarLife", "#Bandhani"],
    mumbai: ["#Mumbai", "#Bandra", "#StreetFood", "#MumbaiNights", "#KalaGhoda"],
    jaipur: ["#PinkCity", "#JLF", "#Rajasthan", "#Havelis", "#Heritage"],
    ahmedabad: ["#AhmedabadEats", "#WorldHeritage", "#Pols", "#NightMarket", "#Gujarat"],
    delhi: ["#DilliDiaries", "#OldDelhi", "#Couture", "#DelhiFashion", "#CapitalCity"],
    bengaluru: ["#Namma Bengaluru", "#StartupCity", "#CraftBeer", "#Techie", "#GardenCity"],
    kolkata: ["#DurgaPuja", "#CityOfJoy", "#Bengali", "#Mishti", "#Kolkata"],
    surat: ["#DiamondCity", "#Surat", "#TextileCity", "#Jewellery", "#Gujarat"],
    rajkot: ["#Rajkot", "#Saurashtra", "#Heritage", "#Gujarat", "#RoyalRoots"],
    vadodara: ["#Navratri", "#Baroda", "#FineArts", "#Vadodara", "#Gujarat"]
  }
};
