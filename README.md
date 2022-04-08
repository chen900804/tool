# zvn 专用工具包
**使用方法**

---------
*  初始化使用方法

```
// 带网络请求的方法需要配置config.php
// 引入
use Zvn\Tool\Tool;
class 方法{
	$HttpTool = Tool::HttpTool();
	$HttpTool // 指向带网络的请求的方法	
	$Tool = Tool::Statics();
	$Tool    // 指向不带网络的方法
}
```


*  目前支持的不带网络请求方法
```
$Tool->createBase64Ewm() // 创建base64未二维码
$Tool->create_order() 	// 创建一个订单
$Tool->IntToFloat()    // 将分转换成元
$Tool->loatToInt()    // 将元转换成分
$Tool->getHideAccount() // 隐藏部分类容 支持手机和邮箱
$Tool->is_mobile() 	   //判断是否为手机号
$Tool->is_ip() 		  //验证不带端口IPV4
$Tool->is_sum 		 // 验证金额
```
* 目前支持的带网络的请求的方法
``` 
$HttpTool->SendSms()      // 塞邮发送短信验证码 
$HttpTool->getIpSite()   // 获取IP的城市 
$HttpTool->getIpWeather // 获取IP的城市天气 
```