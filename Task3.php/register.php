
<?php
session_start();
$name = "";
$email = "";
$mobile = "";
$governorate = "";
$track = $_COOKIE["savedTrack"] ?? "";
$skills = [];
$message = "";

$errors = 0;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $mobile = trim($_POST["mobile"] ?? "");
    $governorate = trim($_POST["governorate"] ?? "");
    $track = trim($_POST["track"] ?? "");
    $message = trim($_POST["message"] ?? "");
    $skills = $_POST["skills"] ?? [];

    if (!is_array($skills)) {
        $skills = [];
    }

    $skills = array_map(
        fn($skill) => is_string($skill) ? trim($skill) : "",
        $skills
    );

    if ($name === "") {
       echo "Name is required.";
       $errors++;
    }
    if ($email === "") {
        $errors["email"] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Please enter a valid email.";
    }

    if ($mobile === "") {
        $errors["mobile"] = "Mobile number is required.";
    } elseif (!preg_match("/^07[789][0-9]{7}$/", $mobile)) {
        echo "Enter a valid Jordanian mobile number, e.g. 0791234567.";
        $errors++;
    }

    $allowedGovernorates = ["Amman", "Irbid", "Aqaba", "Zarqa"];

    if (!in_array($governorate, $allowedGovernorates, true)) {
        echo  "Please choose a governorate.";
        $errors++;
    }


    $allowedTracks = ["Full Stack", "Frontend", "Backend"];

    if (!in_array($track, $allowedTracks, true)) {
        echo "Please choose a training track.";
        $errors++;
        
    }
    $allowedSkills = ["HTML", "CSS", "JavaScript"];

    $skills = array_values(array_intersect($skills, $allowedSkills));

    if (count($skills) === 0) {
        echo "Choose at least one skill.";
        $errors++;
    }

    if (!isset($_POST["agree"])) {
       echo "You must accept the terms.";
       $errors++;
    }
    if ($errors == 0) {

        $user = new stdClass();

        $user->name = $name;
        $user->email = $email;
        $user->mobile = $mobile;
        $user->governorate = $governorate;
        $user->track = $track;
        $user->skills = $skills;
        $user->message = $message;

        $_SESSION["registeredUser"] = $user;

        setcookie(
            "savedTrack",
            $track,
            time() + (7 * 24 * 60 * 60),
            "/"
        );
        header("Location: profile.php");
        exit;
    }
}
function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, "UTF-8");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <h1>Student Registration</h1>

    <form action="register.php" method="post">

        <div class="field">
            <label for="name">Full Name:</label>
            <input
                type="text"
                id="name"
                name="name"
                value="<?= e($name) ?>"
            >
            <span class="error"><?= e($errors["name"] ?? "") ?></span>
        </div>
        <div class="field">
            <label for="email">Email:</label>
            <input
                type="email"
                id="email"
                name="email"
                value="<?= e($email) ?>"
            >
            <span class="error"><?= e($errors["email"] ?? "") ?></span>
        </div>

        <div class="field">
            <label for="mobile">Mobile:</label>
            <input
                type="tel"
                id="mobile"
                name="mobile"
                placeholder="0791234567"
                value="<?= e($mobile) ?>"
            >
            <span class="error"><?= e($errors["mobile"] ?? "") ?></span>
        </div>
        <div class="field">
            <label for="governorate">Governorate:</label>

            <select id="governorate" name="governorate">
                <option value="">Choose a governorate</option>

                <?php
                $governorates = ["Amman", "Irbid", "Aqaba", "Zarqa"];

                foreach ($governorates as $gov) {
                    $selected = ($governorate === $gov) ? "selected" : "";
                    echo "<option value='" . e($gov) . "' $selected>"
                        . e($gov) . "</option>";
                }
                ?>
            </select>

            <span class="error"><?= e($errors["governorate"] ?? "") ?></span>
        </div>
        <fieldset class="field">
            <legend>Training Track:</legend>

            <?php
            $tracks = ["Full Stack", "Frontend", "Backend"];

            foreach ($tracks as $item) {
                $checked = ($track === $item) ? "checked" : "";

                echo "<label>";
                echo "<input type='radio' name='track' value='" . e($item)
                    . "' $checked>";
                echo e($item);
                echo "</label> ";
            }
            ?>

            <span class="error"><?= e($errors["track"] ?? "") ?></span>
        </fieldset>
        <fieldset class="field">
            <legend>Skills:</legend>

            <?php
            $availableSkills = ["HTML", "CSS", "JavaScript"];

            foreach ($availableSkills as $skill) {
                $checked = in_array($skill, $skills, true) ? "checked" : "";

                echo "<label>";
                echo "<input type='checkbox' name='skills[]' value='"
                    . e($skill) . "' $checked>";
                echo e($skill);
                echo "</label> ";
            }
            ?>

            <span class="error"><?= e($errors["skills"] ?? "") ?></span>
        </fieldset>
        <div class="field">
            <label for="message">Message (optional):</label>
            <textarea id="message" name="message" rows="4"><?= e($message) ?></textarea>
        </div>

        <div class="field">
            <label>
                <input
                    type="checkbox"
                    name="agree"
                    value="yes"
                    <?= isset($_POST["agree"]) ? "checked" : "" ?>
                >
                I accept the terms and conditions.
            </label>

            <span class="error"><?= e($errors["agree"] ?? "") ?></span>
        </div>

        <button type="submit">Register</button>

    </form>

</body>
</html>