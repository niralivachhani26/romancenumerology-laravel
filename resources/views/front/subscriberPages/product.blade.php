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
        .bonusSectionText .noQuestionsAsked{ text-align: left}
    </style>
</head>

<body style="background-color: #ffb6c1;">
    <div class="salesCopyWriting">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                     <div class="salesCopyWritingContent ">
                         <div class="noQuestionsAsked m-0">
                            <p>Your product pdf and black & white sketch </p>
                            @if($isPaid==true && $canAccessProduct==true)
                            {{--<a href="{{route('newPdfGeneration', $transcript->id)}}" target="_blank"><span>Paid Download PDF</span></a>--}}
                            <a href="{{ route('newPdfGeneration',  $transcript->id).'?pdf_purpose=D' }}">
                                <span>Download PDF</span>
                            </a>
                            @else
                            <a href="#"><span>Download PDF</span></a>
                            @endif
                        </div>
                        <div class="noQuestionsAsked ">
                            <p>You have purchased the Sketch of your solmate in {{$productName ?? ''}}.</p>
                            <div class="salesCopyWritingImg product">
                                @if($transcript->custom_gender_interest == 'male')
                                <img src="{{ asset('assets/front/soulmate-number/images/salesCopyWriting/male.png') }}" alt="">
                                @else
                                <img src="{{ asset('assets/front/soulmate-number/images/salesCopyWriting/female.png') }}" alt="">
                                @endif
                            </div>
                            @if($isPaid==true && $canAccessProduct==true)
                             <a href="{{asset($transcript->image_path)}}" download=""><span>Download Sketch</span></a>
                            {{--<a href="{{ asset($transcript->image_path) }}" target="_blank"><span>Download Sketch</span></a>--}}
                            @else
                            <a href="#"><span>Download Sketch</span></a>
                            @endif
                        </div>
                        <div class="bonusSection">
                            <div class="bonusSectionImg">
                                <img src="{{ asset('assets/front/soulmate-number/images/salesCopyWriting/faith-Marriage.png') }}" alt="">
                            </div>
                            <div class="bonusSectionText">
                                <p>ðŸ’– <b>Bonus #1: Faith & Marriage</b> â€“ Explore how <b>faith</b> plays a role in lasting,
                                meaningful relationships. Learn how <b>different belief systems</b> shape love and marriage,
                                and <b>discover</b> the secrets of couples who thrive despite religious differences.</p>
                                <div class="noQuestionsAsked borderNone p-0 m-0">
                                    <a href="http://localhost/romancenumerology/padGeneration"><span>Download Bonus #1</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="bonusSection">
                            <div class="bonusSectionImg">
                                <img src="{{ asset('assets/front/soulmate-number/images/salesCopyWriting/intimate-Sexual-Issues.png') }}" alt="">
                            </div>
                            <div class="bonusSectionText">
                                <p>ðŸ’– <b>Bonus #2: Intimate Sexual Issues</b> â€“ Physical intimacy is an <b>essential</b> part of a
                                    deep, connected relationship. This guide explores common sexual issues, emotional
                                    barriers, and practical solutions to create a <b>fulfilling love life.</b></p>
                                <div class="noQuestionsAsked borderNone p-0 m-0">
                                        <a href="http://localhost/romancenumerology/padGeneration"><span>Download Bonus #2</span></a>
                                    </div>
                            </div>
                        </div>
                        <div class="bonusSection">
                            <div class="bonusSectionImg">
                                <img src="{{ asset('assets/front/soulmate-number/images/salesCopyWriting/101-Steps-to-a-Happy-Relationship.png') }}" alt="">
                            </div>
                            <div class="bonusSectionText">
                                <p>ðŸ’– <b>Bonus #3: 101 Steps to a Happy Relationship</b> â€“ Learn the <b>essential</b> keys to
                                    maintaining a loving, joyful, and lasting relationship. This guide offers <b>practical
                                        strategies</b> for communication, trust-building, and emotional intimacy.</p>
                                    <div class="noQuestionsAsked borderNone p-0 m-0">
                                        <a href="http://localhost/romancenumerology/padGeneration"><span>Download Bonus #3</span></a>
                                    </div>
                            </div>
                        </div>
                        <div class="bonusSection">
                            <div class="bonusSectionImg">
                                <img src="{{ asset('assets/front/soulmate-number/images/salesCopyWriting/instant-Spark.png') }}" alt="">
                            </div>
                            <div class="bonusSectionText">
                                <p>ðŸ’– <b>Bonus #4: Instant Spark</b> â€“ <b>Master</b> the art of attraction and connection with
                                    expert dating strategies. Whether youâ€™re <b><i>looking for love</i></b> or trying to <b><i>reignite the
                                        spark</i></b> in an existing relationship, this guide has <b>everything</b> you need.</p>
                                    <div class="noQuestionsAsked borderNone p-0 m-0">
                                        <a href="http://localhost/romancenumerology/padGeneration"><span>Download Bonus #4</span></a>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
<script src="https://code.jquery.com/jquery-3.3.0.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.bundle.min.js"></script>

</body>

</html>
