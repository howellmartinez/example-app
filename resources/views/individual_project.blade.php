<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Projects</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito';
            }
        </style>
    </head>
    <body class="antialiased">
    <h2>Title: {{ $project->name }}</h2>
    <h3>Client: {{ $project->client }}</h3>
    <p>
    Description: {{ $project->description }}
    </p>
    Stages:
    <ol>
    @foreach($project->stages as $stage)
    <li>{{ $stage->description }}</li>
    @endforeach
    </ol>
    <a href="/projects">Back to Projects Home</a>
    </body>
</html>
