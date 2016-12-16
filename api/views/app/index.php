window.apiready = function () {
// 告诉客户端, 网络连接成功
window.app_update_init = true;

// app入口页面
api.setPrefs({
key: 'app_start_page',
value: 'widget://index.html'
});

// 跨境通入口页面
api.setPrefs({
key: 'woodinglobal_start_page',
value: 'widget://html/woodinglobal.html'
});

// 赏金任务入口页面
api.setPrefs({
key: 'task_start_page',
value: ''
});

// 审核模式, 上线后改为off
api.setPrefs({
key: 'app_examine_status',
value: 'off'  // on | off
});

// 启动入口页面
api.openWin({
name: 'root',
url: 'widget://index.html'
});
};
