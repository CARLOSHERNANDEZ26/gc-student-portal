{{-- resources/views/landing.blade.php --}}

<x-app-layout>
    <x-slot name="title">Student Management Portal — Gordon College</x-slot>

    <style>
        * {
          margin: 0;
          padding: 0;
          box-sizing: border-box;
        }

        body {
          font-family: Arial, sans-serif;
          color: #1A5C2A;
        }

        .navbar {
          background-color: #1A5C2A;
          padding: 14px 40px;
          display: flex;
          justify-content: space-between;
          align-items: center;
        }

        .navbar .brand {
          color: #fff;
          font-size: 20px;
          font-weight: bold;
        }

        .navbar .nav-links {
          display: flex;
          gap: 12px;
        }

        .btn {
          padding: 10px 22px;
          border-radius: 6px;
          font-weight: bold;
          font-size: 14px;
          text-decoration: none;
          border: none;
          cursor: pointer;
        }

        .btn-outline {
          background: transparent;
          color: #fff;
          border: 2px solid #A8D5B5;
        }

        .btn-primary {
          background: #276B35;
          color: #fff;
        }

        .btn-success {
          background: #8B3A00;
          color: #fff;
        }

        .hero {
          background: linear-gradient(135deg, #1A5C2A 0%, #276B35 100%);
          min-height: 88vh;
          display: flex;
          align-items: center;
          padding: 60px 40px;
          gap: 60px;
        }

        .hero-text {
          flex: 1;
          color: #fff;
        }

        .hero-text h1 {
          font-size: 48px;
          line-height: 1.2;
          margin-bottom: 20px;
        }

        .hero-text p {
          font-size: 18px;
          color: #A8D5B5;
          margin-bottom: 36px;
        }

        .hero-buttons {
          display: flex;
          gap: 14px;
          flex-wrap: wrap;
        }

        .hero-image {
          flex: 1;
          display: flex;
          justify-content: center;
        }

        .hero-image img {
          max-width: 480px;
          width: 100%;
          border-radius: 16px;
          box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .features {
          padding: 80px 40px;
          background: #F0F7F1;
          text-align: center;
        }

        .features h2 {
          font-size: 32px;
          margin-bottom: 12px;
          color: #1A5C2A;
        }

        .features .subtitle {
          color: #555;
          margin-bottom: 48px;
          font-size: 16px;
        }

        .feature-grid {
          display: grid;
          grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
          gap: 24px;
          max-width: 1000px;
          margin: 0 auto;
        }

        .feature-card {
          background: #fff;
          border-radius: 12px;
          padding: 32px 24px;
          box-shadow: 0 2px 12px rgba(0, 0, 0, 0.07);
          border-top: 4px solid #276B35;
        }

        .feature-card .icon {
          font-size: 36px;
          margin-bottom: 14px;
        }

        .feature-card h3 {
          font-size: 18px;
          margin-bottom: 8px;
          color: #1A5C2A;
        }

        .feature-card p {
          font-size: 14px;
          color: #555;
          line-height: 1.6;
        }

        .footer {
          background: #1A5C2A;
          color: #A8D5B5;
          text-align: center;
          padding: 28px 40px;
          font-size: 14px;
        }
    </style>

    <!-- NAVBAR -->
    <nav class="navbar">
        <span class="brand">🎓 GC Student Portal</span>
        <div class="nav-links">
            <a href="{{ route('login') }}" class="btn btn-outline">Login</a>
            <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
        </div>
    </nav>

    <!-- HERO -->
    <section class="hero">
        <div class="hero-text">
            <h1>Student Management Portal</h1>
            <p>A centralized platform for managing student enrollment records
            at Gordon College, Olongapo City. Fast, secure, and easy to use.</p>

            <div class="hero-buttons">
                <a href="{{ route('login') }}" class="btn btn-primary">Login to Portal</a>
                <a href="{{ route('register') }}" class="btn btn-success">Create Account</a>
            </div>
        </div>

        <div class="hero-image">
            <img src="{{ asset('images/hero-pic.jpg') }}" alt="Students at Gordon College" />
        </div>
    </section>

    <!-- FEATURES -->
    <section class="features">
        <h2>What the Portal Offers</h2>
        <p class="subtitle">Everything you need to manage student records in one place.</p>

        <div class="feature-grid">
            <div class="feature-card">
                <div class="icon">📋</div>
                <h3>Student Records</h3>
                <p>Add, view, update, and delete student enrollment information with ease.</p>
            </div>

            <div class="feature-card">
                <div class="icon">🔒</div>
                <h3>Secure Access</h3>
                <p>Role-based authentication ensures only authorized staff can manage records.</p>
            </div>

            <div class="feature-card">
                <div class="icon">📊</div>
                <h3>Dashboard Overview</h3>
                <p>Get a quick summary of enrolled students by course, year, and block.</p>
            </div>

            <div class="feature-card">
                <div class="icon">🎓</div>
                <h3>Gordon College</h3>
                <p>Built for BSCS, BSIT, BSCS-EMC DAT, and BSEMC-GD programs.</p>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="footer">
        <p>&copy; {{ date('Y') }} Gordon College — College of Computer Studies.</p>
    </footer>

</x-app-layout>