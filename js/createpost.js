$(document).ready(function(){

    $(document).on("change", "#imgImp", function(){

        readImg(this);
    })

    $(document).on("click", "#cancelbtn", function(){
        window.location.href = "post.php?page=1";
    })

    $(document).on("click", "#canceledit", function(){
        window.history.back();
    })

    $(document).on("click", "#backcreate", function(){
        window.history.back();
    })
})

function readImg(input)
{
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
          $('#preview').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]);

        $(".preimg").css("display", "block");
        $(".prelabel").css("display", "block");
      }
}