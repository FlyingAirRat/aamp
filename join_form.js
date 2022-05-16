let joinForm = document.joinForm;
let isEqual = false;

joinForm.upwConfirm.onchange = function(){
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
}

joinForm.btnSubmit.onclick = function() {
    if(isEqual == false) {
        alert("비밀번호가 일치하지 않습니다");
        joinForm.upw.value = "";
        joinForm.upwConfirm.value = "";
        joinForm.upw.focus();
    } else {
        let join = confirm("가입하시겠습니까?");
        if(join == true) {
            alert("회원가입 성공!");
        } else {
            location.reload();
        }
    }
}