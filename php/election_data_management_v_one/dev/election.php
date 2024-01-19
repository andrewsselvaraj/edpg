<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>State Selector</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>

    <label for="country">Select Country:</label>
    <select id="country" name="country" onchange="getStates()">
        <!-- Populate this with your country options -->
        <option value="usa">USA</option>
        <option value="canada">Canada</option>
        <!-- Add more countries as needed -->
    </select>

    <br>

    <label for="state">Select State:</label>
    <select id="state" name="state">
        <!-- States will be populated dynamically using Ajax -->
    </select>

    <script>
        function getStates() {
            var country = $("#country").val();

            $.ajax({
                type: "POST",
                url: "data.php",
                data: { country: country },
                success: function(response) {
                    $("#state").html(response);
                }
            });
        }
    </script>

</body>
</html>
