<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting...</title>
</head>
<body>
    <form id="redirectForm" method="GET" action="{{ $url }}">

        @foreach ($data as $key => $value)
            <input type="text" name="{{ $key }}" value="{{ $value }}">
        @endforeach
    </form>
    <script>
        // Automatically submit the form
       document.getElementById('redirectForm').submit();
     // window.location.href='http://localhost:5173/handle-data';
    </script>
</body>
</html>
