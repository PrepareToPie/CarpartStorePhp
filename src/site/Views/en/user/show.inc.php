<?php
// Get age from birth date
// It is job of view to show info the right way
//$birthday = new DateTimeImmutable();
//$birthday = $birthday->setTimestamp($data['profile']['birthday']);
//$age = $birthday->diff(new DateTime('NOW'))->format('%y');

// Get avatar: user's or default
$avatar = empty($data['profile']['avatar']) ? '/image/def-avatar.jpg' : $data['profile']['avatar'];
$is_owner = (!empty($user) && $user[0]['id'] === $data['profile'][0]['id']);
?>
<!-- Profile Page -->
<div class="profile-box">

    <!-- Main User Info -->
    <div class="profile-header container">
        <div class="col-lg-7 profile-info">
            <div class="list-group">
                <h2 class="list-group-item">
                    Username: <?php echo $data['profile'][0]['username']; ?>
                    <?php echo($is_owner ? '<sup class="text-primary">me</sup>' : '') ?>
                </h2>
                <h2 class="list-group-item">Email:
                    <?php echo $data['profile'][0]['email']; ?></h2>
                <h2 class="list-group-item">
                    Country:
                    <?php echo $data['profile'][0]['country']; ?>
                </h2>
                <h2 class="list-group-item">
                    Gender:
                    <?php echo $data['profile'][0]['gender']; ?>
                </h2>
                <h2 class="list-group-item">About:
                    "<?php echo $data['profile'][0]['about']; ?>"</h2>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="profile-avatar pull-right<?php echo($is_owner ? ' owner' : ''); ?>">
                <img src="<?php echo $avatar; ?>" alt="Avatar">
            </div>
        </div>
        <div class="clear"></div>
    </div>

    <!-- User's Name -->

    <!-- Other stuff -->
    <div class="profile-body">

        <!-- Gallery -->
        <div class="profile-gallery">
            <div class="row">

                <?php
                for ($i = 0; $i < 5; $i++) {
                    ?>
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <img src="/img/def-gallery-pic.jpg" alt="Gallery Pic">
                            <div class="caption">
                                <h3>Gallery Pic</h3>
                                <p>
                                    <a href="#" class="btn btn-primary" role="button" title="Vote Up"><span
                                                class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span></a>
                                    <a href="#" class="btn btn-primary" role="button" title="Vote Down"><span
                                                class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span></a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>

            </div>
        </div>

    </div>

</div>