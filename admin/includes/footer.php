<!-- this is footer which is included in each page, hence secluded in the includes folder (so when making changes, changes made here will appear in every page) -->
</div>
    <!-- /#page-content-wrapper -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // this is for the burger menu 
        // when the burger menu is toggled it either appears with the navigation or disappears
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
    </script>
</body>

</html>