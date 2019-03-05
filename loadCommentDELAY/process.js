/**
 This function makes an object to encapsulate a client
 @param {string} company the name of the company
 @param {string} name the contact name
 @param {string} email their email address
 */
function Client(company){
    this.company = company;
    //this.name = name;
    //this.email = email;
}

/**
 This function reads from the web form and adds the contact
 information to a data file via an AJAX call
 */
function add_client(){
    let company = document.getElementById('company').value;
    //let name = document.getElementById('contact').value;
    //let email = document.getElementById('email').value;
    
    let client = new Client(company);
    
    let data = JSON.stringify(client);
    
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) { // when ready, give status
            document.getElementById('confirm').innerHTML = this.responseText;
        }
    };
    
    xmlhttp.open("POST", "client_post.php", true);
    
    // will send data as a query string
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("client=" + data); // send client info
}
