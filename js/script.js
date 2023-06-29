var hamburger = document.querySelector(".hamburger");
hamburger.addEventListener("click", function() {
    document.querySelector("body").classList.toggle("active");
})


// submenu show /hide function
document.addEventListener('click', function(e){
    let clickedEL = e.target;
    if(clickedEL.classList.contains('showHideSubMenu')){
        // alert('main menu');
        let targetMenu = clickedEL.dataset.submenu;

        //logic to list view users and add users style.display = 'block';
        if(targetMenu != undefined){
            let subMenu = document.getElementById(targetMenu);
            if(subMenu.style.display === 'block'){
                subMenu.style.display = 'none';
            }
            else{
                subMenu.style.display = 'block';
            }
        }
        // console.log(targetMenu);

    }
    // console.log(clickedEL);
    // console.log(e);
})
// console.log(document.querySelectorAll('.btn'));