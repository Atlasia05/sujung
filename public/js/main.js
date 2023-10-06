const pageBtnFrom = document.querySelector(".pagination-buttons");
let nowPage = document.querySelector("#pageVal").value;
console.log(nowPage);

let pageBtns = document.querySelectorAll(".page-btn-num");

pageBtns.forEach((e) => {
    let ev = e.href.split("page=")[1];
    if(ev == nowPage) {
        e.classList.add("active");
    }
})

let active = document.querySelector(".active");
console.log(active);