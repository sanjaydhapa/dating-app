<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Bublee.me - Be the First to Find Your Spark After We Launch!</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa, #c3e0e5); /* Subtle gradient inspired by logo colors */
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .container {
            text-align: center;
            padding: 20px;
            max-width: 700px;
            width: 100%;
        }

        .header {
            margin-bottom: 30px;
        }

        .header img {
            max-width: 300px; /* Adjust logo size */
            height: auto;
            margin-bottom: 15px;
        }

        .header h2 {
            font-size: 1.8em;
            color: #ff6b6b; /* Match logo's coral color */
            margin-bottom: 15px;
        }

        .header p {
            font-size: 1.1em;
            color: #555;
            margin-bottom: 20px;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            max-width: 520px; /* Increased by 30% from 400px */
            margin: 0 auto;
            border: 2px solid #5bc0de; /* Teal border inspired by logo */
        }

        .form-container table {
            width: 100%;
            border-collapse: collapse;
        }

        .form-container td {
            padding: 10px;
            vertical-align: top;
        }

        .form-container label {
            font-weight: bold;
            color: #ff6b6b;
        }

        .form-container input[type="text"],
        .form-container input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #5bc0de; /* Teal border */
            border-radius: 5px;
            font-size: 1em;
            transition: border-color 0.3s;
        }

        .form-container input[type="text"]:focus,
        .form-container input[type="email"]:focus {
            border-color: #ff6b6b; /* Coral on focus */
            outline: none;
        }

        .form-container input[type="submit"] {
            background-color: #ff6b6b;
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 1.1em;
            border-radius: 25px;
            cursor: pointer;
            display: block;
            margin: 20px auto;
            transition: background-color 0.3s;
        }

        .form-container input[type="submit"]:hover {
            background-color: #5bc0de; /* Teal on hover */
        }

        #success-message {
            display: none;
            text-align: center;
            color: #ff6b6b;
            font-size: 1.2em;
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #ff6b6b;
            border-radius: 5px;
            background-color: #ffe6e6;
        }

        footer {
            text-align: center;
            padding: 20px;
            color: #5bc0de; /* Teal footer text */
            font-size: 0.9em;
            margin-top: 20px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 600px) {
            .form-container {
                max-width: 90%;
            }

            .header h2 {
                font-size: 1.5em;
            }

            .header p {
                font-size: 1em;
            }

            .form-container td {
                display: block;
                width: 100%;
            }

            .form-container label {
                margin-bottom: 5px;
            }

            .header img {
                max-width: 250px; /* Smaller logo on mobile */
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('public/logo_bublee.png')}}" alt="Bublee.me Logo">
            <h2>Be the First to Find Your Spark After We Launch!</h2>
            <p>Join the Bublee.me waitlist and get exclusive early access to our revolutionary dating app. Connect with meaningful matches and spark something special.</p>
        </div>

        <div class="form-container">
            <form id="__vtigerWebForm" name="Bubble.me" action="https://crmsystem.si/crm/modules/Webforms/capture.php" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <input type="hidden" name="__vtrftk" value="sid:cdd75fb355fe33b7c740fa5dc92ce9d0a916794e,1744354089">
                <input type="hidden" name="publicid" value="0e418b54bf2066482804c01f6ec314eb">
                <input type="hidden" name="urlencodeenable" value="1">
                <input type="hidden" name="name" value="Bubble.me">
                <input type="hidden" name="user_name" value="info@iteca.si">
                <input type="hidden" name="email" value="info@iteca.si">

                <table>
                    <tbody>

                        <tr>
                            <td><label>Name*</label></td>
                            <td><input type="text" name="lastname" data-label="Last Name" value="" required=""></td>
                        <tr>
                            <td><label>Email*</label></td>
                            <td><input type="email" name="email" data-label="Primary Email" value="" required=""></td>
                        </tr>
                        <tr>
                            <td>
                                <select name="leadsource" data-label="leadsource" hidden="">
                                    <option value="">Select Value</option>
                                    <option value="virtualnikatalogi.org">virtualnikatalogi.org</option>
                                    <option value="Konferenca">Konferenca</option>
                                    <option value="Planetdigital.net">Planetdigital.net</option>
                                    <option value="E-novice">E-novice</option>
                                    <option value="Neli.si">Neli.si</option>
                                    <option value="Online-marketing.si">Online-marketing.si</option>
                                    <option value="Ponudbe.org">Ponudbe.org</option>
                                    <option value="Poznanstvo">Poznanstvo</option>
                                    <option value="Spletnestrani.org">Spletnestrani.org</option>
                                    <option value="Seminar.si">Seminar.si</option>
                                    <option value="Facebook">Facebook</option>
                                    <option value="Revija INTERNET">Revija INTERNET</option>
                                    <option value="Info-net.si">Info-net.si</option>
                                    <option value="primerjam.si">primerjam.si</option>
                                    <option value="E-mail">E-mail</option>
                                    <option value="CRMsistem.si">CRMsistem.si</option>
                                    <option value="DPD">DPD</option>
                                    <option value="Revija DIREKTOR">Revija DIREKTOR</option>
                                    <option value="Paywiser">Paywiser</option>
                                    <option value="DEMO dostop do CRM">DEMO dostop do CRM</option>
                                    <option value="Sejem">Sejem</option>
                                    <option value="Digitalni Marketing">Digitalni Marketing</option>
                                    <option value="Digitalni Marketing GK">Digitalni Marketing GK</option>
                                    <option value="Cold Call">Cold Call</option>
                                    <option value="Existing Customer">Existing Customer</option>
                                    <option value="Self Generated">Self Generated</option>
                                    <option value="Employee">Employee</option>
                                    <option value="Partner">Partner</option>
                                    <option value="Public Relations">Public Relations</option>
                                    <option value="Conference">Conference</option>
                                    <option value="Trade Show">Trade Show</option>
                                    <option value="Web Site">Web Site</option>
                                    <option value="Word of mouth">Word of mouth</option>
                                    <option value="Other">Other</option>
                                    <option value="Podjetniskiutrip.si">Podjetniskiutrip.si</option>
                                    <option value="Sassy.si">Sassy.si</option>
                                    <option value="Nobel Manhattan Coaching">Nobel Manhattan Coaching</option>
                                    <option value="WhitePress">WhitePress</option>
                                    <option value="Nobel Manhattan Coaching - drugi">Nobel Manhattan Coaching - drugi</option>
                                    <option value="bublee" selected="">bublee</option>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <input type="submit" value="Join the Waitlist">
            </form>
            <div id="success-message">Successfully added to the waitlist!</div>
        </div>

        <footer>
            <p>© 2025 Bublee.me. All rights reserved.</p>
        </footer>
    </div>

    <script type="text/javascript">
        window.onload = function() {
            var N = navigator.appName, ua = navigator.userAgent, tem;
            var M = ua.match(/(opera|chrome|safari|firefox|msie)\/?\s*(\.?\d+(\.\d+)*)/i);
            if (M && (tem = ua.match(/version\/([\.\d]+)/i)) != null) M[2] = tem[1];
            M = M ? [M[1], M[2]] : [N, navigator.appVersion, "-?"];
            var browserName = M[0];
            var form = document.getElementById("__vtigerWebForm"), inputs = form.elements;
            var successMessage = document.getElementById("success-message");

            form.onsubmit = function() {
                var required = [], att, val;
                for (var i = 0; i < inputs.length; i++) {
                    att = inputs[i].getAttribute("required");
                    val = inputs[i].value;
                    type = inputs[i].type;
                    if (type == "email") {
                        if (val != "") {
                            var elemLabel = inputs[i].getAttribute("data-label");
                            var emailFilter = /^[_/a-zA-Z0-9]+([!"#$%&()*+,./:;<=>?\^_`{|}~-]?[a-zA-Z0-9/_/-])*@[a-zA-Z0-9]+([\_\-\.]?[a-zA-Z0-9]+)*\.([\-\_]?[a-zA-Z0-9])+(\.?[a-zA-Z0-9]+)?$/;
                            var illegalChars = /[\(\)\<\>\,\;\:\"\[\]]/;
                            if (!emailFilter.test(val)) {
                                alert("For " + elemLabel + " field please enter valid email address");
                                return false;
                            } else if (val.match(illegalChars)) {
                                alert(elemLabel + " field contains illegal characters");
                                return false;
                            }
                        }
                    }
                    if (att != null) {
                        if (val.replace(/^\s+|\s+$/g, "") == "") {
                            required.push(inputs[i].getAttribute("data-label"));
                        }
                    }
                }
                if (required.length > 0) {
                    alert("The following fields are required: " + required.join());
                    return false;
                }
                var numberTypeInputs = document.querySelectorAll("input[type=number]");
                for (var i = 0; i < numberTypeInputs.length; i++) {
                    val = numberTypeInputs[i].value;
                    var elemLabel = numberTypeInputs[i].getAttribute("data-label");
                    if (val != "") {
                        var intRegex = /^[+-]?\d+$/;
                        if (!intRegex.test(val)) {
                            alert("For " + elemLabel + " field please enter valid number");
                            return false;
                        }
                    }
                }
                var dateTypeInputs = document.querySelectorAll("input[type=date]");
                for (var i = 0; i < dateTypeInputs.length; i++) {
                    dateVal = dateTypeInputs[i].value;
                    var elemLabel = dateTypeInputs[i].getAttribute("data-label");
                    if (dateVal != "") {
                        var dateRegex = /^[1-9][0-9]{3}-(0[1-9]|1[0-2]|[1-9]{1})-(0[1-9]|[1-2][0-9]|3[0-1]|[1-9]{1})$/;
                        if (!dateRegex.test(dateVal)) {
                            alert("For " + elemLabel + " field please enter valid date in required format");
                            return false;
                        }
                    }
                }

                // Show success message before submission
                form.style.display = "none";
                successMessage.style.display = "block";

                return true; // Allow direct form submission to CRM
            };
        }
    </script>
</body>
</html>