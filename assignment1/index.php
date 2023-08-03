<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,400;1,100&family=Roboto+Condensed&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="container__header">
            <img src="resource/logo.png" alt=""><span class="font--massive">DEV COMMUNITY</span><span class="link--action"><a href="logout.php">logout</a></span>
        </div>
        <div class="container__body">
            <form action="post">
                <div class="form__heading font--massive">
                    LOGIN
                </div>
                <input type="text" placeholder="username"/><br>
                <input type="text" placeholder="password"/><br>
                <button type="submit">SUBMIT</button>
            </form>
        </div>
        <div class="container__footer font--sub-massive">
            SUBCRIBE TO OUR NEWSLETTER
            <br>
            <input type="text"> <button>SUBMIT</button>
        </div>
    </div>
</body>
</html>