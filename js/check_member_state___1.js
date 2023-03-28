// 確認會員登入狀態
// 登出按鈕  #logout_btn
// 顯示會員名稱  #login_member


//利用cookie 判斷登入狀態
function check_member_state() {

	if (getCookie("UID01") != "" && getCookie("UID02") != "") {
		//傳遞至後端 驗證uid
		var jsonData = {};
		jsonData["uid01"] = getCookie("UID01");
		jsonData["uid02"] = getCookie("UID02");
		console.log(JSON.stringify(jsonData));
		$.ajax({
			type: "POST",
			url: "mem_uid_check_api.php",
			data: JSON.stringify(jsonData),
			dataType: "json",
			async: false,
			success: showdata_uid_check,
			error: function () {
				alert("error-mem_uid_check_api.php");
			}
		});
	} else {
		alert("請先登入會員!");
		location.href = "Home.html";
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

function showdata_uid_check(data) {
	console.log(data);
	if (data.state) {
		console.log(data.data[0].ID);
		//uid合法 驗證成功
		u_id = location.href.split("=")[1]; //取得網址id
		console.log(u_id);
		//確認是否有權限瀏覽畫面
		if (data.data[0].ID == u_id) {
			// console.log(data)
			$("#login_member").text(data.data[0].Username + "會員您好!");
			$("#mem123456").text("會員帳號：" + data.data[0].Username);

			//顯示登出按鈕
			$("#logout_btn").show();
			//隱藏登入.註冊按鈕 
			$("#s2_login_btn").hide();
			$("#s2_reg_btn").hide();
			//顯示會員選項按鈕
			$("#link_control").show();
			$("#link_control01").show();
			$("#link_control02").show();
			$("#link_control03").show();

			$("#myulbook_C").attr("href", "myulbook_C.html?id=" + u_id + "");
			$("#link_control01").attr("href", "member_one_center.html?id=" + u_id + "");
			//更換背景顏色
			$("body").removeClass();
			$("body").css("background-color", "#f1b978")

			if (data.data[0].UserState == "y") {
				//顯示後臺管理按鈕
				// location.href = "mem_control_panel.html";
				// $("#link_control").show();
			} else {
				alert("帳號已被停權!");
			}
			if (data.data[0].Username == "demomap") {
				$("#link_control04").show();
				$("#link_control05").show();
			} else {
				$("#link_control04").hide();
				$("#link_control05").hide();
			}



		} else {
			alert("沒有權限!");
			location.href = "Home.html";
		}
	} else {
		//uid 驗證失敗
		alert("請先登入會員!");
		location.href = "Home.html";
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
