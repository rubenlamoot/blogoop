<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 6/02/2019
 * Time: 9:30
 */

?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-3 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Blogpost</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php
//                                $blogs = Photo::find_all();
//                                echo count($blogs);
                               echo Photo::count_all();
                                ?>

                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-blog fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-3 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Comments</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php
//                                    $comments = Comment::find_all();
//                                    echo count($comments);
                                 echo Comment::count_all();
                                ?>

                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comment fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-3 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Users</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                        <?php
                                        echo User::count_all();
                                        ?>
                                    </div>
                                </div>
<!--                                <div class="col">-->
<!--                                    <div class="progress progress-sm mr-2">-->
<!--                                        <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>-->
<!--                                    </div>-->
<!--                                </div>-->
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-3 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Views</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                        <?php
                                        echo $session->count;
                                        ?>
                                    </div>
                                </div>
                                <!--                                <div class="col">-->
                                <!--                                    <div class="progress progress-sm mr-2">-->
                                <!--                                        <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>-->
                                <!--                                    </div>-->
                                <!--                                </div>-->
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-12">
                <div id="piechart" style="width: 900px; height: 500px">

                </div>
            </div>

            <div>
                <?= $session->count; ?>
            </div>
        </div>



        <!-- Pending Requests Card Example -->

    </div>

    <!-- Content Row -->
<!--    <div class="row">-->
<!--        <div class="col-12">-->
<!--            <h1 class="page-header">-->
<!--                Titel <small>Photo onderdeel</small>-->
<!--            </h1>-->
            <?php
    //            echo "Ophalen van 1 user" ."<br>";
            ////            $sql = "SELECT * FROM users WHERE id=1";
            ////            $resultaat = $database->query($sql);
            ////            /** mysqli_fetch_array = resultaat in een array weer te geven */
            ////            $user_found = mysqli_fetch_array($resultaat); /** is object-varaibele van 1 record */
            ////            echo $user_found["username"]. "<br>";
            ////            echo $user_found["last_name"];
            ///
//            $user = new User();
//            $resultaat = $user->find_all_users();
//            while($row = mysqli_fetch_array($resultaat)){
//                echo $row["id"] .'-'. $row['username'] . '<br><hr>';
//            }
           /** statische manier (Laravel) -> geen user meer declareren, dus lijn 1 en 2 in 1*/
//            $resultaat = User::find_all_users();
//            while($row = mysqli_fetch_array($resultaat)){
//                echo $row["id"] .'-'. $row['username'] . '<br><hr>';
//            }
//
//            $user2 = new User();
//            $resultaat = $user2->find_user(2);
//            $user_found = mysqli_fetch_array($resultaat);
//            echo 'user met id 2 zoeken = ' .$user_found["id"] .'-'. $user_found['first_name'] .' '. $user_found['last_name'] .'<br>';
//
            /** deels oblect, deels procedureel */
//            $found_user = User::find_user(2);
//            $user_found = mysqli_fetch_array($found_user);
//            echo $user_found['username'];

//            echo $found_user['username'];
//            $user = new User();
//            $user->username;

            /** volledig object georienteerd */
//            $found_user = User::find_user(2);
////            $teVullenUser = new User();
////            $teVullenUser->id = $found_user['id'];
////            $teVullenUser->username = $found_user['username'];
////            $teVullenUser->password = $found_user['password'];
////            $teVullenUser->first_name = $found_user['first_name'];
////            $teVullenUser->last_name = $found_user['last_name'];
//
////            $teVullenUser = User::instantie($found_user);
////            echo $teVullenUser->password .'<br>';
////            echo $teVullenUser->username .'<br>';
//
//            echo $found_user->password .'<br>';
//            echo $found_user->username .'<br>';
//
//            /** volledig oop met find_all_users */
//            $users = User::find_all_users();
//            foreach ($users as $user) {
//                echo $user->username. '<br>';
//           }
//
//            ?>
<!--            <h2>Create user</h2>-->
<!--            --><?php
//            $user = new User();
//            $user->username = 'Neville';
//////            $hash = md5('vijf'); /** hashing van het paswoord toegekend aan de variabele hash*/
//            $user->password = 'zeven';
//            $user->first_name = 'Neville';
//            $user->last_name = 'Verleye';
////
////            $user->create();
//
//              $user->save();
//             ?>
<!--            <h2>Update user</h2>-->
<!--            --><?php
//                $user = User::find_user(1);
//                $user->last_name = "Piraat2";
//                $user->first_name = "Piet";
////                $user->update();
//                $user->save();
//            ?>
<!---->
<!--            <h2>Delete user</h2>-->
<!--            --><?php
//                $user = User::find_user(10);
////                $user->delete();
////            ?>
<!--            <div class="row">-->
<!--                <div class="col-12">-->
<!--                    <h1 class="page-header text-center">-->
<!--                        Titel<small> Photo onderdeel</small>-->
<!--                    </h1>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="row">-->
<!--                 <div class="col-6">-->
<!--                            --><?php
//                            $photos = Photo::find_all();
//                            foreach ($photos as $photo) { ?>
<!--                                <h2>--><?php //echo $photo->title; ?><!--</h2>-->
<!--                            --><?php //} ?>
<!--                 </div>-->
<!--                 <div class="col-6">-->
<!--                            <h2>Image</h2>-->
<!--                            --><?php
////                            $photo = new Photo();
////                            $photo->title = "Sam";
////                            $photo->description = "Lorem ipsum Sam";
////                            $photo->size = 15;
//
////                            $photo->save();
//
//                            echo INCLUDES_PATH;
//                            ?>
<!--                 </div>-->
<!--            </div>-->



        </div>
    </div>


</div>

