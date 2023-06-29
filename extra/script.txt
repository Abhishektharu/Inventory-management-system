var hamburger = document.querySelector(".hamburger");
hamburger.addEventListener("click", function() {
    document.querySelector("body").classList.toggle("active");
})


// submenu show /hide function
document.addEventListener('click', function(e){
    let clickedEL = e.target;

    if(clickedEL.classList.contains('showHideSubMenu')){
        // alert('main menu');
        // console.log();

        let subMenu = clickedEL.closest('li').querySelector('.subMenus')
        let mainMenuIcon = clickedEL.closest('li').querySelector('.mainMenuIconArrow')


        //close all submenus except current;
        let subMenus = document.querySelectorAll('.subMenus');
        subMenus.forEach((sub) => {
            if(subMenu !== sub){
                sub.style.display = 'none';
            }
        });


    }
    // console.log(clickedEL);
    // console.log(e);
})

//function - to show/hide submenu
function showHideSubMenu(subMenu,mainMenuIcon){
            // console.log(mainMenuIcon);
        //logic to list view users and add users style.display = 'block';
        if(subMenu != null){
            if(subMenu.style.display === 'block'){
                subMenu.style.display = 'none';
                mainMenuIcon.classList.remove('fa-angle-down');
                mainMenuIcon.classList.add('fa-angle-left');

            }
            else{
                subMenu.style.display = 'block';
                mainMenuIcon.classList.remove('fa-angle-left');
                mainMenuIcon.classList.add('fa-angle-down');
            }
        }
        // console.log(targetMenu);
}
// console.log(document.querySelectorAll('.btn'));


//add / hide active class to menu
//get the current page
// use selector to get the current menu or submenu
// add the active class

let pathArray = window.location.pathname.split('/');
let curFile = pathArray[pathArray.length - 1];

let curNav = document.querySelector('a[href="./' + curFile + '"]');
curNav.classList.add('subMenuActive');

let mainNav = curNav.closest('li.liMainMenu');
//active menu color;
mainNav.style.background = 'red';

let subMenu = curNav.closest('.subMenus');
let mainMenuIcon = mainNav.querySelector('i.mainMenuIconArrow');

console.log(mainMenuIcon);

// call the function show / hide
showHideSubMenu(subMenu, mainMenuIcon);
// console.log(mainNav);
// console.log(curNav);