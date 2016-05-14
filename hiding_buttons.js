function custom_print() {
    var print_button = document.getElementById("print_button");
    var logout_button = document.getElementById("logout");

    logout.style.display = "none";
    print_button.style.display = "none";
    window.print();
    logout.style.display = "block";
    print_button.style.display = "block";
}