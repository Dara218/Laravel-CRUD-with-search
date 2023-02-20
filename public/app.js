$(document).ready(function(){
    $('.edit-post').on('click', function(e){
        e.preventDefault();
        const overlay = $('.overlay')
        const postValue = $(this).data('post-value')

        const postModal = $('.post-modal')
        const postValuePop = $('.form-control')

        postValuePop.val(postValue)

        postModal.slideDown();
        overlay.show()

        $('.fa-x').on('click', function(){
            postModal.slideUp()
            overlay.hide()
        })
    })

    $('.overlay').on('click', function() {
        $('.post-modal').slideUp();
        $(this).hide();
    });
})
