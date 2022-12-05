 <!-- navigation bar to be included in every admin page, changes need to be made here only  -->
 
 <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0 text-white">Dashboard</h2>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse p-4" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown mr-2">
                            <a class="nav-link dropdown-toggle second-text fw-bold text-white" href="#" id="notificationDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-bell">
                                <span class="badge badge-danger" id="notification">0</span>
                                </i>
                            </a>
                            <ul class="dropdown-menu" id="drop-menu" aria-labelledby="notificatinDropdown">
                                <li><a class="dropdown-item"  href="#" id="notification-msg"></a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle second-text fw-bold text-white" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <!-- here displays the username from the session -->
                                <i class="fas fa-user me-2 text-white"></i><?php echo $_SESSION['admin']?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#" onclick="logout()">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>


<script>
    window.addEventListener('load',()=>{ // window loaded
        getNotificationCount(); // invokes function to get the count of appointments that are not read
    });
    const msg = document.querySelector('#notification-msg');
    msg.addEventListener('click',()=>{ // listerner for a click on notifications
        if(msg != 'no new appointments'){ // if we have new appointmens notification
            updateAppointmentRead(); // update the notification count
        }
    })
</script>