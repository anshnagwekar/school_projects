function HideFiles(selector)
{
    //show all files
    if(selector === "All files")
    {
        $("#files > li").show();
        return true;
    }
    else
    {
        //show only the selected filetype
        $("#files > li").hide();
        $("#files > li." + selector).show();
        return true;
    }   
}

function prepareMenu()
{ 
    $("#menu li").click( 
        function () {            
            $("#menu li").each(
                function(){
                    $(this).removeClass("active");
                }
            );
            $(this).addClass("active");
            HideFiles($(this).children().html());
        return false;
    });
 
    //Select the first as default
    $("#menu li:first").click();
}

$(document).ready(function()
{
    prepareMenu();
});