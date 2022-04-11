<?php
require_once "config.php";

$clean = $address = $comment = "";
$clean_err = $address_err = $comment_err = "";

if (isset($_POST["id"]) && !empty($_POST["id"])) {

    $id = $_POST["id"];

    $input_clean = trim($_POST["clean"]);
    if (empty($input_clean)) {
        $clean_err = "Skriv en rengørintstype.";
    } elseif (!filter_var($input_clean, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
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

    $input_comment = trim($_POST["coment"]);
    if (empty($input_coment)) {
        $coment_err = "Skriv en kommentar.";
    } else {
        $comment = $input_comment;
    }

    if (empty($clean_err) && empty($address_err) && empty($comment_err)) {

        $sql = "UPDATE cleaning SET clean=?, address=?, comment=? WHERE id=?";

        if ($stmt = mysqli_prepare($link, $sql)) {

            mysqli_stmt_bind_param($stmt, "sssi", $param_clean, $param_address, $param_comment, $param_id);

            $param_clean = $clean;
            $param_address = $address;
            $param_comment = $comment;
            $param_id = $id;

            if (mysqli_stmt_execute($stmt)) {

                header("location: clean.php");
                exit();
            } else {
                echo "Noget gik galt, prøv igen senere.";
            }
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($link);
} else {

    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {

        $id =  trim($_GET["id"]);

        $sql = "SELECT * FROM cleaning WHERE id = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {

            mysqli_stmt_bind_param($stmt, "i", $param_id);

            $param_id = $id;

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
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Opdater rengøring</title>
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
                    <h2 class="mt-5">Opdater rengøring</h2>
                    <p>Udfyld formularen for at opdatere rengøringen.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Rengøring</label>
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
                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                        <input type="submit" class="btn btn-primary" value="Gem">
                        <a href="clean.php" class="btn btn-secondary ml-2">Tilbage</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>