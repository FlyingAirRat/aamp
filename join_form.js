let joinForm = document.joinForm;
let isEqual = false;

joinForm.upwConfirm.onchange(upwCheck());
joinForm.upw.onchange(upwCheck());

function upwCheck(){
    let upw = joinForm.upw.value;
    let upwConfirm = joinForm.upw.value;
    let checkUpw = document.getElementById("checkUpw");
    let str = "";

    if(upw != upwConfirm) {
        str = "비밀번호가 일치하지 않습니다";
        checkUpw.style.color = "red";
        isEqual = false;
    } else{
        str = "비밀번호가 일치합니다";
        checkUpw.style.color = "green";
        isEqual = true;
    }
    checkUpw.innerHTML = str;
}

function check(){
    if(joinForm.uid.value == "") {
        alert("아이디를 입력해 주세요.");
        joinForm.uid.focus();
        return false;
      }
    else if(joinForm.upw.value == "") {
        alert("비밀번호를 입력해 주세요.");    
        joinForm.uid.focus();
        return false;
    }
    else if(isEqual == false){
        alert("비밀번호가 일치하지 않습니다.");
        joinForm.upw.value = "";
        joinForm.upwConfirm.value = "";
        joinForm.upw.focus();
        return false
    }
    else return true;
}