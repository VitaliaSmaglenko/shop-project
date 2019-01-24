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

                <h2>Edit product</h2>
                 <br>
                <form method="post" enctype="multipart/form-data" >
                    <div class="form-row ">
                        <div class="col-md-10 mb-1">
                            <label for="name">Product name </label>
                            <br>

                            <textarea name="name"
                            class="form-control" id="exampleFormControlTextarea1" rows="3"><?php echo $product->getName();?></textarea>

                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-4 mb-1">
                            <label for="price">Price </label>
                            <br>
                            <input type="text"  value= "<?php echo $product->getPrice();?>" name="price">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-4 mb-1">
                            <label for="category_id">Category</label>
                            <br>
                            <select name="category_id" >
                                <?php   for ($i=0; $i<count($categories); $i++) {?>
                                    <option value=" <?php echo $categories[$i]->getId();?>"
                                        <?php
                                        if($product->getCategoryId() == $categories[$i]->getId())
                                        { echo ' selected="selected"';}?>>
                                        <?php echo $categories[$i]->getCategory(); ?>
                                    </option>
                                <?php }?>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-4 mb-1">
                            <label for="image">Image</label>
                            <br>
                            <img src="../../../components/<?php echo $product->getImage();?>" width="150" height="150">
                            <br>
                            <?php echo $product->getImage();?>
                            <input type="file" value="<?php echo $product->getImage();?>" id="image" name="image">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-4 mb-1">
                            <label for="availability">Availability </label>
                            <br>
                            <input type="text"  value= "<?php echo $product->getAvailability();?>" name="availability">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-4 mb-1">
                            <label for="brand">Brand </label>
                            <br>
                            <input type="text" id="brand" name="brand"  value= "<?php echo $product->getBrand();?>">
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="col-md-10 mb-1">
                            <label for="description">Description </label>
                            <br>
                            <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"><?php echo $product->getDescription();?></textarea>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="col-md-10 mb-1">
                            <label for="specifications">Specifications</label>
                            <br>
                            <textarea name="specifications"  class="form-control" id="exampleFormControlTextarea1" rows="3"><?php echo $product->getSpecifications();?>

                            </textarea>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="col-md-4 mb-1">
                            <label for="is_new">New</label>
                            <br>
                            <select name="is_new">
                                <option value="1" <?php if($product->getIsNew() == 1){ echo 'selected="selected"';};?>>Yes</option>
                                <option value="0" <?php if($product->getIsNew() == 0){ echo 'selected="selected"';};?>>No</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="col-md-4 mb-1">
                            <label for="status">Status</label>
                            <br>
                            <select name="status">
                                <option value="1" <?php if($product->getStatus() == 1){ echo 'selected="selected"';};?>>Displayed</option>
                                <option value="0" <?php if($product->getStatus() == 0){ echo 'selected="selected"';};?>>Not displayed</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <br>
                            <button class="btn btn-primary" name="submitEdit" type="submit">Edit</button>
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
