<?php include("views/include/header.php"); ?>

<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="//">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Authorisations</li>
        </ol>
    </nav>
    <hr class="featurette-divider">

    <form class="form-signin" method="post">
        <div class="text-center mb-4">

            <br> <h1 class="h3 mb-3 font-weight-normal">Sing in</h1>

        </div>
        <?php
        if(isset($errors) && !empty($errors)) {
            echo '<ul>';
            for($i=0; $i<count($errors); $i++) {
                echo '<li>';
                echo $errors[$i];
                echo '</li>';
            }
            echo '</ul>';
        }
        ?>
        <table class="form-sign" align="center" valign="center">
            <tr><td class="">
                    <div class="form-label-group justify-content-center">
                        <label for="inputEmail">Email address</label><br>
                        <input type="email" name="email" id="inputEmail" class="aut-for" placeholder="Email address" required autofocus>

                    </div>

                    <div class="form-label-group">
                        <br>
                        <label for="inputPassword">Password</label><br>
                        <input type="password" name="password" id="inputPassword" class="aut-for" placeholder="Password" required>

                    </div>

                    <div class="aut-for">
                        <br>
                        <label>
                            <input width="100px" type="checkbox" value="remember-me"> Remember me
                        </label>
                    </div>
                    <button class="btn aut-for btn-lg btn-primary btn-block" name="submitLog" type="submit">Sign in</button>
                    <p class="mt-5 mb-3 text-muted text-center"><a href="index.php">Forgot password?</a></p>
                    <p class="mt-5 mb-3 text-muted text-center"><a href="index.php">To register</a></p><br>
                </td></tr>
        </table>

    </form>

</div>

<br>
<hr class="featurette-divider"><br>

<?php include("views/include/footer.php"); ?>

