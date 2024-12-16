<div id="layoutSidenav_nav">

                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>

                            <a class="nav-link" href="order-create.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-bell"></i></div>
                                Create Sales
                            </a>

                            <a class="nav-link" href="sales-view.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                                Sales
                            </a>

                                            <!--INVENTORY BAR-->
                            <div class="sb-sidenav-menu-heading">Inventory</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Categories
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>    
                            
                            
                                                        <!--category dropdown-->
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="categories-create.php">Add Category</a>
                                    <a class="nav-link" href="categories.php">View Category</a>
                                </nav>
                            </div>



                                                    <!--PRODUCT BAR-->
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProduct" aria-expanded="false" aria-controls="collapseProduct">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Products
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>    
                            
                            
                                                        <!--Products dropdown-->
                            <div class="collapse" id="collapseProduct" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="products-create.php">Add Product</a>
                                    <a class="nav-link" href="products.php">View Product</a>
                                </nav>
                            </div>

                                                            <!--Customer Bar-->
                            <div class="sb-sidenav-menu-heading">Manage Users</div>
                        
                                                             <!--Admin Bar-->
                            <a class="nav-link collapsed" href="#" 
                            data-bs-toggle="collapse" 
                            data-bs-target="#collapsAdmins" 
                            aria-expanded="false" aria-controls="collapsAdmins">

                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Admins/Staff
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>                <!--admin dropdown-->
                            <div class="collapse" id="collapsAdmins" 
                            aria-labelledby="headingOne" 
                            data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="admins_create.php">Add Admin</a>
                                    <a class="nav-link" href="admins.php">View Admins</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <!--<div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
                    </div>-->
                </nav>
            </div>