function deleteme(delid)
{

    if (confirm("Do you want to confirm delete?"))
    {
        window.location.href = 'deleteTips.php?del_id='+delid+'';
        return true;

    }

}                