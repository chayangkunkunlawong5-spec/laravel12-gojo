<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
</head>
<body>

    <h1>Gallery of Chayangkun 68122420023</h1>

    <table>
        <tr>
            <td>
                <a href="/gallery/ant">
                    <img src="{{ $ant }}" alt="Ant" width="220" height="150">
                </a>
            </td>
            <td>
                <a href="/gallery/bird">
                    <img src="{{ $bird }}" alt="Bird" width="220" height="150">
                </a>
            </td>
            <td>
                <a href="/gallery/cat">
                    <img src="{{ $cat }}" alt="Cat" width="220" height="150">
                </a>
            </td>
        </tr>
        <tr>
            <td>Ant</td>
            <td>Bird</td>
            <td>Cat</td>
        </tr>
    </table>

</body>
</html>