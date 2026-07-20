@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css" integrity="sha512-wR4oNhLBHf7smjy0K4oqzdWumd+r5/+6QO/vDda76MW5iug4PT7v86FoEkySIJft3XA0Ae6axhIvHrqwm793Nw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

<footer class="quiz-footer">
    <div class="container">
        <div class="row w-100">
            <div class="col-lg-4 col-md-12">
                <div class="footer-main-section">
                    {{-- <img src="{{ asset('assets/front/quiz/quiz3/Luca Amari.png') }}" alt=""> --}}
                    <div class="luca-amari-outter-footer">
                        <div class="luca-amari-footer">
                            <img loading="lazy" src="{{ asset('assets/front/quiz/quiz3/Luca Amari.png') }}" alt="">
                        </div>
                        <div class="fill-img-footer"></div>
                    </div>
                    <p>Meet Luca Amani, your cosmic connection to the realm of love. With a profound link to The Universe, Luca offers potent and precise love readings, guiding you on your journey to heart's fulfillment. Embrace the celestial wisdom of Luca's insights and let love's cosmic energies illuminate your path.</p>
                    {{-- <span class="more-info"><a href="#">More Info</a></span> --}}
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="footer-main-section">
                    <p class="footer-heading">100% guarantee</p>
                    <p>You get the benefit of my divine promise. In this way, you don't take any risks. You could ask for your money back if the Help you got did not meet your full happiness. This is written in my general terms of service and in my divine promise to you.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="footer-main-section">
                    <p class="footer-heading">testimonies</p>
                    <div class="testimonial-footer-box">
                        <div class="carousel">
                            <div class="testimonial-review">
                                <p class="review-heading">Life-Changing Love Reading</p>
                                <p class="testimony-reatings">★★★★★</p>
                                <p class="review-comment">Luca Amani's love reading? It was a total game-changer! His cosmic insights helped me find self-love, and now I'm in a fantastic relationship. Luca really knows his stuff!</p>
                                <p class="testimonial-name">Sarah W.</p>
                            </div>
                            <div class="testimonial-review">
                                <p class="review-heading">Cosmic Expert: Mind-Blowing Guidance</p>
                                <p class="testimony-reatings">★★★★☆</p>
                                <p class="review-comment">A Mind-Blowing experience unlike any other! He is a cosmic expert who guided me through my relationship challenges. No doubt, Luca's the real deal!</p>
                                <p class="testimonial-name">David P.</p>
                            </div>
                            <div class="testimonial-review">
                                <p class="review-heading">Wise Friend: Luca's Love Wisdom</p>
                                <p class="testimony-reatings">★★★★★</p>
                                <p class="review-comment">Luca’s love reading was like talking to a wise friend. He really helped me to find love and learn how to make it work. His advice is awesome!</p>
                                <p class="testimonial-name">Maya T.</p>
                            </div>
                            <div class="testimonial-review">
                                <p class="review-heading">Empowering Love Transformation</p>
                                <p class="testimony-reatings">★★★★★</p>
                                <p class="review-comment">Luca Amani's love insights changed my life for the better. He has helped me boost my self-esteem, and I ended up finding the love I'd been looking for. Luca is amazing!</p>
                                <p class="testimonial-name">Alex M.</p>
                            </div>
                            <div class="testimonial-review">
                                <p class="review-heading">Cosmic Love Therapy</p>
                                <p class="testimony-reatings">★★★★☆</p>
                                <p class="review-comment">Luca Amani's love reading felt like a cosmic therapy session. They gave me great advice to improve my relationship. Luca's gifts are incredible!</p>
                                <p class="testimonial-name">Emily C.</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-last">
        <div class="footer-last-inner">
            <p class="copyright">Copyright © {{ date('Y') }} {{ env('APP_NAME') }}. All rights reserved.</p>
            <p class="footer-links"><a href="#">Privacy Policy</a> | <a href="#">Terms & Conditions</a></p>
        </div>
    </div>
</footer>

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @if (env('APP_ENV') != 'local')
        <script type="text/javascript">
            (function(c,l,a,r,i,t,y){
                c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
                t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
                y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
            })(window, document, "clarity", "script", "kyfh8xoe5x");
        </script>
    @endif

    <script>
        $(document).ready(function(){
            $('.carousel').slick({
                dots: true,
                infinite: true,
                speed: 500,
                slidesToShow: 1,
                slidesToScroll: 1
            });
        });
    </script>
@endpush
