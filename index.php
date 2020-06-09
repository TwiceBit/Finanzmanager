<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script src="./jquery.js"></script>
    <script src="./Chart.js"></script>
</head>
<body>
    <div id="container">


        <div id="side">
            <div id="addbox">

                <form action="/add.php" method="POST">
                    <input type="text" name="description">
                    <input type="number" step="0.01" name="amount">
                    <input type="submit" value="Hinzufügen">
                    
                </form>

            </div>
            <ul>
            
            <?php
                require 'Database.php';
                
                $data = Database::getReverseAllTransactions();
                while($row = $data->fetch_assoc()) {
                    if($row['beschreibung'] == null && $row['betrag'] == null) continue;
                
            ?>

            <li class="finanz_item"><p><?php echo $row['beschreibung'] . " | " . $row['betrag'] ?></p></li>
              <?php
              }
              ?>

            </ul>
        </div>

        <div id="content">
        
                <div id="imgs">
                    <canvas id="myChart"></canvas>
                </div>
            
               
        </div>

        <script>
        
            let canv = document.getElementById("myChart");
            let data;
            let datajs;
            $.getJSON("/jsondata.php", function(da){
                datajs = da;
    
                console.log(da);
    
            
                let chart = new Chart(canv, {
    
                    type: 'line',
                
                    data: {
                        labels: datajs['data']["labels"],
                        datasets: [{
                            label: 'Euro',
                            backgroundColor: 'rgb(255, 99, 132)',
                            borderColor: 'rgb(255, 99, 132)',
                            data: datajs["data"]["datasets"][0]["data"],
                            fill: false
                        }]
                    },
                
                    options: {}
                });
    
            });
           
            
        </script>


        </div>
  
</body>
</html>