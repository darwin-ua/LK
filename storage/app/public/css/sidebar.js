document.addEventListener("DOMContentLoaded", function () {
    var currentUrl = window.location.pathname;

    function setActiveMenuItem(menuItemId) {
        var menuItem = document.getElementById(menuItemId);
        if (menuItem) {
            menuItem.classList.add('active');
        }
    }

    function setMenuActiveOnClick(menuItemId) {
        var menuItem = document.getElementById(menuItemId);
        if (menuItem) {
            menuItem.addEventListener('click', function () {
                var menuItems = document.querySelectorAll('.nav-item .nav-link');
                menuItems.forEach(function (item) {
                    item.classList.remove('active');
                });
                menuItem.classList.add('active');
            });
        }
    }

    if (currentUrl.includes("/admin/payments/all")) {

        var eventsMenu = document.getElementById('pay');
        if (eventsMenu) {
            eventsMenu.classList.add('menu-is-opening', 'menu-open');
        }
        setActiveMenuItem('payment_all');
        setMenuActiveOnClick('payment_all');
    }

    if (currentUrl.includes("/admin/payments/create")) {

        var eventsMenu = document.getElementById('pay');
        if (eventsMenu) {
            eventsMenu.classList.add('menu-is-opening', 'menu-open');
        }
        setActiveMenuItem('payment_create');
        setMenuActiveOnClick('payment_create');
    }

    if (currentUrl.includes("/admin/users/all")) {

        var eventsMenu = document.getElementById('users');
        if (eventsMenu) {
            eventsMenu.classList.add('menu-is-opening', 'menu-open');
        }
        setActiveMenuItem('users_all');
        setMenuActiveOnClick('users_all');
    }

    if (currentUrl.includes("/admin/users/create")) {

        var eventsMenu = document.getElementById('users');
        if (eventsMenu) {
            eventsMenu.classList.add('menu-is-opening', 'menu-open');
        }
        setActiveMenuItem('users_create');
        setMenuActiveOnClick('users_create');
    }

    if (currentUrl.includes("/edit")) {
        var eventsMenu = document.getElementById('events');
        if (eventsMenu) {
            eventsMenu.classList.add('menu-is-opening', 'menu-open');
        }
        setActiveMenuItem('event_settings');
        setMenuActiveOnClick('event_settings');
    }
    if (currentUrl.includes("/admin/events/settings")) {

        var eventsMenu = document.getElementById('events');
        if (eventsMenu) {
            eventsMenu.classList.add('menu-is-opening', 'menu-open');
        }
        setActiveMenuItem('event_settings');
        setMenuActiveOnClick('event_settings');
    }

    if (currentUrl.includes("/admin/events/create")) {

        var eventsMenu = document.getElementById('events');
        if (eventsMenu) {
            eventsMenu.classList.add('menu-is-opening', 'menu-open');
        }
        setActiveMenuItem('event_create');
        setMenuActiveOnClick('event_create');
    }

    if (currentUrl.includes("/admin/events/all")) {
        var eventsMenu = document.getElementById('events');
        if (eventsMenu) {
            eventsMenu.classList.add('menu-is-opening', 'menu-open');
        }
        setActiveMenuItem('event_all');
        setMenuActiveOnClick('event_all');
    }
    if (currentUrl.includes("/admin/events/stats")) {
        var eventsMenu = document.getElementById('events');
        if (eventsMenu) {
            eventsMenu.classList.add('menu-is-opening', 'menu-open');
        }
        setActiveMenuItem('event_stats');
        setMenuActiveOnClick('event_stats');
    }
    if (currentUrl.includes("/admin/shedules/all")) {
        var sheduleMenu = document.getElementById('shedule');
        if (sheduleMenu) {
            sheduleMenu.classList.add('menu-is-opening', 'menu-open');
        }
        setActiveMenuItem('shedule_all');
        setMenuActiveOnClick('shedule_all');
    }
    if (currentUrl.includes("/admin/shedule")) {
        var sheduleMenu = document.getElementById('shedule');
        if (sheduleMenu) {
            sheduleMenu.classList.add('menu-is-opening', 'menu-open');
        }
        if (currentUrl === "/admin/shedules/create") {
            setActiveMenuItem('shedule_create');
        }
        if (currentUrl === "/admin/shedules/settings") {
            setActiveMenuItem('shedule_settings');
        }
    }
    if (currentUrl.includes("/admin/orders")) {

        var sheduleMenu = document.getElementById('orders');
        if (sheduleMenu) {
            sheduleMenu.classList.add('menu-is-opening', 'menu-open');
        }
        if (currentUrl === "/admin/orders/all") {
            setActiveMenuItem('order_all');
        }
        if (currentUrl === "/admin/orders/create") {
            setActiveMenuItem('order_create');
        }
        if (currentUrl === "/admin/orders/stats") {
            setActiveMenuItem('order_stats');
        }
    }


    setMenuActiveOnClick('menu_statistic');
});

    $(function () {
    // Summernote
    $('#summernote').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
    mode: "htmlmixed",
    theme: "monokai"
});
})

    document.addEventListener("DOMContentLoaded", function () {
    const fileInputTitle = document.getElementById("foto_title");
    const fileInputLabelTitle = document.getElementById("fileInputLabelTitle");
    const fileInputLogo = document.getElementById("foto_logo");
    const fileInputLabelLogo = document.getElementById("fileInputLabelLogo");

    fileInputTitle.addEventListener("change", function () {
    if (fileInputTitle.files.length > 0) {
    fileInputLabelTitle.textContent = fileInputTitle.files[0].name;
} else {
    fileInputLabelTitle.textContent = "Нажмите здесь для выбора файла";
}
});

    fileInputLogo.addEventListener("change", function () {
    if (fileInputLogo.files.length > 0) {
    fileInputLabelLogo.textContent = fileInputLogo.files[0].name;
} else {
    fileInputLabelLogo.textContent = "Нажмите здесь для выбора файла";
}
});
});
document.addEventListener("DOMContentLoaded", function () {
    const fileInputTitle = document.getElementById("foto_title");
    const fileInputLabelTitle = document.getElementById("fileInputLabelTitle");
    const fileInputLogo = document.getElementById("foto_logo");
    const fileInputLabelLogo = document.getElementById("fileInputLabelLogo");

    fileInputTitle.addEventListener("change", function () {
        if (fileInputTitle.files.length > 0) {
            fileInputLabelTitle.textContent = fileInputTitle.files[0].name;
        } else {
            fileInputLabelTitle.textContent = "Нажмите здесь для выбора файла";
        }
    });

    fileInputLogo.addEventListener("change", function () {
        if (fileInputLogo.files.length > 0) {
            fileInputLabelLogo.textContent = fileInputLogo.files[0].name;
        } else {
            fileInputLabelLogo.textContent = "Нажмите здесь для выбора файла";
        }
    });
});
