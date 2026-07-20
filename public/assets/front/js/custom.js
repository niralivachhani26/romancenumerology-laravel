$(document).ready(function () {
    const monthNames = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];

    function populateDays(monthIndex, year, selectedDay = null) {
        let daysInMonth = new Date(year, monthIndex, 0).getDate(); // MonthIndex is 1-based

        $('#day').empty(); // Clear previous options

        for (let i = 1; i <= daysInMonth; i++) {
            $('#day').append(`<option value="${i}">${i}</option>`);
        }

        // Restore selected day if valid, otherwise default to last valid day
        if (!selectedDay || selectedDay > daysInMonth) {
            selectedDay = daysInMonth;
        }
        $('#day').val(selectedDay);
    }

    // Populate month dropdown with names (but use numeric values)
    monthNames.forEach((month, index) => {
        $('#month').append(`<option value="${index + 1}">${month}</option>`); // 1-based month value
    });

    // Populate year dropdown (current year - 100 to current year)
    let currentYear = new Date().getFullYear() -18;
    for (let i = currentYear; i >= currentYear - 100; i--) {
        $('#year').append(`<option value="${i}">${i}</option>`);
    }

    // Set default values to today's date
    let today = new Date();
    let selectedDay = today.getDate();
    let selectedMonth = today.getMonth() + 1; // Convert 0-based to 1-based month value
    let selectedYear = today.getFullYear()-18;

    $('#month').val(selectedMonth);
    $('#year').val(selectedYear);
    populateDays(selectedMonth, selectedYear, selectedDay);

    // Update days when month or year changes
    $('#month, #year').change(function () {
        let selectedDay = $('#day').val(); // Keep currently selected day
        let month = $('#month').val(); // Now this returns numeric value (1-12)
        let year = $('#year').val();
        populateDays(month, year, selectedDay);
    });
});


document.querySelectorAll('.fadeImagesContainer').forEach(container => {
    const images = container.querySelectorAll('.fadeImages');
    let currentIndex = 0;

    function showNextImage() {
        images[currentIndex].classList.remove('active');
        currentIndex = (currentIndex + 1) % images.length;
        images[currentIndex].classList.add('active');
    }

    // Set the first image to be visible initially
    images[currentIndex].classList.add('active');

    // Change image every 3 seconds
    setInterval(showNextImage, 3000);
});


// document.querySelectorAll('.fadeImagesContainer').forEach(container => {
//     const images = container.querySelectorAll('.fadeImages');
//     const realTimeImages = [
//         {"time": 0},
//         {"time": 36702},
//         {"time": 52905},
//         {"time": 70580},
//         {"time": 71580},
//         {"time": 83595},
//         {"time": 108857},
//         {"time": 116817},
//         {"time": 143192},
//         {"time": 156457},
//         {"time": 167797},
//         {"time": 188430},
//         {"time": 226615},
//         {"time": 227615},
//         {"time": 237124},
//         {"time": 261519},
//         {"time": 265537 },
//         {"time": 300834}
//     ];

//     let currentIndex = 0;
//     let timeoutId = null; // To store the ID of the current setTimeout

//     // Sort the realTimeImages array by time to ensure correct sequencing
//     // This is crucial because your provided array has 36702 before 10000.
//     realTimeImages.sort((a, b) => a.time - b.time);

//     function showImage(index) {
//         // Ensure the index is within bounds
//         if (index < 0 || index >= images.length) {
//             console.warn("Attempted to show an image at an invalid index:", index);
//             return;
//         }

//         // Remove 'active' from all images
//         images.forEach(img => img.classList.remove('active'));

//         // Add 'active' to the current image
//         images[index].classList.add('active');
//     }

//     function scheduleNextImage() {
//         // If we've gone through all the timed events, reset to the beginning
//         if (currentIndex >= realTimeImages.length) {
//             currentIndex = 0; // Loop back to the start
//         }

//         const currentTimeObject = realTimeImages[currentIndex];
//         const nextTimeObject = realTimeImages[(currentIndex + 1) % realTimeImages.length];

//         // Calculate the delay until the next image should appear.
//         // If it's the last image, the delay will be until the first image of the next loop.
//         let delay;
//         if (currentIndex === realTimeImages.length - 1) {

//              delay = (nextTimeObject.time + realTimeImages[realTimeImages.length - 1].time) - currentTimeObject.time;

//              delay = Math.max(0, nextTimeObject.time - currentTimeObject.time);
//              if (delay === 0 && realTimeImages.length > 1) {
//                  delay = 3000; // Default 3 second display for the last image before looping
//              }
//         } else {
//             delay = nextTimeObject.time - currentTimeObject.time;
//         }

//         // or if you want an immediate transition for some reason).
//         delay = Math.max(0, delay);
//         // Clear any previously set timeout to prevent issues if this function is called rapidly
//         if (timeoutId) {
//             clearTimeout(timeoutId);
//         }
//         // Schedule the next image to be shown
//         timeoutId = setTimeout(() => {
//             showImage(currentIndex); // Show the current image
//             currentIndex++; // Move to the next index for the next iteration
//             scheduleNextImage(); // Schedule the next image
//         }, delay);
//     }

//     // Set the first image to be visible initially
//     showImage(0);

//     // Start the scheduling process
//     scheduleNextImage();
// });

let floatingNumbersIntervalId = null;

const floatingNumbers = (numberText) => {
    const MIN_DISTANCE = 100;
    const TOTAL_NUMBERS = 20;

    // Clear any existing interval to avoid stacking
    if (floatingNumbersIntervalId) {
        clearInterval(floatingNumbersIntervalId);
    }

    function getRandom(min, max) {
        return Math.random() * (max - min) + min;
    }

    function positionNumber(element, side, positionedPoints) {
        const fontSize = getRandom(10, 50);
        element.style.fontSize = `${fontSize}px`;
        element.style.position = 'absolute';

        let x, y;
        let tries = 0;
        let tooClose;

        do {
            if (side === 'left') {
                x = getRandom(0, window.innerWidth * 0.3 - fontSize);
            } else {
                x = getRandom(window.innerWidth * 0.7, window.innerWidth - fontSize);
            }

            y = getRandom(0, window.innerHeight - fontSize);

            tooClose = positionedPoints.some(pt => {
                const dx = pt.x - x;
                const dy = pt.y - y;
                return Math.sqrt(dx * dx + dy * dy) < MIN_DISTANCE;
            });

            tries++;
        } while (tooClose && tries < 100);

        positionedPoints.push({ x, y });

        element.style.left = `${x}px`;
        element.style.top = `${y}px`;
        element.style.opacity = getRandom(0.3, 1);
    }

    function animateNumbers(container) {
        const numbers = container.querySelectorAll('.number');
        const half = numbers.length / 2;
        const positionedPoints = [];

        numbers.forEach((element, index) => {
            const side = index < half ? 'left' : 'right';
            positionNumber(element, side, positionedPoints);
        });
    }

    function createNumberElements() {
        const floatingContainers = document.querySelectorAll('.floatingNumber');
        const half = TOTAL_NUMBERS / 2;

        floatingContainers.forEach((floatingMain, index) => {
            const center = floatingMain.querySelector('.centerNumber p');
            if (center) {
                center.textContent = numberText;
            }

            const floatingSection = floatingMain.querySelector('.floatingNumberSection');
            if (!floatingSection) return;

            // Clear old numbers
            floatingSection.innerHTML = '';
            const positionedPoints = [];

            for (let i = 0; i < TOTAL_NUMBERS; i++) {
                const number = document.createElement('div');
                number.className = 'number';
                number.textContent = numberText;
                floatingSection.appendChild(number);

                const side = i < half ? 'left' : 'right';
                positionNumber(number, side, positionedPoints);
            }

            // Animate after DOM is rendered
            requestAnimationFrame(() => {
                requestAnimationFrame(() => {
                    animateNumbers(floatingSection);
                });
            });
        });
    }

    // Initial render
    createNumberElements();

    // Re-animate every 12 seconds
    floatingNumbersIntervalId = setInterval(() => {
        document.querySelectorAll('.floatingNumber .floatingNumberSection').forEach(container => {
            animateNumbers(container);
        });
    }, 12000);
};





// Add event listener to the button

async function emails() {

    $('#tenth_button button').text('Please wait...').attr('disabled', true);
    const returresponse = await savedata();

    if (returresponse === 1) {

        $('#tenth-phase').addClass('d-none');
        $('#eleven-phase').removeClass('d-none');
        $('.energy').removeClass('d-none');

        var audio10 = document.getElementById("tenthaudio");
        audio10.pause();

        var audio11 = document.getElementById("elevenaudio");
        audio11.play();

        audio11.ontimeupdate = function () {
            let currentTime11 = audio11.currentTime;
            if (currentTime11 >= 9.195063) {
                $('#eleven_button').removeClass('d-none');
            }
        };
    } else {
        $('#tenth_button button').text('Try Again').attr('disabled', false);
        $("#email_err").removeClass('d-none');
        $("#email_err").text("Something went wrong. Contact support or retry the process.");
    }
}

function savedata() {
    return new Promise((resolve, reject) => {
        var email = $('#email').val();
        if (email === '') {
            $('#email_error').removeClass('d-none');
            resolve(0);
            return;
        } else {
            $('#email_error').addClass('d-none');
        }

        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            $('#email_error').removeClass('d-none');
            resolve(0);
            return;
        } else {
            $('#email_error').addClass('d-none');
        }

        var first_name = $('#custom_first_name').val();
        var full_name = $('#custom_full_name').val();
        var bod = $('#custom_dob').val();
        var love_path_number = $('#custom_love_path_number').val();
        var heart_desier_number = $('#custom_heart_desire_number').val();
        var love_Desire_number = $('#custom_love_destiny_number').val();
        var custom_gender = $('#custom_gender').val();
        var custom_gender_interest = $('#custom_gender_interest').val();
        var custom_ethencity = $('#custom_ethencity').val();

        //store name in local storage
        localStorage.setItem('first_name', first_name);
        localStorage.setItem('full_name', full_name);

        // Send data to backend using AJAX
        $.ajax({
            url: '/save-data',
            method: 'POST',
            data: {
                email: email,
                first_name: first_name,
                full_name: full_name,
                bod: bod,
                love_path_number: love_path_number,
                heart_desier_number: heart_desier_number,
                love_Desire_number: love_Desire_number,
                custom_gender:custom_gender,
                custom_gender_interest:custom_gender_interest,
                custom_ethencity:custom_ethencity,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                resolve(1);
            },
            error: function (xhr) {
                resolve(0);
            }
        });
    });
}


// audio and video play

$('.nextdob').on('click', function() {

    audion = document.getElementById("secondaudio");
    audion.pause();

    $('.form-control').removeClass('is-invalid');
    $('.text-danger').hide();
    var error = 0;
    if ($('#name').val() == '') {
        $('#name').addClass('is-invalid');
        $('#name_err').html('Please enter name');
        $('#name_err').show();
        error++;
    }
    if (error > 0) {
        return false;
    }

    $('#custom_first_name').val($('#name').val());
    $('#second_name').addClass('d-none');
    $('#namehide').addClass('d-none');
    $('#nexthide').addClass('d-none');
    $('#seconds').fadeIn('slow').removeClass('d-none');
    $('#secondd').fadeIn('slow').removeClass('d-none');

    var audio = document.getElementById("thirdaudio");
    audio.play();
    // var element = $('#second_dob');
    // var text = element.html(); // Get the HTML content

    // var updatedText = text.replace(/\bname\b/, $('#name').val()); // Replace "name" with "newWord"

    // element.html(updatedText); // Update the content

    $('#secondss').removeClass('d-none');
    $('#second_dob').removeClass('d-none');
});

function waitForAudioTime(audio, targetTime) {
    return new Promise((resolve) => {
        audio.ontimeupdate = function () {

            if (audio.currentTime >= targetTime) {
                audio.ontimeupdate = null; // Clean up
                resolve();
            }
        };
    });
}

$('#second-phase-button').on('click', async function() {

    var audio = document.getElementById("thirdaudio");
    audio.pause();

    var audio_new_three = document.getElementById("thirdaudionew");

    audio_new_three.play();

    // realTimeText111 = [
    //     {"time": 0, "value": "Then, share with me your energy: are you divine feminine or masculine?"},
    //     {"time": 4480, "value": "Tell me who your heart is drawn to..."},
    //     {"time": 6822, "value": "and where in the world your journey began."},
    //     {"time": 9265, "value": "These details will help me connect the cosmic threads to unlock the hidden messages of your love destiny."},
    // ];
    realTimeText111 = [
        {"time": 0, "value": "Then, share with me these details as it will help me connect the cosmic threads to unlock the hidden messages of your love destiny."},

    ];

    // Convert timestamps from milliseconds to seconds
    realTimeText111.forEach(item => {
        item.time = item.time / 1000;
    });

    audio_new_three.ontimeupdate = function () {
        const currentTimeAudio = audio_new_three.currentTime;

        // Find the most recent text whose time is less than or equal to the current time
        let latestText = "";
        for (let i = 0; i < realTimeText111.length; i++) {
            if (currentTimeAudio >= realTimeText111[i].time) {
                latestText = realTimeText111[i].value;
            } else {
                break;
            }
        }

        // Update the text if it has changed
        const dialogTextElement = $('.dialog_box p');
        if (dialogTextElement.text() !== latestText) {
            dialogTextElement.text(latestText);
        }
    };


    $('.form-control').removeClass('is-invalid');
    $('.text-danger').hide();

    $('.showName').html($('#name').val())

    var day = $('#day').val();

    var month = $('#month').val();
    var year = $('#year').val();

    if (!day || !month || !year) {
        alert('Please select a valid date of birth.');
        return;
    }

    var dob = day + '/' + month + '/' + year;

    $('#custom_dob').val(dob);
    $('#form_name').val($('#name').val());
    $('#form_dob').val(dob);

    $('#second-phase').addClass('d-none');
    $('#second-new-phase').removeClass('d-none');
});



