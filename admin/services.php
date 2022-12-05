<?php include "includes/header.php"?>
<!-- Sidebar -->
<?php include "includes/sidebar.php" ?>
<!-- /#sidebar-wrapper -->
<!-- page contents -->
<div id="page-content-wrapper">
            <?php include "includes/navigation.php"?>
            <!-- Button trigger modal -->

<div class="alert" role="alert" id="success" style="width: 20rem;margin-left:19rem;"></div>

<!-- Add Service Modal -->
<div class="modal fade" id="serviceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="serviceModalLabel">Service Details</h5>
      </div>
      <div class="modal-body">
        <form action="" id="service_form">
            <div class="form-group mb-2">
                <label for="name">Service Name</label>
                <input type="text" name="seviceName" id="name" class="form-control" placeholder="Enter Service Name" required>
            </div>
            <div class="form-group mb-2">
                <label for="duration">Service Duration</label>
                <input type="number" name="seviceDuration" id="duration" class="form-control" min=19 placeholder="Enter Service Duration" required>
            </div>
            <div class="form-group mb-2">
                <label for="service_price">Service Price</label>
                <input type="number" name="sevicePrice" id="price" class="form-control" min=20 placeholder="Enter Service Price" required>
            </div>
            <div class="alert" role="alert" id="alert"></div>
            <div class="modal-footer">
                <button type="button" id="close" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
        </form>
      </div>
      
    </div>
  </div>
</div>

<!-- Delete Confirmation Modal -->

<div class="modal fade bd-example-modal-sm" tabindex="-1" id="deleteModal" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content" id="modal_delete" style="padding: 2rem;display:flex;flex-direction:column;align-items:center;">
        <b style="font-size: 2rem;">&#10060;</b><br>
        <h3>Are you sure?</h3>
        <input type="hidden" name="" id="delete_id">
        <p>Do you really want to delete the service?</p> <br>
        <div class="btn-row">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger" onclick="deleteService()">Delete</button>
        </div>
       
    </div>
  </div>
</div>


<!-- Edit modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="serviceModalLabel">Service Details</h5>
      </div>
      <div class="modal-body">
        <form action="" method="POST" id="edit_form" > 
        <input type="hidden" name="" id="edit_id">
            <div class="form-group mb-2">
                <label for="name">Service Name</label>
                <input type="text" name="seviceName" id="edit_name" class="form-control" placeholder="Enter Service Name" required>
            </div>
            <div class="form-group mb-2">
                <label for="duration">Service Duration</label>
                <input type="number" name="seviceDuration" id="edit_duration" class="form-control" min=19 placeholder="Enter Service Duration" required>
            </div>
            <div class="form-group mb-2">
                <label for="service_price">Service Price</label>
                <input type="number" name="sevicePrice" id="edit_price" class="form-control" min=20 placeholder="Enter Service Price" required>
            </div>
            <div class="alert" role="alert" id="alert"></div>
            <div class="modal-footer">
                <button type="button" id="edit_close" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
      </div>
      
    </div>
  </div>
</div>


<div class="container-sm shadow-lg p-3 mb-5 bg-white rounded">
    <div class="d-flex flex-row">
      <button type="button"  class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#serviceModal">Add Service</button>
      <select name="sort" id="sort" class="form-control select w-25 p-0">
            <option value="">Sort By</option>
            <option value="servname">Name</option>
            <option value="servprice">Price</option>
            <option value="servduration">Duration</option>
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
                <th>Service Name</th>
                <th>Duration Time</th>
                <th>Price</th>
                <th>Actions</th>
            </thead>
            <tbody id="service_table"></tbody>
        </table>
    </div>
    </div>
<script>
  

    window.addEventListener('load',()=>{
        getServices();
    })

    const order = document.querySelector("#order");// order dropdown option
    order.addEventListener('change',(e)=>{// user selects and option (asc,des)
      getServices();// invoke services to get services in such order
    })

    const sort = document.querySelector("#sort");// sort dropdown 
    sort.addEventListener('change',(e)=>{// user selects an option (e.g date)
      getServices();// get services in that sort
    })

    const form = document.querySelector('#service_form'); // add service form
    form.addEventListener('submit',(e) => { // add form submitted
        e.preventDefault();
        addService(); // invoke add form function
    })
    const editform = document.querySelector('#edit_form'); // edit service form
    editform.addEventListener('submit',(e) => { // edit form submitted
        e.preventDefault();
        editService(); // invoke edit form function
    })



    $('.btn-danger').attr("data-bs-toggle", "modal");
    $('.btn-danger').attr("data-bs-target", ".bd-example-modal-sm");




</script>

<?php include "includes/footer.php"?>