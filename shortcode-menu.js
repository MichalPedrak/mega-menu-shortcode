jQuery(document).ready(function(){

    console.log('1222222223')

    var $ = jQuery.noConflict();



        class Menu{

            constructor() {

                this.parent = $('#megaMenu .parent-category a');
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
                            console.log($(this).data('id'))
                            if($('.child-category:hover')){
                                return
                            }

                            let dataId = '#child-' + $(this).data('id');
                            let imgId = '#img-' + $(this).data('id');

                            alert(imgId)

                            $(dataId).each(function(){
                                $(this).css("display", "none")
                            })
                            $(imgId).css("display", "none")
                        })


                })

                }

            }


        let initMenu = new Menu();




});
