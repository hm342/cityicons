<x-layouts.app title="404 — This Page Could Not Be Found.">

  <section class="city-edition-section" style="padding:100px 0; text-align:center;">
    <div class="vogue-container">
      <span class="vogue-rubric vogue-rubric--red" style="margin-bottom:14px;">ERROR 404</span>
      <h1 style="font-family:var(--font-didot); font-size:clamp(2.5rem, 5vw, 4.2rem); font-weight:400; line-height:1.15; margin-bottom:16px;">
        This Page Could Not Be Found.
      </h1>
      <p style="font-family:var(--font-garamond); font-size:1.35rem; color:#555; max-width:600px; margin:0 auto 36px;">
        The story may have moved, or the address may be incorrect.
      </p>

      <div style="display:flex; justify-content:center; gap:16px; flex-wrap:wrap;">
        <a href="{{ url('/') }}" style="display:inline-block; background:var(--vogue-black); color:#fff; font-size:0.75rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; padding:14px 28px;">
          Return Home
        </a>
        <a href="{{ url('/stories') }}" style="display:inline-block; border:1px solid var(--vogue-black); color:var(--vogue-black); font-size:0.75rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; padding:14px 28px;">
          Explore Stories
        </a>
      </div>
    </div>
  </section>

</x-layouts.app>
