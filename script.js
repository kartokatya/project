	 $(function () {
                $(document).on('submit','#log',function () {
                    var url = $(this).attr('action');
                    var data = $(this).serializeArray();
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: data,
                        success: function(msg){
                            $('#log').html(msg);
                        }
                    });
                    return false;
                });

});
	 $(function () {
                $(document).on('submit','#registr',function () {
                    var url = $(this).attr('action');
                    var data = $(this).serializeArray();
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: data,
                        success: function(msg){
                            $('#registr').html(msg);
                        }
                    });
                    return false;
                });

});