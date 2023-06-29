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

        console.log(mainMenuIcon);
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
    // console.log(clickedEL);
    // console.log(e);
})
// console.log(document.querySelectorAll('.btn'));