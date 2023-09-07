const buttonCari = document.querySelector("#buttonCari")
const cari = document.querySelector("#cari");
const formCari = document.querySelector("#formCari");
const inputCari = document.querySelector("#inputCari");
const closeModal = document.querySelector("#closeModal");
const containerData = document.querySelector("#containerData");
const modalBody = document.querySelector(".bodyModal");
const modalCreate = modalBody.innerHTML;
const formCreate = document.querySelector("#formCreate");

main()

buttonCari.addEventListener("click",() => cari.style.display = "block")

formCari.addEventListener("submit",(e) => {
    e.preventDefault();
    console.log(inputCari.value)
})

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
    console.log(e.target)

    if(e.target.getAttribute("data-bs-target")){
        const type = e.target.getAttribute("data-type");
        if(type == "create"){
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
    tampilkanData()
}

function modalLoading() {
    modalBody.innerHTML = `
    <div class="d-flex justify-content-center" >
        <div class="spinner-border text-dark" role="status">
    </div>
    `
}

function tambahData (data,atas = false) {
    const isi = `
    <div id="data${data.id}" class="data rounded col-md-10 my-1 bg-putih p-2 d-flex justify-content-between align-items-center">
        <h4>${data.name}</h4>
        <div>
            <button type="button"  data-bs-toggle="modal" data-bs-target="#createModal" data-type="edit" class="btn btn-primary fw-bold" data-id="${data.id}" ><i data-id="${data.id}" data-type="edit" data-bs-toggle="modal" data-bs-target="#createModal" class="bi bi-pencil-square"></i></button>
            <button type="button"  data-bs-toggle="modal" data-bs-target="#createModal" data-type="delete" class="btn btn-danger fw-bold" data-id="${data.id}" ><i data-id="${data.id}" data-type="delete" data-bs-toggle="modal" data-bs-target="#createModal" class="bi bi-trash"></i></button>
        </div>
    </div>
    `
    containerData.innerHTML = atas ? isi + containerData.innerHTML : containerData.innerHTML + isi;
}

function editData (id,value){
    const data = document.getElementById(`data${decodeURIComponent(id)}`);
    const h4 = data.querySelectorAll("h4")[0];
    h4.innerHTML = value;
}

function hapusData (id){
    const data = document.getElementById(`data${decodeURIComponent(id)}`);
    containerData.removeChild(data);
}

async function tampilkanData () {
    loading()
    const data = await setupData();
    for(dt of data){
        tambahData(dt);
    }
    loading(false)
}