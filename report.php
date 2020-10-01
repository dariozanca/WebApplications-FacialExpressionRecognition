<!DOCTYPE html>

<html>

    <head>
    
        <title>NeuroSense - Facial Expression Recognition</title>
        
        <meta charset="UTF-8">
        <meta name="description" content="Facial expression recognition online test">
        <meta name="keywords" content="Facial expression, recognition, test">
        <meta name="author" content="Dario Zanca">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        
        
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <!-- Self-defined CSS -->
        <link rel="stylesheet"  type="text/css" href="css/main.css">
        
        <!-- Self-defined Javascript -->             
		<script src="js/main.js"></script>

    </head>
    
    <body>    

    
    	<!-- Report window starts -->
    	
    	<?php include 'php/save_result_as_csv.php';?>
    	
        <div style="text-align: center; display: block;" id="WindowLast">
                  
            <div class="card">                
                <div class="card-body">
                
                    <h2 class="card-title">File salvato come CSV sul server!</h2>
                    
                    <br>
                    <br>
                    <br>
                    <a href="<?php echo $fileName; ?>" class="btn btn-success btn-block" download>Scarica i risultati di questo test sul tuo PC</a>
					<br>
                    <a href="index.php" class="btn btn-block btn-primary">Ripeti il test</a> 
                    
                </div>
            </div>
            
            <br>
            <br>

    	</div>

    	<!-- Report window ends -->
    
    </body>
    
</html>