let joinForm = document.joinForm;
let isEqual = false;

joinForm.upwConfirm.onchange = function() {
    let checkUpw = document.getElementById("checkUpw");
    let str = "";

    if(joinForm.upw.value != joinForm.upwConfirm.value) {
        str = "비밀번호가 일치하지 않습니다";
        checkUpw.style.color = "red";
        isEqual = false;
    } else{
        str = "비밀번호가 일치합니다";
        checkUpw.style.color = "green";
        isEqual = true;
    }
    checkUpw.innerHTML = str;
};
joinForm.upw.onchange = function() {
    let checkUpw = document.getElementById("checkUpw");
    let str = "";

    if(joinForm.upw.value != joinForm.upwConfirm.value) {
        str = "비밀번호가 일치하지 않습니다";
        checkUpw.style.color = "red";
        isEqual = false;
    } else{
        str = "비밀번호가 일치합니다";
        checkUpw.style.color = "green";
        isEqual = true;
    }
    checkUpw.innerHTML = str;
};


function check(){
    if(isEqual == false){
        alert("비밀번호가 일치하지 않습니다.");
        joinForm.upw.value = "";
        joinForm.upwConfirm.value = "";
        joinForm.upw.focus();
        return false;
    }
    else if(joinForm.upw.value.length < 8){
        alert("비밀번호가 너무 짧습니다.");
        joinForm.upw.value = "";
        joinForm.upwConfirm.value = "";
        joinForm.upw.focus();
        return false;
    }
    else {
        return true
    };
}