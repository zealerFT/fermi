$(function(){
	$(".layer_bg_tishi").hide();
	$(".layer_wrap_tishi").hide();

	//左侧菜单权限控制
	$(".link-item").on("click",function(){
		//tishi("您没有权限！");
		//return false;
	});


	//下拉切换效果start
	$(".btn-group").hover(
			function(){
				var ui_height = $(this).children(".dropdown-menu").height();
				if(ui_height>200){
					$(this).children(".dropdown-menu").css({'height':'150px','overflow-y':'scroll','border-radius':'0 0 4px 4px'});
					$(this).children(".dropdown-menu").show();
				}else{
					$(this).children(".dropdown-menu").css({'border-radius':'0 0 4px 4px'});
					$(this).children(".dropdown-menu").show();
				}
			},
			function(){
				$(this).children(".dropdown-menu").hide();
			});

	$(".dropdown-menu li").on("click",function(){//城市接口ajax
		var T = $(this).text();//文本值
		var D = $(this).find("a").attr('value');//value值
		var N = $(this).parent("ul").prev(".btn-select-option").find("span").attr('name');//name
		if(N != 'provinces'){
			$(this).parent("ul").prev(".btn-select-option").find("span").text(T).css('color','#333');
			$(this).parent("ul").prev(".btn-select-option").find("span").attr('value',D);
			setInputValue(N,D);
		}else{
			$(this).parent("ul").prev(".btn-select-option").find("span").text(T).css('color','#333');
			$(this).parent("ul").prev(".btn-select-option").find("span").attr('value',D);
			setInputValue(N,D);
			getCityList(D);
		}
		$(this).parent("ul").hide();
	})
	//下拉切换效果end

	// $("ul.tab-ul").tabs("div.panes > div");
	// $("ul.tabs02").tabs("div.panes > div");
	// $(".message").live("click",function(){
	// 	$(this).toggleClass("h_auto");
	// })

	var $oA=$("#tabs_tb1 tbody tr td").find('a');

	$oA.on("click",function(){
		$(this).parent().parent().empty();
	})
})

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
	$(".layer_bg09").hide();
	$(".layer_wrap09").hide();
}
function close_tishi(){
	$(".layer_bg_tishi").hide();
	$(".layer_wrap_tishi").hide();
}
//弹出提示框
function tishi(message){
	$('.layer_wrap_tishi #message_error').text(message);
	$('.layer_bg_tishi').show();
	$('.layer_wrap_tishi').show();
}


function addPartner(){
	var txtPartner=$('#txtPartner').val();
	var shareholdingRatio=$('#shareholdingRatio').val();
	var $table = $("#tabs_tb1 tbody");

	if(txtPartner=="" || txtPartner==undefined){
		tishi("股东不能为空");
		$("#txtPartner").focus();
		return false;
	}else if(shareholdingRatio==""||shareholdingRatio==undefined){
		tishi("持股比例不能为空");
		return false;
	}

	var $tr = $("<tr>"+
			"<td>"+txtPartner+"</td>"+
			"<td>"+shareholdingRatio+"</td>"+
			"<td>"+111+"</td>"+
			"<td><a href='javascript:void(0);'>删除</a></td>"
			+"</tr>");

	var $table = $("#tabs_tb1 tbody");
	$table.append($tr);

	$(".layer_bg").hide();
	$(".layer_wrap").hide();
}

function addBestPro(){
	$(".layer_bg").show();
	$(".layer_wrap").hide();
}

function setInputValue(N,V){
	var str = "input[name="+N+"]";
	$(str).val(V);
}


//***********验证邮箱格式********
function validemail(a){

	var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

	if (filter.test(a)) return true;
	else {
		tishi('您输入的电子邮箱格式不正确');
		return false;
	}
}

