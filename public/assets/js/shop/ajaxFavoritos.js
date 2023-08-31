document.addEventListener("DOMContentLoaded", () => {

    const items = [...document.querySelectorAll("[data-value]")];

    if (items.length > 0)
        items.forEach(x => x.addEventListener("click", () => { addItem(x.dataset["value"]); return false }));
});

//=====================================//
// Ajax que agrega un item a favoritos //
//=====================================//
function addItem(id) {
    const icon = document.getElementById("heart");
    const itemsQty = parseInt(icon.innerHTML);

    const url = "/shop/ajax/agregaFavorito";
    const parameters = "articulo_id=" + id;
    const promise = ajax(url, parameters);

    promise.then((data) => {
        if (data["success"]) {
            if (itemsQty < parseInt(data["data"]["itemQty"])) {
                icon.innerHTML = data["data"]["itemQty"];
            }
        }
    });
}