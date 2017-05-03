/**
 * Created by Thilan K Bandara on 3/29/2017.
 */
var postId=0;
var postBodyElement=null;

$(document).ready(function(){
    $('.post').find('.interaction').find('.edit').on('click',function () {///////////////
        // console.log("OOOOOOOOOOOOOOOO");
        event.preventDefault()///////////
        postBodyElement =event.target.parentNode.parentNode.childNodes[1];
        var postbody=postBodyElement.textContent;////////////
        postId=event.target.parentNode.parentNode.dataset['postid'];//////////////

        $('#post-body').val(postbody);//////////
        $('#edit-modal').modal();////////////
    });

    $('#modal-save').on('click',function () {
        $.ajax({
            method:'POST',
            url:url,
            data:{body: $('#post-body').val(),postId:postId, _token:token}
        })
            .done(function (msg) {
                $(postBodyElement).text(msg['new_body']);
                $('#edit-modal').modal('hide')
                // console.log(msg['message']);
            }).fail(function (err) {
            console.log(err);
        });

    });
});


