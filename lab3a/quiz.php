<?php

require "helpers.php";

// Redirect if the request method is not POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit();
}

// Collect user details
$complete_name = $_POST['complete_name'] ?? '';
$email = $_POST['email'] ?? '';
$birthdate = $_POST['birthdate'] ?? '';
$contact_number = $_POST['contact_number'] ?? '';
$agree = $_POST['agree'] ?? '';
$answers = $_POST['answers'] ?? [];

// Retrieve all questions
$questions = retrieve_questions()['questions'];

?>

<html>
<head>
    <meta charset="utf-8">
    <title>IPT10 Laboratory Activity #3A</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css" />
</head>
<body>
<section class="section">

    <!-- Form to handle quiz question submission -->
    <form method="POST" action="result.php">
        <input type="hidden" name="complete_name" value="<?php echo htmlspecialchars($complete_name); ?>" />
        <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>" />
        <input type="hidden" name="birthdate" value="<?php echo htmlspecialchars($birthdate); ?>" />
        <input type="hidden" name="contact_number" value="<?php echo htmlspecialchars($contact_number); ?>" />
        <input type="hidden" name="agree" value="<?php echo htmlspecialchars($agree); ?>" />

        <!-- Include answers array as hidden fields -->
        <?php foreach ($questions as $index => $question): ?>
            <input type="hidden" name="answers[<?php echo $index; ?>]" value="<?php echo htmlspecialchars($answers[$index] ?? ''); ?>" />
        <?php endforeach; ?>

        <!-- Display all questions and their options -->
        <?php foreach ($questions as $index => $question): ?>
            <div class="box">
                <?php if (!isset($question['question']) || !isset($question['options'])): ?>
                    <p>Question data is missing or malformed.</p>
                <?php else: ?>
                    <h2 class="subtitle">Question <?php echo $index + 1; ?></h2>
                    <p><?php echo htmlspecialchars($question['question']); ?></p>
                    <?php foreach ($question['options'] as $option): ?>
                        <div class="field">
                            <div class="control">
                                <label class="radio">
                                    <input type="radio" name="answers[<?php echo $index; ?>]" value="<?php echo htmlspecialchars($option['key']); ?>" <?php echo isset($answers[$index]) && $answers[$index] == $option['key'] ? 'checked' : ''; ?> />
                                    <?php echo htmlspecialchars($option['value']); ?>
                                </label>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>

        <!-- Submit button -->
        <button type="submit" class="button is-primary">Submit</button>
    </form>
</section>
</body>
</html>