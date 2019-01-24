<?php include("views/include/header.php"); ?>


<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="//">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Registartion</li>
        </ol>
    </nav>
    <br> <h1 class="h3 mb-3 font-weight-normal">Sing up</h1>
    <hr class="featurette-divider">
    <?php if (isset($errors) && !empty($errors)) {
            echo '<ul>';
        for ($i=0; $i<count($errors); $i++) {
                    echo '<li>';
                        echo $errors[$i];
                    echo '</li>';
        }
            echo '</ul>';
    } ?>
    <form method="post" class="validation" novalidate  action="#">
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="validationCustom01">First name</label>
                <input type="text" name="firstName" class="form-control"
                       id="validationCustom01" placeholder="First name" value="<?php echo $firstName;?>" required>
                <div class="invalid-feedback">
                    Please choose a first name.
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <label for="validationCustom02">Last name</label>
                <input type="text" name="lastName" class="form-control" id="validationCustom02"
                       placeholder="Last name" value="<?php echo $lastName;?>" required>
                <div class="invalid-feedback">
                    Please choose a last name.
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label for="validationCustomUsername">User name</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                    </div>
                    <input type="text" name="userName" class="form-control" id="validationCustomUsername"
                    value="<?php echo $userName;?>"  placeholder="User name"
                           aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                        Please choose a user name.
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label for="validationCustomUsername">Email</label>
                <input type="email" name="email" value="<?php echo $email;?>"
                       placeholder="Your email"
                       class="email white  form-control"
                       id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
                <div class="invalid-feedback feedback-pos">
                    Please input valid email
                </div>
            </div>


            <div class="col-md-4 mb-3">
                <label for="validationCustomUsername">Your phone number</label>
                <input type="text" name="phone" value="<?php echo $phone;?>"
                       placeholder="Your phone number"
                       class=" white  form-control"
                       id="phone_no" pattern="^((8|\+3)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$" required>
                <div class="invalid-feedback feedback-pos">
                    Please input phone number
                </div>
            </div>

        <div class="col-md-4 mb-3">
            <label for="validationCustomUsername">Password</label>
            <input type="password" name="password" data-minlength="6"
                   class="form-control" id="inputPassword" placeholder="Password" required>
            <div class="invalid-feedback feedback-pos">
                Please input password
            </div>
        </div>


        </div>
        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                <label class="form-check-label" for="invalidCheck">
                    I agree to the terms of use of the site
                </label>
                <div class="invalid-feedback">
                    You must agree before submitting.
                </div>
            </div>
        </div>


        <button class="btn btn-primary" name="submitReg" type="submit">Sign up</button>
    </form>

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