$('#second-new-phase-button').on('click', async function() {

    var audio_new_three = document.getElementById("thirdaudionew");

    audio_new_three.pause();

        var gender = $('#gender').val();
        if(gender == '') {
            $('#gender').addClass('is-invalid');
            $('#gender_err').html('Please select a gender');
            $('#gender_err').show();
            return false;
        }

        var genderofinterest = $('#genderofinterest').val();
        if(genderofinterest == '') {
            $('#genderofinterest').addClass('is-invalid');
            $('#genderofinterest_err').html('Please select a gender of interest');
            $('#genderofinterest_err').show();
            return false;
        }


        var ethnicity = $('#ethnicity').val();
        if(ethnicity == '') {
            $('#genethnicityder').addClass('is-invalid');
            $('#ethnicity_err').html('Please select a ethnicity');
            $('#ethnicity_err').show();
            return false;
        }

        $('#custom_gender').val(gender);
        $('#custom_gender_interest').val(genderofinterest);
        $('#custom_ethencity').val(ethnicity);

        var day = $('#day').val();
        var month = $('#month').val();
        var year = $('#year').val();
        var dob = day + '/' + month + '/' + year;
        var formattedDate = formatDate(dob);

        $('.showDob').html(formattedDate)
        $('.showName').val($('#name').val());

        $('.energy').addClass('d-none');
        $('#second-new-phase').addClass('d-none');
        $('#third-phase').removeClass('d-none');
        $('#third-phase').removeClass('pad_120');
        $('#third-phase').addClass('pad_50');


        var audio3 = document.getElementById("fouraudio");
        audio3.play();

        realTimeText11 = [
            {"time": 0, "value": "Let me weave the magic of numbers to reveal your Love Path Number—a powerful guide written in the stars just for you."},
            {"time": 6367, "value": "This unique number unveils the natural patterns of your heart, \nrevealing your deepest romantic tendencies, \nemotional strengths, and \nthe kind of love that truly fulfills you."},
            {"time": 15997, "value": "It also holds clues to your ideal partner and compatibility, \nhelping you understand the kind of connection your soul is destined to seek."},
        ];

        // Convert timestamps from milliseconds to seconds
        realTimeText11.forEach(item => {
            item.time = item.time / 1000;
        });

        audio3.ontimeupdate = function () {
            const currentTimeAudio = audio3.currentTime;

            // Find the most recent text whose time is less than or equal to the current time
            let latestText = "";
            for (let i = 0; i < realTimeText11.length; i++) {
                if (currentTimeAudio >= realTimeText11[i].time) {
                    latestText = realTimeText11[i].value;
                } else {
                    break;
                }
            }

            // Update the text if it has changed
            const dialogTextElement = $('.dialog_box p');
            if (dialogTextElement.text() !== latestText) {
                dialogTextElement.text(latestText);
            }
        };

        // Create a promise that resolves when audio3 ends
        const audioPromise = new Promise(resolve => {
            audio3.onended = resolve;
        });

        /* animation code start */
        var final_number = await box1(dob);
        /* animation code end */

        // Wait for the audio to finish
        await audioPromise;

        $('#custom_love_path_number').val(final_number);

        if (final_number && audioPromise) {

            await wait(500);

            $('#third-phase').addClass('d-none');
            $('body').addClass('image-revealed');
            $('#third-phase_new').removeClass('d-none');

            setTimeout(function () {
                $('.imagesNumberSection .fadeImagesContainer').css('display', 'none');
            }, 15000);


            var number_audio = document.getElementById("audio_" + final_number);
            number_audio.play();

            floatingNumbers(final_number)

            // $('.floatingNumber').find('.centerNumber p').html();
            // $('.floatingNumber').find('.number').html(final_number);
            // var number_audio_time = 5;
            var realTimeText = [];
            if (final_number == 1) {

                realTimeText = [
                            {"time": 0, "value": "Ah, my dear, your Love Path Number is 1."},
                            {"time": 3355, "value": "This number, it’s a beautiful one, full of the spirit of new beginnings, leadership, and independence."},
                            {"time": 9510, "value": "You, my friend, are like a trailblazer in the realm of love—fearless, with a heart that’s brimming with dreams and possibilities."},
                            {"time": 16952, "value": "Can you feel it?"},
                            {"time": 18357, "value": "That spark inside you?"},
                            {"time": 20212, "value": "It's there, ready to light the way for something new."},
                            {"time": 23592, "value": "In your romantic journey, you don’t just follow the crowd, do you?"},
                            {"time": 27609, "value": "No, you forge your own path, often creating something fresh and exciting in your relationships."},
                            {"time": 33364, "value": "I can imagine your partners, drawn in by your vision, your energy."},
                            {"time": 37507, "value": "There’s something captivating about the way you bring innovation and a sense of adventure to love."},
                            {"time": 42474, "value": "You don’t settle for anything less than extraordinary, and I love that about you."},
                            {"time": 47179, "value": "You have this beautiful, natural confidence."},
                            {"time": 50297, "value": "It’s like a warm embrace that says, “I’m here, and I’m ready."},
                            {"time": 54202, "value": "You’re not afraid to take the first step, to reach out and create those meaningful connections."},
                            {"time": 59394, "value": "And that’s such a gift!"},
                            {"time": 61149, "value": "Your partners must admire the way you seize opportunities and turn them into shared adventures."},
                            {"time": 66404, "value": "It’s inspiring, honestly."},
                            {"time": 68872, "value": "But, my dear, even with your strength and independence, there are moments—aren’t there?"},
                            {"time": 74189, "value": "—when it gets a little tough."},
                            {"time": 76044, "value": "Especially with partners who have a strong will like yours."},
                            {"time": 79537, "value": "But here’s the thing: those clashes, those little bumps, they aren’t failures."},
                            {"time": 84292, "value": "They’re lessons."},
                            {"time": 85722, "value": "They’re teaching you patience, compromise, and how to grow alongside someone else."},
                            {"time": 90739, "value": "Every challenge is shaping your love story into something even more beautiful."},
                            {"time": 95294, "value": "The people who understand and love your dynamic energy, those who respect your autonomy, are the ones who will really fill your heart."},
                            {"time": 102512, "value": "You need someone who supports your dreams, who’s ready to explore the world’s possibilities by your side."},
                            {"time": 108217, "value": "Those are the relationships where your soul will truly flourish."},
                            {"time": 111922, "value": "So, my dear, embrace your path."},
                            {"time": 114802, "value": "It’s leading you toward deep, transformative love."},
                            {"time": 117994, "value": "The world of romance?"},
                            {"time": 119774, "value": "It’s your canvas, and I know you’ll paint it with bold, passionate strokes."},
                            {"time": 124229, "value": "You’re creating something beautiful, and I’m here cheering you on every step of the way."}
                        ];

                number_audio_time = 128.568;
            } else if (final_number == 2) {
                // Set the total audio duration (if needed)

                realTimeText = [
                    {"time": 0, "value": "Ah, my dear one, your Love Path Number is 2."},
                    {"time": 3630, "value": "This number, it's special—so full of the essence of partnership, harmony, and deep sensitivity."},
                    {"time": 9672, "value": "You, my sweet soul, are someone who naturally seeks balance and connection in love."},
                    {"time": 14890, "value": "I can already feel the calm you bring to your relationships, the gentle way you nurture those around you."},
                    {"time": 20544, "value": "You, my dear, have such a gift."},
                    {"time": 23349, "value": "You have this beautiful talent for creating peace and harmony in your relationships."},
                    {"time": 28117, "value": "You make others feel understood, heard, and seen."},
                    {"time": 31497, "value": "You’re like a soothing breeze on a hot day, bringing balance to those lucky enough to be in your life."},
                    {"time": 36852, "value": "Your empathy is such a rare and precious thing, and it creates a space where love can thrive."},
                    {"time": 42407, "value": "Your path, it’s one of collaboration, of building something beautiful together with someone who truly gets you."},
                    {"time": 48587, "value": "Teamwork, mutual respect—these are the things you value most in love, aren’t they?"},
                    {"time": 53754, "value": "You know that love is about sharing, about working together to create something lasting and strong."},
                    {"time": 59197, "value": "And when you find that connection, oh, it must feel so right, like two pieces of a puzzle clicking perfectly into place."},
                    {"time": 66489, "value": "But, my dear, even with all your grace and gentleness, there are moments when your heart feels the weight of giving too much, aren’t there?"},
                    {"time": 73819, "value": "You care so deeply, and sometimes it can be easy to lose sight of your own needs in the process."},
                    {"time": 79374, "value": "But I want you to remember that it’s okay to take care of yourself, too."},
                    {"time": 83554, "value": "Finding that balance between giving and receiving is key to making sure your love is as fulfilling for you as it is for your partner."},
                    {"time": 90547, "value": "You’re at your happiest with someone who truly cherishes your gentle nature, someone who values the depth of emotional connection you bring to the table."},
                    {"time": 98164, "value": "Look for someone who understands your need for harmony, someone who will stand beside you, nurturing the relationship just as you do."},
                    {"time": 105394, "value": "Those are the connections that will make your heart sing."},
                    {"time": 108449, "value": "So, my dear, embrace your journey."},
                    {"time": 111329, "value": "It’s leading you toward relationships filled with deep, meaningful connections."},
                    {"time": 115784, "value": "Your path through love is a dance of harmony, and it’s guiding you to something truly fulfilling."},
                    {"time": 121202, "value": "Trust that, and know that I am always here, supporting you every step of the way."}
                ];

                number_audio_time = 125.616;
            } else if (final_number == 3) {

                realTimeText = [
                        {"time": 0, "value": "Ah, my dear, your Love Path Number is 3."},
                        {"time": 3392, "value": "What a beautiful, lively number it is!"},
                        {"time": 6185, "value": "It’s full of creativity, communication, and pure, infectious joy."},
                        {"time": 11027, "value": "I can feel your energy already—you have this incredible zest for life, don’t you?"},
                        {"time": 16057, "value": "Wherever you go, you bring warmth, laughter, and a sense of adventure that lights up the room."},
                        {"time": 21687, "value": "In love, you’re like a beacon of light."},
                        {"time": 24279, "value": "Your relationships aren’t just ordinary—they’re vibrant, full of color and excitement."},
                        {"time": 29334, "value": "You bring so much creativity and joy into your romantic life, turning even the simplest moments into something magical."},
                        {"time": 36127, "value": "I can just picture it—those spontaneous adventures, those little surprises, the way you make everyday life feel like an adventure."},
                        {"time": 43669, "value": "It’s beautiful to watch, truly."},
                        {"time": 46362, "value": "And let’s not forget about your gift for communication."},
                        {"time": 49654, "value": "Oh, how wonderful it is!"},
                        {"time": 51872, "value": "You have this way of connecting with your partner that feels so open, so natural."},
                        {"time": 56689, "value": "You’re able to express yourself with such ease, creating a space where love can truly thrive."},
                        {"time": 62294, "value": "There’s something so special about the way you share your thoughts, your feelings—like you’re opening a door and inviting love in without hesitation."},
                        {"time": 70224, "value": "Now, I know your enthusiasm is one of your greatest strengths, but I also know it can sometimes make things a little tricky, can’t it?"},
                        {"time": 77679, "value": "There are moments when you might feel restless or eager for something new."},
                        {"time": 81559, "value": "But, my dear, remember to balance that beautiful energy of yours with the deeper aspects of love."},
                        {"time": 87452, "value": "Your relationships can be full of excitement and also grounded in meaning."},
                        {"time": 91707, "value": "When you find that balance, you create something truly lasting."},
                        {"time": 95849, "value": "You, my lively soul, need someone who appreciates your spirit, someone who loves the way you bring adventure and creativity into every corner of life."},
                        {"time": 104179, "value": "Seek out a partner who encourages your dreams, who’s ready to explore the world by your side."},
                        {"time": 109497, "value": "The best relationships for you are those where both of you are uplifted by each other’s passion for life."},
                        {"time": 115189, "value": "So, embrace your path, my dear one."},
                        {"time": 118319, "value": "It’s filled with opportunities to create unforgettable, magical moments."},
                        {"time": 122687, "value": "Your journey through love is a tapestry woven with laughter, connection, and endless joy."},
                        {"time": 128104, "value": "And trust me, it’s leading you toward relationships that are not only enriching but deeply, wonderfully fulfilling."},
                        {"time": 134447, "value": "I’m here with you, every step of the way."}
                    ];

                number_audio_time = 136.848;
            } else if (final_number == 4) {

                realTimeText = [
                        {"time": 0, "value": "Ah, my dear, your Love Path Number is 4."},
                        {"time": 3430, "value": "What a beautiful, solid number."},
                        {"time": 5772, "value": "It’s filled with stability, reliability, and dedication—qualities that are woven into the very fabric of who you are."},
                        {"time": 12802, "value": "You walk through life with this deep, unwavering sense of responsibility, don’t you?"},
                        {"time": 17782, "value": "I can feel it—the way you seek to build something strong, something lasting in your relationships."},
                        {"time": 23624, "value": "In love, you are truly a builder."},
                        {"time": 26142, "value": "You don’t just want fleeting moments or casual connections; no, you want to lay the groundwork for something real, something solid."},
                        {"time": 33522, "value": "Your partners must admire this about you—your commitment, your ability to create an environment of trust and loyalty."},
                        {"time": 40277, "value": "You are that steady force, the one who makes others feel safe, secure, and loved in the most meaningful way."},
                        {"time": 46832, "value": "And oh, your practicality is such a gift!"},
                        {"time": 50049, "value": "You have this incredible talent for turning dreams into reality."},
                        {"time": 53967, "value": "You don’t just talk about what could be—you make it happen."},
                        {"time": 57409, "value": "In love, you’re always thinking about how to create a strong foundation, ensuring that your relationships are not only stable but truly fulfilling."},
                        {"time": 65652, "value": "That’s such a rare quality, my dear, and it’s one that brings so much depth and richness to your romantic life."},
                        {"time": 72157, "value": "But even with your incredible strength and dedication, I know there are moments when it’s hard to let go of control, right?"},
                        {"time": 78799, "value": "Your focus on stability is a beautiful thing, but sometimes it can make you a little hesitant to embrace change."},
                        {"time": 84942, "value": "And that’s okay!"},
                        {"time": 86447, "value": "The key is finding a balance—holding onto the security you need while staying open to new experiences."},
                        {"time": 92464, "value": "Growth, after all, is part of any lasting relationship."},
                        {"time": 96644, "value": "You, my dear, need someone who truly sees and appreciates your reliability, someone who values loyalty and commitment as much as you do."},
                        {"time": 104624, "value": "Look for partners who are ready to build a future with you, hand in hand, with the same sense of dedication you bring to the table."},
                        {"time": 111554, "value": "Together, you’ll create something stable, rewarding, and incredibly fulfilling."},
                        {"time": 116472, "value": "So, embrace your path, my dear one."},
                        {"time": 119602, "value": "It’s filled with opportunities to create meaningful, enduring connections."},
                        {"time": 123919, "value": "Your journey through love is a testament to your strength, your dedication, and your heart."},
                        {"time": 128912, "value": "I’m here with you, every step of the way, cheering you on as you build the beautiful, lasting love you deserve."}
                    ];

                number_audio_time = 134.64;
            } else if (final_number == 5) {
                realTimeText = [
                        {"time": 0, "value": "Ah, my dear, your Love Path Number is 5, and what a thrilling number it is!"},
                        {"time": 5142, "value": "It’s filled with freedom, adventure, and the beauty of adaptability."},
                        {"time": 9272, "value": "I can feel your excitement, your curiosity about the world around you."},
                        {"time": 13440, "value": "You have this spark, this zest for life, and when it comes to love, you’re always seeking something vibrant, something dynamic."},
                        {"time": 20732, "value": "You, my dear, are never one to settle for the ordinary."},
                        {"time": 24712, "value": "In your romantic journey, you are a true explorer, aren’t you?"},
                        {"time": 28542, "value": "You thrive on variety, on discovering new experiences with someone by your side."},
                        {"time": 33447, "value": "I can imagine your partners being drawn to that energy—your love for life, your willingness to dive into the unknown, always ready for the next great adventure."},
                        {"time": 42052, "value": "It’s like you bring color and excitement into every relationship, making each moment feel fresh and alive."},
                        {"time": 48382, "value": "You have such a beautiful gift, you know that?"},
                        {"time": 51462, "value": "Your ability to adapt, to flow with whatever life throws your way."},
                        {"time": 55467, "value": "In love, this makes you resilient, flexible, and open to change."},
                        {"time": 59959, "value": "When things get tough, you find a way to navigate through it, turning challenges into exciting opportunities for growth."},
                        {"time": 66527, "value": "That’s what makes your relationships not just thrilling, but strong and enduring."},
                        {"time": 71269, "value": "But, my dear, I know there are times when your love for freedom can make things a little complicated, right?"},
                        {"time": 77337, "value": "There may be moments when you feel restless, when the idea of commitment feels like it’s slowing you down."},
                        {"time": 82967, "value": "And that’s okay."},
                        {"time": 84459, "value": "The key is finding a balance—keeping your adventurous spirit alive while also embracing the deeper, more meaningful parts of love."},
                        {"time": 91764, "value": "When you do that, you’ll find relationships that are not only exciting but truly fulfilling."},
                        {"time": 97319, "value": "You, my free spirit, are most compatible with someone who loves your adventurous nature, someone who’s just as open to exploring the world as you are."},
                        {"time": 105737, "value": "Seek out partners who are willing to join you on your journey, who understand your need for freedom and are excited to explore life’s endless possibilities alongside you."},
                        {"time": 114704, "value": "Those are the connections that will fill your heart with both joy and meaning."},
                        {"time": 118697, "value": "So, embrace your path, my dear one."},
                        {"time": 121827, "value": "It’s filled with so many opportunities to explore, to grow, and to love."},
                        {"time": 126457, "value": "Your journey through romance is an adventure, one that will lead you to relationships that are enriching, inspiring, and full of life."},
                        {"time": 133774, "value": "And know that I’m here, always cheering you on as you navigate the exciting world of love."}
                    ];

                number_audio_time = 138.432;
            } else if (final_number == 6) {
                realTimeText = [
                            {"time": 0, "value": "Ah, my dear, your Love Path Number is 6, and what a beautiful number it is."},
                            {"time": 5105, "value": "It’s filled with harmony, care, and a deep sense of responsibility."},
                            {"time": 9435, "value": "You, my sweet soul, walk through life with so much compassion, always wanting to create a loving and supportive space for the ones you cherish."},
                            {"time": 17502, "value": "It’s like your heart overflows with warmth, and I can feel how deeply you care for those around you."},
                            {"time": 23107, "value": "In love, you are such a natural nurturer."},
                            {"time": 26062, "value": "You have this incredible ability to bring balance and harmony into your relationships, don’t you?"},
                            {"time": 31517, "value": "Your partners must feel so cherished, so valued, just by being with you."},
                            {"time": 36159, "value": "It’s like you have this magic way of making others feel truly loved, supported, and safe in your presence."},
                            {"time": 42427, "value": "You’re the heart of the relationship, the one who holds everything together with your love and care."},
                            {"time": 47744, "value": "Your commitment, oh, it’s unwavering."},
                            {"time": 50562, "value": "You have such a strong sense of responsibility when it comes to love."},
                            {"time": 54754, "value": "You’re always thinking about how to create a stable, secure environment for your partner, making sure they feel supported in every way."},
                            {"time": 62022, "value": "It’s like you’re building a home in your heart for those you love—a place where they can feel safe, always."},
                            {"time": 67902, "value": "But, my dear, I know sometimes your nurturing nature can lead you to focus so much on others that you forget about your own needs."},
                            {"time": 75094, "value": "You give so much of yourself, and while that’s such a beautiful strength, it’s important to take care of you, too."},
                            {"time": 81349, "value": "Finding that balance between caring for others and ensuring your own well-being is key to making your relationships fulfilling for both of you."},
                            {"time": 88954, "value": "You, my compassionate soul, are most compatible with someone who truly appreciates your caring nature, someone who shares your values of commitment and harmony."},
                            {"time": 97897, "value": "Look for a partner who’s ready to build a loving, supportive partnership alongside you—someone who’s as dedicated to nurturing the relationship as you are."},
                            {"time": 106389, "value": "Those are the connections that will make your heart feel at home."},
                            {"time": 109844, "value": "So, embrace your path, my dear one."},
                            {"time": 112974, "value": "It’s filled with so many opportunities to create deep, meaningful, and lasting connections."},
                            {"time": 118417, "value": "Your journey through love is a testament to your compassion, your dedication, and your beautiful heart."},
                            {"time": 124047, "value": "I’m here with you, always cheering you on as you create the love you deserve."}
                ];

                number_audio_time = 127.992;
            } else if (final_number == 7) {
                realTimeText = [
                    {"time": 0, "value": "Ah, my dear, your Love Path Number is 7."},
                    {"time": 3442, "value": "It’s such a special number, filled with introspection, spirituality, and incredible depth."},
                    {"time": 9085, "value": "You’re someone who navigates life with a yearning to understand the deeper meanings, especially in your relationships."},
                    {"time": 15315, "value": "You’re always seeking that soul connection, aren’t you?"},
                    {"time": 18382, "value": "The kind that resonates deep within, where love becomes something more than just the surface."},
                    {"time": 23712, "value": "In your romantic journey, you are truly a seeker—a seeker of truth, of understanding, of something that goes beyond the ordinary."},
                    {"time": 31192, "value": "You crave relationships that offer meaning, depth, and a spiritual connection."},
                    {"time": 35972, "value": "I can see why your partners are captivated by you."},
                    {"time": 39202, "value": "There’s a wisdom within you, a sense that you see love as more than just a feeling, but as something that holds the key to life's greatest mysteries."},
                    {"time": 47169, "value": "And you, my dear, are a master of introspection."},
                    {"time": 50774, "value": "You have this natural ability to look inward, to reflect on yourself and your relationships."},
                    {"time": 56054, "value": "It’s such a gift!"},
                    {"time": 57597, "value": "This depth of understanding allows you to form connections that are profound, ones that truly touch the soul."},
                    {"time": 63764, "value": "Your relationships aren’t just about the everyday—they’re enlightening, full of growth and discovery."},
                    {"time": 69494, "value": "But I know, my dear, that your introspective nature can sometimes lead you into moments of isolation, can’t it?"},
                    {"time": 76124, "value": "There are times when you might withdraw, seeking solitude to process it all."},
                    {"time": 80542, "value": "And while that’s a strength in many ways, it’s important to also let others in."},
                    {"time": 84997, "value": "Balancing your need for quiet reflection with openness to emotional connection is how your relationships will truly flourish."},
                    {"time": 91677, "value": "Love, after all, thrives in connection."},
                    {"time": 95069, "value": "You, my deep and thoughtful soul, are most compatible with someone who truly appreciates the depth you bring to love."},
                    {"time": 101724, "value": "Seek out partners who, like you, desire meaning and are willing to explore the mysteries of life and love by your side."},
                    {"time": 108554, "value": "Together, you can support one another on this beautiful journey of discovery, where every step brings you closer to understanding love's true essence."},
                    {"time": 116647, "value": "So, embrace your path, dear one."},
                    {"time": 119564, "value": "It’s a quest filled with opportunities to explore, to understand, and to deepen your connection to love."},
                    {"time": 125594, "value": "Your journey is one of truth and enlightenment, leading you to relationships that are not only fulfilling but profoundly meaningful."},
                    {"time": 132337, "value": "I’m here with you, every step of the way, as you uncover the beauty and wisdom love has to offer."}
                ];

                number_audio_time = 137.736;
            } else if (final_number == 8) {

                realTimeText = [
                    {"time": 0, "value": "Ah, my dear, your Love Path Number is 8, and what a powerful number it is."},
                    {"time": 5167, "value": "Strength, ambition, and achievement are at the core of who you are, aren’t they?"},
                    {"time": 9860, "value": "You navigate through life with such drive and focus, and when it comes to love, you seek relationships that reflect that same energy—empowering, dynamic, and full of potential."},
                    {"time": 20065, "value": "You’re not someone who settles for anything less than greatness."},
                    {"time": 23769, "value": "In love, you are a true leader."},
                    {"time": 26162, "value": "You have this incredible presence, this determination that draws people in."},
                    {"time": 30742, "value": "Your partners must admire how strong you are, how you carry yourself with such confidence and purpose."},
                    {"time": 36684, "value": "You inspire them, don’t you?"},
                    {"time": 38852, "value": "You motivate others to be their best, and that’s such a beautiful gift to bring into a relationship."},
                    {"time": 44282, "value": "You’re not just building love—you’re building something truly meaningful, something that can stand the test of time."},
                    {"time": 50637, "value": "You, my dear, have a natural talent for success."},
                    {"time": 54317, "value": "Whether it’s in your career or your relationships, you’re always thinking about how to make things better, stronger, more secure."},
                    {"time": 61359, "value": "You don’t just dream about a beautiful future—you make it happen."},
                    {"time": 65239, "value": "Your practical approach to love means you’re focused on creating something solid, something that lasts."},
                    {"time": 71032, "value": "It’s not just about today; you’re building a future that’s fulfilling, prosperous, and full of love."},
                    {"time": 77124, "value": "But with all that strength and ambition, I know there are moments when things get a bit tricky, right?"},
                    {"time": 82529, "value": "Sometimes, that drive for success can make it hard to let go of control or to connect on a deeper emotional level."},
                    {"time": 89159, "value": "But, my dear, remember that vulnerability and emotional connection are just as important as achieving your goals."},
                    {"time": 95814, "value": "When you find that balance, your relationships will thrive in ways you never imagined."},
                    {"time": 100882, "value": "You, my strong and determined soul, need a partner who truly appreciates your drive."},
                    {"time": 106149, "value": "Someone who shares your vision for success and is ready to build a future with you."},
                    {"time": 110542, "value": "Look for someone who’s supportive of your goals, who’s willing to walk beside you as you create a life of abundance, not just in material things, but in love and joy as well."},
                    {"time": 119709, "value": "Together, you’ll build something truly powerful."},
                    {"time": 122877, "value": "So, embrace your path, dear one."},
                    {"time": 125794, "value": "It’s filled with opportunities to create a legacy of love and success."},
                    {"time": 130024, "value": "Your journey through romance is a testament to your strength and determination, and it’s leading you to relationships that will empower and reward you in ways that go beyond what you can imagine."},
                    {"time": 139629, "value": "I’m here with you, every step of the way, as you create the love story you’ve always dreamed of."}
                ];

                number_audio_time = 144.696;
            } else if (final_number == 9) {

                realTimeText = [
                    {"time": 0, "value": "Ah, my dear, your Love Path Number is 9, and what a beautiful, soulful number it is."},
                    {"time": 5755, "value": "Empathy, generosity, and a deep sense of universal love flow through you."},
                    {"time": 10497, "value": "You have this incredible way of navigating life with compassion, always seeking connections that go beyond the surface."},
                    {"time": 17140, "value": "For you, love isn’t just about the everyday—it’s something that touches the very core of your soul, isn’t it?"},
                    {"time": 23744, "value": "In your romantic journey, you are such a beautiful giver of love."},
                    {"time": 27624, "value": "You offer so much understanding, always reaching for depth and meaning in your relationships."},
                    {"time": 32904, "value": "It’s not just about being close to someone—you want to connect on a level that’s emotional, spiritual, something profound."},
                    {"time": 39997, "value": "I imagine your partners must feel captivated by your empathy, by the way you can see into their hearts and truly understand them."},
                    {"time": 47464, "value": "You, my dear, have a heart so full of compassion, and it’s a gift."},
                    {"time": 52057, "value": "You see the bigger picture, don’t you?"},
                    {"time": 54549, "value": "You understand the interconnectedness of life, and that wisdom allows you to nurture relationships that are both inspiring and deeply fulfilling."},
                    {"time": 62242, "value": "You bring a sense of unity, a harmony that makes your relationships feel like a safe, warm space for everyone involved."},
                    {"time": 69222, "value": "It’s like you’re able to create a little world of love wherever you go."},
                    {"time": 73302, "value": "But, my sweet soul, I know your compassionate nature can sometimes lead you to take on more than you can handle, right?"},
                    {"time": 80169, "value": "You give so much of yourself, and while that’s such a beautiful strength, it’s important to remember that you need care, too."},
                    {"time": 86887, "value": "Don’t forget to nurture your own heart."},
                    {"time": 89329, "value": "When you find that balance between caring for others and making sure your own needs are met, your relationships will flourish in even more wonderful ways."},
                    {"time": 97472, "value": "You, my generous spirit, are most compatible with someone who truly appreciates the depth of your empathy."},
                    {"time": 103752, "value": "Someone who shares your desire for meaningful connection, who’s ready to explore the deeper aspects of life and love alongside you."},
                    {"time": 110757, "value": "When you find a partner who supports your journey of understanding and connection, the relationship will feel like a profound, shared adventure."},
                    {"time": 118112, "value": "So, embrace your path, dear one."},
                    {"time": 121029, "value": "It’s filled with opportunities to create deep, lasting, and truly profound connections."},
                    {"time": 126384, "value": "Your journey through love is a quest for unity, understanding, and the kind of love that transcends the ordinary."},
                    {"time": 132489, "value": "And I’m right here with you, cheering you on every step of the way as you create the love and connection your heart so deeply deserves."}
                ];

                number_audio_time = 139.008;
            }

                // Get the audio player and dynamic text element

                const dynamicText = document.getElementById('number_' + final_number) + ' p';



                // Convert timestamps from milliseconds to seconds
                realTimeText.forEach(item => item.time /= 1000);


                $(".skipbutton3").click( function(){
                    number_audio.pause();
                    $('#fifth-phase_new').addClass('d-none');

                    $('#third-phase_new').addClass('d-none');
                    // $('#singleno1').addClass('d-none');
                    // $('.energy').addClass('d-none');
                    $('#fourth-phase').removeClass('d-none');

                    var audio4 = document.getElementById("fiveaudio");
                    $('#fivetext').removeClass('d-none');
                    audio4.play();
                    $('#forubuton').removeClass('d-none');
                })

                number_audio.ontimeupdate = async function() {
                let currentTimeAudio = number_audio.currentTime;

                    // Find the last matching text update based on the current time
                    let latestText = realTimeText.reduce((acc, item) => (currentTimeAudio >= item.time ? item.value : acc), "");

                    // Update the text if it has changed
                    if (dynamicText.textContent !== latestText) {
                        $("#number_" + final_number + ' p').text(latestText);
                    }

                    console.log(currentTimeAudio);

                if (currentTimeAudio >= number_audio_time) {

                    number_audio.pause();

                    await wait(3000);

                    $('#third-phase_new').addClass('d-none');
                    // $('#singleno1').addClass('d-none');
                    // $('.energy').addClass('d-none');
                    $('#fourth-phase').removeClass('d-none');

                    var audio4 = document.getElementById("fiveaudio");
                    $('#fivetext').removeClass('d-none');
                    audio4.play();
                    $('#forubuton').removeClass('d-none');
                }
            }

        }

});


