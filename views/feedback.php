<?php include("views/include/header.php"); ?>

<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="//">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Feedback</li>
        </ol>
    </nav>
    <hr class="featurette-divider">

    <?php if ($send == false) {?>

    <form class="form-signin" method="post">
        <div class="text-center mb-4">

            <br> <h1 class="h3 mb-3 font-weight-normal">Send your letter</h1>

        </div>
        <table class="form-sign" align="center" valign="center">
            <tr><td class="">
                    <div class="form-label-group justify-content-center">
                        <label for="inputEmail">Email address</label><br>
                        <input type="email" name="email" id="inputEmail"
                               class="aut-for" placeholder="Email address" required autofocus>

                    </div>

                    <div class="form-label-group">
                        <br>
                        <label for="inputPassword">Your name </label><br>
                        <textarea name="name"></textarea>

                    </div>
                    <div class="form-label-group">
                        <br>
                        <label for="inputPassword">Theme of letter</label><br>
                        <textarea name="theme"></textarea>

                    </div>
                    <div class="form-label-group">
                        <br>
                        <label for="inputPassword">Your message</label><br>
                        <textarea name="message"></textarea>
                    </div>



                    <button class="btn aut-for btn-lg btn-primary btn-block"
                            name="submitSend" type="submit">Send</button>

                </td></tr>
        </table>

    </form>
    <?php } else {?>
        <div class="text-center mb-4">

            <br> <h1 class="h3 mb-3 font-weight-normal">Your letter send</h1>

        </div>
    <?php }?>

</div>

<br>
<hr class="featurette-divider"><br>
<?php include("views/include/footer.php"); ?>
