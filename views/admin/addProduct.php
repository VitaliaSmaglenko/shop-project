<?php include("views/include/header_admin.php"); ?>

    <div class="container-fluid">
        <div class="row">
            <?php include("views/include/nav_admin.php"); ?>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>

                </div>

                <?php  if(isset($errors) && !empty($errors)) {
                    echo '<ul>';
                    for($i=0; $i<count($errors); $i++) {
                        echo '<li>';
                        echo $errors[$i];
                        echo '</li>';
                    }
                    echo '</ul>';
                }
                ?>

                <h2>Add product</h2>
                <br>
                <form method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="name">Product name </label>
                            <br>
                            <input type="text" id="name" name="name">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="price">Price </label>
                            <br>
                            <input type="text" id="price" name="price">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="category_id">Category</label>
                            <br>
                            <select name="category_id">
                                <?php   for ($i=0; $i<count($categories); $i++) {?>
                                    <option value=" <?php echo $categories[$i]->getId();?>">
                                            <?php echo $categories[$i]->getCategory(); ?>
                                    </option>
                                <?php }?>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="image">Image</label>
                            <br>
                            <input type="file" id="image" name="image">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="availability">Availability </label>
                            <br>
                            <input type="text" id="availability" name="availability">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="brand">Brand </label>
                            <br>
                            <input type="text" id="brand" name="brand">
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="description">Description </label>
                            <br>
                            <textarea name="description"></textarea>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="specifications">Specifications</label>
                            <br>
                            <textarea name="specifications"></textarea>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="is_new">New</label>
                            <br>
                            <select name="is_new">
                                <option value="1">Yes</option>
                                <option value="o">No</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="status">Status</label>
                            <br>
                            <select name="status">
                                <option value="1">Displayed</option>
                                <option value="o">Not displayed</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <br>
                            <button class="btn btn-primary" name="submitSave" type="submit">Save</button>
                            <a class="btn  btn-primary" href="/admin/product">Back</a>
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
/**
 * Created by PhpStorm.
 * User: Виталия
 * Date: 19.01.2019
 * Time: 16:35
 */