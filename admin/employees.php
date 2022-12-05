<?php include "includes/header.php"?>

<!-- Sidebar -->
<?php include "includes/sidebar.php" ?>
<!-- /#sidebar-wrapper -->

<!-- page contents -->
<div id="page-content-wrapper">
            <?php include "includes/navigation.php"?>
    <div class="alert" role="alert" id="success" style="width: 20rem;margin-left:25rem;"></div>

<!-- Add Emp Modal -->
        <div class="modal fade" id="employeeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="employeeModalLabel">Service Details</h5>
                </div>
                <div class="modal-body">
                    <form action="" id="emp_form" method="POST">
                        <div class="form-group mb-2">
                            <label for="fname">Employee First Name</label>
                            <input type="text" name="fname" id="fname" class="form-control" placeholder="Enter First Name" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="lname">Employee Last Name</label>
                            <input type="text" name="lname" id="lname" class="form-control" placeholder="Enter Last Name" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="img">Employee Image</label>
                            <input type="file" name="img" id="img" class="form-control" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="img">Employee Gender</label>
                            <select name="gender" id="gender" class="form-control select">
                                <option value="Male">M</option>
                                <option value="Female">F</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="city">City</label>
                            <input type="text" name="city" id="city" class="form-control" placeholder="Enter City" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter phone" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="salary">Salary</label>
                            <input type="number" name="salary" id="salary" class="form-control" min=500 placeholder="Enter Salary" required>
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
<!-- Small modal -->
<!-- Delete Confirmation Modal -->

<div class="modal fade bd-example-modal-sm" tabindex="-1" id="deleteModal" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content" id="modal_delete" style="padding: 2rem;display:flex;flex-direction:column;align-items:center;">
        <b style="font-size: 2rem;">&#10060;</b><br>
        <h3>Are you sure?</h3>
        <input type="hidden" name="" id="secret_delete_id">
        <p>Do you really want to delete the Employee?</p> <br>
        <div class="btn-row">
          <button class="btn btn-secondary" data-bs-dismiss="modal" id="cancel">Cancel</button>
          <button type="submit" class="btn btn-danger" onclick="deleteEmployee()">Delete</button>
        </div>
       
    </div>
  </div>
</div>


<!-- Edit Emp Modal -->
        <div class="modal fade" id="editemployeeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="employeeModalLabel">Service Details</h5>
                </div>
                <div class="modal-body">
                    <form action="" id="edit_emp_form" method="POST">
                    <input type="hidden" name="" id="secret">
                    <div class="form-group mb-2">
                            <label for="city">City</label>
                            <input type="text" name="empcity" id="empcity" class="form-control" placeholder="Enter City" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="phone">Phone</label>
                            <input type="text" name="empphone" id="empphone" class="form-control" placeholder="Enter phone" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="salary">Salary</label>
                            <input type="number" name="empsalary" id="empsalary" class="form-control" min=500 placeholder="Enter Salary" required>
                        </div>
                        <div class="alert" role="alert" id="alert"></div>
                        <div class="modal-footer">
                            <button type="button" id="editclose" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="update">Update</button>
                        </div>
                    </form>
                </div>
                
                </div>
            </div>
        </div>
            <div class="container-sm shadow-lg p-3 mb-5 bg-white rounded">
                <nav class="navbar navbar-light bg-light mb-3">
                    <form class="form-inline d-inline-flex">
                        <input class="form-control mr-sm-2  w-75" type="search" id="search" placeholder="Search" aria-label="Search" style="margin-right: 0.7rem;">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </nav>
                <div class="d-flex flex-row mb-3">
                <button type="button"  class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#employeeModal">Add Employee</button>
                    <select name="sort" id="sort" class="form-control select w-25 p-0">
                            <option value="">Sort By</option>
                            <option value="fname">Name</option>
                            <option value="city">City</option>
                            <option value="salary">Salary</option>

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
                        <th>Gender</th>
                        <th>City</th>
                        <th>Phone</th>
                        <th>Salary</th>
                        <th>Profile</th>
                        <th>Actions</th>
                    </thead>
                    <tbody id="employee_table"></tbody>
                </table>
            </div>
</div>
<script>
window.addEventListener('load',()=>{ // document ready
    getEmployees();
})

const order = document.querySelector("#order");// order dropdown option
    order.addEventListener('change',(e)=>{// user selects and option (asc,des)
        getEmployees();// invoke employees function to get employee in such order
    })

const sort = document.querySelector("#sort");// sort dropdown 
sort.addEventListener('change',(e)=>{// user selects an option (e.g name)
    getEmployees();// get employee in that sort
})

const search = document.querySelector("#search");
search.addEventListener('input',(e)=>{
    getEmployees();
})

const addForm = document.querySelector('#emp_form'); // add employee form
addForm.addEventListener('submit',(e)=>{ // add employee form submitted
    e.preventDefault();
    addEmployee(); // add employee
})

const editForm = document.querySelector('#edit_emp_form'); // edit employee form
editForm.addEventListener('submit',(e)=>{ // edit employee form submitted
    e.preventDefault();
    updateEmployee(); // update employee
})

const imgInput = document.querySelector('#img'); // file input
  let img; // to store image name
  imgInput.addEventListener('change',(e)=>{ // triggered by file upload
      const path = e.target.value.split("\\"); // split path
      img = path[path.length-1]; // get image name
})

</script>
<?php include "includes/footer.php"?>

