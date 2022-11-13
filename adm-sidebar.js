function dynamicSidebarMenu(pageName) {
    var elmnt = document.getElementsByClassName("dynamicSidebarMenu");

    if (pageName === "Home") {
        elmnt[0].style.backgroundColor = "#151515";
    }
    else if (pageName === "Accounts"){
        elmnt[1].style.backgroundColor = "#151515";
    }
    else if (pageName === "Items"){
        elmnt[2].style.backgroundColor = "#151515";
    }
    else if (pageName === "History"){
        elmnt[3].style.backgroundColor = "#151515";
    }
};