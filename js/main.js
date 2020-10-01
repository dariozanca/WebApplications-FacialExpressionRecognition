/**

In this file we define all the scripts.

 */

function submitForm() {
	
	window.name = document.getElementById("name").value;
	window.surname = document.getElementById("surname").value;
	window.birthdate = document.getElementById("birthdate").value;

	document.getElementById("WindowForm").style.display = "none";
	document.getElementById("WindowInstructions").style.display = "block";

	document.getElementById("spanName").innerHTML = name;
}


function closeInstructions() {

	document.getElementById("WindowInstructions").style.display = "none";
	document.getElementById("WindowExperimentEmoticons").style.display = "block";
	

	document.getElementById("StimulusEmoticons").src = window.emoticons[0];	
	window.trial_start_time = new Date().getTime();
}


function trialActionEmoticons(answer) {	
	
	img_vec = window.emoticons;
	
	current_img = img_vec[window.trial_id];
	
	add_to_report(current_img, answer);
	
	if(current_img.includes(answer)) {
		
		window.trial_id = window.trial_id + 1;	
		
		if (window.trial_id < 6) {
			current_img = img_vec[window.trial_id];
			document.getElementById("StimulusEmoticons").src = current_img;
			window.trial_start_time = new Date().getTime();
		}
		else{
			document.getElementById("WindowExperimentEmoticons").style.display = "none";
			document.getElementById("WindowExperimentHumans").style.display = "block";
			
			document.getElementById("StimulusHumans").src = window.humans[0];
			window.trial_start_time = new Date().getTime();
		}
	}
}


function trialActionHumans(answer) {	
	
	img_vec = window.humans;
	
	current_img = img_vec[window.trial_id - 6];
	
	add_to_report(current_img, answer);
	
	if(current_img.includes(answer)) {
		
		window.trial_id = window.trial_id + 1;	
		
		if (window.trial_id < window.number_of_trials) {
			current_img = img_vec[window.trial_id - 6];
			document.getElementById("StimulusHumans").src = current_img;
			window.trial_start_time = new Date().getTime();
		}
		else{
			go_to_last_page();
		}
	}
}


function add_to_report(current_img, answer) {
	
	end_time = new Date().getTime();
	
	window.answers_report = window.answers_report.concat(
			current_img, ",",
			answer, ",");
	
	if (current_img.includes(answer)) {
		window.answers_report = window.answers_report.concat("CORRECT,");
	}
	else {
		window.answers_report = window.answers_report.concat("ERROR,");
	}
	
	window.answers_report = window.answers_report.concat(
			(end_time - window.trial_start_time).toString(), "\n"
	);
	
}


function go_to_last_page() {	

	document.getElementById("WindowExperimentHumans").style.display = "none";
	document.getElementById("WindowLast").style.display = "block";


	document.getElementById("name_last_page").innerHTML = window.name;
	document.getElementById("surname_last_page").innerHTML = window.surname;
	document.getElementById("birthdate_last_page").innerHTML = window.birthdate;
	document.getElementById("errors_last_page").innerHTML = (window.answers_report.match(/ERROR/g) || []).length;;

	document.getElementById("name_report").value = window.name;
	document.getElementById("surname_report").value = window.surname;
	document.getElementById("birthdate_report").value = window.birthdate;
	document.getElementById("answers_report").value = window.answers_report;
	
}