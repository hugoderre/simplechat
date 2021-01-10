<?php
session_start();
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="favicon.ico" />
    <title>Simple Chat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="chat-form">
        <input type="text" name="pseudo" id="pseudo" value="<?= $_SESSION['pseudo'] ?? '' ?>" placeholder="Pseudonyme"></input>
        <textarea name="message" id="message" cols="30" rows="3" placeholder="Message"></textarea>
        <input class="btn btn-primary" type="submit" value="Envoyer" id="submit">

        <div id="chat-messages"></div>
    </div>

    
    <script src="js/ajax.js"></script>
    <script src="js/chat.js"></script>
</body>

</html>