<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <form action="/ok" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="file" name="file">
        <input type="submit">
    </form>

</body>
</html>
