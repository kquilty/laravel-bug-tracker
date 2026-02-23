<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bug Tracker - Bugs</title>
</head>
<body>
    <h1>Existing Bugs</h1>
    <ul>
        @foreach ($bug_array as $bug)
            <li>
                <p>{{ $bug['title'].' ('.$bug['status'].')' }}</p>
                <a href="/bugs/{{ $bug['id'] }}">View Details</a> 
            </li>
        @endforeach
    </ul>
</body>
</html>