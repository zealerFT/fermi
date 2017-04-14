/*
* 系统中JS的扩展函数
*
*
*/
// 清除两边的空格
String.prototype.trim = function() {
    return this.replace(/(^\s*)|(\s*$)/g, '');
};
// 合并多个空白为一个空白
String.prototype.ResetBlank = function() {
    var regEx = /\s+/g;
    return this.replace(regEx, ' ');
};
// 保留数字
String.prototype.GetNum = function() {
    var regEx = /[^\d]/g;
    return this.replace(regEx, '');
};
// 保留中文
String.prototype.GetCN = function() {
    var regEx = /[^\u4e00-\u9fa5\uf900-\ufa2d]/g;
    return this.replace(regEx, '');
};
// String转化为Number
String.prototype.ToInt = function() {
    return isNaN(parseInt(this)) ? this.toString() : parseInt(this);
};
// 得到字节长度
String.prototype.GetLen = function() {
    var regEx = /^[\u4e00-\u9fa5\uf900-\ufa2d]+$/;
    if (regEx.test(this)) {
        return this.length * 2;
    } else {
        var oMatches = this.match(/[\x00-\xff]/g);
        var oLength = this.length * 2 - oMatches.length;
        return oLength;
    }
};
// 获取文件全名
String.prototype.GetFileName = function() {
    var regEx = /^.*\/([^\/\?]*).*$/;
    return this.replace(regEx, '$1');
};
// 获取文件扩展名
String.prototype.GetExtensionName = function() {
    var regEx = /^.*\/[^\/]*(\.[^\.\?]*).*$/;
    return this.replace(regEx, '$1');
};
/******add By 刘景宁 2010-12-09 *******/
String.prototype.replaceAll = function(reallyDo, replaceWith, ignoreCase) {
    if (!RegExp.prototype.isPrototypeOf(reallyDo)) {
        return this.replace(new RegExp(reallyDo, (ignoreCase ? "gi" : "g")), replaceWith);
    } else {
        return this.replace(reallyDo, replaceWith);
    }
};
//格式化字符串 add By 刘景宁 2010-12-09
String.Format = function() {
    if (arguments.length == 0) {
        return '';
    }
    if (arguments.length == 1) {
        return arguments[0];
    }
    var reg = /{(\d+)?}/g;
    var args = arguments;
    var result = arguments[0].replace(reg, function($0, $1) {
        return args[parseInt($1) + 1];
    });
    return result;
};
// 数字补零
Number.prototype.LenWithZero = function(oCount) {
    var strText = this.toString();
    while (strText.length < oCount) {
        strText = '0' + strText;
    }
    return strText;
};
// Unicode还原
Number.prototype.ChrW = function() {
    return String.fromCharCode(this);
};
// 数字数组由小到大排序
Array.prototype.Min2Max = function() {
    var oValue;
    for (var i = 0; i < this.length; i++) {
        for (var j = 0; j <= i; j++) {
            if (this[i] < this[j]) {
                oValue = this[i];
                this[i] = this[j];
                this[j] = oValue;
            }
        }
    }
    return this;
};
// 数字数组由大到小排序
Array.prototype.Max2Min = function() {
    var oValue;
    for (var i = 0; i < this.length; i++) {
        for (var j = 0; j <= i; j++) {
            if (this[i] > this[j]) {
                oValue = this[i];
                this[i] = this[j];
                this[j] = oValue;
            }
        }
    }
    return this;
};
// 获得数字数组中最大项
Array.prototype.GetMax = function() {
    var oValue = 0;
    for (var i = 0; i < this.length; i++) {
        if (this[i] > oValue) {
            oValue = this[i];
        }
    }
    return oValue;
};
// 获得数字数组中最小项
Array.prototype.GetMin = function() {
    var oValue = 0;
    for (var i = 0; i < this.length; i++) {
        if (this[i] < oValue) {
            oValue = this[i];
        }
    }
    return oValue;
};
/**
*删除数组指定下标或指定对象
*/
Array.prototype.remove = function(obj){
    for(var i =0;i <this.length;i++){
        var temp = this[i];
        if(!isNaN(obj)){
            temp=i;
        }
        if(temp == obj){
            for(var j = i;j <this.length;j++){
                this[j]=this[j+1];
            }
            this.length = this.length-1;
        }
    }
}
// 获取当前时间的中文形式
Date.prototype.GetCNDate = function() {
    var oDateText = '';
    oDateText += this.getFullYear().LenWithZero(4) + new Number(24180).ChrW();
    oDateText += this.getMonth().LenWithZero(2) + new Number(26376).ChrW();
    oDateText += this.getDate().LenWithZero(2) + new Number(26085).ChrW();
    oDateText += this.getHours().LenWithZero(2) + new Number(26102).ChrW();
    oDateText += this.getMinutes().LenWithZero(2) + new Number(20998).ChrW();
    oDateText += this.getSeconds().LenWithZero(2) + new Number(31186).ChrW();
    oDateText += new Number(32).ChrW() + new Number(32).ChrW() + new Number(26143).ChrW() + new Number(26399).ChrW() + new String('26085199682010819977222352011620845').substr(this.getDay() * 5, 5).ToInt().ChrW();
    return oDateText;
};
//扩展Date格式化
Date.prototype.Format = function(format) {
    var o = {
        "M+": this.getMonth() + 1, //月份
        "d+": this.getDate(), //日
        "h+": this.getHours() % 12 == 0 ? 12 : this.getHours() % 12, //小时
        "H+": this.getHours(), //小时
        "m+": this.getMinutes(), //分
        "s+": this.getSeconds(), //秒
        "q+": Math.floor((this.getMonth() + 3) / 3), //季度
        "S": this.getMilliseconds() //毫秒
    };
    var week = {
        "0": "\u65e5",
        "1": "\u4e00",
        "2": "\u4e8c",
        "3": "\u4e09",
        "4": "\u56db",
        "5": "\u4e94",
        "6": "\u516d"
    };
    if (/(y+)/.test(format)) {
        format = format.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
    }
    if (/(E+)/.test(format)) {
        format = format.replace(RegExp.$1, ((RegExp.$1.length > 1) ? (RegExp.$1.length > 2 ? "\u661f\u671f" : "\u5468") : "") + week[this.getDay() + ""]);
    }
    for (var k in o) {
        if (new RegExp("(" + k + ")").test(format)) {
            format = format.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
        }
    }
    return format;
}
//禁止回车自动提交表单
document.onkeydown = function(event) {
    var target, code, tag;
    if (!event) {
        event = window.event; //针对ie浏览器
        target = event.srcElement;
        code = event.keyCode;
        if (code == 13) {
            tag = target.tagName;
            if (tag == "TEXTAREA") { return true; }
            else { return false; }
        }
    }
    else {
        target = event.target; //针对遵循w3c标准的浏览器，如Firefox
        code = event.keyCode;
        if (code == 13) {
            tag = target.tagName;
            if (tag == "INPUT") { return false; }
            else { return true; }
        }
    }
};

//判断字符串在不在数组中
Array.prototype.Exists = function(v) {
  var b = false;
  for(var i=0;i<this.length;i++)
  {
    if(this[i]==v)
    {
      b = true;
      break;
    }
  }
  return b;
}

var sel = "白";
var arr =["白色","黑色","红色","粉色"];

if(arr.Exists(sel))
{
  alert("存在");
} else {
  alert("不存在");
}