async function box1(dateStr) {
    const dateParts = dateStr.split('/');
    const day = dateParts[0];
    const month = dateParts[1];
    const year = dateParts[2];

    const monthNames = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];

    const monthName = monthNames[parseInt(month, 10) - 1];

    function animatedAppend(selector, content) {
        const element = $(`<span style="display:none;">${content}</span>`);
        $(selector).append(element);
        element.slideDown(400); // Will work only if <span> has block/inline-block display
    }

    await wait(1000);
    animatedAppend(".append1", monthName);

    await wait(1500);
    animatedAppend(".append2", parseInt(day, 10));

    await wait(1500);
    animatedAppend(".append3", year);

    const monthS = numberToSingleDigitSum(month);
    await wait(1500);
    animatedAppend(".append1", monthS);

    const dayS = numberToSingleDigitSum(day);
    await wait(1500);
    animatedAppend(".append2", dayS);

    await wait(1500);
    animatedAppend(".append3", numberToTwoDigitSum(year));

    await wait(1500);
    animatedAppend(".append1", monthS);

    await wait(2000);
    animatedAppend(".append2", dayS);

    const yearS = numberToSingleDigitSum(year);
    await wait(1000);
    animatedAppend(".append3", yearS);

    const total = numberToSingleDigitSum(parseInt(monthS, 10) + parseInt(dayS, 10) + parseInt(yearS, 10));
    await wait(1000);
    animatedAppend(".append4", total);

    $('.singleNumber').html(total);
    $(`#number_${total}`).removeClass('d-none');

    return total;
}



// Delay helper
function wait(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}


