// 此為不須登入前的導覽列
//密碼監聽行為
//1. 密碼輸入時, 需要同時監聽確認密碼欄位
//2. 密碼已經不符合規定時, 確認密碼監聽行為不用啟動


var flag_check01 = false;
var flag_username = true;
var flag_password = false;
var flag_repassword = false;
var flag_email = true;
var id;
function top01() {
	// 截入資料頂端
	$.ajax({
		type: "GET",
		url: "section_R+search-待整合.php",
		// dataType: "json",
		asyns: false,//先有資料，再有畫面
		success: showdata_Readtop01,
		error: function () {
			alert("error-section_R+search-待整合.php");
		}
	});
}
function showdata_Readtop01(data) {
	// console.log(data);
	$("#top").html(data);
	member();
}







function member() {
	//登入按鈕監聽
	$("#login_btn").bind("click", function () {
		var jsonData = {};
		jsonData["username"] = $("#login_username").val();
		jsonData["password"] = $("#login_password").val();
		// console.log(JSON.stringify(jsonData));
		$.ajax({
			type: "POST",
			url: "mem_login_api.php",
			data: JSON.stringify(jsonData),
			dataType: "json",
			asyns: false,//先有資料，再有畫面
			success: showdata_login,
			error: function () {
				alert("error-mem_login_api.php");
			}
		});
	});
	//註冊按鈕監聽
	$("#reg_btn").bind("click", function () {
		console.log("test");
		if (flag_check01) {
			if (flag_password && flag_repassword) {
				//{"username":"owner", "password":"123456", "email":"xxx@ccc.xom"}
				//mem_reg_api.php

				var jsonData = {};
				jsonData["username"] = $("#reg_username").val();
				jsonData["password"] = $("#reg_password").val();
				jsonData["email"] = $("#reg_username").val();
				console.log(JSON.stringify(jsonData));
				$.ajax({
					type: "POST",
					url: "mem_reg_api.php",
					data: JSON.stringify(jsonData),
					dataType: "json",
					success: showdata_reg,
					error: function () {
						alert("error-mem_reg_api.php");
					}
				});
			} else {
				alert("欄位輸入不符規定, 請修正!");
			}
		} else {
			alert("請勾選遵守會員守則!");
		}
	});
	//帳號即時監聽
	$("#reg_username").bind("input propertychange", function () {
		if ($(this).val().length > 0 && $(this).val().length < 9) {
			//符合規則
			var jsonData = {};
			jsonData["username"] = $(this).val();
			console.log(JSON.stringify(jsonData));
			$.ajax({
				type: "POST",
				url: "mem_reg_check_one_api.php",
				dataType: "json",
				data: JSON.stringify(jsonData),
				success: showdata_check_one,
				error: function () {
					alert("error-mem_reg_check_one_api.php")
				}
			});
			$("#reg_valid-feedback").text("帳號輸入正確");
			$("#reg_username").removeClass("is-invalid");
			$("#reg_username").addClass("is-valid");
			flag_username = true;
		} else {
			//不符合規則
			$("#reg_invalid-feedback").text("帳號輸入錯誤");
			$("#reg_username").removeClass("is-valid");
			$("#reg_username").addClass("is-invalid");
			flag_username = false;
		}
	});
	//密碼即時監聽
	$("#reg_password").bind("input propertychange", function () {
		if ($(this).val().length > 0 && $(this).val().length < 9) {
			//符合規則
			// $("#err_reg_password").html("密碼符合規則!");
			// $("#err_reg_password").css("color", "green");

			$("#reg_password").removeClass("is-invalid");
			$("#reg_password").addClass("is-valid");
			flag_password = true;
		} else {
			//不符合規則
			// $("#err_reg_password").html("不密碼符合規則!");
			// $("#err_reg_password").css("color", "red");

			$("#reg_password").removeClass("is-valid");
			$("#reg_password").addClass("is-invalid");
			flag_password = false;
		}
	});
	//確認密碼即時監聽
	$("#reg_re_password").bind("input propertychange", function () {
		console.log("test");
		if ($(this).val() == $("#reg_password").val()) {
			//密碼確認一致
			$("#err_reg_re_password").html("確認密碼一致!");
			$("#err_reg_re_password").css("color", "green");
			flag_repassword = true;
		} else {
			$("#err_reg_re_password").html("密碼不一致!");
			$("#err_reg_re_password").css("color", "red");
			flag_repassword = false;
		}
	});
	//會員守則 即時監聽
	$("#mem_check01").bind("input propertychange", function () {
		var check01 = [];
		$.each($("input[name='mem_check01']:checked"), function () {
			check01.push($(this).val());
		});
		console.log(check01);
		if (check01.length == 1) {
			console.log("遵守!");
			flag_check01 = true;
		} else {
			console.log("不遵守!");
			flag_check01 = false;
		}
	});
	//利用cookie 判斷登入狀態
	if (getCookie("UID01") != "" && getCookie("UID02") != "") {
		//傳遞至後端 驗證uid
		var jsonData = {};
		jsonData["uid01"] = getCookie("UID01");
		jsonData["uid02"] = getCookie("UID02");
		// console.log(JSON.stringify(jsonData));
		$.ajax({
			type: "POST",
			url: "mem_uid_check_api.php",
			data: JSON.stringify(jsonData),
			dataType: "json",
			asyns: false,//先有資料，再有畫面
			success: showdata_uid_check,
			error: function () {
				alert("error-mem_uid_check_api.php");
			}
		});
	}
	//背景紐變換監聽
	$("#bgc_btn").bind("input propertychange", function () {
		console.log($(this).is(':checked'));
		if ($(this).is(":checked")) {
			// $(this).next().text("啟用");
			// $(this).next().css("color", "green");
			// userState = "y";
			$(this).removeClass("bg-light");
			$(this).addClass("bg-dark");
			$(this).css("border-color", "var(--mycolor16)");

			$("#bgc").removeClass("bg-light");
			$("#bgc").addClass("bg-dark");
			$("#ftc").removeClass("navbar-light");
			$("#ftc").addClass("navbar-dark");


		} else {
			$(this).removeClass("bg-dark");
			$(this).addClass("bg-light");
			$(this).css("color", "var(--mycolor16)");
			$("#bgc").removeClass("bg-dark");
			$("#bgc").addClass("bg-light");
			$("#ftc").removeClass("navbar-dark");
			$("#ftc").addClass("navbar-light");
		}
	});
	//登出按鈕監聽
	$("#logout_btn").bind("click", function () {
		setCookie("UID01", "", 7);
		setCookie("UID02", "", 7);
		location.href = "Home.html";
	});
};

