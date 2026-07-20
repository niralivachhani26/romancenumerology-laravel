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
                    <h3 class="card-title">Order List</h3>
                </div>
                <div class="card-body">
                    <div id="post-data-container">
                            @include('admin.orders.partials.order_table')
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
     <script>

          $(document).ready(function() {
            // Function to fetch posts via AJAX
            function fetchPosts(page) {
                $.ajax({
                    url: "{{ route('admin.orders.list') }}?page=" + page,
                    type: 'GET',
                    beforeSend: function() {
                        $('#post-data-container').append('<div class="text-center" id="loading-spinner"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>');
                    },
                    success: function(data) {
                        $('#loading-spinner').remove();
                        $('#post-data-container').html(data);
                    },
                    error: function(xhr, status, error) {
                        $('#loading-spinner').remove();
                        console.error("AJAX Error:", status, error);
                        alert("Error loading posts. Please try again.");
                    }
                });
            }

            // Handle pagination link clicks
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault(); // Prevent default link behavior (full page reload)
                var page = $(this).attr('href').split('page=')[1]; // Get the page number from the href
                fetchPosts(page); // Call the function to fetch new data
            });
        });

    </script>
@stop
