<?php
class Config{
    private $cfg = array(
        'ly_url'=>'https://interface.e8pay.com/api/pay/Order', /*支付接口请求地址，请联系技术支持确认 */
        'ly_user_id'=>'61000006',/* 商户号 */
        /* ↓↓↓↓↓↓↓↓平台提供的公钥填写至此处↓↓↓↓↓↓ */
        'public_rsa_key'=>'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAvIWcc/moe45UAM2qyrig2Hqk7u4tNmzGuOaJ4vm38CF0Lc1U/75NrDnSImj4KfCAWFfDDZFDXw61PBvkSMqh451TvIq/kL7Rhziclfmht1vHr69ArI4SNzUbBsBUmdq51rVz3SWu2Kgno4UMCKweiTi6fLLBVzNU5lOBKJ06y6j+9gi0R8i7o32QcwlfuCyyN2tzY62Lzqy1YfhrHgviMZ2pe78PcDWYSwc+dJjStPT6lR1czXoBrRvtzdp9GPbXVi1jGlauEBbpWnl+tG0XDv3u939zXnHLuSYB23FYmUQbW30DkRriQZ12UXZ352SNbh5xtHKR0OmI8Fqse0JJXwIDAQAB' , /* 平台提供的公钥填写至此处 */
        /* ↓↓↓↓↓↓↓↓自己生成的私钥填写至此处↓↓↓↓↓↓  需要把您自己生成的公钥填写至平台配置页面 */
        'private_rsa_key'=>'MIIEowIBAAKCAQEAyBZNTAlsu3Z5d6yQ2jeoNp3XJITbAvJLrgLfdYJSX9//9YUPI+rZG4ifPgcYkw4qjYFdTABmU3S9fGWvqcmvnZKQeI8Fk7m8P/TJSR1LYBQtBHHF6VoYD5PxkSVGpuZ6wMOd+eSKXrWRrymUyyjQF0IE4kxAFQMxLKCB0iZa1/vleqh8fhlc+g/UoYr4q73bl/JUE/Rq/kBYoOUF0Tzc+ZgSN3TqRBrmUtE2mAwZ5rPIPH9VoJLzidcmkIR9xvsZCLgOxKodx9yAlN1arzwzZOiTXy9wBNZMaufuGxXyMKX/BoaXwO5cz6Ia9zjUdIXOWgAu1cHZxB7dMInRXcsO9QIDAQABAoIBADCbgmGzdG/CI1YYXQQ2Oy4xgB+GCvKXTB1U41ZXt41FDJhnn7r5BY8zzIO0E5s9+MZxo+mfuzwRAytiRJ95uKkN/vzaud8eYwYigHe7nyETJbCLtymuUmQOa8P4C0bmfPGxVAJuK9NARskHz/bezlaoGimjnnm8UcjmoUMdQDpxr8qGSvgkmsJqJeCIm5fs1JLx0RRQ5MMWIoZjn6IBXX7/RnsvgZEK1XAPXKy/yqfbOmllAIpEEQXVCSofOGBp3yx1hGL/QHxIgTvW8GvGy12cSmRNl2685vfwW2PEqV77kjZe5Gv6pWceEuBJE3HYijZDaqpChk5E1JXezRuoNKECgYEA+xF20zI8SSs44mAPKrSEWH2yDRYYvwpcU2W/p5z/jKE0IztGDsPcvOGDs/Ooh7IZn+Mw/c4S58XDZbFYKfom9mrRgdsZ2TN674J+0L2eV4/EBNamP7q/EBdCKpvGqLY+IRxYDwVLwZq6U5DSY8VFIAAyL1//joHry80ADP8MCf0CgYEAzAR4qPOgcYzug5YiQaHeUV9i3RtQ46LN0i/Gg+qMNRW6mAEWY3m9hN8pEAbFcJru7IHmW9JcnlCspwN5Z2gisI9zP2KlrYmLNDlLcstHp6HjITMz7IJtdUQ0wJ346AK2L7pHkrRJKqN95W43K809sHn4LN+XKPLQNtOSuUB6zlkCgYBmdV0RmSmjDoF7WIo3+k0cM8eKsZ7Nr7O30QkipN5hDJRTYGgZtHKLnlh6ApCfN95fMn8WxJdQgJNaF8KL9usZmsP/A2QMEIc14QJRu2A4CZKMCvDzhwlbzrIQ41tyFFVMe92v25Br5PHvEmXZk3K/OXVBgiKvjHOmyvUfWKIYHQKBgEm1u9pe2zLrVilYjtvjna0Mp213Nwxnf7FW7YQvs6RiS14r1mjuTRi6f914dNEwSO5OKGo4YJoaT6avzKcdqprb2SmnfHBsZ0zg/m9lHmhkRulx1Gq43M8na1/EM2+vux8XUFCirmSnWQ8ReQFsT8N47b9YsQZsY+nLGxGvSC9RAoGBAKyGCZaIc7JXBKzf7mo189fqEaDs52eflCddN5sZDJgF8u2GS1R82qMWQrBS5eVb7pF1kZ/5ep3JgT8lOXcV8usVIm1z+gveFIxCv5SAn+27pnrbcvzm/LvXgxkB3UqQ4Fyp7WtcJSm/ywLq316gB2+z0tLegwTkFgz/v+aFjmBd'  /* 用户生成的私钥填写至此处 */
       );
    
    public function C($cfgName){
        return $this->cfg[$cfgName];
    }
}
?>