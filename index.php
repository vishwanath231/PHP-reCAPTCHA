<?php

if (isset($_POST['submit'])) {

    $username = $_POST['name'];
    $scretKey = "6LfIjJEbAAAAAAC_nmrj6Tm7sGV_5smOvgacZPGI";
    $responseKey = $_POST['g-recaptcha-response'];
    $userIP = $_SERVER['REMOTE_ADDR'];

    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$scretKey&response=$responseKey&remoteip=$userIP";
    $response = file_get_contents($url);
    $response = json_decode($response);

    if ($response->success) {
        $_SESSION['msg'] = "<strong> <span class='text-success'>Verification success</span>, Your name is :<span class='text-uppercase'> $username </span> </strong>";
    } else {
        $_SESSION['msg'] = "";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reCAPTCHA</title>
    <link href="Bootstrap/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container-sm" style="margin-top: 100px;">
        <div class="row justify-content-center">
            <div class="display-5 text-center mb-4">reCAPTCHA</div>
            <div class="text-center mt-2 mb-2 verify h6">
                <?php
                if (isset($_SESSION['msg'])) {
                    echo $_SESSION['msg'];
                }
                ?>
            </div>
            <form action="index.php" method="POST" class="col-md-6 col-md-offset-3" id="ctct-custom-form">
                <div class=" mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Steve Smith" required>
                </div>
                <div class="g-recaptcha" data-sitekey="6LfIjJEbAAAAADdpKF2ogxwBZKdaFNdIt7QwLnC6" required></div>
                <button type="submit" name="submit" class="btn btn-primary mt-3">save</button>

            </form>
        </div>
    </div>

    <!-- reCAPTCHA API URL -->
    <script src="https://www.google.com/recaptcha/api.js"></script>

    <script>
        //  reCAPTCHA Verification 
        var form = document.getElementById('ctct-custom-form');
        form.addEventListener("submit", function(event) {
            if (grecaptcha.getResponse() === '') {
                event.preventDefault();
                document.querySelector(".verify").innerHTML = `<span class='text-danger h5'>Please check the reCAPTCHA</span>`;
            }
        }, false);


    </script>
</body>

</html>