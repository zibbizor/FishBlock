function RenderNotification(msg, type){
    $.notify({
        // options
        message: msg
    },{
        // settings
        type: type
    });
};