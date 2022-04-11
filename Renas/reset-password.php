<center>
    <?php

    session_start();

    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("location: login.php");
        exit;
    }

    require_once "config.php";

    $new_password = $confirm_password = "";
    $new_password_err = $confirm_password_err = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty(trim($_POST["new_password"]))) {
            $new_password_err = "Skriv dit nye kodeord.";
        } elseif (strlen(trim($_POST["new_password"])) < 6) {
            $new_password_err = "Kodeord skal være minimum 6 karakterer.";
        } else {
            $new_password = trim($_POST["new_password"]);
        }

        if (empty(trim($_POST["confirm_password"]))) {
            $confirm_password_err = "Bekræft kodeord.";
        } else {
            $confirm_password = trim($_POST["confirm_password"]);
            if (empty($new_password_err) && ($new_password != $confirm_password)) {
                $confirm_password_err = "Kodeordene matchede ikke.";
            }
        }

        if (empty($new_password_err) && empty($confirm_password_err)) {

            $sql = "UPDATE users SET password = ? WHERE id = ?";

            if ($stmt = mysqli_prepare($link, $sql)) {

                mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);

                $param_password = password_hash($new_password, PASSWORD_DEFAULT);
                $param_id = $_SESSION["id"];

                if (mysqli_stmt_execute($stmt)) {

                    session_destroy();
                    header("location: login.php");
                    exit();
                } else {
                    echo "Noget gik galt, prøv igen senere..";
                }

                mysqli_stmt_close($stmt);
            }
        }

        mysqli_close($link);
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Nulstil kodeord</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <style>
            body {
                font: 14px sans-serif;
            }

            .wrapper {
                width: 360px;
                padding: 20px;
            }
        </style>
    </head>

    <body>
        <div class="wrapper">
            <h2>Nulstil kodeord</h2>
            <p>Udfyld formularen for at skifte kodeord.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label>Nyt kodeord</label>
                    <input type="password" name="new_password" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">
                    <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
                </div>
                <div class="form-group">
                    <label>Bekræft kodeord</label>
                    <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                    <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Bekræft">
                    <a class="btn btn-link ml-2" href="index.php">Annuler</a>
                </div>
            </form>
        </div>
    </body>

    </html>
</center>