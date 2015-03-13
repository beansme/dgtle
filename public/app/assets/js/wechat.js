var dataForWeixin = {
    imgUrl: "",
    title: "",
    link: rootUrl + '',
    desc: "",
    success: function(res) {},
    cancel: function(res){}
};

wx.ready(function(){
    wx.onMenuShareTimeline({
        title: dataForWeixin.title,
        link: dataForWeixin.link,
        imgUrl: dataForWeixin.imgUrl,
        success: dataForWeixin.success,
        cancel: dataForWeixin.cancel
    });
    wx.onMenuShareAppMessage({
        title: dataForWeixin.title,
        link: dataForWeixin.link,
        desc: dataForWeixin.desc,
        imgUrl: dataForWeixin.imgUrl,
        success: dataForWeixin.success,
        cancel: dataForWeixin.cancel
    });
});