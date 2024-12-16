<?php include('includes/header.php'); ?>

<div class="container-fluid px-4 ">
    <h1 class="mt-4 ">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"></li>
        </ol>
        <div class="row"> 
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">
                                        <h4>Admins </h4>
                                    </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                            <label class="fw-bold mb-0"><h6>Total : <?= getCount('admins'); ?></h6></label>
                            <!-- <div class="small text-white"><i class="fas fa-angle-right"></i></div> -->
                            </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card bg-info text-white mb-4">
                            <div class="card-body">
                                <h4>Products</h4>
                            </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                        <label class="small text-white stretched-link"><h6>Total : <?= getCount('products'); ?></h6></label>
                        <!-- <div class="small text-white"><i class="fas fa-angle-right"></i></div> -->
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card bg-info text-white mb-4">
                            <div class="card-body">
                                <h4>Categories</h4>
                            </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                        <label class="small text-white stretched-link"><h6>Total : <?= getCount('categories'); ?></h6></label>
                        <!-- <div class="small text-white"><i class="fas fa-angle-right"></i></div> -->
                        </div>
                    </div>
                </div>

                <?php $totalSales = $_SESSION['totalSales']; ?>

                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success  text-white mb-4">
                            <div class="card-body">
                                <h4>Total Sales</h4>
                            </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                        <label class="small text-white stretched-link"><h6>Total : ₱ <?= number_format($totalSales, 2); ?></h6></label>
                                <!-- <div class="small text-white"><i class="fas fa-angle-right"></i></div> -->
                        </div>
                    </div>
                </div>
                <hr>

                
                <div class="col-xl-4 col-md-6">
                    <div class="card bg-success  text-white mb-">
                            <div class="card-body">
                                <h4>Fast Moving Products</h4>
                            </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <label class="small text-white stretched-link"><h6> <?php if (!empty($_SESSION['topFastestMovingItems']))  ?>        
                                <ul>
                                    <?php foreach ($_SESSION['topFastestMovingItems'] as $item): ?>
                                        <li>   
                                            <?= htmlspecialchars($item['name']); ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>     
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                            <div class="card-body">
                                <h4>Number of Sales</h4>
                            </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                        <label class="small text-white stretched-link"><h6>Total : <?= $_SESSION['totalItems']; ?></h6></label>
                        </div>
                    </div>
                </div>  

                <div class="col-xl-4 col-md-6">
                    <div class="card bg-danger  text-white mb-">
                            <div class="card-body">
                                <h4>Slow Moving Products</h4>
                            </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <label class="small text-white stretched-link"><h6> <ul>
                                <?php foreach ($_SESSION['slowMovingItems'] as $item): ?>
                                    <li><?= htmlspecialchars($item['name']); ?></li>
                                <?php endforeach; ?>
                            </ul>
                                   
                            </label>
                        </div>
                    </div>
                </div>

                       
        </div>                  
                            
<?php include('includes/footer.php'); ?>