<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Funnel</title>
    <link rel="icon" href="{{ asset('assets/front/soulmate-number/new/images/favicon.png') }}" type="image/x-icon">
	<link rel="stylesheet" href="{{ asset('assets/bootstrap.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/bootstrap-datepicker.min.css') }}">
	<link href="{{ asset('assets/css2.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('assets/front/soulmate-number/new/css/style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

	<style>
		.skybgImg{ position: relative; background: none}
		.skyanimationbg{ min-height: 100vh; height: 100%; overflow: hidden; position: absolute; top: 0; left: 0; width: 100%; background-color: #0f042c; }
		.skyanimationbg::after{ content: ''; width: 100%; height: 100%; position: absolute;background: url({{ asset('assets/front/soulmate-number/images/mountain.png') }});     background-repeat: no-repeat;  background-position: bottom; background-size: contain;}
		.skyanimationbg .skystars { position: absolute; top: 0; left: 0; width: 1px; height: 1px; background: transparent;}
		.skyanimationbg #starsLayer1 { animation: animationStars 50s linear infinite; }
		.skyanimationbg #starsLayer2 { width: 2px; height: 2px; animation: animationStars 100s linear infinite; }
		.skyanimationbg #starsLayer3 { width: 3px; height: 3px; animation: animationStars 150s linear infinite; }
		.skyanimationbg .skystars::after { content: ""; position: absolute; top: 2000px; width: inherit; height: inherit; background: transparent;}

		@keyframes animationStars {
		from { transform: translateY(0); }
		to   { transform: translateY(-2000px); }
		}
	</style>
</head>

<body >



<div class="skybgImg">
	<div class="skyanimationbg">
		<div id="starsLayer1" class="skystars"></div>
		<div id="starsLayer2" class="skystars"></div>
		<div id="starsLayer3" class="skystars"></div>
	  </div>

	<label for="choose-file" class="choose-file" style="display: none;">
		Choose an Audio File
		<input type="file" id="choose-file">
	</label>

	<div class="animated_box" >
		@if (session()->has('success'))
                        <div class="alert alert-success text-center m-5">
                            @if(is_array(session('success')))
                                <ul>
                                    @foreach (session('success') as $message)
                                        <li>{{ $message }}</li>
                                    @endforeach
                                </ul>
                            @else
                                {{ session('success') }}
                            @endif
                        </div>
                    @endif
        <div class="energy animated">
			<div class="animated_boxImg ">
				<span style="--color:#A020F0;--radius:18px;--duration:2.5s;"></span>
				<span style="--color:#FFC0CB;--radius:13px;--duration:5s;"></span>
				<span style="--color:#191970;--radius:15px;--duration:7.5s;"></span>
			</div>
		</div>
	</div>
	<section class="first_phase pad_120" id="first-phase">
		<div class="container">

			<div class="row">
				<div class="col-lg-12">
					<div class="love_life text-center">
						<button class="button" onclick="playAudio()" id="playaudio">Romance Numerology Forecast</button>
						<audio id="my_audio" preload="none">
							<source src="{{ asset('assets/new_audio/intro.mp3') }}"
								type="audio/mpeg" >
							Your browser does not support the audio tag.
						</audio>
					</div>
					<div class="dialog_box d-none" id="dialog_box_1">
						<div class="dialog_buttons">
                            <div class="play_button d-none">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/play.png') }}" alt="">
							</div>
							<div class="pause_button ">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/pause.png') }}" alt="">
							</div>
							<div class="umnute_button">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/volume.png') }}" alt="">
							</div>
							<div class="mute_button d-none">
								<img src="{{ asset('assets/front/soulmate-number/new/images/mute.png') }}" alt="">
							</div>
						</div>
						<p id="dynamicText">Greetings, seeker of love!</p>
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
						<form action="">
							<div class="form_wrapper" id="namehide" style="width: 80%;">
								<label class="form-label">Your First Name</label>
								<input type="text" class="form-control" id="name" name="text">
								<span id="name_err" class="text-danger"></span>
								<audio id="secondaudio" preload="none">
									<source src="{{ asset('assets/new_audio/second_name.mp3') }}"
										type="audio/mpeg" >
									Your browser does not support the audio tag.
								</audio>
							</div>
							<div class="form_wrapper" id="nexthide">
								<button type="button" class="btn btn-primary nextdob">Next</button>
							</div>
							<div class="form_wrapper d-none" id="secondd" style="width: 80%;">
								<label class="form-label">Date of birth</label>
								<div class="date-input">
                                    <div class="d-flex">
                                        <label>Day</label>
                                        <div class="selectArrow">
                                            <select id="day" class="form-control"></select>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <label>Month</label>
                                        <div class="selectArrow">
                                            <select id="month" class="form-control"></select>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <label>Year</label>
                                        <div class="selectArrow">
                                            <select id="year" class="form-control"></select>
                                        </div>
                                    </div>
								</div>
								<span id="dob_err" class="text-danger"></span>
								<audio id="thirdaudio" preload="none">
									<source src="{{ asset('assets/new_audio/second_dob.mp3') }}"type="audio/mpeg">
									Your browser does not support the audio tag.
								</audio>
							</div>
							<div class="form_wrapper d-none" id="secondss">
								<button type="button" class="btn btn-primary" id="second-phase-button">Next</button>
							</div>
						</form>
					</div>
					<div class="dialog_box d-none" id="seconds">
						<p id="second_name">Tell me, what name shall I call you on this journey of the heart?</p>
						<p id="second_dob" class="d-none"><!-- Ah, [User's Name], --> A name that resonates with the
							stars!
							Now, let us discover when you were born under the celestial sky.</p>
                        <div class="dialog_buttons">
							<div class="play_button d-none">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/play.png') }}" alt="">
							</div>
							<div class="pause_button ">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/pause.png') }}" alt="">
							</div>
							<div class="umnute_button">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/volume.png') }}" alt="">
							</div>
							<div class="mute_button d-none">
								<img src="{{ asset('assets/front/soulmate-number/new/images/mute.png') }}" alt="">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
    <section class="second_new_phase pad_120 d-none" id="second-new-phase">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="love_life">
						<form action="">
							<div class="form_wrapper"  style="width: 80%;">
                                <div class="date-input">
                                    <div class="d-flex">
										<label class="form-label">Gender</label>
										<div class="selectArrow">
											<select name="gender" id="gender" class="form-control">
												<option value="male">Male</option>
												<option value="female">Female</option>
												<option value="others">Others</option>
											</select>
											<span id="gender_err" class="text-danger"></span>
										</div>
									</div>
                                    <div class="d-flex">
										<label class="form-label">Country</label>
										<div class="selectArrow">
											<select name="ethnicity" id="ethnicity" class="form-control">
                                                <option value="">Select a country</option>
                                                <option value="Afghanistan">Afghanistan</option>
                                                <option value="Albania">Albania</option>
                                                <option value="Algeria">Algeria</option>
                                                <option value="Andorra">Andorra</option>
                                                <option value="Angola">Angola</option>
                                                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                                <option value="Argentina">Argentina</option>
                                                <option value="Armenia">Armenia</option>
                                                <option value="Australia">Australia</option>
                                                <option value="Austria">Austria</option>
                                                <option value="Azerbaijan">Azerbaijan</option>
                                                <option value="Bahamas">Bahamas</option>
                                                <option value="Bahrain">Bahrain</option>
                                                <option value="Bangladesh">Bangladesh</option>
                                                <option value="Barbados">Barbados</option>
                                                <option value="Belarus">Belarus</option>
                                                <option value="Belgium">Belgium</option>
                                                <option value="Belize">Belize</option>
                                                <option value="Benin">Benin</option>
                                                <option value="Bhutan">Bhutan</option>
                                                <option value="Bolivia">Bolivia</option>
                                                <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                                <option value="Botswana">Botswana</option>
                                                <option value="Brazil">Brazil</option>
                                                <option value="Brunei">Brunei</option>
                                                <option value="Bulgaria">Bulgaria</option>
                                                <option value="Burkina Faso">Burkina Faso</option>
                                                <option value="Burundi">Burundi</option>
                                                <option value="Cabo Verde">Cabo Verde</option>
                                                <option value="Cambodia">Cambodia</option>
                                                <option value="Cameroon">Cameroon</option>
                                                <option value="Canada">Canada</option>
                                                <option value="Central African Republic">Central African Republic</option>
                                                <option value="Chad">Chad</option>
                                                <option value="Chile">Chile</option>
                                                <option value="China">China</option>
                                                <option value="Colombia">Colombia</option>
                                                <option value="Comoros">Comoros</option>
                                                <option value="Congo (Congo-Brazzaville)">Congo (Congo-Brazzaville)</option>
                                                <option value="Costa Rica">Costa Rica</option>
                                                <option value="Croatia">Croatia</option>
                                                <option value="Cuba">Cuba</option>
                                                <option value="Cyprus">Cyprus</option>
                                                <option value="Czech Republic">Czech Republic</option>
                                                <option value="Democratic Republic of the Congo">Democratic Republic of the Congo</option>
                                                <option value="Denmark">Denmark</option>
                                                <option value="Djibouti">Djibouti</option>
                                                <option value="Dominica">Dominica</option>
                                                <option value="Dominican Republic">Dominican Republic</option>
                                                <option value="Ecuador">Ecuador</option>
                                                <option value="Egypt">Egypt</option>
                                                <option value="El Salvador">El Salvador</option>
                                                <option value="Equatorial Guinea">Equatorial Guinea</option>
                                                <option value="Eritrea">Eritrea</option>
                                                <option value="Estonia">Estonia</option>
                                                <option value="Eswatini">Eswatini</option>
                                                <option value="Ethiopia">Ethiopia</option>
                                                <option value="Fiji">Fiji</option>
                                                <option value="Finland">Finland</option>
                                                <option value="France">France</option>
                                                <option value="Gabon">Gabon</option>
                                                <option value="Gambia">Gambia</option>
                                                <option value="Georgia">Georgia</option>
                                                <option value="Germany">Germany</option>
                                                <option value="Ghana">Ghana</option>
                                                <option value="Greece">Greece</option>
                                                <option value="Grenada">Grenada</option>
                                                <option value="Guatemala">Guatemala</option>
                                                <option value="Guinea">Guinea</option>
                                                <option value="Guinea-Bissau">Guinea-Bissau</option>
                                                <option value="Guyana">Guyana</option>
                                                <option value="Haiti">Haiti</option>
                                                <option value="Honduras">Honduras</option>
                                                <option value="Hungary">Hungary</option>
                                                <option value="Iceland">Iceland</option>
                                                <option value="India">India</option>
                                                <option value="Indonesia">Indonesia</option>
                                                <option value="Iran">Iran</option>
                                                <option value="Iraq">Iraq</option>
                                                <option value="Ireland">Ireland</option>
                                                <option value="Israel">Israel</option>
                                                <option value="Italy">Italy</option>
                                                <option value="Jamaica">Jamaica</option>
                                                <option value="Japan">Japan</option>
                                                <option value="Jordan">Jordan</option>
                                                <option value="Kazakhstan">Kazakhstan</option>
                                                <option value="Kenya">Kenya</option>
                                                <option value="Kiribati">Kiribati</option>
                                                <option value="Kuwait">Kuwait</option>
                                                <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                <option value="Laos">Laos</option>
                                                <option value="Latvia">Latvia</option>
                                                <option value="Lebanon">Lebanon</option>
                                                <option value="Lesotho">Lesotho</option>
                                                <option value="Liberia">Liberia</option>
                                                <option value="Libya">Libya</option>
                                                <option value="Liechtenstein">Liechtenstein</option>
                                                <option value="Lithuania">Lithuania</option>
                                                <option value="Luxembourg">Luxembourg</option>
                                                <option value="Madagascar">Madagascar</option>
                                                <option value="Malawi">Malawi</option>
                                                <option value="Malaysia">Malaysia</option>
                                                <option value="Maldives">Maldives</option>
                                                <option value="Mali">Mali</option>
                                                <option value="Malta">Malta</option>
                                                <option value="Marshall Islands">Marshall Islands</option>
                                                <option value="Mauritania">Mauritania</option>
                                                <option value="Mauritius">Mauritius</option>
                                                <option value="Mexico">Mexico</option>
                                                <option value="Micronesia">Micronesia</option>
                                                <option value="Moldova">Moldova</option>
                                                <option value="Monaco">Monaco</option>
                                                <option value="Mongolia">Mongolia</option>
                                                <option value="Montenegro">Montenegro</option>
                                                <option value="Morocco">Morocco</option>
                                                <option value="Mozambique">Mozambique</option>
                                                <option value="Myanmar (Burma)">Myanmar (Burma)</option>
                                                <option value="Namibia">Namibia</option>
                                                <option value="Nauru">Nauru</option>
                                                <option value="Nepal">Nepal</option>
                                                <option value="Netherlands">Netherlands</option>
                                                <option value="New Zealand">New Zealand</option>
                                                <option value="Nicaragua">Nicaragua</option>
                                                <option value="Niger">Niger</option>
                                                <option value="Nigeria">Nigeria</option>
                                                <option value="North Korea">North Korea</option>
                                                <option value="North Macedonia">North Macedonia</option>
                                                <option value="Norway">Norway</option>
                                                <option value="Oman">Oman</option>
                                                <option value="Pakistan">Pakistan</option>
                                                <option value="Palau">Palau</option>
                                                <option value="Palestine State">Palestine State</option>
                                                <option value="Panama">Panama</option>
                                                <option value="Papua New Guinea">Papua New Guinea</option>
                                                <option value="Paraguay">Paraguay</option>
                                                <option value="Peru">Peru</option>
                                                <option value="Philippines">Philippines</option>
                                                <option value="Poland">Poland</option>
                                                <option value="Portugal">Portugal</option>
                                                <option value="Qatar">Qatar</option>
                                                <option value="Romania">Romania</option>
                                                <option value="Russia">Russia</option>
                                                <option value="Rwanda">Rwanda</option>
                                                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                                <option value="Saint Lucia">Saint Lucia</option>
                                                <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                                <option value="Samoa">Samoa</option>
                                                <option value="San Marino">San Marino</option>
                                                <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                                <option value="Saudi Arabia">Saudi Arabia</option>
                                                <option value="Senegal">Senegal</option>
                                                <option value="Serbia">Serbia</option>
                                                <option value="Seychelles">Seychelles</option>
                                                <option value="Sierra Leone">Sierra Leone</option>
                                                <option value="Singapore">Singapore</option>
                                                <option value="Slovakia">Slovakia</option>
                                                <option value="Slovenia">Slovenia</option>
                                                <option value="Solomon Islands">Solomon Islands</option>
                                                <option value="Somalia">Somalia</option>
                                                <option value="South Africa">South Africa</option>
                                                <option value="South Korea">South Korea</option>
                                                <option value="South Sudan">South Sudan</option>
                                                <option value="Spain">Spain</option>
                                                <option value="Sri Lanka">Sri Lanka</option>
                                                <option value="Sudan">Sudan</option>
                                                <option value="Suriname">Suriname</option>
                                                <option value="Sweden">Sweden</option>
                                                <option value="Switzerland">Switzerland</option>
                                                <option value="Syria">Syria</option>
                                                <option value="Tajikistan">Tajikistan</option>
                                                <option value="Tanzania">Tanzania</option>
                                                <option value="Thailand">Thailand</option>
                                                <option value="Timor-Leste">Timor-Leste</option>
                                                <option value="Togo">Togo</option>
                                                <option value="Tonga">Tonga</option>
                                                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                                <option value="Tunisia">Tunisia</option>
                                                <option value="Turkey">Turkey</option>
                                                <option value="Turkmenistan">Turkmenistan</option>
                                                <option value="Tuvalu">Tuvalu</option>
                                                <option value="Uganda">Uganda</option>
                                                <option value="Ukraine">Ukraine</option>
                                                <option value="United Arab Emirates">United Arab Emirates</option>
                                                <option value="United Kingdom">United Kingdom</option>
                                                <option value="United States">United States</option>
                                                <option value="Uruguay">Uruguay</option>
                                                <option value="Uzbekistan">Uzbekistan</option>
                                                <option value="Vanuatu">Vanuatu</option>
                                                <option value="Vatican City">Vatican City</option>
                                                <option value="Venezuela">Venezuela</option>
                                                <option value="Vietnam">Vietnam</option>
                                                <option value="Yemen">Yemen</option>
                                                <option value="Zambia">Zambia</option>
                                                <option value="Zimbabwe">Zimbabwe</option>
											</select>
											<span id="ethnicity_err" class="text-danger"></span>
										</div>
									</div>
                                    <div class="d-flex">
										<label class="form-label">Gender of Interest</label>
										<div class="selectArrow">
										<select name="genderofinterest" id="genderofinterest" class="form-control">
												<option value="male">Male</option>
												<option value="female">Female</option>
												<option value="both">Both</option>
											</select>
											<span id="genderofinterest_err" class="text-danger"></span>
										</div>
									</div>
                                </div>

								<audio id="thirdaudionew" preload="none">
									<source src="{{ asset('assets/new_audio/news_phase_2.mp3') }}"
										type="audio/mpeg">
									Your browser does not support the audio tag.
								</audio>
							</div>
							<div class="form_wrapper" id="seconds_new">
								<button type="button" class="btn btn-primary" id="second-new-phase-button">Next</button>
							</div>
						</form>
					</div>
					<div class="dialog_box" id="seconds_new">

						<p>Before I calculate out your love path number, I will need a few more information to personalise your love reading</p>
                        <div class="dialog_buttons">
							<div class="play_button d-none">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/play.png') }}" alt="">
							</div>
							<div class="pause_button ">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/pause.png') }}" alt="">
							</div>
							<div class="umnute_button">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/volume.png') }}" alt="">
							</div>
							<div class="mute_button d-none">
								<img src="{{ asset('assets/front/soulmate-number/new/images/mute.png') }}" alt="">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="third_phase pad_120 d-none" id="third-phase">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="date_reveal text-center" id="singleno1">
						<h1>Life Path for <span class="showName"></span></h1>
						<h2>Date of birth <span class="showDob"></span></h2>
						<div class="datereveal_box">
							<div class="date_calculation">
								<div class="date_boxes append1"></div>
								<div class="date_boxes append2"></div>
								<div class="date_boxes append3"></div>
							</div>
							<div class="datereveal append4"></div>
						</div>
					</div>
					<div class="revealed_boxes text-center d-none" id="singleno2">
						<h3 class="singleNumber"></h3>
					</div>
					<div class="dialog_box">
						<p>Let me weave the magic of numbers to reveal your Love Path Number—a powerful guide written in the stars just for you. This unique number unveils the natural patterns of your heart, revealing your deepest romantic tendencies, emotional strengths, and the kind of love that truly fulfills you. It also holds clues to your ideal partner and compatibility, helping you understand the kind of connection your soul is destined to seek.</p>

                        <div class="dialog_buttons">
							<div class="play_button d-none">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/play.png') }}" alt="">
							</div>
							<div class="pause_button ">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/pause.png') }}" alt="">
							</div>
							<div class="umnute_button">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/volume.png') }}" alt="">
							</div>
							<div class="mute_button d-none">
								<img src="{{ asset('assets/front/soulmate-number/new/images/mute.png') }}" alt="">
							</div>
						</div>
					</div>
					<audio id="fouraudio" preload="none">
						<source src="{{ asset('assets/new_audio/lovepathnumbers.mp3') }}" type="audio/mpeg">
						Your browser does not support the audio tag.
					</audio>
				</div>
			</div>
		</div>
	</section>
	<section class="third_phase image_phase pad_120 d-none" id="third-phase_new">
		<div class="imagesNumberSection">
			<div class="fadeImagesContainer">
				<div class="fadeImagesBackground">
					<img src="{{ asset('assets/front/soulmate-number/new/images/image-border.png') }}" alt="">
				</div>
				<div class="fadeImagesContent">
					<img src="{{ asset('assets/front/soulmate-number/new/images/couple1.jpg') }}" class="fadeImages" alt="Image 1">
					<img src="{{ asset('assets/front/soulmate-number/new/images/couple2.jpg') }}" class="fadeImages" alt="Image 2">
					<img src="{{ asset('assets/front/soulmate-number/new/images/couple3.jpg') }}" class="fadeImages" alt="Image 3">
					<img src="{{ asset('assets/front/soulmate-number/new/images/couple4.jpg') }}" class="fadeImages" alt="Image 3">
					<img src="{{ asset('assets/front/soulmate-number/new/images/couple5.jpg') }}" class="fadeImages" alt="Image 3">
				</div>
			</div>
			<div class="floatingNumber">
				<div class="centerNumber">
					<p></p>
					<img src="{{ asset('assets/front/soulmate-number/new/images/image-border.png') }}" alt="">
				</div>
				<div class="floatingNumberSection"></div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="dialog_box d-none" id="number_1">
                        <p>Ah, my dear one, your Love Path Number is 1.</p>
                            <div class="dialog_buttons">
                                <div class="play_button d-none">
                                    <img  src="{{ asset('assets/front/soulmate-number/new/images/play.png') }}" alt="">
                                </div>
                                <div class="pause_button ">
                                    <img  src="{{ asset('assets/front/soulmate-number/new/images/pause.png') }}" alt="">
                                </div>
                                <div class="umnute_button">
                                    <img  src="{{ asset('assets/front/soulmate-number/new/images/volume.png') }}" alt="">
                                </div>
                                <div class="mute_button d-none">
                                    <img src="{{ asset('assets/front/soulmate-number/new/images/mute.png') }}" alt="">
                                </div>
                            </div>
					</div>
					<div class="dialog_box d-none" id="number_2">
						<p>Ah, my dear one, your Love Path Number is 2.</p>
                            <div class="dialog_buttons">
                                <div class="play_button d-none">
                                    <img  src="{{ asset('assets/front/soulmate-number/new/images/play.png') }}" alt="">
                                </div>
                                <div class="pause_button ">
                                    <img  src="{{ asset('assets/front/soulmate-number/new/images/pause.png') }}" alt="">
                                </div>
                                <div class="umnute_button">
                                    <img  src="{{ asset('assets/front/soulmate-number/new/images/volume.png') }}" alt="">
                                </div>
                                <div class="mute_button d-none">
                                    <img src="{{ asset('assets/front/soulmate-number/new/images/mute.png') }}" alt="">
                                </div>
                            </div>
					</div>
					<div class="dialog_box d-none" id="number_3">
                        <p>Ah, my dear one, your Love Path Number is 3.</p>
                            <div class="dialog_buttons">
                                <div class="play_button d-none">
                                    <img  src="{{ asset('assets/front/soulmate-number/new/images/play.png') }}" alt="">
                                </div>
                                <div class="pause_button ">
                                    <img  src="{{ asset('assets/front/soulmate-number/new/images/pause.png') }}" alt="">
                                </div>
                                <div class="umnute_button">
                                    <img  src="{{ asset('assets/front/soulmate-number/new/images/volume.png') }}" alt="">
                                </div>
                                <div class="mute_button d-none">
                                    <img src="{{ asset('assets/front/soulmate-number/new/images/mute.png') }}" alt="">
                                </div>
                            </div>
					</div>
					<div class="dialog_box d-none" id="number_4">
                        <p>Ah, my dear one, your Love Path Number is 4.</p>
                            <div class="dialog_buttons">
                                <div class="play_button d-none">
                                    <img  src="{{ asset('assets/front/soulmate-number/new/images/play.png') }}" alt="">
                                </div>
                                <div class="pause_button ">
                                    <img  src="{{ asset('assets/front/soulmate-number/new/images/pause.png') }}" alt="">
                                </div>
                                <div class="umnute_button">
                                    <img  src="{{ asset('assets/front/soulmate-number/new/images/volume.png') }}" alt="">
                                </div>
                                <div class="mute_button d-none">
                                    <img src="{{ asset('assets/front/soulmate-number/new/images/mute.png') }}" alt="">
                                </div>
                            </div>
					</div>
					<div class="dialog_box d-none" id="number_5">
                        <p>Ah, my dear one, your Love Path Number is 5.</p>
                            <div class="dialog_buttons">
                                <div class="play_button d-none">
                                    <img  src="{{ asset('assets/front/soulmate-number/new/images/play.png') }}" alt="">
                                </div>
                                <div class="pause_button ">
                                    <img  src="{{ asset('assets/front/soulmate-number/new/images/pause.png') }}" alt="">
                                </div>
                                <div class="umnute_button">
                                    <img  src="{{ asset('assets/front/soulmate-number/new/images/volume.png') }}" alt="">
                                </div>
                                <div class="mute_button d-none">
                                    <img src="{{ asset('assets/front/soulmate-number/new/images/mute.png') }}" alt="">
                                </div>
                            </div>
					</div>
					<div class="dialog_box d-none" id="number_6">
                        <p>Ah, my dear one, your Love Path Number is 6.</p>
                            <div class="dialog_buttons">
                                <div class="play_button d-none">
                                    <img  src="{{ asset('assets/front/soulmate-number/new/images/play.png') }}" alt="">
                                </div>
                                <div class="pause_button ">
                                    <img  src="{{ asset('assets/front/soulmate-number/new/images/pause.png') }}" alt="">
                                </div>
                                <div class="umnute_button">
                                    <img  src="{{ asset('assets/front/soulmate-number/new/images/volume.png') }}" alt="">
                                </div>
                                <div class="mute_button d-none">
                                    <img src="{{ asset('assets/front/soulmate-number/new/images/mute.png') }}" alt="">
                                </div>
                            </div>
					</div>
					<div class="dialog_box d-none" id="number_7">
                        <p>Ah, my dear one, your Love Path Number is 7.</p>
                            <div class="dialog_buttons">
                                <div class="play_button d-none">
                                    <img  src="{{ asset('assets/front/soulmate-number/new/images/play.png') }}" alt="">
                                </div>
                                <div class="pause_button ">
                                    <img  src="{{ asset('assets/front/soulmate-number/new/images/pause.png') }}" alt="">
                                </div>
                                <div class="umnute_button">
                                    <img  src="{{ asset('assets/front/soulmate-number/new/images/volume.png') }}" alt="">
                                </div>
                                <div class="mute_button d-none">
                                    <img src="{{ asset('assets/front/soulmate-number/new/images/mute.png') }}" alt="">
                                </div>
                            </div>
					</div>
					<div class="dialog_box d-none" id="number_8">
                        <p>Ah, my dear one, your Love Path Number is 8.</p>
                            <div class="dialog_buttons">
                                <div class="play_button d-none">
                                    <img  src="{{ asset('assets/front/soulmate-number/new/images/play.png') }}" alt="">
                                </div>
                                <div class="pause_button ">
                                    <img  src="{{ asset('assets/front/soulmate-number/new/images/pause.png') }}" alt="">
                                </div>
                                <div class="umnute_button">
                                    <img  src="{{ asset('assets/front/soulmate-number/new/images/volume.png') }}" alt="">
                                </div>
                                <div class="mute_button d-none">
                                    <img src="{{ asset('assets/front/soulmate-number/new/images/mute.png') }}" alt="">
                                </div>
                            </div>
					</div>
					<div class="dialog_box d-none" id="number_9">
                        <p>Ah, my dear one, your Love Path Number is 9.</p>
                            <div class="dialog_buttons">
                                <div class="play_button d-none">
                                    <img  src="{{ asset('assets/front/soulmate-number/new/images/play.png') }}" alt="">
                                </div>
                                <div class="pause_button ">
                                    <img  src="{{ asset('assets/front/soulmate-number/new/images/pause.png') }}" alt="">
                                </div>
                                <div class="umnute_button">
                                    <img  src="{{ asset('assets/front/soulmate-number/new/images/volume.png') }}" alt="">
                                </div>
                                <div class="mute_button d-none">
                                    <img src="{{ asset('assets/front/soulmate-number/new/images/mute.png') }}" alt="">
                                </div>
                            </div>
					</div>
                            <div class="skipbutton3"  onclick="skip()">
								Skip
							</div>

					<audio id="audio_1" preload="none">
						<source src="{{ asset('assets/new_audio/lovenumberone.mp3') }}" type="audio/mpeg">
						Your browser does not support the audio tag.
					</audio>
					<audio id="audio_2" preload="none">
						<source src="{{ asset('assets/new_audio/lovenumbertwo.mp3') }}" type="audio/mpeg">
						Your browser does not support the audio tag.
					</audio>
					<audio id="audio_3" preload="none">
						<source src="{{ asset('assets/new_audio/lovenumberthree.mp3') }}" type="audio/mpeg">
						Your browser does not support the audio tag.
					</audio>
					<audio id="audio_4"     preload="none">
						<source src="{{ asset('assets/new_audio/lovenumberfour.mp3') }}" type="audio/mpeg">
						Your browser does not support the audio tag.
					</audio>
					<audio id="audio_5" preload="none">
						<source src="{{ asset('assets/new_audio/lovenumberfive.mp3') }}" type="audio/mpeg">
						Your browser does not support the audio tag.
					</audio>
					<audio id="audio_6" preload="none">
						<source src="{{ asset('assets/new_audio/lovenumbersixe.mp3') }}" type="audio/mpeg">
						Your browser does not support the audio tag.
					</audio>
					<audio id="audio_7" preload="none">
						<source src="{{ asset('assets/new_audio/lovenumberseven.mp3') }}" type="audio/mpeg">
						Your browser does not support the audio tag.
					</audio>
					<audio id="audio_8" preload="none">
						<source src="{{ asset('assets/new_audio/lovenumbereight.mp3') }}" type="audio/mpeg">
						Your browser does not support the audio tag.
					</audio>
					<audio id="audio_9" preload="none">
						<source src="{{ asset('assets/new_audio/lovenumbernine.mp3') }}" type="audio/mpeg">
						Your browser does not support the audio tag.
					</audio>
				</div>
			</div>
		</div>
	</section>
	<section class="fourth_phase pad_50 d-none" id="fourth-phase">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">

					<div class="date_reveal text-center" >
                        <h1>Enter your full birth name to reveal both your heart's desire and love destiny number </h1>
					</div>
					<div class="love_life text-center">
						<video autoplay muted loop class="email_video">
							<source src="{{ asset('assets/front/soulmate-number/new/images/icon.mp4') }}"
								type="video/mp4">
						</video>
						<form action="">
							<div class="form_wrapper" style="width: 51%;">
								<label class="form-label">Enter Your Full Birth Name</label>
								<input type="text" class="form-control" id="birth_name" name="text"
									onclick="fullName()">
								<span id="birth_name_err" class="text-danger"></span>
							</div>
							<div class="form_wrapper" id="forubuton">
								<button type="button" class="btn btn-primary fourth-phase">Continue with my
									reading</button>
							</div>
						</form>
						<audio id="fiveaudio" preload="none">
							<source src="{{ asset('assets/new_audio/heartandlovenumber.mp3') }}" type="audio/mpeg">
							Your browser does not support the audio tag.
						</audio>
					</div>
					<div class="dialog_box d-none" id="fivetext">
						<span>To delve deeper into your romantic essence, I need your full name at birth. This will unlock
							your
							Heart's Desire and Love Destiny numbers.</span>

                        <div class="dialog_buttons">
							<div class="play_button d-none">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/play.png') }}" alt="">
							</div>
							<div class="pause_button ">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/pause.png') }}" alt="">
							</div>
							<div class="umnute_button">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/volume.png') }}" alt="">
							</div>
							<div class="mute_button d-none">
								<img src="{{ asset('assets/front/soulmate-number/new/images/mute.png') }}" alt="">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="pad_50 d-none" id="fifth-phase">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="letter_boxes" id="heart_desier_number">
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
					<div class="reveal_boxed_parent"></div>
                    <div class="reveal_boxed_show_calculation_parent"></div>
					<div class="dialog_box">

						<p>Now, let's uncover your Heart's Desire Number. These numbers reveal your innermost desires and how you express love.</p>
						<!-- <p>Calculated from your full birth name by assigning numerical values to each letter and reducing them to a single.</p> -->
                        <div class="dialog_buttons">
							<div class="play_button d-none">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/play.png') }}" alt="">
							</div>
							<div class="pause_button ">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/pause.png') }}" alt="">
							</div>
							<div class="umnute_button">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/volume.png') }}" alt="">
							</div>
							<div class="mute_button d-none">
								<img src="{{ asset('assets/front/soulmate-number/new/images/mute.png') }}" alt="">
							</div>
						</div>
					</div>
					<audio id="sixaudio"    preload="none">
						<source src="{{ asset('assets/new_audio/heartandlovenumbers.mp3') }}" type="audio/mpeg">
						Your browser does not support the audio tag.
					</audio>
				</div>
			</div>
		</div>
	</section>
	<section class="pad_120 d-none" id="fifth-phase_new">
        {{-- <div class="floatingNumber" id="heart_destiny_number_float_5"></div> --}}
		<div class="floatingNumber">
			<div class="floatingNumberSection"></div>
		</div>
		<div class="fadeImagesContainer">
            <div class="fadeImagesBackground">
                <img src="{{ asset('assets/front/soulmate-number/new/images/image-border.png') }}" alt="">
            </div>
            <div class="fadeImagesContent">
                <img src="{{ asset('assets/front/soulmate-number/new/images/couple6.webp') }}" class="fadeImages" alt="Image 1">
                <img src="{{ asset('assets/front/soulmate-number/new/images/couple7.webp') }}" class="fadeImages" alt="Image 2">
                <img src="{{ asset('assets/front/soulmate-number/new/images/couple8.webp') }}" class="fadeImages" alt="Image 3">
                <img src="{{ asset('assets/front/soulmate-number/new/images/couple9.webp') }}" class="fadeImages" alt="Image 3">
                <img src="{{ asset('assets/front/soulmate-number/new/images/couple10.webp') }}" class="fadeImages" alt="Image 3">
            </div>
        </div>
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="dialog_box d-none" id="numbers_1">
						<p></p>
                        <div class="dialog_buttons">
							<div class="play_button d-none">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/play.png') }}" alt="">
							</div>
							<div class="pause_button ">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/pause.png') }}" alt="">
							</div>
							<div class="umnute_button">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/volume.png') }}" alt="">
							</div>
							<div class="mute_button d-none">
								<img src="{{ asset('assets/front/soulmate-number/new/images/mute.png') }}" alt="">
							</div>
						</div>
                    </div>
					<div class="dialog_box d-none" id="numbers_2">
						<p></p>
                        <div class="dialog_buttons">
							<div class="play_button d-none">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/play.png') }}" alt="">
							</div>
							<div class="pause_button ">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/pause.png') }}" alt="">
							</div>
							<div class="umnute_button">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/volume.png') }}" alt="">
							</div>
							<div class="mute_button d-none">
								<img src="{{ asset('assets/front/soulmate-number/new/images/mute.png') }}" alt="">
							</div>
						</div>
					</div>
					<div class="dialog_box d-none" id="numbers_3">
						<p></p>
                        <div class="dialog_buttons">
							<div class="play_button d-none">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/play.png') }}" alt="">
							</div>
							<div class="pause_button ">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/pause.png') }}" alt="">
							</div>
							<div class="umnute_button">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/volume.png') }}" alt="">
							</div>
							<div class="mute_button d-none">
								<img src="{{ asset('assets/front/soulmate-number/new/images/mute.png') }}" alt="">
							</div>
						</div>
                    </div>
					<div class="dialog_box d-none" id="numbers_4">
						<p></p>
                        <div class="dialog_buttons">
							<div class="play_button d-none">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/play.png') }}" alt="">
							</div>
							<div class="pause_button ">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/pause.png') }}" alt="">
							</div>
							<div class="umnute_button">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/volume.png') }}" alt="">
							</div>
							<div class="mute_button d-none">
								<img src="{{ asset('assets/front/soulmate-number/new/images/mute.png') }}" alt="">
							</div>
						</div>
                    </div>
					<div class="dialog_box d-none" id="numbers_5">
						<p></p>
                        <div class="dialog_buttons">
							<div class="play_button d-none">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/play.png') }}" alt="">
							</div>
							<div class="pause_button ">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/pause.png') }}" alt="">
							</div>
							<div class="umnute_button">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/volume.png') }}" alt="">
							</div>
							<div class="mute_button d-none">
								<img src="{{ asset('assets/front/soulmate-number/new/images/mute.png') }}" alt="">
							</div>
						</div>
                    </div>
					<div class="dialog_box d-none" id="numbers_6">
						<p></p>
                        <div class="dialog_buttons">
							<div class="play_button d-none">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/play.png') }}" alt="">
							</div>
							<div class="pause_button ">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/pause.png') }}" alt="">
							</div>
							<div class="umnute_button">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/volume.png') }}" alt="">
							</div>
							<div class="mute_button d-none">
								<img src="{{ asset('assets/front/soulmate-number/new/images/mute.png') }}" alt="">
							</div>
						</div>
                    </div>
					<div class="dialog_box d-none" id="numbers_7">
						<p></p>
                        <div class="dialog_buttons">
							<div class="play_button d-none">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/play.png') }}" alt="">
							</div>
							<div class="pause_button ">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/pause.png') }}" alt="">
							</div>
							<div class="umnute_button">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/volume.png') }}" alt="">
							</div>
							<div class="mute_button d-none">
								<img src="{{ asset('assets/front/soulmate-number/new/images/mute.png') }}" alt="">
							</div>
						</div>
                    </div>
					<div class="dialog_box d-none" id="numbers_8">
						<p></p>
                        <div class="dialog_buttons">
							<div class="play_button d-none">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/play.png') }}" alt="">
							</div>
							<div class="pause_button ">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/pause.png') }}" alt="">
							</div>
							<div class="umnute_button">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/volume.png') }}" alt="">
							</div>
							<div class="mute_button d-none">
								<img src="{{ asset('assets/front/soulmate-number/new/images/mute.png') }}" alt="">
							</div>
						</div>
                    </div>
					<div class="dialog_box d-none" id="numbers_9">
						<p></p>
                        <div class="dialog_buttons">
							<div class="play_button d-none">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/play.png') }}" alt="">
							</div>
							<div class="pause_button ">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/pause.png') }}" alt="">
							</div>
							<div class="umnute_button">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/volume.png') }}" alt="">
							</div>
							<div class="mute_button d-none">
								<img src="{{ asset('assets/front/soulmate-number/new/images/mute.png') }}" alt="">
							</div>
						</div>
                    </div>
					<audio id="audios_1" preload="none">
						<source src="{{ asset('audio/h1.mp3') }}" type="audio/mpeg">
						Your browser does not support the audio tag.
					</audio>
					<audio id="audios_2" preload="none">
						<source src="{{ asset('audio/h2.mp3') }}" type="audio/mpeg">
						Your browser does not support the audio tag.
					</audio>
					<audio id="audios_3" preload="none">
						<source src="{{ asset('audio/h3.mp3') }}" type="audio/mpeg">
						Your browser does not support the audio tag.
					</audio>
					<audio id="audios_4" preload="none">
						<source src="{{ asset('audio/h4.mp3') }}" type="audio/mpeg">
						Your browser does not support the audio tag.
					</audio>
					<audio id="audios_5" preload="none">
						<source src="{{ asset('audio/h5.mp3') }}" type="audio/mpeg">
						Your browser does not support the audio tag.
					</audio>
					<audio id="audios_6" preload="none">
						<source src="{{ asset('audio/h6.mp3') }}" type="audio/mpeg">
						Your browser does not support the audio tag.
					</audio>
					<audio id="audios_7" preload="none">
						<source src="{{ asset('audio/h7.mp3') }}" type="audio/mpeg">
						Your browser does not support the audio tag.
					</audio>
					<audio id="audios_8" preload="none">
						<source src="{{ asset('audio/h8.mp3') }}" type="audio/mpeg">
						Your browser does not support the audio tag.
					</audio>
					<audio id="audios_9" preload="none">
						<source src="{{ asset('audio/h9.mp3') }}" type="audio/mpeg">
						Your browser does not support the audio tag.
					</audio>

				</div>
                <button class="skipbutton5">Skip</button>
			</div>
		</div>
	</section>
    <section class="pad_50 d-none" id="sixsith-phase">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="letter_boxes" id="love_destiny_number">
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
					<div class="reveal_boxed_parent_love"></div>
                    <div class="reveal_boxed_show_calculation_parent_love"></div>
					<div class="dialog_box" id="sevenaudiotext">
						<p> Now, let’s uncover your Love Destiny Number—a powerful vibration that whispers the truth about your soul’s romantic purpose.</p>
                        <div class="dialog_buttons">
							<div class="play_button d-none">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/play.png') }}" alt="">
							</div>
							<div class="pause_button ">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/pause.png') }}" alt="">
							</div>
							<div class="umnute_button">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/volume.png') }}" alt="">
							</div>
							<div class="mute_button d-none">
								<img src="{{ asset('assets/front/soulmate-number/new/images/mute.png') }}" alt="">
							</div>
						</div>
                    </div>
					<audio id="sevenaudio" preload="none">
						<source src="{{ asset('assets/new_audio/lovedestinynumbers.mp3') }}" type="audio/mpeg">
						Your browser does not support the audio tag.
					</audio>
				</div>
			</div>
		</div>
	</section>
	<section class="pad_120 d-none" id="sixsith-phase_new">
        {{-- <div class="floatingNumber" id="love_destiny_number_float_5"></div> --}}
		<div class="floatingNumber">
			<div class="floatingNumberSection"></div>
		</div>
        <div class="fadeImagesContainer">
            <div class="fadeImagesBackground">
                <img src="{{ asset('assets/front/soulmate-number/new/images/image-border.png') }}" alt="">
            </div>
            <div class="fadeImagesContent">
                <img src="{{ asset('assets/front/soulmate-number/new/images/couple11.webp') }}" class="fadeImages" alt="Image 1">
                <img src="{{ asset('assets/front/soulmate-number/new/images/couple12.webp') }}" class="fadeImages" alt="Image 2">
                <img src="{{ asset('assets/front/soulmate-number/new/images/couple13.webp') }}" class="fadeImages" alt="Image 3">
                <img src="{{ asset('assets/front/soulmate-number/new/images/couple14.webp') }}" class="fadeImages" alt="Image 3">
                <img src="{{ asset('assets/front/soulmate-number/new/images/couple15.webp') }}" class="fadeImages" alt="Image 3">
            </div>
        </div>
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="dialog_box d-none" id="lovenumbers_1">
						<p></p>
                        <div class="dialog_buttons">
							<div class="play_button d-none">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/play.png') }}" alt="">
							</div>
							<div class="pause_button ">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/pause.png') }}" alt="">
							</div>
							<div class="umnute_button">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/volume.png') }}" alt="">
							</div>
							<div class="mute_button d-none">
								<img src="{{ asset('assets/front/soulmate-number/new/images/mute.png') }}" alt="">
							</div>
						</div>
                    </div>
					<div class="dialog_box d-none" id="lovenumbers_2">
						<p></p>
                        <div class="dialog_buttons">
							<div class="play_button d-none">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/play.png') }}" alt="">
							</div>
							<div class="pause_button ">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/pause.png') }}" alt="">
							</div>
							<div class="umnute_button">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/volume.png') }}" alt="">
							</div>
							<div class="mute_button d-none">
								<img src="{{ asset('assets/front/soulmate-number/new/images/mute.png') }}" alt="">
							</div>
						</div>
                    </div>
					<div class="dialog_box d-none" id="lovenumbers_3">
						<p></p>
                        <div class="dialog_buttons">
							<div class="play_button d-none">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/play.png') }}" alt="">
							</div>
							<div class="pause_button ">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/pause.png') }}" alt="">
							</div>
							<div class="umnute_button">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/volume.png') }}" alt="">
							</div>
							<div class="mute_button d-none">
								<img src="{{ asset('assets/front/soulmate-number/new/images/mute.png') }}" alt="">
							</div>
						</div>
                    </div>
					<div class="dialog_box d-none" id="lovenumbers_4">
						<p></p>
                        <div class="dialog_buttons">
							<div class="play_button d-none">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/play.png') }}" alt="">
							</div>
							<div class="pause_button ">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/pause.png') }}" alt="">
							</div>
							<div class="umnute_button">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/volume.png') }}" alt="">
							</div>
							<div class="mute_button d-none">
								<img src="{{ asset('assets/front/soulmate-number/new/images/mute.png') }}" alt="">
							</div>
						</div>
                    </div>
					<div class="dialog_box d-none" id="lovenumbers_5">
						<p></p>
                        <div class="dialog_buttons">
							<div class="play_button d-none">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/play.png') }}" alt="">
							</div>
							<div class="pause_button ">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/pause.png') }}" alt="">
							</div>
							<div class="umnute_button">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/volume.png') }}" alt="">
							</div>
							<div class="mute_button d-none">
								<img src="{{ asset('assets/front/soulmate-number/new/images/mute.png') }}" alt="">
							</div>
						</div>
                    </div>
					<div class="dialog_box d-none" id="lovenumbers_6">
						<p></p>
                        <div class="dialog_buttons">
							<div class="play_button d-none">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/play.png') }}" alt="">
							</div>
							<div class="pause_button ">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/pause.png') }}" alt="">
							</div>
							<div class="umnute_button">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/volume.png') }}" alt="">
							</div>
							<div class="mute_button d-none">
								<img src="{{ asset('assets/front/soulmate-number/new/images/mute.png') }}" alt="">
							</div>
						</div>
                    </div>
					<div class="dialog_box d-none" id="lovenumbers_7">
						<p></p>
                        <div class="dialog_buttons">
							<div class="play_button d-none">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/play.png') }}" alt="">
							</div>
							<div class="pause_button ">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/pause.png') }}" alt="">
							</div>
							<div class="umnute_button">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/volume.png') }}" alt="">
							</div>
							<div class="mute_button d-none">
								<img src="{{ asset('assets/front/soulmate-number/new/images/mute.png') }}" alt="">
							</div>
						</div>
                    </div>
					<div class="dialog_box d-none" id="lovenumbers_8">
						<p></p>
                        <div class="dialog_buttons">
							<div class="play_button d-none">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/play.png') }}" alt="">
							</div>
							<div class="pause_button ">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/pause.png') }}" alt="">
							</div>
							<div class="umnute_button">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/volume.png') }}" alt="">
							</div>
							<div class="mute_button d-none">
								<img src="{{ asset('assets/front/soulmate-number/new/images/mute.png') }}" alt="">
							</div>
						</div>
                    </div>
					<div class="dialog_box d-none" id="lovenumbers_9">
						<p></p>
                        <div class="dialog_buttons">
							<div class="play_button d-none">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/play.png') }}" alt="">
							</div>
							<div class="pause_button ">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/pause.png') }}" alt="">
							</div>
							<div class="umnute_button">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/volume.png') }}" alt="">
							</div>
							<div class="mute_button d-none">
								<img src="{{ asset('assets/front/soulmate-number/new/images/mute.png') }}" alt="">
							</div>
						</div>
                    </div>
					<audio id="loveaudios_1" preload="none">
						<source src="{{ asset('audio/ldn1.mp3') }}" type="audio/mpeg">
						Your browser does not support the audio tag.
					</audio>
					<audio id="loveaudios_2" preload="none">
						<source src="{{ asset('audio/ldn2.mp3') }}" type="audio/mpeg">
						Your browser does not support the audio tag.
					</audio>
					<audio id="loveaudios_3" preload="none">
						<source src="{{ asset('audio/ldn3.mp3') }}" type="audio/mpeg">
						Your browser does not support the audio tag.
					</audio>
					<audio id="loveaudios_4" preload="none">
						<source src="{{ asset('audio/ldn4.mp3') }}" type="audio/mpeg">
						Your browser does not support the audio tag.
					</audio>
					<audio id="loveaudios_5" preload="none">
						<source src="{{ asset('audio/ldn5.mp3') }}" type="audio/mpeg">
						Your browser does not support the audio tag.
					</audio>
					<audio id="loveaudios_6" preload="none">
						<source src="{{ asset('audio/ldn6.mp3') }}" type="audio/mpeg">
						Your browser does not support the audio tag.
					</audio>
					<audio id="loveaudios_7" preload="none">
						<source src="{{ asset('audio/ldn7.mp3') }}" type="audio/mpeg">
						Your browser does not support the audio tag.
					</audio>
					<audio id="loveaudios_8" preload="none">
						<source src="{{ asset('audio/ldn8.mp3') }}" type="audio/mpeg">
						Your browser does not support the audio tag.
					</audio>
					<audio id="loveaudios_9" preload="none">
						<source src="{{ asset('audio/ldn9.mp3') }}" type="audio/mpeg">
						Your browser does not support the audio tag.
					</audio>
                    <button class="skipbutton6">Skip</button>
				</div>
			</div>
		</div>
	</section>
	<section class="tenth_phase pad_120 d-none" id="tenth-phase">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="love_life text-center">
						<div class="emailSection">
							<div class="form_wrapper">
								<label class="form-label">Enter Your Email</label>
								<input type="email" class="form-control emlOnly" id="email" name="email">
								<span id="email_err" class="text-danger"></span>
							</div>
							<div class="form_wrapper form_wrapper_Button" id="tenth_button">
								<button type="button" class="btn btn-primary btnSubmit" onclick="emails()">Proceed</button>
							</div>
						</div>
					<div class="dialog_box" id="tenth-text">
						<span>You have glimpsed the essence of your romantic numbers, <span class="showName"></span>. To
							receive the full transcript of your reading and delve deeper into your romantic path, where
							shall I send it?</span>
                        <div class="dialog_buttons">
							<div class="play_button d-none">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/play.png') }}" alt="">
							</div>
							<div class="pause_button ">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/pause.png') }}" alt="">
							</div>
							<div class="umnute_button">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/volume.png') }}" alt="">
							</div>
							<div class="mute_button d-none">
								<img src="{{ asset('assets/front/soulmate-number/new/images/mute.png') }}" alt="">
							</div>
						</div>

					</div>
					<audio id="tenthaudio" preload="none">
						<source src="{{ asset('assets/new_audio/email.mp3') }}" type="audio/mpeg">
						Your browser does not support the audio tag.
					</audio>
				</div>
			</div>
		</div>
	</section>
    <section class="eleven_phase pad_120 d-none" id="eleven-phase">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="buttonSection">
						<div class="discover_more text-center">
							<button class="btn btn-primary" id="product_listen" onclick="listen()">Listen</button>
						</div>
						<div class="discover_more text-center">
							<a class="btn btn-primary" href="{{route('salesCopyWriting')}}">Read</a>
						</div>
					</div>
					<div class="dialog_box">
						<span>There is still so much more that I have yet to reveal about your soulmate…</span>
						<span>Do you wish to…?</span>
                        <div class="dialog_buttons">
							<div class="play_button d-none">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/play.png') }}" alt="">
							</div>
							<div class="pause_button ">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/pause.png') }}" alt="">
							</div>
							<div class="umnute_button">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/volume.png') }}" alt="">
							</div>
							<div class="mute_button d-none">
								<img src="{{ asset('assets/front/soulmate-number/new/images/mute.png') }}" alt="">
							</div>
						</div>
					</div>
				</div>
			</div>
            <audio id="elevenaudio" preload="none">
				<source src="{{ asset('assets/new_audio/reveal_about_solmate.mp3') }}" type="audio/mpeg">
				    Your browser does not support the audio tag.
			</audio>
		</div>
	</section>
    <section class="twelve_phase pad_120 d-none" id="twelve-phase">
        <div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="listenImages ">
						<div class="fadeImagesBackground">
							<img src="{{ asset('assets/front/soulmate-number/new/images/image-border.png') }}" alt="">
						</div>
						<div class="fadeImagesContent">
								<img src="{{ asset('assets/front/soulmate-number/new/sales-audio-images/1.jpg') }}" class="d-none" alt="Image 1" id="saimg1">
								<img src="{{ asset('assets/front/soulmate-number/new/sales-audio-images/2.jpg') }}" class="d-none" alt="Image 2" id="saimg2">
								<img src="{{ asset('assets/front/soulmate-number/new/sales-audio-images/3.jpg') }}" class="d-none" alt="Image 3" id="saimg3">
								<img src="{{ asset('assets/front/soulmate-number/new/sales-audio-images/4.jpg') }}" class="d-none" alt="Image 4" id="saimg4">
								<img src="{{ asset('assets/front/soulmate-number/new/sales-audio-images/5.jpg') }}" class="d-none" alt="Image 5" id="saimg5">
                                <img src="{{ asset('assets/front/soulmate-number/new/sales-audio-images/6.jpg') }}" class="d-none" alt="Image 6" id="saimg6">
                                <img src="{{ asset('assets/front/soulmate-number/new/sales-audio-images/7.jpg') }}" class="d-none" alt="Image 7" id="saimg7">
                                <img src="{{ asset('assets/front/soulmate-number/new/sales-audio-images/8.jpg') }}" class="d-none" alt="Image 8" id="saimg8">
                                <img src="{{ asset('assets/front/soulmate-number/new/sales-audio-images/9.jpg') }}" class="d-none" alt="Image 9" id="saimg9">
                                <img src="{{ asset('assets/front/soulmate-number/new/sales-audio-images/10.jpg') }}" class="d-none" alt="Image 10" id="saimg10">
                                <img src="{{ asset('assets/front/soulmate-number/new/sales-audio-images/11.jpg') }}" class="d-none" alt="Image 11" id="saimg11">
                                <img src="{{ asset('assets/front/soulmate-number/new/sales-audio-images/12.jpg') }}" class="d-none" alt="Image 12" id="saimg12">
                                <img src="{{ asset('assets/front/soulmate-number/new/sales-audio-images/13.jpg') }}" class="d-none" alt="Image 13" id="saimg13">
                                <img src="{{ asset('assets/front/soulmate-number/new/sales-audio-images/14.jpg') }}" class="d-none" alt="Image 14" id="saimg14">
                                <img src="{{ asset('assets/front/soulmate-number/new/sales-audio-images/15.jpg') }}" class="d-none" alt="Image 15" id="saimg15">
                                <img src="{{ asset('assets/front/soulmate-number/new/sales-audio-images/16.jpg') }}" class="d-none" alt="Image 16" id="saimg16">
                                <img src="{{ asset('assets/front/soulmate-number/new/sales-audio-images/17.jpg') }}" class="d-none" alt="Image 17" id="saimg17">
                                <img src="{{ asset('assets/front/soulmate-number/new/sales-audio-images/18.jpg') }}" class="d-none" alt="Image 18" id="saimg18">
						</div>
					</div>
					<div class="dialog_box" id="product_text">
                        <div class="dialog_buttons">
							<div class="play_button d-none">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/play.png') }}" alt="">
							</div>
							<div class="pause_button ">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/pause.png') }}" alt="">
							</div>
							<div class="umnute_button">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/volume.png') }}" alt="">
							</div>
							<div class="mute_button d-none">
								<img src="{{ asset('assets/front/soulmate-number/new/images/mute.png') }}" alt="">
							</div>
						</div>
					</div>
				</div>
			</div>
            <audio id="forteenaudio" preload="none">
				<source src="{{ asset('assets/new_audio/product_1.mp3') }}" type="audio/mpeg">
				    Your browser does not support the audio tag.
			</audio>
		</div>
	</section>
	<section class="thirteen_phase pad_120 d-none" id="thirteen-phase">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
                    <div class="discover_more text-center mt-5">
						<button class="btn btn-primary btnSubmit"  >Purchase</button>
					</div>
					<div class="dialog_box">
						<p>Thank you for trusting me with your journey. Check your email for the complete reading and
							more
							love secrets!</p>
                        <div class="dialog_buttons">
							<div class="play_button d-none">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/play.png') }}" alt="">
							</div>
							<div class="pause_button ">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/pause.png') }}" alt="">
							</div>
							<div class="umnute_button">
								<img  src="{{ asset('assets/front/soulmate-number/new/images/volume.png') }}" alt="">
							</div>
							<div class="mute_button d-none">
								<img src="{{ asset('assets/front/soulmate-number/new/images/mute.png') }}" alt="">
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>
    <!-- <div class="test"><button onclick="opennextpage()">Next</button></div> -->
</div>

<input type="hidden" id="custom_first_name" name="custom_first_name">
<input type="hidden" id="custom_dob" name="custom_dob">
<input type="hidden" id="custom_gender" name="custom_gender">
<input type="hidden" id="custom_gender_interest" name="custom_gender_interest">
<input type="hidden" id="custom_ethencity" name="custom_ethencity">
<input type="hidden" id="custom_full_name" name="custom_full_name">
<input type="hidden" id="custom_love_path_number" name="custom_love_path_number">
<input type="hidden" id="custom_heart_desire_number" name="custom_heart_desire">
<input type="hidden" id="custom_love_destiny_number" name="custom_love_destiny_number">

<footer class="footerSection">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="footer_text text-center">
					<p>Copyright © 2025 Romance Numerology. All rights reserved.</p>
					<p><a href="{{ route('privacyPolicy') }}" target="_blank">Privacy Policy</a> | <a href="{{ route('termsOfService') }}" target="_blank">Terms & Conditions</a></p>
				</div>
			</div>
		</div>
	</div>
</footer>
	<script src="https://code.jquery.com/jquery-3.3.0.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('assets/front/js/custom.js') }}"></script>
	<script>
		function generateStars(layer, count) {
		let boxShadow = [];
		for (let i = 0; i < count; i++) {
			const x = Math.floor(Math.random() * 2000);
			const y = Math.floor(Math.random() * 2000);
			boxShadow.push(`${x}px ${y}px #FFF`);
		}

		const $element = $('.skyanimationbg #' + layer);
		$element.css('box-shadow', boxShadow.join(','));

		const style = `
			.skyanimationbg #${layer}::after {
			box-shadow: ${boxShadow.join(',')};
			content: '';
			position: absolute;
			top: 2000px;
			width: inherit;
			height: inherit;
			}
		`;

		$('<style></style>').text(style).appendTo('head');
		}

		$(function () {
		generateStars('starsLayer1', 700);
		generateStars('starsLayer2', 200);
		generateStars('starsLayer3', 100);
		});

	  </script>
</body>

</html>

