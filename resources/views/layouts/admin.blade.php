<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ $title ?? 'Dashboard' }} — CityIcons Editorial Administration</title>
  
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Bodoni+Moda:ital,opsz,wght@0,6..96,400;0,6..96,700;1,6..96,400&display=swap" rel="stylesheet">
  
  <!-- FontAwesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  
  <!-- Quill WYSIWYG Editor -->
  <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />

  <style>
    :root {
      --primary: #B51622;
      --primary-dark: #8c0f18;
      --primary-light: #fdf2f2;
      --sidebar-bg: #111113;
      --sidebar-text: #9e9ea7;
      --sidebar-hover: #1c1c20;
      --bg-body: #f7f7f9;
      --card-bg: #ffffff;
      --border-color: #e5e5ea;
      --text-dark: #1a1a1e;
      --text-muted: #6e6e78;
      --font-sans: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
      --font-serif: 'Bodoni Moda', serif;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: var(--font-sans);
      background-color: var(--bg-body);
      color: var(--text-dark);
      font-size: 14px;
      line-height: 1.5;
      display: flex;
      min-height: 100vh;
    }

    /* Sidebar */
    .admin-sidebar {
      width: 260px;
      background: var(--sidebar-bg);
      color: var(--sidebar-text);
      display: flex;
      flex-direction: column;
      position: fixed;
      top: 0; bottom: 0; left: 0;
      z-index: 100;
      overflow-y: auto;
    }
    .admin-brand {
      padding: 24px 20px;
      border-bottom: 1px solid #222228;
      display: flex;
      align-items: center;
      gap: 12px;
      text-decoration: none;
    }
    .admin-brand__badge {
      background: var(--primary);
      color: #fff;
      font-family: var(--font-serif);
      font-weight: 700;
      font-size: 18px;
      width: 38px; height: 38px;
      display: flex; align-items: center; justify-content: center;
      border-radius: 6px;
      letter-spacing: -1px;
    }
    .admin-brand__text {
      display: flex;
      flex-direction: column;
    }
    .admin-brand__title {
      font-family: var(--font-serif);
      font-size: 16px;
      letter-spacing: 2px;
      color: #fff;
      font-weight: 700;
      line-height: 1.1;
    }
    .admin-brand__sub {
      font-size: 10px;
      letter-spacing: 1.5px;
      text-transform: uppercase;
      color: var(--primary);
      font-weight: 700;
    }

    .admin-nav {
      padding: 16px 12px;
      flex: 1;
      display: flex;
      flex-direction: column;
      gap: 4px;
    }
    .nav-label {
      font-size: 10px;
      font-weight: 700;
      letter-spacing: 1.2px;
      text-transform: uppercase;
      color: #555562;
      padding: 16px 12px 6px;
    }
    .nav-item {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 10px 14px;
      border-radius: 8px;
      color: var(--sidebar-text);
      text-decoration: none;
      font-size: 13px;
      font-weight: 500;
      transition: all 0.15s ease;
    }
    .nav-item:hover {
      background: var(--sidebar-hover);
      color: #fff;
    }
    .nav-item.active {
      background: var(--primary);
      color: #fff;
      font-weight: 600;
    }
    .nav-item i {
      width: 18px;
      text-align: center;
      font-size: 14px;
    }
    .nav-badge {
      margin-left: auto;
      background: #2b2b32;
      color: #fff;
      font-size: 11px;
      font-weight: 700;
      padding: 2px 8px;
      border-radius: 12px;
    }
    .nav-badge.danger {
      background: var(--primary);
    }

    /* Main Content */
    .admin-main {
      margin-left: 260px;
      flex: 1;
      display: flex;
      flex-direction: column;
      min-width: 0;
    }

    /* Header */
    .admin-header {
      background: #ffffff;
      border-bottom: 1px solid var(--border-color);
      height: 64px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 32px;
      position: sticky;
      top: 0;
      z-index: 50;
    }
    .header-title {
      font-size: 18px;
      font-weight: 700;
      color: var(--text-dark);
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .header-actions {
      display: flex;
      align-items: center;
      gap: 16px;
    }
    .user-pill {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 6px 12px;
      border-radius: 30px;
      background: #f4f4f7;
      border: 1px solid var(--border-color);
    }
    .user-avatar {
      width: 28px; height: 28px;
      border-radius: 50%;
      background: var(--primary);
      color: #fff;
      display: flex; align-items: center; justify-content: center;
      font-weight: 700;
      font-size: 12px;
    }
    .user-name {
      font-size: 12px;
      font-weight: 600;
      color: var(--text-dark);
    }
    .role-badge {
      font-size: 9px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      padding: 2px 6px;
      background: #111;
      color: #fff;
      border-radius: 4px;
    }

    /* Page Content */
    .admin-content {
      padding: 32px;
      flex: 1;
      opacity: 1;
      transition: opacity 0.18s ease-in-out;
    }
    .admin-content.is-loading {
      opacity: 0.35;
      pointer-events: none;
    }

    /* Top Progress Bar for Seamless SPA transitions */
    #admin-progress-bar {
      position: fixed;
      top: 0;
      left: 0;
      height: 3px;
      width: 0%;
      background: linear-gradient(90deg, var(--primary), #ef4444);
      z-index: 99999;
      opacity: 0;
      transition: width 0.25s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.2s ease;
      pointer-events: none;
      box-shadow: 0 0 10px rgba(181, 22, 34, 0.6);
    }

    /* Alert Close Button */
    .alert-close {
      margin-left: auto;
      background: none;
      border: none;
      font-size: 18px;
      line-height: 1;
      cursor: pointer;
      opacity: 0.5;
      padding: 0 4px;
      color: inherit;
    }
    .alert-close:hover {
      opacity: 1;
    }

    /* Common Components */
    .btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 9px 18px;
      font-size: 13px;
      font-weight: 600;
      border-radius: 6px;
      cursor: pointer;
      text-decoration: none;
      transition: all 0.15s ease;
      border: 1px solid transparent;
    }
    .btn-primary {
      background: var(--primary);
      color: #fff;
    }
    .btn-primary:hover {
      background: var(--primary-dark);
    }
    .btn-secondary {
      background: #ffffff;
      border-color: var(--border-color);
      color: var(--text-dark);
    }
    .btn-secondary:hover {
      background: #f4f4f7;
    }
    .btn-dark {
      background: #1a1a1e;
      color: #fff;
    }
    .btn-dark:hover {
      background: #000;
    }
    .btn-danger {
      background: #fee2e2;
      color: #dc2626;
      border-color: #fecaca;
    }
    .btn-danger:hover {
      background: #dc2626;
      color: #fff;
    }
    .btn-sm {
      padding: 5px 10px;
      font-size: 12px;
    }

    .card {
      background: var(--card-bg);
      border: 1px solid var(--border-color);
      border-radius: 10px;
      padding: 24px;
      margin-bottom: 24px;
      box-shadow: 0 1px 3px rgba(0,0,0,0.03);
    }
    .card-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 20px;
      padding-bottom: 14px;
      border-bottom: 1px solid var(--border-color);
    }
    .card-title {
      font-size: 16px;
      font-weight: 700;
      color: var(--text-dark);
    }

    /* Table */
    .table-responsive {
      overflow-x: auto;
    }
    .admin-table {
      width: 100%;
      border-collapse: collapse;
      text-align: left;
    }
    .admin-table th {
      background: #fafafc;
      padding: 12px 16px;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 0.8px;
      text-transform: uppercase;
      color: var(--text-muted);
      border-bottom: 1px solid var(--border-color);
    }
    .admin-table td {
      padding: 14px 16px;
      border-bottom: 1px solid var(--border-color);
      font-size: 13px;
      vertical-align: middle;
    }
    .admin-table tr:hover td {
      background: #fdfdfd;
    }

    /* Badges */
    .badge {
      display: inline-block;
      padding: 3px 8px;
      font-size: 11px;
      font-weight: 700;
      border-radius: 4px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    .badge-success { background: #dcfce7; color: #15803d; }
    .badge-warning { background: #fef3c7; color: #b45309; }
    .badge-danger { background: #fee2e2; color: #b91c1c; }
    .badge-info { background: #e0f2fe; color: #0369a1; }
    .badge-dark { background: #1a1a1e; color: #ffffff; }

    /* Alert */
    .alert {
      padding: 14px 18px;
      border-radius: 8px;
      margin-bottom: 24px;
      display: flex;
      align-items: center;
      gap: 12px;
      font-size: 13px;
      font-weight: 500;
    }
    .alert-success { background: #ecfdf5; border: 1px solid #a7f3d0; color: #065f46; }
    .alert-error { background: #fef2f2; border: 1px solid #fecaca; color: #991b1b; }
    .alert-info { background: #eff6ff; border: 1px solid #bfdbfe; color: #1e40af; }

    /* Forms */
    .form-group {
      margin-bottom: 20px;
    }
    .form-label {
      display: block;
      font-size: 12px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      color: var(--text-dark);
      margin-bottom: 6px;
    }
    .form-control {
      width: 100%;
      padding: 10px 14px;
      font-family: inherit;
      font-size: 13px;
      background: #fff;
      border: 1px solid var(--border-color);
      border-radius: 6px;
      color: var(--text-dark);
      transition: border-color 0.15s;
    }
    .form-control:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(181, 22, 34, 0.1);
    }
    .form-text {
      font-size: 11px;
      color: var(--text-muted);
      margin-top: 4px;
    }
  </style>
  @stack('styles')
</head>
<body>
  <!-- Progress Bar for SPA content navigation -->
  <div id="admin-progress-bar"></div>

  <!-- Sidebar -->
  <aside class="admin-sidebar">
    <a href="{{ route('admin.dashboard') }}" class="admin-brand">
      <div class="admin-brand__badge">CI</div>
      <div class="admin-brand__text">
        <span class="admin-brand__title">CITYICONS</span>
        <span class="admin-brand__sub">Editorial Control</span>
      </div>
    </a>

    <nav class="admin-nav">
      <span class="nav-label">Overview</span>
      <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i class="fa-solid fa-chart-line"></i>
        <span>Dashboard</span>
      </a>

      <span class="nav-label">Editorial Content</span>
      <a href="{{ route('admin.articles.index') }}" class="nav-item {{ request()->routeIs('admin.articles.*') ? 'active' : '' }}">
        <i class="fa-solid fa-newspaper"></i>
        <span>Articles &amp; Stories</span>
      </a>
      <a href="{{ route('admin.people.index') }}" class="nav-item {{ request()->routeIs('admin.people.*') ? 'active' : '' }}">
        <i class="fa-solid fa-users"></i>
        <span>People Directory</span>
      </a>
      <a href="{{ route('admin.nominations.index') }}" class="nav-item {{ request()->routeIs('admin.nominations.*') ? 'active' : '' }}">
        <i class="fa-solid fa-inbox"></i>
        <span>Nominations</span>
        @php $pendingCount = \App\Models\Nomination::where('status', 'pending')->count(); @endphp
        @if($pendingCount > 0)
          <span class="nav-badge danger">{{ $pendingCount }}</span>
        @endif
      </a>

      <span class="nav-label">Taxonomy &amp; Network</span>
      <a href="{{ route('admin.categories.index') }}" class="nav-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
        <i class="fa-solid fa-folder-tree"></i>
        <span>Categories</span>
      </a>
      <a href="{{ route('admin.tags.index') }}" class="nav-item {{ request()->routeIs('admin.tags.*') ? 'active' : '' }}">
        <i class="fa-solid fa-tags"></i>
        <span>Tags</span>
      </a>
      <a href="{{ route('admin.cities.index') }}" class="nav-item {{ request()->routeIs('admin.cities.*') ? 'active' : '' }}">
        <i class="fa-solid fa-city"></i>
        <span>Cities (10 Editions)</span>
      </a>

      <span class="nav-label">Publishing &amp; Growth</span>
      <a href="{{ route('admin.brands.index') }}" class="nav-item {{ request()->routeIs('admin.brands.*') ? 'active' : '' }}">
        <i class="fa-solid fa-handshake"></i>
        <span>Featured Partners</span>
      </a>
      <a href="{{ route('admin.magazine-editions.index') }}" class="nav-item {{ request()->routeIs('admin.magazine-editions.*') ? 'active' : '' }}">
        <i class="fa-solid fa-book-open"></i>
        <span>Magazine Editions</span>
      </a>
      <a href="{{ route('admin.subscribers.index') }}" class="nav-item {{ request()->routeIs('admin.subscribers.*') ? 'active' : '' }}">
        <i class="fa-solid fa-envelope-open-text"></i>
        <span>Subscribers</span>
      </a>

      <span class="nav-label">System</span>
      <a href="{{ route('admin.settings.index') }}" class="nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
        <i class="fa-solid fa-sliders"></i>
        <span>Site Settings</span>
      </a>
      <a href="{{ url('/') }}" target="_blank" class="nav-item">
        <i class="fa-solid fa-arrow-up-right-from-square"></i>
        <span>View Live Site</span>
      </a>
    </nav>
  </aside>

  <!-- Main Content -->
  <div class="admin-main">
    <header class="admin-header">
      <div class="header-title">
        @yield('header_title', 'Editorial Dashboard')
      </div>
      <div class="header-actions">
        <div class="user-pill">
          <div class="user-avatar">{{ substr(Auth::user()->name ?? 'A', 0, 1) }}</div>
          <span class="user-name">{{ Auth::user()->name ?? 'Admin' }}</span>
          <span class="role-badge">{{ Auth::user()->role ?? 'Admin' }}</span>
        </div>
        <form action="{{ route('admin.logout') }}" method="POST" data-no-pjax style="display:inline;">
          @csrf
          <button type="submit" class="btn btn-secondary btn-sm" title="Log out">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
            <span>Logout</span>
          </button>
        </form>
      </div>
    </header>

    <main class="admin-content">
      @if(session('success'))
        <div class="alert alert-success">
          <i class="fa-solid fa-circle-check"></i>
          <span>{{ session('success') }}</span>
        </div>
      @endif

      @if(session('error'))
        <div class="alert alert-error">
          <i class="fa-solid fa-triangle-exclamation"></i>
          <span>{{ session('error') }}</span>
        </div>
      @endif

      @if($errors->any())
        <div class="alert alert-error">
          <i class="fa-solid fa-triangle-exclamation"></i>
          <div>
            @foreach($errors->all() as $err)
              <div>• {{ $err }}</div>
            @endforeach
          </div>
        </div>
      @endif

      @yield('content')
    </main>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

  <script>
    /* ==========================================================================
       CityIcons Admin SPA Router & Seamless PJAX Engine
       Enables instantaneous page-content reloads without reloading the sidebar.
       ========================================================================== */
    const progressBar = document.getElementById('admin-progress-bar');
    let progressTimer = null;
    let currentAbortController = null;

    function startProgress() {
      if (!progressBar) return;
      clearTimeout(progressTimer);
      progressBar.style.opacity = '1';
      progressBar.style.width = '25%';
      progressTimer = setTimeout(() => {
        progressBar.style.width = '70%';
      }, 150);
    }

    function finishProgress() {
      if (!progressBar) return;
      clearTimeout(progressTimer);
      progressBar.style.width = '100%';
      setTimeout(() => {
        progressBar.style.opacity = '0';
        setTimeout(() => {
          progressBar.style.width = '0%';
        }, 200);
      }, 200);
    }

    // Initialize Quill WYSIWYG Editor
    function initAdminQuill() {
      const editorEl = document.querySelector('#quill-editor');
      if (!editorEl) return;

      // Avoid re-initialization if already active
      if (editorEl.classList.contains('ql-container')) {
        return;
      }

      // Remove any leftover duplicate toolbar element if existing
      const prevToolbar = editorEl.previousElementSibling;
      if (prevToolbar && prevToolbar.classList.contains('ql-toolbar')) {
        prevToolbar.remove();
      }

      const targetInput = document.getElementById('body-input') || document.getElementById('bio-input');
      const placeholder = editorEl.getAttribute('data-placeholder') || 'Write editorial content here...';

      try {
        const quill = new Quill(editorEl, {
          theme: 'snow',
          placeholder: placeholder,
          modules: {
            toolbar: [
              [{ 'header': [1, 2, 3, false] }],
              ['bold', 'italic', 'underline', 'blockquote'],
              [{ 'list': 'ordered'}, { 'list': 'bullet' }],
              ['link', 'clean']
            ]
          }
        });

        editorEl.__quill = quill;

        const form = editorEl.closest('form');
        if (form && targetInput) {
          if (!form.dataset.quillBound) {
            form.dataset.quillBound = 'true';
            form.addEventListener('submit', function () {
              targetInput.value = quill.root.innerHTML;
            });
          }
        }
      } catch (err) {
        console.error('Quill initialization error:', err);
      }
    }

    // Initialize all page-level components
    function initAdminPage() {
      initAdminQuill();

      // Dismissible flash alerts
      document.querySelectorAll('.alert').forEach(alert => {
        if (!alert.querySelector('.alert-close')) {
          const closeBtn = document.createElement('button');
          closeBtn.type = 'button';
          closeBtn.className = 'alert-close';
          closeBtn.innerHTML = '&times;';
          closeBtn.title = 'Dismiss alert';
          closeBtn.onclick = () => alert.remove();
          alert.appendChild(closeBtn);
        }
      });

      // Dispatch custom lifecycle event
      document.dispatchEvent(new CustomEvent('admin:page-loaded', { detail: { url: window.location.href } }));
    }

    // Re-evaluate script elements inside newly injected dynamic content
    function executeScripts(container) {
      const scripts = container.querySelectorAll('script');
      scripts.forEach(oldScript => {
        if (oldScript.type && oldScript.type !== 'text/javascript' && oldScript.type !== 'module') {
          return;
        }
        const newScript = document.createElement('script');
        Array.from(oldScript.attributes).forEach(attr => {
          newScript.setAttribute(attr.name, attr.value);
        });
        newScript.textContent = oldScript.textContent;
        oldScript.parentNode.replaceChild(newScript, oldScript);
      });
    }

    // Fetch and seamlessly swap page content
    async function loadAdminPage(url, pushState = true, options = {}) {
      if (currentAbortController) {
        currentAbortController.abort();
      }
      currentAbortController = new AbortController();

      const contentEl = document.querySelector('.admin-content');
      const headerTitleEl = document.querySelector('.header-title');
      const navEl = document.querySelector('.admin-nav');

      startProgress();
      if (contentEl) contentEl.classList.add('is-loading');

      try {
        const fetchOptions = {
          method: options.method || 'GET',
          headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-Admin-PJAX': 'true',
            'Accept': 'text/html, application/xhtml+xml, */*'
          },
          signal: currentAbortController.signal,
          redirect: 'follow'
        };

        if (options.body) {
          fetchOptions.body = options.body;
        }

        const response = await fetch(url, fetchOptions);

        // Check if session timed out and redirected to login
        if (response.url.includes('/login')) {
          window.location.href = response.url;
          return;
        }

        // Check content-type: if file download (e.g. CSV export)
        const contentType = response.headers.get('content-type') || '';
        if (!contentType.includes('text/html')) {
          window.location.href = url;
          finishProgress();
          if (contentEl) contentEl.classList.remove('is-loading');
          return;
        }

        if (!response.ok && response.status !== 422) {
          window.location.href = url;
          return;
        }

        const html = await response.text();
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');

        const newContent = doc.querySelector('.admin-content');
        const newHeaderTitle = doc.querySelector('.header-title');
        const newNav = doc.querySelector('.admin-nav');

        if (!newContent) {
          window.location.href = url;
          return;
        }

        // 1. Update Document Title
        if (doc.title) {
          document.title = doc.title;
        }

        // 2. Update Header Title
        if (headerTitleEl && newHeaderTitle) {
          headerTitleEl.innerHTML = newHeaderTitle.innerHTML;
        }

        // 3. Update Content
        if (contentEl) {
          contentEl.innerHTML = newContent.innerHTML;
          executeScripts(contentEl);
        }

        // 4. Update Sidebar Navigation (updates active item highlight and notification badges without reloading sidebar)
        if (navEl && newNav) {
          navEl.innerHTML = newNav.innerHTML;
        }

        // 5. Update Browser History State
        const finalUrl = response.url || url;
        if (pushState) {
          window.history.pushState({ pjax: true, url: finalUrl }, '', finalUrl);
        }

        // 6. Scroll window to top
        window.scrollTo({ top: 0, behavior: 'instant' });

        // 7. Initialize page components (Quill editor, etc.)
        initAdminPage();

      } catch (err) {
        if (err.name === 'AbortError') {
          return; // Aborted by newer navigation click
        }
        console.error('PJAX navigation error, falling back to full page load:', err);
        window.location.href = url;
      } finally {
        if (contentEl) contentEl.classList.remove('is-loading');
        finishProgress();
      }
    }

    // Global Click Interception for Admin Links
    document.addEventListener('click', function (e) {
      const link = e.target.closest('a');
      if (!link) return;

      // Ignore modified clicks (Ctrl, Cmd, Shift, Alt)
      if (e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return;

      // Ignore links with target="_blank"
      if (link.target && link.target !== '_self') return;

      // Ignore explicit download links
      if (link.hasAttribute('download')) return;

      // Ignore data-no-pjax
      if (link.closest('[data-no-pjax]') || link.hasAttribute('data-no-pjax')) return;

      const href = link.getAttribute('href');
      if (!href || href.startsWith('#') || href.startsWith('javascript:')) return;

      // Parse absolute URL
      let targetUrl;
      try {
        targetUrl = new URL(link.href, window.location.href);
      } catch (err) {
        return;
      }

      // Must be same origin
      if (targetUrl.origin !== window.location.origin) return;

      // Must be within admin dashboard paths
      if (!targetUrl.pathname.startsWith('/admin')) return;

      // Exclude binary export routes
      if (targetUrl.pathname.endsWith('/export')) return;

      e.preventDefault();
      loadAdminPage(targetUrl.href, true);
    });

    // Global Form Submission Interception
    document.addEventListener('submit', function (e) {
      const form = e.target.closest('form');
      if (!form) return;

      // Ignore if marked with data-no-pjax
      if (form.hasAttribute('data-no-pjax') || form.closest('[data-no-pjax]')) return;

      // Ignore logout form (must do full page reload)
      if (form.action.includes('logout')) return;

      let targetUrl;
      try {
        targetUrl = new URL(form.action, window.location.href);
      } catch (err) {
        return;
      }

      if (targetUrl.origin !== window.location.origin || !targetUrl.pathname.startsWith('/admin')) {
        return;
      }

      const method = (form.getAttribute('method') || 'GET').toUpperCase();

      if (method === 'GET') {
        e.preventDefault();
        const formData = new FormData(form);
        const params = new URLSearchParams();
        for (const [key, value] of formData.entries()) {
          if (value !== '') {
            params.append(key, value);
          }
        }
        const cleanUrl = targetUrl.pathname + (params.toString() ? '?' + params.toString() : '');
        loadAdminPage(cleanUrl, true);
      } else if (method === 'POST') {
        // Sync Quill editor if present inside this form before creating FormData
        const editorEl = form.querySelector('#quill-editor');
        if (editorEl && editorEl.__quill) {
          const targetInput = form.querySelector('#body-input') || form.querySelector('#bio-input');
          if (targetInput) targetInput.value = editorEl.__quill.root.innerHTML;
        }

        e.preventDefault();
        const formData = new FormData(form);
        loadAdminPage(form.action, true, {
          method: 'POST',
          body: formData
        });
      }
    });

    // Handle browser Back / Forward navigation
    window.addEventListener('popstate', function (e) {
      loadAdminPage(window.location.href, false);
    });

    // Initial load execution
    document.addEventListener('DOMContentLoaded', function () {
      initAdminPage();
    });
  </script>

  @stack('scripts')
</body>
</html>
