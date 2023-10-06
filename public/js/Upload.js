setInterval(e => {
    
})
function formatPhoneNumber() {
    const Num = document.querySelector(".contents-price");
    const NumValue = Num.value;
    const numbersOnly = NumValue.replace(/[^0-9]/g, "");
    if(numbersOnly == "") {
        Num.value = "";
    }
    else {
        Num.value = Number(numbersOnly).toLocaleString();
    }
}

var srcs = "";

function setThumbnail(event) {
    let place = document.querySelector(".Upload-img");
    let noo_img = document.querySelector("#noo_img");
    let reader = new FileReader();

    reader.onload = function(event) {
        let ev = event.target;
        place.replaceChildren();
        place.style.backgroundColor = "white";
        let img = document.createElement("img");

        var imgs = new Image();
        img.src = event.target.result;

        img.onload = function() {
            var width = this.width;
            var height = this.height;
            width > height ? img.classList.add("wid") : img.classList.add("hei");
        }

        let li = document.createElement("li");
        img.setAttribute("src", event.target.result);
        srsc = event.target.result;
        li.appendChild(img);
        place.appendChild(li);
        if(noo_img != null) {
            noo_img.value = "false";
        }
    };

    reader.readAsDataURL(event.target.files[0]);
}


document.addEventListener("click", e=> {
    if(e.target.id == "no_img") {
        console.log("OK");
        let place = document.querySelector(".Upload-img");
        let noo_img = document.querySelector("#noo_img");
    
        redraw();
    
        place.replaceChildren();
        place.style.backgroundColor = "white";
        let img = document.createElement("img");
        let li = document.createElement("li");
    
        img.setAttribute("src", "../images/Static/no_img.jpg");
        li.appendChild(img);
        place.appendChild(li);
    
        noo_img.value = "true";
    }
})

function redraw() {
    let form = document.querySelector(".Upload-img-form");

    form.replaceChildren();
    form.innerHTML = `
        <input type="file" class="Upload-img-input" name="chooseFile" id="chooseFile" accept="image/*" onchange="setThumbnail(event);">
        <input type="hidden" name="no_img" id="noo_img" style="display: none" value="false">
        <label for="chooseFile" class="Upload-img-label">
            이미지 변경
        </label>
        <button id="no_img" type="button" class="Upload-img-label">
            이미지 없음
        </button>
    `;
}