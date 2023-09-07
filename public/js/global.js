async function setupFetch (form,link = window.location.href,method = "POST") {
    
    const response = await fetch(link,{
        method:"post",
        body:new FormData(form),
        headers:{
            "X-HTTP-Method-Override" : method,
        }
    })
    const data = await response.json();
    if(data.status === "danger"){
        alert(data.msg)
        return false;
    }
    return data;
}

async function setupData (link = window.location.href){
    const response = await fetch(link,{
        method:"get",
        headers:{
            "X-Requested-With": "XMLHttpRequest"
        }
    });
    const data = await response.json();
    return data;
}

function loading(pilihan = true){
    const loadingScreen = document.querySelector("#loadingScreen");
    loadingScreen.style.display = pilihan ? "" : "none";
}

function buttonLoading(button,isi,pilihan = true) {
    if(pilihan){
        button.innerHTML = `<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> ` + isi;
        button.disabled = true;
    }else{
        button.innerHTML = isi;
        button.disabled = false;
    }
}
