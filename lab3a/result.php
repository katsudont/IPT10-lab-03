<?php

require "helpers.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit();
}

$complete_name = isset($_POST['complete_name']) ? htmlspecialchars(trim($_POST['complete_name'])) : '';
$email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : '';
$birthdate = isset($_POST['birthdate']) ? htmlspecialchars(trim($_POST['birthdate'])) : '';
$contact_number = isset($_POST['contact_number']) ? htmlspecialchars(trim($_POST['contact_number'])) : '';


$answers = $_POST['answers'] ?? [];

$score = compute_score($answers);

$questions = retrieve_questions();
$correct_answers = $questions['answers'] ?? [];

$date = new DateTime($birthdate);
$formatted_birthdate = $date->format('F d, Y');

$hero_class = $score > 2 ? 'is-success' : 'is-danger';

$show_confetti = $score === 5;

?>
<html>
<head>
    <meta charset="utf-8">
    <title>IPT10 Laboratory Activity #3A</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/confetti-js@0.0.18/site/site.min.css">
    <script src="https://cdn.jsdelivr.net/npm/confetti-js@0.0.18/dist/index.min.js"></script>
</head>
<body>
<section class="hero <?php echo $hero_class; ?>">
    <div class="hero-body">
        <p class="title">Your Score: <?php echo $score; ?></p>
        <p class="subtitle">This is the IPT10 PHP Quiz Web Application Laboratory Activity.</p>

    </div>
</section>
<section class="section">
    <div class="table-container">
        <table class="table is-bordered is-hoverable is-fullwidth">
            <tbody>
                <tr>
                    <th>Input Field</th>
                    <th>Value</th>
                </tr>
                <tr>
                    <td>Complete Name</td>
                    <td><?php echo $complete_name; ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?php echo $email; ?></td>
                </tr>
                <tr>
                    <td>Birthdate</td>
                    <td><?php echo $formatted_birthdate; ?></td>
                </tr>
                <tr>
                    <td>Contact Number</td>
                    <td><?php echo $contact_number; ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Additional table for questions and answers -->
    <div class="table-container">
        <table class="table is-bordered is-hoverable is-fullwidth">
            <thead>
                <tr>
                    <th>Question</th>
                    <th>Correct Answer</th>
                    <th>Your Answer</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                $letter_map = ['A', 'B', 'C', 'D', 'E']; // maps the index to the letter
                foreach ($questions['questions'] as $index => $question): 
                    // gets the correct index this is what i was displaying before
                    $correct_index = array_search($correct_answers[$index], array_column($question['options'], 'key'));
                    // gets the letter corresponding to the correct answer
                    $correct_letter = $letter_map[$correct_index];
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($question['question']); ?></td>
                    <td><?php echo htmlspecialchars($correct_letter); ?></td> 
                    <td><?php echo isset($answers[$index]) ? $letter_map[array_search($answers[$index], array_column($question['options'], 'key'))] : 'Not Answered'; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Confetti effect -->
    <?php if ($show_confetti): ?>
    <canvas id="confetti-canvas"></canvas>
    <script>
        var confettiSettings = {
            target: 'confetti-canvas'
        };
        var confetti = new ConfettiGenerator(confettiSettings);
        confetti.render();
    </script>
    <?php endif; ?>
</section>
</body>
</html>