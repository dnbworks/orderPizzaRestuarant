
// You can send it and insert the data to the body:

var xhr = new XMLHttpRequest();
xhr.open("POST", yourUrl, true);
xhr.setRequestHeader('Content-Type', 'application/json');
xhr.send(JSON.stringify({
    value: value
}));


var xhr = new XMLHttpRequest();
// we defined the xhr

xhr.onreadystatechange = function () {
    if (this.readyState != 4) return;

    if (this.status == 200) {
        var data = JSON.parse(this.responseText);

        // we get the returned data
    }

    // end of state change: it can be after some time (async)
};

xhr.open('GET', yourUrl, true);
xhr.send();


let data = {element: "barium"};

fetch("/post/data/here", {
  method: "POST", 
  body: JSON.stringify(data)
}).then(res => {
  console.log("Request complete! response:", res);
});

window.post = function(url, data) {
    return fetch(url, {method: "POST", body: JSON.stringify(data)});
  }
  
  // ...
  
  post("post/data/here", {element: "osmium"});



  xhr.open("POST", url, true);
xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
xhr.send(someStuff);




var xhr = new XMLHttpRequest();
xhr.open("POST", "/postman", true);
xhr.setRequestHeader('Content-Type', 'application/json');
xhr.send(JSON.stringify({
    value: 'value'
}));
xhr.onload = function() {
  console.log("HELLO")
  console.log(this.responseText);
  var data = JSON.parse(this.responseText);
  console.log(data);
}