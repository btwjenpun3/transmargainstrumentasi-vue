<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Fredoka", sans-serif;
            font-optical-sizing: auto;
            font-weight: 200;
            font-style: normal;
            font-variation-settings:
                "wdth" 100;
        }
    </style>
    <title>Document</title>
    @routes()
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    @inertiaHead
</head>

<body class="bg-gray-50 flex flex-col min-h-screen">
    @inertia
</body>

</html>
