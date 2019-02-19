<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 6/02/2019
 * Time: 9:26
 */

?>
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Blog</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <!-- users gedeelte -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-user"></i>
            <span>Users</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">

                <a class="collapse-item" href="./users.php">Create User</a>
                <a class="collapse-item" href="./users.php">Edit User</a>
                <a class="collapse-item" href="./users.php">Delete User</a>
            </div>
        </div>
    </li>

   <!-- upload gedeelte -->

    <li class="nav-item">
        <a class="nav-link" href="./upload.php">
        <i class="fas fa-upload"></i>
            <span>Upload</span></a>
    </li>
    <!-- photos gedeelte -->
    <li class="nav-item">
        <a class="nav-link" href="./photos.php">
            <i class="fas fa-camera-retro"></i>
            <span>Photos</span></a>
    </li>
    <!-- comments gedeelte -->
    <li class="nav-item">
        <a class="nav-link" href="./comments.php">
            <i class="fas fa-comment"></i>
            <span>Comments</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
