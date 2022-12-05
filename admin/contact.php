<?php include "includes/header.php"?>
<!-- Sidebar -->
<?php include "includes/sidebar.php" ?>
<!-- /#sidebar-wrapper -->
<!-- page contents -->
<div id="page-content-wrapper">
    <?php include "includes/navigation.php"?>
    <div class="alert" role="alert" id="success" style="width: 20rem;margin-left:25rem;"></div>
    <div class="row my-4 shadow-lg p-4 mb-5 bg-white rounded" style="margin:0 auto;width:70rem;height:30rem;position:relative;">
        <div class="col " id="columnchart_material" style="width: 800px;">
        <div id="title" class="bg-secondary mb-6 p-2">
            <h2 >Contact Info</h2>
        </div>
            
            <form>
                <div class="form-group mb-4 mt-5">
                    <label for="about_title">Address</label>
                    <input type="text" class="form-control" id="street" aria-describedby="Contact" placeholder="Street" required>
                </div>
                <div class="form-group mb-4">
                    <label for="phone">Phone Number</label>
                    <input type="text" class="form-control"  name="phone" id="phone" placeholder="Mobile Number" required>
                </div>
                <div class="form-group mb-4">
                    <label  for="email">Contact E-mail</label>
                    <input name="email" id="email" class="form-control" placeholder="E-mail Address" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>

</div>

<?php include "includes/footer.php"?>


<script>
window.addEventListener('load',() => { // document ready
    getContactInfo();
})
document.querySelector('form').addEventListener('submit',(e)=>{ // edit form submitted
    e.preventDefault();
    updateContactInfo();
})

</script>