function formatDate(dateStr) {
    // Split the date string into components [mm, dd, yyyy]


    var dateParts = dateStr.split('/');
    // Get the month, day, and year
    var month = dateParts[1];
    var day = dateParts[0];
    var year = dateParts[2];


    // Convert the month to a full month name
    var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    var monthName = monthNames[parseInt(month) - 1];


    // Return the formatted date
    var monthS = numberToSingleDigitSum(month);
    var dayS = numberToSingleDigitSum(day);
    var yearS = numberToSingleDigitSum(year);

    var totals = numberToSingleDigitSum(parseInt(monthS) + parseInt(dayS) + parseInt(yearS));
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



$('.fourth-phase').on('click', async function () {

    var audio41 = document.getElementById("fiveaudio");
    audio41.pause();
    $('.form-control').removeClass('is-invalid');
    $('.text-danger').hide();
    var error = 0;
    if ($('#birth_name').val() == '') {
        $('#birth_name').addClass('is-invalid');
        $('#birth_name_err').html('Please enter birth name');
        $('#birth_name_err').show();
        error++;
    }

    $('#custom_full_name').val($('#birth_name').val());

    if (error > 0) {
        return false;
    }



    $('#fourth-phase').addClass('d-none');
    $('#fifth-phase').removeClass('d-none');

    var str = $('#birth_name').val();

    var audio5 = document.getElementById("sixaudio");
    audio5.play();

    // realTimeText11 = [
    //     {"time": 0, "value": "Now, let’s uncover your Heart’s Desire Number—a sacred reflection of your inner world and emotional truth."},
    //     {"time": 6542, "value": "This number reveals the secret longings of your soul, the silent wishes you carry in matters of love and connection."},
    //     {"time": 13247, "value": "It speaks to how you express affection, crave intimacy, and what truly makes your heart feel seen and fulfilled."},
    //     {"time": 19889, "value": "Often hidden beneath the surface, this number holds the key to understanding your emotional needs and the kind of love that nourishes you most."},
    //     {"time": 27507, "value": "When you align with its message, you begin attracting relationships that resonate with your truest self."},
    // ];

    realTimeText11 = [
        {"time":0,"value":"Now, let’s uncover your Heart’s Desire Number—a sacred reflection of your inner world and emotional truth."},
        {"time":6292, "value":"This number reveals the secret longings of your soul, the silent wishes you carry in matters of love and connection."},
        {"time":12747, "value":"It speaks to how you express affection, crave intimacy, and what truly makes your heart feel seen and fulfilled."},
        {"time":19140, "value":"When you align with its message, you begin attracting relationships that resonate with your truest self."},
    ];




    // Convert timestamps from milliseconds to seconds
    realTimeText11.forEach(item => {
        item.time = item.time / 1000;
    });

    audio5.ontimeupdate = function () {
        const currentTimeAudio = audio5.currentTime;

        // Find the most recent text whose time is less than or equal to the current time
        let latestText = "";
        for (let i = 0; i < realTimeText11.length; i++) {
            if (currentTimeAudio >= realTimeText11[i].time) {
                latestText = realTimeText11[i].value;
            } else {
                break;
            }
        }

        // Update the text if it has changed
        const dialogTextElement = $('.dialog_box p');
        if (dialogTextElement.text() !== latestText) {
            dialogTextElement.text(latestText);
        }
    };

    // Create a promise that resolves when audio5 ends
    const audioPromise = new Promise(resolve => {
        audio5.onended = resolve;
    });



    const heart_number = await heart_desier_number(str);

    await audioPromise;

    await sleep(500);

    if (heart_number && audioPromise) {

        const nameDigit = $('#custom_heart_desire_number').val();
        $('#forubuton').removeClass('d-none');
        $('#fifth-phase').addClass('d-none');
        $('#fifth-phase_new').removeClass('d-none');
        $('.energy').addClass('d-none');
        $('#numbers_' + nameDigit).removeClass('d-none');

        var number_audio = document.getElementById("audios_" + nameDigit);
        number_audio.play();
        // var number_audio_time = 5;
        var realTimeText = [];
        if (nameDigit == 1) {

            realTimeText = [
                {"time": 0, "value": "I see that your heart’s desire number is 1, a radiant symbol that reveals your deepest desires when it comes to love and connection."},
                {"time": 7055, "value": "It's like a window to your soul, showing me what you truly crave in a relationship."},
                {"time": 11910, "value": "And I can see it so clearly now."},
                {"time": 14227, "value": "At the very core of your being, what you long for most is recognition."},
                {"time": 18320, "value": "You want to be seen, really seen, for who you are."},
                {"time": 21812, "value": "You dream of a partner who not only notices your uniqueness but celebrates it, someone who understands your individuality and takes joy in your accomplishments."},
                {"time": 30342, "value": "Your heart yearns for a love that honors every bit of who you are and encourages you to step into your brilliance."},
                {"time": 36197, "value": "And oh, the kind of partner you’re drawn to!"},
                {"time": 39202, "value": "It’s no wonder."},
                {"time": 40607, "value": "You’re irresistibly attracted to those who carry confidence, ambition—those who reflect the fire and passion you hold inside."},
                {"time": 47762, "value": "What excites you is a relationship built on mutual respect, where admiration flows freely between you and your love."},
                {"time": 54405, "value": "You crave a connection that lifts both of you, where you both feel empowered to become the very best versions of yourselves."},
                {"time": 60910, "value": "True joy, for you, comes from a love that values your independence, while still cherishing the deep bond you share."},
                {"time": 67527, "value": "You thrive in relationships where you can be fully yourself—passionate, curious, and always learning."},
                {"time": 73520, "value": "You seek not just love, but a connection that’s both passionate and intellectually stimulating."},
                {"time": 78925, "value": "And I see you wanting to explore, to dive into the depths of desire and possibility with someone who matches your energy."},
                {"time": 85405, "value": "But there’s more, love."},
                {"time": 87372, "value": "Deep down, you yearn for a connection that nurtures you, that inspires your dreams and challenges you to go even further."},
                {"time": 94015, "value": "You want a partner whose love is bold and adventurous, a love that pushes you toward your destiny with unshakeable support."},
                {"time": 100657, "value": "Your heart is calling for a love that dares to dream with you, to walk beside you as you both reach for the stars."},
                {"time": 106650, "value": "So, my dear, listen to these desires."},
                {"time": 109855, "value": "Nurture them."},
                {"time": 111110, "value": "Trust them."},
                {"time": 112340, "value": "They are your guiding light, pointing you toward the love that aligns perfectly with who you are."},
                {"time": 117395, "value": "Your heart knows exactly what it wants, and in time, it will lead you to the love that fulfills your every longing."}
            ];


            number_audio_time = 123.216;
        } else if (nameDigit == 2) {
            // Set the total audio duration (if needed)

            realTimeText = [
                {"time": 0, "value": "Let's take a gentle look at the number 2, your Heart’s Desire Number."},
                {"time": 4042, "value": "This number, like a quiet whisper from within, reveals the tender longings and deep needs of your heart when it comes to love."},
                {"time": 10885, "value": "It’s as if your soul is softly pointing the way to what will truly make your heart feel whole."},
                {"time": 15777, "value": "At the very core of you, there is a longing—an undeniable desire for connection, real and genuine."},
                {"time": 21845, "value": "You want a partner who not only sees you but truly understands you, someone who values the depth of emotional intimacy as much as you do."},
                {"time": 29512, "value": "Your heart isn’t looking for surface-level love; it craves something deeper, a bond built on trust and mutual understanding."},
                {"time": 36630, "value": "You want to feel seen, heard, and cherished for who you are in the most authentic way."},
                {"time": 41485, "value": "I know, you are naturally drawn to those who are caring and empathetic, just like you."},
                {"time": 46565, "value": "You’re attracted to people who mirror that same sensitivity and warmth."},
                {"time": 50620, "value": "What fills your heart is a relationship where emotions are shared openly and freely, where vulnerability isn’t just accepted but embraced."},
                {"time": 58287, "value": "You want a love that creates a safe space, where you and your partner can let your guards down and let love truly flourish."},
                {"time": 64867, "value": "And there’s more, my dear."},
                {"time": 66972, "value": "You deeply yearn for a love that nurtures your emotional well-being."},
                {"time": 70790, "value": "It’s not just about being in a relationship—it’s about feeling supported, valued, and loved for the beautiful person that you are."},
                {"time": 77870, "value": "You seek a connection that encourages open communication, where emotional honesty flows without fear."},
                {"time": 83900, "value": "In that space, you can be your most authentic self, knowing you’re accepted just as you are."},
                {"time": 89192, "value": "So, dear heart, hold close to these desires."},
                {"time": 92747, "value": "Nurture them, trust them, because they are guiding you toward the love that aligns perfectly with your essence."},
                {"time": 98577, "value": "Your heart knows exactly what it’s searching for, and in time, it will lead you to a love that echoes your deepest, truest desires."}
            ];

            number_audio_time = 105;
        } else if (nameDigit == 3) {
            realTimeText = [
                {"time": 0, "value": "let’s take a moment to dive into the beautiful energy of the number 3, your Heart’s Desire Number."},
                {"time": 5542, "value": "This number is like a bright spark in your soul, revealing what your heart truly craves in love."},
                {"time": 10872, "value": "It’s all about what brings you joy, what makes your spirit come alive in a relationship."},
                {"time": 15702, "value": "At the heart of it all, what you desire most is expression—true, free, and joyful expression."},
                {"time": 21782, "value": "You long for a love where you can be unapologetically yourself, where your partner celebrates your individuality and encourages that vibrant, creative spirit you carry inside."},
                {"time": 31387, "value": "Your heart seeks a love that’s filled with inspiration, where both you and your partner can uplift each other and let your unique lights shine."},
                {"time": 38380, "value": "I can tell, you’re naturally drawn to partners who are outgoing, expressive, and full of life, just like you."},
                {"time": 44885, "value": "It’s as if their energy mirrors your own vibrant nature."},
                {"time": 48227, "value": "What fills your heart is a relationship where dreams and passions are shared openly, where both of you can explore your ideas and aspirations together."},
                {"time": 56495, "value": "You crave a bond that’s dynamic, full of life, and constantly inspiring—where love feels like an adventure you’re both creating."},
                {"time": 63787, "value": "And there’s something more, dear."},
                {"time": 65967, "value": "You yearn for a connection that nurtures your creativity and joy."},
                {"time": 69797, "value": "You need a partner who supports your playful, adventurous side, someone who encourages you to explore new possibilities and to keep dreaming big."},
                {"time": 77827, "value": "You seek a love that’s just as expressive and colorful as your own spirit, one that lets you be your most authentic self, always growing, always creating."},
                {"time": 86370, "value": "So, hold onto these desires, my dear."},
                {"time": 89600, "value": "Nurture them and listen to what they’re telling you."},
                {"time": 92367, "value": "These longings are your heart’s way of guiding you toward a love that aligns perfectly with who you are."},
                {"time": 97597, "value": "Your heart knows exactly what it’s searching for, and it will lead you to a love that resonates with your deepest joys."}
            ];


            number_audio_time = 103;
        } else if (nameDigit == 4) {

            realTimeText = [
                {"time": 0, "value": "let’s take a deep breath and explore the essence of the number 4, your Heart’s Desire Number."},
                {"time": 5167, "value": "This number reveals something so precious about you—what your heart truly craves when it comes to love."},
                {"time": 10910, "value": "It’s all about the desires that bring you a sense of security and fulfillment in a relationship."},
                {"time": 16115, "value": "At the core of your heart, what you long for most is stability."},
                {"time": 19757, "value": "You want a love that feels like home, a relationship built on solid ground."},
                {"time": 24425, "value": "You crave a partner who values commitment just as much as you do, someone who is ready to put in the work to build something lasting and meaningful."},
                {"time": 32030, "value": "Your heart seeks a love that’s grounded in trust, where mutual support becomes the foundation of your connection—a place where you can truly thrive."},
                {"time": 40010, "value": "I can feel that you’re naturally drawn to partners who are dependable and loyal, those who reflect the same values you hold dear."},
                {"time": 46890, "value": "There’s a certain strength in knowing you can rely on each other, and that’s what truly fulfills you—a bond that stands the test of time."},
                {"time": 54195, "value": "You seek a relationship where both of you are there for each other, always, creating something strong and enduring together."},
                {"time": 60987, "value": "But, my dear, it’s not just about stability for stability’s sake."},
                {"time": 65555, "value": "You yearn for a connection that nurtures your sense of security while also allowing for growth."},
                {"time": 70697, "value": "You want a love that provides the space to build a life together, one that is fulfilling and rewarding."},
                {"time": 76277, "value": "You seek a partnership where dedication and stability form the foundation for something even more beautiful—a life where both of you can grow, dream, and create a future together."},
                {"time": 86032, "value": "So, take these desires to heart, dear one."},
                {"time": 89487, "value": "Nurture them."},
                {"time": 90742, "value": "They are guiding you toward the love that aligns perfectly with who you are, with what you truly value."},
                {"time": 96347, "value": "Your heart knows exactly what it’s seeking, and in time, it will lead you to a love that resonates deeply with your essence."}
            ];

            number_audio_time = 102;
        } else if (nameDigit == 5) {

            realTimeText = [
                {"time": 0, "value": "let’s explore the energy of the number 5, your Heart’s Desire Number."},
                {"time": 4330, "value": "This number reveals something beautiful and exciting about you—what your heart truly craves in a romantic partnership."},
                {"time": 10885, "value": "It’s all about joy, fulfillment, and, most of all, freedom."},
                {"time": 15402, "value": "At the very core of your heart, there’s a deep longing for freedom and independence."},
                {"time": 20132, "value": "You’re not someone who wants to be confined or limited in love."},
                {"time": 23737, "value": "You crave a partner who understands and respects that need for space, someone who encourages your adventurous spirit rather than holding it back."},
                {"time": 31467, "value": "Your heart seeks a love that is open and flexible, where both of you are free to grow, explore, and discover new horizons together."},
                {"time": 38910, "value": "I can see that you’re naturally drawn to partners who are spontaneous and adventurous, just like you."},
                {"time": 44640, "value": "You love that energy, that spark that comes from living in the moment and embracing the unknown."},
                {"time": 49857, "value": "What fulfills you most is a relationship where change isn’t feared but welcomed, where both of you are always seeking new experiences and finding inspiration in each other."},
                {"time": 58900, "value": "It’s a bond that’s alive, dynamic, and constantly evolving."},
                {"time": 63092, "value": "But more than anything, my dear, you yearn for a connection that nurtures your sense of freedom."},
                {"time": 68310, "value": "You need a love that lets you express yourself fully, where there’s no holding back or feeling trapped."},
                {"time": 73765, "value": "You want a partnership that’s as open-minded and adventurous as your spirit—one that encourages exploration, whether it’s of the world, your dreams, or each other."},
                {"time": 82707, "value": "So, trust these desires, my dear."},
                {"time": 85750, "value": "Nurture them and honor what they tell you, for they are guiding you toward a love that aligns perfectly with who you are."},
                {"time": 91792, "value": "Your heart knows exactly what it seeks, and in time, it will lead you to a love that resonates with your deepest joys."}
            ];

            number_audio_time = 98;
        } else if (nameDigit == 6) {

            realTimeText = [
                {"time": 0, "value": "let’s talk about the beautiful energy of the number 6, your Heart’s Desire Number."},
                {"time": 4842, "value": "This number reveals what your heart truly longs for in love, and it’s all about creating joy, fulfillment, and, most of all, harmony."},
                {"time": 12947, "value": "At the core of your heart, you crave love that’s peaceful and balanced."},
                {"time": 17040, "value": "You dream of a relationship where there’s mutual respect, where understanding flows easily between you and your partner."},
                {"time": 23482, "value": "You long for a love that feels nurturing and supportive, a connection that gives you both a safe haven—a place where you can truly thrive together."},
                {"time": 31237, "value": "You’re naturally drawn to those who are caring and compassionate, people who reflect your own values of kindness and warmth."},
                {"time": 37792, "value": "And what fulfills you most is a relationship where love is expressed openly, where both partners are there for each other, offering support in every way."},
                {"time": 45947, "value": "You want a bond that feels deep and enduring, something that stands strong through the ups and downs of life."},
                {"time": 51815, "value": "And my dear, you have such a beautiful heart."},
                {"time": 54845, "value": "You yearn for a connection that nurtures your sense of harmony, a love that allows you to express your affection freely and fully."},
                {"time": 61662, "value": "You seek a partnership that’s as nurturing and compassionate as you are, where both of you encourage each other’s growth and understanding, creating a deep, soulful bond."},
                {"time": 70867, "value": "So, dear one, embrace these desires."},
                {"time": 74160, "value": "Hold them close."},
                {"time": 75677, "value": "They are guiding you toward the love that aligns with your true essence."},
                {"time": 79520, "value": "Trust your heart—it knows exactly what it seeks, and in time, it will lead you to a love that resonates with your deepest values."}
            ];

            number_audio_time = 86;
        } else if (nameDigit == 7) {

            realTimeText = [
                {"time": 0, "value": "let’s take a quiet, thoughtful moment to explore the essence of the number 7, your Heart’s Desire Number."},
                {"time": 5955, "value": "This number holds something so special—your deepest cravings when it comes to love, the kind that brings peace and fulfillment to your soul."},
                {"time": 13385, "value": "At the very core of your heart, you long for depth."},
                {"time": 16515, "value": "You want a love that goes beyond the surface, something meaningful and profound."},
                {"time": 21082, "value": "You crave a partner who shares your curiosity about life, someone who is just as eager as you are to explore the spiritual and intellectual dimensions of love."},
                {"time": 29812, "value": "Your heart seeks a relationship that feels enlightening, where both of you can grow together in a way that feels like you’ve found a sanctuary in each other."},
                {"time": 37692, "value": "I can see that you’re naturally drawn to partners who are thoughtful, introspective souls."},
                {"time": 42760, "value": "They reflect your own values—seeking depth, meaning, and wisdom in all things."},
                {"time": 47790, "value": "What truly fulfills you is a relationship where you and your partner can explore life’s mysteries together, sharing your insights, and learning from each other."},
                {"time": 55995, "value": "It’s a bond that feels rich and inspiring, where every conversation and moment together deepens your connection."},
                {"time": 62075, "value": "And, dear heart, I know that you yearn for a love that nurtures your sense of wisdom, a relationship where you can express your true self without fear."},
                {"time": 70142, "value": "You seek a love that’s reflective, insightful, and always encouraging growth."},
                {"time": 74935, "value": "You want a partner who sees the world as you do—with wonder, curiosity, and a desire to understand it all."},
                {"time": 81577, "value": "Together, you’ll create something that goes beyond the ordinary—a love that’s built on shared understanding and a desire to keep growing."},
                {"time": 88895, "value": "So, listen to these desires, my dear."},
                {"time": 92062, "value": "Nurture them, for they are guiding you toward a love that aligns with the deepest truths of who you are."},
                {"time": 97280, "value": "Your heart knows exactly what it seeks, and in time, it will lead you to a love that resonates with the wisdom and depth you carry within."}
            ];

            number_audio_time = 104;

        } else if (nameDigit == 8) {

            realTimeText = [
                {"time": 0, "value": "let’s step into the powerful energy of the number 8, your Heart’s Desire Number."},
                {"time": 4767, "value": "This number reveals something bold and beautiful about what your heart truly craves in love."},
                {"time": 9860, "value": "It’s all about finding a deep sense of fulfillment, empowerment, and joy in a relationship."},
                {"time": 15302, "value": "At the very core of your heart, you long for empowerment."},
                {"time": 18757, "value": "You’re someone who desires success, not just in life but in love as well."},
                {"time": 23175, "value": "You crave a partner who shares that same ambition, someone who’s ready to stand by your side and work together to achieve great things."},
                {"time": 30517, "value": "Your heart seeks a love that’s both powerful and nurturing—a foundation where both of you can thrive and grow together."},
                {"time": 36860, "value": "I can see you’re naturally attracted to partners who are confident and ambitious, and that makes perfect sense."},
                {"time": 43052, "value": "They reflect the same drive and determination that you carry within yourself."},
                {"time": 47507, "value": "What truly fulfills you is a relationship where both of you can pursue your dreams, building a life of abundance and success together."},
                {"time": 54700, "value": "You want a bond that’s dynamic, where you inspire each other to reach new heights, constantly growing and evolving as a team."},
                {"time": 61630, "value": "And, my dear, you yearn for a connection that nurtures your sense of power, where you can express your true self without hesitation."},
                {"time": 69035, "value": "You seek a love that’s just as ambitious and driven as your spirit—a relationship that encourages growth, achievement, and the pursuit of greatness."},
                {"time": 77290, "value": "Together, you and your partner can create something truly extraordinary, a life built on shared goals and deep understanding."},
                {"time": 84395, "value": "So, embrace these desires, dear one."},
                {"time": 87625, "value": "Nurture them, for they’re guiding you toward a love that aligns with your true essence."},
                {"time": 92030, "value": "Your heart knows exactly what it seeks, and in time, it will lead you to a love that resonates with your deepest aspirations and dreams."}
            ];

            number_audio_time = 99;
        } else if (nameDigit == 9) {

            realTimeText = [
                {"time": 0, "value": "let’s take a gentle journey into the meaning of the number 9, your Heart’s Desire Number."},
                {"time": 4980, "value": "This number reveals something so tender and profound about you—what your heart truly craves in love."},
                {"time": 10635, "value": "It’s all about finding deep connection, peace, and fulfillment."},
                {"time": 14690, "value": "At the very core of your heart, you long for connection."},
                {"time": 18082, "value": "You want to be seen and understood in a way that touches your soul."},
                {"time": 21750, "value": "You crave a partner who shares your empathy, someone who is willing to explore the emotional and spiritual depths of love with you."},
                {"time": 28642, "value": "Your heart seeks a love that feels nurturing, a space where both of you can grow and learn together, creating a sanctuary of trust and mutual care."},
                {"time": 36947, "value": "I can feel that you’re naturally drawn to partners who are compassionate and empathetic, and that makes perfect sense."},
                {"time": 43315, "value": "These qualities reflect the very essence of who you are."},
                {"time": 46707, "value": "What truly fulfills you is a relationship where both of you can express your love freely, with deep understanding and kindness."},
                {"time": 53725, "value": "You want a bond that is not only inspiring but also grounded in a shared commitment to caring for each other in every way."},
                {"time": 60355, "value": "And, my dear, you have such a beautiful heart."},
                {"time": 63785, "value": "You yearn for a connection that nurtures your sense of empathy, where you can be your true self, open and vulnerable."},
                {"time": 69977, "value": "You seek a love that’s as compassionate and understanding as your spirit—a love that encourages harmony, growth, and healing."},
                {"time": 77132, "value": "Together, you and your partner can create a bond that brings peace and fulfillment, where both of your souls can flourish."},
                {"time": 83687, "value": "So, listen to these desires, dear one."},
                {"time": 86892, "value": "Nurture them, because they are guiding you toward the love that aligns with your truest essence."},
                {"time": 91847, "value": "Your heart knows what it seeks, and in time, it will lead you to a love that resonates with the deepest truths of who you are."}
            ];

            number_audio_time = 98;
        }

            // Get the audio player and dynamic text element

            const containerheart_desier_number = document.getElementById('numbers_' + nameDigit);
            const dynamicText = containerheart_desier_number.querySelector('p');



            // Convert timestamps from milliseconds to seconds
            realTimeText.forEach(item => item.time /= 1000);

            $(".skipbutton5").click( async function(){

                number_audio.pause();

                $('#fifth-phase_new').addClass('d-none');
                    $('#sixsith-phase').removeClass('d-none');
                    $('.energy').addClass('d-none');



                    // Find the last matching text update based on the current time


                    var audio6 = document.getElementById("sevenaudio");

                    audio6.play();
                    // realTimeText11 = [
                    //     {"time": 0, "value": "Now, let’s uncover your Love Destiny Number—a powerful vibration that whispers the truth about your soul’s romantic purpose."},
                    //     {"time": 7567, "value": "This number holds the secrets of your heart’s higher calling in love, guiding you toward the connections your spirit was meant to experience."},
                    //     {"time": 14997, "value": "Unlike fleeting feelings or passing infatuations, your Love Destiny Number reveals the deeper emotional patterns you’re here to explore in this lifetime."},
                    //     {"time": 23539, "value": "It illuminates your greatest desires in relationships, what kind of partner you're drawn to, and the lessons your soul must learn through love."},
                    //     {"time": 31207, "value": "This number also reflects how you express affection, the energy you bring into relationships, and the kind of bond that helps you feel truly alive."},
                    //     {"time": 39524, "value": "Often, it uncovers the subconscious needs you've been carrying—ones that shape your romantic decisions without you even realizing it."},
                    //     {"time": 47154, "value": "When aligned with your Love Destiny Number, love feels more meaningful, spiritual, and transformative."},
                    //     {"time": 53534, "value": "It acts as a cosmic compass, leading you toward partners and experiences that awaken the best parts of you."},
                    //     {"time": 59889, "value": "Whether you’ve felt lost in love or still searching for that “forever” feeling, this number offers clarity, comfort, and direction."},
                    //     {"time": 67094, "value": "It’s not just a number—it’s the energetic blueprint of your heart’s true destiny."},
                    // ];
                    // realTimeText11 = [
                    //     {"time":0, "value":"Now, let’s uncover your Love Destiny Number—a powerful vibration that whispers the truth about your soul’s romantic purpose."},
                    //     {"time":7380, "value":"This number holds the secrets of your heart’s higher calling in love, guiding you toward the connections your spirit was meant to experience."},
                    //     {"time":14560, "value":"Unlike fleeting feelings or passing infatuations, your Love Destiny Number reveals the deeper emotional patterns you’re here to explore in this lifetime."},
                    //     {"time":23090, "value":"It illuminates your greatest desires in relationships, what kind of partner you're drawn to, and the lessons your soul must learn through love."},
                    //     {"time":30507, "value":"This number also reflects how you express affection, the energy you bring into relationships, and the kind of bond that helps you feel truly alive."},
                    //     {"time":38575, "value":"Often, it uncovers the subconscious needs you've been carrying—ones that shape your romantic decisions without you even realizing it."},
                    //     {"time":45955, "value":"When aligned with your Love Destiny Number, love feels more meaningful, spiritual, and transformative."},
                    // ];
                    // realTimeText11 = [
                    //     {"time":0, "value":"Now, let’s uncover your Love Destiny Number—a powerful vibration that whispers the truth about your soul’s romantic purpose."},
                    //     {"time":7380, "value":"This number holds the secrets of your heart’s higher calling in love, guiding you toward the connections your spirit was meant to experience."},
                    //     {"time":14560, "value":"Unlike fleeting feelings or passing infatuations, your Love Destiny Number reveals the deeper emotional patterns you’re here to explore in this lifetime."},
                    //     {"time":23090, "value":"It illuminates your greatest desires in relationships, what kind of partner you're drawn to, and the lessons your soul must learn through love."}
                    // ];
                    realTimeText11 = [
                        {"time":0,"type":"sentence","start":0,"end":130,"value":"Now, let’s uncover your Love Destiny Number—a powerful vibration that whispers the truth about your soul’s romantic purpose."},
                        {"time":7380,"type":"sentence","start":131,"end":274,"value":"This number holds the secrets of your heart’s higher calling in love, guiding you toward the connections your spirit was meant to experience."},
                        {"time":14497,"type":"sentence","start":275,"end":430,"value":"Unlike fleeting feelings or passing infatuations, your Love Destiny Number reveals the deeper emotional patterns you’re here to explore in this lifetime."},
                        {"time":23027,"type":"sentence","start":431,"end":574,"value":"It illuminates your greatest desires in relationships, what kind of partner you're drawn to, and the lessons your soul must learn through love."},
                        {"time":30445,"type":"sentence","start":575,"end":677,"value":"When aligned with your Love Destiny Number, love feels more meaningful, spiritual, and transformative."}
                    ];
                    // Convert timestamps from milliseconds to seconds
                    realTimeText11.forEach(item => {
                        item.time = item.time / 1000;
                    });

                    audio6.ontimeupdate = function () {
                        const currentTimeAudio = audio6.currentTime;

                        // Find the most recent text whose time is less than or equal to the current time
                        let latestText = "";
                        for (let i = 0; i < realTimeText11.length; i++) {
                            if (currentTimeAudio >= realTimeText11[i].time) {
                                latestText = realTimeText11[i].value;
                            } else {
                                break;
                            }
                        }

                        // Update the text if it has changed
                        const dialogTextElement = $('.dialog_box p');
                        if (dialogTextElement.text() !== latestText) {
                            dialogTextElement.text(latestText);
                        }
                    };

                    // Create a promise that resolves when audio5 ends
                    const audioPromise = new Promise(resolve => {
                        audio6.onended = resolve;
                    });

                    const love_destiny_number = await loveDestinyNumber(str);
                    await audioPromise;

                    await sleep(1000);
                    if(love_destiny_number && audioPromise) {
                        sixnewphase();
                    }

            })

            number_audio.ontimeupdate = async function() {

                    let currentTimeAudio = number_audio.currentTime;

                    // Find the last matching text update based on the current time
                    let latestText = realTimeText.reduce((acc, item) => (currentTimeAudio >= item.time ? item.value : acc), "");

                    // Update the text if it has changed
                    if (dynamicText.textContent !== latestText) {
                        $("#numbers_" + nameDigit + ' p').text(latestText);
                    }
            }


            number_audio.onended = async  function () {

                    console.log("Audio has ended.");

                    number_audio.pause();

                    await sleep(2000);

                    $('#fifth-phase_new').addClass('d-none');
                    $('#sixsith-phase').removeClass('d-none');

                    var audio6 = document.getElementById("sevenaudio");
                    audio6.play();


                    realTimeText11 = [
                        {"time": 0, "value": "Now, let’s uncover your Love Destiny Number—a powerful vibration that whispers the truth about your soul’s romantic purpose."},
                        {"time": 7567, "value": "This number holds the secrets of your heart’s higher calling in love, guiding you toward the connections your spirit was meant to experience."},
                        {"time": 14997, "value": "Unlike fleeting feelings or passing infatuations, your Love Destiny Number reveals the deeper emotional patterns you’re here to explore in this lifetime."},
                        {"time": 23539, "value": "It illuminates your greatest desires in relationships, what kind of partner you're drawn to, and the lessons your soul must learn through love."},
                        {"time": 31207, "value": "This number also reflects how you express affection, the energy you bring into relationships, and the kind of bond that helps you feel truly alive."},
                        {"time": 39524, "value": "Often, it uncovers the subconscious needs you've been carrying—ones that shape your romantic decisions without you even realizing it."},
                        {"time": 47154, "value": "When aligned with your Love Destiny Number, love feels more meaningful, spiritual, and transformative."},
                        {"time": 53534, "value": "It acts as a cosmic compass, leading you toward partners and experiences that awaken the best parts of you."},
                        {"time": 59889, "value": "Whether you’ve felt lost in love or still searching for that “forever” feeling, this number offers clarity, comfort, and direction."},
                        {"time": 67094, "value": "It’s not just a number—it’s the energetic blueprint of your heart’s true destiny."},
                    ];

                    // Convert timestamps from milliseconds to seconds
                    realTimeText11.forEach(item => {
                        item.time = item.time / 1000;
                    });

                    audio6.ontimeupdate = function () {
                        const currentTimeAudio = audio6.currentTime;

                        // Find the most recent text whose time is less than or equal to the current time
                        let latestText = "";
                        for (let i = 0; i < realTimeText11.length; i++) {
                            if (currentTimeAudio >= realTimeText11[i].time) {
                                latestText = realTimeText11[i].value;
                            } else {
                                break;
                            }
                        }

                        // Update the text if it has changed
                        const dialogTextElement = $('.dialog_box p');
                        if (dialogTextElement.text() !== latestText) {
                            dialogTextElement.text(latestText);
                        }
                    };

                    // Create a promise that resolves when audio5 ends
                    const audioPromise = new Promise(resolve => {
                        audio6.onended = resolve;
                    });

                    const love_destiny_number = await loveDestinyNumber(str);
                    await audioPromise;

                    await sleep(1000);
                    if(love_destiny_number && audioPromise) {
                        sixnewphase();
                    }
            };

    }
});

function nameToSingleDigit(name) {
    let sum = 0;
    // Loop through each character of the name
    for (let i = 0; i < name.length; i++) {
        let char = name[i].toUpperCase(); // Convert to uppercase to handle both cases
        // Get position in the alphabet (A=1, B=2, ..., Z=26)
        if (char >= 'A' && char <= 'Z') {
            let position = char.charCodeAt(0) - 'A'.charCodeAt(0) + 1;
            sum += position;
        }
    }
    // Reduce the sum to a single digit
    while (sum >= 10) {
        let tempSum = 0;
        while (sum > 0) {
            tempSum += sum % 10;
            sum = Math.floor(sum / 10);
        }
        sum = tempSum;
    }
    return sum;
}



function listen() {
    $('#eleven-phase').addClass('d-none');
    $('#twelve-phase').removeClass('d-none');

    $('.energy').addClass('d-none');

    var audio10 = document.getElementById("elevenaudio");
    audio10.pause();

    var audio11 = document.getElementById("forteenaudio");
    audio11.play();

    // const realTimeText = [
    //     {"time": 0, "value": "Hi There,"},
    //     {"time": 1392, "value": "You’ve already taken the first step toward understanding your love life on a deeper level."},
    //     {"time": 6247, "value": "You’ve uncovered powerful insights about yourself, and you might be noticing patterns in your relationships that you never saw before."},
    //     {"time": 13314, "value": "But here’s the thing—knowing yourself is just the beginning."},
    //     {"time": 16857, "value": "Understanding how to attract and recognize your true soulmate is where the magic happens."},
    //     {"time": 22299, "value": "Maybe love has always felt just out of reach—like a beautiful dream you can see but never quite touch."},
    //     {"time": 28179, "value": "Maybe you’ve spent countless nights wondering why relationships seem so hard, why the wrong people keep showing up, or why things just don’t last."},
    //     {"time": 36334, "value": "It’s frustrating, isn’t it?"},
    //     {"time": 38752, "value": "You’re not alone."},
    //     {"time": 40232, "value": "Many of us long for that deep, soulful connection—someone who truly sees us, loves us, and understands us."},
    //     {"time": 47149, "value": "But without clarity, the search for love can feel exhausting, confusing, and even hopeless."},
    //     {"time": 52854, "value": "I know, because I’ve been there too."},
    //     {"time": 55347, "value": "Let me share a story with you."},
    //     {"time": 57677, "value": "A Moment of Clarity That Changed Everything"},
    //     {"time": 60707, "value": "Emma was just like you—smart, confident, and full of love to give."},
    //     {"time": 65274, "value": "She had a successful career, great friends, and big dreams."},
    //     {"time": 69392, "value": "But when it came to love, something was always missing."},
    //     {"time": 72972, "value": "She’d tried everything—dating apps, relationship books, even advice from friends and coaches."},
    //     {"time": 78877, "value": "But no matter what she did, the same pattern repeated—partners who were emotionally unavailable or just not looking for something real."},
    //     {"time": 86319, "value": "One evening, feeling drained from yet another disappointing date, she stumbled across something new—numerology."},
    //     {"time": 92962, "value": "She was curious but skeptical."},
    //     {"time": 95342, "value": "How could numbers possibly help her love life?"},
    //     {"time": 98484, "value": "But after years of frustration, she decided to explore it."},
    //     {"time": 102302, "value": "That’s when she discovered her Soulmate Number—and everything changed."},
    //     {"time": 106694, "value": "For the first time, Emma saw why she kept repeating the same relationship mistakes."},
    //     {"time": 111787, "value": "Her Soulmate Number revealed her unique love blueprint—her strengths, challenges, and the kind of partner who would truly make her happy."},
    //     {"time": 119604, "value": "And suddenly, everything made sense."},
    //     {"time": 122222, "value": "Emma realized she had been looking for love in all the wrong places."},
    //     {"time": 126227, "value": "With this newfound clarity, she met Ryan—a kind-hearted, emotionally available man who truly cherished her."},
    //     {"time": 133119, "value": "This is the power of understanding your Soulmate Number."},
    //     {"time": 136624, "value": "Introducing the Solution: Your Soulmate Number Reading"},
    //     {"time": 140342, "value": "Imagine waking up every morning with clarity about your love life."},
    //     {"time": 144334, "value": "No more guessing games, no more heartbreak—just a clear, empowered path to finding the soulmate connection you’ve always wanted."},
    //     {"time": 151427, "value": "That’s exactly what the Soulmate Number Reading does for you."},
    //     {"time": 154932, "value": "With your Soulmate Number Reading, you’ll discover:"},
    //     {"time": 158236, "value": "This isn’t about waiting for the universe to bring you love."},
    //     {"time": 161591, "value": "It’s about understanding yourself, making empowered choices, and opening your heart to the love that’s already meant for you."},
    //     {"time": 168484, "value": "Why This Changes Everything"},
    //     {"time": 170826, "value": "Think about the love you’ve always dreamed of—the kind that makes you feel truly seen, understood, and cherished."},
    //     {"time": 177356, "value": "How much longer are you willing to wait for it?"},
    //     {"time": 180336, "value": "Exclusive Quick Action Bonuses – Limited Time Only"},
    //     {"time": 184341, "value": "To help you on this journey, you’ll also receive these exclusive bonuses:"},
    //     {"time": 189046, "value": "Faith & Marriage—Explore how faith deepens love and builds strong relationships."},
    //     {"time": 194376, "value": "Intimate Sexual Issues—Gain insights into overcoming physical intimacy challenges."},
    //     {"time": 200156, "value": "101 Steps to a Happy Relationship—Strengthen your connection with practical advice."},
    //     {"time": 206074, "value": "Instant Spark—Proven dating strategies to ignite chemistry."},
    //     {"time": 210541, "value": "These bonuses are available for a limited time, so don’t wait."},
    //     {"time": 214809, "value": "Get Your Soulmate Number Reading Risk-Free for 365 Days"},
    //     {"time": 219576, "value": "Imagine this: You can experience the transformation that comes with your Soulmate Number Reading completely risk-free for an entire year."},
    //     {"time": 227019, "value": "That’s right."},
    //     {"time": 228311, "value": "I’m offering a 365-Day, No Questions Asked Guarantee."},
    //     {"time": 233066, "value": "If, for any reason, you don’t feel that your reading has given you the clarity, guidance, and confidence you were hoping for, just let me know."},
    //     {"time": 241009, "value": "I’ll give you a full refund—no questions asked."},
    //     {"time": 244301, "value": "You have absolutely nothing to lose and everything to gain."},
    //     {"time": 247944, "value": "Reserve your reading now and receive:"},
    //     {"time": 250673, "value": "Your Soulmate Number Reading"},
    //     {"time": 252941, "value": "Four Amazing Bonuses"},
    //     {"time": 255208, "value": "Complete Peace of Mind with a risk-free guarantee"},
    //     {"time": 258563, "value": "All this, for just $XX, marked down from $XX."},
    //     {"time": 262718, "value": "This is your chance to unlock the love you’ve been dreaming of—completely risk-free."},
    //     {"time": 267361, "value": "Don’t miss out."},
    //     {"time": 268803, "value": "Reserve your reading today."},
    //     {"time": 271021, "value": "Final Call: The Love You Deserve is Waiting for You"},
    //     {"time": 274488, "value": "Your soulmate is closer than you think."},
    //     {"time": 276993, "value": "You just need the clarity and confidence to find them."},
    //     {"time": 280261, "value": "Get your Soulmate Number Reading now and unlock the love you’ve been waiting for."},
    //     {"time": 284578, "value": "Love is closer than you think."}
    // ];
    const realTimeText = [
            {"time":0,"type":"sentence","start":0,"end":92, "image_id": "saimg1", "value":"You’ve already taken the first step toward understanding your love life on a deeper level."},
            {"time":4855,"type":"sentence","start":93,"end":229, "image_id": "saimg1", "value":"You’ve uncovered powerful insights about yourself, and you might be noticing patterns in your relationships that you never saw before."},
            {"time":11922,"type":"sentence","start":230,"end":294, "image_id": "saimg1", "value":"But here’s the thing—knowing yourself is just the beginning."},
            {"time":15465,"type":"sentence","start":295,"end":335, "image_id": "saimg1", "value":"Now, it’s time to go beyond insight…"},
            {"time":18357,"type":"sentence","start":336,"end":380, "image_id": "saimg1", "value":"and actually see who your soulmate might be."},
            {"time":21212,"type":"sentence","start":381,"end":470, "image_id": "saimg1", "value":"Understanding how to attract and recognize your true soulmate is where the magic happens."},
            {"time":26405,"type":"sentence","start":471,"end":587, "image_id": "saimg1", "value":"And with your Soulmate Number Reading—plus a personalized Soulmate Sketch—you’ll not only gain deep clarity…"},
            {"time":32572,"type":"sentence","start":588,"end":660, "image_id": "saimg1", "value":"but a real, visual connection to the one your heart is destined to meet."},
            {"time":36702,"type":"sentence","start":661,"end":765, "image_id": "saimg2", "value":"Maybe love has always felt just out of reach—like a beautiful dream you can see but never quite touch."},
            {"time":42582,"type":"sentence","start":766,"end":916, "image_id": "saimg2", "value":"Maybe you’ve spent countless nights wondering why relationships seem so hard, why the wrong people keep showing up, or why things just don’t last."},
            {"time":50737,"type":"sentence","start":917,"end":948, "image_id": "saimg2", "value":"It’s frustrating, isn’t it?"},
            {"time":52905,"type":"sentence","start":949,"end":968, "image_id": "saimg3", "value":"You’re not alone."},
            {"time":54385,"type":"sentence","start":969,"end":1077, "image_id": "saimg3", "value":"Many of us long for that deep, soulful connection—someone who truly sees us, loves us, and understands us."},
            {"time":61302,"type":"sentence","start":1078,"end":1169, "image_id": "saimg3", "value":"But without clarity, the search for love can feel exhausting, confusing, and even hopeless."},
            {"time":67007,"type":"sentence","start":1170,"end":1208, "image_id": "saimg3", "value":"I know, because I’ve been there too."},
            {"time":69500,"type":"sentence","start":1209,"end":1239, "image_id": "saimg3", "value":"Let me share a story with you."},
            {"time":71580,"type":"sentence","start":1240,"end":1308, "image_id": "saimg5", "value":"Emma was just like you—smart, confident, and full of love to give."},
            {"time":76147,"type":"sentence","start":1309,"end":1368, "image_id": "saimg5", "value":"She had a successful career, great friends, and big dreams."},
            {"time":80265,"type":"sentence","start":1369,"end":1424, "image_id": "saimg5", "value":"But when it came to love, something was always missing."},
            {"time":83595,"type":"sentence","start":1425,"end":1522, "image_id": "saimg6", "value":"She’d tried everything—dating apps, relationship books, even advice from friends and coaches."},
            {"time":89500,"type":"sentence","start":1523,"end":1660, "image_id": "saimg6", "value":"But no matter what she did, the same pattern repeated—partners who were emotionally unavailable or just not looking for something real."},
            {"time":96942,"type":"sentence","start":1661,"end":1774, "image_id": "saimg6", "value":"One evening, feeling drained from yet another disappointing date, she stumbled across something new—numerology."},
            {"time":103585,"type":"sentence","start":1775,"end":1805, "image_id": "saimg6", "value":"She was curious but skeptical."},
            {"time":105965,"type":"sentence","start":1806,"end":1852, "image_id": "saimg6", "value":"How could numbers possibly help her love life?"},
            {"time":108857,"type":"sentence","start":1853,"end":1911, "image_id": "saimg7", "value":"But after years of frustration, she decided to explore it."},
            {"time":112675,"type":"sentence","start":1912,"end":1986, "image_id": "saimg7", "value":"That’s when she discovered her Soulmate Number—and everything changed."},
            {"time":116817,"type":"sentence","start":1987,"end":2070, "image_id": "saimg8", "value":"For the first time, Emma saw why she kept repeating the same relationship mistakes."},
            {"time":121910,"type":"sentence","start":2071,"end":2210, "image_id": "saimg8", "value":"Her Soulmate Number revealed her unique love blueprint—her strengths, challenges, and the kind of partner who would truly make her happy."},
            {"time":129477,"type":"sentence","start":2211,"end":2321, "image_id": "saimg8", "value":"Emma received a Soulmate Sketch—a visual representation of the one who matched her energetic love frequency."},
            {"time":135820,"type":"sentence","start":2322,"end":2363, "image_id": "saimg8", "value":"The moment she saw it, something clicked."},
            {"time":138462,"type":"sentence","start":2364,"end":2445, "image_id": "saimg8", "value":"A wave of recognition washed over her, like she had met this person in a dream..."},
            {"time":143192,"type":"sentence","start":2446,"end":2482, "image_id": "saimg9", "value":"And suddenly, everything made sense."},
            {"time":145810,"type":"sentence","start":2483,"end":2551, "image_id": "saimg9", "value":"Emma realized she had been looking for love in all the wrong places."},
            {"time":149815,"type":"sentence","start":2552,"end":2661, "image_id": "saimg9", "value":"With this newfound clarity, she met Ryan—a kind-hearted, emotionally available man who truly cherished her."},
            {"time":156457,"type":"sentence","start":2662,"end":2718, "image_id": "saimg10", "value":"This is the power of understanding your Soulmate Number."},
            {"time":159712,"type":"sentence","start":2719,"end":2834, "image_id": "saimg10", "value":"And when paired with your Soulmate Sketch, it becomes even more powerful—because now, love not only feels real…"},
            {"time":166380,"type":"sentence","start":2835,"end":2849, "image_id": "saimg10", "value":"It looks real."},
            {"time":167797,"type":"sentence","start":2850,"end":2916, "image_id": "saimg11", "value":"Imagine waking up every morning with clarity about your love life."},
            {"time":171790,"type":"sentence","start":2917,"end":3049, "image_id": "saimg11", "value":"No more guessing games, no more heartbreak—just a clear, empowered path to finding the soulmate connection you’ve always wanted."},
            {"time":178882,"type":"sentence","start":3050,"end":3113, "image_id": "saimg11", "value":"That’s exactly what the Soulmate Number Reading does for you."},
            {"time":182387,"type":"sentence","start":3114,"end":3224, "image_id": "saimg11", "value":"And now, with your Soulmate Sketch, you’ll see the face of the person who aligns with your romantic destiny."},
            {"time":188430,"type":"sentence","start":3225,"end":3358, "image_id": "saimg12", "value":"With your Soulmate Number Reading, you’ll discover, Who You Truly Are in Love—your strengths, emotional needs, and love patterns."},
            {"time":196160,"type":"sentence","start":3359,"end":3456, "image_id": "saimg12", "value":"Your Ideal Soulmate Match—the energy and qualities of the person truly aligned with your heart."},
            {"time":201690,"type":"sentence","start":3457,"end":3549, "image_id": "saimg12", "value":"Opportunities for Love—when love is likely to appear and how to recognize it when it does."},
            {"time":206957,"type":"sentence","start":3550,"end":3638, "image_id": "saimg12", "value":"What’s Holding You Back—uncovering limiting beliefs or patterns that keep you stuck."},
            {"time":211850,"type":"sentence","start":3639,"end":3739, "image_id": "saimg12", "value":"Your Soulmate Sketch—a personalized, intuitive sketch revealing the face of your destined partner."},
            {"time":217617,"type":"sentence","start":3740,"end":3802, "image_id": "saimg14", "value":"This isn’t about waiting for the universe to bring you love."},
            {"time":220972,"type":"sentence","start":3803,"end":3932, "image_id": "saimg14", "value":"It’s about understanding yourself, making empowered choices, and opening your heart to the love that’s already meant for you."},
            {"time":227615,"type":"sentence","start":3933,"end":4050, "image_id": "saimg14", "value":"Think about the love you’ve always dreamed of—the kind that makes you feel truly seen, understood, and cherished."},
            {"time":234145,"type":"sentence","start":4051,"end":4098, "image_id": "saimg14", "value":"How much longer are you willing to wait for it?"},
            {"time":237124,"type":"sentence","start":4100,"end":4258, "image_id": "saimg15", "value":"To help you on this journey, you’ll also receive these exclusive bonuses, Faith & Marriage—Explore how faith deepens love and builds strong relationships."},
            {"time":246104,"type":"sentence","start":4259,"end":4343, "image_id": "saimg15", "value":"Intimate Sexual Issues—Gain insights into overcoming physical intimacy challenges."},
            {"time":251634,"type":"sentence","start":4344,"end":4429, "image_id": "saimg15", "value":"101 Steps to a Happy Relationship—Strengthen your connection with practical advice."},
            {"time":257302,"type":"sentence","start":4430,"end":4491, "image_id": "saimg15", "value":"Instant Spark—Proven dating strategies to ignite chemistry."},
            {"time":261519,"type":"sentence","start":4492,"end":4556, "image_id": "saimg16", "value":"These bonuses are available for a limited time, so don’t wait."},
            {"time":265537,"type":"sentence","start":4557,"end":4694, "image_id": "saimg17", "value":"Imagine this, You can experience the transformation that comes with your Soulmate Number Reading completely risk-free for an entire year."},
            {"time":272917,"type":"sentence","start":4695,"end":4710, "image_id": "saimg17", "value":"That’s right."},
            {"time":274209,"type":"sentence","start":4711,"end":4766, "image_id": "saimg17", "value":"I’m offering a 365-Day, No Questions Asked Guarantee."},
            {"time":278964,"type":"sentence","start":4767,"end":4912, "image_id": "saimg17", "value":"If, for any reason, you don’t feel that your reading has given you the clarity, guidance, and confidence you were hoping for, just let me know."},
            {"time":286907,"type":"sentence","start":4913,"end":4964, "image_id": "saimg17", "value":"I’ll give you a full refund—no questions asked."},
            {"time":290199,"type":"sentence","start":4965,"end":5024, "image_id": "saimg17", "value":"You have absolutely nothing to lose and everything to gain."},
            {"time":293842,"type":"sentence","start":5025,"end":5077, "image_id": "saimg17", "value":"All this, for just $24.90, marked down from $169.90."},
            {"time":300834,"type":"sentence","start":5078,"end":5117, "image_id": "saimg18", "value":"Your soulmate is closer than you think."},
            {"time":303339,"type":"sentence","start":5118,"end":5172, "image_id": "saimg18", "value":"You just need the clarity and confidence to find them."},
            {"time":306607,"type":"sentence","start":5173,"end":5288, "image_id": "saimg18", "value":"Get your Soulmate Sketch and Soulmate Number Reading now—and see what love has been trying to show you all along."},
            {"time":312587,"type":"sentence","start":5289,"end":5319, "image_id": "saimg18", "value":"Love is closer than you think."}

    ];



    const dynamicText = document.getElementById('product_text');

    // Convert timestamps from milliseconds to seconds
    realTimeText.forEach(item => item.time /= 1000);


    audio11.ontimeupdate = async function() {
        let currentTimeAudio = audio11.currentTime;
        //Find the image to display
        let latestImageId = realTimeText.reduce((acc, item) => (currentTimeAudio >= item.time ? item.image_id : acc), "");

        document.querySelectorAll('.fadeImagesContent img').forEach(img => {
            img.classList.add('d-none');
        });

        // Show the current image if an ID was found
        if (latestImageId) {
            const currentImage = document.getElementById(latestImageId);
            if (currentImage) {
                currentImage.classList.remove('d-none');
            }
        }
        // Find the last matching text update based on the current time
        let latestText = realTimeText.reduce((acc, item) => (currentTimeAudio >= item.time ? item.value : acc), "");

        // Update the text if it has changed
        if (dynamicText.textContent !== latestText) {
            $("#product_text").text(latestText);
        }

        await wait(2000);

        if (currentTimeAudio >= 284.578) {
            audio11.pause();
            $('#twelve-phase').addClass('d-none');
            $('#thirteen-phase').removeClass('d-none');
        }

    }
}

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

$('.fourth-phase').on('click', function () {
    var audio41 = document.getElementById("fiveaudio");
})

$(document).on('click', '.btnSubmit', function(e) {
    e.preventDefault();
    $('.stLoading').show();
    //toastr.remove();
    $('#errmsg').hide();
    var fd = new FormData($('#payment-form')[0]);
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
            } else {
                if (res.success == 1) {
                    window.location.href = res.redirect_url;
                } else {
                    toastr.error('Something went wrong! Please try again.');
                }
            }
        }
    });
});

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}


