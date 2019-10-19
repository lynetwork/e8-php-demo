<!DOCTYPE html>

<html>
<head runat="server">
     <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   
    <title>E8PAY-DEMO</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>
    <![endif]-->

    <style>
        input {
            padding：2px 8px 0pt 3px;
            /*height:18px;*/
            border：1px solid #999;
            background-color: #f5eeee;
        }

        body {
            /*text-align：center;*/
            font-family：Georgia;
            FILTER：Alpha( style=1,opacity=25,finishOpacity=100, startX=50,finishX= 100,startY=50,finishY=100);
            background-color： #fff;
        }
    </style>
</head>
<body style="background-color:#FFFFFF">  


     <div class="container" style="padding: 30px;">

        <div class="row">

            <div class="form-group">
                <div class="col-sm-12 text-center">
                    <h1>E8专业支付DEMO PHP版本</h1>
                    <p>-------------------------------------------------------</p>
                    
                    <h2>调用付款接口,构造以下表格</h2>

                </div>
            </div>

            <form class="form-horizontal" role="form" action="request.php" method="POST">
                <div class="form-group">
                    <label for="lastname" class="col-sm-2 control-label">商户号：</label>
                    <div class="col-sm-10">
                        <input type="text" name="parter" id="parter" class="form-control" value="请前往配置文件修改" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="lastname" class="col-sm-2 control-label">商户密钥：</label>
                    <div class="col-sm-10">
                        <input type="text" name="key" id="key" class="form-control" value="请前往配置文件修改" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="lastname" class="col-sm-2 control-label">订单号：</label>
                    <div class="col-sm-10">
                        <input size="30" type="text" name="ly_order_no" id="inp_orderno" value="随机生成商户可根据自己需求生成" class="form-control" />
                    </div>
                </div>


                <div class="form-group">
                    <label for="lastname" class="col-sm-2 control-label">金&nbsp;&nbsp;额(以分为单位)：</label>
                    <div class="col-sm-10">
                        <input size="30" type="text" name="ly_money" id="inp_price" value="100" class="form-control" />
                    </div>
                </div>



                 <div class="form-group">
                    <label for="lastname" class="col-sm-2 control-label">支付方式：</label>
                    <div class="col-sm-10">
                        <select name="ly_trade_type" class="form-control">
                            <option value="pay_alipay_code">支付宝扫码</option>
                            <option value="pay_alipay_gatewaycode">支付宝网关</option>
                            <option value="pay_alipay_h5code">支付宝H5</option>
                            <option value="pay_alipay_appcode">支付宝APP</option>
                            <option value="pay_wxpay_code">微信扫码</option>
                            <option value="pay_wxpay_h5code">微信H5</option>
                            <option value="pay_wxpay_jsapicode">微信公众号</option>
                            <option value="pay_wxpay_appcode">微信APP</option>
                            <option value="pay_wxpay_appletcode">微信小程序</option>
                            <option value="pay_qpay_code" selected="selected">QQ钱包扫码</option>
                            <option value="pay_qpay_h5code">QQ钱包H5</option>
                            <option value="pay_qpay_jsapicode">QQ钱包公众号</option>
                            <option value="pay_qpay_appcode">QQ钱包APP</option>
                            <option value="pay_tenpay_code">财付通</option>
                            <option value="pay_bank_code">网银</option>
                            <option value="pay_bank_h5code">网银H5</option>
                    </select>
                    </div>
                </div>                         


                <div class="form-group">
                    <label for="lastname" class="col-sm-2 control-label">同步返回地址：</label>
                    <div class="col-sm-10">
                        <input size="50" type="text" name="ly_return_url" id="inp_RecefiveUrl" class="form-control" value="<?php echo 'http://'.$_SERVER['SERVER_ADDR'].':'.$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI']; ?>return_url.php" />
                    </div>
                </div>


                 <div class="form-group">
                    <label for="lastname" class="col-sm-2 control-label">异步返回地址： </label>
                    <div class="col-sm-10">
                        <input size="50" type="text" name="ly_notify_url" id="inp_NotifyUrl" value="<?php echo 'http://'.$_SERVER['SERVER_ADDR'].':'.$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI']; ?>notify_url.php" class="form-control" />
                    </div>
                </div>               


                <div class="form-group">
                    <label for="lastname" class="col-sm-2 control-label">商户订单备注：</label>
                    <div class="col-sm-10">
                        <input size="50" type="text" name="ly_notes" id="remark" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="lastname" class="col-sm-2 control-label">商户订单描述：</label>
                    <div class="col-sm-10">
                        <input size="50" type="text" name="ly_body" id="remark" class="form-control" value="订单测试" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="lastname" class="col-sm-2 control-label">订单支付加密方式：</label>
                    <div class="col-sm-10">
                        <select name="ly_sign_type" class="form-control">
                            <option value="RSA2" selected="selected">RSA2</option>
                        </select>
                    </div>
                </div>


                <div class="form-group">
                    <label for="lastname" class="col-sm-2 control-label">是否直反二维码：</label>
                    <div class="col-sm-10">
                        <select name="ly_scan_code" class="form-control">
                            <option value="true">是</option>
                            <option value="false" selected="selected">否</option>
                        </select>
                    </div>
                </div>



                 <div class="form-group">
                    <label for="lastname" class="col-sm-2 control-label">是否同步到商户成功页面：</label>
                    <div class="col-sm-10">
                         <select name="ly_skip_not_page" class="form-control">
                        <option value="true">是</option>
                        <option value="false" selected="selected">否</option>
                    </select>
                    </div>
                </div>
               

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-lg btn-danger">点我提交付款</button>
                    </div>
                </div>

            </form>          

        </div>


    </div>


    <!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@1.12.4/dist/jquery.min.js"></script>
    <!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>

</body>
</html>
