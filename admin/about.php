<?php include "includes/header.php"?>
<!-- Sidebar -->
<?php include "includes/sidebar.php" ?>
<!-- /#sidebar-wrapper -->
<!-- page contents -->
<div id="page-content-wrapper">
    <?php include "includes/navigation.php"?>
    <div class="alert" role="alert" id="success" style="width: 20rem;margin-left:25rem;"></div>
    <div class="row my-4 shadow-lg p-4 mb-5 bg-white rounded" style="margin:0 auto;width:70rem;height:45rem;position:relative;">
        <div class="col " id="columnchart_material" style="width: 800px;">
        <div id="title" class="bg-secondary mb-6 p-2">
            <h2 >Update About Us Page</h2>
        </div>
            
            <form method="POST" enctype="multipart/form-data" >
                <div class="form-group mb-4 mt-5">
                    <label for="about_title">Page Title</label>
                    <input type="text" class="form-control" id="about_title" aria-describedby="AboutUs" placeholder="About Us" required>
                </div>
                <div class="form-group mb-4">
                    <label for="about_image">Page Image</label><br>
                    <div class="img mb-1">
                        <img id="view_img" src="" alt="" width="100px" height="100px">
                    </div>
                    <input type="file"  name="image" id="about_image" required>
                </div>
                <div class="form-group mb-4">
                    <label  for="description">Page Description</label>
                    <textarea name="about_description" id="description" cols="30" rows="10" class="form-control" placeholder="About Us Description" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>

</div>

<?php include "includes/footer.php"?>


<script>
window.addEventListener('load',() => { // document loaded
    getAboutInfo(); // invoke function
})

const imgInput = document.querySelector('#about_image'); // holds file element
  let imgName;
  imgInput.addEventListener('change',(e)=>{ // listener for file upload
      const path = e.target.value.split("\\"); // splits file path
      imgName = path[path.length-1] // get image name
})

document.querySelector('form').addEventListener('submit',(e)=>{ // form submitted
    e.preventDefault(); // prevent page refresh
    updateAboutInfo(); // invoke function
})
</script>
