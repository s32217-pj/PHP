 <?php
    include_once "login_utils.php";
    require_login();

    //return string value of cookie or decoded json map
    function getCookieValue($name) {
        if (isset($_COOKIE[$name])) {
            $value = $_COOKIE[$name];
            if (strpos($value, "[") !== false || strpos($value, "{") !== false) {
                $decoded = json_decode($value, true);

                //change to map, we need to know which addon was selected
                if ($name == 'addons' && is_array($decoded)) {

                    foreach ($decoded as $key => $val) {
                        if (is_numeric($key)) $result[$val] = true;
                        else                  $result[$key] = true;
                    }
                    return $result;
                }

                return $decoded; //is not array
            }

            return $value;
        }
        return '';
    }
?>


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
<body class="bg-light pb-5">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
        <div class="container">
            <span class="navbar-text text-white mr-auto">
                <strong>Admin</strong>
            </span>
            <a href="logout.php" class="btn btn-outline-light">Wyloguj</a>
        </div>
    </nav>

    <div class="container">
        <h2 class="text-center mb-4">Rezerwacja pokoju hotelowego</h2>

        <form action="hotel_post.php" method="post" class="bg-white p-4 rounded shadow-sm">
            <!-- Ilość osób -->
            <div class="form-group">
                <label for="people-count">Ilość osób</label>
                <input type="number" name="people-count" id="people-count" class="form-control" min="1" max="4" <?php if(getCookieValue('people-count')) echo 'value='.getCookieValue('people-count'); ?>
                    required>
            </div>

            <div id="people-details"></div> <!--Javascript will generate fields there depending on people-count-->

            <!-- Dane osoby rezerwującej -->
            <fieldset class="border p-3 mb-4">
                <legend class="w-auto">Dane osoby rezerwującej</legend>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="name">Imię</label>
                        <input type="text" name="name" id="name" class="form-control" 
                        value="<?php if(getCookieValue('name')) echo getCookieValue('name') ?>"
                        required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="surname">Nazwisko</label>
                        <input type="text" name="surname" id="surname" class="form-control" 
                        value="<?php if(getCookieValue('surname')) echo getCookieValue('surname') ?>"
                        required>
                    </div>
                </div>

                <!-- Adres -->
                <fieldset class="border p-3 mb-4">
                    <legend class="w-auto">Adres</legend>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="address-city">Miasto</label>
                            <input type="text" name="address-city" id="address-city" class="form-control" 
                            value="<?php if(getCookieValue('address-city')) echo getCookieValue('address-city') ?>"
                            required>
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="address-province">Województwo</label>
                            <input type="text" name="address-province" id="address-province" class="form-control"
                            value="<?php if(getCookieValue('address-province')) echo getCookieValue('address-province') ?>"
                                required>
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="address-address">Ulica, numer domu</label>
                            <input type="text" name="address-address" id="address-address" class="form-control"
                            value="<?php if(getCookieValue('address-address')) echo getCookieValue('address-address') ?>"
                                required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address-postal-code">Kod pocztowy</label>
                        <input type="text" pattern="^\d{2}-\d{3}$" name="address-postal-code" id="address-postal-code"
                        value="<?php if(getCookieValue('address-postal-code')) echo getCookieValue('address-postal-code') ?>" 
                         class="form-control" placeholder="12-345" required>
                    </div>
                </fieldset>

                <!-- Numer karty -->
                <div class="form-group">
                    <label for="credit-card">Numer karty</label>
                    <input type="text" pattern="^(\d{4}[-\s]?){3}\d{4}$" name="credit-card" id="credit-card"
                       value="<?php if(getCookieValue('credit-card')) echo getCookieValue('credit-card') ?>" class="form-control" placeholder="1234-5678-9012-3456" required>
                </div>
            </fieldset>

            <!-- Dodatkowe -->
            <fieldset class="border p-3">
                <legend class="w-auto">Dodatkowe</legend>

                <div class="form-check">
                    <input type="checkbox" name="child-bed" id="child-bed" class="form-check-input"
                        <?php if(getCookieValue('credit-card')) echo 'checked'; ?> >
                    <label for="child-bed" class="form-check-label">Łóżko dla dziecka</label>
                </div>

                <div class="form-group mt-2">
                    <label for="addons">Udogodnienia</label>
                    <select name="addons[]" id="addons" class="form-control selectpicker" multiple>
                        <!--addons must have [], otherwise it will not be treated as array-->
                        <option value="ashtray" <?php if(isset(getCookieValue('addons')['ashtray'])) echo 'selected'; ?> >Popielniczka</option>
                        <option value="air-conditioning" <?php if(isset(getCookieValue('addons')['air-conditioning'])) echo 'selected'; ?>>Klimatyzacja</option>
                        <option value="wifi" <?php if(isset(getCookieValue('addons')['wifi'])) echo 'selected'; ?> >Wi-Fi</option>
                        <option value="pool" <?php if(isset(getCookieValue('addons')['pool'])) echo 'selected'; ?> >Basen</option>
                    </select>
                </div>
            </fieldset>

            <!-- Buttons -->
            <div class="container mt-2">
                <div class="row">
                    <div class="col-4 mb-2">
                        <button type="submit" class="btn btn-primary w-100">Zarezerwuj</button>
                    </div>
                    <div class="col-4 mb-2">
                        <input type="reset" class="btn btn-primary w-100" value="Wyczyść formularz">
                    </div>
                    <div class="col-4 mb-2">
                        <button class="btn btn-primary w-100" id="btn-show-data">Wyświetl Dane</button>
                    </div>
                </div>
            </div>

        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js" integrity="sha512-3j3VU6WC5rPQB4Ld1jnLV7Kd5xr+cq9avvhwqzbH/taCRNURoeEpoPBK9pDyeukwSxwRPJ8fDgvYXd6SkaZ2TA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha256-CjSoeELFOcH0/uxWu6mC/Vlrc1AARqbm/jiiImDGV3s=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

    <script>

        function setPeopleCount(){
                    let peopleCountInput = $('#people-count');
                    let peopleCount = parseInt(peopleCountInput.val()) || 0;
                    
                    let peopleDetailsContainer = $("#people-details");
                    peopleDetailsContainer.empty(); // Wyczyść stare pola

                    // Pobierz dane z ciasteczek (jeśli istnieją)
                    let cookieNames = [];
                    let cookieSurnames = [];

                    try {
                        if (document.cookie.includes("people-names")) {
                            cookieNames = JSON.parse($.cookie("people-names"));
                        }
                        if (document.cookie.includes("people-surnames")) {
                            cookieSurnames = JSON.parse($.cookie("people-surnames"));
                        }
                    } catch (e) {
                        console.warn("Error while parsing cookies:", e);
                    }

                    // Tworzenie pól formularza
                    for (let i = 0; i < peopleCount; i++) {
                        let container = $("<fieldset>").addClass("border p-3 mb-4")
                            .append($("<legend>").text("Osoba " + (i + 1)));
                        let personDiv = $("<div>").addClass("form-group row");

                        // Imię
                        let nameContainer = $("<div class='col-md-6'>");
                        let nameLabel = $("<label>").attr("for", "person-name-" + (i + 1)).text("Imię");
                        let nameInput = $("<input>").attr({
                            "type": "text",
                            "class": "form-control",
                            "name": "people-names[]",
                            "required": true,
                            "value": cookieNames[i] || ""
                        });

                        // Nazwisko
                        let surnameContainer = $("<div class='col-md-6'>");
                        let surnameLabel = $("<label>").attr("for", "person-surname-" + (i + 1)).text("Nazwisko");
                        let surnameInput = $("<input>").attr({
                            "type": "text",
                            "class": "form-control",
                            "name": "people-surnames[]",
                            "required": true,
                            "value": cookieSurnames[i] || ""
                        });

                        nameContainer.append(nameLabel, nameInput);
                        surnameContainer.append(surnameLabel, surnameInput);
                        personDiv.append(nameContainer, surnameContainer);
                        container.append(personDiv);
                        peopleDetailsContainer.append(container);
            }
        }

        function resetForm(){
            $("form")[0].reset();
            $("#people-details").empty();
            $('.selectpicker').val([]).selectpicker('refresh');

            var cookies = $.cookie();
            for(var cookie in cookies)
                $.removeCookie(cookie);
        }

        //show data button listener
        $("#btn-show-data").on('click', function() {
            window.location.href = "hotel_show_data.php";
        });

        // Initialize Bootstrap-Select
        $(document).ready(function () {
            $('.selectpicker').selectpicker();
            setPeopleCount(); //cookie might be set, we want to set in on ready as well
        });

        //EVENT LISTENERS
        $("#people-count").on("input", setPeopleCount);
        $("input[type='reset']").on("click", resetForm);
    </script>
</body>

</html>