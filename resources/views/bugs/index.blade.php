<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bug Tracker - Bugs</title>
</head>
<body>
    <h1>Existing Bugs</h1>
    <ul>
        <li> <a href="/bugs/{{ $bug_array[0]['id'] }}"> {{ $bug_array[0]['title'].' ('.$bug_array[0]['status'].')' }} </a> </li>
        <li>{{ $bug_array[1]['title'].' ('.$bug_array[1]['status'].')' }}</li>
        <li>{{ $bug_array[2]['title'].' ('.$bug_array[2]['status'].')' }}</li>
    </ul>
</body>
</html>