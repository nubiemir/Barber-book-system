<?php include "includes/header.php"?> 
<!-- Sidebar -->
<?php include "includes/sidebar.php" ?> 
<!-- /#sidebar-wrapper -->
<!-- page contents -->

<!-- Edit modal -->
<div class="modal fade" id="editApptModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="serviceModalLabel">Service Details</h5>
      </div>
      <div class="modal-body">
        <form action="" id="edit_form" method="POST">
          <input type="hidden" name="" id="edit_appt_id">
            <div class="form-group mb-2">
                <label for="name">Appointment Date</label>
                <input type="date" name="apptDate" id="edit_date" class="form-control" placeholder="Enter Date" required>
            </div>
            <div class="form-group mb-2">
                <label for="duration">Appointment Time</label>
                <input type="time" name="apptTime" id="edit_time" class="form-control" min=19 placeholder="Enter Time" required>
            </div>
            <div class="alert" role="alert" id="alert"></div>
            <div class="modal-footer">
                <button type="button" id="close" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Edit</button>
            </div>
        </form>
      </div>
      
    </div>
  </div>
</div>

<!--  -->
<!-- Add Modal -->
<div class="modal fade" id="addApptModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="appointmentModalLabel">Appointment Details</h5>
      </div>
      <div class="modal-body">
        <form action="" id="add_form" method="POST">
            <div class="form-group mb-2">
                <label for="name">Customer</label>
                <select name="customer" id="customer_select" class="form-control"></select>
            </div>
            <div class="form-group mb-2">
                <label for="service">Service</label>
                <select name="service" id="service_select" class="form-control"></select>
            </div>
            <div class="form-group mb-2">
                <label for="name">Appointment Date</label>
                <input type="date" name="apptDate" id="add_date" class="form-control" placeholder="Enter Date" required>
            </div>
            <div class="form-group mb-2">
                <label for="duration">Appointment Time</label>
                <input type="time" name="apptTime" id="add_time" class="form-control" min=19 placeholder="Enter Time" required>
            </div>
            <div class="alert" role="alert" id="alert"></div>
            <div class="modal-footer">
                <button type="button" id="close-add" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
        </form>
      </div>
      
    </div>
  </div>
</div>

<div id="page-content-wrapper">
            <?php include "includes/navigation.php"?>
            <div class="alert" role="alert" id="success" style="width: 20rem;margin-left:19rem;"></div>
            <div class="container-sm shadow-lg p-3 mb-5 bg-white rounded">
                <div class="d-flex flex-row">
                    <button type="button"  class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#addApptModal">Add Appointment</button>
                    <select name="sort" id="sort" class="form-control select w-25 ">
                          <option value="">Sort By</option>
                          <option value="appointment.appodate">Date</option>
                          <option value="appointment.appotime">Time</option>
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
                        <th>Appointement Date</th>
                        <th>Appointment Time</th>
                        <th>Customer</th>
                        <th>Service</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody id="appointment_table"></tbody>
                </table>
            </div>          
</div>

<script>
    window.addEventListener('load',()=>{ 
        getAppointments(); // getappointments
        getServiceNameInfo(); // get service dropdown
        getCustomersInfo(); // get customer dropdown
    })

    const order = document.querySelector("#order"); // order dropdown option
    order.addEventListener('change',(e)=>{ // user selects and option (asc,des)
      getAppointments(); // invoke appointments to get appointments in such order
    })

    const sort = document.querySelector("#sort"); // sort dropdown 
    sort.addEventListener('change',(e)=>{ // user selects an option (e.g date)
      getAppointments(); // get appointments in that sort
    })

    const addForm = document.querySelector('#add_form');
    addForm.addEventListener('submit',(e)=>{ // add appointment form submitted
      e.preventDefault();
      addAppointment()
    })
    
    const editForm = document.querySelector('#edit_form');
    editForm.addEventListener('submit',(e)=>{ // edit form submitted
      e.preventDefault();
      editAppointment();
      
    })
    
</script>
<?php include "includes/footer.php"?>
