<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MyCareerCoach') }} - Authentication</title>

    <!-- Scripts and Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        .input-premium {
            width: 100%;
            border: none;
            border-bottom: 1px solid #e2e8f0;
            background-color: transparent;
            padding: 0.85rem 0.2rem;
            color: #334155;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .input-premium:focus {
            outline: none;
            border-bottom-color: #1e3a8a;
            box-shadow: none;
        }

        .input-premium::placeholder {
            color: #94a3b8;
            font-weight: 300;
        }

        .input-label {
            display: block;
            font-size: 0.95rem;
            font-weight: 700;
            color: #475569;
            margin-bottom: 0.1rem;
        }

        .btn-red {
            background-color: #e11d48;
            /* Red to mimic the image */
            color: white;
            font-weight: 600;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
        }

        .btn-red:hover {
            background-color: #be123c;
            transform: translateY(-1px);
        }
    </style>
</head>

<body
    class="font-sans text-gray-900 antialiased bg-white selection:bg-rose-500 selection:text-white h-screen overflow-hidden">
    {{ $slot }}
</body>

</html>