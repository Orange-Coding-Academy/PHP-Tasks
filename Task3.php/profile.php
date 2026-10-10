
<?php
session_start();
$user = $_SESSION["registeredUser"] ?? null;

$savedTrack = $_COOKIE["savedTrack"] ?? "";

function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, "UTF-8");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <link rel="stylesheet" href="style.css">

    <style>
        .profile {
            max-width: 600px;
            margin: 30px auto;
            padding: 25px;
            border: 1px solid #ddd;
            border-radius: 10px;
        }

        .profile p {
            margin: 12px 0;
        }

        .profile a {
            display: inline-block;
            margin-top: 15px;
        }
    </style>
</head>

<body>

    <div class="profile">
        <h1>Student Profile</h1>

        <?php if ($user !== null): ?>

            <p><strong>Full Name:</strong> <?= e($user->name) ?></p>

            <p><strong>Email:</strong> <?= e($user->email) ?></p>

            <p><strong>Mobile:</strong> <?= e($user->mobile) ?></p>

            <p><strong>Governorate:</strong> <?= e($user->governorate) ?></p>

            <p><strong>Training Track:</strong> <?= e($user->track) ?></p>

            <p><strong>Skills:</strong>
                <?= e(implode(", ", $user->skills)) ?>
            </p>

            <p><strong>Message:</strong>
                <?= e($user->message !== "" ? $user->message : "No message") ?>
            </p>

        <?php else: ?>

            <p>No registration information is available in this session.</p>

        <?php endif; ?>

        <hr>

        <h2>Saved Preference</h2>

        <?php if ($savedTrack !== ""): ?>
            <p>
                <strong>Training track saved in cookie:</strong>
                <?= e($savedTrack) ?>
            </p>
        <?php else: ?>
            <p>No saved training track cookie was found.</p>
        <?php endif; ?>

        <a href="register.php">Back to Registration</a>
    </div>

</body>
</html>