function sixnewphase()
{


    var str = $('#birth_name').val();

    var nameDigit = $('#custom_love_destiny_number').val();

    $('#sixsith-phase').addClass('d-none');
    $('#sixsith-phase_new').removeClass('d-none');
    $('.energy').addClass('d-none');
    $('#lovenumbers_' + nameDigit).removeClass('d-none');



    var number_audio = document.getElementById("loveaudios_" + nameDigit);
        number_audio.play();

        var realTimeText = [];
            if (nameDigit == 1) {

                realTimeText = [
                    { "time": 0, "value": "We’ve arrived at a beautiful part of your journey—understanding the meaning of the number 1 as your Love Destiny Number." },
                    { "time": 6255, "value": "This number speaks to how you naturally move through love and the qualities you bring to your romantic relationships." },
                    { "time": 12385, "value": "It shines a light on the path you are destined to walk when it comes to love." },
                    { "time": 16502, "value": "In matters of the heart, you are a natural leader." },
                    { "time": 19670, "value": "You carry a sense of direction, clarity, and purpose that inspires those lucky enough to be by your side." },
                    { "time": 25800, "value": "You bring vision to your relationships, and your confidence sets the stage for a love that is vibrant and fulfilling." },
                    { "time": 32055, "value": "You’re not one to simply follow—you lead with grace, and that leadership brings a beautiful energy to your romantic life." },
                    { "time": 38610, "value": "One of your greatest gifts, my dear, is your ability to take charge while navigating challenges with ease." },
                    { "time": 44690, "value": "It’s not just about solving problems—it’s about seeing the potential in your partner and in the relationship itself." },
                    { "time": 51020, "value": "You have a way of bringing out the very best in the people you love, encouraging them to chase their dreams while building a strong foundation together." },
                    { "time": 58800, "value": "Your determination and focus are truly contagious, and your partner will feel empowered just being by your side, knowing that together, anything is possible." },
                    { "time": 67430, "value": "And when it comes to who you’re destined to connect with, it’s clear that your path leads to partners who respect your need for independence." },
                    { "time": 74410, "value": "You’re drawn to someone who appreciates your visionary approach to life—someone who can stand beside you as an equal, celebrating your strength while contributing their own." },
                    { "time": 83552, "value": "Together, you’ll create a relationship that’s dynamic, inspiring, and constantly pushing both of you toward your highest dreams." },
                    { "time": 90907, "value": "But remember, my dear, your love story isn’t just about the present." },
                    { "time": 95350, "value": "You’re building something far greater—a legacy of love." },
                    { "time": 98867, "value": "Your destiny is to create partnerships that transform both your life and the lives of those you touch." },
                    { "time": 104435, "value": "The love you build will leave a lasting impact, something beautiful that lives on in the hearts of those you hold dear." },
                    { "time": 110377, "value": "So, embrace your role as a leader in love." },
                    { "time": 113545, "value": "Trust that your path will guide you toward relationships that are as powerful and visionary as you are." }
                ];


                number_audio_time = 113.545;

            } else if (nameDigit == 2) {
                // Set the total audio duration (if needed)

                realTimeText = [
                    { "time": 0, "value": "We’ve now come to the meaning of the number 2 as your Love Destiny Number." },
                    { "time": 4067, "value": "This number reveals the beautiful, natural way you move through love, highlighting the qualities you bring into your relationships." },
                    { "time": 11097, "value": "It shows the path you are meant to walk when it comes to love and connection." },
                    { "time": 15177, "value": "In love, you are a true partner—a beacon of harmony." },
                    { "time": 18745, "value": "You bring a sense of balance and peace into your relationships that is simply undeniable." },
                    { "time": 23750, "value": "You have this incredible ability to create unity, making your partner feel valued, understood, and truly seen." },
                    { "time": 30655, "value": "Your presence alone brings calm, and that’s one of your greatest gifts in love." },
                    { "time": 34997, "value": "Your empathy and understanding are the heart of your love." },
                    { "time": 38277, "value": "You seem to always know what your partner needs, often before they even say a word." },
                    { "time": 43032, "value": "You have a remarkable ability to sense their emotions, to feel their highs and lows, and to respond in a way that creates an environment of support and encouragement." },
                    { "time": 52012, "value": "You have such a gentle yet powerful way of making those you love feel cherished, and that is your gift to the world." },
                    { "time": 58042, "value": "When it comes to your destined connections, you’re drawn to partners who share your values of cooperation and emotional connection." },
                    { "time": 64910, "value": "You don’t seek love that’s surface-level—you want something deeper, a bond that’s built on mutual respect and shared emotional growth." },
                    { "time": 72152, "value": "Together, you and your partner will create a relationship that’s not only nurturing but also inspiring, where both of you can truly thrive in the safety of that love." },
                    { "time": 80982, "value": "And remember, my dear, your love journey isn’t just about the here and now." },
                    { "time": 85587, "value": "You’re building something lasting—a legacy of love and connection." },
                    { "time": 89517, "value": "Your destiny is to create partnerships that transform both your life and the lives of those you hold dear." },
                    { "time": 95247, "value": "The love you nurture will ripple out, leaving a lasting impact on the hearts of those around you." },
                    { "time": 100465, "value": "So, celebrate these beautiful qualities you carry within, dear one." },
                    { "time": 105045, "value": "Your ability to bring harmony, compassion, and understanding into your relationships paves the way for a love that’s deeply rewarding and meaningful." },
                    { "time": 113062, "value": "You are destined for a life filled with love, and your presence alone creates a space where hearts can flourish." }
                ];

                number_audio_time = 113.062;
            } else if (nameDigit == 3) {

                realTimeText = [
                    { "time": 0, "value": "Let’s explore the delightful meaning of the number 3 as your Love Destiny Number." },
                    { "time": 4630, "value": "This number reveals something truly special about you—how you naturally move through love and the beautiful qualities you bring into your relationships." },
                    { "time": 12735, "value": "It’s a joyful path you’re walking, one filled with light and love." },
                    { "time": 16640, "value": "In romance, you are a true source of joy and inspiration." },
                    { "time": 20495, "value": "There’s something about your energy that makes everything brighter, more exciting, and full of wonder." },
                    { "time": 26012, "value": "You have this magical ability to create a vibrant and lively atmosphere in your relationships, drawing others in with your enthusiasm and zest for life." },
                    { "time": 34467, "value": "Your love feels like an adventure, one filled with endless possibilities and unforgettable moments." },
                    { "time": 40160, "value": "Your creativity and enthusiasm—oh, these are your greatest gifts in love." },
                    { "time": 45102, "value": "You have a way of turning even the simplest moments into something extraordinary." },
                    { "time": 49570, "value": "Whether it’s a small gesture or a spontaneous adventure, you infuse passion and energy into everything you do." },
                    { "time": 56087, "value": "With you, love never feels dull or routine—it’s always alive, always evolving, always full of wonder." },
                    { "time": 62680, "value": "You are destined to connect with partners who share that same zest for life." },
                    { "time": 66922, "value": "People who appreciate your creative spirit and who, like you, see life as something to be explored and cherished." },
                    { "time": 73315, "value": "Together, you will build a relationship that’s exhilarating yet nurturing, one that allows both of you to grow, explore, and flourish side by side." },
                    { "time": 81757, "value": "It will be a love that’s not only exciting but also deeply supportive." },
                    { "time": 85862, "value": "And remember, my dear, your love journey is about so much more than the present moment." },
                    { "time": 90880, "value": "You’re building a legacy of joy and inspiration." },
                    { "time": 93897, "value": "Your destiny is to create partnerships that are transformative, leaving a lasting impact not only on your life but on the lives of everyone you touch." },
                    { "time": 102127, "value": "The joy you bring into your relationships will ripple out, spreading love and happiness far beyond just you and your partner." },
                    { "time": 108632, "value": "So, celebrate these beautiful qualities within yourself, dear one." },
                    { "time": 113100, "value": "Your creativity, your joy, your boundless enthusiasm—they pave the way for a love that is both rewarding and vibrant." },
                    { "time": 120242, "value": "You are a beacon of light and adventure, destined to live a life filled with love, wonder, and endless possibilities." }
                ];

                number_audio_time = 120.242;
            } else if (nameDigit == 4) {

                realTimeText = [
                    {"time": 0, "value": "We’ve now come to the meaning of the number 4 as your Love Destiny Number."},
                    {"time": 4067, "value": "This number speaks to the beautiful way you approach love and the qualities that make your relationships so special."},
                    {"time": 10160, "value": "It shows the steady and reliable path you are destined to walk in matters of the heart."},
                    {"time": 14890, "value": "In love, you are a pillar of strength—a steady partner who brings security and stability into your relationships."},
                    {"time": 21520, "value": "You create a nurturing environment where love can truly flourish."},
                    {"time": 25450, "value": "Your presence alone makes your partner feel safe, supported, and valued, and that’s one of the most precious gifts you bring to your connections."},
                    {"time": 33080, "value": "Your ability to create order and structure, both in life and in love, is such a powerful strength."},
                    {"time": 38835, "value": "You have this incredible knack for building relationships that are not only secure but also deeply fulfilling."},
                    {"time": 44927, "value": "You know how to ensure that both you and your partner feel cared for, appreciated, and fully supported."},
                    {"time": 50845, "value": "With you, love isn’t chaotic or unpredictable—it’s a solid foundation that both of you can count on."},
                    {"time": 56950, "value": "And when it comes to your destined connections, you are drawn to partners who share your values of loyalty and commitment."},
                    {"time": 63317, "value": "These are the people who, like you, value the beauty of an enduring, stable love."},
                    {"time": 68372, "value": "Together, you’ll build a relationship that stands the test of time—one that is both rewarding and full of growth."},
                    {"time": 74727, "value": "It’s a love that allows both of you to thrive, knowing that you are each other’s anchor in life."},
                    {"time": 79782, "value": "As you continue on your love path, remember that your relationships are about more than just the present."},
                    {"time": 85425, "value": "You are creating a legacy of stability and dedication, a love that leaves a lasting impact not only on your life but on the lives of those you hold dear."},
                    {"time": 93692, "value": "The partnerships you build will transform and strengthen not just you and your partner, but everyone touched by your love."},
                    {"time": 100047, "value": "So, celebrate these wonderful qualities you possess, dear one."},
                    {"time": 104277, "value": "Your strength, your reliability, your ability to create a secure and loving environment—they pave the way for a love that is both rewarding and enduring."},
                    {"time": 112632, "value": "You are a beacon of stability, destined to lead a life filled with love, security, and deep connection."}
                ];

                number_audio_time = 112.632;
            } else if (nameDigit == 5) {

                realTimeText = [
                    {"time": 0, "value": "We’ve now reached the beautiful meaning of the number 5 as your Love Destiny Number."},
                    {"time": 4505, "value": "This number shines a light on your natural way of loving and the qualities that make your romantic connections so full of life and energy."},
                    {"time": 11585, "value": "It reveals the path you are destined to walk in love, one that is vibrant and full of adventure."},
                    {"time": 17002, "value": "In love, you are a free spirit, a source of energy and inspiration."},
                    {"time": 21470, "value": "You bring excitement and possibility into your relationships, filling them with a sense of wonder and adventure."},
                    {"time": 27550, "value": "With you, love feels alive—always evolving, always full of new possibilities."},
                    {"time": 32942, "value": "You have this magical ability to create a vibrant and lively atmosphere that draws others in, making your relationships feel dynamic and exhilarating."},
                    {"time": 41572, "value": "Your adaptability and openness—oh, my dear, these are your greatest gifts in love."},
                    {"time": 46952, "value": "You have a remarkable ability to embrace change, to see challenges as opportunities for growth."},
                    {"time": 52570, "value": "Where others might feel uncertain, you bring enthusiasm and energy, turning even the unexpected into something beautiful."},
                    {"time": 59412, "value": "You infuse your relationships with this wonderful sense of possibility, always finding ways to keep love fresh and exciting."},
                    {"time": 66380, "value": "You are destined to connect with partners who share your love for adventure, people who appreciate your free-spirited nature and are ready to explore life by your side."},
                    {"time": 75022, "value": "Together, you will create a relationship that’s both exhilarating and nurturing, a love that encourages both of you to grow and flourish."},
                    {"time": 82577, "value": "It will be a bond that’s as freeing as it is supportive, allowing both of you to chase your dreams while staying connected at the heart."},
                    {"time": 89207, "value": "And as you continue on your love journey, remember that your relationships are about so much more than the here and now."},
                    {"time": 95412, "value": "You’re creating a legacy of freedom and exploration."},
                    {"time": 98730, "value": "Your destiny is to build partnerships that transform both your life and the lives of those you touch, leaving a lasting impact that goes beyond love itself."},
                    {"time": 107122, "value": "So, celebrate these incredible qualities you possess, dear one."},
                    {"time": 111490, "value": "Your energy, your adaptability, your adventurous spirit—they are leading you toward a love that is deeply rewarding and full of excitement."},
                    {"time": 119182, "value": "You are a beacon of freedom and inspiration, destined to lead a life filled with love, exploration, and endless possibilities."}
                ];

                number_audio_time = 119.182;
            } else if (nameDigit == 6) {

                realTimeText = [
                    { "time": 0, "value": "Let's explore the significance of the number 6 as your Love Destiny Number." },
                    { "time": 4380, "value": "This number reveals something so tender and beautiful about the way you approach love." },
                    { "time": 9022, "value": "It shows how you naturally bring warmth, care, and harmony into your relationships, lighting the path you are destined to walk in love." },
                    { "time": 16540, "value": "In romance, you are a caring partner, a true source of love and support." },
                    { "time": 21320, "value": "You have this incredible ability to create a space where love can truly flourish, a nurturing environment that feels safe and warm." },
                    { "time": 28712, "value": "Your presence in a relationship brings a deep sense of stability, making your partner feel cherished, valued, and cared for." },
                    { "time": 35880, "value": "It’s such a special gift you bring to those you love." },
                    { "time": 38897, "value": "One of your greatest strengths in love is your ability to create harmony and balance." },
                    { "time": 43502, "value": "You have a natural talent for building relationships that are both supportive and loving, where both you and your partner feel seen and appreciated." },
                    { "time": 51245, "value": "Your love is never one-sided—you ensure that there is always a beautiful balance between giving and receiving, making your relationships feel strong and deeply fulfilling." },
                    { "time": 60400, "value": "And when it comes to your destined connections, you are drawn to partners who share your values of love, harmony, and care." },
                    { "time": 67230, "value": "Together, you will build a relationship that is both nurturing and rewarding—a bond that allows both of you to grow and thrive, always lifting each other up." },
                    { "time": 75647, "value": "It’s a love that feels like home, a safe haven where both hearts can blossom." },
                    { "time": 80390, "value": "As you walk your path of love, remember that your relationships are about more than just the present moment." },
                    { "time": 86157, "value": "You’re building a legacy of love and care, one that leaves a lasting impact not only on your life but on the lives of those around you." },
                    { "time": 93175, "value": "The love you cultivate will ripple out, touching the hearts of everyone who experiences the warmth and compassion you bring." },
                    { "time": 99817, "value": "So, celebrate these beautiful qualities, dear one." },
                    { "time": 103585, "value": "Your ability to love deeply, to care, and to create harmony is leading you toward a love that is both rewarding and nurturing." },
                    { "time": 110627, "value": "You are a beacon of love and compassion, destined to lead a life filled with harmony, understanding, and lasting connection." }
                ];

                number_audio_time = 110.627;
            } else if (nameDigit == 7) {

                realTimeText = [
                    { "time": 0, "value": "Let's take a moment to reflect on the significance of the number 7 as your Love Destiny Number." },
                    { "time": 5255, "value": "This number reveals something truly special about how you approach love—how you bring wisdom, depth, and insight into your relationships." },
                    { "time": 13197, "value": "It highlights the profound path you are destined to walk when it comes to love." },
                    { "time": 17477, "value": "In romance, you are a wise partner, a source of deep understanding and reflection." },
                    { "time": 22720, "value": "You bring a sense of calm and thoughtfulness to your relationships, often creating a space where love can flourish through meaningful conversations and shared insights." },
                    { "time": 31437, "value": "With you, love is never superficial—it’s always rich, always thoughtful, always reaching for something deeper." },
                    { "time": 38105, "value": "One of your greatest strengths is your ability to see beyond the surface." },
                    { "time": 42147, "value": "You have this incredible talent for exploring the deeper meanings of love, for seeking out the truth and understanding the essence of what binds two hearts together." },
                    { "time": 50602, "value": "You build relationships that are not just loving, but profound and enlightening." },
                    { "time": 55082, "value": "You ensure that both you and your partner feel truly understood, valued, and appreciated on a level that goes beyond the ordinary." },
                    { "time": 62375, "value": "And when it comes to your destined connections, you are drawn to partners who share your love for depth and spirituality." },
                    { "time": 68717, "value": "These are the souls who, like you, seek something more in love—a connection that’s not just emotional, but also spiritual and intellectual." },
                    { "time": 76785, "value": "Together, you will create a relationship that’s both enlightening and deeply rewarding, one that allows both of you to grow and evolve in the most beautiful ways." },
                    { "time": 85190, "value": "As you walk this love path, remember that your relationships are about so much more than just the present moment." },
                    { "time": 91207, "value": "You are creating a legacy of wisdom, understanding, and shared insight." },
                    { "time": 95875, "value": "Your destiny is to build partnerships that transform not only your life but also the lives of those around you." },
                    { "time": 101955, "value": "The wisdom and depth you bring into your relationships will leave a lasting impact, touching the hearts and minds of those you love." },
                    { "time": 108610, "value": "So, celebrate these incredible qualities within yourself, dear one." },
                    { "time": 113202, "value": "Your insight, your depth, your ability to love with such wisdom—they are leading you toward a love that is both rewarding and profound." },
                    { "time": 120545, "value": "You are a beacon of understanding, destined to live a life filled with love, meaning, and deep connection." }
                ];

                number_audio_time = 120.545;

            } else if (nameDigit == 8) {

                realTimeText = [
                    { "time": 0, "value": "Now we’ve arrived at the significance of the number 8 as your Love Destiny Number." },
                    { "time": 4505, "value": "This number reveals the powerful energy you bring into your relationships and the unique path you are meant to walk in love." },
                    { "time": 10960, "value": "It’s all about strength, success, and empowerment—qualities that make your love life truly extraordinary." },
                    { "time": 17427, "value": "In romance, you are a powerful partner, someone who brings both strength and inspiration to those you love." },
                    { "time": 23532, "value": "You have a remarkable ability to create an environment where love doesn’t just exist—it flourishes through growth, achievement, and shared goals." },
                    { "time": 31750, "value": "Your presence in a relationship is empowering, and you naturally help those you love feel stronger, more capable, and ready to take on the world." },
                    { "time": 39505, "value": "One of your greatest talents in love is your ability to create success." },
                    { "time": 43647, "value": "You know how to build a relationship that is not only prosperous but also deeply fulfilling." },
                    { "time": 48865, "value": "You have a knack for achieving goals, and you bring that same focus and drive into your partnerships." },
                    { "time": 54345, "value": "You make sure both you and your partner feel valued, supported, and empowered to reach your full potential together." },
                    { "time": 60600, "value": "And when it comes to your destined connections, you are drawn to partners who share your ambition, your desire for success, and your vision for the future." },
                    { "time": 68642, "value": "Together, you will create a relationship that is not only rewarding but also deeply empowering." },
                    { "time": 74185, "value": "It will be a bond where both of you grow, thrive, and support each other’s dreams—where love is a source of strength that propels you forward." },
                    { "time": 81877, "value": "As you continue on your love path, remember that your relationships are about more than just the present moment." },
                    { "time": 87832, "value": "You’re building a legacy of empowerment and achievement, one that leaves a lasting impact on both your life and the lives of those around you." },
                    { "time": 95050, "value": "Your love has the power to transform, to uplift, and to create something truly magnificent." },
                    { "time": 100730, "value": "So, celebrate these incredible qualities within you, dear one." },
                    { "time": 105060, "value": "Your strength, your drive, your ability to empower those you love—they are paving the way to a relationship that is both rewarding and deeply meaningful." },
                    { "time": 113352, "value": "You are a beacon of strength and success, destined to lead a life filled with love, achievement, and transformation." }
                ];

                number_audio_time = 113.352;
            } else if (nameDigit == 9) {

                realTimeText = [
                    { "time": 0, "value": "Let's gently explore the beautiful meaning of the number 9 as your Love Destiny Number." },
                    { "time": 4842, "value": "This number reveals the heart of how you approach love and the qualities that make your relationships truly special." },
                    { "time": 10947, "value": "It’s all about compassion, wisdom, and the deep understanding you bring into the lives of those you love." },
                    { "time": 16752, "value": "In romance, you are a compassionate partner." },
                    { "time": 19832, "value": "You are a source of love, empathy, and understanding, creating an environment where love can flourish through kindness and unity." },
                    { "time": 27125, "value": "You have a way of making your partner feel truly seen, heard, and valued, bringing warmth and care into every moment." },
                    { "time": 33992, "value": "Your love feels like a safe space, where both hearts can be vulnerable and grow together." },
                    { "time": 39022, "value": "One of your greatest talents is your ability to connect deeply with others." },
                    { "time": 43077, "value": "You have this amazing gift of understanding the needs of those you love, often before they even express them." },
                    { "time": 49132, "value": "You naturally build relationships that are both nurturing and inspiring, where both partners feel cherished and encouraged to be their best selves." },
                    { "time": 56937, "value": "With you, love is always about lifting each other up and creating a bond that feels both strong and gentle." },
                    { "time": 63005, "value": "And when it comes to your destined connections, you are drawn to partners who share your values of compassion and understanding." },
                    { "time": 69685, "value": "These are the souls who, like you, seek a love that is deep, meaningful, and full of empathy." },
                    { "time": 75415, "value": "Together, you will create a relationship that is both rewarding and enlightening—a love that allows both of you to grow, to thrive, and to experience life’s beauty with open hearts." },
                    { "time": 85082, "value": "As you walk your love path, remember that your relationships are about creating something lasting—something that will leave a legacy of empathy, kindness, and wisdom." },
                    { "time": 94250, "value": "Your destiny is to build partnerships that not only transform your life but also touch the lives of those around you." },
                    { "time": 100580, "value": "The love you share will ripple out, bringing light and healing to everyone you encounter." },
                    { "time": 105272, "value": "So, celebrate the beautiful qualities within you, dear one." },
                    { "time": 109352, "value": "Your compassion, your wisdom, your deep understanding—they are paving the way to a love that is both rewarding and transformative." },
                    { "time": 116.68, "value": "You are a beacon of love and light, destined to live a life filled with connection, empathy, and endless understanding." }
                    ];

                number_audio_time = 98;
            }

    // Get the audio player and dynamic text element



    const containerlovenumber = document.getElementById('lovenumbers_' + nameDigit);
    const dynamicText = containerlovenumber.querySelector('p');

    // Convert timestamps from milliseconds to seconds
    realTimeText.forEach(item => item.time /= 1000);

    $(".skipbutton6").click( function(){
        number_audio.pause();
            $('#tenth-phase').removeClass('d-none');
            $('#sixsith-phase_new').addClass('d-none');
            $('.energy').removeClass('d-none');
            var audio10 = document.getElementById("tenthaudio");
            $('#tenth-text').removeClass('d-none');
            audio10.play();
            audio10.ontimeupdate = function() {
            let currentTime10 = audio10.currentTime;

            if (currentTime10 >= 9.195063) {
                $('#tenth_button').removeClass('d-none');
                }
            }
    })

    number_audio.ontimeupdate = async  function() {

        let currentTimeAudio = number_audio.currentTime;

                        // Find the last matching text update based on the current time
        let latestText = realTimeText.reduce((acc, item) => (currentTimeAudio >= item.time ? item.value : acc), "");

                        // Update the text if it has changed
        if (dynamicText.textContent !== latestText) {
            $("#lovenumbers_" + nameDigit + ' p').text(latestText);
        }

    }

    number_audio.onended = async  function () {

        await wait(2000);

        $('#tenth-phase').removeClass('d-none');
        $('#sixsith-phase_new').addClass('d-none');
        $('.energy').removeClass('d-none');

        var audio10 = document.getElementById("tenthaudio");
        $('#tenth-text').removeClass('d-none');

        audio10.play();
        audio10.ontimeupdate = function() {
        let currentTime10 = audio10.currentTime;

        if (currentTime10 >= 9.195063) {

            $('#tenth_button').removeClass('d-none');
            }

        }

    }
}




