<?php include("views/include/header.php"); ?>
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>
    <br> <h1 class="h3 mb-3 font-weight-normal">Checkout</h1>
    <hr class="featurette-divider">


    <table class="form-sign" align="center" valign="center" width="1000px">
        <form method="post" class="validation" novalidate  action="#">
            <tr><td class="">

                <div class="col-md-4 mb-3">
                    <label for="validationCustom01">First name</label>
                    <input type="text" name="firstName" class="form-control" id="validationCustom01" placeholder="First name" value="" required>
                    <div class="invalid-feedback">
                        Please choose a first name.
                    </div>
                </div>
                </td></tr>
            <tr> <td>
                <div class="col-md-4 mb-3">
                    <label for="validationCustom02">Last name</label>
                    <input type="text" name="lastName" class="form-control" id="validationCustom02" placeholder="Last name" value="" required>
                    <div class="invalid-feedback">
                        Please choose a last name.
                    </div>
                </div>
                </td></tr>


            <tr> <td>
                <div class="col-md-4 mb-3">
                    <label for="validationCustomUsername">Number of phone</label>
                    <input type="password" name="password" data-minlength="6" class="form-control" id="inputPassword" placeholder="Password" value="" required>
                    <div class="invalid-feedback feedback-pos">
                        Please input password
                    </div>
                </div>



        </td></tr>

                <tr> <td>

                    <div class="col-md-4 mb-3">
                        <label for="validationCustomUsername">Comment</label>
                        <textarea name="comment"  class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Comment" value=""  required> </textarea>
                        <div class="invalid-feedback feedback-pos">
                            Please input password
                        </div>
                    </div>
                </td></tr>


            <tr><td><div class="col-md-4 mb-3">
                    <button class="btn btn-primary" name="submitSave" type="submit">Save</button>
                    </div></td></tr>

        </form>
    </table>
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
