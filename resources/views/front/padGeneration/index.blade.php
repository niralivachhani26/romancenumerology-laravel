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
</head>

<body style="background-color: #ffb6c1;">
    <div class="salesCopyWriting">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <form action="{{route('order.store')}}" method="POST">
                        @csrf
                        <div class="salesCopyWritingContent padGeneration">
                            <div class="noQuestionsAsked">
                                <h2>Your Soulmate Number Reading </h2>
                                    <div class="salesCopyWritingImg product">
                                        <img src="{{ asset('assets/front/soulmate-number/images/salesCopyWriting/12-Month-Love-Life-Forecast.png') }}" alt="">
                                    </div>
                                    <h2 class="mainPrice">$24.90</h2>

                                    <div class="sketchSection">
                                        <input type="hidden" name="amount" value="24.90">
                                        <div class="sketchGroup">
                                            <input type="radio" name="sketch" id="blackWhite" value="black&white" checked>
                                            <label for="blackWhite"> <span></span> Black & White</label>
                                        </div>
                                        <div class="sketchGroup">
                                            <input type="radio" name="sketch" id="color" value="color">
                                            <label for="color"> <span></span> Color</label>
                                        </div>
                                        <div class="sketchGroup">
                                            <input type="radio" name="sketch" id="sketch" value="background">
                                            <label for="sketch"> <span></span> Background </label>
                                        </div>

                                    </div>
                                <button class="button"><span>I Want My Soulmate Number Reading Now!</span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
