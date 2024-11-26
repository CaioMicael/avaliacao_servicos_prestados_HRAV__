function doAjaxCarregaPergunta() {
    let xmlhttp;
    const method = "GET";
    const url    = "../../lib/estAjax/estClassAjaxPergunta.php";
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = 
    xmlhttp.open(method,url,true);
    xmlhttp.send();
}