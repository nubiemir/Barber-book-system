<?php include "includes/header.php"?>

<!-- Sidebar -->
<?php include "includes/sidebar.php" ?>
<!-- /#sidebar-wrapper -->

<!-- page contents -->
<div id="page-content-wrapper">
            <?php include "includes/navigation.php"?>
            <div class="container-sm shadow-lg p-3 mb-5 bg-white rounded">
                <nav class="navbar navbar-light bg-light mb-3">
                    <form class="form-inline d-flex flex-row">
                        <input class="form-control mr-sm-2 mr-1 w-50" id="search" type="search" placeholder="Search" aria-label="Search" style="margin-right: 0.5rem;">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </nav>
                <div class="d-flex flex-row mb-3">
                    <select name="sort" id="sort" class="form-control select w-25 p-0">
                            <option value="">Sort By</option>
                            <option value="fname">Name</option>
                            <option value="username">Username</option>
                            <option value="email">E-mail</option>
                            <option value="date_creation">Date</option>

                    </select>

                    <select name="order" id="order" class="form-control select w-25 p-0">
                            <option value="">Order</option>
                            <option value="ASC">Ascending</option>
                            <option value="DESC">Descending</option>
                    </select>
            </div>
                <table class="table table-hover">
                    <thead class="table-primary">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Phone</th>
                        <th>E-mail</th>
                        <th>Date</th>
                    
                    </thead>
                    <tbody id="client_table"></tbody>
                </table>
            </div>
</div>
<script>
window.addEventListener('load',()=>{ // document loaded
    getClients(); // get clients and generate table
})

const order = document.querySelector("#order");// order dropdown option
    order.addEventListener('change',(e)=>{// user selects and option (asc,des)
      getClients();// invoke appointments to get clients in such order
    })

const sort = document.querySelector("#sort"); // sort dropdown 
sort.addEventListener('change',(e)=>{// user selects an option (e.g name)
    getClients();// get clients in that sort
})

const search = document.querySelector("#search"); // search input
search.addEventListener('input',(e)=>{ // user types in the search bar
    getClients(); // get clients with username similar to the input of search bar
})


</script>
<?php include "includes/footer.php"?>