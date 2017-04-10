// codding=utf-8

/*
 * 功能：一段时间后跳转某个url
 * 作者：liteng
 * url:要跳转的url
 * time：等待的时间（毫秒）
 */
function navigate(url, time) {
	if (time == 0) {
		window.location = url;
		return;
	}
	setTimeout("navigate('" + url + "',0);", time);
}