function showdata_login(data) {
	console.log(data);
	console.log(data.data[0].ID);
	u_id = data.data[0].ID;
	member = {};
	member = data
	console.log(member)

	if (data.state) {
		//     alert(data.message);
		// //    location.href = "mem_control_panel.html";
		//     $("#link_control").show();

		// console.log(data.data[0].UserState);
		// console.log(data.data[0].UID01);

		//將UID寫入cookie
		setCookie("UID01", data.data[0].UID01, 7);
		setCookie("UID02", data.data[0].UID02, 7);

		//顯示會員相關訊息login_member
		$("#login_member").text(data.data[0].Username + "會員您好!");

		//隱藏登入.註冊按鈕
		$("#s2_login_btn").hide();
		$("#s2_reg_btn").hide();
		//顯示登出按鈕
		$("#logout_btn").show();
		//顯示會員選項按鈕
		$("#link_control").show();
		$("#link_control01").show();
		$("#link_control07").show();



		$("#link_control").attr("href", "myubook_R.html?id=" + u_id + "");
		$("#link_control01").attr("href", "member_one_center.html?id=" + u_id + "");

		//更換背景顏色
		$("body").removeClass();
		$("body").css("background-color", "var(--mycolor01)")

		if (data.data[0].UserState == "y") {
			//顯示後臺管理按鈕
			// location.href = "mem_control_panel.html";
			// $("#link_control").show();
		} else {
			alert("帳號已被停權!");
		}
	} else {
		alert(data.message);
	}
	if (data.data[0].Username == "demomap") {
		$("#link_control02").show();
		$("#link_control03").show();
		$("#link_control04").show();
		$("#link_control05").show();
		$("#link_control06").show();

		$("#link_control").hide();
		$("#link_control01").hide();
		$("#link_control07").hide();
	} else {
		$("#link_control02").hide();
		$("#link_control03").hide();
		$("#link_control04").hide();
		$("#link_control05").hide();
		$("#link_control06").hide();

		$("#link_control").show();
		$("#link_control01").show();
		$("#link_control07").show();
	}
}
function showdata_reg(data) {
	console.log(data);
	if (data.state) {
		alert(data.message);
		location.href = "Home.html"
	} else {
		alert(data.message);
	}
}
function showdata_check_one(data) {
	console.log(data);
	if (data.state) {
		//該帳號不存在, 帳號可以使用!
		$("#reg_valid-feedback").text("該帳號不存在, 帳號可以使用!");
		$("#reg_username").removeClass("is-invalid");
		$("#reg_username").addClass("is-valid");
		flag_username = true;
	} else {
		//該帳號已存在, 帳號不可以使用!
		$("#reg_invalid-feedback").text("該帳號已存在, 帳號不可以使用!");
		$("#reg_username").removeClass("is-valid");
		$("#reg_username").addClass("is-invalid");
		flag_username = false;
	}
}
function showdata_uid_check(data) {
	// console.log(data)
	member = {};
	member = data

	// console.log(member)
	if (data.state) {

		id = data.data[0].ID;
		//uid合法
		//顯示會員相關訊息login_member
		$("#login_member").text(data.data[0].Username + "會員您好!");

		//隱藏登入.註冊按鈕 
		$("#s2_login_btn").hide();
		$("#s2_reg_btn").hide();
		//顯示登出按鈕
		$("#logout_btn").show();
		//顯示會員選項按鈕
		$("#link_control").show();
		$("#link_control01").show();
		$("#link_control07").show();


		$("#link_control").attr("href", "myubook_R.html?id=" + id + "");
		$("#link_control01").attr("href", "member_one_center.html?id=" + id + "");

		//更換背景顏色
		$("body").removeClass();
		$("body").css("background-color", "#d4d3d3")

		if (data.data[0].UserState == "y") {
			//顯示後臺管理按鈕
			// location.href = "mem_control_panel.html";
			$("#link_control").show();
		} else {
			alert("帳號已被停權!");
		}
		// } else {
		// 	alert(data.message);//確認是否登入用訊息
	}
	
}
//form w3c
function setCookie(cname, cvalue, exdays) {
	const d = new Date();
	d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
	let expires = "expires=" + d.toUTCString();
	document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
//form w3c
function getCookie(cname) {
	let name = cname + "=";
	let decodedCookie = decodeURIComponent(document.cookie);
	let ca = decodedCookie.split(';');
	for (let i = 0; i < ca.length; i++) {
		let c = ca[i];
		while (c.charAt(0) == ' ') {
			c = c.substring(1);
		}
		if (c.indexOf(name) == 0) {
			return c.substring(name.length, c.length);
		}
	}
	return "";
}

