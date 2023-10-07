let input = document.getElementById("inputCity");
// console.log(input);
input.addEventListener("change", function () {
    let ele = document.getElementById("sec");
    let color = ntc.name(this.value);
    ele.value = color[1];
    // console.log(color);
    // console.log(document.getElementById("sec").value);
});
