document.addEventListener("DOMContentLoaded", load, false);

function load()
{
    const buttons = [...document.querySelectorAll(".btn-danger")];
    if(buttons.length>0)
        buttons.forEach(x => x.addEventListener("click", function() { removeItem(x.value); return false }));
}

function removeItem(id)
{
    const url           = "/shop/ajax/eliminaFavorito";
    const parameters    = "articulo_id=" + id;
    const promise       = ajax(url,parameters);

    promise.then((data) => 
    {
        location.reload();
    });
}