$(function() {
    $(".layer_bg_tishi").hide();
    $(".layer_wrap_tishi").hide();
	
	$("ul.tabs").tabs("div.panes > div");

	$(".Validform").Validform({
		tiptype: 3,
		datatype:{
			"s620" : /^[A-Za-z0-9]{6,20}$///6-20λ���ֻ���ĸ			
		}
	});
	
	$(".form").Validform({
		tiptype:function(msg,o,cssctl){
			var objtip=$(".error");
			cssctl(objtip,o.type);
			objtip.text(msg);
		},
        datatype:{
            "phone" : /^(((13[0-9]{1})|(15[0-9]{1})|(17[0-9]{1})|(18[0-9]{1}))+\d{8})$/,//????
            "username" : /^[A-Za-z]{1}[A-Za-z0-9]{5,19}$/,//6-20??????,?????
            "n20" : /^[A-Za-z0-9]{6,20}$/, //6-20??????
            "n18"  : /^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}(\d|X|x)$/, //???
            "n4-4":/^[0-9]{4,4}$/,//?????
            "n6-6":/^[0-9]{6,6}$/, //?????
			"n11":/^[0-9]{11}$/
        }
	});
	
	$(".highsearch ul li .more").on("click",function(){
		$(this).parent("li").toggleClass("h_auto");
	})
	
	$(".highsearch .list a").on("click",function(){
		$(this).siblings().removeClass("select");
		$(this).addClass("select");
	})	
	
	$(".advisor .ewm").hover(
	  function () {
		$(this).addClass("ewm_b");
	  },
	  function () {
		$(this).removeClass("ewm_b");
	  }
	);
	
	$(".advisor:odd").addClass("ml30");
	$("table.sm tr:even").addClass("even");
});

//弹出提示框
function tishi(message){
    $('.layer_wrap_tishi #message_error').text(message);
    $('.layer_bg_tishi').show();
    $('.layer_wrap_tishi').show();
}

//***********关闭弹出框********
function closeAll_1(){
	$(".layer_bg").hide();
	$(".layer_wrap").hide();
	$(".layer_bg_tishi").hide();
	$(".layer_wrap_tishi").hide();
	$(".layer_bg01").hide();
	$(".layer_wrap01").hide();
	$(".layer_bg02").hide();
	$(".layer_wrap02").hide();
	$(".layer_bg03").hide();
	$(".layer_wrap03").hide();
	$(".layer_bg04").hide();
	$(".layer_wrap04").hide();
	$(".layer_bg05").hide();
	$(".layer_wrap05").hide();
    $(".layer_bg06").hide();
    $(".layer_wrap06").hide();
    $(".layer_bg07").hide();
    $(".layer_wrap07").hide();
    $(".layer_bg08").hide();
    $(".layer_wrap08").hide();
}
function close_tishi(){
	$(".layer_bg_tishi").hide();
	$(".layer_wrap_tishi").hide();
}



