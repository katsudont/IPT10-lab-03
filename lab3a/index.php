<html>
<head>
    <meta charset="utf-8">
    <title>IPT10 Laboratory Activity #3A</title>
    <!-- Add the Bulma CSS here -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">

    <script>
        function checkInputs() {
            var name = document.getElementById('complete_name').value;
            var email = document.getElementById('email').value;
            var submitButton = document.getElementById('submitButton');
            
            function isValidEmail(email){
                return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
            }
            if (name === "" || !isValidEmail(email)) {
                submitButton.disabled = true;
            } else {

                submitButton.disabled = false;
            }
        }

       window.onload = function(){
            var nameInput = document.querySelector('input[name="complete_name"]');
            var emailInput = document.querySelector('input[name="email"]');

            nameInput.addEventListener('input', checkInputs);
            emailInput.addEventListener('input', checkInputs);
        }
    </script>
    
</head>
<body>
<section class="section">
    <h1 class="title">User Registration</h1>
    <h2 class="subtitle">
        This is the IPT10 PHP Quiz Web Application Laboratory Activity. Please register
    </h2>
    <!-- Supply the correct HTTP method and target form handler resource -->
    <form method="POST" action="instructions.php">
        <div class="field">
            <label class="label">Name</label>
            <div class="control">
                <input class="input" type="text" name="complete_name" id="complete_name" onchange="checkInputs()" placeholder="Complete Name">
            </div>
        </div>

        <div class="field">
            <label class="label">Email</label>
            <div class="control">
                <input class="input" name="email" id="email" onchange="checkInputs()" type="email" />
            </div>
        </div>

        <div class="field">
            <label class="label">Birthdate</label>
            <div class="control">
                <input class="input" name="birthdate" type="date" />
            </div>
        </div>

        <div class="field">
            <label class="label">Contact Number</label>
            <div class="control">
                <input class="input" name="contact_number" type="number" />
            </div>
        </div>

        <!-- Next button -->
        <button type="submit" class="button is-link" name="submitButton" id="submitButton" disabled>Proceed Next</button>
    </form>
</section>

</body>
</html>