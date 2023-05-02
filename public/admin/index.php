<?php require_once('../../private/initialize.php'); ?>
<?php require_once(PRIVATE_PATH . '/class/employee.class.php'); ?>
<?php require_once(PRIVATE_PATH . '/class/user.class.php'); ?>
<?php require_once(PRIVATE_PATH . '/class/client.class.php'); ?>
<?php require_once(PRIVATE_PATH . '/class/prepackagedevent.class.php'); ?>
<?php requireLogin() ?>
<?php include SHARED_PATH . '/admin_header.php' ?>
<?php
$employees = Employee::getAllEmployee();
$prepackaged_events = User::viewPrepackagedEvents();
?>
<div class="container">
    <?php include SHARED_PATH . '/admin_navigation.php' ?>
    <div class="main">
        <div class="top-bar">
            <div class="search">
                <i class="fas fa-user-tie"></i>
                <span><?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name'] ?></span>
            </div>
            <span class="role"> <?php echo $_SESSION['role'] ?></span>
            <div class="user">
                <img src="<?php echo urlFor('/images/default_avatar.jpg'); ?>" alt="Default Avatar">
            </div>
        </div>
        <div class="cards">
            <div class="card">
                <div class="card-content">
                    <div class="number"><?php echo Client::getTotalNumberOfClients()?></div>
                    <div class="card-name">Clients</div>
                </div>
                <div class="icon-box">
                    <i class="fas fa-user-check"></i>
                </div>
            </div>
            <div class="card">
                <div class="card-content">
                    <div class="number"><?php echo Employee::getTotalNumberOfEmployee()?></div>
                    <div class="card-name">Employees</div>
                </div>
                <div class="icon-box">
                    <i class="fas fa-user-tie"></i>
                </div>
            </div>
            <div class="card">
                <div class="card-content">
                    <div class="number">105</div>
                    <div class="card-name">Custom Events</div>
                </div>
                <div class="icon-box">
                    <i class="fas fa-glass-cheers"></i>
                </div>
            </div>
            <div class="card">
                <div class="card-content">
                    <div class="number"><?php echo PrepackagedEvent::getTotalNumberOfEvents()?></div>
                    <div class="card-name">Prepackaged Events</div>
                </div>
                <div class="icon-box">
                    <i class="fas fa-box-open"></i>
                </div>
            </div>
        </div>
        <div class="tables">
            <div class="list-prepackaged">
                <div class="heading">
                    <h2>Prepackaged Events</h2>
                    <a href="<?php echo urlFor('/admin/prepackage/prepackage_index.php')?>" class="btn">View all</a>
                </div>
                <table class="events">
                    <thead>
                    <td>Name</td>
                    <td>Location</td>
                    <td>Price</td>
                    </thead>
                    <tbody>
                    <?php foreach($prepackaged_events as $event) { ?>
                        <tr>
                            <td><?php echo $event->getName(); ?></td>
                            <td><?php echo $event->getLocation();?></td>
                            <td> &#163 <?php echo  $event->getPrice();?></td>
                        </tr>
                    <?php } ?>
                    </tbody>

                </table>
            </div>
            <div class="list-staff">
                <div class="heading">
                    <h2>Employees</h2>
                </div>
                <table class="staff">
                    <thead>
                    <td>Name</td>
                    <td>Role</td>
                    </thead>
                    <tbody>
                    <?php foreach($employees as $employee) { ?>
                    <tr>
                        <td><?php echo $employee->getFullName(); ?></td>
                        <td><?php echo strtolower($employee->role); ?></td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>
