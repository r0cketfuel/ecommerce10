document.addEventListener("DOMContentLoaded", () => {

    const tiles = document.querySelectorAll("div.tile:not(.main)");
    tiles.forEach(tile => tile.addEventListener("click", () => { imageGrid(tile); return false; }));

    const maxSlide = tiles.length - 1;
    let curSlide = 0;

    const nextSlide = document.querySelector(".btn-next");
    if (nextSlide)
        nextSlide.addEventListener("click", () => { curSlide = curSlide === maxSlide ? 0 : curSlide + 1; imageGrid(tiles[curSlide]); });

    const prevSlide = document.querySelector(".btn-prev");
    if (prevSlide)
        prevSlide.addEventListener("click", () => { curSlide = curSlide === 0 ? maxSlide : curSlide - 1; imageGrid(tiles[curSlide]); });

    //==================================//
    // CARGA LAS MINIATURAS EN EL VISOR //
    //==================================//
    function imageGrid(tile) {
        curSlide = Array.from(tiles).indexOf(tile);
    
        const tileMainPicture = document.querySelector(".tile.main");
        const tileActive = document.querySelector(".tile.active");
        const tileClicked = tile.children[0];
    
        tileActive.classList.remove("active");
        tile.classList.add("active");
    
        const tileClickedHref = tileClicked.currentSrc.replace("thumbs/", "");
    
        tileMainPicture.children[0].children[0].src = tileClicked.currentSrc;
        tileMainPicture.children[0].href = tileClickedHref;
    }
});
