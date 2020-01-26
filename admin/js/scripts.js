//asyncronously displays the current amount of users online.

async function load_online_users(){
        //make a get request to this php function file
        const Http = new XMLHttpRequest();
        //url parameter 'online_users' will be hold the amount of users online
        const url='functions.php?online_users=result';

        //make request
        Http.open("GET", url);
        Http.send();

        //once the http request has been sent
        Http.onreadystatechange = (e) => {
            //append the value to this DOM object.
        document.querySelector('.usersonline').innerHTML = "Users online: " + Http.responseText;
    }
}

//refresh the users being displayed every half a second.
setInterval(() => {
    load_online_users();
}, 500);