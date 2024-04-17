<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .X {
            text-align: center;
            cursor: pointer;
        }

        .green {
            background-color: green;
            color: white;
        }

        #dialog-form {
            display: none;
        }

        #dialog-form label {
            display: block;
            margin-top: 10px;
        }

        h3 {
            text-align: center;
            text-decoration: underline;
            border-radius: 30px;
        }
    </style>
    <title>Portfolio | Hugo</title>
</head>

<body>
    <h1>BTS SERVICES INFORMATIQUES AUX ORGANISATIONS</h1>
    <h3>Tableau de synthèse des réalisations professionnelles (2023-2025)</h3>

    <table id="portfolio">
        <tr>
            <th width=30%>Réalisation</th>
            <th width=30%>Compétences</th>
        </tr>

        

    </table>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            function loadData() {
                $.ajax({
                    url: 'Database.php', 
                    method: 'GET',
                    success: function (data) {
                        $('#portfolio').append(data); 
                    }
                });
            }

            
            loadData();

            
            $('.ok').click(function () {
                if ($(this).text() == 'X') {
                    $(this).toggleClass('green');
                }
            });
        });
    </script>

</body>

</html>
