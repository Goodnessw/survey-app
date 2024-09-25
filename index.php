<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Goodnessw Survey</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="logo.jpg" type="image/x-icon">
    <style>
        .error-message {
            color: red;
            font-size: 14px;
            display: none;
            margin-top: 5px;
        }
    </style>
</head>
<body>

   
    
    <form action="survey_query.php" method="POST" id="form" onsubmit="return validateForm()">
    <h1>Goodnessw Survey Form</h1>

<?php if(isset($_SESSION['message'])): ?>
    <div class="alert alert-<?php echo $_SESSION['message']['alert'] ?> msg">
        <?php echo $_SESSION['message']['text'] ?>
    </div>
    <script>
        (function() {
            setTimeout(function(){
                document.querySelector('.msg').remove();
            }, 3000)
        })();
    </script>
<?php endif; ?>
        <div class="form-control">
            <label for="name" id="label-name">Name</label>
            <input type="text" id="name" placeholder="Enter your name" name="full_name" required />
        </div>

        <div class="form-control">
            <label for="email" id="label-email">Email</label>
            <input type="email" id="email" placeholder="Enter your email" name="email" required />
        </div>

        <div class="form-control">
            <label for="age" id="label-age">Birth Year</label>
            <select name="age" id="age">
                <?php 
                    $currentYear = date('Y');
                    foreach (range($currentYear, 1700) as $option) {
                        echo "<option>" . $option . "</option>";
                    }
                ?>
            </select>
        </div>

        <div class="form-control">
            <label for="role" id="label-role">Which option best describes you?</label>
            <?php
                $html = '<select name="option">';
                $opts = array('student', 'intern', 'professional', 'others');
                foreach($opts as $option) {
                    $html .= '<option value="' . $option . '">' . ucfirst($option) . '</option>';
                }
                $html .= '</select>';
                print $html;
            ?>
        </div>

        <div class="form-control">
            <label>Would you recommend Goodnessw to a friend?</label>
            <label for="recommend-1">
                <input type="radio" id="recommend-1" name="recommend" value="Yes" required> Yes
            </label>
            <label for="recommend-2">
                <input type="radio" id="recommend-2" name="recommend" value="No" required> No
            </label>
            <label for="recommend-3">
                <input type="radio" id="recommend-3" name="recommend" value="Maybe" required> Maybe
            </label>
        </div>

        <div class="form-control" id="languages-section">
            <label>Languages and Frameworks known <small>(Check all that apply)</small></label>

            <label for="language-1">
                <input type="checkbox" name="language[]" value="C"> C
            </label>
            <label for="language-2">
                <input type="checkbox" name="language[]" value="C++"> C++
            </label>
            <label for="language-3">
                <input type="checkbox" name="language[]" value="C#"> C#
            </label>
            <label for="language-4">
                <input type="checkbox" name="language[]" value="Java"> Java
            </label>
            <label for="language-5">
                <input type="checkbox" name="language[]" value="Python"> Python
            </label>
            <label for="language-6">
                <input type="checkbox" name="language[]" value="JavaScript"> JavaScript
            </label>

            <label for="language-other">
                <input type="checkbox" id="language-other" onclick="toggleOtherLanguage()"> Other
            </label>

            <div id="other-language-container" style="display: none;">
                <label for="other-language">Please specify:</label>
                <input type="text" id="other-language" placeholder="Enter other language">
            </div>
            <div class="error-message" id="language-error">Please select at least one language.</div>
        </div>

        <div class="form-control">
            <label for="comment" id="label-comment">Any Comments or Suggestions</label>
            <textarea name="comment" placeholder="Enter Your Comment Here:" style="width: 450px; height: 80px;"></textarea>
        </div>

        <button type="submit" name="submit">Submit</button>
    </form>

    <script>
        function toggleOtherLanguage() {
            const otherLanguageContainer = document.getElementById('other-language-container');
            const otherLanguageCheckbox = document.getElementById('language-other');

            if (otherLanguageCheckbox.checked) {
                otherLanguageContainer.style.display = 'block';
            } else {
                otherLanguageContainer.style.display = 'none';
                document.getElementById('other-language').value = '';  // Clear input if unchecked
            }
        }

        function validateForm() {
            const languageCheckboxes = document.querySelectorAll('input[name="language[]"]:checked');
            const otherLanguage = document.getElementById('other-language').value.trim();
            const otherLanguageCheckbox = document.getElementById('language-other');
            const errorMessage = document.getElementById('language-error');

            // Check if no languages are selected
            if (languageCheckboxes.length === 0 && otherLanguage === "") {
                errorMessage.style.display = 'block';
                return false;
            }

            // Hide error if there's a valid selection
            errorMessage.style.display = 'none';

            // If "Other" is checked but no value entered, stop form submission
            if (otherLanguageCheckbox.checked && otherLanguage === "") {
                errorMessage.innerText = "Please specify the 'Other' language.";
                errorMessage.style.display = 'block';
                return false;
            }

            // Add other language to form data if entered
            if (otherLanguageCheckbox.checked && otherLanguage !== "") {
                const newInput = document.createElement('input');
                newInput.type = 'hidden';
                newInput.name = 'language[]';
                newInput.value = otherLanguage;
                document.getElementById('form').appendChild(newInput);
            }

            return true;
        }
    </script>
</body>
</html>
