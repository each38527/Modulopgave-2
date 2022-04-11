<?php

require_once "config.php";

$clean = $address = $comment = "";
$clean_err = $address_err = $comment_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $input_clean = trim($_POST["clean"]);
    if (empty($input_clean)) {
        $clean_err = "Skriv en rengøringstype.";
    } else {
        $clean = $input_clean;
    }


    $input_address = trim($_POST["address"]);
    if (empty($input_address)) {
        $address_err = "Skriv en adresse.";
    } else {
        $address = $input_address;
    }

    $input_comment = trim($_POST["comment"]);
    if (empty($input_comment)) {
        $comment_err = "Skriv en kommentar.";
    } else {
        $comment = $input_comment;
    }

    if (empty($clean_err) && empty($address_err) && empty($comment_err)) {

        $sql = "INSERT INTO cleaning (clean, address, comment) VALUES (?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {

            mysqli_stmt_bind_param($stmt, "sss", $param_clean, $param_address, $param_comment);

            $param_clean = $clean;
            $param_address = $address;
            $param_comment = $comment;

            if (mysqli_stmt_execute($stmt)) {

                header("location: clean.php");
                exit();
            } else {
                echo "Noget gik galt, prøv igen senere.";
            }

            mysqli_stmt_close($stmt);
        }
    }
}


mysqli_close($link);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ny rengøring</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Ny rengøring</h2>
                    <p>Udfyld formularen for at oprette en ny rengøring.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Rengøringstype</label>
                            <input type="text" name="clean" class="form-control <?php echo (!empty($clean_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $clean; ?>">
                            <span class="invalid-feedback"><?php echo $clean_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Addresse</label>
                            <textarea name="address" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>"><?php echo $address; ?></textarea>
                            <span class="invalid-feedback"><?php echo $address_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Kommentar</label>
                            <input type="text" name="comment" class="form-control <?php echo (!empty($comment_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $comment; ?>">
                            <span class="invalid-feedback"><?php echo $comment_err; ?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Gem">
                        <a href="clean.php" class="btn btn-secondary ml-2">Tilbage</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>