<center>
    <?php

    session_start();

    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("location: login.php");
        exit;
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Renas</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <style>
            body {
                font: 14px sans-serif;
                text-align: center;
            }
        </style>
    </head>

    <body>
        <h1 class="my-5">Hej <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Velkommen til din side</h1>
        <p>
            <a href="reset-password.php" class="btn btn-warning">Skift kodeord</a>
            <a href="logout.php" class="btn btn-danger ml-3">Log ud</a>
            <a href="clean.php" class="btn btn-success">Rengøring</a>


        </p>
    </body>

    </html>
    <!DOCTYPE html>
    <html lang="en">
</center>