let hasRunCalculation = false;
let revealCalculationPromise = null;

async function heart_desier_number(str) {

    const vowelValues = {
        A: 1, E: 5, I: 9, O: 6, U: 3,
        a: 1, e: 5, i: 9, o: 6, u: 3
    };

    str = str.toLowerCase();


    // Reset UI
    $('.reveal_boxed_parent').empty();
    $('.reveal_letter .calculation_result').remove();
    $('.char_value_text').remove();

    // Render letters
    for (let i = 0; i < str.length; i++) {
        const char = str[i];
        const value = vowelValues[char];

        if (value !== undefined) {
            $('.reveal_boxed_parent').append(`
                <div class="char_wrapper char_${i}" style="text-align: center;">
                    <div class="char_value d-none">${value}</div>
                    <p>${char}</p>
                </div>
            `);
        } else {
            $('.reveal_boxed_parent').append(`
                <div class="char_wrapper char_${i}" style="text-align: center;">
                    <div class="char_value d-none" style="visibility: hidden;"></div>
                    <p>${char}</p>
                </div>
            `);
        }
    }

    await wait(1000);
    const consonantPromises = [];
    const vowelPromises = [];
    let delay = 0;

    for (let i = 0; i < str.length; i++) {
        const char = str[i];

        // Consonant removal animation
        // if (vowelValues[char] === undefined) {
        //     consonantPromises.push(new Promise(resolve => {
        //         const $charEl = $('.reveal_boxed_parent p').filter(function () {
        //             return $(this).text() === char;
        //         }).first();

        //         if ($charEl.length === 0) {
        //             resolve();
        //             return;
        //         }

        //         $charEl.addClass('animate__animated animate__fadeOut animate__faster');

        //         $charEl.one('animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd', function () {
        //             const $parent = $charEl.parent();
        //             $parent.remove();

        //             // Remove duplicates
        //             $('.reveal_boxed_parent p').filter(function () {
        //                 return $(this).text() === char;
        //             }).each(function () {
        //                 $(this).parent().remove();
        //             });

        //             resolve();
        //         });
        //     }));
        // }

        // Vowel bounce animation
        if (vowelValues[char] !== undefined) {
            vowelPromises.push(new Promise(resolve => {
                setTimeout(() => {
                    $('#heart_desier_number .selected_' + char)
                        .addClass('selected animate__animated animate__bounce animate__slower');

                    $('#heart_desier_number .selected_' + vowelValues[char])
                        .addClass('selected animate__animated animate__bounce animate__slower');

                    resolve();
                }, delay);
            }));

            delay += 100;
        } else {
            delay = 0;
        }
    }

    // Wait for both groups to finish
    await Promise.all([...consonantPromises]);




    // 🧠 Memoize the animation Promise so it only runs once
    if (revealCalculationPromise) {
        return revealCalculationPromise;
    }
    delay = 0;
    revealCalculationPromise = new Promise(resolve => {

        setTimeout(async () => {
            let values = [];



            // Gather promises for all animations
            const animationPromises = [];

            $('.reveal_boxed_parent .char_wrapper').each(function () {
                const value = $(this).find('.char_value').text().trim();

                if (!value) return;

                values.push(value);

                const $el = $(this).find('.char_value');
                $el.removeClass('d-none');
                $el.addClass('animate__animated animate__fadeIn animate__slower');

                // Wrap animation in a promise
                const animPromise = new Promise(res => {
                    $el.one('animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd', function () {
                        $el.removeClass('animate__animated animate__fadeIn animate__slower');
                        res();
                    });
                });

                animationPromises.push(animPromise);
            });

            // Wait for all animations to complete
            await Promise.all(animationPromises);

            await new Promise(resolve => setTimeout(resolve, 1000));

            // Now show calculation
            if (!hasRunCalculation) {
                hasRunCalculation = true;

                await showCalculation(values);
            }

            resolve(true);
        }, delay);
    });

    return revealCalculationPromise;
}




