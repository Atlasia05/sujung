function setThumbnail(event) {
    let place = document.querySelector(".profileBox");
    let reader = new FileReader();
    let pro = document.querySelector("#noImage");

    reader.onload = function(event) {
        place.replaceChildren();
        place.style.backgroundColor = "white";
        let img = document.createElement("img");
        img.setAttribute("src", event.target.result);
        place.appendChild(img);
        pro.value = "";
    };

    reader.readAsDataURL(event.target.files[0]);
}

let noImage = document.querySelector(".noImage");
noImage.addEventListener("click", e=> {
    let place = document.querySelector(".profileBox");
    let pro = document.querySelector("#noImage");
    place.replaceChildren();

    pro.value = "images/user.jpg";
    let img = document.createElement("img");
    img.setAttribute("src", "images/Static/user.jpg");
    place.appendChild(img);
})