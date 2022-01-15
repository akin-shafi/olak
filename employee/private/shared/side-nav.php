    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item nav-profile">
                <a href="#" class="nav-link">
                    <div class="profile-image">
                        <img class="img-xs rounded-circle" src="<?php echo url_for('assets/uploads/' . $user->photo); ?>" alt="profile image">
                        <div class="dot-indicator bg-success"></div>
                    </div>
                    <div class="text-wrapper">
                        <p class="profile-name"><?php echo ucwords($user->full_name()); ?></p>
                        <p class="designation"><?php echo strtoupper($designationName); ?></p>
                    </div>
                </a>
            </li>

            <li class="nav-item <?php echo $page == 'Dashboard' ? 'active' : '' ?>">
                <a class="nav-link py-4" href="<?php echo url_for('dashboard'); ?>">
                    <i class="icon-screen-desktop mr-4"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>

            <li class="nav-item <?php echo $page == 'Profile' ? 'active' : '' ?>">
                <a class="nav-link py-4" href="<?php echo url_for('profiles') ?>">
                    <i class="icon-user mr-4"></i>
                    <span class="menu-title">My Profile</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link py-4" href="#">
                    <i class="icon-credit-card mr-4"></i>
                    <span class="menu-title">Loan Status</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link py-4" href="#">
                    <i class="icon-calendar mr-4"></i>
                    <span class="menu-title">Attendance</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link py-4" href="#">
                    <i class="icon-home mr-4"></i>
                    <span class="menu-title">Leave Status</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link py-4" href="#">
                    <i class="icon-settings mr-4"></i>
                    <span class="menu-title">Settings</span>
                </a>
            </li>

            <div class="m-custom" style="margin-top: 5rem;"></div>
            <li class="nav-item">
                <a class="nav-link py-4" href="<?php echo url_for('logout.php') ?>">
                    <i class="icon-logout mr-4"></i>
                    <span class="menu-title">Logout</span>
                </a>
            </li>

        </ul>
    </nav>