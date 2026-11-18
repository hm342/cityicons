<x-layouts.app title="The List — A monthly archive of selected stories">

  <section class="city-edition-section" style="padding-top:40px; margin-bottom:var(--section-gap);">
    <div class="vogue-container">
      
      <!-- Section Header -->
      <div style="border-bottom:2px solid var(--vogue-black); padding-bottom:16px; margin-bottom:30px;">
        <span class="vogue-rubric vogue-rubric--red">MONTHLY EDITORIAL ARCHIVE</span>
        <h1 style="font-family:var(--font-didot); font-size:clamp(2.4rem, 4.5vw, 4rem); font-weight:400; line-height:1.1; margin:8px 0 12px;">
          The List
        </h1>
        <p style="font-family:var(--font-didot); font-size:clamp(1.25rem, 2vw, 1.6rem); color:var(--vogue-black); line-height:1.3; margin-bottom:8px;">
          A month in people and stories.
        </p>
        <p style="font-family:var(--font-garamond); font-size:1.15rem; color:#444; max-width:850px; line-height:1.6; margin-bottom:12px;">
          The List brings together profiles published by Bhavnagar Icons during each month. Names are presented alphabetically. Inclusion is based on editorial selection and does not represent a ranking, competition, award or comparative judgment.
        </p>
      </div>

      <!-- Archive Selectors (Page 11) -->
      <div style="background:var(--vogue-bg-light); border:1px solid var(--vogue-border); padding:20px 24px; margin-bottom:36px; display:flex; align-items:center; gap:20px; flex-wrap:wrap;">
        <span style="font-size:0.75rem; font-weight:800; letter-spacing:1.5px; text-transform:uppercase;">Archive Filter:</span>
        
        <select style="padding:8px 14px; border:1px solid var(--vogue-border); font-family:inherit; font-size:0.85rem; background:#fff;">
          <option>Year 2026</option>
          <option>Year 2025</option>
        </select>

        <select style="padding:8px 14px; border:1px solid var(--vogue-border); font-family:inherit; font-size:0.85rem; background:#fff;">
          <option>November 2026</option>
          <option>October 2026</option>
          <option>September 2026</option>
        </select>

        <button style="background:var(--vogue-black); color:#fff; font-size:0.75rem; font-weight:700; letter-spacing:1.5px; text-transform:uppercase; padding:9px 18px; border:none; cursor:pointer;">
          View Archive
        </button>
      </div>

      <!-- Alphabetical Archive List -->
      <div style="margin-bottom:48px;">
        <div style="font-size:0.75rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; color:var(--vogue-muted); margin-bottom:16px;">
          November 2026 Edition · Alphabetical Record
        </div>

        <div style="border-top:1px solid var(--vogue-black);">
          @foreach(['Anandiben Patel · Heritage Conservation', 'Gohil Dynasty Architects · Royal Restoration', 'Jayeshbhai Shah · Shipbreaking Innovation', 'Ketan Mehta · Saurashtra Cinema', 'Meena Thakkar · Bandhani Craft Revival', 'Pravinbhai Trivedi · Education & Public Service'] as $entry)
            <div style="display:flex; justify-content:space-between; align-items:center; padding:18px 0; border-bottom:1px solid var(--vogue-border);">
              <span style="font-family:var(--font-didot); font-size:1.25rem;">{{ $entry }}</span>
              <a href="{{ url('/stories') }}" style="font-size:0.75rem; font-weight:700; letter-spacing:1.5px; text-transform:uppercase; color:var(--vogue-red);">
                Read Profile →
              </a>
            </div>
          @endforeach
        </div>
      </div>

      <!-- Disclaimer (Page 11) -->
      <div style="border-left:3px solid var(--vogue-red); padding-left:20px; font-size:0.85rem; color:#666; line-height:1.6;">
        <strong style="color:var(--vogue-black); text-transform:uppercase; letter-spacing:1px; display:block; margin-bottom:4px;">Editorial Disclaimer</strong>
        The List documents published editorial work. It does not create or confer any award, title or official recognition.
      </div>

    </div>
  </section>

</x-layouts.app>
