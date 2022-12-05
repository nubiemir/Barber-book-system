<?php include "includes/header.php"?>
<!-- Sidebar -->
<?php include "includes/sidebar.php" ?>
<!-- /#sidebar-wrapper -->
<!-- page contents -->

<div id="page-content-wrapper">
            <?php include "includes/navigation.php"?>
            <div class="alert" role="alert" id="success" style="width: 20rem;margin-left:19rem;"></div>
            <div class="container-sm shadow-lg p-3 bg-white rounded">
            <div class="d-flex flex-row mb-2">
                    <select name="sort" id="sort" class="form-control select w-25 ">
                          <option value="">Sort By</option>
                          <option value="review">Review</option>
                          <option value="user">Reviewer</option>
                    </select>

                    <select name="order" id="order" class="form-control select w-25">
                          <option value="">Order</option>
                          <option value="ASC">Ascending</option>
                          <option value="DESC">Descending</option>
                    </select>
                </div>
                <table class="table">
                    <thead class="table-primary">
                        <th>ID</th>
                        <th>Reviewer</th>
                        <th>Review</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody id="review_table"></tbody>
                </table>
            </div>          
</div>

<script>
    window.addEventListener('load',()=>{ // document ready
        getReviews(); // get reviews
    })

    const order = document.querySelector("#order");// order dropdown option
    order.addEventListener('change',(e)=>{// user selects and option (asc,des)
      getReviews();// invoke reviews to get reviews in such order
    })

    const sort = document.querySelector("#sort");// sort dropdown 
    sort.addEventListener('change',(e)=>{// user selects an option (e.g date)
      getReviews();// get reviews in that sort
    })
    
</script>
<?php include "includes/footer.php"?>