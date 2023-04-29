<?php require_once('../../private/initialize.php'); ?>
<?php requireLogin() ?>
<?php include SHARED_PATH . '/client_header.php' ?>
<div class="container">
    <?php include SHARED_PATH . '/client_navigation.php' ?>
    <section class="main">
        <div class="main-top">
            <h1>Dashboard</h1>
            <span> <?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name'] ?>
                <i class="fas fa-user-cog"></i></span>

        </div>
        <div class="main-actions">
            <div class="card">
                <i class="fas fa-glass-cheers"></i>
                <h3>Manage Guests</h3>
                <p>Manage guest list for your events</p>
                <button>Manage Guest</button>
            </div>
            <div class="card">
                <i class="fas fa-box-open"></i>
                <h3>Pre-Packaged Events</h3>
                <p>Book our pre-packaged events</p>
                <button>Book Events</button>
            </div>
            <div class="card">
                <i class="fas fa-glass-cheers"></i>
                <h3>Custom Events</h3>
                <p>View details of your custom events</p>
                <button>View Details</button>
            </div>
            <div class="card">
                <i class="fas fa-user"></i>
                <h3>Manage Profile</h3>
                <p>Manage your profile</p>
                <button>Edit Profile</button>
            </div>
        </div>
        <section class="main-events">
            <h1>Events</h1>
            <div class="events-box">
                <div class="course">
                    <div class="box">
                        <h3>Movie Night</h3>
                        <p>$100</p>
                        <button>Book Event</button>
                        <i class="fas fa-box-open event"></i>
                    </div>
                    <div class="box">
                        <h3>Bowling Alley</h3>
                        <p>$150</p>
                        <button>Book Event</button>
                        <i class="fas fa-box-open event"></i>
                    </div>
                    <div class="box">
                        <h3>Car Race</h3>
                        <p>$250</p>
                        <button>Book Event</button>
                        <i class="fas fa-box-open event"></i>
                    </div>
                </div>
            </div>
        </section>
    </section>
</div>