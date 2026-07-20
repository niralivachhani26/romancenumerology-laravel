@php
	$ads = getPageAds();
@endphp

@extends('front.layout.main')

@push('styles')
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	<link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="{{ asset('assets/front/soulmate-number/css/style.css?' . time()) }}">
@endpush

@section('content')
	<section class="first_phase pad_120" id="first-phase">
		<video autoplay muted loop id="myVideo">
			<source src="{{ asset('assets/front/soulmate-number/images/video-5.mp4') }}" type="video/mp4">
		</video>
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="love_life text-center">
						<img src="{{ asset('assets/front/soulmate-number/images/angel.webp') }}" alt="">
						<button class="button" id="playaudio">start</button>
						<audio id="my_audio" autoplay>
							<source src="{{ asset('assets/front/soulmate-number/images/speech-1.mp3') }}" type="audio/mpeg">
							Your browser does not support the audio tag.
						</audio>
					</div>
					<div class="dialog_box">
						<p>Greetings, seeker of love! I am the Great Love, a celestial guide here to illuminate the path to your romantic destiny. Together, we'll uncover the secrets hidden within your numbers.</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="second_phase pad_120 d-none" id="second-phase">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="love_life">
						<img src="{{ asset('assets/front/soulmate-number/images/angel.webp') }}" alt="">
						<form action="">
							<div class="mb-3">
								<label class="form-label">Your Name</label>
								<?php /*<input type="text" class="form-control" id="text" name="text" onclick="firstName()"> */ ?>
								<input type="text" class="form-control" id="name" name="text" >
								<span id="name_err" class="text-danger"></span>
								<audio id="secondaudio" autoplay>
									<source src="{{ asset('assets/front/soulmate-number/images/speech-2.mp3') }}" type="audio/mpeg">
									Your browser does not support the audio tag.
								</audio>
							</div>
							<div class="mb-4">
								<label class="form-label">Date of birth</label>
								<?php /* <input id="datepicker" class="form-control" onclick="dateofBirth()"> */ ?>
								<input id="datepicker" class="form-control dob">
								<span id="dob_err" class="text-danger"></span>
								<audio id="thirdaudio" autoplay>
									<source src="{{ asset('assets/front/soulmate-number/images/speech-3.mp3') }}" type="audio/mpeg">
									Your browser does not support the audio tag.
								</audio>
							</div>
							<button type="button" class="btn btn-primary second-phase">Submit</button>
						</form>
					</div>
					<div class="dialog_box">
						<p>Tell me, what name shall I call you on this journey of the heart?</p>
						<!-- <p>Ah, [User's Name], a name that resonates with the stars! Now, let us discover when you were born under the celestial sky.</p> -->
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="third_phase pad_120 d-none" id="third-phase">
		<video autoplay muted loop id="myVideo">
			<source src="{{ asset('assets/front/soulmate-number/images/video-2.mp4') }}" type="video/mp4">
		</video>
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="date_reveal text-center">
						<h1>Life Path for <span class="showName"></span></h1>
						<h2>Date of birth <span class="showDob"></span></h2>
						<div class="datereveal_box">
							<div class="date_calculation">
								<div class="date_boxes">
									<span class="showMonth"></span>
									<span class="showMonthTwo"></span>
									<span class="showMonthTwo"></span>
								</div>
								<div class="date_boxes">
									<span class="showDate"></span>
									<span class="showDateTwo"></span>
									<span class="showDateTwo"></span>
								</div>
								<div class="date_boxes">
									<span class="showYear"></span>
									<span class="showYearTwo"></span>
									<span class="showYearThree"></span>
								</div>
							</div>
							<div class="datereveal">
								<span class="singleNumber"></span>
							</div>
						</div>
					</div>
					<div class="revealed_boxes text-center">
						<!-- <div class="rotate_text">
							<span>Text 1</span>
							<span>Text 2</span>
							<span>Text 3</span>
							<span>Text 4</span>
						</div> -->
						<h3 class="singleNumber"></h3>
					</div>
					<div class="dialog_box">
						<p>Let me weave the magic of numbers to reveal your Love Path Number... This number guides you on your romantic journey, showing your inclinations and compatibility.</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="fourth_phase pad_120 d-none" id="fourth-phase">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="love_life text-center">
						<video autoplay muted loop class="email_video">
							<source src="{{ asset('assets/front/soulmate-number/images/icon.mp4') }}" type="video/mp4">
						</video>
						<form action="">
							<div class="mb-4">
								<label class="form-label">Enter Your Full Birth Name</label>
								<?php /* <input type="text" class="form-control" id="text" name="text" onclick="firstName()"> */ ?>
								<input type="text" class="form-control" id="birth_name" name="text">
								<span id="birth_name_err" class="text-danger"></span>
							</div>
							<button type="button" class="btn btn-primary fourth-phase">Continue with my reading</button>
						</form>
						<audio id="secondaudio" autoplay>
							<source src="{{ asset('assets/front/soulmate-number/images/speech-2.mp3') }}" type="audio/mpeg">
							Your browser does not support the audio tag.
						</audio>
					</div>
					<div class="dialog_box">
						<p>To delve deeper into your romantic essence, I need your full name at birth. This will unlock your Heart's Desire and Love Destiny numbers.</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="first_phase pad_120 d-none" id="fifth-phase">
		<video autoplay muted loop id="myVideo">
			<source src="{{ asset('assets/front/soulmate-number/images/video-3.mp4') }}" type="video/mp4">
		</video>
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="letter_boxes">
						<div class="expression_letter">
							<span class="selected_1">1</span>
							<span class="selected_2">2</span>
							<span class="selected_3">3</span>
							<span class="selected_4">4</span>
							<span class="selected_5">5</span>
							<span class="selected_6">6</span>
							<span class="selected_7">7</span>
							<span class="selected_8">8</span>
							<span class="selected_9">9</span>
						</div>
						<div class="expression_letter">
							<span class="selected_a">A</span>
							<span class="selected_b">B</span>
							<span class="selected_c">C</span>
							<span class="selected_d">D</span>
							<span class="selected_e">E</span>
							<span class="selected_f">F</span>
							<span class="selected_g">G</span>
							<span class="selected_h">H</span>
							<span class="selected_i">I</span>
						</div>
						<div class="expression_letter">
							<span class="selected_j">J</span>
							<span class="selected_k">K</span>
							<span class="selected_l">L</span>
							<span class="selected_m">M</span>
							<span class="selected_n">N</span>
							<span class="selected_o">O</span>
							<span class="selected_p">P</span>
							<span class="selected_q">Q</span>
							<span class="selected_r">R</span>
						</div>
						<div class="expression_letter">
							<span class="selected_s">S</span>
							<span class="selected_t">T</span>
							<span class="selected_u">U</span>
							<span class="selected_v">V</span>
							<span class="selected_w">W</span>
							<span class="selected_x">X</span>
							<span class="selected_y">Y</span>
							<span class="selected_z">Z</span>
							<span>&nbsp;</span>
						</div>
					</div>
					<div class="reveal_boxed">
						<!-- <div class="reveal_letters">
							<span></span>
							<span>T</span>
							<span>1</span>
						</div>
						<div class="reveal_letters">
							<span>0</span>
							<span>E</span>
							<span></span>
						</div>
						<div class="reveal_letters">
							<span></span>
							<span>s</span>
							<span>1</span>
						</div>
						<div class="reveal_letters">
							<span></span>
							<span>L</span>
							<span>1</span>
						</div>
						<div class="reveal_letters">
							<span>0</span>
							<span>A</span>
							<span></span>
						</div> -->
					</div>
					<div class="reveal_letter text-center fifth-phase">
						<h3 class="name_digit"></h3>
					</div>
					<div class="dialog_box">
						<p>Now, let's uncover your Heart's Desire Number and Love Destiny Number. These numbers reveal your innermost desires and how you express love.</p>
						<p>Calculated from your full birth name by assigning numerical values to each letter and reducing them to a single.</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="tenth_phase pad_120  d-none" id="tenth-phase">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="love_life text-center">
						<form method="POST" id="payment-form">
							@csrf
							<div class="mb-4">
								<input id="form_name" name="name" type="hidden" value="">
								<input id="form_birth_name" name="birth_name" type="hidden" value="">
								<input id="form_dob" name="dob" type="hidden" value="">

								<label class="form-label">Enter Your Email</label>
								<input type="email" class="form-control emlOnly" id="email" name="email" placeholder="Enter your email" required>
								<span id="email_err" class="text-danger"></span>
							</div>
							<button type="button" class="btn btn-primary btnSubmit">Proceed</button>
						</form>
					</div>
					<div class="dialog_box">
						<p>You have glimpsed the essence of your romantic numbers, <span class="showName"></span>. To receive the full transcript of your reading and delve deeper into your romantic path, where shall I send it?</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="eleven_phase pad_120 d-none" id="eleven-phase">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="discover_more text-center">
						<img src="{{ asset('assets/front/soulmate-number/images/phase-10.webp') }}" alt="">
						<button class="btn btn-primary">Discover More Love Insights</button>
					</div>
					<div class="dialog_box">
						<p>Thank you for trusting me with your journey. Check your email for the complete reading and more love secrets!</p>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection

@push('scripts')
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
	<script type="text/javascript">
		var audio = document.getElementById("my_audio");
		function playAudio() {
			audio.play();
			// setTimeout(function () {
			//     $('#first-phase').hide;
			//     $('#second-phase').show;
			// }, 1300);
		}
		$('#datepicker').datepicker({
			uiLibrary: 'bootstrap5'
		});
		function firstName() {
			var audio = document.getElementById("secondaudio");
			audio.play();
		}
		function dateofBirth() {
			var audio = document.getElementById("thirdaudio");
			audio.play();
		}
		$(document).ready(function () {
			$('#playaudio').on('click', function(){
				$('#first-phase').addClass('d-none');
				$('#second-phase').removeClass('d-none');
			});

			$('.second-phase').on('click', function(){
				$('.form-control').removeClass('is-invalid');
				$('.text-danger').hide();
				var error = 0;
				if ($('#name').val() == '') {
					$('#name').addClass('is-invalid');
					$('#name_err').html('Please enter name');
					$('#name_err').show();
					error++;
				}
				if ($('.dob').val() == '') {
					$('.dob').addClass('is-invalid');
					$('#dob_err').html('Please enter Date of Birth');
					$('#dob_err').show();
					error++;
				}
				if (error > 0) {
					return false;
				}

				$('.showName').html($('#name').val())
				var dob = $('.dob').val();
				$('#form_name').val($('#name').val());
				$('#form_dob').val(dob);
				var formattedDate = formatDate(dob);
				$('.showDob').html(formattedDate)

				$('#second-phase').addClass('d-none');
				$('#third-phase').removeClass('d-none');

				setTimeout(function () {
					$('#third-phase').addClass('d-none');
					$('#fourth-phase').removeClass('d-none');
				}, 5000);
			});

			function formatDate(dateStr) {
				// Split the date string into components [mm, dd, yyyy]
				var dateParts = dateStr.split('/');
				// Get the month, day, and year
				var month = dateParts[0];
				var day = dateParts[1];
				var year = dateParts[2];
				// Convert the month to a full month name
				var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
				var monthName = monthNames[parseInt(month) - 1];
				// Return the formatted date
				$('.showMonth').html(monthName);
				var monthS = numberToSingleDigitSum(month);
				$('.showMonthTwo').html(monthS);
				$('.showDate').html(day);
				var dayS = numberToSingleDigitSum(day);
				$('.showDateTwo').html(dayS);
				$('.showYear').html(year);
				$('.showYearTwo').html(numberToTwoDigitSum(year));
				var yearS = numberToSingleDigitSum(year);
				$('.showYearThree').html(yearS);
				var totals = numberToSingleDigitSum(parseInt(monthS)+parseInt(dayS)+parseInt(yearS));
				$('.singleNumber').html(totals)
				return monthName + ' ' + day + ', ' + year;
			}

			// Function to calculate the two-digit sum number
			function numberToTwoDigitSum(num) {
				// Ensure that num is a positive integer
				num = Math.abs(num);
				// Sum the digits of the number
				while (num >= 100) {
					num = num.toString().split('').reduce(function(sum, digit) {
						return sum + parseInt(digit);
					}, 0);
				}
				// If the result is a single digit, ensure it is a two-digit number by adding a leading 0
				if (num < 10) {
					num = '0' + num; // Add leading zero for single digits
				}
				return num;
			}

			function numberToSingleDigitSum(num) {
				// Ensure that num is a positive integer
				num = Math.abs(num);
				// While the number has more than one digit
				while (num >= 10) {
					num = num.toString().split('').reduce(function(sum, digit) {
						return sum + parseInt(digit);
					}, 0);
				}
				return num;
			}

			$('.fourth-phase').on('click', function(){
				$('.form-control').removeClass('is-invalid');
				$('.text-danger').hide();
				var error = 0;
				if ($('#birth_name').val() == '') {
					$('#birth_name').addClass('is-invalid');
					$('#birth_name_err').html('Please enter birth name');
					$('#birth_name_err').show();
					error++;
				}
				if (error > 0) {
					return false;
				}

				var str = $('#birth_name').val();
				$('#form_birth_name').val(str);
				var nameDigit = nameToSingleDigit(str);
				$('.selected_'+nameDigit).addClass('selected');
				$('.name_digit').html(nameDigit);
				$.each(str.split(''), function(index, char) {
					var class_car = char.toLowerCase();  // Output each character to the console
					var show_car = char.toUpperCase();  // Output each character to the console
					$('.selected_'+class_car).addClass('selected');
					$('.reveal_boxed').append('<div class="reveal_letters"><span></span><span>'+show_car+'</span><span></span></div>');
				});

				$('#fourth-phase').addClass('d-none');
				$('#fifth-phase').removeClass('d-none');
			});

			function nameToSingleDigit(name) {
				// Step 1: Convert each character of the name to ASCII value and sum the digits
				var sum = 0;
				for (var i = 0; i < name.length; i++) {
					var charCode = name.charCodeAt(i); // Get the ASCII value of the character
					sum += charCode;
				}
				// Step 2: Reduce the sum to a single digit by repeatedly summing the digits
				while (sum >= 10) {
					sum = sum.toString().split('').reduce(function(acc, digit) {
						return acc + parseInt(digit);
					}, 0);
				}
				return sum;
			}
			
			$('.fifth-phase').on('click', function(){
				$('#fifth-phase').addClass('d-none');
				$('#tenth-phase').removeClass('d-none');
			});

			$(".emlOnly").keypress(function(e) {
				var key = e.key;
				var regex = /^[A-Za-z0-9\.\-\_\@]+$/;
				var isValid = regex.test(key);
				if (!isValid) {
					e.preventDefault();
				}
			});

			$('.emlOnly').on('focusout', function() {
				let fldid = $(this).attr('id');
				var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				if (!regex.test($('#' + fldid).val())) {
					$('#' + fldid).addClass('is-invalid');
					$('#' + fldid + '_err').html('Please enter valid email');
					$('#' + fldid + '_err').show();
				}
			});
			
			$('.tenth-phase').on('click', function(){
				$('.form-control').removeClass('is-invalid');
				$('.text-danger').hide();
				var error = 0;
				let fldid = 'email';
				var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				if (!regex.test($('#' + fldid).val())) {
					$('#' + fldid).addClass('is-invalid');
					$('#' + fldid + '_err').html('Please enter valid email');
					$('#' + fldid + '_err').show();
					error++;
				}
				if (error > 0) {
					return false;
				}
				$('.form-control').removeClass('is-invalid');
				$('.text-danger').hide();

				$('#tenth-phase').addClass('d-none');
				$('#eleven-phase').removeClass('d-none');
			});
		});

		$(document).on('click', '.btnSubmit', function(e) {
			e.preventDefault();
			$('.stLoading').show();
			// $('.btnSubmit').hide();
			// $('.btnSubmit').attr('disabled', true);
			toastr.remove();
			$('#errmsg').hide();
			var fd = new FormData($('#payment-form')[0]);
			console.log(fd);
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: "{{ route('postSoulmateNumber') }}",
				data: fd,
				processData: false,
				contentType: false,
				dataType: 'json',
				type: 'POST',
				success: function(res) {
					if (res.error == 3) {
						toastr.error(res.msz);
					}else{
						if (res.success == 1) {
							window.location.href = res.redirect_url;
						} else {
							 toastr.error('Something went wrong! Please try again.');
						}
					}
					// $('#'+btnid).prop('disabled', false);
				}
			});
		});

	</script>
