document.getElementById('classDel').addEventListener('click',
 function() {
    if(confirm("정말 삭제하시겠습니까? 되돌릴 수 없습니다!")){
        document.getElementById('classDelSubmit').click();
    }
});