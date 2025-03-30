<!--Uwaga! Wygląd strony został wygenerowany CZĘŚCIOWO przez AI, niektóre rzeczy poprawiłem samodzielnie, gdyż wyglądały średnio
 -->


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Reservation Demo</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css"
        rel="stylesheet">
</head>

<body class="bg-light py-5">

    <div class="container">
        <h2 class="text-center mb-4">Rezerwacja pokoju hotelowego</h2>

        <form action="hotel_post.php" method="post" class="bg-white p-4 rounded shadow-sm">
            <!-- Ilość osób -->
            <div class="form-group">
                <label for="people-count">Ilość osób</label>
                <input type="number" name="people-count" id="people-count" class="form-control" min="1" max="4"
                    required>
            </div>

            <div id="people-details"></div> <!--Javascript will generate fields there depending on people-count-->

            <!-- Dane osoby rezerwującej -->
            <fieldset class="border p-3 mb-4">
                <legend class="w-auto">Dane osoby rezerwującej</legend>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="name">Imię</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="surname">Nazwisko</label>
                        <input type="text" name="surname" id="surname" class="form-control" required>
                    </div>
                </div>

                <!-- Adres -->
                <fieldset class="border p-3 mb-4">
                    <legend class="w-auto">Adres</legend>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="address-city">Miasto</label>
                            <input type="text" name="address-city" id="address-city" class="form-control" required>
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="address-province">Województwo</label>
                            <input type="text" name="address-province" id="address-province" class="form-control"
                                required>
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="address-address">Ulica, numer domu</label>
                            <input type="text" name="address-address" id="address-address" class="form-control"
                                required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address-postal-code">Kod pocztowy</label>
                        <input type="text" pattern="^\d{2}-\d{3}$" name="address-postal-code" id="address-postal-code"
                            class="form-control" placeholder="12-345" required>
                    </div>
                </fieldset>

                <!-- Numer karty -->
                <div class="form-group">
                    <label for="credit-card">Numer karty</label>
                    <input type="text" pattern="^(\d{4}[-\s]?){3}\d{4}$" name="credit-card" id="credit-card"
                        class="form-control" placeholder="1234-5678-9012-3456" required>
                </div>
            </fieldset>

            <!-- Dodatkowe -->
            <fieldset class="border p-3">
                <legend class="w-auto">Dodatkowe</legend>

                <div class="form-check">
                    <input type="checkbox" name="child-bed" id="child-bed" class="form-check-input">
                    <label for="child-bed" class="form-check-label">Łóżko dla dziecka</label>
                </div>

                <div class="form-group mt-2">
                    <label for="addons">Udogodnienia</label>
                    <select name="addons[]" id="addons" class="form-control selectpicker" multiple>
                        <!--addons must have [], otherwise it will not be treated as array-->
                        <option value="ashtray">Popielniczka</option>
                        <option value="air-conditioning">Klimatyzacja</option>
                        <option value="wifi">Wi-Fi</option>
                        <option value="pool">Basen</option>
                    </select>
                </div>
            </fieldset>

            <!-- Buttons -->
            <div class="container mt-2">
                <div class="row">
                    <div class="col-6 mb-2">
                        <button type="submit" class="btn btn-primary w-100">Zarezerwuj</button>
                    </div>
                    <div class="col-6 mb-2">
                        <button class="btn btn-primary w-100" id="btn-show-data">Wyświetl Dane</button>
                    </div>
                </div>
            </div>

        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha256-CjSoeELFOcH0/uxWu6mC/Vlrc1AARqbm/jiiImDGV3s=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

    <script>

        //show data button listener
        $("#btn-show-data").on('click', function() {
            window.location.href = "hotel_show_data.php";
        });

        // Initialize Bootstrap-Select
        $(document).ready(function () {
            $('.selectpicker').selectpicker();
        });

        $("#people-count").on("input", function () {
            let peopleCount = parseInt(this.value) || 0;
            let peopleDetailsContainer = $("#people-details");
            peopleDetailsContainer.empty(); // Clear the previous fields

            // Loop through the number of people and create input fields for each person
            for (let i = 1; i <= peopleCount; i++) {
                // Create a div for each person
                let container = $("<fieldset>").addClass("border p-3 mb-4")
                    .append($("<legend>").text("Osoba " + i));
                let personDiv = $("<div>").addClass("form-group row");

                // Create a label and input for name
                let nameContainer = $("<div class='col-md-6'>");
                let nameLabel = $("<label>").attr("for", "person-name-" + i).text("Imię");
                let nameInput = $("<input>").attr({
                    "type": "text",
                    "class": "form-control",
                    "name": "people-names[]",
                    "required": true
                });

                // Create a label and input for surname
                let surnameContainer = $("<div class='col-md-6'>");
                let surnameLabel = $("<label>").attr("for", "person-surname-" + i).text("Nazwisko");
                let surnameInput = $("<input>").attr({
                    "type": "text",
                    "class": "form-control",
                    "name": "people-surnames[]",
                    "required": true
                });

                nameContainer.append(nameLabel, nameInput);
                surnameContainer.append(surnameLabel, surnameInput);
                // Append the labels and inputs to the person div
                personDiv.append(nameContainer, surnameContainer);
                container.append(personDiv);

                // Append the person div to the people details container
                peopleDetailsContainer.append(container);
            }
        });


    </script>
</body>

</html>