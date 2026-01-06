document.addEventListener("DOMContentLoaded", function () {
    const sidebar = new coreui.Sidebar(document.getElementById("sidebar"));

    document
        .getElementById("sidebarToggle")
        .addEventListener("click", function (e) {
            e.preventDefault();
            sidebar.toggle();
        });
});
