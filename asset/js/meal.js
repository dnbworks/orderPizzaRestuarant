

const getMenu = async () => {
    const response = await fetch('http://127.0.0.1:5500/data.json');
    const data = await response.json();
    return data;
};


function render(data, elementObject, type, pizza_name){
    data.forEach(item => {
        if(type == item.type){
            var item_data = item.data;
            

            for(let i = 0; i < item_data.length; i++){
               
                if(item_data[i].title == pizza_name){
                    // console.log(item_data[i].title);
                    elementObject.title.innerText = item_data[i].title;
                    elementObject.img.src = item_data[i].img;
                    
                }
      
            }
        }
    });   

   // add zoom feature
    var evt = new Event(),
    m = new Magnifier(evt);
    m.attach({
        thumb: '#thumb',
        largeWrapper: 'preview',
        zoom:2,
        zoomable: false,
        mode: "inside"
    });
    
    // var preloader = document.querySelector(".pre-loader");
    // preloader.style.display = "none"; 
    
}


window.onload = function(){
    const pizza_name = new URLSearchParams(window.location.search).get("pizza_name");
    const type = new URLSearchParams(window.location.search).get("type");
    const elementObject = {
        title: document.querySelector("h4"),
        img: document.querySelector("figure img")
    }

    getMenu()
    .then(data => render(data, elementObject, type, pizza_name))
    .catch(err => console.log("error", err));

    // console.log(pizza_name, type);

}