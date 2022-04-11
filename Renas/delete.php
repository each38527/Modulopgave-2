<?php

if (isset($_POST["id"]) && !empty($_POST["id"])) {

    require_once "config.php";

    $sql = "DELETE FROM cleaning WHERE id = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {

        mysqli_stmt_bind_param($stmt, "i", $param_id);

        $param_id = trim($_POST["id"]);

        if (mysqli_stmt_execute($stmt)) {

            header("location: clean.php");
            exit();
        } else {
            echo "Noget gik galt, prøv igen senere.";
        }
    }

    mysqli_stmt_close($stmt);

    mysqli_close($link);
} else {

    if (empty(trim($_GET["id"]))) {

        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Slet rengøring</title>
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
                    <h2 class="mt-5 mb-3">Slet rengøring</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>" />
                            <p>Er du sikker på du vil slette rengøringen?</p>
                            <p>
                                <input type="submit" value="Ja" class="btn btn-danger">
                                <a href="clean.php" class="btn btn-secondary">Nej</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>