<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Funnel</title>
    <link rel="icon" href="{{ asset('assets/front/soulmate-number/new/images/favicon.png') }}" type="image/x-icon">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" />
	<link
		href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
		rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('assets/front/soulmate-number/new/css/style.css?' . time()) }}">
<style>
    .salesCopyWritingImg .floatingNumber .centerNumber img{ object-fit: contain}
    .salesCopyWritingImg .floatingNumber{ position: relative;}
    .floatingNumber .centerNumber{ position: unset; margin: 80px 0}

    @media(width <= 567px){
        .floatingNumber .centerNumber img{ height: 150px;}
    }
</style>
</head>

<body class="skybgImg transcriptBGImg">
    <header class="transcriptHeader">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h4>Romance Numerology</h4>
                </div>
            </div>
        </div>
    </header>
    <div>
        <div class="col-lg-12">
            <div class="salesCopyWritingContent">
                <p>Hello {{ $transcript->first_name }},</p>

                <p>
                    Welcome, and thank you for subscribing to your personalized <strong>Romance Numerology Report</strong>! 🌹
                    You're now one step closer to unlocking the deeper secrets of your heart, your soul, and your romantic journey.
                </p>

                <p>
                    This report has been carefully crafted to guide you through the mysteries of your inner world and love life using the timeless wisdom of numerology.
                    Whether you're seeking a soulmate, looking to strengthen a current relationship, or simply gaining a deeper understanding of yourself—your numbers hold the answers.
                </p>

                <hr>

                <h4>📝 Your Details</h4>
                <div class="yourDetails">
                    <p><strong>Full Name:</strong> {{ $transcript->full_name }}</p>
                    <p><strong>Date of Birth:</strong> {{ $transcript->bod }}</p>
                    <p><strong>Love Path Number:</strong> {{ $transcript->love_path_number }}</p>
                    <p><strong>Heart Desire Number:</strong> {{ $transcript->heart_desier_number }}</p>
                    <p><strong>Love Destiny Number:</strong> {{ $transcript->love_Desire_number }}</p>
                </div>

                <hr>

                <h4>💖 What This Report Reveals</h4>
                <ul>
                    <li><strong>Your Romantic Nature:</strong> Discover how you naturally express love and what makes your heart beat faster.</li>
                    <li><strong>Love Compatibility:</strong> Find out which life path numbers you're most in harmony with in love and relationships.</li>
                    <li><strong>Emotional Needs:</strong> Understand your heart's deepest desires and what type of connection truly satisfies your soul.</li>
                    <li><strong>Potential Challenges:</strong> Identify obstacles that may influence your love life—and how to overcome them with grace and self-awareness.</li>
                    <li><strong>Personalized Guidance:</strong> Receive intuitive insights based on your unique numbers to help attract and nurture lasting, meaningful love.</li>
                    <li><strong>Spiritual Alignment:</strong> Learn how aligning your heart with your soul’s purpose can lead to deeper and more fulfilling romantic experiences.</li>
                </ul>

                <p>
                    ✨ Get ready to dive deep into the numbers that shape your love story.
                    Your journey to romantic self-discovery starts now!
                </p>

                <hr>

                <div class="salesCopyWritingImg">
                    <h2>🔢 Love Path Number</h2>
                    <div class="floatingNumber">
                        <div class="centerNumber">
                            <p>{{ $transcript->love_path_number }}</p>
                            <img src="{{ asset('assets/front/soulmate-number/new/images/image-border.png') }}" alt="">
                        </div>
                    </div>
                    {{-- <h4 class="loveDesierNumber">{{ $transcript->love_path_number }}</h4> --}}
                    <!-- <div class="salesCopyWritingImg">
                        <img src="{{ asset('assets/front/soulmate-number/images/salesCopyWriting/lovingCouples-1.jpg') }}" alt="Loving Couple">
                    </div> -->
                    @php
                        $description = $transcript->getlovepathnumber->description;

                        // Split by period followed by space or end of string (handles "This is a sentence. Another one.")
                        $sentences = preg_split('/(?<=[.?!])\s+/', trim($description));

                        // Group every 4 sentences
                        $chunks = array_chunk($sentences, 4);
                    @endphp

                    @foreach ($chunks as $chunk)
                        <p>{{ implode(' ', $chunk) }}</p>
                    @endforeach
                    <hr>

                </div>

                <div class="salesCopyWritingImg">

                    <h2>💓 Heart Desire Number</h2>
                    <div class="floatingNumber">
                        <div class="centerNumber">
                            <p>{{ $transcript->heart_desier_number }}</p>
                            <img src="{{ asset('assets/front/soulmate-number/new/images/image-border.png') }}" alt="">
                        </div>
                    </div>
                    {{-- <h4 class="loveDesierNumber">{{ $transcript->heart_desier_number }}</h4> --}}
                    <!-- <div class="salesCopyWritingImg">
                        <img src="{{ asset('assets/front/soulmate-number/images/salesCopyWriting/lovingCouples-2.jpg') }}" alt="Heart Desire">
                    </div> -->
                    @php
                        $description = $transcript->getheartdesiernumber->description;

                        // Split by period followed by space or end of string (handles "This is a sentence. Another one.")
                        $sentences = preg_split('/(?<=[.?!])\s+/', trim($description));

                        // Group every 4 sentences
                        $chunks = array_chunk($sentences, 4);
                    @endphp

                    @foreach ($chunks as $chunk)
                        <p>{{ implode(' ', $chunk) }}</p>
                    @endforeach
                    <hr>

                </div>

                <div class="salesCopyWritingImg">
                    <h2>🌠 Love Destiny Number</h2>
                    <div class="floatingNumber">
                        <div class="centerNumber">
                            <p>{{ $transcript->love_Desire_number }}</p>
                            <img src="{{ asset('assets/front/soulmate-number/new/images/image-border.png') }}" alt="">
                        </div>
                    </div>
                    {{-- <h4 class="loveDesierNumber">{{ $transcript->love_Desire_number }}</h4> --}}
                    <!-- <div class="salesCopyWritingImg">
                        <img src="{{ asset('assets/front/soulmate-number/images/salesCopyWriting/lovingCouples-3.jpg') }}" alt="Love Destiny">
                    </div> -->
                    @php
                        $description = $transcript->getlovedesirenumber->description;

                        // Split by period followed by space or end of string (handles "This is a sentence. Another one.")
                        $sentences = preg_split('/(?<=[.?!])\s+/', trim($description));

                        // Group every 4 sentences
                        $chunks = array_chunk($sentences, 4);
                    @endphp

                    @foreach ($chunks as $chunk)
                        <p>{{ implode(' ', $chunk) }}</p>
                    @endforeach
                    <hr>

                </div>


                <p>
                    🌹 We hope this journey brings clarity, connection, and love into your life.
                    Your romantic path is uniquely yours—and it's written in the stars... and numbers. 🌟
                </p>

                <p>
                    Take some time to reflect on the insights shared with you today. What resonated most? What patterns do you see in your past and present relationships?
                    As you explore your numerology report, you may uncover hidden truths that help you heal, grow, and move closer to the love you deserve.
                </p>
            </div>
        </div>
    </div>
    <footer class="footerSection">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer_text text-center">
                        <p>Copyright © 2025 Cosmic Love Tarot. All rights reserved.</p>
                        <p><a href="{{ route('privacyPolicy') }}">Privacy Policy</a> | <a href="{{ route('termsOfService') }}">Terms & Conditions</a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>
