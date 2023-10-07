document
    .getElementById("photo-category")
    .addEventListener("click", function (e) {
        e.preventDefault();
        document.getElementById("photo-input").click();
    });
let btn = document.getElementById("add");
let counter = 0;
let once = 0;
window.onload = function () {
    if (c > 0) {
        for (let index = 0; index < c; index++) {
            btn.click();
        }
    }
};
let arr_options = [];
let html_add = `
<div class="form-group col-md-3">
    <label for="inputCity">Color</label>
    <input type="color" class="form-control" name="option[]" id="inputCity">
</div>
<div class="form-group col-md-3">
    <label for="inputZip">Quantity</label>
    <input type="number" name="option[]" class="form-control" min="1" max="100">
</div>
<div class="form-group col-md-5">
    <label for="inputState">Size</label>
    <select id="inputState" name="option[]" class="form-control">
        <option value="">Choose...</option>
        <option value="S">Small</option>
        <option value="M">Medium</option>
        <option value="L">Large</option>
        <option value="XL">X-Large</option>
        <option value="XXL">XX-Large</option>
    </select>
</div>`;
let div = document.getElementById("divbtn");
btn.addEventListener("click", function () {
    counter += 1;
    if (counter <= 24) {
        let ele = document.createElement("div");
        ele.classList.add("form-row");
        ele.style.marginTop = "10px";
        ele.innerHTML = html_add;
        div.append(ele);
    } else {
        if (once == 0) {
            let ele = document.createElement("p");
            ele.style.color = "red";
            ele.textContent = `This is Max of Options !!`;
            btn.after(ele);
            once = 1;
        }
    }
});
document.getElementById("inputCity").addEventListener("change", function () {
    let ele = document.getElementById("sec");
    let color = ntc.name(this.value);
    ele.value = color[1];
    console.log(color);
    console.log(document.getElementById("sec").value);
});
