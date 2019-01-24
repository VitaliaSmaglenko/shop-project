<?php include("views/include/header.php"); ?>


<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>
    <br> <h1 class="h3 mb-3 font-weight-normal">Edit data</h1>
    <hr class="featurette-divider">
    <?php

    if (isset($errors) && !empty($errors)) {
        echo '<ul>';
        for ($i=0; $i<count($errors); $i++) {
            echo '<li>';
            echo $errors[$i];
            echo '</li>';
        }
        echo '</ul>';
    }
    ?>
    <?php  if ($result) {
        echo ' <br> <h1 class="h3 mb-3 font-weight-normal">Data save</h1>';
        echo ' <a class="btn btn-sm btn-outline-secondary" href="/cabinet">Back to cabinet</a>';
    } else {
        ?>
    <form method="post" class="validation" novalidate  action="#">

        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="validationCustom01">First name</label>
                <input type="text" name="firstName" class="form-control"
                id="validationCustom01" placeholder="First name" value="<?php echo $user->getFirstName();?>" required>
                <div class="invalid-feedback">
                    Please choose a first name.
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <label for="validationCustom02">Last name</label>
                <input type="text" name="lastName" class="form-control" id="validationCustom02"
                 placeholder="Last name" value="<?php echo $user->getLastName();?>" required>
                <div class="invalid-feedback">
                    Please choose a last name.
                </div>
            </div>




            <div class="col-md-4 mb-3">
                <label for="validationCustomUsername">Password</label>
                <input type="password" name="password" data-minlength="6"
                 class="form-control" id="inputPassword" placeholder="Password" value="" required>
                <div class="invalid-feedback feedback-pos">
                    Please input password
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <label for="validationCustomUsername">Your phone number</label>
                <input type="text" name="phone" value="<?php echo $user->getPhone();?>"
                       placeholder="Your phone number"
                       class=" white  form-control"
                       id="phone_no" pattern="^((8|\+3)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$" required>
                <div class="invalid-feedback feedback-pos">
                    Please input phone number
                </div>
            </div>


        </div>



        <button class="btn btn-primary" name="submitSave" type="submit">Save</button>
        <a class="btn  btn-primary" href="/cabinet">Back to cabinet</a>
    </form>
    <?php } ?>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</div>


<br>
<hr class="featurette-divider"><br>

<?php include("views/include/footer.php"); ?>

