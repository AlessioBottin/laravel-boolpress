<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Email: {{ $new_lead->email }}</h1>
    <h2>Name: {{ $new_lead->name }}</h2>

    <p>{{ $new_lead->content }}</p>
</body>
</html>