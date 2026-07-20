{{-- <footer class="footer fixed-bottom"> --}}
<footer class="footer">
    <div class="container pb-1">
        <div class="row d-flex justify-content-between">
            <div class="col-lg-4 pb-3">
                <div class="main-footer-logo">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('assets/front/images/logo-black.png') }}" alt="">
                    </a>
                </div>
                <!--<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis ipsam provident ut consequuntur. Non pariatur explicabo neque quis molestias, obcaecati maiores dicta earum praesentium illo animi culpa vero accusantium at?</p>-->
            </div>
            <div class="col-lg-3 col-md-6 pb-3">
                <div class="quicklinks">
                    <div class="main-footer-heading">Quicklinks</div>
                    <div class="footer-links">
                        <div class=""><a href="{{ route('page', ['page' => 'about-us']) }}">About Us</a></div>
                        {{-- <div class=""><a href="{{ route('page', ['page' => 'about-us']) }}">Contact Us</a></div> --}}
                        <div class=""><a href="{{ route('page', ['page' => 'disclaimer']) }}">Disclaimer</a></div>
                        <div class=""><a href="{{ route('page', ['page' => 'privacy-policy']) }}">Privacy Policy</a></div>
                        <div class=""><a href="{{ route('page', ['page' => 'terms-condition']) }}">Terms & Condition</a></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 pb-3">
                <div class="newsletter">
                    <div class="main-footer-heading">Subscribe Newsletter</div>
                    {{-- {!! Form::open($model, ['url' => $formUrl, 'method' => 'post', 'id' => 'data-form']) !!} --}}
                    {!! Form::open(['route' => 'newsletter', 'id' => 'newsletter']) !!}
                        <div class="col-md-12 col-12">
                            <div class="my-1">
                                {{-- {!! Form::label('name', 'Name', ['class' => 'form-label']) !!} --}}
                                <div class="input-group">
                                    {!! Form::text('name', '', [
                                        'class' => 'form-control input-lg rounded-0',
                                        'id' => 'name',
                                        'placeholder' => 'Name',
                                    ]) !!}
                                </div>
                                <x-form-error name='name' />
                            </div>
                        </div>
                        <div class="col-md-12 col-12">
                            <div class="mb-1">
                                {{-- {!! Form::label('email', 'Email', ['class' => 'form-label']) !!} --}}
                                <div class="input-group">
                                    {!! Form::text('email', '', [
                                        'class' => 'form-control input-lg rounded-0',
                                        'id' => 'email',
                                        'placeholder' => 'Email',
                                    ]) !!}
                                </div>
                                <x-form-error name='email' />
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button class="btn subscribe-btn" id="data-btn"><span class="w-100">Subscribe</span></button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
     <div class="footer-inner">
        <p class="copyright">Copyright © {{ date('Y') }} {{ env('APP_NAME') }}. All rights reserved.</p>
        <p class="footer-links"><a href="#">Privacy Policy</a> | <a href="#">Terms & Conditions</a></p>
    </div>
</footer>
<script src="{{asset('assets/common/js/common.js')}}"></script>
<style>
    .toast-success{
        background: green
    }
</style>
