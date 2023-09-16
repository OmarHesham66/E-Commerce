let sizes = Array.from(document.querySelectorAll(".color-filter li"));
// console.log(sizes);
function removeAllActive() {
    sizes.forEach(function (size) {
        size.classList.remove("active");
    });
}
// {{ csrf_token()

sizes.forEach(function (size) {
    size.addEventListener("click", function () {
        removeAllActive();
        size.classList.toggle("active");
        var req = new XMLHttpRequest();
        req.onloadend = function () {};
        req.open("POST", "http://127.0.0.1:8000/options");
        req.setRequestHeader(
            "Content-Type",
            "application/x-www-form-urlencoded"
        );
        let s = size.firstChild.getAttribute("data-color");
        req.send(`size=` + s);
        // console.log(typeof size.firstChild.getAttribute("data-color"));
    });
});
