tyest one
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
                    <h3 class="card-title">Create Pdf By prompt follow the format</h3>
                </div>
                <div class="card-body">
                    <div id="post-data-container">
                        <form action="{{route('admin.storeTestPdfContent')}}" method="POST" id="sketch-prompt-form">
                            @csrf
                            <textarea class="w-100" name="prompt" id="prompt" cols="30" rows="10">
                                    introduction : Welcome to Your Soulmate Journey,
                                    chapter_1 : The Essence of Soulmate Number 7 in Love,
                                    chapter_2 : Understanding Soulmate Number 7,
                                    chapter_3 : Why Soulmate Number 7 Is Perfect for You,
                                    chapter_4 : Discovering and Recognizing Your Soulmate,
                                    chapter_5 : Building a Relationship with a Soulmate Number 7,
                                    chapter_6 : The Spiritual and Transformative Power of Your Soulmate,
                                    chapter_7 : Common Challenges & How to Grow Through Them,
                                    conclusion :Embracing the Path of Love

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
                            <div id="loading-spinner" class="spinner-border text-primary" role="status" style="display: none;">

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
    {{-- <script>
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
                    console.log(data);
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
    </script> --}}
@stop
