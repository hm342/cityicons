<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editorial Sign In — CityIcons Administration</title>
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Bodoni+Moda:ital,opsz,wght@0,6..96,400;0,6..96,700;1,6..96,400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <style>
    :root {
      --primary: #B51622;
      --font-sans: 'Plus Jakarta Sans', sans-serif;
      --font-serif: 'Bodoni Moda', serif;
    }
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: var(--font-sans);
      background: #0d0d10;
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      padding: 24px;
    }
    .login-container {
      width: 100%;
      max-width: 440px;
      background: #17171c;
      border: 1px solid #282832;
      border-radius: 14px;
      padding: 44px 36px;
      box-shadow: 0 20px 40px rgba(0,0,0,0.4);
    }
    .login-brand {
      text-align: center;
      margin-bottom: 32px;
    }
    .login-emblem {
      display: inline-flex;
      width: 52px; height: 52px;
      background: var(--primary);
      color: #fff;
      font-family: var(--font-serif);
      font-size: 26px;
      font-weight: 700;
      align-items: center;
      justify-content: center;
      border-radius: 10px;
      margin-bottom: 16px;
    }
    .login-title {
      font-family: var(--font-serif);
      font-size: 24px;
      letter-spacing: 2px;
      font-weight: 700;
      margin-bottom: 4px;
    }
    .login-subtitle {
      font-size: 11px;
      text-transform: uppercase;
      letter-spacing: 1.5px;
      color: var(--primary);
      font-weight: 700;
    }
    .form-group {
      margin-bottom: 20px;
    }
    .form-label {
      display: block;
      font-size: 11px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 1px;
      color: #a0a0b0;
      margin-bottom: 8px;
    }
    .form-control {
      width: 100%;
      padding: 13px 16px;
      background: #0f0f13;
      border: 1px solid #2e2e3a;
      border-radius: 8px;
      color: #fff;
      font-size: 14px;
      font-family: inherit;
      transition: all 0.15s;
    }
    .form-control:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(181, 22, 34, 0.25);
    }
    .login-btn {
      width: 100%;
      background: var(--primary);
      color: #fff;
      padding: 14px;
      border: none;
      border-radius: 8px;
      font-size: 13px;
      font-weight: 700;
      letter-spacing: 1.5px;
      text-transform: uppercase;
      cursor: pointer;
      margin-top: 10px;
      transition: background 0.15s;
    }
    .login-btn:hover {
      background: #d41a29;
    }
    .alert-error {
      background: rgba(181, 22, 34, 0.15);
      border: 1px solid rgba(181, 22, 34, 0.4);
      color: #ff8b94;
      padding: 12px 14px;
      border-radius: 8px;
      font-size: 13px;
      margin-bottom: 22px;
    }
    .alert-success {
      background: rgba(16, 185, 129, 0.15);
      border: 1px solid rgba(16, 185, 129, 0.4);
      color: #34d399;
      padding: 12px 14px;
      border-radius: 8px;
      font-size: 13px;
      margin-bottom: 22px;
    }
    .login-footer {
      text-align: center;
      margin-top: 28px;
      font-size: 12px;
      color: #6a6a7c;
    }
    .login-footer a {
      color: #a0a0b0;
      text-decoration: none;
    }
    .login-footer a:hover {
      color: #fff;
    }
  </style>
</head>
<body>

  <div class="login-container">
    <div class="login-brand">
      <div class="login-emblem">CI</div>
      <h1 class="login-title">CITYICONS</h1>
      <div class="login-subtitle">Editorial Administration</div>
    </div>

    @if(session('success'))
      <div class="alert-success">
        <i class="fa-solid fa-circle-check" style="margin-right:6px;"></i> {{ session('success') }}
      </div>
    @endif

    @if($errors->any())
      <div class="alert-error">
        @foreach($errors->all() as $err)
          <div>• {{ $err }}</div>
        @endforeach
      </div>
    @endif

    <form action="{{ route('admin.login.submit') }}" method="POST">
      @csrf

      <div class="form-group">
        <label class="form-label" for="email">Admin Email Address</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" required autofocus placeholder="name@cityicons.in" autocomplete="email">
      </div>

      <div class="form-group">
        <label class="form-label" for="password">Password</label>
        <input type="password" id="password" name="password" class="form-control" required placeholder="Enter administrative password" autocomplete="current-password">
      </div>

      <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; font-size:12px; color:#a0a0b0;">
        <label style="display:flex; align-items:center; gap:8px; cursor:pointer;">
          <input type="checkbox" name="remember" style="accent-color:var(--primary);">
          <span>Keep me signed in</span>
        </label>
      </div>

      <button type="submit" class="login-btn">
        <i class="fa-solid fa-shield-halved" style="margin-right:8px;"></i> Sign In Securely
      </button>
    </form>

    <div class="login-footer">
      <a href="{{ url('/') }}"><i class="fa-solid fa-arrow-left"></i> Return to CityIcons Public Site</a>
    </div>
  </div>

</body>
</html>