//***********验证传真格式格式********
function validworkfax(b){

	var filter  = /^((\+?[0-9]{2,4}\-[0-9]{3,4}\-)|([0-9]{3,4}\-))?([0-9]{7,8})(\-[0-9]+)?$/;

	if (filter.test(b)) return true;
	else {
		tishi('您输入的传真格式不正确');
		return false;
	}
}
/*验证客户传真格式*/
function validfax(f) {

	var filter = /^(([0-9]{3,4}\-))?([0-9]{7,8})(\-[0-9]+)?$/;

	if (filter.test(f)) return true;
	else {
		tishi('您输入的传真格式不正确');
		return false;
	}
}
//***********验证电话号码格式********
function validphone(c) {

	var filter =  /^(([0-9]{3,4}\-))?([0-9]{7,8})(\-[0-9]+)?$/;

	if (filter.test(c)) return true;
	else {
		tishi('您输入形如021-55661234的电话号码');
		return false;
	}

}
//***********验证手机号码格式********
function validcusmobile(m) {

	var filter =/^(((13[0-9]{1})|(15[0-9]{1})|(17[0-9]{1})|(18[0-9]{1}))+\d{8})$/;

	if (filter.test(m)) return true;
	else {
		tishi('您输入手机号码格式不正确');
		return false;
	}

}
//验证邮编格式
function validpostcode(p) {
	var filter = /^[1-9][0-9]{5}$/;
	if (filter.test(p)) return true;
	else {
		tishi('您输入的邮编格式不正确');
		return false;
	}
}
//验证用户名格式
function validaccountname(n) {
	var filter = /^[A-Za-z]{1}[A-Za-z0-9]{5,19}$/;
	if (filter.test(n)) return true;
	else {
		tishi('请输入字母开头，6-20位数字或字母的用户名');
		return false;
	}
}
//验证用户名格式
function valididcardno(i) {
	var filter = /^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}(\d|X|x)$/;
	if (filter.test(i)) return true;
	else {
		tishi('请输入18位身份证号码');
		return false;
	}
}
//验证汉字
function validchinese(h) {
	var filter = /[^u4e00-u9fa5]/;
	if (filter.test(h)) return true;
	else {
		tishi('请输入2-4个汉字');
		return false;
	}
}
//***********验证日期格式********
function validdate(d) {
	var filter = /^[0-9]{4}-[0-9]{2}-[0-9]{2}$/;

	if (filter.test(d)) return true;
	else {
		/*tishi('1');*/
		/*$('.error').html('您输入的日期格式不正确，请从日历中选择标准格式的日期');*/
		/*document.getElementById('error').innerhtml = '您输入的日期格式不正确，请从日历中选择标准格式的日期';*/
		tishi('您输入的日期格式不正确，请从日历中选择标准格式的日期');
		return false;
	}

}

/*消息管理菜单切换*/
$(function () {
	var $special = $("#change").find(".special");
	$special.click(function(){
		$(this).addClass("bg-color");
		$(this).siblings().removeClass("bg-color");
	})
});
/*通用菜单列表*/
$(function () {
	var $special = $(".div_nav").find(".special");
	$special.click(function(){
		$(this).addClass("bg-color");
		$(this).siblings().removeClass("bg-color");
		$(this).find("span").show();
		$(this).siblings().find("span").hide();
	});
	/*消息列表循环判断添加背景*/
	$special.each(function(i){
		if(i == 0) {
			$(this).click(function(){
				$(this).siblings().find("i").removeClass("iconList");
				$(this).find("i").addClass("iconList");
			});
		}
		if(i == 1) {
			$(this).click(function(){
				$(this).siblings().find("i").removeClass("iconList");
				$(this).find("i").addClass("iconList");
			});
		}
		if(i == 2) {
			$(this).click(function(){
				$(this).siblings().find("i").removeClass("iconList");
				$(this).find("i").addClass("iconList");
			});
		}
		if(i == 3) {
			$(this).click(function(){
				$(this).siblings().find("i").removeClass("iconList");
				$(this).find("i").addClass("iconList");
			});
		}
		if(i == 4) {
			$(this).click(function(){
				$(this).siblings().find("i").removeClass("iconList");
				$(this).find("i").addClass("iconList");
			});
		}
		if(i == 5) {
			$(this).click(function(){
				$(this).siblings().find("i").removeClass("iconList");
				$(this).find("i").addClass("iconList");
			});
		}
	});
});

/*去除浏览器默认边框*/
$(function(){
	var $a = $("a");
	$a.focus(function(){
		$(this).blur();
	});
});
//确认返回
function back(){
	if(confirm("确定要返回吗？")){
		//如果是true ，那么就把页面转向列表页
		return true;
	}
	return false;
}

/*资管认证页*/
$(function(){
	var $a_up = $(".div_list .a_up");
	var $li = $(".zg_list li");
	$li.eq(0).addClass("hue");
	$a_up.click(function(){
		$(this).parent().parent().siblings().hide();
		$(this).parent().parent().hide();
		$(this).parents().parent().prev().show();
		var  $num  = $(this).parent().parent().index()-1;
		$li.not($num).removeClass("hue");
		$li.eq($num).addClass("hue");
	});
});
