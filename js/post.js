$(document).ready(function(){

    if(localStorage.getItem('success') != null)
    {
        $("#mypopup").css("display", "block");
        window.localStorage.clear();
    }

    $(document).on("click", "#close", function(){
        $("#mypopup").css("display", "none");
    })

    $(document).on("click", "#postproceed", function(){
        $("#mypopup").css("display", "none");
    })


    $('div.click').click(function()
    {
        var id = $(this).attr("data-id");
         window.location.href = "viewpost.php?id="+id;
    })

    $(document).on('click','#createPost',function(){
        window.location.href = "createPost.php";
    })

    $(document).on('click','#gologin',function(){
        window.location.href = "login.php";
    })

   

    activePage();
  
})

function activePage()
{
    var current_page_URL = location.href;

    $('.addressClick').each(function(){
        var target = $(this).prop("href");
        if (target == current_page_URL)
        {
            $(this).addClass('active');
            return false;
        }
    })
}

