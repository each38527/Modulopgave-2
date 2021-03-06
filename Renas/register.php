<center>
    <?php
    require_once "config.php";

    $username = $password = $confirm_password = "";
    $username_err = $password_err = $confirm_password_err = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty(trim($_POST["username"]))) {
            $username_err = "Skriv brugernavn.";
        } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
            $username_err = "Username can only contain letters, numbers, and underscores.";
        } else {
            $sql = "SELECT id FROM users WHERE username = ?";

            if ($stmt = mysqli_prepare($link, $sql)) {

                mysqli_stmt_bind_param($stmt, "s", $param_username);

                $param_username = trim($_POST["username"]);

                if (mysqli_stmt_execute($stmt)) {

                    mysqli_stmt_store_result($stmt);

                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        $username_err = "Brugernavnet er allerede brugt.";
                    } else {
                        $username = trim($_POST["username"]);
                    }
                } else {
                    echo "Noget gik galt, prøv igen senere.";
                }

                mysqli_stmt_close($stmt);
            }
        }

        if (empty(trim($_POST["password"]))) {
            $password_err = "Skriv kodeord.";
        } elseif (strlen(trim($_POST["password"])) < 6) {
            $password_err = "Kodeord skal være minimum 6 karakterer.";
        } else {
            $password = trim($_POST["password"]);
        }

        if (empty(trim($_POST["confirm_password"]))) {
            $confirm_password_err = "Bekræft kodeord.";
        } else {
            $confirm_password = trim($_POST["confirm_password"]);
            if (empty($password_err) && ($password != $confirm_password)) {
                $confirm_password_err = "Kodeord passede ikke.";
            }
        }

        if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {

            $sql = "INSERT INTO users (username, password) VALUES (?, ?)";

            if ($stmt = mysqli_prepare($link, $sql)) {

                mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

                $param_username = $username;
                $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

                if (mysqli_stmt_execute($stmt)) {

                    header("location: login.php");
                } else {
                    echo "Noget gik galt, prøv igen senere.";
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
        <title>Renas Registrer</title>
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
            <h2>Opret bruger</h2>
            <p>Udfyld formularen for at oprette dig som bruger.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label>Brugernavn</label>
                    <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                    <span class="invalid-feedback"><?php echo $username_err; ?></span>
                </div>
                <div class="form-group">
                    <label>Kodeord</label>
                    <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                </div>
                <div class="form-group">
                    <label>Bekræft kodeord</label>
                    <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                    <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Gem">
                    <a href="index.php" class="btn btn-danger ml-3">Anuller</a>

                </div>
                <p>Har du allerede en bruger?<a href="login.php">Log ind her</a>.</p>
            </form>
        </div>
    </body>

    </html>
</center>