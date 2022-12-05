<?php include "includes/header.php" ?>
        <!-- Sidebar -->
        <?php include "includes/sidebar.php" ?>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <?php include "includes/navigation.php"?>

            <!-- THE CUSTOMER , SERVICE, DIVS -->

            <div class="container-fluid px-4">
                <div class="row g-3 my-2" style="display:flex;justify-content:center">
                    <div class="col-md-2">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2" id="employees"></h3>
                                <p class="fs-5">Employees</p>
                            </div>
                            <i class="fas fa-user-cog fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2" id="appointments"></h3>
                                <p class="fs-5">Appointments</p>
                            </div>
                            <i
                                class="fas fa-calendar-check fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2" id="services"></h3>
                                <p class="fs-5">Services</p>
                            </div>
                            <i class="fas fa-cut fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2" id="clients"></h3>
                                <p class="fs-5">Customers</p>
                            </div>
                            <i class="fas fa-users fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>
                </div>

                <div class="row my-5 shadow-lg p-3 mb-5 bg-white rounded" style="margin:0 auto;width:85rem;height:40rem">
                    <div class="col " id="columnchart_material" style="width: 800px;">
                    
            </div>
                </div>

            </div>

            <!-- !!!!! -->

        </div>
   <?php include "includes/footer.php" ?>
<script defer type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script defer type="text/javascript" src="js/chart.js"></script>  
<script>
    window.addEventListener('load',()=>{ // document loaded
        getEntitiesCount(); // invoke function 
    })
</script>