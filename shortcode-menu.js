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
            // this.lastItem = "";
            // this.lastImg = "";

        }


        showMobileElements(){

            this.parent.each(function(e){
                $(this).on('click', function (){


                    // $(Menu.lastItem).each(function(){
                    //     $(this).css("display", "none")
                    // })
                    // $(Menu.lastImg).css("display", "none")

                    let dataId = '.child-mobile-' + $(this).data('id');


                    // console.log($('#megaMenu'))
                    // console.log($(dataId))

                    // let child = document.querySelector(dataId)
                    console.log(dataId)
                    console.log($(dataId))
                    $(dataId).show();
                    // $(dataId).each(function(){
                    //     $(this).css("display", "flex")
                    // })
                    // $('#megaMenu').find(".mobile-child").css("display", "flex")

                    // $(imgId).css("display", "flex")

                })



                //
                // $(this).on('mouseout', function (){
                //     console.log($(this).data('id'))
                //     // if($('.child-category:hover')){
                //         // return
                //     // }
                //
                //     let dataId = '#child-' + $(this).data('id');
                //     // let imgId = '#img-' + $(this).data('id');
                //
                //     // alert(imgId)
                //
                //     $(dataId).each(function(){
                //         $(this).css("display", "none")
                //     })
                //     // $(imgId).css("display", "none")
                // })


            })

        }

    }

    $( window ).load(function() {
        let initMenu = new Menu();
        let initMobileMenu = new MobileMenu();
    });






});
