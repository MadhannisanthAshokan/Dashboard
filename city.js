$('.allcity').click(function(){
    var cityid=$(this).attr("data-cityid");
    var details={
        'cityid':cityid
    };
    $.ajax({
        type:'POST',
        url:'city.php',
        data:details,
        success:function(datas){
            window.location.href='student.php';
        }
    })
});