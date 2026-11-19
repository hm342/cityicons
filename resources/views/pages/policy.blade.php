@props(['slug' => 'editorial', 'city' => null])

@php
  $cName = isset($city) ? (is_object($city) ? $city->name : ucfirst($city)) : 'Bhavnagar';
  $cSlug = isset($city) ? (is_object($city) ? $city->slug : strtolower($city)) : 'bhavnagar';
  $isFlagship = ($cSlug === 'bhavnagar');
  $policies = [
    'editorial' => [
      'title' => 'Editorial Policy',
      'num' => '13',
      'content' => '
        <p>Bhavnagar Icons independently selects stories based on editorial relevance, credible work, verifiable achievement, public value and connection to Bhavnagar.</p>
        <p><strong>Editorial selection cannot be purchased.</strong></p>
        <h3>Our editorial team retains final authority over:</h3>
        <ul>
          <li>Story selection</li>
          <li>Category placement</li>
          <li>Editorial angle</li>
          <li>Headlines</li>
          <li>Presentation</li>
          <li>Publication schedule</li>
          <li>Corrections and updates</li>
        </ul>
        <p>Subjects may review factual details, name spellings, designations, photographs and sensitive personal information before publication.</p>
        <p>Subjects do not control the final editorial framing.</p>
        <p>Paid collaborations are published separately under Featured Brands and are clearly labelled as Paid Partnership, Sponsored, Advertisement or Event Partner.</p>
      '
    ],
    'selection' => [
      'title' => 'Selection Policy',
      'num' => '14',
      'content' => '
        <p>Selection may consider:</p>
        <ul>
          <li>A credible connection to Bhavnagar</li>
          <li>An established body of work or credible future potential</li>
          <li>Verifiable achievements</li>
          <li>Contribution to a field, community or wider public</li>
          <li>Strength and relevance of the journey</li>
          <li>Availability of reliable supporting information</li>
          <li>Long-term documentation value</li>
        </ul>
        <p>Follower count, publicity or personal influence alone does not determine selection.</p>
        <p>Nominations do not guarantee publication.</p>
        <p>Bhavnagar Icons does not publish active political officeholders or party-affiliated political profiles within Icons or Rising.</p>
        <p>Government officers, public servants and civic professionals may be considered based on verified work and editorial relevance.</p>
      '
    ],
    'fact-checking' => [
      'title' => 'Fact-Checking Policy',
      'num' => '15',
      'content' => '
        <p>Accuracy is central to our editorial work.</p>
        <h3>Before publication, we seek to verify significant factual claims including:</h3>
        <ul>
          <li>Names and preferred public names</li>
          <li>Current designations</li>
          <li>Dates and timelines</li>
          <li>Numerical claims</li>
          <li>Institutions and qualifications</li>
          <li>Awards and professional recognition</li>
          <li>Project, film, organisation and place names</li>
          <li>Direct quotations</li>
          <li>Government and public-service appointments</li>
        </ul>
        <p>Verification may involve official records, credible published sources, institutional information and confirmation from the subject.</p>
        <p>Where a claim cannot be responsibly verified, it may be removed, qualified or held from publication.</p>
      '
    ],
    'political' => [
      'title' => 'Political Policy',
      'num' => '16',
      'content' => '
        <p>Bhavnagar Icons maintains a non-partisan editorial position.</p>
        <p>Active political officeholders, party representatives and individuals currently campaigning for political office are not eligible for Icons or Rising selection.</p>
        <p>They may appear only where necessary within factual civic or public-interest reporting. Such coverage does not represent endorsement, recognition or editorial status.</p>
        <p>Past political involvement may be reviewed on a case-by-case basis when the proposed story concerns a separate and independently established body of work.</p>
        <p>Editorial coverage of civic matters does not represent support for any political party, candidate or ideology.</p>
        <p><strong>Political advertising is not accepted.</strong></p>
      '
    ],
    'corrections' => [
      'title' => 'Corrections Policy',
      'num' => '17',
      'content' => '
        <p>We are committed to correcting verified factual errors transparently and promptly.</p>
        <p>Readers and subjects may report a possible error by contacting: <strong>editorial@cityicons.in</strong></p>
        <h3>Please include:</h3>
        <ul>
          <li>The story title or page link</li>
          <li>The information believed to be incorrect</li>
          <li>The proposed correction</li>
          <li>Supporting evidence or reliable sources</li>
        </ul>
        <p>Verified material errors will be corrected. Where appropriate, a correction or update note may be added to the published story.</p>
        <p>Requests based solely on preference, retrospective withdrawal of cooperation or disagreement with editorial judgment may not qualify as factual corrections. Privacy, safety and legal concerns will be reviewed separately.</p>
      '
    ],
    'paid-content' => [
      'title' => 'Paid Content Disclosure',
      'num' => '18',
      'content' => '
        <p>Featured Brands is a commercial content category.</p>
        <p>Commercial content is clearly identified using one or more of the following labels:</p>
        <ul>
          <li><strong>Featured Brand</strong></li>
          <li><strong>Paid Partnership</strong></li>
          <li><strong>Sponsored</strong></li>
          <li><strong>Advertisement</strong></li>
          <li><strong>Event Partner</strong></li>
        </ul>
        <p>Payment provides agreed commercial visibility. It does not provide editorial selection, Icon status, Rising status or inclusion in The List.</p>
        <p>Advertising clients and commercial partners do not receive control over independent editorial coverage.</p>
        <p>Commercial partners may review paid content for factual and brand accuracy before publication. Final publication remains subject to our content standards.</p>
      '
    ],
    'editorial-integrity' => [
      'title' => 'Editorial Integrity',
      'num' => '19',
      'content' => '
        <p>Bhavnagar Icons does not fabricate facts, achievements, quotations, credentials or documentary events.</p>
        <p>Artificial intelligence and digital tools may assist with internal research, transcription, editing or production, but they do not replace editorial verification.</p>
        <p>Synthetic images will not be presented as authentic documentary photographs of people or events.</p>
        <p>Material visual alterations that could mislead readers about a person, place or event will not be used in independent editorial coverage.</p>
      '
    ],
    'privacy' => [
      'title' => 'Privacy Policy',
      'num' => '20',
      'content' => '
        <h3>Information We Collect</h3>
        <p>We may collect information submitted through nomination forms, contact forms, advertising enquiries, newsletter subscriptions, correction requests, and website analytics.</p>
        <h3>How We Use Information</h3>
        <p>Information may be used to review nominations, conduct editorial verification, respond to enquiries, maintain records, and send updates where consent has been granted.</p>
        <h3>Sharing of Information</h3>
        <p><strong>We do not sell personal information.</strong> Information is shared only with technical service providers as strictly necessary for operations.</p>
        <h3>Grievance & Rights</h3>
        <p>You may request access, correction or deletion of eligible personal information by contacting: <strong>editorial@cityicons.in</strong></p>
        <p><small>Last updated: 18 November 2026</small></p>
      '
    ],
    'cookies' => [
      'title' => 'Cookie Policy',
      'num' => '21',
      'content' => '
        <p>CityIcons may use cookies and similar technologies to operate essential website functions, remember visitor preferences, understand website usage, and measure performance.</p>
        <p>Where required, visitors may accept, reject or manage non-essential cookies through website cookie settings.</p>
        <p>Third-party analytics or embedded services may place their own cookies according to their respective policies.</p>
      '
    ],
    'terms' => [
      'title' => 'Terms Of Use',
      'num' => '22',
      'content' => '
        <p>By accessing or using this website, you agree to these Terms of Use. In these Terms, "CityIcons", "Bhavnagar Icons", "we", "us" and "our" refer to the operator of cityicons.in.</p>
        <h3>No Award or Official Status</h3>
        <p>Publication by Bhavnagar Icons does not confer an award, legal title, certification, membership or official status. Icons and Rising are editorial categories.</p>
        <h3>Governing Jurisdiction</h3>
        <p>These terms are governed by the applicable laws of India. Any dispute will be subject to the jurisdiction of the competent courts in Bhavnagar, Gujarat.</p>
        <p><small>Last updated: 18 November 2026</small></p>
      '
    ],
    'content-and-image-rights' => [
      'title' => 'Content And Image Rights',
      'num' => '23',
      'content' => '
        <p>Photographs, videos, documents and creative materials are published where CityIcons has obtained ownership, permission, licence or another lawful right to use the material for editorial purposes.</p>
        <p>Image credits are provided where required and available.</p>
        <p>If you believe that material published on this website infringes your copyright or other rights, contact: <strong>editorial@cityicons.in</strong></p>
      '
    ],
    'accessibility' => [
      'title' => 'Accessibility Statement',
      'num' => '24',
      'content' => '
        <p>We aim to make the CityIcons website clear, readable and usable across common devices and assistive technologies.</p>
        <p>We work towards maintaining readable text contrast, descriptive image alt text, keyboard-friendly navigation, clear heading structures, and mobile responsiveness.</p>
        <p>Visitors experiencing an accessibility issue may contact: <strong>editorial@cityicons.in</strong></p>
      '
    ]
  ];

  $current = $policies[$slug] ?? $policies['editorial'];
  $renderedContent = $current['content'];
  if ($cName !== 'Bhavnagar') {
      $renderedContent = str_replace('Bhavnagar Icons', $cName . ' Icons', $renderedContent);
      $renderedContent = str_replace('to Bhavnagar', 'to ' . $cName, $renderedContent);
      $renderedContent = str_replace('connected to Bhavnagar', 'connected to ' . $cName, $renderedContent);
  }
