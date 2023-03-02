jQuery(document).ready(function(){


    var $ = jQuery.noConflict();


        class Menu{

            constructor() {

                this.parent = $('.megaMenu .desktop-mega-menu .parent-category a');
                this.showElements();
                this.lastItem = "";
                this.lastImg = "";

            }


            showElements(){

                this.parent.each(function(e){
                    $(this).on('mouseover', function (){

                        $(this).addClass("menu-hover")

                        $(Menu.lastItem).each(function(){
                            $(this).css("display", "none")
                        })
                        $(Menu.lastImg).css("display", "none")

                        let dataId = '#child-' + $(this).data('id');
                        let imgId = '#img-' + $(this).data('id');

                        Menu.lastItem = dataId;
                        Menu.lastImg= imgId;



                        $(dataId).each(function(){
                            $(this).css("display", "flex")
                        })

                        $(imgId).css("display", "flex")

                    })



                        $(this).on('mouseout', function (){

                            if($('.child-category:hover')){
                                return
                            }
                            $(this).removeClass("menu-hover")
                            let dataId = '#child-' + $(this).data('id');
                            let imgId = '#img-' + $(this).data('id');


                            $(dataId).each(function(){
                                $(this).css("display", "none")

                            })
                            $(imgId).css("display", "none")
                        })


                })

                }

            }

        class MobileMenu{

        constructor() {

            this.parent = $('.megaMenu .mobile-mega-menu .parent-category a');
            this.showMobileElements();
            this.showMobileElements1();

        }


            showMobileElements(){

                this.parent.each(function(e){
                    $(this).on('click', function (){




                        let dataId = '.child-mobile-' + $(this).data('id');
                        let arrowId = '.arrow-' + $(this).data('id');




                        $(dataId).slideToggle(500)
                        $(arrowId).toggleClass('rotate-arrow')






                        // $(this).on('click', function (){
                        //
                        //
                        //     let dataId = '#child-' + $(this).data('id');
                        //
                        //
                        //     $(dataId).css("display", "flex")
                        //
                        //
                        // })

                    })







                })

            }

            showMobileElements1(){

                $('#menu-main-1 li').each(function(e){

                    let container =  $(this).find('.elementskit-megamenu-panel .elementor-container')
                    let img =  $(this).find(' i.elementskit-submenu-indicator')


                    $(this).find(' a.ekit-menu-nav-link').on('click', function (){

                        console.log(img)
                        $(img).toggleClass('rotate-arrow1')
                        container.slideToggle(500);

                        // let dataId = '.child-mobile-' + $(this).data('id');




                        // $(dataId).toggle(500)/






                        // $(this).on('click', function (){
                        //
                        //
                        //     let dataId = '#child-' + $(this).data('id');
                        //
                        //
                        //     $(dataId).css("display", "flex")
                        //
                        //
                        // })

                    })



                })

            }

    }

    $( window ).load(function() {
        let initMenu = new Menu();
        let initMobileMenu = new MobileMenu();
    });






});
