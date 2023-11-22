<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <h2>Тухайн өрөөнд ямар ахуйн хэрэгсэл байгааг харах хуудас.</h2>

    <label>Хайх өрөөг сонгоно уу?</label> <br>
    <select id="roomlist">
        <option value="R01">Living Room</option>
        <option value="R02">Kitchen</option>
        <option value="R03">Bedroom 1</option>
        <option value="R04">Bedroom 2</option>
        <option value="R05">Bathroom 1</option>
        <option value="R06">Bathroom 2</option>
        <option value="R07">Dining Room</option>
        <option value="R08">Home Office</option>
        <option value="R09">Guest Room</option>
        <option value="R10">Laundry Room</option>
        <option value="R11">Hallway</option>
        <option value="R12">Basement</option>
    </select>
    <button onclick="activatephp()">Мэдээлэл харах</button>

    <div id="result"></div>

    <script>
        function activatephp() {
            var selectelement = document.getElementById("roomlist");
            var parametervalue = selectelement.value;

            fetch('clientdbsearch.php?parameter=' + parametervalue)
                .then(Response => Response.json())
                .then(data => {
                    display(data);
                })
                .catch(error => {
                    console.error(error);
                });
        }

        function display(data) {
            var selectelement = document.getElementById("roomlist");
            var parametervalue = selectelement.value;

            var divelement = document.getElementById("result");
            divelement.innerHTML = "";

            if (data.message) {
                divelement.innerHTML = "<p>Үр дүн олдсонгүй.</p>";
            } else {

                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        var a = 0
                        var records = JSON.parse(xhr.responseText);
                        records.forEach(function(record) {
                            if (a == 0) {
                                divelement.innerHTML = "<p>" + record.roomname + " өрөө нь " + record.area + " метр квадратын талбайтай өрөө байна. Үүнд:</p>";
                                a = a + 1;
                            }
                            divelement.innerHTML += "<p>" + record.size + " " + record.condition + " " + record.itemname + " нь " + record.quantity + " ширхэг байна. " + "</p>";
                        })
                    }
                }

                // var a = 0
                // data.forEach(record => {
                //     if (a == 0) {
                //         divelement.innerHTML = "<p>" + record.roomname + " өрөө нь " + record.area + " метр квадратын талбайтай өрөө байна. Үүнд:</p>";
                //         a = a + 1;
                //     }
                //     divelement.innerHTML += "<p>" + record.size + " " + record.condition + " " + record.itemname + " нь " + record.quantity + " ширхэг байна. " + "</p>";
                // });

                xhr.open('GET', 'clientdbsearch.php?parameter=' + parametervalue, true);
                xhr.send();
            }
        }
    </script>

</body>

</html>