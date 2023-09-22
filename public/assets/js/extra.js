let colors = Array.from(document.querySelectorAll(".size-filter li"));
// console.log(colors);
function removeAllActive() {
    colors.forEach(function (color) {
        color.classList.remove("active");
    });
}
// {{ csrf_token()

colors.forEach(function (color) {
    color.addEventListener("click", function () {
        removeAllActive();
        color.classList.toggle("active");
        var req = new XMLHttpRequest();
        req.onloadend = function () {
            // console.log("done");
        };
        req.open("POST", "http://127.0.0.1:8000/options");
        req.setRequestHeader(
            "Content-Type",
            "application/x-www-form-urlencoded"
        );
        req.setRequestHeader(
            "X-CSRF-TOKEN",
            document.querySelector("meta[name=token]").getAttribute("content")
        );
        let s = this.getAttribute("data-color");
        req.send(`size=` + s);
        console.log("done");
        // console.log(typeof size.firstChild.getAttribute("data-color"));
    });
});
