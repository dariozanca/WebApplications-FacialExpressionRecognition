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
		
		<!-- Pre-load the lists of facial expression files for the trials, already in a random order -->
		<?php 
    		include 'php/recursive_scandir.php';		
    		$emoticons = scanDir::scan('media/emoticons', "jpg", FALSE);		
    		$humans = scanDir::scan('media/humans', "mp4", TRUE);		
		?>
		<script type="text/javascript">
    		var emoticons = <?php echo array2string($emoticons); ?>;
    		var humans = <?php echo array2string($humans); ?>;

    		var trial_id = 0;
    		var number_of_trials = 6 + 36;
    		var answers_report = "Current image,Answer,Result,Time (ms)\n";
		</script>

    </head>
    
    <body>    
    
    	<!-- First window starts (FORM) -->
    	
        <div style="text-align: center; display: block;" id="WindowForm">
        
                <div class="card">
                
                <img class="card-img-top" src="media/logo-neurosense.png" alt="Card image cap">
                
                <div class="card-body">
                
                    <h5 class="card-title">Benvenuto</h5>
                    <p class="card-text">Inserisci le informazioni richieste per cominciare il test.</p>
                    
                    <form onsubmit="submitForm()" method="post" id="form">
                    
                		<div style="text-align: left;">
                            <p><label for="name">Nome:</label>
                            <input type="text" id="name" name="name" class="form-control" required="required"></p>
                            
                            <p><label for="surname">Cognome:</label>
                            <input type="text" id="surname" name="surname" class="form-control" required="required"></p>
                            
                            <p><label for="birthdate">Data di nascita:</label>
                            <input type="date" id="birthdate" name="birthdate" class="form-control" required="required"></p>
                		</div>
                        <br>
                        <button type="submit" class="btn btn-primary">Salva e continua</button>
                    </form>
                    
                	<script type="text/javascript">
                    	// Prevent page from refreshing page on submit
                        $("#form").submit(function(e) {e.preventDefault();});
                	</script>
                    
                </div>
            </div>  
            
            <br>
            <br>  		            
                  
    	</div>

    	<!-- First window ends (FORM) -->
    	
    	
    	
    	
    
    	<!-- Second window starts (INSTRUCTIONS) -->
    	
        <div style="text-align: center; display: none;" id="WindowInstructions">
                  
            <div class="card">
            
                <img class="card-img-top" src="media/logo-neurosense.png" alt="Card image cap">
                
                <div class="card-body" style="text-align: left;">
                
                    <h2 class="card-title">Ciao <span id="spanName"></span>!</h2>
                    
                	<h5>Leggi attentamente le istruzioni.</h5> 
                	
                	<br>
                	<br>
                	
                    <p class="card-text">Il test si divide in due fasi:
                
                        <ol>
                        	<li>Nella prima fase viene richiesto di riconoscrele le emozioni
                        	corrispondenti a delle "faccine" (emoticon): &egrave; necessario cliccare 
                        	sul pulsante corrispondente all'emozione che si ritiene corretta.
                        	I pulsanti sono posizionati attorno alla faccina (emoticon).</li>
                        	
                        	<li>Nella seconda fase il test precedente viene ripetuto,
                        	questa volta con delle vere e proprie espressioni del viso umane
                        	(non emoticon). In questo caso, le espressioni sono "dinamiche":
                        	il volto impiega qualche secondo per mostrare l'espressione definitiva.</li>
                        </ol>
                    
                    </p>
                	
                	<br>
                	
                	<button type="button" class="btn btn-primary" onclick="closeInstructions()">Inizia l'esperimento!</button>
                </div>
            </div> 
            
            <br>
            <br>   
    	</div>

    	<!-- Second window ends (INSTRUCTIONS) -->
    	
    	
    	
    	
    
    	<!-- Third window starts (EXPERIMENT - EMOTICONS) -->
    	
        <div style="text-align: center; display: none;" id="WindowExperimentEmoticons">
        
            <div class="card">
            
                <img src="" class="Stimulus" id="StimulusEmoticons">
                
                <div class="card-body" style="text-align: left;">
                	
                    <p class="card-text">
                    
                    	<div class="row">
                    	
                    		<div class="col-4"><button class="btn btn-secondary btn-sm btn-block" type="button" onclick="trialActionEmoticons('DISGUSTO')">DISGUSTO</button></div>
                    		<div class="col-4"><button class="btn btn-secondary btn-sm btn-block" type="button" onclick="trialActionEmoticons('RABBIA')">RABBIA</button></div>
                    		<div class="col-4"><button class="btn btn-secondary btn-sm btn-block" type="button" onclick="trialActionEmoticons('FELICITA')">FELICIT&Agrave;</button></div>
                    		
                    	</div>
                    	
                    	<br>
                    	
                    	<div class="row">
                    	
                    		<div class="col-4"><button class="btn btn-secondary btn-sm btn-block" type="button" onclick="trialActionEmoticons('SORPRESA')">SORPRESA</button></div>
                    		<div class="col-4"><button class="btn btn-secondary btn-sm btn-block" type="button" onclick="trialActionEmoticons('PAURA')">PAURA</button></div>
                    		<div class="col-4"><button class="btn btn-secondary btn-sm btn-block" type="button" onclick="trialActionEmoticons('TRISTEZZA')">TRISTEZZA</button></div>
                    		
                    	</div>
                    
                    </p>
                	
                </div>
                
            </div> 
            
            <br>
            <br>
        
    	</div>

    	<!-- Third window ends (EXPERIMENT - EMOTICONS) -->
    	
    	
    	
    	
    
    	<!-- Fourth window starts (EXPERIMENT - HUMANS) -->
    	
        <div style="text-align: center; display: none;" id="WindowExperimentHumans">
        
            <div class="card">

                <video 
                	class="Stimulus" id="StimulusHumans" 
                	src="" 
                	type="video/mp4"
                	autoplay muted>
                </video>
                
                <div class="card-body" style="text-align: left;">
                	
                    <p class="card-text">
                    
                    	<div class="row">
                    	
                    		<div class="col-4"><button class="btn btn-secondary btn-sm btn-block" type="button" onclick="trialActionHumans('DISGUSTO')">DISGUSTO</button></div>
                    		<div class="col-4"><button class="btn btn-secondary btn-sm btn-block" type="button" onclick="trialActionHumans('RABBIA')">RABBIA</button></div>
                    		<div class="col-4"><button class="btn btn-secondary btn-sm btn-block" type="button" onclick="trialActionHumans('FELICITA')">FELICIT&Agrave;</button></div>
                    		
                    	</div>
                    	
                    	<br>
                    	
                    	<div class="row">
                    	
                    		<div class="col-4"><button class="btn btn-secondary btn-sm btn-block" type="button" onclick="trialActionHumans('SORPRESA')">SORPRESA</button></div>
                    		<div class="col-4"><button class="btn btn-secondary btn-sm btn-block" type="button" onclick="trialActionHumans('PAURA')">PAURA</button></div>
                    		<div class="col-4"><button class="btn btn-secondary btn-sm btn-block" type="button" onclick="trialActionHumans('TRISTEZZA')">TRISTEZZA</button></div>
                    		
                    	</div>
                    
                    </p>
                	
                </div>
                	
        	</div>
            
            <br>
            <br>
                
    	</div>

    	<!-- Fourth window ends (EXPERIMENT - HUMANS) -->
    	
    	
    	
    	
    
    	<!-- Fifth window starts (LAST) -->
    	
        <div style="text-align: center; display: none;" id="WindowLast">
                  
            <div class="card">                
                <div class="card-body">
                
                    <h2 class="card-title">Fine dell'esperimento!</h2>
                    <p>Grazie per aver partecipato.</p> 
                    
                </div>
            </div>
                  
            <div class="card">                
                <div class="card-body" style="text-align: left;">
                
                    <h5 class="card-title">Dati del soggetto</h5>
                    <p><b>Nome: </b><span id="name_last_page"></span></p>
                    <p><b>Cognome: </b><span id="surname_last_page"></span></p>
                    <p><b>Data di nascita: </b><span id="birthdate_last_page"></p>
                    <p><b>Errori totali: </b><span id="errors_last_page"></span></p>
                        
					 <br>
					 <br>
       	 			 
       	 			 <form action="report.php" method="post">
       	 			 
       	 			 <input type="hidden" name="name_report" id="name_report" value="">
       	 			 <input type="hidden" name="surname_report" id="surname_report" value="">
       	 			 <input type="hidden" name="birthdate_report" id="birthdate_report" value="">
       	 			 <input type="hidden" name="answers_report" id="answers_report" value="">

				  	 <button type="submit" class="btn btn-primary btn-block">PROCEDI</button>
       	 			 </form>
                                
                </div>
            </div>
            
            <br>
            <br>

    	</div>

    	<!-- Fifth window ends (LAST) -->
    
    </body>
    
</html>