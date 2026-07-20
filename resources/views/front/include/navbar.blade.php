<nav class="navbar navbar-expand-lg cosmic-nav">
    <div class="container-fluid">
        {{-- <a class="navbar-brand" href="#">Navbar</a> --}}
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('assets/front/images/logo-black.png') }}" alt="" >
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav-top"
            aria-controls="main-nav-top" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="main-nav-top">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('horoscope') }}">Horoscope</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Tarot
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('daily-tarot') }}">Daily Tarot</a></li>
                        <li><a class="dropdown-item" href="{{ route('yes-or-no-tarot') }}">Yes Or No Tarot</a></li>
                        <li><a class="dropdown-item" href="{{ route('love_tarot') }}">Love Tarot</a></li>
                        <li><a class="dropdown-item" href="{{ route('wealth_tarot') }}">Wealth Tarot</a></li>
                        <li><a class="dropdown-item" href="{{ route('love_questions') }}">Love Questions</a></li>
                        <li><a class="dropdown-item" href="{{ route('quiz3_index') }}">Love Quiz</a></li>
                        <li><a class="dropdown-item" href="{{ route('past-present-future') }}">Past Present Future</a></li>
                        <li><a class="dropdown-item" href="{{ route('love-triangle-reading') }}">Love Triangle Reading</a></li>
                        <li><a class="dropdown-item" href="{{ route('auspicious-signs') }}">Auspicious Signs</a></li>
                        <li><a class="dropdown-item" href="{{ route('lucky-tarot') }}">Lucky Tarot</a></li>
                        <li><a class="dropdown-item" href="{{ route('love-quiz') }}">Love Quiz</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('blog') }}">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('numerology') }}">Numerology</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('daily-angel-love-message') }}">Angel Message</a>
                </li> --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="Message" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Message
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="Message">
                        <li><a class="dropdown-item" href="{{ route('daily-angel-love-message') }}">Angel Message</a></li>
                        <li><a class="dropdown-item" href="{{ route('lords-message') }}">Lords Message</a></li>
                        <li><a class="dropdown-item" href="{{ route('tarot-message') }}">Tarot Message</a></li>
                        <li><a class="dropdown-item" href="{{ route('angel-cards') }}">Angel Card</a></li>
                        <li><a class="dropdown-item" href="{{ route('divine-angelic-message') }}">Divine Angelic Message</a></li>
                        <li><a class="dropdown-item" href="{{ route('affirmation') }}">Affirmation</a></li>
                        <li><a class="dropdown-item" href="{{ route('prayer') }}">Prayer</a></li>
                        <li><a class="dropdown-item" href="{{ route('angel-numbers') }}">Angel Number</a></li>
                        <li><a class="dropdown-item" href="{{ route('lucky-number') }}">Lucky Number</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('love-compatibility') }}">Love Compatibility</a>
                </li>

            </ul>

        </div>
    </div>
</nav>
