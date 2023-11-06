import "./bootstrap";
var channel = Echo.private(`Admin.${User_id}`);
channel.notification(function (data) {
    Livewire.emit("notify", data);
});
