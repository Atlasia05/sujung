var complete = "";
var checkID = document.querySelector(".checkID");

function formatPhoneNumber() {
    const phone = document.getElementById("phone");
    const phoneValue = phone.value;
    const numbersOnly = phoneValue.replace(/[^0-9]/g, "");
  
    if (numbersOnly.length > 3 && numbersOnly.length < 8) {
      phone.value = `${numbersOnly.slice(0, 3)}-${numbersOnly.slice(3)}`;
    } else if (numbersOnly.length >= 8) {
      phone.value = `${numbersOnly.slice(0, 3)}-${numbersOnly.slice(3, 7)}-${numbersOnly.slice(7, 11)}`;
    } else {
      phone.value = numbersOnly;
    }
}

function formatClassNumber() {
    const classes = document.getElementById("class");
    const classValue = classes.value;
    const numbersOnly = classValue.replace(/[^0-9]/g, "");

    if (numbersOnly.length > 5) {
        classes.value = `${numbersOnly.slice(0, 5)}`;
    } else {
        classes.value = numbersOnly;
    }
}

const overlap = document.querySelector("#overlap");
overlap.addEventListener("click", (e) => {
  let userid = document.querySelector("#userid").value;

  $.ajax({
    url: "/check",
    type: "GET",
    data: {
        uid : `${userid}`,
        b : "hi"
    },
    }).done(function(data){
        Checking(data.trim());
  });
})

function Checking(data) {
  if(data == "able") {
    complete = "able";
    checkID.innerText = '사용이 가능한 아이디 입니다.'
    checkID.style.color = "green";
  }
  else {
    complete = "unable";
    checkID.innerText = '사용이 불가능한 아이디 입니다.'
    checkID.style.color = "red";
  }
}

function Submit() {
  console.log(complete);
  if(complete == "able") {
    return true;
  }
  else if (complete == "unable") {
    alert("아이디 중복체크를 해주세요");
    return false;
  }
  else {
    alert("아이디 중복체크를 해주세요.");
    return false;
  }
}

let uid = document.querySelector("#userid");
uid.addEventListener("change", e => {
  checkID.innerText = '아이디 중복체크를 해주세요'
  checkID.style.color = "red";
  complete = "unable";
})