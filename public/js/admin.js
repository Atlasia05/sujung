const pageBtnFrom = document.querySelector(".pagination-buttons");
let nowPage = document.querySelector("#pageVal").value;

let pageBtns = document.querySelectorAll(".page-btn-num");

pageBtns.forEach((e) => {
    let ev = e.href.split("page=")[1];
    if(ev == nowPage) {
        e.classList.add("active");
    }
})

let active = document.querySelector(".active");

function Modify(e) {
    const uid = e.dataset.uid;
    console.log(uid);
    if(uid == 1) {
        alert("관리자 계정은 변경이 불가합니다.");
        return;
    }
    let inputs = document.querySelectorAll(`.inputs${uid}`);
    let btnsForm = document.querySelector(`.submit${uid}`);

    btnsForm.innerHTML = `
        <button type="submit">저장</button>
        <button type="button" class="del" onclick='Cansle(${uid})'>취소</button>
    `

    inputs.forEach(e => {
        e.disabled = false;
        e.classList.add("see");
    })
}

function Cansle(uid) {
    let inputs = document.querySelectorAll(`.inputs${uid}`);

    let btnsForm = document.querySelector(`.submit${uid}`);

    btnsForm.innerHTML = `
        <button type="button" data-uid="${uid}" onclick="Modify(this)">수정</button>
        <a href="userDel?id=${uid}" class="del">삭제</a>
    `

    inputs.forEach(e => {
        e.disabled = true;
        e.classList.remove("see");
    })
}

$('#exel_down').click(function(){
	location.href = "url";
})