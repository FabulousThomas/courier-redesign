<?php require APPROOT . '/views/access/inc/head.php'; ?>

<body class="bg-white d-flex flex-column align-items-center justify-content-center">
    <!-- LOGIN -->
    <section class="container">
        <h2 class="text-center">Login</h2>
        <div class="col-lg-6 col-12 mx-auto card border-0 rounded-0 shadow">
            <div class="card-body py-4">
                <div class=""><?php flashMsg('error'); ?></div>
                <form method="POST" class="w-100" id="form" enctype="multipart/form-data">

                    <div class="form-group mb-2">
                        <label for="email" class="m-0">Email</label>
                        <input type="email" class="form-control shadow-none" name="email" placeholder="Email" inputmode="email" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="password" class="m-0">Password</label>
                        <input type="password" class="form-control shadow-none" name="password" placeholder="Password" inputmode="password" required>
                    </div>
                    <div class="form-group mb-">
                        <input type="submit" class="btn btn-secondary w-100" name="btn-login" value="Login">
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <?php require APPROOT . '/views/access/inc/footer.php'; ?>