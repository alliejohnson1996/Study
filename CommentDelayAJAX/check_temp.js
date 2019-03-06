/**
 These files demonstrate using AJAX to do a GET request to read from a text file, temp.txt
 Be sure to have such a file when you try this out. Then try to change it. EVENTUALLY, the html page
 should show the update. Usually writing to a flat file is slower than with databases so it can take a really
 long time.
 */


/**
 This function creates an object to manage updates to the temperature file
 @param {string} file the name of the file
 @param {string} element the id of the element to update
 @return an object that tracks the file name, element id, current temperature, and length
 for the timeout to wait
 */
function Temperature(file,element){
    this.file_name = file;
    this.element_id = element;
    this.temp = null;
    this.interval = 10000; // so 5 sec intervals
}

/**
 This function performs an AJAX call to update part of the HTML page
 @param {object} updater a Temperature object
 */
function read_text(updater){
    let xhttp = new XMLHttpRequest(); // object to do ajax with
    
    // when the operation is complete (readyState 4) and it is successful ( status 200)
    xhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            // change HTML to store what came back
            set_value(updater.element_id, this.responseText);
            setTimeout(read_text, updater.interval, updater);
        }
    };
    
    // set GET request to read from the file, doing it 'asynchronously'
    xhttp.open("GET", updater.file_name, true);
    xhttp.send(); // do it!
}

/**
 This function changes the value of the text within an element
 @param {string} id the id of an element
 @param {string} value the value to place inside
 */
function set_value(id, value){
    document.getElementById(id).innerHTML = value;
}

// when the window loads, start the process of reading from the file and updating
window.onload = function(){
    let updater = new Temperature("contacts.txt","temp");
    setTimeout(read_text, updater.interval, updater);	
};
