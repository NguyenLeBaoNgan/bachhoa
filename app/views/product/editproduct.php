<?php include_once 'app/views/admin/header.php'; ?>
<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <?php include_once 'app/views/admin/sidebar.php'; ?>
        <div class="body-wrapper">
        <?php if (isset($errors)): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($errors as $err): ?>
                <li><?= $err ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
<form  action="/chieu2/product/save" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <?php if (empty($product->image) || !file_exists($product->image)): ?>
                            <p>No Image!</p>
                        <?php else: ?>
                            <img src="/chieu2/<?= $product->image ?>" alt="Product Image"style="height: 340px; width: 340px;">
                        <?php endif; ?>
                                <input type="file" class="form-control" id="image" name="image">
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                        <input type="hidden" name="id" value="<?= $product->id ?>">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name"  value="<?= $product->name ?>" name="name">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" value="<?= $product->description ?>" ></textarea>
                            </div>

                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text" class="form-control" id="price" value="<?= $product->price ?>" name="price">
                            </div>
                            <div class="form-group">
                                    <label for="price">Danh mục</label>
                                <select class="form-control" id="categoryid" name="categoryid">
                                <?php while ($row = $categories->fetch(PDO::FETCH_ASSOC)): ?>
                                    <option  value="<?= $row['id'] ?>"  ?><?= $row['name'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                                </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Cập nhập </button>
                </div>
            </div>
        </form>
        </div>
        </body >
        <script src="/chieu2/public/admin/libs/jquery/dist/jquery.min.js"></script>
        <script src="/chieu2/public/admin/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

        <script src="/chieu2/public/admin/js/sidebarmenu.js"></script>
        <script src="/chieu2/public/admin/js/app.min.js"></script>
        <script src="/chieu2/public/admin/libs/simplebar/dist/simplebar.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sockjs-client/1.5.2/sockjs.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/stomp.js/2.3.3/stomp.min.js"></script>
        <script>