@endphp

<x-layouts.app :title="$current['title'] . ' — ' . $cName . ' Icons Policies'" :city="$city ?? null">

  <section class="city-edition-section" style="padding-top:40px; margin-bottom:var(--section-gap);">
    <div class="vogue-container">
      
      <!-- Section Header -->
      <div style="border-bottom:2px solid var(--vogue-black); padding-bottom:16px; margin-bottom:36px;">
        <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px; margin-bottom:8px;">
          <span class="vogue-rubric vogue-rubric--red">
            {{ strtoupper($cName) }} ICONS · POLICIES &amp; STANDARDS · SECTION {{ $current['num'] }}
          </span>
          <a href="{{ url('/' . $cSlug) }}" style="font-size:0.75rem; font-weight:800; letter-spacing:1px; text-transform:uppercase; color:var(--vogue-black); text-decoration:underline;">
            &larr; Back to {{ $cName }} Subsite
          </a>
        </div>
        <h1 style="font-family:var(--font-didot); font-size:clamp(2.4rem, 4.5vw, 3.8rem); font-weight:400; line-height:1.1; margin:8px 0 12px;">
          {{ $current['title'] }}
        </h1>
        <p style="font-family:var(--font-garamond); font-size:1.15rem; font-style:italic; color:var(--vogue-muted);">
          Selected with purpose. Documented with responsibility.
        </p>
      </div>

      <div style="display:grid; grid-template-columns:1.8fr 1fr; gap:48px; align-items:start;">
        
        <!-- Policy Content Body -->
        <div style="background:#ffffff; border:1px solid var(--vogue-border); padding:clamp(28px, 4vw, 48px); font-family:var(--font-garamond); font-size:1.25rem; line-height:1.75; color:#222;">
          <style>
            .policy-content h3 { font-family:var(--font-didot); font-size:1.4rem; font-weight:400; margin:28px 0 12px; color:var(--vogue-black); }
            .policy-content p { margin-bottom:18px; }
            .policy-content ul { margin:0 0 20px 24px; line-height:2; font-size:1.1rem; }
            .policy-content strong { color:var(--vogue-black); font-family:var(--font-sans); font-size:0.95rem; }
          </style>
          <div class="policy-content">
            {!! $renderedContent !!}
          </div>
        </div>

        <!-- Policy Navigation Sidebar -->
        <div style="background:var(--vogue-bg-light); border:1px solid var(--vogue-border); padding:28px;">
          <h3 style="font-size:0.75rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; color:var(--vogue-black); margin-bottom:16px; border-bottom:1px solid var(--vogue-border); padding-bottom:8px;">
            Policies Directory
          </h3>

          <ul style="list-style:none; font-size:0.8rem; line-height:2.2; font-weight:600; text-transform:uppercase; letter-spacing:1px;">
            @foreach($policies as $key => $p)
              <li>
                <a href="{{ $cSlug ? url('/' . $cSlug . '/policies/' . $key) : url('/policies/' . $key) }}" style="{{ $slug === $key ? 'color:var(--vogue-red); font-weight:800;' : 'color:#555;' }}">
                  {{ $p['title'] }}
                </a>
              </li>
            @endforeach
          </ul>

          <div style="margin-top:24px; border-top:1px solid var(--vogue-border); padding-top:16px; font-size:0.8rem; color:#666;">
            <strong>Editorial Desk:</strong><br>
            <a href="mailto:editorial@cityicons.in" style="color:var(--vogue-black); text-decoration:underline;">editorial@cityicons.in</a>
          </div>
        </div>

      </div>

    </div>
  </section>

</x-layouts.app>
