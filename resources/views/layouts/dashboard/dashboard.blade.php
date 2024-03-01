@props(['dir'])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ $dir ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ env('APP_NAME') }} | Responsive Bootstrap 5 Admin Dashboard Template</title>

    @include('partials.dashboard._head')
</head>

<body class="">
    @include('partials.dashboard._body')
    <a class="btn btn-fixed-end btn-secondary btn-icon btn-dashboard" href="../landing-pages/index">Landing Pages</a>
    <script>
        $(document).ready(function() {

            $('.main_form form').submit(function(e) {
                e.preventDefault(); // Prevent default form submission

                var formData = $(this).serialize(); // Serialize form data
                var url = form.find('input[name="handler"]').val()

                // Submit form data via AJAX
                $.ajax({
                    url: url, // Get the form action dynamically
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        alert(response.message); // Show success message
                        // Refresh page content dynamically here
                        // $('.table-responsive').load(location.href +
                        // ' .table-responsive'); // Reload the content of the container without reloading the page
                    },
                    error: function(xhr) {
                        // Handle errors
                        alert('Error: ' + xhr.responseText);
                    }
                });
            });
        });
    </script>
    
</body>

</html>
