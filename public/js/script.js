function  getdata(id) {
    jQuery.ajax({
        method:'post',
        url: '/basket/fakeAdd?id=' + id,
        success: function (response) {
            console.log(response);
        }
    })
}