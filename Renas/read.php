<?php

if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {

    require_once "config.php";

    $sql = "SELECT * FROM cleaning WHERE id = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {

        mysqli_stmt_bind_param($stmt, "i", $param_id);

        $param_id = trim($_GET["id"]);

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) {

                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                $clean = $row["clean"];
                $address = $row["address"];
                $comment = $row["comment"];
            } else {

                header("location: error.php");
                exit();
            }
        } else {
            echo "Noget gik galt, prøv igen senere.";
        }
    }

    mysqli_stmt_close($stmt);

    mysqli_close($link);
} else {

    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Se rengøringer</title>
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
                    <h1 class="mt-5 mb-3">Se rengøring</h1>
                    <div class="form-group">
                        <label>Rengøringer</label>
                        <p><b><?php echo $row["clean"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Addresse</label>
                        <p><b><?php echo $row["address"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Kommentar</label>
                        <p><b><?php echo $row["comment"]; ?></b></p>
                    </div>
                    <p><a href="clean.php" class="btn btn-primary">Tilbage</a></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>