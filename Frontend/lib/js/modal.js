function togglePopup(){
    document.getElementById("popup-overlay").classList.toggle("active");
}

document.getElementById("close").addEventListener("click", function(){
    togglePopup();
});

document.getElementById("openModalBtn").addEventListener("click", function(){
    togglePopup();
});
