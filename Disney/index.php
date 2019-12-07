<?php
        
    include __DIR__ . '/models/model_disney.php';
    $getCharacters = getCharacters();
    
        
?>

<head>
  <title>Disney Votes</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
</head>

<body>
    <div class="container">
        
    <div class="col-sm-offset-2 col-sm-10">
        <h1>Vote for your Favorite Disney Star</h1>
        
        <div class="dchar" id="DisneyCharacterId" >
        <?php foreach ($getCharacters as $row): ?>
                <tr>
                <h1><td><?php echo $row['DisneyCharacterName']; ?></td></h1>    
                
                    <td><img src =images/<?php echo $row['DisneyCharacterImage']; ?>></td>
                    
                    <td><input type ="button" class="btn" data-character-id ="<?php echo $row['DisneyCharacterId']; ?>" value="Vote for <?php echo $row['DisneyCharacterName']; ?>"></td>
                    
                    
                </tr>
            <?php endforeach; ?>
        </div>
        
        <div class ="container">
            <canvas id ="voteChart"></canvas>
        </div>
       
    </div>
    </div>
</body>
</html>

<script>
(function() {
    
    async function displayChart() {
    const url = 'votes.php';
 
    try {
        const response = await fetch(url, {
        method: 'POST', 
        headers: {
          'Content-Type': 'application/json'
        }
      });
     const votes = await response.json();
     console.log (votes);
     
     new Chart(document.getElementById("voteChart"), {
                type: 'bar',
                  data: {
                  labels: votes[0],
                  datasets: [
                    {
                      label: "Number of Votes",
                      backgroundColor:["#3e95cd","#8e5ea2","#3cba9f"],
                      data: votes[1],
                      borderWidth: 10
                    }
                  ]
                }
            });
      
    } catch (error) {
        console.error (error);
     
    }   
  }
  
  displayChart();
  
    
    async function executeVote() {
    const url = 'ajax.php';
    const data = {CharacterID: this.dataset.characterId };

    try {
      const response = await fetch(url, {
        method: 'POST', 
        body: JSON.stringify(data), 
        headers: {
          'Content-Type': 'application/json'
        }
      });
      const json = await response.json();
      document.getElementById("voteChart").innerHTML = JSON.stringify(json);
      console.log(json.CharacterID);

    } catch (error) {
        console.error (error);
     
    }
  }
  
  document.querySelectorAll('.btn').forEach(item => {
        item.addEventListener('click', insertVote);
        
      })
      
      function insertVote() {
          
          executeVote( this.dataset.characterId);
          
      }
   
})();
</script>

