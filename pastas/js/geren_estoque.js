const buttons = document.querySelectorAll('.table button.btn-danger');

buttons.forEach(button => {
    button.addEventListener('click', () => {
        const name = button.getAttribute('name');
        xml(name);
    });
});

function xml($parametro){
    var xml = new XMLHttpRequest();
    xml.open("POST", "geren_estoque.php", true);
    xml.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xml.onreadystatechange = function(){
        if(xml.readyState === 4 && xml.status === 200){
            console.log(xml.responseText);
        }
    };
    xml.send("id=" + encodeURIComponent($parametro));
}