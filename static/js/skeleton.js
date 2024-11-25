const themeCookieName = 'theme';
const themeDark = 'dark';
const themeLight = 'light';

const body = document.getElementsByTagName('body')[0];

// Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    // Initialize theme
    loadTheme();
    
    // Initialize profile dropdown
    const dropdownToggle = document.querySelector('.dropdown-toggle');
    const dropdownMenu = document.getElementById('user-menu');
    
    if (dropdownToggle && dropdownMenu) {
        dropdownToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            dropdownMenu.classList.toggle('show');
        });
        
        document.addEventListener('click', function(e) {
            if (!dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.remove('show');
            }
        });
    }
});

function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    const expires = "expires=" + d.toUTCString();
    document.cookie = cname + '=' + cvalue + ';' + expires + ';path=/';
}  

function getCookie(cname) {
    const name = cname + '=';
    const ca = document.cookie.split(';');
    for(let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while(c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if(c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function loadTheme() {
    const theme = getCookie(themeCookieName);
    body.classList.add(theme === "" ? themeLight : theme);
}

function switchTheme() {
    if(body.classList.contains(themeLight)) {
        body.classList.remove(themeLight);
        body.classList.add(themeDark);
        setCookie(themeCookieName, themeDark);
    } else {
        body.classList.remove(themeDark);
        body.classList.add(themeLight);
        setCookie(themeCookieName, themeLight);
    }
}

function collapseSidebar() {
    const sidebar = document.querySelector('.sidebar');
    if (sidebar) {
        sidebar.classList.toggle('active');
    }
    body.classList.toggle('sidebar-expand');
}

// Dropdown functionality
function closeAllDropdown() {
    const dropdowns = document.getElementsByClassName('dropdown-expand');
    for(let i = 0; i < dropdowns.length; i++) {
        dropdowns[i].classList.remove('dropdown-expand');
    }
}

function openCloseDropdown(event) {
    if (!event.target.matches('.dropdown-toggle')) {
        closeAllDropdown();
    } else {
        const toggle = event.target.dataset.toggle;
        const content = document.getElementById(toggle);
        if (content.classList.contains('dropdown-expand')) {
            closeAllDropdown();
        } else {
            closeAllDropdown();
            content.classList.add('dropdown-expand');
        }
    }
}

// Expense menu toggle
function open1() {
    const val = document.getElementById('Expense');
    const sib1 = val.nextElementSibling;
    const sib2 = sib1.nextElementSibling;
    
    if(val.classList.length === 1) {
        val.classList.add("open");
        sib1.outerHTML = `<li class="sidebar-nav-item">
                            <a href="5-Add-Expenses.php" class="sidebar-nav-link">
                                <div>
                                <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                </div>
                                <span>
                                    Add Expenses
                                </span>
                            </a>
                        </li>`;
        sib2.outerHTML = `<li class="sidebar-nav-item">
                            <a href="6-Manage-Expenses.php" class="sidebar-nav-link">
                                <div>
                                <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                </div>
                                <span>
                                    Manage Expenses
                                </span>
                            </a>
                        </li>`;
    } else {
        val.classList.remove("open");
        sib1.outerHTML = `<li class="sidebar-nav-item" style="display: none">
                            <a href="5-Add-Expenses.php" class="sidebar-nav-link">
                                <div>
                                <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                </div>
                                <span>
                                    Add Expenses
                                </span>
                            </a>
                        </li>`;
        sib2.outerHTML = `<li class="sidebar-nav-item">
                            <a href="6-Manage-Expenses.php" class="sidebar-nav-link" style="display: none">
                                <div>
                                <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                </div>
                                <span>
                                    Manage Expenses
                                </span>
                            </a>
                        </li>`;
    }
}

// Report menu toggle
function open2() {
    const val = document.getElementById('ER');
    const sib1 = val.nextElementSibling;
    const sib2 = sib1.nextElementSibling;
    const sib3 = sib2.nextElementSibling;
    
    if(val.classList.length === 1) {
        val.classList.add("open");
        sib1.outerHTML = `<li class="sidebar-nav-item">
                            <a href="7-Datewise.php" class="sidebar-nav-link">
                                <div>
                                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                </div>
                                <span>
                                    Datewise Report
                                </span>
                            </a>
                        </li>`;
        sib2.outerHTML = `<li class="sidebar-nav-item">
                            <a href="8-Monthly.php" class="sidebar-nav-link">
                                <div>
                                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                </div>
                                <span>
                                    Monthly Report
                                </span>
                            </a>
                        </li>`;
        sib3.outerHTML = `<li class="sidebar-nav-item">
                            <a href="9-Yearly.php" class="sidebar-nav-link">
                                <div>
                                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                </div>
                                <span>
                                    Yearly Report
                                </span>
                            </a>
                        </li>`;
    } else {
        val.classList.remove("open");
        sib1.outerHTML = `<li class="sidebar-nav-item" style="display:none;">
                            <a href="7-Datewise.php" class="sidebar-nav-link">
                                <div>
                                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                </div>
                                <span>
                                    Datewise Report
                                </span>
                            </a>
                        </li>`;
        sib2.outerHTML = `<li class="sidebar-nav-item" style="display: none;">
                            <a href="8-Monthly.php" class="sidebar-nav-link">
                                <div>
                                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                </div>
                                <span>
                                    Monthly Report
                                </span>
                            </a>
                        </li>`;
        sib3.outerHTML = `<li class="sidebar-nav-item" style="display:none;">
                            <a href="9-Yearly.php" class="sidebar-nav-link">
                                <div>
                                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                </div>
                                <span>
                                    Yearly Report
                                </span>
                            </a>
                        </li>`;
    }
}