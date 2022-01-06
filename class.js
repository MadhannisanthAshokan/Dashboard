$('.allstudent').click(function(){
    var classid= $(this).attr("data-classid");
    var details={
        'classid':classid
    };
    console.log(classid)
    $.ajax({
        type:'POST',
        url:'class.php',
        data:details,
        success:function(datas){
            window.location.href='student.php';
        }
    })
});