@endpush
<?php /*
@php
	 $ads = getPageAds();
@endphp

@extends('front.layout.main')

@push('styles')
	 <link rel="stylesheet" href="{{ asset('assets/front/css/home.css?' . time()) }}">
@endpush

@section('content')
	 <div class="home-page-main">
		  <section class="section-main">
				<div class="main-home-heading">
					 <h1>Soulmate Number</h1>
					 <div class="div-heading-line"></div>
					 <div class="row">
					 <form method="POST" id="payment-form">
						  @csrf
						  <div class="col-md-12 col-12">
								<div class="my-1">
									 <div class="input-group">
										  <input class="form-control input-lg rounded-0" id="name" placeholder="Name" name="name" type="text" value="" required>
									 </div>
									 <div class="text-danger form-text error-msg" id="name_error">
									 </div>
								</div>
						  </div>
						  <div class="col-md-12 col-12">
								<div class="mb-1">
									 <div class="input-group">
										  <input class="form-control input-lg rounded-0" id="datepicker" placeholder="DOB" name="dob" type="text" value="" required>
									 </div>
									 <div class="text-danger form-text error-msg" id="email_error">
									 </div>
								</div>
						  </div>
						  <div class="col-12 text-center">
								<button class="btn btn-success btnSubmit"><span class="w-100">Submit</span></button>
						  </div>
					 </form>
					 </div>
				</div>
		  </section>
	 </div>
@endsection

@push('scripts')
	 <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	 <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
	 <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />

	 <script>
		  $('#datepicker').datepicker({
				uiLibrary: 'bootstrap5'
		  });
	 </script>
	 <script>
				$(document).on('click', '.btnSubmit', function(e) {
					 e.preventDefault();
					 $('.stLoading').show();
					 // $('.btnSubmit').hide();
					 // $('.btnSubmit').attr('disabled', true);
					 toastr.remove();
					 $('#errmsg').hide();
					 var fd = new FormData($('#payment-form')[0]);
					 console.log(fd);
					 $.ajax({
					 headers: {
						  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					 },
					 url: "{{ route('postSoulmateNumber') }}",
					 data: fd,
					 processData: false,
					 contentType: false,
					 dataType: 'json',
					 type: 'POST',
					 success: function(res) {
						  if (res.error == 3) {
								toastr.error(res.msz);
						  }else{
								alert(res.success);
								if (res.success == 1) {
									 window.location.href = res.redirect_url;
								} else {
									 toastr.error('Something went wrong! Please try again.');
								}
						  }
						  // $('#'+btnid).prop('disabled', false);
					 }
				});
		  });
 </script>
@endpush
*/ ?>