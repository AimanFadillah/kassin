const buttonCari = document.querySelector("#buttonCari")
const cari = document.querySelector("#cari");
const formCari = document.querySelector("#formCari");
const inputCari = document.querySelector("#inputCari");
const closeModal = document.querySelector("#closeModal");
const containerData = document.querySelector("#containerData");
const modalBody = document.querySelector(".bodyModal");
const modalCreate = modalBody.innerHTML;
const formCreate = document.querySelector("#formCreate");
const bentukData = containerData.innerHTML;
let search = "";
let page = 1;
let pageLast;
let timer ;

main()

buttonCari.addEventListener("click",() => cari.style.display = "block")


formCari.addEventListener("submit",(e) => {
    e.preventDefault();
    search = inputCari.value;
    refreshData();
})

document.addEventListener("scroll",handleScroll);
document.addEventListener("submit",async (e) => {
    e.preventDefault()
    
    if(e.target.id === "formCreate"){
        const buttonSubmit = document.querySelector("#buttonSubmit")
        const isiButton = buttonSubmit.innerHTML;
        const method = formCreate.getAttribute("data-method")
        const action = formCreate.getAttribute("data-action")
        buttonLoading(buttonSubmit,isiButton);
        const data = await setupFetch(formCreate,action,method);
        buttonLoading(buttonSubmit,isiButton,false)
        if(data){
            closeModal.click();
            if(method === "POST"){
                tambahData(data.msg,true);
            }else if (method === "DELETE"){
                const id = action.split("/")[4]
                hapusData(id);
            }else if (method === "PUT"){
                const id = action.split("/")[4]
                editData(id,data.msg)
            }
            formCreate.reset();
        }
    }

})

document.addEventListener("click",async (e) => {    

    if(e.target.getAttribute("data-bs-target")){
        const type = e.target.getAttribute("data-type");
        if(type == "show"){
            modalLoading()
            const id = encodeURIComponent(e.target.getAttribute("data-id"));
            const data = await setupData(window.location.href + "?show=" + id);
            modalBody.innerHTML = `<ul class="list-group"></ul>`
            const list = modalBody.querySelector(".list-group");
            for(dt of data){
                list.innerHTML += `
                    <li  class="list-group-item d-flex justify-content-between align-items-center">
                        <h6 class="fw-bold" >${XSS(dt.name)}</h6>
                        <h6>${XSS(dt.value)}</h6>
                    </li>
                `
            }
        }else if(type == "create"){
            formCreate.setAttribute("data-action",window.location.href)
            formCreate.setAttribute("data-method","POST");
            if(modalBody.innerHTML !== modalCreate) return modalBody.innerHTML = modalCreate;
        }else {
            const id = encodeURIComponent(e.target.getAttribute("data-id"));
            formCreate.setAttribute("data-action",window.location.href + "/" + id + "/" )
            if(type === "delete"){
                formCreate.setAttribute("data-method","DELETE");
                modalBody.innerHTML = `
                <h6 for="name" class="form-h3" >Anda yakin ingin menghapusnya?</h6>
                <div class="d-flex justify-content-center">
                <div data-bs-dismiss="modal" class="btn btn-danger me-1" style="width: 100%" >Batal</div>
                <button id="buttonSubmit" class="btn btn-success" style="width: 100%" >Yakin</button>
                </div>
                `
            }else if (type === "edit"){
                modalLoading()
                const data = await setupData(window.location.href + "?id=" + id);
                formCreate.setAttribute("data-method","PUT");
                modalBody.innerHTML = modalCreate;
                const inputs =  modalBody.querySelectorAll("input");
                for(input of inputs){
                    input.setAttribute("value",data[input.getAttribute("name")])
                }
            }
        }
    }

})


function main () {
    refreshData()
}

function modalLoading() {
    modalBody.innerHTML = `
    <div class="d-flex justify-content-center" >
        <div class="spinner-border text-dark" role="status">
    </div>
    `
}

function tambahData (data,atas = false) { 
    let bentuk = bentukData;
    for(key of Object.keys(data)){
        if(bentuk.includes("${data." + key + "}")){
            bentuk = bentuk.replace(new RegExp(`\\$\\{data\\.${key}\\}`,"g"),XSS(data[key]));
        }
    }
    const isi = bentuk;
    containerData.innerHTML = atas ? isi + containerData.innerHTML : containerData.innerHTML + isi; 
}

function editData (id,value){
    const data = document.getElementById(`data${decodeURIComponent(id)}`); 
    const fieldEdit = data.querySelectorAll(".fieldEdit");
    for(field of fieldEdit){
        field.innerHTML = value[field.getAttribute("data-edit")]
    }
}

function hapusData (id){
    const data = document.getElementById(`data${decodeURIComponent(id)}`);
    containerData.removeChild(data);
}

function refreshData (){
    containerData.innerHTML = "";
    page = 1;
    pageLast = 0;
    if(!document.addEventListener("scroll",handleScroll)){
        document.addEventListener("scroll",handleScroll)
    }
    tampilkanData()
}

function handleScroll() {
    clearTimeout(timer); 
    timer = setTimeout(() => { 
      const windowHeight = window.innerHeight; 
      const fullHeight = document.body.scrollHeight; 
      const scrollOffset = document.documentElement.scrollTop;
      
      if (scrollOffset + windowHeight + 30 >= fullHeight) { 
        page++
        tampilkanData()
        checkEventScroll();
      }
    },500) // timer
}

function checkEventScroll(){
    if(page >= pageLast){
        document.removeEventListener("scroll",handleScroll);
    }
}

async function tampilkanData () {
    loading()
    const data = await setupData(`${window.location.href}?cari=${search}&page=${page}`);
    pageLast = data.last_page
    for(dt of data.data){
        tambahData(dt);
    }
    checkEventScroll();
    loading(false)
}