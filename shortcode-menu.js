jQuery(document).ready(function(){

    console.log('123')

    var $ = jQuery.noConflict();



        class Menu{

            constructor() {

                this.parent = $('#megaMenu .parent-category a');
                this.showElements();
                this.lastItem = "";

            }


            showElements(){

                this.parent.each(function(e){
                    $(this).on('mouseover', function (){


                        $(Menu.lastItem).each(function(){
                            $(this).css("display", "none")
                        })

                        let dataId = '#child-' + $(this).data('id');

                        Menu.lastItem = dataId;



                        $(dataId).each(function(){
                            $(this).css("display", "flex")
                        })


                    })




                        $(this).on('mouseout', function (){

                            if($('.child-category').is(':hover')){
                                return
                            }

                            let dataId = '#child-' + $(this).data('id');

                            $(dataId).each(function(){
                                $(this).css("display", "none")
                            })
                        })


                })

                }

            }


        let initMenu = new Menu();




});
