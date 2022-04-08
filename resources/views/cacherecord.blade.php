<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
    </tr>
    @foreach($cache as $cache)
    <tr>
       <td>{{$cache->id}}</td>
       <td>{{$cache->name}}</td>
       <td>{{$cache->email}}</td>
    </tr>
    @endforeach
    </table>
</body>
</html>