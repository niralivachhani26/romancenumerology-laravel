@extends('adminlte::page')

@section('title', 'Order')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create Sketch By prompt</h3>
                </div>
                <div class="card-body">
                    <div id="post-data-container">
                        <form action="{{route('admin.testSketchPromptStore')}}" method="POST" id="sketch-prompt-form">
                            @csrf
                            <textarea class="w-100 text-left ml-2" name="prompt" id="prompt" cols="30" rows="10">
                                You are a spiritually attuned and hyper-realistic portrait artist specializing in hand-drawn pencil sketch techniques.
                                Your artwork captures the ethereal presence and emotional energy of a destined soulmate with precision, warmth, and soulful realism.
                                Create a highly realistic black-and-white pencil sketch, using soft shading and subtle texture, similar to classical figure drawing on textured paper.
                                Focus on expressive eyes, natural facial structure, delicate hair details, and authentic skin textures.
                                The subject should appear emotionally alive and realistic, with a gentle romantic aura.

                                Your task is to create a head-and-shoulders pencil-style sketch of a person’s future soulmate, guided by spiritual cues derived from their personal numerology and romantic profile. The following inputs should be used: the user’s date of birth, their gender of interest, ethnicity preference, and their soulmate number (a symbolic numerological value representing romantic destiny and vibrational energy).

                                Please note: The date of birth refers to the user, not the soulmate. Even if the user is under 18 years of age, the drawing must always depict a mature, adult soulmate who appears to be 18 years or older. The soulmate must always be presented as a fully grown adult — emotionally and physically mature in appearance, and has to be around the age range of the user.

                                Use the soulmate number to influence the subtle mood or spiritual expression of the portrait — for instance, a soulmate number of “1” may suggest a confident, bold gaze, while a “9” might reflect a soulful and wise energy. This influence should be woven softly into their pose, expression, or emotional aura rather than shown as literal symbols.
                                Ensure that the gender of interest is strictly followed — generate only the gender explicitly provided. The ethnicity preference must also be visibly respected in the subject's facial features, hair texture, and overall appearance, with culturally authentic but natural details.

                                The subject must be drawn fully within the frame, including their complete head and hair — avoid cropping any part of the head or zooming too closely. The composition should be a well-balanced, head-and-shoulders portrait, centered and elegant. No background elements, symbols, text, or distractions should be added. The portrait must be done in black and white with soft pencil shading, fine facial detail, and a timeless, realistic hand-drawn style — just like a traditional pencil sketch on textured paper.

                                Clothing Note: The person’s attire should vary naturally — they should not always wear a simple t-shirt. You may include a mix of casual or semi-formal styles such as sweaters, collared shirts, blouses, or simple formal tops, as long as it fits the overall mature and authentic tone of the portrait. Keep the clothing realistic, balanced, and appropriate to the person’s aura.

                                Now generate a black-and-white pencil sketch image based on the entire description above. The output should be a visual artwork, not a text explanation.

                                Create the soulmate sketch for this user:
                                    - User's Date of Birth: 05/05/1988
                                    - Gender of Interest: Female
                                    - Ethnicity Preference: India
                                    - Soulmate Number: 6
                            </textarea>
                            <button class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                        <div id="generated-image-container" class="mt-4">
                            <p id="image-placeholder">Your generated sketch will appear here.</p>
                            <div id="loading-spinner" class="spinner-border text-primary text-center" role="status" style="display: none;">
                                {{-- <span class="visually-hidden">Loading...</span> --}}
                                  <span class="sr-only">Loading...</span>
                            </div>
                            <img id="generated-sketch" src="" alt="Generated Sketch" style="display: none;">
                        </div>

                        <div id="error-message" class="alert alert-danger mt-3" style="display: none;"></div>

                </div>

            </div>
        </div>

    </div>
</div>

@stop

@section('css')
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('sketch-prompt-form');
            const promptTextarea = document.getElementById('prompt');
            const generatedSketchImg = document.getElementById('generated-sketch');
            const imagePlaceholder = document.getElementById('image-placeholder');
            const loadingSpinner = document.getElementById('loading-spinner');
            const errorMessageDiv = document.getElementById('error-message');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            form.addEventListener('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission

                // Hide previous image and error messages
                generatedSketchImg.style.display = 'none';
                generatedSketchImg.src = '';
                errorMessageDiv.style.display = 'none';
                errorMessageDiv.textContent = '';
                imagePlaceholder.style.display = 'none';

                // Show loading spinner
                loadingSpinner.style.display = 'block';

                // Prepare data for the request
                const formData = new FormData();
                formData.append('_token', csrfToken);
                formData.append('prompt', promptTextarea.value);

                // Or, if sending as JSON (more common for APIs):
                const requestData = {
                    _token: csrfToken,
                    prompt: promptTextarea.value
                };

                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json', // Indicate JSON content
                        'Accept': 'application/json', // Expect JSON response
                        'X-CSRF-TOKEN': csrfToken // Also good practice to send CSRF in header for APIs
                    },
                    body: JSON.stringify(requestData) // Convert object to JSON string
                })
                .then(response => {
                    loadingSpinner.style.display = 'none'; // Hide spinner regardless of success/fail
                    if (!response.ok) {
                        // If response is not OK (e.g., 400, 500), throw an error
                        return response.json().then(errorData => {
                            throw new Error(errorData.message || 'Server error occurred.');
                        });
                    }
                    return response.json(); // Parse the JSON response
                })
                .then(data => {
                    if (data.success && data.image_path) {
                        generatedSketchImg.src = data.image_path;
                        generatedSketchImg.style.display = 'block';
                        imagePlaceholder.style.display = 'none';
                    } else {
                        errorMessageDiv.textContent = data.message || 'Error: No image path received.';
                        errorMessageDiv.style.display = 'block';
                        imagePlaceholder.style.display = 'block';
                    }
                })
                .catch(error => {
                    loadingSpinner.style.display = 'none'; // Hide spinner on error
                    errorMessageDiv.textContent = `An error occurred: ${error.message}`;
                    errorMessageDiv.style.display = 'block';
                    imagePlaceholder.style.display = 'block';
                    console.error('Fetch Error:', error);
                });
            });
        });
    </script>
@stop