async function showCalculation(values) {
    const $container = $('.reveal_boxed_parent');

    // Clear previous content
    $container.stop(true, true).hide().empty().show();

    let validValues = [];
    let sum = 0;

    // Collect and validate numbers
    for (let i = 0; i < values.length; i++) {
        const val = parseInt(values[i], 10);
        if (!isNaN(val)) {
            validValues.push(val);
            sum += val;
        }
    }

    // Animate the number + plus signs
    for (let i = 0; i < validValues.length; i++) {
        const val = validValues[i];
        const $val = $(`<span class="calculation_result name_digit" style="display:none;">${val}</span>`);
        $container.append($val);
        $val.fadeIn(400);
        await new Promise(resolve => setTimeout(resolve, 800));

        if (i < validValues.length - 1) {
            const $plus = $(`<span class="calculation_result" style="display:none;">+</span>`);
            $container.append($plus);
            $plus.fadeIn(300);
            await new Promise(resolve => setTimeout(resolve, 500));
        }
    }

    // Show "=" and sum
    const $equals = $(`<span class="calculation_result" style="display:none;">=</span>`);
    $container.append($equals);
    $equals.fadeIn(300);
    await new Promise(resolve => setTimeout(resolve, 600));

    let currentSum = sum;
    const $sum = $(`<span class="calculation_result name_digit" style="display:none;">${currentSum}</span>`);
    $container.append($sum);
    $sum.fadeIn(500);
    await new Promise(resolve => setTimeout(resolve, 1000));

    // Breakdown if sum > 9
    while (currentSum > 9) {
        const $container1 = $('.reveal_boxed_show_calculation_parent');
        $container1.stop(true, true).hide().empty().show();

        await new Promise(resolve => setTimeout(resolve, 1000));

        const digits = currentSum.toString().split('').map(Number);
        let digitSum = 0;

        // Optional label or space between steps
        const $stepLabel = $('<div class="calculation_result" style="display:none;"></div>');
        $container1.append($stepLabel);
        $stepLabel.fadeIn(300);

        for (let i = 0; i < digits.length; i++) {
            const $digit = $(`<span class="calculation_result name_digit" style="display:none;">${digits[i]}</span>`);
            $container1.append($digit);
            $digit.fadeIn(400);
            await new Promise(resolve => setTimeout(resolve, 600));
            digitSum += digits[i];

            if (i < digits.length - 1) {
                const $plus = $(`<span class="calculation_result" style="display:none;">+</span>`);
                $container1.append($plus);
                $plus.fadeIn(300);
                await new Promise(resolve => setTimeout(resolve, 400));
            }
        }

        const $equals2 = $(`<span class="calculation_result" style="display:none;">=</span>`);
        $container1.append($equals2);
        $equals2.fadeIn(400);
        await new Promise(resolve => setTimeout(resolve, 500));

        const $digitSum = $(`<span class="calculation_result name_digit" style="display:none;">${digitSum}</span>`);
        $container1.append($digitSum);
        $digitSum.fadeIn(500);

        currentSum = digitSum;
        await new Promise(resolve => setTimeout(resolve, 2000));
    }

    await new Promise(resolve => setTimeout(resolve, 1500));
    $('#custom_heart_desire_number').val(currentSum);

    floatingNumbers(currentSum);
}



