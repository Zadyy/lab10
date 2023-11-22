<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <h2>Look for data from the database</h2>

    <label>Хайх утыг оруулна уу?</label>
    <input type="character" id="parameterinput">
    <button onclick="activatephp()">Хайх</button>

    <script>
        function activatephp() {
            var parametervalue = document.getElementById("parameterinput").value

            fetch('searchdata.php?parameter=' + parametervalue)
            .then(Response => Response.json())
            .then(data => {
                displayResult(data);
            })
            .catch(error => {
                console.error(error);
            });
        }



    </script>

</body>