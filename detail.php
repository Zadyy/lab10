<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <h2>Look for data from the database</h2>

    <label>Хайх утыг оруулна уу?</label> <br>
    <label>Жишээлбэл: HI001-HI050, R01-R10</label> <br>
    <input type="character" id="parameterinput">
    <button onclick="activatephp()">Хайх</button>

    <div id="result"></div>

    <script>
        function activatephp() {
            var parametervalue = document.getElementById("parameterinput").value

            fetch('searchdata.php?parameter=' + parametervalue)
            .then(Response => Response.json())
            .then(data => {
                display(data);
            })
            .catch(error => {
                console.error(error);
            });
        }

        function display(data) {
            var divelement = document.getElementById("result");
            divelement.innerHTML = "";

            if (data.message) {
                divelement.innerHTML = "<p>Үр дүн олдсонгүй.</p>";
            } else {
                data.forEach(record => {
                    divelement.innerHTML += "<p>" + record.roomno + " нэртэй өрөөнд " + record.condition + " " + record.itemno + " " + record.quantity + " ширхэг байна. "  + "</p>";
                });
            }
        }

    </script>

</body>
</html>