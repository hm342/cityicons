<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Article — CITYICON Magazine</title>
  <link rel="stylesheet" href="{{ asset('css/shared.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🏙</text></svg>">
  <style>
    body { background: var(--city-bg, #f8f8f8); color: var(--city-text, #121212); font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; }

    /* Article header */
    .article-header {
      background: #ffffff;
      border-bottom: 1px solid #e2e2e2;
      padding: 0.85rem 0;
      position: sticky; top: 0; z-index: 100;
    }
    .article-header__inner {
      display: flex; align-items: center;
      justify-content: space-between;
      max-width: 1280px; margin: 0 auto; padding: 0 24px;
    }
    .article-header__logo {
      font-family: 'Bodoni Moda', Georgia, serif;
      font-size: 1.4rem; font-weight: 900;
      letter-spacing: 4px; color: #000000;
      text-decoration: none;
    }
    .article-header__back {
      font-size: 0.72rem; letter-spacing: 1px;
      text-transform: uppercase; color: #757575;
      display: flex; align-items: center; gap: 0.4rem;
      text-decoration: none;
      transition: color 0.2s ease;
    }
    .article-header__back:hover { color: #e51a24; }

    /* Article hero */
    .article-hero {
      position: relative;
      height: 65vh; min-height: 400px; max-height: 600px;
      overflow: hidden; background: #000000;
    }
    .article-hero img {
      width: 100%; height: 100%; object-fit: cover;
      opacity: 0.85;
    }
    .article-hero__overlay {
      position: absolute; inset: 0;
      background: linear-gradient(to bottom, transparent 30%, rgba(0,0,0,0.75) 100%);
    }
    .article-hero__content {
      position: absolute; bottom: 0; left: 0; right: 0;
      padding: 2.5rem 0;
    }
    .article-hero__content .container {
      max-width: 1280px; margin: 0 auto; padding: 0 24px;
    }
    .article-hero__cat {
      display: inline-block;
      background: #e51a24; color: #ffffff;
      font-size: 0.65rem; font-weight: 700;
      letter-spacing: 2px; text-transform: uppercase;
      padding: 0.35rem 0.9rem; border-radius: 2px;
      margin-bottom: 1rem;
    }
    .article-hero__title {
      font-family: 'Bodoni Moda', Georgia, serif;
      font-size: clamp(1.8rem, 4vw, 3rem);
      font-weight: 700; color: #ffffff;
      line-height: 1.2; max-width: 900px;
      margin-bottom: 1rem;
    }
    .article-hero__meta {
      font-size: 0.8rem; color: rgba(255,255,255,0.75);
      display: flex; align-items: center; gap: 1rem; flex-wrap: wrap;
    }
    .article-hero__meta .sep::before { content: '·'; }

    /* Article body */
    .article-body-wrap {
      max-width: 780px; margin: 0 auto;
      padding: 3.5rem 1.5rem;
    }
    .article-excerpt {
      font-family: 'Cormorant Garamond', Georgia, serif;
      font-size: 1.35rem; line-height: 1.65;
      color: #333333; margin-bottom: 2rem;
      border-left: 3px solid #e51a24;
      padding-left: 1.5rem;
      font-style: italic;
    }
    .article-content {
      font-size: 1.05rem; line-height: 1.85;
      color: #222222;
    }
    .article-content p { margin-bottom: 1.5rem; }
    .article-content h2 {
      font-family: 'Bodoni Moda', Georgia, serif;
      font-size: 1.6rem; font-weight: 700;
      color: #000000; margin: 2.5rem 0 1rem;
      padding-bottom: 0.5rem;
      border-bottom: 1px solid #e2e2e2;
    }
    .article-content blockquote {
      border-left: 3px solid #e51a24;
      padding: 1rem 1.5rem; margin: 2rem 0;
      background: #f8f8f8; border-radius: 0 4px 4px 0;
      font-family: 'Cormorant Garamond', Georgia, serif; font-size: 1.2rem;
      color: #121212; line-height: 1.6; font-style: italic;
    }

    /* Author box */
    .author-box {
      display: flex; gap: 1.25rem; align-items: flex-start;
      background: #ffffff; padding: 1.5rem;
      border-radius: 4px; border: 1px solid #e2e2e2;
      margin: 2.5rem 0;
    }
    .author-avatar {
      width: 60px; height: 60px; border-radius: 50%;
      object-fit: cover; flex-shrink: 0;
      background: #f0f0f0;
      display: flex; align-items: center; justify-content: center;
      font-family: 'Bodoni Moda', serif; font-size: 1.3rem; font-weight: 700;
      color: #e51a24;
    }
    .author-name { font-weight: 700; font-size: 0.95rem; margin-bottom: 0.25rem; }
    .author-bio  { font-size: 0.82rem; color: #757575; line-height: 1.6; }

    /* Tags */
    .article-tags { display: flex; flex-wrap: wrap; gap: 0.5rem; margin: 2rem 0; }
    .article-tag {
      padding: 0.35rem 0.9rem; border: 1px solid #e2e2e2;
      font-size: 0.72rem; color: #757575;
      border-radius: 50px; cursor: pointer;
      transition: all 0.2s ease;
    }
    .article-tag:hover { background: #000000; color: #ffffff; border-color: #000000; }

    /* Share */
    .share-bar {
      display: flex; align-items: center; gap: 0.75rem;
      padding: 1.5rem 0; border-top: 1px solid #e2e2e2;
      border-bottom: 1px solid #e2e2e2; margin: 1rem 0;
    }
    .share-label { font-size: 0.72rem; letter-spacing: 1.5px; text-transform: uppercase; color: #757575; }
    .share-btn {
      display: flex; align-items: center; gap: 0.4rem;
      padding: 0.4rem 1rem; border: 1px solid #e2e2e2;
      border-radius: 50px; font-size: 0.75rem; color: #757575;
      transition: all 0.2s ease; cursor: pointer; background: none; font-family: inherit;
    }
    .share-btn:hover { background: #000000; color: #ffffff; border-color: #000000; }

    /* Related articles */
    .related-section { padding: 3rem 0; max-width: 1280px; margin: 0 auto; padding-left: 24px; padding-right: 24px; }
    .related-section h2 {
      font-family: 'Bodoni Moda', Georgia, serif; font-size: 1.4rem;
      font-weight: 700; margin-bottom: 1.5rem;
      padding-bottom: 0.75rem; border-bottom: 2px solid #000000;
    }
    .related-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; }
    .related-card {
      background: #ffffff; border-radius: 4px; overflow: hidden;
      border: 1px solid #e2e2e2; cursor: pointer;
      transition: all 0.25s ease;
    }
    .related-card:hover { transform: translateY(-3px); box-shadow: 0 8px 20px rgba(0,0,0,0.06); }
    .related-card img { width: 100%; height: 180px; object-fit: cover; }
    .related-card__body { padding: 1rem; }
    .related-card .cat-tag { color: #e51a24; font-size: 0.65rem; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; }
    .related-card__title {
      font-family: 'Bodoni Moda', Georgia, serif; font-size: 1.05rem;
      font-weight: 600; line-height: 1.35; color: #000000;
      margin-top: 0.35rem;
    }

    @media (max-width: 768px) {
      .article-hero { height: 50vh; }
      .related-grid { grid-template-columns: 1fr; }
      .article-body-wrap { padding: 2rem 1rem; }
    }
  </style>
</head>
<body>

  <!-- Header -->
  <header class="article-header">
    <div class="article-header__inner">
      <a href="{{ url('/') }}" class="article-header__logo">CITYICONS</a>
      <a href="javascript:history.back()" class="article-header__back">← Back</a>
    </div>
  </header>

  <!-- Article Hero -->
  <div class="article-hero">
    <img id="article-hero-img" src="" alt="" loading="eager">
    <div class="article-hero__overlay"></div>
    <div class="article-hero__content">
      <div class="container">
        <span class="article-hero__cat" id="article-cat"></span>
        <h1 class="article-hero__title" id="article-title"></h1>
        <div class="article-hero__meta">
          <span id="article-author"></span>
          <span class="sep"></span>
          <span id="article-date"></span>
          <span class="sep"></span>
          <span id="article-readtime"></span>
          <span class="sep"></span>
          <span id="article-city-link"></span>
        </div>
      </div>
    </div>
  </div>

  <!-- Article Body -->
  <main>
    <div class="article-body-wrap">
      <div class="article-excerpt" id="article-excerpt"></div>
      <div class="article-tags" id="article-tags"></div>

      <!-- Share bar -->
      <div class="share-bar">
        <span class="share-label">Share</span>
        <button class="share-btn" onclick="shareArticle('facebook')"><i class="fab fa-facebook-f"></i> Facebook</button>
        <button class="share-btn" onclick="shareArticle('twitter')"><i class="fab fa-x-twitter"></i> Twitter</button>
        <button class="share-btn" onclick="shareArticle('whatsapp')"><i class="fab fa-whatsapp"></i> WhatsApp</button>
        <button class="share-btn" onclick="copyLink()"><i class="fas fa-link"></i> Copy Link</button>
      </div>

      <!-- Content -->
      <div class="article-content" id="article-content"></div>

      <!-- Author box -->
      <div class="author-box" id="author-box">
        <div class="author-avatar" id="author-avatar"></div>
        <div>
          <div class="author-name" id="author-name"></div>
          <div class="author-bio">Contributing writer at CITYICON Magazine, covering fashion, culture and lifestyle across India's most vibrant cities.</div>
        </div>
      </div>

      <div class="article-tags" id="article-tags-bottom"></div>
    </div>

    <!-- Related Articles -->
    <div class="related-section">
      <h2>You Might Also Like</h2>
      <div class="related-grid" id="related-grid"></div>
    </div>
  </main>

  <x-footer />

  <script src="{{ asset('js/data.js') }}"></script>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const D = CITYICON_DATA;
      const params = new URLSearchParams(window.location.search);
      let id = parseInt(params.get('id'));
      @if(isset($articleId) && $articleId)
        id = {{ $articleId }};
      @endif

      if (!id) id = 1;

      const article = D.articles.find(a => a.id === id) || D.articles[0];

      if (!article) {
        document.querySelector('.article-hero').style.display = 'none';
        document.querySelector('main').innerHTML = `
          <div style="text-align:center;padding:5rem 1rem;">
            <h2 style="font-family:'Bodoni Moda',serif;margin-bottom:1rem;">Article not found</h2>
            <a href="{{ url('/') }}" style="color:#e51a24;">← Back to Home</a>
          </div>`;
        return;
      }

      const city = article.city ? D.cities.find(c => c.id === article.city) : null;
      document.title = article.title + ' — CITYICON Magazine';

      document.getElementById('article-hero-img').src = article.image;
      document.getElementById('article-hero-img').alt = article.title;
      document.getElementById('article-cat').textContent   = article.category;
      document.getElementById('article-title').textContent = article.title;
      document.getElementById('article-author').textContent   = 'By ' + article.author;
      document.getElementById('article-readtime').textContent = article.readTime || '7 min read';
      document.getElementById('article-date').textContent = new Date(article.date).toLocaleDateString('en-GB', { day:'numeric', month:'long', year:'numeric' });

      if (city) {
        document.getElementById('article-city-link').innerHTML = `<a href="{{ url('/cities') }}/${city.id}" style="color:rgba(255,255,255,0.85);text-decoration:underline;">${city.name}</a>`;
      }

      document.getElementById('article-excerpt').textContent = article.excerpt;

      const tagsHTML = (article.tags || ['Fashion', 'Culture', 'Living']).map(t => `<span class="article-tag">${t}</span>`).join('');
      document.getElementById('article-tags').innerHTML = tagsHTML;
      document.getElementById('article-tags-bottom').innerHTML = tagsHTML;

      document.getElementById('article-content').innerHTML = `
        <p>${article.excerpt} This story goes deeper into what makes this corner of India truly special — blending heritage, modernity, and the irreplaceable spirit of its people.</p>
        <h2>The Story Behind It</h2>
        <p>Every great story has its roots in something deeply human. For this piece, our writer spent days immersed in the culture, talking to locals, visiting the spaces that matter, and experiencing what it truly means to live and breathe the life that inspires this feature.</p>
        <blockquote>"The soul of a city is in its contradictions — in the way old and new coexist, in how tradition and modernity negotiate space on the same street." — ${article.author}</blockquote>
        <p>What emerged was not just a story about ${article.category.toLowerCase()}, but a portrait of a living, breathing moment in time — one that captures why CityIcon exists: to tell the stories that mainstream media overlooks, to celebrate the creativity and culture that define India's cities beyond the obvious.</p>
        <h2>What This Means for You</h2>
        <p>Whether you're a local who knows every lane, or a curious visitor looking for the authentic experience, this story is a reminder that the best of India is often hidden in plain sight — in its conversations, its crafts, its cuisine, and in the quiet confidence of people who know exactly who they are.</p>
        <p>Stay tuned to CityIcon for more stories like this, as we continue to map the living culture of India's most fascinating cities — one story at a time.</p>`;

      document.getElementById('author-name').textContent = article.author;
      document.getElementById('author-avatar').textContent = article.author.charAt(0);

      const related = D.articles.filter(a =>
        a.id !== article.id &&
        (a.category === article.category || a.city === article.city)
      ).slice(0, 3);
      document.getElementById('related-grid').innerHTML = related.map(a => `
        <div class="related-card" onclick="location.href='{{ url('/article') }}?id=${a.id}'">
          <img src="${a.image}" alt="${a.title}" loading="lazy">
          <div class="related-card__body">
            <span class="cat-tag">${a.category}</span>
            <div class="related-card__title">${a.title}</div>
          </div>
        </div>`).join('');
    });

    function shareArticle(platform) {
      const url = encodeURIComponent(window.location.href);
      const title = encodeURIComponent(document.title);
      const urls = {
        facebook: `https://www.facebook.com/sharer/sharer.php?u=${url}`,
        twitter:  `https://twitter.com/intent/tweet?url=${url}&text=${title}`,
        whatsapp: `https://wa.me/?text=${title}%20${url}`
      };
      window.open(urls[platform], '_blank', 'width=600,height=400');
    }

    function copyLink() {
      navigator.clipboard.writeText(window.location.href).then(() => {
        alert('Article link copied to clipboard!');
      });
    }
  </script>
</body>
</html>