let revealCalculationPromiseLove = null;
let hasRunCalculationLove = false;

async function loveDestinyNumber(str) {
    str = str.toLowerCase();
    $('.reveal_boxed_parent_love').empty();

    // Render characters one-by-one to ensure full completion
    for (let i = 0; i < str.length; i++) {
        const char = str[i];
        $('.reveal_boxed_parent_love').append(`
            <div class="char_wrapper char_${i}" style="text-align: center;">
                <div class="char_value d-none">${getCharacterValue(char)}</div>
                <p>${char}</p>
            </div>
        `);
    }

    // Wait for DOM rendering (next tick)
    await new Promise(requestAnimationFrame);



    // Animate selected characters
    for (let i = 0; i < str.length; i++) {
        const char = str[i];
        $('#love_destiny_number .selected_' + char).addClass('selected animate__animated animate__bounce animate__slower');
        $('#love_destiny_number .selected_' + getCharacterValue(char)).addClass('selected animate__animated animate__bounce animate__slower');
    }

    if (revealCalculationPromiseLove) return revealCalculationPromiseLove;


    revealCalculationPromiseLove = new Promise(resolve => {
        setTimeout(async () => {
            const values = [];
            const animationPromises = [];

            $('.reveal_boxed_parent_love .char_wrapper').each(function () {
                const $el = $(this).find('.char_value');
                const value = $el.text().trim();

                if (!value) return;

                values.push(value);
                $el.removeClass('d-none').addClass('animate__animated animate__fadeIn animate__slower');

                const animPromise = new Promise(res => {
                    $el.one('animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd', function () {
                        $el.removeClass('animate__animated animate__fadeIn animate__slower');
                        res();
                    });
                });

                animationPromises.push(animPromise);
            });

            await Promise.all(animationPromises);

            if (!hasRunCalculationLove) {
                hasRunCalculationLove = true;
                await showCalculationLoveDestiny(values);
            }
            console.log('outside --->',values);
            resolve(true);
        }, 2000);
    });

    return revealCalculationPromiseLove;
}

async function showCalculationLoveDestiny(values) {
    const $container = $('.reveal_boxed_parent_love');
    $container.stop(true, true).hide().empty().show();

    let validValues = [];
    let sum = 0;

    for (let i = 0; i < values.length; i++) {
        const val = parseInt(values[i], 10);
        if (!isNaN(val)) {
            validValues.push(val);
            sum += val;
        }
    }

    // Show calculation steps
    for (let i = 0; i < validValues.length; i++) {
        const val = validValues[i];
        const $el = $('<div class="calculation_result name_digit"></div>').text(val);
        $container.append($el);
        $el.addClass('animate__animated animate__fadeIn animate__slower');
        await new Promise(res => setTimeout(res, 800));

        if (i < validValues.length - 1) {
            const $plus = $('<div class="calculation_result">+</div>');
            $container.append($plus);
            $plus.addClass('animate__animated animate__fadeIn animate__slower');
            await new Promise(res => setTimeout(res, 500));
        }
    }

    const $equals = $('<div class="calculation_result">=</div>');
    $container.append($equals);
    $equals.addClass('animate__animated animate__fadeIn animate__slower');
    await new Promise(res => setTimeout(res, 800));

    let currentSum = sum;
    const $sum = $('<div class="calculation_result name_digit"></div>').text(currentSum);
    $container.append($sum);
    $sum.addClass('animate__animated animate__fadeIn animate__slower');
    await new Promise(res => setTimeout(res, 1000));

    // Reduce to single digit
    while (currentSum > 9) {
        $container.hide();
        const $container1 = $('.reveal_boxed_show_calculation_parent_love');
        $container1.stop(true, true).hide().empty().show();

        await new Promise(res => setTimeout(res, 1000));

        const digits = currentSum.toString().split('').map(Number);
        let digitSum = 0;

        for (let i = 0; i < digits.length; i++) {
            const $digit = $('<div class="calculation_result name_digit"></div>').text(digits[i]);
            $container1.append($digit);
            $digit.addClass('animate__animated animate__fadeIn animate__slower');
            await new Promise(res => setTimeout(res, 600));

            digitSum += digits[i];

            if (i < digits.length - 1) {
                const $plus = $('<div class="calculation_result">+</div>');
                $container1.append($plus);
                $plus.addClass('animate__animated animate__fadeIn animate__slower');
                await new Promise(res => setTimeout(res, 400));
            }
        }

        const $equals2 = $('<div class="calculation_result">=</div>');
        $container1.append($equals2);
        $equals2.addClass('animate__animated animate__fadeIn animate__slower');
        await new Promise(res => setTimeout(res, 600));

        const $digitSum = $('<div class="calculation_result name_digit"></div>').text(digitSum);
        $container1.append($digitSum);
        $digitSum.addClass('animate__animated animate__fadeIn animate__slower');
        currentSum = digitSum;

        console.log('outside2 --->',currentSum);

        await new Promise(res => setTimeout(res, 1000));
    }

    $('#custom_love_destiny_number').val(currentSum);

    floatingNumbers(currentSum)
    // $('#love_destiny_number_float_5').find('.centerNumber p').html(currentSum);
    // $('#love_destiny_number_float_5').find('.number').html(currentSum);
    console.log('outsideff3 --->',currentSum);
    await new Promise(res => setTimeout(res, 1000));

}

function getCharacterValue(char) {
    const charMap = {
        a: 1, b: 2, c: 3, d: 4, e: 5,
        f: 6, g: 7, h: 8, i: 9, j: 1,
        k: 2, l: 3, m: 4, n: 5, o: 6,
        p: 7, q: 8, r: 9, s: 1, t: 2,
        u: 3, v: 4, w: 5, x: 6, y: 7,
        z: 8
    };
    return charMap[char] || '';
}


/* Play and Stop */



let lastPausedMedia = null;

// Pause button click
$('.pause_button').on('click', function () {
    $('.pause_button').addClass('d-none');
    $('.play_button').removeClass('d-none');

    $('audio, video').each(function () {
        if (!this.paused && !this.ended) {
            this.pause();
            lastPausedMedia = this; // store the currently playing one
        }
    });
});

// Play button click
$('.play_button').on('click', function () {
    $('.play_button').addClass('d-none');
    $('.pause_button').removeClass('d-none');

    if (lastPausedMedia) {
        lastPausedMedia.play().catch(e => {
            console.warn('Autoplay prevented:', e);
        });
    }
});

$('.umnute_button').on('click', function() {
    $('.umnute_button').addClass('d-none');
    $('.mute_button').removeClass('d-none');

    // Mute all audio and video elements
    $('audio, video').each(function() {
        this.muted = true;
    });
});

$('.mute_button').on('click', function() {
    $('.umnute_button').removeClass('d-none');
    $('.mute_button').addClass('d-none');

    // Unmute all audio and video elements
    $('audio, video').each(function() {
        this.muted = false;
    });
});


$(document).ready( function(){

    var intro = document.getElementById("my_audio");
    const dynamicText = document.getElementById('dynamicText');
    let secondPhasePlayed = false;

    // Text array to display during different parts of the audio (convert ms to seconds)
    const realTimeText = [
        { time: 0, value: "Greetings, seeker of love!" },
        { time: 2.267, value: "I am the Great Love, a celestial guide here to illuminate the path to your romantic destiny." },
        { time: 7.672, value: "Together, we'll uncover the secrets hidden within your numbers." },
    ];

    window.playAudio = function() {
        $('#playaudio').addClass('d-none');
        $('#dialog_box_1').removeClass('d-none');
        $('#play_1').addClass('d-none');
        $('#pause_1').removeClass('d-none');
        intro.play();
    }

    // Update dynamic text as audio progresses
    intro.ontimeupdate = function () {

        let currentTime = intro.currentTime;


        // Find the latest text that should be displayed
        let latestText = realTimeText.reduce((acc, item) => (
            currentTime >= item.time ? item.value : acc
        ), "");

        if (dynamicText.textContent !== latestText) {
            dynamicText.textContent = latestText;
        }

        // Play second audio and show second-phase content only once
        if (currentTime >= 11.016 && !secondPhasePlayed) {
            secondPhasePlayed = true;

            $('#first-phase').addClass('d-none');
            $('#second-phase').removeClass('d-none');
            $('#seconds').removeClass('d-none');

            var audion = document.getElementById("secondaudio");
            audion.play();
        }
    };
})
