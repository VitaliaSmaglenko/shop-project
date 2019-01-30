<?php include("views/include/header_admin.php"); ?>

    <div class="container-fluid " >
        <div class="row ">
            <?php include("views/include/nav_admin.php"); ?>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 ">
                <div class="d-flex justify-content-between flex-wrap
                flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>

                </div>

                <?php  if (isset($errors) && !empty($errors)) {
                    echo '<ul>';
                    for ($i=0; $i<count($errors); $i++) {
                        echo '<li>';
                        echo $errors[$i];
                        echo '</li>';
                    }
                    echo '</ul>';
                }
                ?>

                <h2>Edit user</h2>
                <br>
                <form method="post" enctype="multipart/form-data" >
                    <div class="form-row ">
                        <div class="col-md-10 mb-1">
                            <label>First Name </label>
                            <br>
                            <input type="text" name="firstName" value="<?php echo $user->getFirstName();?>"
                                      class="form-control" id="exampleFormControlTextarea1" rows="3">

                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-10 mb-1">
                            <label>Last Name </label>
                            <br>
                            <input type="text" name="lastName" value="<?php echo $user->getLastName();?>"
                                   class="form-control" id="exampleFormControlTextarea1" rows="3">

                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-10 mb-1">
                            <label>User Name </label>
                            <br>
                            <input type="text" name="userName" value="<?php echo $user->getUserName();?>"
                                   class="form-control" id="exampleFormControlTextarea1" rows="3">

                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-10 mb-1">
                            <label>Phone </label>
                            <br>
                            <input type="text" name="phone" value="<?php echo $user->getPhone();?>"
                                   class="form-control" id="exampleFormControlTextarea1" rows="3">

                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-10 mb-1">
                            <label>Email </label>
                            <br>
                            <input type="text" name="email" value="<?php echo $user->getEmail();?>"
                                   class="form-control" id="exampleFormControlTextarea1" rows="3">

                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-10 mb-1">
                            <label>Role</label>
                            <br>
                            <input type="text" name="role" value="<?php echo $user->getRole();?>"
                                   class="form-control" id="exampleFormControlTextarea1" rows="3">

                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <br>
                            <button class="btn btn-primary" name="submitEdit" type="submit">Edit</button>
                            <a class="btn  btn-primary" href="/admin/user">Back</a>
                        </div>
                    </div>
                </form>
            </main>
        </div>
    </div>
    <br>
    <br>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="/docs/4.2/assets/js/vendor/jquery-slim.min.js"><\/script>')</script><script src="/docs/4.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-zDnhMsjVZfS3hiP7oCBRmfjkQC4fzxVxFhBx8Hkz2aZX8gEvA/jsP3eXRCvzTofP" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
    <script src="dashboard.js"></script></body>
    </html><?php
