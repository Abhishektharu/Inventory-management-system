var hamburger= document.querySelector(".hamburger");
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


        
        //check if there is submenu
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
    }

})

