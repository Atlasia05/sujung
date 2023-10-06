document.addEventListener('DOMContentLoaded', function() {
    var image = document.getElementById("mainImg");
    let img = document.querySelector(".main-img > img");
    let width = image.width;
    let height = image.height;

    if(width > height) {
        img.classList.add("wid");
    }
    else {
        let main = document.querySelector(".main-img");
        img.classList.add("hei");
        main.classList.add("low");
    }
}, false);